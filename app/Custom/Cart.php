<?php

namespace App\Custom;


 use App\Size;
 use App\Product;
 use Illuminate\Http\Request;



class Cart

{
	
	
	protected $quantity;
	protected $product_id;
	protected $sizeOrColor;
	protected $image;
	protected $productName;
	protected $price;
	protected $stock;
	protected $cartKey;

	public function __construct($quantity, $product_id, $sizeOrColor = null)
	{
		$this->quantity = $quantity;
		$this->product_id = $product_id;
		$this->sizeOrColor = $sizeOrColor;
	}

	
	public function addItem()
	{
		$this->setCartProperties();
		$data= array($this->cartKey=>[
								'image'=> $this->image,
								'productName'=> $this->productName,
								'stock'=>$this->stock,
								'price'=> $this->price,
								'quantity'=> $this->quantity,
								'key'=> $this->cartKey,
								'productSubTotal'=> $this->quantity * $this->price
								]);
		
			if(session('cart')== null)
			{
			session( ['cart'=> $data]);
			}else
			{
				if ($this->cartKeyExists($this->cartKey))
			{
				$item = session('cart');
				
				$item[$this->cartKey]['quantity'] = $item[$this->cartKey]['quantity'] + 1;

				session(['cart'=> $item]);
			}else
			{
				$result= session('cart')+ $data;
				session(['cart'=>$result]);

			}
			}

    
	}

	public function updateCart( $Key, $qnt)
   	 {
   	 	$item = session('cart');
   	 	$item[$key]['quantity']= $item[$key][$qnt];
   	 	$item[$key]['productSubTotal'] = $item[$key]['quantity'] * $item[$key]['price'];
   	 	session(['cart'=> $item]);
   	 }


	protected function setCartProperties()
	{
		$this->image= $this->makeSize()->image;
		$this->stock = $this->makeSize()->stock;
		$this->price = $this->makeSize()->price;
		$this->productName= $this->makeProduct()->product_name;
		$this->cartKey = $this->generateCartKey();
	}
	

	protected function makeSize()
	{
		return Size::where([
			'size'=> $this->sizeOrColor, 
			'product_id'=> $this->product_id
			])
		    ->firstOrfail();

	}
	protected function makeProduct()
	{
		return Product::where('id', $this->product_id)->firstOrfail();
	}
	protected function generateCartKey()
	{
		return $this->sizeOrColor !== null ? $this->product_id. $this->sizeOrColor : $this->product_id;
	}
	protected function hasStock()
	{
		return $this->stock>= $this->quantity? true: false;
	}

	protected function cartKeyExists($cartKey)
	{
		return array_key_exists($cartKey, session('cart'))? true: false;
	}

	
}