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
					<a href="<?php echo base_url(); ?>client_services/add/<?php echo $row['id']; ?>" class="btn btn-info btn-xs">Request</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>
