<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('teams_id')->unsigned();
            $table->string('date');
            $table->integer('hour');
            $table->integer('minute');
            $table->string('time');
            $table->integer('opponents_id')->unsigned();
            $table->string('results');
            $table->integer('locations_id')->unsigned();
            $table->string('place');
            $table->string('uniform');
            $table->integer('duration_hour');
            $table->integer('duration_minute');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teams_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('opponents_id')->references('id')->on('opponents')->onDelete('cascade');
            $table->foreign('locations_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
