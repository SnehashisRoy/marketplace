<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = [
    	'unique_product_key',
    	'quantity',
    	'order_id'
    ];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
    public static function  AddCartItemDetail($unique_product_key, $quantity)
    {
    	$cart= new static;
    	$cart->unique_product_key= $unique_product_key;
    	$cart->quantity = $quantity;
    	return $cart;
    }
}
