<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Size extends Model
{
    protected $table = 'product_size';

    protected $fillable = [
    		'product_id',
    		'size',
    		'image', 
    		'stock',
    		'price', 
            'sku_id',
            'unique_product_key'
    ];

    
    protected $baseDir= 'image/product';

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public static function addSizeDetail(UploadedFile $file, $size, $stock,$price,$product_id)
    {
    	$sizeDetail = new static;
    	$sizeDetail->saveAs( $size, $stock, $price, $file->getClientOriginalName(), $product_id);
        $sizeDetail->moveImage($file);
        return $sizeDetail;
     
    }

    public  function moveImage(UploadedFile $file)
    {
    	$file->move($this->baseDir, $this->image);
    }

    public function saveAs($size, $stock, $price, $image = null, $product_id = null)
    {
      $this->image = sprintf('%s-%s', time(), $image);
      $this->size= $size;
      $this->stock= $stock;
      $this->price= $price;
      $this->unique_product_key= $product_id.$size;

    } 

    public function updateSizeWithImage(UploadedFile $file, $size, $stock, $price)
    {
       
       $this->saveAs($size, $stock, $price, $file->getClientOriginalName());
       $this->moveImage($file);
       $this->save();
    }
    public function updateSizeDetail($size, $stock, $price)
    {
        $this->saveAs($size, $stock, $price);
        $this->save();
    }

    public function sizeExists(Product $product)
    {
       return $this->where('product_id',$product->id)->first()!==null? true: false;
    }
}
