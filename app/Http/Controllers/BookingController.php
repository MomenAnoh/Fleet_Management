<?php

namespace App\Http\Controllers;
use App\Models\Seat;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    use ApiResponseTrait;
    
    public function storebooking(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'Name' => 'required|string|max:255',
            'phone' => 'required|max:15',
            'seat_id' => 'required|exists:seats,id',
            'bus_id' => 'required|exists:buses,id',
            'trip_id' => 'required|exists:trips,id', // تأكد من وجود الرحلة في جدول trips
        ]);
        if($validator->fails())
        {
            return $this->apiResponse(NULL,$validator->errors(),200);
        }
        $trip = Trip::find($request->trip_id);
        if ($trip && $trip->includesCities($request->from, $request->to)) {
            $seat = Seat::find($request->seat_id);
            if ($seat && $seat->status == 'available') {
                $store = new Booking();
                $store->Name = $request->Name;
                $store->phone = $request->phone;
                $store->seat_id = $request->seat_id;
                $store->bus_id = $request->bus_id;
                $store->trip_id = $request->trip_id;
                $store->from = $request->from;
                $store->to = $request->to;
                $store->save();

                $seat->status = 'reserved';
                $seat->save();
                
                $bus=Bus::find($request->bus_id);
                $bus->total_seets--;
               $bus->save();

                return $this->apiResponse($store, 'Booking Done', 200); // تأكد من الحالة هنا
            } else {
                return $this->apiResponse(null, 'Seat is not available', 400); // تعديل الحالة هنا أيضاً
            }
        }
        else {
            return $this->apiResponse(null, 'he cities in this path are not in the correct order.', 400);
        }
    }
}
