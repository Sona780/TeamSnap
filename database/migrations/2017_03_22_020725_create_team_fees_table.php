<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teams_id')->unsigned();
            $table->string('description');
            $table->decimal('amount');
            $table->string('note');

            $table->foreign('teams_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_fees');
    }
}
