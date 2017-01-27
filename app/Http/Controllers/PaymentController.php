<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_ClientToken;
use App\Custom\BraintreePayment;
use App\Customer;
use App\Order;
use App\Cart;
use App\Size;
use App\Custom\cartTrait;
//use Braintree_Transaction;
//use App\Custom\cartTrait;


class PaymentController extends Controller
{
    
    use cartTrait;
    
    public function customerInfo()
    {
        return view('payment.customerInfo');
    }

    public function customerInfoIntoSession(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|string',
            'email'=> 'required|email',
            'street'=> 'required|string',
            'apt'=> 'alpha_num',
            'city'=> 'required|alpha',
            'state'=> 'required|alpha',
            'zip'=> 'required|alpha_num',
            'country'=> 'required|alpha', 
            ]);
        $data = $request->except(['_token']);
        session(['customer'=> $data]);
        var_dump(session('customer'));
    }
   

    public function show()
    {
    	$data['address']= $this->ShippingAddressFromSession();
        $data['clientToken'] = Braintree_ClientToken::generate();
    	return view('payment.form', $data);
    }
    
    public function checkOut(BraintreePayment $payment, Request $request)
    {
    	$result=$payment->createTransaction($request->payment_method_nonce);

    	if($result->success)
        {
            $this->registerTransaction($result->transaction->id);
        }else
        {
            return redirect()->route('payment.show');
        }
                            
    	

    }

    protected function ShippingAddressFromSession()
    {
        $item= session('customer');
        $address = $item['name'].'<br>'
                  .$item['apt'].'-'.$item['street'].'<br>'
                  . $item['city'].','.$item['zip'].'<br>'
                  . $item['country'].'<br>';
        return $address;
        
        
    }
    protected function registerTransaction($transaction_id)
    {
        $customer= $this->insertCustomerData();
        $order= $this->insertIntoOrderTable($transaction_id, $customer);
        $this->insertCartItemAndUpdateStock($order);
        $this->unsetCartSession();

    }

    protected function insertCustomerData()
    {
        $item= session('customer');

        $customer=Customer::updateOrCreate(
            ['email'=> $item['email']],
            [ 'name'=> $item['name'],
             'street'=> $item['street'],
             'apt'=> $item['apt'],
             'city'=> $item['city'],
              'state'=> $item['state'],
              'zip'=> $item['zip'],
             'country'=> $item['country'],
             ]
            );
        return $customer;
    }

    protected function insertIntoOrderTable($transaction_id, $customer)
    {
        $order=Order::addOrderDetail($transaction_id, $this->getTotal());
        $order =$customer->orders()->save($order);
        return $order;
    }

    protected function insertCartItemAndUpdateStock($order)
    {
        foreach(session('cart') as $product)
        {

            $cart = Cart::addCartItemDetail($product['key'],$product['quantity']);
            $order->cartItems()->save($cart);
            $size=Size::where('unique_product_key', $product['key'])->firstOrfail();
            $size->stock -= $product['quantity'];
            $size->save();
        }
    }

    protected function unsetCartSession()
    {
        session()->forget('cart');
    }



}






