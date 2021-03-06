<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Custom\cartTrait;
use App\Custom\Cart;
use Braintree_ClientToken;


class CartController extends Controller
{
    use cartTrait;
    /**
     * Display all the products added to the cart.
     *
     * @return Response
     */
    public function index()
    {
    	$data = $this->buildCartElements();
    	return view('cart.index', $data);
    } 
    /**
     * Provides the datat to the ajax call.
     *
     * @param  Request $request
     * @return Response
     */
    public function cartAjax(Request $request)
    {
    	$this->updateCart($request->key, $request->qnt);
    	$data = $this->buildCartElements();
    	return json_encode($data);
    }

        
}
