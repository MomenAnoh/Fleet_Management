<?php

namespace Database\Seeders;
use App\Models\City;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $Cities = [
            'Cairo',
            'Giza',
            'AlFayyum',
            'AlMinya',
            'Asyut'
        ];

        foreach ($Cities as $cityName) { 
            $city = new City();
            $city->City_Name = $cityName;
            $city->save();
        }
    }
}
