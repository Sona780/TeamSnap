<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emails_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->string('subject');
            $table->text('body');
            $table->timestamp('send_at');

            $table->foreign('emails_id')->references('id')->on('emails')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_infos');
    }
}
