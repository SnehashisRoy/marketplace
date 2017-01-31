<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Make the columns fillable
     *
     * @var array
     */
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
    /**
     * Get the all the orders of the customer
     */
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
