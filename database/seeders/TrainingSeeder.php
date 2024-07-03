<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
                'date' => '2024-07-02',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
                'trainer_id' => 2,
                'max_points' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Training::firstOrCreate(
            [
                'description' => 'Rozciąganie',
                'date' => '2024-07-19',
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'trainer_id' => 2, 
                'max_points' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        Training::firstOrCreate(
            [
                'description' => 'Gimnastyka',
                'date' => '2024-07-26',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
                'trainer_id' => 3, 
                'max_points' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
