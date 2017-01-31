<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Make the columns fillble
     * @var array
     */
    protected $fillable=[
    	'customer_id',
    	'order_total',
    	'transaction_id'
    ];
    /**
     * Get the associated customers of the order 
     */

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
    /**
     * Get the cart items of the order
     */
	public function cartItems()
	{
		return $this->hasMany('App\Cart');
	}    
    /**
     * Set the properties to the model
     *
     * @param  string 
     * @param  string 
     * @return object
     */

    public static function addOrderDetail($transaction_id, $total)
    {
    	$order= new static;
    	$order->transaction_id= $transaction_id;
    	$order->order_total = $total;
    	return $order;
    }
}
