<?php

namespace App\Http\Controllers;

use App\Product;
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
    	return view('product.createbasicProductInfo');
    }

    public function storeBasicProductInfo( Request $request)
    {
    	$this->validate($request,[

    		'product_name'=> 'required',
    		'description'=> 'required',
            'type'=> 'required',

    		]);
    	$product= new Product($request->all());
        $request->user()->products()->save($product);
        return redirect()->to('admin/product/'.$product->product_name);

    }
    public function createSizeDetail($name, Product $product)
    {
    	
    	$product= Product::where('product_name', $name)->firstorFail();
        $sizes=$product->sizes;
       	$data['product']= $product;
        $data['sizes'] = $sizes;
       
    	return view('product.createSizeDetail', $data);
    }

    public function storeSizeDetail(Request $request, $name, $id)
    {
        $this->validate($request, [
            'size'=> [
                    'required',
                     Rule::unique('product_size','size')->where('product_id', $id)
                     ],
            
            'price'=> 'required|alpha_num',
            'stock'=> 'required|alpha_num',
            'photo'=> 'required| mimes:jpg,jpeg,png'
            ]);
       

        $size = Size::addSizeDetail($request->file('photo'), $request->size, $request->stock, $request->price,$id);
        Product::makeProduct($name)->sizes()->save($size);
        return redirect()->back();
         //before refactoring...
        //$file= $request->file('photo');
        //$photoName = time().$file->getClientOriginalName();
        //$file->move('image/product', $photoName);
        /* Product::where('product_name', $name)->firstOrfali()->sizes()->create([
                'size'=> $request->size,
                'image'=>$photoName,
                'price'=>$request->price,
                'stock'=> $request->stock

            ]);*/
   
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








    public function createWithSizes()
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
}









