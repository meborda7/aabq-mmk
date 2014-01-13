<div class="">
	<?php
		$results = json_decode($clients, true);		
	?>
	<div class="well">
		<a href="<?php echo base_url(); ?>client/add" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span> Add New Client</a>
	</div>
	
	<table class="table table-striped table-bordered">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Email</th>
			<th>Contact No.</th>
			<th>Controls</th>
		</tr>
		<?php foreach ($results['result'] as $row) { $id = $row['id']; ?>
			<tr>
				<td><?php echo $row['first_name'] ?></td>
				<td><?php echo $row['last_name'] ?></td>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['contact_no'] ?></td>
				<td>
					<a href="<?php echo base_url(); ?>client/update/<?php echo $id ?>" class="btn btn-info btn-xs">Update</a>
					<a href="<?php echo base_url(); ?>client/delete/<?php echo $id ?>" class="btn btn-danger btn-xs">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>