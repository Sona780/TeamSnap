<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_manages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->integer('type');  // 0 for public, 1 for manager
            $table->boolean('member'); // 1 for access
            $table->boolean('schedule'); // 1 for access
            $table->boolean('availability'); // 1 for access
            $table->boolean('record'); // 1 for access
            $table->boolean('media'); // 1 for access
            $table->boolean('message'); // 1 for access
            $table->boolean('asset'); // 1 for access
            $table->boolean('setting'); // 1 for access

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_manages');
    }
}
