<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_division_id')->unsigned();
            $table->string('loc_name');
            $table->string('loc_detail');
            $table->string('contact');

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
        Schema::dropIfExists('league_locations');
    }
}
