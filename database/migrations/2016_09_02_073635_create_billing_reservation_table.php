<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_reservation', function(Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->string('billing_reference');
            $blueprint->integer('reservation_id');
            $blueprint->string('total_cost');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('billing_reservation');
    }
}
