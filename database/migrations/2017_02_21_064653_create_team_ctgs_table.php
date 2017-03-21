<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamCtgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('team_ctgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teams_id')->unsigned();
            $table->integer('categories_id')->unsigned();

            $table->foreign('teams_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('team_ctgs');
    }
}
