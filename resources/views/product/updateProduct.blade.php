@extends('layouts.app')

@section('content')
<div class="container">
 @foreach($products as $product)
 	 <a href="{{route('product.createSizeDetail',[$product->product_name])}}">{{$product->product_name}}</a><br>
 @endforeach
 </div>

@stop