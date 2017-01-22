@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>{{$product->product_name}}</h2>
				<p>{{$product->description}}</p>
			</div>
			<div class="col-md-6">
				<img id="img" class="img-responsive" src="/image/product/{{$product->sizes()->firstOrfail()->image}}">
			<div class="col-md-4">
				<form method="POST" action="{{route('product.addItem')}}">
					{{csrf_field()}}
					<div class="form-group">
			 			    <label for="sizeOrColor">Size</label>
			 			    <select type="text" class="form-control" id="sizeOrColor" name="sizeOrColor" onchange="updateSizeDetail();">
			 			    	@foreach($product->sizes as $size)
			 			    		<option value="{{$size->unique_product_key}}">{{$size->size}}</option>
			 			    	@endforeach
			 			    </select>
			 		</div>
			 		<div class="form-group">
			 			    <label for="qnt">Quantity</label>
			 			    <select type="text" class="form-control" id="qnt" name="qnt">
			 			    	<option value="1">1</option>
			 			    	<option value="2">2</option>
			 			    	<option value="3">3</option>
			 			    	<option value="4">4</option>
			 			    	<option value="5">5</option>

			 			    </select>
			 		</div>
					<button type="submit" class="btn btn-success">Add To Cart</button>
				</form>
			</div>
			<h3 id='price'>$ {{$product->sizes()->firstOrfail()->price}}</h3>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function updateSizeDetail(){
		var siz = $('#sizeOrColor').val();
					
		$.ajax({
			url: "/products/productAjax",
			type: "POST",
			data: 'size='+ siz,
			dataType: "json",
			success: function(data, status, http){
				console.log(data);
				$('#img').attr('src', '/image/product/'+data.imageUrl);
				$('#price').html('$'+data.price);
			},
			error: function () {alert("Problem in sending reply!")}
			});
	}
	</script>
	
@stop







