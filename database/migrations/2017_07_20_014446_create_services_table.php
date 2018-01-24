<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
       Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            
        });

       Schema::create('service_user', function (Blueprint $table) {
         $table->integer('service_id')->unsigned();
         $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('services_user');
        Schema::dropIfExists('services');
    }
}