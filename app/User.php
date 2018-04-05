<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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

    
    public function avatars() {
        return $this->hasMany(Avatars::class,'users_id');
    }

    // public function avatarsByEmail() {
    //     return $this->hasMany(Avatars::class)->orderBy('userEmail');
    // }

    public function emails() {
        return $this->avatars->pluck('userEmail');
    }
}
