<?php

namespace App\Custom;


 use App\Size;
 use App\Product;
 use Illuminate\Http\Request;



class Cart

{
	/**
     * The quantity of the added cart item.
     *
     * @var int
     */	
	
	protected $quantity;
	/**
     * The unique product key of added cart item
     *
     * @var string
     */
	protected $unique_product_key;
	/**
     * URL of the uploaded image of a product.
     *
     * @var string
     */
	protected $image;
	/**
     * The name of the product.
     *
     * @var string
     */
	protected $productName;
	/**
     * The price of the added item.
     *
     * @var float
     */
	protected $price;
	/**
     * The stock of the added item.
     *
     * @var int 
     */
	protected $stock;
	/**
     * Set value to the properties: quantity and unique_product_key
     *
     * @param int $quantity 
     * @param string $unique_product_key 
     * @return void
     */
	public function __construct($quantity, $unique_product_key)
	{
		$this->quantity = $quantity;
		$this->unique_product_key = $unique_product_key;
		
	}
	/**
     * Adding information of the added item into the session.
     *
     * @return void
     */
	
	public function addItem()
	{
		// set values to the properties
		$this->setCartProperties();
		// create an array with the attributes of added item 
		$data= array($this->unique_product_key=>[
								'image'=> $this->image,
								'productName'=> $this->productName,
								'stock'=>$this->stock,
								'price'=> $this->price,
								'quantity'=> $this->quantity,
								'key'=> $this->unique_product_key,
								'productSubTotal'=> $this->quantity * $this->price
								]);
		//if session cart is empty , push the array into the session cart
			if(session('cart')== null)
			{
			session( ['cart'=> $data]);
			}else
			{
		//if item is present in the cart, increase the quantity by one.
				if ($this->cartKeyExists($this->unique_product_key))
			{
				$item = session('cart');
				
				$item[$this->unique_product_key]['quantity'] = $item[$this->unique_product_key]['quantity'] + 1;

				session(['cart'=> $item]);
			}else
			{
		// if item has not been added yet, add the data array with a new array key
				$result= session('cart')+ $data;
				session(['cart'=>$result]);

			}
			}
   
	}

	/**
	     * Set value to the properties
	     *
	     * @return void
	     */	


	protected function setCartProperties()
	{
		$this->image= $this->makeSize()->image;
		$this->stock = $this->makeSize()->stock;
		$this->price = $this->makeSize()->price;
		$this->productName= $this->makeSize()->product->product_name;
	}
	
	/**
     * Create Size model instance
     *
     * @return void
     */
	protected function makeSize()
	{
		return Size::where([
			'unique_product_key'=> $this->unique_product_key 
			])
		    ->firstOrfail();

	}
	
	/**
     * Check whether item is already exists. 
     *
     * @param  string $Key
     * @return boolean
     */
	protected function cartKeyExists($Key)
	{
		return array_key_exists($Key, session('cart'))? true: false;
	}

	
}