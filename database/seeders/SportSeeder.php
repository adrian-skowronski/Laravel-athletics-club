<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sport;


class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sport::firstOrCreate([
            'name' => 'biegi krótkodystansowe',
        ]
        );
        Sport::firstOrCreate([
            'name' => 'skoki wzwyż',
        ]
        );
    }
}
