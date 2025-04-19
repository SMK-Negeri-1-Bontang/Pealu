<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'admin',
                'nama_lengkap' => 'Administrator',
                'hp' => '081234567890',
                'email' => 'admin@example.com',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
                'role' => 'admin',
                'image' => 'https://a0.anyrgb.com/pngimg/1850/1546/admin-administrator-icon-admin%D0%B8%D1%81%D1%82%D1%80%D0%B0%D1%82%D0%BE%D1%80-system-administrator-administrator-nuvola-user-profile-hearing-login-internet-forum.png',
            ]);
        }        
    }
}
