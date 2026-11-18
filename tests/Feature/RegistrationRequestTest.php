<?php

use App\Http\Requests\RegistrationRequest;
use App\Models\Registration;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::post('/test/registrations', fn (RegistrationRequest $request) => response()->json($request->validated()));
});

it('allows a participant to order tickets again while there is enough quota', function () {
    $user = User::factory()->create();
    $workshop = Workshop::create([
        'judul' => 'Workshop Laravel',
        'deskripsi' => 'Belajar Laravel',
        'jadwal' => now(),
        'harga' => 100000,
        'kuota' => 5,
    ]);

    Registration::create([
        'order_id' => 'order-existing',
        'kode_tiket' => 'ticket-existing',
        'jumlah' => 2,
        'user_id' => $user->id,
        'workshop_id' => $workshop->id,
        'status' => 'menunggu',
    ]);

    $this->actingAs($user)
        ->postJson('/test/registrations', [
            'workshop_id' => $workshop->id,
            'jumlah' => 3,
        ])
        ->assertOk()
        ->assertJson([
            'workshop_id' => $workshop->id,
            'jumlah' => 3,
        ]);
});

it('rejects an order that exceeds the remaining workshop quota', function () {
    $user = User::factory()->create();
    $workshop = Workshop::create([
        'judul' => 'Workshop Laravel',
        'deskripsi' => 'Belajar Laravel',
        'jadwal' => now(),
        'harga' => 100000,
        'kuota' => 5,
    ]);

    Registration::create([
        'order_id' => 'order-existing',
        'kode_tiket' => 'ticket-existing',
        'jumlah' => 3,
        'user_id' => $user->id,
        'workshop_id' => $workshop->id,
        'status' => 'menunggu',
    ]);

    $this->actingAs($user)
        ->postJson('/test/registrations', [
            'workshop_id' => $workshop->id,
            'jumlah' => 3,
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('jumlah');
});
