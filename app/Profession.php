<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function characters()
    {
        # Profession has many Characters
        # Define a one-to-many relationship.
        return $this->hasMany('GameMaster\Character');
    }
}
