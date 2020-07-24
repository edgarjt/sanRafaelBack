<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaballoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caballo', function (Blueprint $table) {
            $table->increments('cab_id');
            $table->string('cab_nombre');
            $table->string('cab_capa');
            $table->string('cab_nacimiento');
            $table->string('cab_semental');
            $table->string('cab_fot1')->nullable();
            $table->string('cab_fot2')->nullable();
            $table->string('cab_fot3')->nullable();
            $table->string('cab_video')->nullable();
            $table->integer('fk_id_user')->unsigned();
            $table->integer('fk_id_finca')->unsigned();
            $table->foreign('fk_id_user')->references('use_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fk_id_finca')->references('fin_id')->on('finca')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caballo');
    }
}
