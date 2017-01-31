<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Size extends Model
{
    /**
     * Name of the associated table.
     *
     * @var string
     */
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
    /**
     * Base directory for the imagae upload.
     *
     * @var array
     */
    
    protected $baseDir= 'image/product';
    /**
     * Get all of the tasks for a given user.
     */

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
    /**
     * Setting values to the properties of a Size Model instance and uplaod image.
     *
     *@param UploadedFile $file
     *@param string $size  
     *@param int $stock    
     *@param float $stock  
     *@return static 
     */
    public static function addSizeDetail(UploadedFile $file, $size, $stock,$price,$product_id)
    {
    	$sizeDetail = new static;
    	$sizeDetail->saveAs( $size, $stock, $price, $file->getClientOriginalName(), $product_id);
        $sizeDetail->moveImage($file);
        return $sizeDetail;
     
    }
    /**
     * Store the image to specified directory.
     *
     * @param  UploadedFIle $file  
     * @return void
     */
    public  function moveImage(UploadedFile $file)
    {
    	$file->move($this->baseDir, $this->image);
    }
    /**
     * Set the values to the model properties.
     *
     * @param string $size      
     * @param int $stock     
     * @param float $price       
     * @param string|null $image       
     * @param int|null $producct_id       
     * @return void
     */
    public function saveAs($size, $stock, $price, $image = null, $product_id = null)
    {
      $this->image = sprintf('%s-%s', time(), $image);
      $this->size= $size;
      $this->stock= $stock;
      $this->price= $price;
      $this->unique_product_key= $product_id.$size;

    } 
    /**
     * Update the size model instance with new values from update form and upload the new image.
     */
    public function updateSizeWithImage(UploadedFile $file, $size, $stock, $price)
    {
       
       $this->saveAs($size, $stock, $price, $file->getClientOriginalName());
       $this->moveImage($file);
       $this->save();
    }
    /**
     * Update the size model instance with new values from update form.
     */
    public function updateSizeDetail($size, $stock, $price)
    {
        $this->saveAs($size, $stock, $price);
        $this->save();
    }
    
}
