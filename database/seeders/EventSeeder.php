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
                'category' => 'powiatowe',
                'age_from' => 20,
                'age_to' => 40,
                'name' => 'Puchar Prezesa',
                'description' => 'Zapraszamy do Krakowa!',
                'date' => '2024-06-06',
                'start_hour' => '09:00:00',
                'max_participants' => 40,
            ]
            );
            Event::firstOrCreate(
                [
                    'category' => 'wojewódzkie',
                    'age_from' => 20,
                    'age_to' => 99,
                    'name' => 'Mistrzostwa Województwa',
                    'description' => 'Zapraszamy do Rzeszowa!',
                    'date' => '2024-06-08',
                    'start_hour' => '11:30:00',  
                    'max_participants' => 60,  
                ]
                );
    }
}
