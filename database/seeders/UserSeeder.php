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
            'user_code' => '#ADMINHOCI',
            'role' => 'admin',
            'email' => 'adminhoci@gmail.com',
            'full_name' => 'Administrator',
            'username' => 'adminhoci777',
            'password' => Hash::make('adminhoci777'),
            'status' => 'active',
            'last_active' => now(),
        ]);

        // Member User
        User::create([
            'user_code' => 'MBRHOCI0001',
            'role' => 'member',
            'email' => 'member@gmail.com',
            'full_name' => 'Member User',
            'username' => 'member777',
            'password' => Hash::make('member777'),
            'status' => 'active',
            'last_active' => now(),
        ]);

        // Member User
        User::create([
            'user_code' => 'MBRHOCI0002',
            'role' => 'member',
            'email' => 'membergacor@gmail.com',
            'full_name' => 'GusCor',
            'username' => 'mangguscor',
            'password' => Hash::make('anjirgacor22'),
            'status' => 'active',
            'last_active' => now(),
        ]);
    }
}
