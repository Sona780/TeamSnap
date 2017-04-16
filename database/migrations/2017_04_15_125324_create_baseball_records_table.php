<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseballRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baseball_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_user_id')->unsigned();
            $table->integer('game_team_id')->unsigned();
            $table->integer('at_bats');
            $table->integer('runs');
            $table->integer('hits');
            $table->integer('singles');
            $table->integer('doubles');
            $table->integer('triples');
            $table->integer('home_runs');
            $table->integer('runs_batted_in');
            $table->integer('bases_on_balls');
            $table->integer('strike_outs');
            $table->integer('stolen_bases');
            $table->integer('caught_stealing');
            $table->integer('hit_by_pitch');
            $table->integer('sacrifice_flies');

            $table->foreign('team_user_id')->references('id')->on('team_users')->onDelete('cascade');
            $table->foreign('game_team_id')->references('id')->on('game_teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baseball_records');
    }
}
