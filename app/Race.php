<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function characters()
    {
        # Race has many Characters
        # Define a one-to-many relationship.
        return $this->hasMany('GameMaster\Character');
    }
}
