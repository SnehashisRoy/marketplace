<?php

namespace App\Custom;


 use App\Size;
 use App\Product;
 use Illuminate\Http\Request;



class Cart

{
	
	
	protected $quantity;
	protected $unique_product_key;
	protected $image;
	protected $productName;
	protected $price;
	protected $stock;
	
	public function __construct($quantity, $unique_product_key)
	{
		$this->quantity = $quantity;
		$this->unique_product_key = $unique_product_key;
		
	}

	
	public function addItem()
	{
		$this->setCartProperties();
		$data= array($this->unique_product_key=>[
								'image'=> $this->image,
								'productName'=> $this->productName,
								'stock'=>$this->stock,
								'price'=> $this->price,
								'quantity'=> $this->quantity,
								'key'=> $this->unique_product_key,
								'productSubTotal'=> $this->quantity * $this->price
								]);
		
			if(session('cart')== null)
			{
			session( ['cart'=> $data]);
			}else
			{
				if ($this->cartKeyExists($this->unique_product_key))
			{
				$item = session('cart');
				
				$item[$this->unique_product_key]['quantity'] = $item[$this->unique_product_key]['quantity'] + 1;

				session(['cart'=> $item]);
			}else
			{
				$result= session('cart')+ $data;
				session(['cart'=>$result]);

			}
			}

    
	}

	/*public function updateCart( $Key, $qnt)
   	 {
   	 	$item = session('cart');
   	 	$item[$key]['quantity']= $item[$key][$qnt];
   	 	$item[$key]['productSubTotal'] = $item[$key]['quantity'] * $item[$key]['price'];
   	 	session(['cart'=> $item]);
   	 }*/


	protected function setCartProperties()
	{
		$this->image= $this->makeSize()->image;
		$this->stock = $this->makeSize()->stock;
		$this->price = $this->makeSize()->price;
		$this->productName= $this->makeSize()->product->product_name;
	}
	

	protected function makeSize()
	{
		return Size::where([
			'unique_product_key'=> $this->unique_product_key 
			])
		    ->firstOrfail();

	}
	
	
	protected function hasStock()
	{
		return $this->stock>= $this->quantity? true: false;
	}

	protected function cartKeyExists($Key)
	{
		return array_key_exists($Key, session('cart'))? true: false;
	}

	
}