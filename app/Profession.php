<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function characters()
    {
        return $this->hasMany('GameMaster\Character');
    }

    public function stats()
    {
        return $this->belongsToMany('GameMaster\Stat')->withPivot('ranking');;
    }

    public function user()
    {
        return $this->belongsTo('GameMaster\User');
    }
}
