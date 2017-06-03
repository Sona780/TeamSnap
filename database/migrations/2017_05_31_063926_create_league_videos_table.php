<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id')->unsigned();
            $table->string('video_url');
            $table->string('video_title');

            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_videos');
    }
}
