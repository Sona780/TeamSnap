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
            $table->string('teamname')->unique();
            $table->string('sport');   //0 for sport 1 for non-sport
            $table->string('country');
            $table->integer('zip');
            $table->integer('team_owner_id')->unsigned();
            $table->string('team_logo')->default('default.jpg');
            $table->string('team_color_first');
            $table->string('team_color_second');
            $table->timestamp('created_at'); 
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
