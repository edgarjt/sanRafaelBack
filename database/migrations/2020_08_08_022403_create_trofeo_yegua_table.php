<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrofeoYeguaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trofeoYegua', function (Blueprint $table) {
            $table->increments('trf_id');
            $table->string('trf_titulo');
            $table->string('trf_foto')->nullable();
            $table->string('trf_fecha');
            $table->string('trf_descripcion');
            $table->integer('fk_id_yegua')->unsigned();
            $table->foreign('fk_id_yegua')->references('yeg_id')->on('yegua')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('trofeoYegua');
    }
}
