<?php

namespace GameMaster;

use Illuminate\Database\Schema\Grammars\MySqlGrammar;

class ExtendedMySqlGrammar extends MySqlGrammar {

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