<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->enum('gender', ['male','female'])->nullable();
            $table->integer('class_id')->unsigned();
            $table->integer('race_id')->unsigned();
            $table->enum('lawfulness', ['lawful', 'neutral', 'chaotic'])->nullable();
            $table->enum('morality', ['good', 'neutral', 'evil'])->nullable();
            $table->text('background')->nullable();
            $table->binary('image')->nullable();
            $table->integer('level');
            // Moved to stats pivot table
            // $table->integer('strength');
            // $table->integer('dexterity');
            // $table->integer('constitution');
            // $table->integer('intelligence');
            // $table->integer('wisdom');
            // $table->integer('charisma');

            # Setup foreign keys
            $table->foreign('class_id')->references('id')->on('professions');
            $table->foreign('race_id')->references('id')->on('races');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
