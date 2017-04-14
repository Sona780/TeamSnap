<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_division_id')->unsigned();
            $table->integer('team1')->unsigned();
            $table->integer('team2')->unsigned();
            $table->string('result');
            $table->string('match_date');
            $table->integer('hour');
            $table->integer('minute');
            $table->boolean('time'); // 0=>am, 1=>pm
            $table->integer('league_location_id')->unsigned();

            $table->foreign('league_division_id')->references('id')->on('league_divisions')->onDelete('cascade');
            $table->foreign('league_location_id')->references('id')->on('league_locations')->onDelete('cascade');
            $table->foreign('team1')->references('id')->on('league_teams')->onDelete('cascade');
            $table->foreign('team2')->references('id')->on('league_teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_matches');
    }
}
