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


class PaymentController extends Controller
{
    
    use cartTrait;
    /**
    * Display the form to input customer information
    *
    * @return Response
    */   
    public function customerInfo()
    {
        return view('payment.customerInfo');
    }
    /**
     * Put customer information into session.
     *
     * @param Request $request 
     * @return Response
     */
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
        
    }
   /**
   * Show  the shipping address and payment form 
   *
   * @return Response
   */  

    public function show()
    {
    	$data['address']= $this->ShippingAddressFromSession();
        $data['clientToken'] = Braintree_ClientToken::generate();
    	return view('payment.form', $data);
    }
    /**
     * Get all of the tasks for a given user.
     *
     * @param BraintreePayment $payment  
     * @return void| Response
     */
    public function checkOut(BraintreePayment $payment, Request $request)
    {
    	$result=$payment->createTransaction($request->payment_method_nonce);

    	if($result->success)
        {
            $customer= $this->insertCustomerData();
            $order= $this->insertIntoOrderTable($result->transaction->id, $customer);
            $this->insertCartItemAndUpdateStock($order);
            $this->unsetCartSession();
        }else
        {
            return redirect()->route('payment.show');
        }
     
    }
    /**
     * Create Shipping Address from customer data stored in session
     *
     * @return string
     */
    protected function ShippingAddressFromSession()
    {
        $item= session('customer');
        $address = $item['name'].'<br>'
                  .$item['apt'].'-'.$item['street'].'<br>'
                  . $item['city'].','.$item['zip'].'<br>'
                  . $item['country'].'<br>';
        return $address;
        
        
    }
    /**
     * Insert or update with customer data stored in session into customer table
     *
     * @return Customer $customer
     */    
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
    /**
     * Insert related data into order table after successful transaction
     *
     * @param Customer $customer  
     * @return Order $order
     */
    protected function insertIntoOrderTable($transaction_id, $customer)
    {
        $order=Order::addOrderDetail($transaction_id, $this->getTotal());
        $order =$customer->orders()->save($order);
        return $order;
    }
    /**
     * Insert cart item and the quantity and update the stock
     *
     * @param  
     * @return Response
     */
    protected function insertCartItemAndUpdateStock($order)
    {
        foreach(session('cart') as $product)
        {
            // create a cart model instance with unique product key and quantity.
            $cart = Cart::addCartItemDetail($product['key'],$product['quantity']);
            // insert cart item with associated order_id.
            $order->cartItems()->save($cart);
            //create Size model instance
            $size=Size::where('unique_product_key', $product['key'])->firstOrfail();
            //update the stock
            $size->stock -= $product['quantity'];
            $size->save();
        }
    }
    /**
     * Destroy the session.
     *
     * @return void
     */
    protected function unsetCartSession()
    {
        session()->forget('cart');
    }



}






