<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function seat()
{
    return $this->belongsTo(Seat::class);
}

public function bus()
{
    return $this->belongsTo(Bus::class);
}

public function trip()
{
    return $this->belongsTo(Trip::class);
}
}
