<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    public function characters()
    {
        return $this->hasMany('GameMaster\Character');
    }

    public function user()
    {
        return $this->belongsTo('GameMaster\User');
    }
}
