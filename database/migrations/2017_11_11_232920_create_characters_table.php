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
            $table->integer('profession_id')->unsigned();
            $table->integer('race_id')->unsigned();
            $table->enum('lawfulness', ['lawful', 'neutral', 'chaotic'])->nullable();
            $table->enum('morality', ['good', 'neutral', 'evil'])->nullable();
            $table->text('background')->nullable();
            $table->binary('image')->nullable();
            $table->integer('level');
            $table->integer('user_id')->unsigned();

            # Setup foreign keys
            $table->foreign('profession_id')->references('id')->on('professions');
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('user_id')->references('id')->on('users');
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
