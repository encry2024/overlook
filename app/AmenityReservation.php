<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmenityReservation extends Model
{
    //
    protected $table = 'amenity_reservation';

    public function amenity()
    {
        return $this->belongsTo(Amenity::class);
    }
}
