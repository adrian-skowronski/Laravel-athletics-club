<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteEventTable extends Migration
{
    public function up()
    {
        Schema::create('athlete_event', function (Blueprint $table) {
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();

            $table->foreign('athlete_id')->references('user_id')->on('users');
            $table->foreign('event_id')->references('event_id')->on('events');
        });
    }

    public function down()
    {
        Schema::dropIfExists('athlete_event');
    }
}