<div class="well">
	<?php
		$id            = "";
		$first_name    = "";
		$last_name     = "";
		$username      = "";
		$password      = "";
		$address       = "";
		$email         = "";
		$contact_no    = "";
		$date_created  = "";
		// $date_modified = "";
		$photo         = "";
		$btnSubmitStr  = "Add Client";
		$formAction    = base_url() . "client/register";

		// if client_data is set, meaning this is an update operation..
		if (isset($client_data)) {
			$results = json_decode($client_data, true);

			foreach($results['result'] as $row) {
				$id            = $row[ID];
				$first_name    = $row[FNAME];
				$last_name     = $row[LNAME];
				$username      = $row[UNAME];
				$password      = $row[PWD];
				$address       = $row[ADDRESS];
				$email         = $row[EMAIL];
				$contact_no    = $row[CONTACT];
				$photo         = $row[PHOTO];
				$date_created  = $row[DATE_CREATED];
				// $date_modified = $row[DATE_MODIFIED];
			}

			$btnSubmitStr  = "Update Client";
			$formAction    = base_url() . "client/modify";
		}
	?>
	<form action="<?php echo $formAction; ?>" method="post" role="form">
		<input type="hidden" name="<?php echo ID; ?>" id="<?php echo ID; ?>" value="<?php echo $id; ?>" />

		<label for="first_name">Fist Name: </label>
		<input class="form-control" type="text" name="<?php echo FNAME; ?>" id="<?php echo FNAME; ?>" value="<?php echo $first_name; ?>" />

		<label for="last_name">Last Name: </label>
		<input class="form-control" type="text" name="<?php echo LNAME; ?>" id="<?php echo LNAME; ?>" value="<?php echo $last_name; ?>" />

		<label for="username">Username: </label>
		<input class="form-control" type="text" name="<?php echo UNAME; ?>" id="<?php echo UNAME; ?>" value="<?php echo $username; ?>" />

		<label for="password">Password: </label>
		<input class="form-control" type="password" name="<?php echo PWD; ?>" id="<?php echo PWD; ?>" value="<?php echo $password; ?>" />

		<label for="address">Address: </label>
		<input class="form-control" type="text" name="<?php echo ADDRESS; ?>" id="<?php echo ADDRESS; ?>" value="<?php echo $address; ?>" />

		<label for="email">Email: </label>
		<input class="form-control" type="email" name="<?php echo EMAIL; ?>" id="<?php echo EMAIL; ?>" value="<?php echo $email; ?>" />

		<label for="contact_no">Contact No: </label>
		<input class="form-control" type="text" name="<?php echo CONTACT; ?>" id="<?php echo CONTACT; ?>" value="<?php echo $contact_no; ?>" />

		<label for="date_created">Date Created: </label>
		<input class="form-control" type="datetime" name="<?php echo DATE_CREATED; ?>" id="<?php echo DATE_CREATED; ?>" value="<?php echo $date_created; ?>" />

		<!-- <label for="date_modified">Date Modified: </label>
		<input class="form-control" type="datetime" name="<?php echo DATE_MODIFIED; ?>" id="<?php echo DATE_MODIFIED; ?>" value="<?php echo $date_modified; ?>" /> -->

		<label for="photo">Photo: </label>
		<input type="file" name="<?php echo PHOTO; ?>" id="<?php echo PHOTO; ?>" /><br />

		<input style="width: 100%" type="submit" class="btn btn-primary" name="contactSubmit" value="<?php echo $btnSubmitStr; ?>" />
	</form>
</div>
