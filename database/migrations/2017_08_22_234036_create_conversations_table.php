<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table){
            
            $table->increments('id');
            
            $table->integer('from_user')->unsigned();
            $table->foreign('from_user')->references('id')->on('users');
            
            $table->integer('to_user')->unsigned();
            $table->foreign('to_user')->references('id')->on('users');

            $table->integer('demand_id')->unsigned()->nullable();  
            
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
        Schema::dropIfExists('conversations');
    }
}
