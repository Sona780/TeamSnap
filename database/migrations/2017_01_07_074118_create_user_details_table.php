<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
     Schema::create('user_details', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('manager_access'); //1-owner, 0-member, 2-manager
            $table->string('mobile')->nullable();
            $table->integer('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('avatar')->default(config('paths.default_avatar_path'));

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
     }

    public function down()
    {
        Schema::drop('user_details');
    }
}
