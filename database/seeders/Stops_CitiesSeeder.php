<?php

namespace Database\Seeders;

use App\Models\Stop_City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Stops_CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Stops_Cities = [
            ['city_id' => 2, 'trip_id' => 1, 'order'=> 1], 
            ['city_id' => 3, 'trip_id' => 1, 'order'=> 2], 
            ['city_id' => 4, 'trip_id' => 1, 'order'=> 3], 
            ['city_id' => 3, 'trip_id' => 2, 'order'=> 1], 
            ['city_id' => 5, 'trip_id' => 2, 'order'=> 2], 
           
        ];

        foreach ($Stops_Cities as $Stop_city) { 
            $Stop = new Stop_City();
            $Stop->city_id = $Stop_city['city_id'];
            $Stop->trip_id = $Stop_city['trip_id'];
            $Stop->order = $Stop_city['order'];
            $Stop->save();
        }
    }
    
}
