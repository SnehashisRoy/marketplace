@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			 <div class="col-md-4">
				 <form>
			  	@include('product.partials.productForm',[
						'submit'=> "Update",
						'product_value'=> $product->product_name,
						'description_value'=> $product->description,
						'cat_value'=> $product->category->id
						])
				</form>
				
			 </div>
			<div class="col-md-8">
			
			@if($sizes)

				@foreach($sizes as $size)
					<form method="POST" action="{{route('product.updateSizeDetail', [$size->id]) }}" enctype="multipart/form-data"class ="form-inline">
						{{ method_field('PATCH') }}
					   	@include('product.partials.sizeForm',[
					   			'submit'=> 'Update',
					   			'price_value' => $size->price,
					   			'stock_value' => $size->stock,
					   			'size_value' => $size->size,
					   			'size'=> 'size'
					   	])
					</form>
					<form method="POST" action="#">
						{{csrf_field()}}
						<input type="submit" value="Delete" class="btn btn-danger">
						
					</form>
					<hr>

				@endforeach
			@endif
			</div> 
			

			 <div class="col-md-12" style="margin-top: 50px">
				<h3> Create New Size of the Product</h3>
				   	<form method="POST" action="{{route('product.storeSizeDetail', [$product->id]) }}" enctype="multipart/form-data"class ="form-inline">
				     	@include('product.partials.sizeForm',[
				   		'submit'=> 'Create Size Detail',
				   		'price_value' => old('price'),
				   		'stock_value' => old('stock'),
				   		'size_value'  => old('size'),
				   		'size'=> 'createSize'
				   	])
					 			 		
				 	</form>
			 	
			 </div>
		</div>
	</div>
	
@stop