<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtuationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('atuations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            
        });

       Schema::create('atuation_user', function (Blueprint $table) {
         $table->integer('atuation_id')->unsigned();
         $table->foreign('atuation_id')->references('id')->on('atuations');
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');


       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atuations_user');
        Schema::dropIfExists('atuations');
    }
}
