<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_room', function( Blueprint $blueprint ) {
            $blueprint->increments('id');
            $blueprint->integer('reservation_id')->unsigned();
            $blueprint->integer('room_id')->unsigned();
            $blueprint->string('status');
            $blueprint->date('date_reserved');
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
        Schema::drop('reservation_room');
    }
}
