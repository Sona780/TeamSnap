<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teamname');
            $table->string('sport');
            $table->string('country');
            $table->integer('zip');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        
        });
    }

   
    public function down()
    {
         Schema::drop('teams');
    }
}
