<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendedBlueprint extends Blueprint {

    /**
     * Create a new set column on the table.
     *
     * @param  string  $column
     * @param  array   $allowed
     * @return \Illuminate\Support\Fluent
     */
    public function set($column, array $allowed)
    {
        return $this->addColumn('set', $column, compact('allowed'));
    }

}


class ExtendedMySqlGrammar extends Illuminate\Database\Schema\Grammars\MySqlGrammar {

    /**
     * Create the column definition for a set type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeSet(\Illuminate\Support\Fluent $column)
    {
        return "set('".implode("', '", $column->allowed)."')";
    }

}

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
