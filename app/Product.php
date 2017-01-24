<?php

namespace App;

use App\Size;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable= [
    		'product_name',
    		'description',
    		'user_id',
    		'type',
            'category_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function sizes()
    {
    	return $this->hasMany('App\Size');
    }

    public static function makeProduct($product_id)
    {
    	return static::where('id', $product_id)->firstOrfail();

    }
   











}
