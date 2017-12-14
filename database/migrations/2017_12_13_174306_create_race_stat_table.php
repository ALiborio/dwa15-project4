<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_stat', function (Blueprint $table) {
            $table->integer('race_id')->unsigned();
            $table->integer('stat_id')->unsigned();
            // positive or negative modifier to this stat for this race
            $table->integer('modifier');

            # Make foreign keys
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('stat_id')->references('id')->on('stats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_stat');
    }
}
