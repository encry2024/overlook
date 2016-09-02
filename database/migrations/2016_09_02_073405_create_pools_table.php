<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pools', function( Blueprint $blueprint ) {
            $blueprint->increments('id');
            $blueprint->string('name');
            $blueprint->string('min_capacity');
            $blueprint->string('max_capacity');
            $blueprint->decimal('price',5,2);
            $blueprint->string('file_location');
            $blueprint->string('description');
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
        Schema::drop('pools');
    }
}
