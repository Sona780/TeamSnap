<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ctgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');
        });
    }


    public function down()
    {
         Schema::drop('ctgs');
    }
}
