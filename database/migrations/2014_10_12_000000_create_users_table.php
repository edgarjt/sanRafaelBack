<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('use_id');
            $table->string('use_nombre');
            $table->string('use_app');
            $table->string('use_apm');
            $table->string('use_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('use_password');
            $table->string('use_telefono', 10)->unique();
            $table->integer('use_role');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
