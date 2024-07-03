<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::firstOrCreate(
            [
                'required_category_id' => '1',
                'age_from' => 20,
                'age_to' => 40,
                'name' => 'Puchar Prezesa',
                'description' => 'Zawody w Krakowie',
                'date' => '2024-07-03',
                'start_hour' => '09:00:00',
                'max_participants' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            );
            Event::firstOrCreate(
                [
                    'required_category_id' => '2',
                    'age_from' => 19,
                    'age_to' => 99,
                    'name' => 'Mistrzostwa Województwa',
                    'description' => 'Zapraszamy!',
                    'date' => '2024-07-18',
                    'start_hour' => '09:30:00',  
                    'max_participants' => 60, 
                    'created_at' => now(),
                    'updated_at' => now(), 
                ]
                );
                Event::firstOrCreate(
                    [
                        'required_category_id' => '1',
                        'age_from' => 4,
                        'age_to' => 18,
                        'name' => 'Mistrzostwa Juniorów',
                        'description' => 'Kategorie wiekowe: 4-18 lat!',
                        'date' => '2024-07-28',
                        'start_hour' => '11:30:00',  
                        'max_participants' => 20,  
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                    );
    }
}
