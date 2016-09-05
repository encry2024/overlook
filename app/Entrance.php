<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    //
    public function entrance_type()
    {
        return $this->hasMany(EntranceType::class);
    }
}
