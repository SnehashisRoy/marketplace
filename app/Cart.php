<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * Associated table name of model
     *
     * @var string
     */
    protected $table = 'cart';
    
    /**
     * Make the columns of the table fillable
     *
     * @var array
     */
    protected $fillable = [
    	'unique_product_key',
    	'quantity',
    	'order_id'
    ];
    
    /**
     * provides the associated order
     */
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
    /**
     * Get all of the tasks for a given user.
     *
     * @param  string 
     * @param  string 
     * @return object

     */
    public static function  AddCartItemDetail($unique_product_key, $quantity)
    {
    	$cart= new static;
    	$cart->unique_product_key= $unique_product_key;
    	$cart->quantity = $quantity;
    	return $cart;
    }
}
