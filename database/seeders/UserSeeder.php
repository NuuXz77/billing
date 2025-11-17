<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'user_code' => 'ADM-' . strtoupper(Str::random(6)),
            'role' => 'admin',
            'email' => 'admin@example.com',
            'full_name' => 'Administrator',
            'username' => 'admin777',
            'password' => Hash::make('password'),
            'status' => 'active',
            'last_active' => now(),
        ]);

        // Member User
        User::create([
            'user_code' => 'MBR-' . strtoupper(Str::random(6)),
            'role' => 'member',
            'email' => 'member@example.com',
            'full_name' => 'Member User',
            'username' => 'member777',
            'password' => Hash::make('password'),
            'status' => 'active',
            'last_active' => now(),
        ]);
    }
}
