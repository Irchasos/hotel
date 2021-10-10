<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TouristObjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   final public function up()
    {
        Schema::create('tourist_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

        });
    }

   final public function down()
    {
        Schema::dropIfExists('tourist_objects');
    }
}
