<?php

use Illuminate\Support\Facades\Schema;
use GameMaster\ExtendedBlueprint;
use Illuminate\Database\Migrations\Migration;
use GameMaster\ExtendedMySqlGrammar;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // set new grammar class
        DB::connection()->setSchemaGrammar(new ExtendedMySqlGrammar());

        // get custom schema object
        $schema = DB::connection()->getSchemaBuilder();

        // bind new blueprint class
        $schema->blueprintResolver(function($table, $callback) {
            return new ExtendedBlueprint($table, $callback);
        });

        // then create tables 
        $schema->create('races', function (ExtendedBlueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->set('bonus_attr', [
                'strength',
                'dexterity',
                'constitution',
                'intelligence',
                'wisdom',
                'charisma'
            ])->nullable();
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
        Schema::dropIfExists('races');
    }
}
