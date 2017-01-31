<?php
namespace App\Custom;

   trait cartTrait
   {
    /**
     * Hst as percentage of total. Upon inclusion in database, things to be modified.
     *
     * @var float
     */
   	public $percentHst= 0.13;
    /**
     * Shipping cost  Should be modified as required in future
     *
     * @var array
     */
   	public $shippingCost= 5.0;
  /**
   * Get the subtotal for an item
   *
   * @return float $subTotal
   */
   	
   	public function getSubtotal()
   	 {
   	 	$subTotal= 0;
   	 	
   	 	foreach ($this->makeCollection() as $product) {

   	 		$subTotal += $product['quantity']*$product['price'];
   	 	}
   	 	return $subTotal;
   	 } 
    /**
     * Get the total HST for an item.
     *
     * @return float
     */
   	 public function getHst()
   	 {
   	 	return $this->getSubtotal() * $this->percentHst;
   	 }
    /**
     * Get the Shipping Cost
     *
     * @return float
     */

     public function getShippingCost()
   	 {
   	 	return $this->shippingCost;
   	 }
    /**
     * Get the total of the cart
     *
     * @return float
     */
     public function getTotal()
   	 {
   	 	return $this->getSubtotal()+ $this->getHst() + $this->getShippingCost();
   	 }
    /**
     * Convert Session Array to Collection
     *
     * @return Collection
     */
   	 public function makeCollection()
   	 {
   	 	return collect(session('cart'));
   	 }
     /**
     * Update the cart , if user changes anything from the cart page.
     *
     * @param string $key  
     * @param int $qnt  
     * @return void
     */
   	 public function updateCart($key, $qnt)
   	 {
   	 	$item = session('cart');
   	 	$item[$key]['quantity']= $qnt;
   	 	$item[$key]['productSubTotal'] = $item[$key]['quantity'] * $item[$key]['price'];
   	 	session(['cart'=> $item]);
   	 }
    /**
     * Build dynamic data for different cart elements
     *
     * @return array
     */
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
   