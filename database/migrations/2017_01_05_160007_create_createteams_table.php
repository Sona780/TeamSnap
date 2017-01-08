<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
          Schema::create('createteams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teamname')->unique();
            $table->string('sport');
            $table->string('country');
            $table->integer('zip');
        
        });
    }

   
    public function down()
    {
         Schema::drop('createteams');
    }
}
