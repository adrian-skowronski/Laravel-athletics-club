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
            ]);
            User::firstOrCreate(
            [
                'name' => 'Jan',
                'surname' => 'Nowak',
                'email' => 'nowak@mail.com',
                'password' => Hash::make('12345678'),
                'birthdate' => '1990-02-03',
                'phone' => '444555777',
                'role_id' => 2,
            ],
        );
    }
}
