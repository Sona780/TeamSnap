<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emails_id')->unsigned();

            //user of mail
            $table->integer('users_id')->unsigned();

            //last visited by user
            $table->timestamp('last_checked_at');

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('emails_id')->references('id')->on('emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_users');
    }
}
