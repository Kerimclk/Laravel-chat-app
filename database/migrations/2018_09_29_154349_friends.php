<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Friends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Friends',function(Blueprint $table){
            $table->increments('id');

            $table->integer('request_sender')->unsigned();
            $table->integer('request_receiver')->unsigned();
            $table->boolean('confirm');

            $table->foreign('request_sender')->references('id')->on('users');
            $table->foreign('request_receiver')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Friends');
    }
}
