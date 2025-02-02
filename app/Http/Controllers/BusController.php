<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    use ApiResponseTrait;
    public function add_buses(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
         'trip_id'=>'required|exists:trips,id',
         'total_seets' => 'required|integer|min:1'
        ]);
        if($validator->fails())
        {
            return $this->apiResponse(NULL,$validator->errors(),200);
        }
        $add_bus = new Bus();
        $add_bus->trip_id=$request->trip_id;
        $add_bus->total_seets=$request->total_seets;
        $add_bus->save();
        return $this->apiResponse($add_bus,'The Bus was added',200);
        
    }
}


         
       