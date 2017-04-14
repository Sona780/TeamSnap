<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_divisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id')->unsigned();
            $table->string('division_name');
            $table->integer('parent_id');

            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_divisions');
    }
}
