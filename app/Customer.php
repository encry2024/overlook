<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function full_name()
    {
        return $this->name;
    }
}
