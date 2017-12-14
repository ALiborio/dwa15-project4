<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public function characters()
    {
        return $this->belongsToMany('GameMaster\Character');
    }

    public function professions()
    {
        return $this->belongsToMany('GameMaster\Profession');
    }

    public function races()
    {
        return $this->belongsToMany('GameMaster\Race');
    }

    public function user()
    {
        return $this->belongsTo('GameMaster\User');
    }
}
