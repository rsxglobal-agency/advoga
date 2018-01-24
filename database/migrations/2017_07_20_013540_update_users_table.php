<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function (Blueprint $table) {

          $table->text('description');
          $table->string('social');
          $table->integer('state_id')->unsigned();
          $table->foreign('state_id')->references('id')->on('states');
          $table->integer('city_id')->unsigned();
          $table->foreign('city_id')->references('id')->on('cities');
          $table->integer('formation_id')->unsigned();
          $table->foreign('formation_id')->references('id')->on('formations');
          $table->integer('titulation_id')->unsigned();
          $table->foreign('titulation_id')->references('id')->on('titulations');

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
