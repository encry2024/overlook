<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function( Blueprint $blueprint ) {
            $blueprint->increments('id');
            $blueprint->string('name');
            $blueprint->string('min_capacity');
            $blueprint->string('max_capacity');
            $blueprint->string('price');
            $blueprint->string('file_location')->nullable();
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
        Schema::drop('categories');
    }
}
