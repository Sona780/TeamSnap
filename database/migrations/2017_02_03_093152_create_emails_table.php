<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('emails', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('title');
            $table->string('body');
            $table->integer('sender_id');
            $table->integer('team_id');
            $table->timestamp('send_at')
            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')
                  ->references('id')
                  ->on('users')
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
       Schema::drop('emails');
    }
}
