<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyworkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myworkouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('created_workout');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('created_workout')->references('id')->on('workouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myworkouts');
    }
}
