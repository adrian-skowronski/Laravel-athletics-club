<?php

namespace Database\Seeders;

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
            'created_at' => now(),
            'updated_at' => now(),
        ]
        );
        Sport::firstOrCreate([
            'name' => 'skoki wzwyż',
            'created_at' => now(),
            'updated_at' => now(),
        ]
        );
        Sport::firstOrCreate([
            'name' => 'skoki w dal',
            'created_at' => now(),
            'updated_at' => now(),
        ]
        );
    }
}
