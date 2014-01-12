<div class="well">
	<form action="add_client" method="post" role="form">
		<label for="first_name">Fist Name: </label>
		<input class="form-control" type="text" name="first_name" id="first_name"  />
		
		<label for="last_name">Last Name: </label>
		<input class="form-control" type="text" name="last_name" id="last_name"  />
		
		<label for="username">Username: </label>
		<input class="form-control" type="text" name="username" id="username"  />
		
		<label for="password">Password: </label>
		<input class="form-control" type="password" name="password" id="password"  />
		
		<label for="address">Address: </label>
		<input class="form-control" type="text" name="address" id="address"  />
		
		<label for="email">Email: </label>
		<input class="form-control" type="text" name="email" id="email"  />
		
		<label for="contact_no">Contact No: </label>
		<input class="form-control" type="text" name="contact_no" id="contact_no"  />
		
		<label for="date_created">Date Created: </label>
		<input class="form-control" type="datetime" name="date_created" id="date_created"  />
		
		<label for="date_modified">Date Modified: </label>
		<input class="form-control" type="datetime" name="date_modified" id="date_modified"  />
		
		<label for="photo">Photo: </label>
		<input type="file" id="photo" /><br />
		
		<input style="width: 100%" type="submit" class="btn btn-primary" name="contactSubmit" value="Add Client" />
	</form>
</div>