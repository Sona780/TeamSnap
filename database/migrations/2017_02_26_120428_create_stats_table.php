<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
      Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stats_name');
            $table->string('acronym_name');
            $table->string('formula');
            $table->string('stats_group');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('stats');
    }
}
