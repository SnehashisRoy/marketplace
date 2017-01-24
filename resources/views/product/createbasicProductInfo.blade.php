@extends('layouts.app')

@section('content')
		
	<div class="container">
		<form method="POST" action="{{route('product.storeBasicProductInfo')}}">
		@include('product.partials.productForm',[
		'submit'=> "Crteate Product",
		'product_value'=> old('product_name'),
		'description_value'=> old('description'),
		'cat_value'=> old('cat')
		
		])
				
		</form>
	</div>

@stop