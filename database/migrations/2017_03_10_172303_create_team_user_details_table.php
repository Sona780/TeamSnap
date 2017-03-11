<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_users_id')->unsigned();
            $table->integer('flag'); //1 for player, 0 for non-player
            $table->string('role');

            $table->foreign('team_users_id')->references('id')->on('team_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_user_details');
    }
}
