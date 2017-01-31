@extends('layouts.app')
<!--Table to host the cart-->
@section('content')
		
			<div class="container">
				<div class="row">
	                <div class="col-md-9">                               
					   <table class="table">
					     <thead>
					       <tr>
					         <th>Product</th>
					         <th>Image</th>
					         <th>Quantity</th>
					         <th>Price</th>
					         <th> Remove </th>
					         
					       </tr>
					     </thead>
					  	@foreach ($products as $product)

					     <tbody>
					       <tr>
					       	 <td>{{ $product['productName']}}</td>
					         <td><img class="img-thumbnail" src="/image/product/{{$product['image']}}" style="max-width: 100px; "></td>
					         <td>
					         	<input id="{{ $product['key']}}" name="quantity" 
					         	value="{{$product['quantity']}}" onBlur="saveCart(this);">
					         </td>
					         <td id="productTotal{{$product['key']}}"> {{$product['productSubTotal']}} </td>
					         <td> <a href="#">remove the item</a></td>
					       </tr>
					     </tbody>
					    @endforeach
					 </table>
					</div>
					<div class="col-md-3">
						<h2> Cart Summary</h2>
						Subtotal:<h3 id="subTotal">{{$subTotal}}</h3>
						HST:<h3 id="hst">{{$hst}}</h3>
						Shipping Cost:<h3 id= 'shippingCost'>{{$shippingCost}}</h3>
						Total: <h2 id="total">{{$total}}</h2>
						
						
					</div>	
				</div>
			</div>
@stop

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function saveCart(obj)
	{
		var qnt = $(obj).val();
		var key = $(obj).attr('id');
		$.ajax({
			url: "/cart/cartAjax",
			type: "POST",
			data: 'key='+key+'&qnt='+qnt,
			dataType: "json",
			success: function(data, status, http){
				console.log(data);
				$('#subTotal').html('$'+ data.subTotal);
				$('#hst').html('$'+ data.hst);
				$('#shippingCost').html('$'+ data.shippingCost);
				$('#total').html('$'+ data.total);
				$.each(data.products, function(index, item){
					$('#productTotal'+item.key).html('$'+item.productSubTotal);
				});
				
			},
			error: function () {alert("Problem in sending reply!")}
			});
	}
	</script>


@stop
