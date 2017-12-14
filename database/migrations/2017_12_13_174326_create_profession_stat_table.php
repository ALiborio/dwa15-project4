<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession_stat', function (Blueprint $table) {
            $table->integer('profession_id')->unsigned();
            $table->integer('stat_id')->unsigned();
            // primary or secondary stat for this profession/class
            $table->enum('ranking', ['primary','secondary']);

            # Make foreign keys
            $table->foreign('profession_id')->references('id')->on('professions');
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
        Schema::dropIfExists('profession_stat');
    }
}
