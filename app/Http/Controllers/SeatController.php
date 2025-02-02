<?php

namespace App\Http\Controllers;
use App\Models\Seat;
use App\Models\BUS;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function getAvailableSeats()
    {
        $show_vailableseats=Seat::where('status','available')->get();
        return response()->json($show_vailableseats);
    }
}
