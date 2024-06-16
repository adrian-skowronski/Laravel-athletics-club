<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->unsignedBigInteger('required_category_id');
            $table->foreign('required_category_id')->references('category_id')->on('categories');
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('start_hour');
            $table->integer('max_participants');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}