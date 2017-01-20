<?php

namespace App\Custom;

use App\Custom\cartTrait;
use Braintree_Transaction;



class BraintreePayment
{
	
	use cartTrait;

	protected $total;

	public function __construct()
	{
		$this->total = $this->getTotal();
	}

	
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