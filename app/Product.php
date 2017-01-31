<?php

namespace App;

use App\Size;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Make columns fillable
     *
     * @var array
     */
    protected $fillable= [
    		'product_name',
    		'description',
    		'user_id',
    		'type',
            'category_id'
    ];
    /**
     * Get the associated user of the product.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    /**
     * Get the associated category
     */

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    /**
     * Get the size details of the product.
     */
    public function sizes()
    {
    	return $this->hasMany('App\Size');
    }
    /**
     * Get a product model with product id .
     *
     * @param  string  
     * @return model
     */

    public static function makeProduct($product_id)
    {
    	return static::where('id', $product_id)->firstOrfail();

    }
}
