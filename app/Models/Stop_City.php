<?php

namespace App\Models;
use App\Models\Trip;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Stop_City extends Model
{
    use HasFactory;

    protected $table = 'stops_cities';
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
