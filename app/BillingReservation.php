<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingReservation extends Model
{
    //
    protected $fillable = ['total_cost'];
    protected $table = 'billing_reservation';
}
