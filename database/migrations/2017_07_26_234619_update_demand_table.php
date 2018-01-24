<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('demands', function (Blueprint $table) {

          
          $table->integer('executor_id')->unsigned()->nullable();
          $table->foreign('executor_id')->references('id')->on('users');
          $table->integer('stars')->unsigned();

          $table->integer('formation_id')->unsigned();
          $table->foreign('formation_id')->references('id')->on('formations');
          $table->integer('titulation_id')->unsigned();
          $table->foreign('titulation_id')->references('id')->on('titulations');
          
          $table->dropColumn('remember_token');
      });

       Schema::create('demand_executor', function (Blueprint $table) {

          $table->integer('executor_id')->unsigned()->nullable();
          $table->foreign('executor_id')->references('id')->on('users');
          $table->integer('demand_id')->unsigned()->nullable();
          $table->foreign('demand_id')->references('id')->on('demands');

       });

       Schema::create('demand_service', function (Blueprint $table) {

          $table->integer('service_id')->unsigned()->nullable();
          $table->foreign('service_id')->references('id')->on('services');
          $table->integer('demand_id')->unsigned()->nullable();
          $table->foreign('demand_id')->references('id')->on('demands');

       });

         Schema::create('atuation_demand', function (Blueprint $table) {

          $table->integer('atuation_id')->unsigned()->nullable();
          $table->foreign('atuation_id')->references('id')->on('atuations');
          $table->integer('demand_id')->unsigned()->nullable();
          $table->foreign('demand_id')->references('id')->on('demands');

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
