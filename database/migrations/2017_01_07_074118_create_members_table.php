<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
     Schema::create('members', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('role');
            $table->string('birthday');
            $table->string('city');
            $table->string('state');
          
             

        });
     }
    
    public function down()
    {
        Schema::drop('members');
    }
}
