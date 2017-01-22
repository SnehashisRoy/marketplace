<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    Protected $table= 'roles';

    Protected $fillable= [
    	'user_id',
    	'role',
    ];

    public function user()
    {
    	return hasMany('App\User');
    }

    public function hasRole($role)
	{
		if('admin' == $role)
		{
			return true;
		}
	}
}
