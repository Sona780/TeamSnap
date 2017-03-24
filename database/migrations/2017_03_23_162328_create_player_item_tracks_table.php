<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerItemTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_item_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_users_id')->unsigned();
            $table->integer('team_items_id')->unsigned();

            $table->foreign('team_users_id')->references('id')->on('team_users')->onDelete('cascade');
            $table->foreign('team_items_id')->references('id')->on('team_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_item_tracks');
    }
}
