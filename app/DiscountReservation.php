<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountReservation extends Model
{
    //
    protected $table = 'discount_reservation';

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
