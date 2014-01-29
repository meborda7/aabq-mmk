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
		<button id="btn_add_services" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Request New Service</button>
	</div>
	<div class="" id="output" style="margin-top: 5px;">
	</div>

</div>

<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
	  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Request New Service</h4>
	  </div>
	  <div class="modal-body">	  
		<table class="table">
			  <tr>
				<td>Select A Service:</td>
				<td>					
					<?php
						echo '<select class="form-control date-form" id="select_client">';
						foreach ($services as $row) {
							echo '<option value="'. $row['id'] .'">';
							echo $row['name'];
							echo '</option>';
						}
						echo '</select>';
					?>
				</td>
			  </tr>
			  <tr>
				<td>Start date: </td>
				<td><input class="form-control date-form" type="text" id="date_start" name="date_start" data-date-format="yyyy-mm-dd" readonly></td>
			  </tr>
			  <tr>
				<td>End date:</td>
				<td><input class="form-control date-form" type="text" data-date-format="yyyy-mm-dd" id="date_end" name="date_end" readonly></td>
			  </tr>
			  <tr>
				<td>Remarks:</td>
				<td><textarea class="form-control" name="add_info" placeholder="Enter text here..." id="add_info"></textarea></td>
			  </tr>
		  </table>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button type="submit" id="frm_submit" class="btn btn-primary">Save changes</button>
	  </div>
    </div>
  </div>
</div>