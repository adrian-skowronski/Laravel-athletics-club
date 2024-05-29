<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(
            ['role_id' => 1, 'name' => 'admin']);
            Role::firstOrCreate(['role_id' => 2, 'name' => 'trener']);
            Role::firstOrCreate(['role_id' => 3, 'name' => 'sportowiec']);
    }
}
