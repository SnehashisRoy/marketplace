				{{csrf_field()}}
				<div class="form-group {{$errors ->has('product_name')? 'has-error': ""}}">
					<label for="product_name">Product Name:</label>
					<input type="text" class="form-control" id="product_name" name="product_name"  value= "{{$product_value}}">
					@if($errors->has('product_name'))
						<div class="help-block">{{$errors->first('product_name')}}</div>
					@endif
				</div>
				<div class="form-group {{$errors->has('description')? 'has-error': ""}}">
					<label for="description">Description:</label>
					<textarea type="text" class="form-control" id="description" name="description" rows ="10">
						{{$description_value}}
					</textarea> 
					@if($errors->has('description'))
						<div class="help-block">{{$errors->first('description')}}</div>
					@endif 
				</div>
				<div class="form-group">
		 			    <label for="type">Type of Product:</label>
		 			    <select type="text" class="form-control" id="type" name="type" value={{$type_value}}>
		 			    	<option @if($type_value == 'sizes') selected='selected' @endif>sizes</option>
		 			    	<option @if($type_value == 'colors') selected='selected' @endif>colors</option>
		 			    	<option @if($type_value == 'plain') selected='selected' @endif>plain</option>
		 			    </select>
		 		</div>
				<button type="submit" class="btn btn-success">{{$submit}}</button>
