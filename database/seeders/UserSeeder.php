<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '01710000001',
                'role' => 2, // admin
                'status' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('Admin@123'), // secure password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sub Admin User',
                'email' => 'subadmin@example.com',
                'phone' => '01710000002',
                'role' => 3, // sub-admin
                'status' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('SubAdmin@123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'phone' => '01710000003',
                'role' => 1, // normal user
                'status' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('User@123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
