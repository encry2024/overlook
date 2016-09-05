<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntranceType extends Model
{
    //
    public function entrance_rate()
    {
        return $this->hasMany(EntranceRate::class);
    }
}
