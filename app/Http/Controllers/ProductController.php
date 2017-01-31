<?php

namespace App\Http\Controllers;

use App\Product;
use App\Size;
use Illuminate\Http\Request;
use App\Custom\Cart;

class ProductController extends Controller
{

    /**
     * Get all the products
     *
     * @return Response
     */
    public function index()
    {
    	$data['products']= Product::all();
        $data['size'] = new Size;
    	return view('product.index', $data);
    }
    /**
     * Showa an individual product
     *
     * @param  string $name
     * @return Response
     */
    public function show($name)
    {
    	$product=Product::where('product_name', $name)->firstOrfail();
    	$data['product']=$product;

    	return view('product.show', $data);
    }
    /**
     * Provides json data upon ajax call.
     */

    public function productAjax(Request $request)
    {
    	$size=Size::where('unique_product_key', $request->size)->firstOrfail();
        $data= [
    		'imageUrl'=>$size->image,
    		'price'=> $size->price
    	];
    	return json_encode($data);

    }
    /**
     * Add item to cart
     *
     * @param Request $request  
     * @return void
     */
    public function addItem(Request $request)
    {
        
        (new Cart($request->qnt, $request->sizeOrColor))->addItem();

    }
}




