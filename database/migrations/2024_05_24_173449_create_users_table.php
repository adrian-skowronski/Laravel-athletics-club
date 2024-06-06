<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthdate');
            $table->integer('points')->nullable();
            $table->string('phone');
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('approved')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('sport_id')->references('sport_id')->on('sports');
            $table->foreign('category_id')->references('category_id')->on('categories');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}