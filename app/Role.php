<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * specify the Associated table of the model 
     *
     * @var string
     */
    Protected $table= 'roles';
    /**
     * make the columns fillable
     *
     * @var array
     */

    Protected $fillable= [
    	'user_id',
    	'role',
    ];
    /**
     * Get the users associated with certain role.
     */

    public function user()
    {
    	return hasMany('App\User');
    }
    /**
     * To check the role of the user
     *
     * @param  string  
     * @return boolean
     */
    public function hasRole($role)
	{
		if('admin' == $role)
		{
			return true;
		}
	}
}
