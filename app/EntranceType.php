<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntranceType extends Model
{
    //
    public function entrance_rates()
    {
        return $this->hasMany(EntranceRate::class);
    }

    public function entrance()
    {
        return $this->belongsTo(Entrance::class);
    }
}
