<div class="">
	<?php
		$client_data = json_decode($client_data, true);
		$results = $client_data['result'];
	?>

	<div class="well form-inline">
		Select A Client:
		<?php
			echo '<select class="form-control" style="width: 20%;" id="select_client">';
			foreach ($results as $row) {
				echo '<option value="'. $row['id'] .'">';
				echo $row['first_name'] . " " . $row['last_name'];
				echo '</option>';
			}
			echo '</select>';
		?>
		<button id="btn_get_services" class="btn btn-warning">Get Availed Services</button>
	</div>
	<div class="" id="output" style="margin-top: 5px;">
	</div>

</div>
