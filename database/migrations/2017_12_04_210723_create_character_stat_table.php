<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_stat', function (Blueprint $table) {
            $table->integer('character_id')->unsigned();
            $table->integer('stat_id')->unsigned();
            $table->integer('value');

            # Make foreign keys
            $table->foreign('character_id')->references('id')->on('characters');
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
        Schema::dropIfExists('character_stat');
    }
}
