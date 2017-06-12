<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->text('detail');
            $table->string('uniform');
            $table->string('alernate_sport_name');
            $table->string('league');
            $table->string('league_url');
            $table->string('division');
            $table->string('season');
            $table->string('level');
            $table->string('age_group');
            $table->string('gender');
            $table->string('home_uniform');
            $table->string('away_uniform');
            $table->integer('time_zone_id')->unsigned();
            $table->string('custom_domain');

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_infos');
    }
}
