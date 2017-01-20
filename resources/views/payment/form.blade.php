

@extends('layouts.app')

@section('content')
<div class="container">
	<form id="checkout" method="post" action="/checkout">
	{{csrf_field()}}
	  <div id="payment-form"></div>
	  <input type="submit" value="Pay $10">
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