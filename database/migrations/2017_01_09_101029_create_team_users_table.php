<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teams_id')->unsigned();
            $table->integer('users_id')->unsigned();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teams_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }


    public function down()
    {
         Schema::drop('team_users');
    }
}
