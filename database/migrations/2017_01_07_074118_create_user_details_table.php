<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
     Schema::create('user_details', function (Blueprint $table) {

            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('flag');   // 1- player 0-nonplayer
            $table->boolean('manager_access'); //1-manager 
            $table->string('mobile')->nullable();
            $table->integer('gender')->nullable();
            $table->string('role')->nullable();
            $table->string('birthday')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->string('avatar')->default('default.jpg');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
     

        });
     }

    public function down()
    {
        Schema::drop('user_details');
    }
}
