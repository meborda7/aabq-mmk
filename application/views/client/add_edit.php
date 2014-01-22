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
		
		$err_fname  = "";
		$err_lname  = "";
		$err_uname  = "";
		$err_pwd    = "";
		$err_add    = "";
		$err_email  = "";
		$err_cno    = "";
		
		
		//$date_created  = "";
		// $date_modified = "";
		$photo         = "";
		$btnSubmitStr  = "Add Client";
		$formAction    = base_url() . "client/register";

		// if client_data is set, meaning this is an update operation..
		// ps : modified for validation; client_data can also be set if form data has invalid/empty fields 
		// this is so we could still display previously inputted data; @ahdz : PLEASE CHECK FOR CONFIRMATION
		if( isset($error_data) ){
			var_dump($client_data);
			if (array_key_exists(ID, $client_data)) 		$id  			= $client_data[ID];	
			if (array_key_exists(FNAME, $client_data))		$first_name  	= $client_data[FNAME];
			if (array_key_exists(LNAME, $client_data))		$last_name     	= $client_data[LNAME];			
			if (array_key_exists(UNAME, $client_data))		$username     	= $client_data[UNAME];			
			if (array_key_exists(ADDRESS, $client_data))	$address       	= $client_data[ADDRESS];
			if (array_key_exists(EMAIL, $client_data))		$email        	= $client_data[EMAIL];
			if (array_key_exists(CONTACT, $client_data))	$contact_no     = $client_data[CONTACT];
			if (array_key_exists(PHOTO, $client_data))		$photo       	= $client_data[PHOTO];
			
			$password      = "";
			
			if (array_key_exists(PHOTO, $error_data))		$err_fname     	= $error_data[FNAME];
			if (array_key_exists(FNAME, $error_data))		$err_fname     	= $error_data[FNAME];
			if (array_key_exists(LNAME, $error_data))		$err_lname     	= $error_data[LNAME];
			if (array_key_exists(UNAME, $error_data))		$err_uname     	= $error_data[UNAME];
			if (array_key_exists(PWD, $error_data))			$err_pwd       	= $error_data[PWD];
			if (array_key_exists(EMAIL, $error_data))		$err_email     	= $error_data[EMAIL];
			if (array_key_exists(ADDRESS, $error_data))		$err_add       	= $error_data[ADDRESS];
			if (array_key_exists(CONTACT, $error_data))		$err_cno       	= $error_data[CONTACT];
			if (array_key_exists(PHOTO, $error_data))		$err_photo     	= $error_data[PHOTO];
			
		} else if (isset($client_data) && count($client_data) > 0) {
			$client_data = json_decode($client_data, TRUE);
			foreach($client_data['result'] as $client) {
				$id            = $client[ID];
				$first_name    = $client[FNAME];
				$last_name     = $client[LNAME];
				$username      = $client[UNAME];
				$password      = $client[PWD];
				$address       = $client[ADDRESS];
				$email         = $client[EMAIL];
				$contact_no    = $client[CONTACT];
				$photo         = $client[PHOTO];
				// $date_created  = $row[DATE_CREATED];  automatically added in the db
				// $date_modified = $row[DATE_MODIFIED];
			}
		}	
		if( $isModify ){
			$btnSubmitStr  = "Update Client";
			$formAction    = base_url() . "client/modify";
		}
	?>
	<form action="<?php echo $formAction; ?>" method="post" role="form">
		<input type="hidden" name="<?php echo ID; ?>" id="<?php echo ID; ?>" value="<?php echo $id; ?>" />

		<label for="first_name">Fist Name: </label><span class ="error_lbl"><?php echo $err_fname; ?></span>
		<input class="form-control" type="text" name="<?php echo FNAME; ?>" id="<?php echo FNAME; ?>" value="<?php echo $first_name; ?>" />

		<label for="last_name">Last Name: </label><span class ="error_lbl"><?php echo $err_lname; ?></span>
		<input class="form-control" type="text" name="<?php echo LNAME; ?>" id="<?php echo LNAME; ?>" value="<?php echo $last_name; ?>" />

		<label for="username">Username: </label><span class ="error_lbl"><?php echo $err_uname; ?></span>
		<input class="form-control" type="text" name="<?php echo UNAME; ?>" id="<?php echo UNAME; ?>" value="<?php echo $username; ?>" />

		<label for="password">Password: </label><span class ="error_lbl"><?php echo $err_pwd; ?></span>
		<input class="form-control" type="password" name="<?php echo PWD; ?>" id="<?php echo PWD; ?>" value="<?php echo $password; ?>" />

		<label for="address">Address: </label><span class ="error_lbl"><?php echo $err_add; ?></span>
		<input class="form-control" type="text" name="<?php echo ADDRESS; ?>" id="<?php echo ADDRESS; ?>" value="<?php echo $address; ?>" />

		<label for="email">Email: </label><span class ="error_lbl"><?php echo $err_email; ?></span>
		<input class="form-control" type="email" name="<?php echo EMAIL; ?>" id="<?php echo EMAIL; ?>" value="<?php echo $email; ?>" />

		<label for="contact_no">Contact No: </label><span class ="error_lbl"><?php echo $err_cno; ?></span>
		<input class="form-control" type="text" name="<?php echo CONTACT; ?>" id="<?php echo CONTACT; ?>" value="<?php echo $contact_no; ?>" />

		<!-- 
		<label for="date_created">Date Created: </label>
		<input class="form-control" type="datetime" name="<?php echo DATE_CREATED; ?>" id="<?php echo DATE_CREATED; ?>" value="<?php echo $date_created; ?>" />

		<!-- <label for="date_modified">Date Modified: </label>
		<input class="form-control" type="datetime" name="<?php echo DATE_MODIFIED; ?>" id="<?php echo DATE_MODIFIED; ?>" value="<?php echo $date_modified; ?>" /> -->

		<label for="photo">Photo: </label>
		<input type="file" name="<?php echo PHOTO; ?>" id="<?php echo PHOTO; ?>" /><br />

		<input style="width: 100%" type="submit" class="btn btn-primary" name="contactSubmit" value="<?php echo $btnSubmitStr; ?>" />
	</form>
</div>
