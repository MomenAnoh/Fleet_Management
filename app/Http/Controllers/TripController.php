<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Trip;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
class TripController extends Controller
{
    use ApiResponseTrait;
    public function add_Trips(Request $request)
    {
        $validator = Validator::make($request->all(), [
         'From'=>'required|exists:cities,id',
         'to'=>'required|exists:cities,id',
        ]);
   
        if($validator->fails())
        {
            return $this->apiResponse(NULL,$validator->errors(),200);
        }
        $add=new Trip();
        $add->From=$request->From;
        $add->to=$request->to;
        $add->save();
        return $this->apiResponse($add,'The Trip was added',200);
        
    }
    public function show_trips()
    {
        $show = Trip::with('stops_cities.city')->get();
        return $this->apiResponse($show, 'All of the Trips', 200);
    }
    
    
}
