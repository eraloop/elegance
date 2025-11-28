<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                "name" => "John Doe",
                "email" => "johndoe@example.com",
                "phone" => "123-456-7890",
                "photo" => "profile1.jpg",
                "password" => bcrypt('password123'),
                "role" => "admin",
                "status" => "active",
                "email_verified_at" => now(),
                "remember_token" => Str::random(60)
            ],
            [
                "name" => "Jane Smith",
                "email" => "janesmith@example.com",
                "phone" => "987-654-3210",
                "photo" => "profile2.jpg",
                "password" => bcrypt('password123'),
                "role" => "customer",
                "status" => "active",
                "email_verified_at" => now(),
                "remember_token" => Str::random(60)
            ],
            [
                "name" => "Alice Johnson",
                "email" => "alicejohnson@example.com",
                "phone" => "555-123-4567",
                "photo" => "profile3.jpg",
                "password" => bcrypt('password123'),
                "role" => "customer",
                "status" => "inactive",
                "email_verified_at" => now(),
                "remember_token" => Str::random(60)
            ],
            [
                "name" => "Bob Williams",
                "email" => "bobwilliams@example.com",
                "phone" => "444-777-8888",
                "photo" => "profile4.jpg",
                "password" => bcrypt('password123'),
                "role" => "customer",
                "status" => "banned",
                "email_verified_at" => now(),
                "remember_token" => Str::random(60)
            ],
            [
                "name" => "Charlie Brown",
                "email" => "charliebrown@example.com",
                "phone" => "222-333-4444",
                "photo" => "profile5.jpg",
                "password" => bcrypt('password123'),
                "role" => "admin",
                "status" => "active",
                "email_verified_at" => now(),
                "remember_token" => Str::random(60)
            ]
        ];

        foreach ($users as $userData) {
            $roleName = $userData['role'];
            $user = User::create($userData);

            if ($roleName === 'admin') {
                $role = \Spatie\Permission\Models\Role::where('name', 'super_admin')->where('guard_name', 'admin')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            } else {
                $role = \Spatie\Permission\Models\Role::where('name', 'user')->where('guard_name', 'web')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }
    }
}
