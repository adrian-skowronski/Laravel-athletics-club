<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSportTable extends Migration
{
    public function up()
    {
        Schema::create('event_sport', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('sport_id');
            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('sport_id')->references('sport_id')->on('sports');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_sport');
    }
}