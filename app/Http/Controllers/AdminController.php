<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
   
    /**
     * Middleware role restricts access of admin pages.
     * String admin passed as a parameter to the Middleware.   
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    /**
     * Displays dashboard page.
     *
     * @return Response
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    /**
     * Create form to input basic product info.
     *
     * @return Response
     */

    public function createBasicProductInfo()
    {
    	$data['categories']= Category::all();
        return view('product.createbasicProductInfo', $data);
    }
    /**
     * Validate the post data and insert into products table
     *
     * @param  Request $request  
     * @return Response
     */
    public function storeBasicProductInfo( Request $request)
    {
    	//validate the post data
        $this->validate($request,[

    		'product_name'=> 'required',
    		'description'=> 'required',
            'category_id'=> 'required'

    		]);
        // create new product model instance
    	$product= new Product($request->all());
        //insert post data into the products along with related user_id.
        $request->user()->products()->save($product);
        return redirect()->to('admin/product/'.$product->product_name);

    }
    /**
     * Display the form to input details of the products
     *
     * @param  string $name  
     * @param  Product $product  
     * @return Response
     */
    public function createSizeDetail($name, Product $product)
    {
    	
    	$product= Product::where('product_name', $name)->firstorFail();
        $sizes=$product->sizes;
        $data['categories']= Category::all();
        $data['product']= $product;
        $data['sizes'] = $sizes;
              
    	return view('product.createSizeDetail', $data);
    }

    /**
     * Insert details of the product in product_size table 
     *
     * @param  Request $request  
     * @param  int $product_id  
     * @return Response
     */
    public function storeSizeDetail(Request $request, $product_id)
    {
       //validate the form data.
       // custom rule is in place to prevent duplicate value of size or color of a product with specific id.
        $this->validate($request, [
            'size'=> [
                    'required',
                     Rule::unique('product_size','size')->where('product_id', $product_id)
                     ],
            
            'price'=> 'required|alpha_num',
            'stock'=> 'required|alpha_num',
            'photo'=> 'required| mimes:jpg,jpeg,png'
            ]);
       
        // create Size model instance with the post data
        $size = Size::addSizeDetail($request->file('photo'), $request->size, $request->stock, $request->price,$product_id);
        // insert data in product_size table with related product_id.
        Product::makeProduct($product_id)->sizes()->save($size);
        return redirect()->back();
         
    }
    /**
     * Update the product details with or without image
     *
     * @param  User  
     * @return Response
     */
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
    /**
     * update basic product information.
     *
     * @return Response
     */
    public function updateProduct()
    {
        $data['products']=Product::all();
        return view('product.updateProduct', $data);
    }


}









