<div class="well">
	<?php
		$id           = "";
		$name         = "";
		$description  = "";
		$price        = "";
		$remarks      = "";
		$discount     = "";
		$sla          = "";
		$btnSubmitStr = "Add Service";
		$formAction   = base_url() . "professional_services/register";

		// if service_data is set, meaning this is an update operation..
		if (isset($service_data)) {
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

			$btnSubmitStr  = "Update Service";
			$formAction    = base_url() . "professional_services/modify";
		}
	?>
	<form action="<?php echo $formAction; ?>" method="post" role="form">
		<input type="hidden" name="<?php echo ID; ?>" id="<?php echo ID; ?>" value="<?php echo $id; ?>" />

		<label for="name">Service Name: </label>
		<input class="form-control" type="text" name="<?php echo NAME; ?>" id="<?php echo NAME; ?>" value="<?php echo $name; ?>" />

		<label for="description">Description: </label>
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
