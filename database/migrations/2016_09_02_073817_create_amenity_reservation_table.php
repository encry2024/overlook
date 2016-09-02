<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenityReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_reservation', function(Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->integer('amenity_id')->unsigned();
            $blueprint->integer('reservation_id')->unsigned();
            $blueprint->string('qty');
            $blueprint->decimal('total_price');
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amenity_reservation');
    }
}
