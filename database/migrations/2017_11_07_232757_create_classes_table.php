<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->enum('primary_attr', [
                'strength',
                'dexterity',
                'constitution',
                'intelligence',
                'wisdom',
                'charisma'
            ]);
            $table->enum('secondary_attr', [
                'strength',
                'dexterity',
                'constitution',
                'intelligence',
                'wisdom',
                'charisma'
            ]);
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
