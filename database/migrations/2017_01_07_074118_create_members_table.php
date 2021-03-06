<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
     Schema::create('members', function (Blueprint $table) {

            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('flag');   // 0- player 1-nonplayer
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->integer('gender')->nullable();
            $table->string('role')->nullable();
            $table->string('birthday')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('players')->nullable();
            $table->string('team_name')->nullable();
            $table->string('user_id')->nullable();
            $table->string('avatar')->default('default.jpg');

        });
     }

    public function down()
    {
        Schema::drop('members');
    }
}
