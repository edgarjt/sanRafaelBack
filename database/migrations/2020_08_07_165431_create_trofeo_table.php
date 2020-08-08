<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrofeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trofeoCaballo', function (Blueprint $table) {
            $table->increments('trf_id');
            $table->string('trf_titulo');
            $table->string('trf_foto');
            $table->string('trf_fecha');
            $table->string('trf_descripcion');
            $table->integer('fk_id_caballo')->unsigned();
            $table->foreign('fk_id_caballo')->references('cab_id')->on('caballo')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('trofeo');
    }
}
