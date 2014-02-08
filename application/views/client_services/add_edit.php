<?php 
	$date_start = "";
	$date_end   = "";
	$remarks   = "";
	$ser_id = "";
	if( isset($service_id) ){
		$ser_id = $service_id;
	}
	if( isset($service) ){
		$date_start = $service[DATE_START];
		$date_end   = $service[DATE_END];
		$remarks   = $service[REMARKS];
		$method =  base_url() . "client_service/modify/" . $id;
		$ser_id = $service[SERVICE_ID];
		$name = $service["name"];
	} else {
		$method =  base_url() . "client_service/register/2";
	}
?>

<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $method; ?>" method="post" role="form">
			  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php if(isset($name)) echo $name;?></h4>
			  </div>
			  <div class="modal-body">	  
				<table class="table">
					  <tr>
						<td>Start date: </td>
						<td><input class="form-control date-form" value="<?php echo $date_start;?>" type="text" id="date_start" name="date_start" data-date-format="yyyy-mm-dd" readonly></td>
					  </tr>
					  <tr>
						<td>End date:</td>
						<td><input class="form-control date-form" value="<?php echo $date_end;?>" type="text" data-date-format="yyyy-mm-dd" id="date_end" name="date_end" readonly></td>
					  </tr>
					  <tr>
						<td>Remarks:</td>
						<td><textarea class="form-control" name="add_info" placeholder="Enter text here..." id="add_info"><?php echo $remarks;?></textarea></td>
						<td><input type="hidden" name="service_id" id="service_id" value="<?php echo $ser_id ?>"></td>
					  </tr>
				  </table>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="window.history.back();">Cancel</button>
				<button type="submit" id="frm_submit" class="btn btn-primary">Save changes</button>
			  </div>
		</form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="<?php echo $method; ?>" method="post" role="form">
	  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><?php if(isset($name)) echo $name;?></h4>
	  </div>
	  <div class="modal-body">	  
		<table class="table">
			  <tr>
				<td>Start date: </td>
				<td><input class="form-control date-form" value="<?php echo $date_start;?>" type="text" id="date_start" name="date_start" data-date-format="yyyy-mm-dd" readonly></td>
			  </tr>
			  <tr>
				<td>End date:</td>
				<td><input class="form-control date-form" value="<?php echo $date_end;?>" type="text" data-date-format="yyyy-mm-dd" id="date_end" name="date_end" readonly></td>
			  </tr>
			  <tr>
				<td>Remarks:</td>
				<td><textarea class="form-control" name="add_info" placeholder="Enter text here..." id="add_info"><?php echo $remarks;?></textarea></td>
				<td><input type="hidden" name="service_id" id="service_id" value="<?php echo $ser_id ?>"></td>
			  </tr>
		  </table>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" onclick="window.history.back();">Cancel</button>
		<button type="submit" id="frm_submit" class="btn btn-primary">Save changes</button>
	  </div>
</form>
