<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@2024'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Secretary User',
            'email' => 'secretary_1@secretary.com',
            'password' => Hash::make('secretary@2024'),
            'role' => 'secretary',
        ]);

        User::create([
            'name' => 'Secretary User',
            'email' => 'secretary_2@example.com',
            'password' => Hash::make('secretary@2024'),
            'role' => 'secretary',
        ]);
    }
}
