<?php

namespace GameMaster;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function characters()
    {
        return $this->hasMany('GameMaster\Character');
    }

    public function parties()
    {
        return $this->hasMany('GameMaster\Party');
    }

    public function professions()
    {
        return $this->hasMany('GameMaster\Profession');
    }

    public function races()
    {
        return $this->hasMany('GameMaster\Race');
    }

    public function stats()
    {
        return $this->hasMany('GameMaster\Stat');
    }
}
