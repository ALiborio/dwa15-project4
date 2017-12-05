<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public function race()
    {
        return $this->belongsTo('GameMaster\Race');
    }

    public function profession()
    {
        return $this->belongsTo('GameMaster\Profession');
    }

    public function stats()
    {
        return $this->belongsToMany('GameMaster\Stat')->withPivot('value');;
    }

    public function alignment()
    {
        if ($this->lawfulness == 'neutral' && $this->morality == 'neutral') {
            return 'true neutral';
        } else {
            return $this->lawfulness.' '.$this->morality;
        }
    }
}
