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
        // === ADMIN ===
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // === USER BIASA ===
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Biasa',
                'password' => bcrypt('password'),
                'role' => 'user',
                'status' => 'active',
            ]
        );

        // === STATUS FORM ===
        \App\Models\StatusForm::firstOrCreate(
            ['id' => 1],
            [
                'status' => 'Buka',
                'tanggal_buka' => now()->format('Y-m-d'),
                'tanggal_tutup' => now()->addMonths(3)->format('Y-m-d'),
                'gelombang_aktif' => 1,
            ]
        );
    }
}
