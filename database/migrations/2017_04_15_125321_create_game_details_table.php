<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_team_id')->unsigned();
            $table->string('date');
            $table->integer('hour');
            $table->integer('minute');
            $table->string('time');
            $table->integer('opponent_detail_id')->unsigned();
            $table->string('result');
            $table->integer('location_detail_id')->unsigned();
            $table->string('place');
            $table->string('uniform');
            $table->integer('duration_hour');
            $table->integer('duration_minute');

            $table->foreign('game_team_id')->references('id')->on('game_teams')->onDelete('cascade');
            $table->foreign('opponent_detail_id')->references('id')->on('opponent_details')->onDelete('cascade');
            $table->foreign('location_detail_id')->references('id')->on('location_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_details');
    }
}
