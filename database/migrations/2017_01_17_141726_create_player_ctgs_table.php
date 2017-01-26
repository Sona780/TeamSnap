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
            $table->boolean('playing')->default(0);
            $table->boolean('injured')->default(0);
            $table->boolean('topstar')->default(0);
            $table->string('team_name')->nullable();
            $table->integer('member_id')->nullable();
             
        
        });
    }

   
    public function down()
    {
         Schema::drop('player_ctgs');
    }
}
