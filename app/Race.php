<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function characters()
    {
        return $this->hasMany('GameMaster\Character');
    }

    public function stats()
    {
        return $this->belongsToMany('GameMaster\Stat')->withPivot('modifier');;
    }

    public function user()
    {
        return $this->belongsTo('GameMaster\User');
    }
}
