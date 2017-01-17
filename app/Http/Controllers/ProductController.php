<?php

namespace App\Http\Controllers;

use App\Product;
use App\Size;
use Illuminate\Http\Request;
use App\Custom\Cart;

class ProductController extends Controller
{
    public function index()
    {
    	$data['products']= Product::all();
        $data['size'] = new Size;
    	return view('product.index', $data);
    }
    public function show($name)
    {
    	$product=Product::where('product_name', $name)->firstOrfail();
    	$data['product']=$product;

    	return view('product.show', $data);
    }

    public function productAjax(Request $request)
    {
    	$size=Size::where(['size'=> $request->size, 'product_id'=> $request->product])->firstOrfail();
        $data= [
    		'imageUrl'=>$size->image,
    		'price'=> $size->price
    	];
    	return json_encode($data);

    }

    public function addItem(Request $request, $product_id)
    {
        (new Cart($request->qnt, $product_id, $request->sizeOrColor))->addItem();

        var_dump(session('cart'));
    }
}




