<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            [
                'name' => 'Adrian',
                'surname' => 'Skowroński',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'birthdate' => '1999-09-08',
                'phone' => '111222333',
                'role_id' => 1,
                'approved' => 1,
            ]);
        User::firstOrCreate(
            [
                'name' => 'Adam',
                'surname' => 'Małysz',
                'email' => 'malysz@mail.com',
                'password' => Hash::make('password'),
                'birthdate' => '1977-12-03',
                'phone' => '444555777',
                'role_id' => 2,
                'sport_id' => 3,
                'approved' => 1,
            ],
        );
        User::firstOrCreate(
            [
                'name' => 'Dawid',
                'surname' => 'Kubacki',
                'email' => 'kubacki@mail.com',
                'password' => Hash::make('password'),
                'birthdate' => '1990-03-12',
                'phone' => '444555888',
                'role_id' => 2,
                'sport_id' => 2,
                'approved' => 1,
            ],
        );
        User::firstOrCreate(
            [
                'name' => 'Kamil',
                'surname' => 'Stoch',
                'email' => 'stoch@mail.com',
                'password' => Hash::make('password'),
                'birthdate' => '1987-05-25',
                'phone' => '111222333',
                'role_id' => 3,
                'sport_id' => 3,
                'approved' => 1,
                'category_id' => 2,
            ],
        );
        User::firstOrCreate(
            [
                'name' => 'Piotr',
                'surname' => 'Żyła',
                'email' => 'zyla@mail.com',
                'password' => Hash::make('password'),
                'birthdate' => '1987-01-16',
                'phone' => '222333444',
                'role_id' => 3,
                'sport_id' => 2,
                'approved' => 1,
                'category_id' => 1,
            ],
        );
    }
}
