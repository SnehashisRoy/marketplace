<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
     * Associated table name of the model
     *
     * @var string
     */
    protected $table = 'categories';
	/**
     * Make the columns fillable
     *
     * @var array
     */

    protected $fillable = [
    	'category'
    ];
	/**
     * Get the associated products of the category
     */
    public function product()
    {
    	return $this->hasMany('App\Product');
    }
}
