<div class="">
	<?php
		$results = json_decode($services, true);
	?>
	<div class="well">
		<a href="<?php echo base_url(); ?>professional_services/add" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span> Add New Service</a>
	</div>

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
					<a href="<?php echo base_url(); ?>professional_services/update/<?php echo $id ?>" class="btn btn-info btn-xs">Update</a>
					<a href="<?php echo base_url(); ?>professional_services/delete/<?php echo $id ?>" class="btn btn-danger btn-xs">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>
