<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
    	'customer_id',
    	'order_total',
    	'transaction_id'
    ];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

	public function cartItems()
	{
		return $this->hasMany('App\Cart');
	}    

    public static function addOrderDetail($transaction_id, $total)
    {
    	$order= new static;
    	$order->transaction_id= $transaction_id;
    	$order->order_total = $total;
    	return $order;
    }
}
