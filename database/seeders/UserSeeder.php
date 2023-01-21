<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
            "name" => "Admin",
            "last_name" => "Admin",
            "full_name" => "Admin Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin12"),
            "role_id" => 1
            ],
            [
            "name" => "User",
            "last_name" => "User",
            "full_name" => "User User",
            "email" => "user@gmail.com",
            "password" => Hash::make("user12"),
            "role_id" => 2
            ],
            [
            "name" => "Michael",
            "last_name" => "Jordan",
            "full_name" => "Michael Jordan",
            "email" => "michael@gmail.com",
            "password" => Hash::make("michael12"),
            "role_id" => 2
            ]
        ];
        foreach ($users as $u){
            User::create([
                "name" => $u["name"],
                "last_name" => $u["last_name"],
                "full_name" => $u["full_name"],
                "email" => $u["email"],
                "password" => $u["password"],
                "role_id" => $u["role_id"]
            ]);
        }
    }
}
