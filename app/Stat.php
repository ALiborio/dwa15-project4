<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public function characters() {
        return $this->belongsToMany('GameMaster\Character');
    }
}
