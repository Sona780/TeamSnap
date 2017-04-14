<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_division_id')->unsigned();
            $table->string('team_name');
            $table->string('owner_first_name');
            $table->string('owner_last_name');
            $table->string('owner_email');

            $table->foreign('league_division_id')->references('id')->on('league_divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_teams');
    }
}
