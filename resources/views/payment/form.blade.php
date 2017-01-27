

@extends('layouts.app')

@section('content')
<div class="container">
	<form id="checkout" method="post" action="/checkout">
	{{csrf_field()}}
	<div class="col-md-6">
		<h5>Please check the information carefully before placing order</h5>
		<h4>Sipping Address:</h4>
		<p>{!! $address !!}</p>
		<h4>E-mail:</h4>
		<p>{{session('customer')['email']}}</p>
	</div>
	<div class="col-md-6">
	  <div id="payment-form"></div>
	  <input type="submit" value="Place Order">
	</div>
	</form>
</div>



@stop

@section('js')
	<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
	<script>
	var clientToken = "{{$clientToken}}";

	braintree.setup(clientToken, "dropin", {
	  container: "payment-form"
	});
	</script>

@stop