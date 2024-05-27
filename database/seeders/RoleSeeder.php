<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['role_id' => 1, 'name' => 'admin'],
            ['role_id' => 2, 'name' => 'trener'],
            ['role_id' => 3, 'name' => 'sportowiec'],
        ];

        DB::table('roles')->insert($roles);
    }
}
