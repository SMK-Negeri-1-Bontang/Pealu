<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'nama_lengkap' => 'Administrator',
            'hp' => '081234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role' => 'admin',
        ]);
    }
}
