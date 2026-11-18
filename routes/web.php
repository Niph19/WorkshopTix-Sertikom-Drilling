<?php

use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware(['auth', 'verified', 'roles:peserta'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'roles:panitia'])->group(function () {
    Route::get('/dashboard-admin', [PanitiaController::class, 'index'])->name('dashboard-admin.index');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('workshops', WorkshopController::class)->except('show');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
