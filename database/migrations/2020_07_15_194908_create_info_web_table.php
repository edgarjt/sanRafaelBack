<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoWeb', function (Blueprint $table) {
            $table->increments('inf_id');
            $table->string('inf_logo');
            $table->string('inf_telefono');
            $table->string('inf_email');
            $table->string('inf_historia', 1000);
            $table->integer('fk_id_user')->unsigned();
            $table->foreign('fk_id_user')->references('use_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('infoWeb');
    }
}
