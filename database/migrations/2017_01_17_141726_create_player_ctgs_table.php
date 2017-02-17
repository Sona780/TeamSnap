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
            $table->integer('member_id');
            $table->integer('ctg_id')->unsigned();
            $table->foreign('ctg_id')
                  ->references('id')
                  ->on('ctgs')
                  ->onDelete('cascade');

        
        });
    }

   
    public function down()
    {
         Schema::drop('player_ctgs');
    }
}
