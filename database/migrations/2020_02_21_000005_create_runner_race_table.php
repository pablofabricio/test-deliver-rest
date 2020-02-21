<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnerRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner_race', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_runner');
            $table->unsignedInteger('id_race');
            $table->time('initial_time');
            $table->time('final_time');
            $table->foreign('id_runner')->references('id')->on('runner');
            $table->foreign('id_race')->references('id')->on('race');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runner_race');
    }
}
