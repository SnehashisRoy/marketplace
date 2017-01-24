<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function createBasicProductInfo()
    {
    	$data['categories']= Category::all();
        return view('product.createbasicProductInfo', $data);
    }

    public function storeBasicProductInfo( Request $request)
    {
    	$this->validate($request,[

    		'product_name'=> 'required',
    		'description'=> 'required',
            'category_id'=> 'required'

    		]);
    	$product= new Product($request->all());
        $request->user()->products()->save($product);
        return redirect()->to('admin/product/'.$product->product_name);

    }
    public function createSizeDetail($name, Product $product)
    {
    	
    	$product= Product::where('product_name', $name)->firstorFail();
        $sizes=$product->sizes;
        $data['categories']= Category::all();
        $data['product']= $product;
        $data['sizes'] = $sizes;
              
    	return view('product.createSizeDetail', $data);
    }

    public function storeSizeDetail(Request $request, $product_id)
    {
        $this->validate($request, [
            'size'=> [
                    'required',
                     Rule::unique('product_size','size')->where('product_id', $product_id)
                     ],
            
            'price'=> 'required|alpha_num',
            'stock'=> 'required|alpha_num',
            'photo'=> 'required| mimes:jpg,jpeg,png'
            ]);
       

        $size = Size::addSizeDetail($request->file('photo'), $request->size, $request->stock, $request->price,$product_id);
        Product::makeProduct($product_id)->sizes()->save($size);
        return redirect()->back();
         
    }
    public function updateSizeDetail(Request $request, $size_id)
    {
        $this->validate($request,[
            'price'=> 'required|numeric',
            'size'=> 'required|alpha_num',
            'stock'=>'required|numeric',
            'photo'=>'mimes:jpg,jpeg,png'
            ]);
        if($request->file('photo')!== null)
        {
            Size::find($size_id)->updateSizeWithImage( $request->file('photo'), $request->size, $request->stock, $request->price);
        }else{
            Size::find($size_id)->updateSizeDetail($request->size, $request->stock, $request->price);   
        }
        
        return redirect()->back();
        

    }

    public function updateProduct()
    {
        $data['products']=Product::all();
        return view('product.updateProduct', $data);
    }








    /*public function createWithSizes()
    {
        return view('product.createWithsizes');
    }

    public function StoreWithSizes(Request $request)
    {
        $this->validate($request,[

            'product_name'=> 'required',
            'description'=> 'required',
            'type'=> 'required',
            'size'=> 'required|alpha_num',
            'price'=> 'required|alpha_num',
            'stock'=> 'required|alpha_num',
            'photo'=> 'required| mimes:jpg,jpeg,png'
             ]);
        $product=$request->user()->products()->create([
            'product_name'=> $request->product_name,
            'description'=> $request->description,
            'type'=> $request->type

            ]);
        $size = Size::addSizeDetail($request->file('photo'), $request->size, $request->stock, $request->price);
        $product->sizes()->save($size);
    }
    */
}









