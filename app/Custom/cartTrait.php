<?php
namespace App\Custom;

   trait cartTrait
   {
   	public $percentHst= 0.13;
   	public $shippingCost= 5.0;

   	
   	public function getSubtotal()
   	 {
   	 	$subTotal= 0;
   	 	
   	 	foreach ($this->makeCollection() as $product) {

   	 		$subTotal += $product['quantity']*$product['price'];
   	 	}
   	 	return $subTotal;
   	 } 

   	 public function getHst()
   	 {
   	 	return $this->getSubtotal() * $this->percentHst;
   	 }
   	 
     public function getShippingCost()
   	 {
   	 	return $this->shippingCost;
   	 }
   	 public function getTotal()
   	 {
   	 	return $this->getSubtotal()+ $this->getHst() + $this->getShippingCost();
   	 }

   	 public function makeCollection()
   	 {
   	 	return collect(session('cart'));
   	 }

   	 public function updateCart($key, $qnt)
   	 {
   	 	$item = session('cart');
   	 	$item[$key]['quantity']= $qnt;
   	 	$item[$key]['productSubTotal'] = $item[$key]['quantity'] * $item[$key]['price'];
   	 	session(['cart'=> $item]);
   	 }

   	 public function buildCartElements()
   	 {
   	 	$data['products']= $this->makeCollection();
    	$data['subTotal']= $this->getSubtotal();
    	$data['hst'] = $this->getHst();
    	$data['shippingCost']= $this->getShippingCost();
    	$data['total']= $this->getTotal();
    	return $data;
   	 }


   }
   