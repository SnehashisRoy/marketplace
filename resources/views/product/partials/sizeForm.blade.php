                       {{csrf_field()}}
		 				<div class="form-group {{ $errors->has('size')? 'has-error': ""}}">
			 			    <label for="size">Size</label>
			 			    <input type="text" class="form-control" id="size" name="size"  value= "{{$size_value}}">
			 			    @if($errors->has('size'))
			 		        	<div class="help-block">{{$errors->first('size')}}</div>
			 		        @endif
		 			   </div>
	 			
	 		   		<div class="form-group {{ $errors->has('price')? 'has-error': ""}}">
	 		   			<label for="price">Price:</label>
	 		   			<input type="text" class="form-control" id="price" name="price"  value= "{{$price_value}}">
	 		   			@if($errors->has('price'))
	 		   				<div class="help-block">{{$errors->first('price')}}</div>
	 		   			@endif
	 		   		</div>
	 		   		<div class="form-group {{ $errors->has('stock')? 'has-error': ""}}">
	 		   			<label for="stock">Stock:</label>
	 		   			<input type="text" class="form-control" id="stock" name="stock"  value= "{{$stock_value}}">
	 		   			@if($errors->has('stock'))
	 		   				<div class="help-block">{{$errors->first('stock')}}</div>
	 		   			@endif
	 		   		</div>
	 		   		<div class="form-group {{ $errors->has('photo')? 'has-error': ""}}">
			 		    <label for="photo">Image:</label>
			 		    <input type="file" id="photo" name="photo" value= "{{old('photo')}}>
			 		    <p class="help-block">Put the image</p>
			 		    @if($errors->has('photo'))
	 		   				<div class="help-block">{{$errors->first('photo')}}</div>
	 		   			@endif
			 		</div>

			 		<button type="submit" class="btn btn-success">{{$submit}}</button>
	