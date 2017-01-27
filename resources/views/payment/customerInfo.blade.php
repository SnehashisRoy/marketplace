@extends('layouts.app')

@section('content')
	<div class="container">
		<form method="POST" action="/customer">
		{{csrf_field()}}
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('name')? 'has-error': ""}}">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name"  value= "{{old('name')}}">
					@if($errors->has('name'))
						<div class="help-block">{{$errors->first('name')}}</div>
					@endif
				</div>
				<div class="form-group {{ $errors->has('email')? 'has-error': ""}}">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email"  value= "{{old('email')}}">
					@if($errors->has('email'))
						<div class="help-block">{{$errors->first('email')}}</div>
					@endif
				</div>
				<h3>Address</h3>
		 		<div class="form-group {{ $errors->has('street')? 'has-error': ""}}">
		 			<label for="street">Street:</label>
		 			<input type="text" class="form-control" id="street" name="street"  value= "{{old('street')}}">
		 			@if($errors->has('street'))
		 				<div class="help-block">{{$errors->first('street')}}</div>
		 			@endif
		 		</div>

		 		<div class="form-group {{ $errors->has('apt')? 'has-error': ""}}">
		 			<label for="apt">Apartment:</label>
		 			<input type="text" class="form-control" id="apt" name="apt"  value= "{{old('apt')}}">
		 			@if($errors->has('apt'))
		 				<div class="help-block">{{$errors->first('apt')}}</div>
		 			@endif
		 		</div>
		 	
		 	
				
			</div>
			<div class="col-md-6">
					<div class="form-group {{ $errors->has('city')? 'has-error': ""}}">
		 			<label for="city">City:</label>
		 			<input type="text" class="form-control" id="city" name="city"  value= "{{old('city')}}">
		 			@if($errors->has('city'))
		 				<div class="help-block">{{$errors->first('city')}}</div>
		 			@endif
		 		</div>
		 		<div class="form-group {{ $errors->has('state')? 'has-error': ""}}">
		 			<label for="state">State:</label>
		 			<input type="text" class="form-control" id="state" name="state"  value= "{{old('state')}}">
		 			@if($errors->has('state'))
		 				<div class="help-block">{{$errors->first('state')}}</div>
		 			@endif
		 		</div>
		 		<div class="form-group {{ $errors->has('zip')? 'has-error': ""}}">
		 			<label for="zip">Zip:</label>
		 			<input type="text" class="form-control" id="zip" name="zip"  value= "{{old('zip')}}">
		 			@if($errors->has('zip'))
		 				<div class="help-block">{{$errors->first('zip')}}</div>
		 			@endif
		 		</div>
		 		<div class="form-group {{ $errors->has('country')? 'has-error': ""}}">
		 			<label for="country">Country:</label>
		 			<input type="text" class="form-control" id="country" name="country"  value= "{{old('country')}}">
		 			@if($errors->has('country'))
		 				<div class="help-block">{{$errors->first('country')}}</div>
		 			@endif
		 		</div>
			</div>
			<button type="submit" class="btn btn-success"> Submit</button> 
		</form>
	</div>
	 		
	 		



@stop