<?php

namespace GameMaster;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public function race()
    {
        return $this->belongsTo('GameMaster\Race');
    }

    public function party()
    {
        return $this->belongsTo('GameMaster\Party');
    }

    public function profession()
    {
        return $this->belongsTo('GameMaster\Profession');
    }

    public function stats()
    {
        return $this->belongsToMany('GameMaster\Stat')->withPivot('value');
    }

    public function user()
    {
        return $this->belongsTo('GameMaster\User');
    }

    /**
     * Gets the external alignment value by combining the two axes
     *
     * @return external alignment text
     */
    public function alignment()
    {
        // 'neutral neutral' is silly, so we normalize to 'true neutral' instead.
        if ($this->lawfulness == 'neutral' && $this->morality == 'neutral') {
            return 'true neutral';
        } else {
            return $this->lawfulness.' '.$this->morality;
        }
    }

    /**
     * generates the statsList for this character based on profession and race
     *
     * @param Collection of all GameMaster\Stat
     * @return external alignment text
     */
    public function generateStats($stats)
    {
        $statCount = count($stats);
        for ($i=0; $i < $statCount; $i++) { 
            $values[$i] = rand(1,20);
        }
        rsort($values);
        $collection = $this->profession->stats->sortBy('ranking');
        // Take primary stat
        $statVal[$collection->shift()->id] = array_shift($values);
        // Take secondary stat
        $statVal[$collection->shift()->id] = array_shift($values);

        for ($i=1; $i <= $statCount; $i++) { 

            if (!isset($statVal[$i])) {
                $statVal[$i] = array_shift($values);
            }
            $mod = $this->race->stats->where('id', $i)->first();
            if ($mod) {
                $statVal[$i] += $mod->pivot->modifier;
            }
        }
        foreach ($stats as $stat) {
            $statList[$stat->id] = ['value' => $statVal[$stat->id]];
        }

        return $statList;
    }
}
