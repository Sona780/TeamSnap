<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueMatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_match_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_division_id')->unsigned();
            $table->integer('game_team_id')->unsigned();
            $table->string('result');
            $table->string('match_date');
            $table->integer('hour');
            $table->integer('minute');
            $table->boolean('time'); // 0=>am, 1=>pm
            $table->integer('league_location_id')->unsigned();

            $table->foreign('league_division_id')->references('id')->on('league_divisions')->onDelete('cascade');
            $table->foreign('league_location_id')->references('id')->on('league_locations')->onDelete('cascade');
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
        Schema::dropIfExists('league_match_details');
    }
}
