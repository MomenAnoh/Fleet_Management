<?php

namespace App\Http\Controllers;


use App\Models\Stop_City;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Stop_CityContorller extends Controller
{
    use ApiResponseTrait;
    public function add_Stops_Cities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id',
            'trip_id' => 'required|exists:trips,id',
            'order' => 'required|unique:stops_cities,order',
        ]);
        if($validator->fails())
        {
            return $this->apiResponse(NULL,$validator->errors(),200);
        }
       
            $stops=new Stop_City();
            $stops->city_id=$request->city_id;
            $stops->trip_id=$request->trip_id;
            $stops->order=$request->order;
            $stops ->save();
            return $this->apiResponse($stops,'The Stops Citeies was added',200);
       
    
    }
}
