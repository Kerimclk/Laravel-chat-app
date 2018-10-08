<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Messages',function(Blueprint $table){

            $table->increments('id');

            $table->integer('from')->unsigned();
            $table->integer('receiver')->unsigned();
            $table->string('text');

            $table->foreign('from')->references('id')->on('users');
            $table->foreign('receiver')->references('id')->on('users');

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
        Schema::dropIfExists('Messages');
    }
}
