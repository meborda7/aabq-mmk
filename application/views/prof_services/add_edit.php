<div class="well">
	<form action="add_prof_service" method="post" role="form">
		<label for="name">Service Name: </label>
		<input class="form-control" type="text" name="name" id="name"  />
		
		<label for="description">Description: </label>
		<textarea class="form-control" rows="5" name="description" id="description"></textarea>
		
		<label for="price">Price: </label>
		<input class="form-control" type="text" name="price" id="price"  />
		
		<label for="remarks">Remarks: </label>
		<textarea class="form-control" rows="5" name="remarks" id="remarks"></textarea>
		
		<label for="discount">Discount: </label>
		<input class="form-control" type="text" name="discount" id="discount"  />
		
		<label for="sla">Service-Level Agreement: </label>
		<input class="form-control" type="text" name="sla" id="sla"  /><br />
		
		<input style="width: 100%" type="submit" class="btn btn-primary" name="contactSubmit" value="Add Service" />
	</form>
</div>