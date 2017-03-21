<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerCtgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_ctgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_users_id')->unsigned();
            $table->integer('categories_id')->unsigned();

            $table->foreign('team_users_id')->references('id')->on('team_users')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    public function down()
    {
         Schema::drop('player_ctgs');
    }
}
