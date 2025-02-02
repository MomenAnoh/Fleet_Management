<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function stops_cities()
    {
        return $this->hasMany(Stop_City::class)->orderBy('order');
    }
    public function Path_Cities($from,$to)
    {
        $cities_ids=$this->stops_cities()->pluck('city_id')->toArray();
        // المفروض اني هبحث عن المدن ال هينتقل منها واليها اليوزر في الاراي الي هتطلع
        $start_Posetion=array_search($from, $cities_ids);
        $end_Posetion=array_search($to, $cities_ids);
       
        return $start_Posetion !== false && $end_Posetion !== false && $start_Posetion < $end_Posetion;
    }
}
