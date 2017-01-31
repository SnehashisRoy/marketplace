<?php

namespace App\Custom;

use App\Custom\cartTrait;
use Braintree_Transaction;
use Order;



class BraintreePayment
{
	
	use cartTrait;
	/**
     * The payable amount.
     *
     * @var float
     */
	protected $total;
	/**
     * Set value to property $total.
     *
     * @return void
     */

	public function __construct()
	{
		$this->total = $this->getTotal();
	}
	/**
     * Create transaction with braintree.
     *
     * @param string $nonce 
     * @return Response
     */
	
	public function createTransaction($nonce)
	{
		if(!empty($nonce))
		{
			return Braintree_Transaction::sale([
				  'amount' => $this->total,
				  'paymentMethodNonce' => $nonce,
				  'options' => [
				    'submitForSettlement' => True
				  ]
				]);
		} 
	}

}