<div class="">
	<?php
		$results = json_decode($services, true);
	?>	
	<table class="table table-striped table-bordered">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
			<th>Remarks</th>
			<th>Discount</th>
			<th>SLA</th>
			<th>Controls</th>
		</tr>
		<?php foreach ($results['result'] as $row) { $id = $row['id']; ?>
			<tr>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['description'] ?></td>
				<td><?php echo $row['price'] ?></td>
				<td><?php echo $row['remarks'] ?></td>
				<td><?php echo $row['discount'] ?></td>
				<td><?php echo $row['sla'] ?></td>
				<td style="width:12%">
					<button class="btn btn-primary btn-lg rq_btn" id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#md_request">
					  Request
					</button>
				</td>
			</tr>
		<?php } ?>
	</table>
	<div class="modal fade" id="md_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Request Service</h4>
		  </div>
		  <form action="<?php echo base_url() . "client_services/register/2"; ?>" method="post" role="form">
			  <div class="modal-body">
			  
				<table class="table">
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
						<td><textarea class="form-control" name="remarks" placeholder="Enter text here..."></textarea></td>
						<td><input type="hidden" name="service_id" id="service_id"></td>
					  </tr>
				  </table>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
		</form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
