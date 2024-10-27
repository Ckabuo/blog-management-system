<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'username' => 'madMax',
            'phone_number' => '+2348131828555',
            'email' => 'super@admin.com',
            'password' => Hash::make ('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super-admin');

        $admin = User::create([
            'username' => 'admin',
            'phone_number' => '+2348131000555',
            'email' => 'admin@admin.com',
            'password' => Hash::make ('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'username' => 'user',
            'phone_number' => '+2348131000000',
            'email' => 'user@user.com',
            'password' => Hash::make ('password'),
        ]);
        $user->assignRole('user');
    }
}
