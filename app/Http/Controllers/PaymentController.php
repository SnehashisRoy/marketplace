<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_ClientToken;
use App\Custom\BraintreePayment;
//use Braintree_Transaction;
//use App\Custom\cartTrait;


class PaymentController extends Controller
{
    
   // use cartTrait;

    public function show()
    {
    	$data['clientToken'] = Braintree_ClientToken::generate();
    	return view('payment.form', $data);
    }

    public function checkOut(BraintreePayment $payment, Request $request)
    {
    	$result=$payment->createTransaction($request->payment_method_nonce);

    	$result->success ? $payment->registerTransaction($result->transaction->id);
                           : return redirect()->route('payment.show'); 
    	

    }
}
