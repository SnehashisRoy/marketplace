<?php

namespace App;

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
    /**
     * Get all the products created by a user.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    /**
     * Get the associated role of a user.
     */
    public function role()
    {
        return $this->hasOne('App\Role');
    }



}





