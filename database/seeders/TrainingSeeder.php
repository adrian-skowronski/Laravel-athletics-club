<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Training;


class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Training::firstOrCreate(
            [
                'description' => 'Rozgrzewka',
                'date' => '2024-06-04',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
                'trainer_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Training::firstOrCreate(
            [
                'description' => 'Rozciąganie',
                'date' => '2024-06-06',
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'trainer_id' => 7, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
