<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Trip;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    public function run()
    {
        $trips = Trip::all(); // الحصول على جميع الرحلات

        foreach ($trips as $trip) {
            // إنشاء حافلة جديدة لكل رحلة
            $bus = new Bus();
            $bus->trip_id = $trip->id;
            $bus->total_seets = 12;
            $bus->save();

            // إنشاء 12 مقعد لكل حافلة
            for ($i = 1; $i <= 12; $i++) {
                $seat = new Seat();
                $seat->bus_id = $bus->id;
                $seat->seat_number = $i;
                $seat->status = 'available';
                $seat->save();
            }
        }
    }
}
