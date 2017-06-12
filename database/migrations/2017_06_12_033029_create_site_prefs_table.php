<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitePrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_prefs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->string('sort_player')->default('First Name');
            $table->string('color_scheme');
            $table->boolean('game_notify');
            $table->boolean('event_notify');
            $table->boolean('availability');
            $table->boolean('item_tracking_privacy');
            $table->boolean('non_player_item_tracking');
            $table->boolean('payment_tracking_privacy');
            $table->boolean('non_player_payment_tracking');
            $table->string('currency')->default('$');
            $table->integer('time_format')->default(12);
            $table->boolean('date_format');
            $table->boolean('assignment_tracking');
            $table->boolean('score_tracking');

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
        Schema::dropIfExists('site_prefs');
    }
}
