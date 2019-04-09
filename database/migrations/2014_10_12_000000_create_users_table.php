<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('nome_cognome', 250);
            $table->string('username', 55)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 250);
            $table->boolean('isAdmin')->nullable();
            $table->string('email_code', 200)->unique()->nullable();
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
