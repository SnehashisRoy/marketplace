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
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function sizes()
    {
    	return $this->hasMany('App\Size');
    }

    public static function makeProduct($name)
    {
    	return static::where('product_name', $name)->firstOrfail();

    }
   











}
