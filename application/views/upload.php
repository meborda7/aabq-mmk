<?php
	$client_data = json_decode($client_data, true);
	$results = $client_data['result'];
?>

<div class="well form-inline">
	Select A Client:
	<?php
		echo '<select class="form-control" style="width: 20%;" id="select_client_id">';
		foreach ($results as $row) {
			echo '<option value="'. $row['id'] .'">';
			echo $row['first_name'] . " " . $row['last_name'];
			echo '</option>';
		}
		echo '</select>';
	?>
</div>

<form action="#" method="post" enctype="multipart/form-data">
	<input type="file" name="files[]" multiple="multiple">
</form>

<table class="table table-striped table-bordered">
	<thead>
		<th>File Name</th>
		<th>Controls</th>
	</thead>
	<tbody id="tbody_uploaded_files">

	</tbody>
</table>

<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modify file</h4>
      </div>
      <div class="modal-body">
		<table style="width: 100%;" >
			<tr>
				<td>Old filename : </td>
				<td><input style="width: 100%;" class="form-control date-form" type="text" id="old_filename" name="old_filename" readonly></td>
			</tr>
			<tr>
				<td>New filename : </td>
				<td><input style="width: 100%;" class="form-control date-form" type="text" id="new_filename" name="new_filename" ></td>
			</tr>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_save" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->