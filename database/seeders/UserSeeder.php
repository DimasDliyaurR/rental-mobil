<?php

namespace Database\Seeders;

use App\Models\Note_user;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = User::all();
        $user = [
            [
                "username" => "owner",
                "password" => "owner123",
                "level" => "owner",
            ],
            [
                "username" => "riko",
                "password" => "riko123",
                "level" => "owner",
            ],
            [
                "username" => "setyo",
                "password" => "setyo123",
                "level" => "owner",
            ],
        ];

        foreach ($user as $i => $value) {
            if (!count($data)) {
                User::create($user[$i]);
                Note_user::create($user[$i]);
            }
        }
    }
}
