<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    public function run()
    {
        $trips = [
            ['From' => 1, 'to' => 5], // من القاهرة إلى أسيوط
            ['From' => 2, 'to' => 4]  // من الجيزة إلى المنيا
        ];

        foreach ($trips as $tripData) {
            $trip = new Trip();
            $trip->From = $tripData['From'];
            $trip->to = $tripData['to'];
            $trip->save();
        }
    }
}
