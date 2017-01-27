<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=[
    		'name',
    		'email',
    		'street',
    		'apt',
    		'city',
    		'zip',
    		'state',
    		'country'

    ];

    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
