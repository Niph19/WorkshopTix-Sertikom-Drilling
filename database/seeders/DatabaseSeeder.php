<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'asdasdasd',
            'roles' => 'panitia',
        ]);

        User::factory()->create([
            'nama_lengkap' => 'User1',
            'email' => 'user1@test.com',
            'password' => 'asdasdasd',
            'roles' => 'peserta',
        ]);

        User::factory()->create([
            'nama_lengkap' => 'User2',
            'email' => 'user2@test.com',
            'password' => 'asdasdasd',
            'roles' => 'peserta',
        ]);
    }
}
