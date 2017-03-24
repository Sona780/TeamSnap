<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_users_id')->unsigned();
            $table->integer('team_fees_id')->unsigned();
            $table->decimal('pamount');
            $table->integer('status'); // 0-> paid, 1-> not paid, 2-> does not apply
            $table->string('transaction_note');

            $table->foreign('team_users_id')->references('id')->on('team_users')->onDelete('cascade');
            $table->foreign('team_fees_id')->references('id')->on('team_fees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_fees');
    }
}
