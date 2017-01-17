<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('admin/product/createWithSizes', 'AdminController@createWithSizes')->name('product.createWithsizes');
Route::post('admin/prodductWithSize', 'AdminController@storeWithSizes')->name('product.storeWithSizes');

Route::get('/home', 'HomeController@index');
Route::get('admin/product/create', 'AdminController@createBasicProductInfo')->name('product.createBasicProductInfo');
Route::post('admin/product', 'AdminController@storeBasicProductInfo')->name('product.storeBasicProductInfo');
Route::get('admin/product/{name}', 'AdminController@createSizeDetail')->name('product.createSizeDetail');
Route::post('admin/product/{name}/{id}', 'AdminController@storeSizeDetail')->name('product.storeSizeDetail');
Route::patch('admin/product/{size_id}', 'AdminController@updateSizeDetail')->name('product.updateSizeDetail');

Route::get('products', 'ProductController@index')->name('product.index');
Route::get('products/{name}', 'ProductController@show')->name('product.show');
Route::post('products/productAjax', 'ProductController@productAjax')->name('product.ajax');
Route::post('products/addItem/{product_id}', 'ProductController@addItem')->name('product.addItem');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart/cartAjax', 'CartController@cartAjax')->name('cart.ajax');








