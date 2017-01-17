@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" action="{{route('product.storeWithSizes')}}">
			{{csrf_field()}}
			<div class="form-group {{$errors ->has('product_name')? 'has-error': ""}}">
				<label for="product_name">Product Name:</label>
				<input type="text" class="form-control" id="product_name" name="product_name"  value= "{{old('product_name')}}">
				@if($errors->has('product_name'))
					<div class="help-block">{{$errors->first('product_name')}}</div>
				@endif
			</div>
			<div class="form-group {{$errors->has('description')? 'has-error': ""}}">
				<label for="description">Description:</label>
				<textarea type="text" class="form-control" id="description" name="description" rows ="10" value="{{old('description')}}">
				</textarea> 
				@if($errors->has('description'))
					<div class="help-block">{{$errors->first('description')}}</div>
				@endif 
			</div>
			<div class="form-group">
	 			    <label for="type">Type of Product:</label>
	 			    <select type="text" class="form-control" id="type" name="type">
	 			    	<option>sizes</option>
	 			    	<option>colors</option>
	 			    	<option>plain</option>
	 			    </select>
	 		</div>

			<div class="form-group {{ $errors->has('size')? 'has-error': ""}}">
			    <label for="size">Size</label>
			    <select type="text" class="form-control" id="size" name="size">
			    	<option>1</option>
			    	<option>2</option>
			    	<option>3</option>
			    </select>
			    @if($errors->has('size'))
		        	<div class="help-block">{{$errors->first('size')}}</div>
		        @endif
		   </div>
	 	
	   		<div class="form-group {{ $errors->has('price')? 'has-error': ""}}">
	   			<label for="price">Price:</label>
	   			<input type="text" class="form-control" id="price" name="price"  value= "{{old('price')}}">
	   			@if($errors->has('price'))
	   				<div class="help-block">{{$errors->first('price')}}</div>
	   			@endif
	   		</div>
	   		<div class="form-group {{ $errors->has('stock')? 'has-error': ""}}">
	   			<label for="stock">Stock:</label>
	   			<input type="text" class="form-control" id="stock" name="stock"  value= "{{old('stock')}}">
	   			@if($errors->has('stock'))
	   				<div class="help-block">{{$errors->first('stock')}}</div>
	   			@endif
	   		</div>
		
			<div class="form-group {{ $errors->has('photo')? 'has-error': ""}}">
			    <label for="photo">Image:</label>
			    <input type="file" id="photo" name="photo">
			        @if($errors->has('photo'))
						<div class="help-block">{{$errors->first('photo')}}</div>
					@endif
			</div>
			<button type="submit" class="btn btn-success">Submit</button>

	</form>
</div>
@stop