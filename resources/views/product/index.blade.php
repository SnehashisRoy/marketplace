@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@foreach($products as $product)
			
				<div class="col-md-4">
					<div class="row">
					@if( $size->where('product_id', $product->id)->first()!==null)
						<div class="col-md-6">
							<img class="img-responsive" src="/image/product/{{$product->sizes()->firstOrfail()->image}}">
						</div>
					</div>
					<h3>{{$product->product_name}}</h3>
					
						<p style="display:inline-block;"><strong>Sizes:</strong></p>
						@foreach($product->sizes as $size)
							<p style="display:inline-block;">{{$size->size}},</p>
						@endforeach
						<h3>${{$product->sizes()->first()->price}}</h3>
					

					<a class="btn btn-primary" href="{{route('product.show',[$product->product_name])}}" role="button">Add To Cart</a>
					@endif
				</div>

			@endforeach
			
		</div>
	</div>

@stop