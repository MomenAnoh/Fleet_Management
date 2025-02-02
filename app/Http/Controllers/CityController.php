<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\City;
class CityController extends Controller
{
    use ApiResponseTrait;
    public function add_Cities(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
         'City_Name'=>'required',
        ]);
        if($validator->fails())
        {
            return $this->apiResponse(NULL,$validator->errors(),200);
        }
        $add_City = new City();
        $add_City->City_Name=$request->City_Name;
        $add_City->save();
        return $this->apiResponse($add_City,'The Trip was added',200);
        
    }
}
