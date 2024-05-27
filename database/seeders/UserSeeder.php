<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'name' => 'Adrian',
            'surname' => 'Skowroński',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), 
            'phone' => 444555444,
            'category' => 'admin',
            'role_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($admin);
    }
}
