<div class="well">
	<?php
		$id              = "";
		$name            = "";
		$description     = "";
		$price           = "";
		$remarks         = "";
		$discount        = "";
		$sla             = "";

		$err_name        = "";
		$err_description = "";

		$btnSubmitStr    = "Add Service";
		$formAction      = base_url() . "professional_service/register";

			// if service_data is set, meaning this is an update operation..
		if (isset($error_data)) {
			var_dump($service_data);

			if (array_key_exists(ID, $service_data)) 			$id                  = $service_data[ID];
			if (array_key_exists(NAME, $service_data)) 			$name                = $service_data[NAME];
			if (array_key_exists(DESCRIPTION, $service_data)) 	$description         = $service_data[DESCRIPTION];
			if (array_key_exists(PRICE, $service_data)) 		$price               = $service_data[PRICE];
			if (array_key_exists(REMARKS, $service_data)) 		$remarks             = $service_data[REMARKS];
			if (array_key_exists(DISCOUNT, $service_data)) 		$discount            = $service_data[DISCOUNT];
			if (array_key_exists(SLA, $service_data)) 			$sla                 = $service_data[SLA];

			if (array_key_exists(NAME, $service_data)) 			$err_name            = $service_data[NAME];
			if (array_key_exists(DESCRIPTION, $service_data)) 	$err_description     = $service_data[DESCRIPTION];
		}
		else if (isset($service_data) && count($service_data) > 0) {
			$results = json_decode($service_data, true);

			foreach($results['result'] as $row) {
				$id          = $row[ID];
				$name        = $row[NAME];
				$description = $row[DESCRIPTION];
				$price       = $row[PRICE];
				$remarks     = $row[REMARKS];
				$discount    = $row[DISCOUNT];
				$sla         = $row[SLA];
			}
		}

		if ($isModify) {
			$btnSubmitStr  = "Update Service";
			$formAction    = base_url() . "professional_service/modify";
		}
	?>
	<form action="<?php echo $formAction; ?>" method="post" role="form">
		<input type="hidden" name="<?php echo ID; ?>" id="<?php echo ID; ?>" value="<?php echo $id; ?>" />

		<label for="name">Service Name: </label><span class ="error_lbl"><?php echo $err_name; ?></span>
		<input class="form-control" type="text" name="<?php echo NAME; ?>" id="<?php echo NAME; ?>" value="<?php echo $name; ?>" />

		<label for="description">Description: </label><span class ="error_lbl"><?php echo $err_description; ?></span>
		<textarea class="form-control" rows="5" name="<?php echo DESCRIPTION; ?>" id="<?php echo DESCRIPTION; ?>"><?php echo $description; ?></textarea>

		<label for="price">Price: </label>
		<input class="form-control" type="text" name="<?php echo PRICE; ?>" id="<?php echo PRICE; ?>" value="<?php echo $price; ?>" />

		<label for="remarks">Remarks: </label>
		<textarea class="form-control" rows="5" name="<?php echo REMARKS; ?>" id="<?php echo REMARKS; ?>"><?php echo $remarks; ?></textarea>

		<label for="discount">Discount: </label>
		<input class="form-control" type="text" name="<?php echo DISCOUNT; ?>" id="<?php echo DISCOUNT; ?>" value="<?php echo $discount; ?>" />

		<label for="sla">Service-Level Agreement: </label>
		<input class="form-control" type="text" name="<?php echo SLA; ?>" id="<?php echo SLA; ?>" value="<?php echo $sla; ?>" /><br />

		<input style="width: 100%" type="submit" id="frm_submit" disabled="disabled" class="btn btn-primary" value="<?php echo $btnSubmitStr; ?>" />
	</form>
</div>
