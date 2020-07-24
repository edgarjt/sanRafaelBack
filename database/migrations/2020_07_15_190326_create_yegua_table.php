<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYeguaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yegua', function (Blueprint $table) {
            $table->increments('yeg_id');
            $table->string('yeg_nombre');
            $table->string('yeg_capa');
            $table->string('yeg_nacimiento');
            $table->string('yeg_semental');
            $table->string('yeg_fot1')->nullable();
            $table->string('yeg_fot2')->nullable();
            $table->string('yeg_fot3')->nullable();
            $table->string('yeg_video')->nullable();
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
        Schema::dropIfExists('yegua');
    }
}
