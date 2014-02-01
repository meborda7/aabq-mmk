$(function(){

	var is_modify         = false;
	var client_service_id = -1;

	$('.rq_btn').click(
		function(e){

			$.ajax({
				type            : 'GET',
				contentType : 'json',
				url              : '/client_services/getClientAvailedServices/2/',
				success       : function(data) {
					console.log(data);
				}
			});
			$('#service_id').attr("value",e.target.id);
		}
	);

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	var start = $('#date_start').datepicker({
	  onRender: function(date) {
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  if (ev.date.valueOf() > end.date.valueOf()) {
		var newDate = new Date(ev.date)
		newDate.setDate(newDate.getDate() + 1);
		end.setValue(newDate);
	  }
	  start.hide();
	  $('#date_end')[0].focus();
	}).data('datepicker');
	var end = $('#date_end').datepicker({
	  onRender: function(date) {
		return date.valueOf() <= now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  if (ev.date.valueOf() > end.date.valueOf()) {
		var newDate = new Date(ev.date)
		newDate.setDate(newDate.getDate() + 1);
		end.setValue(newDate);
	  }
	  start.hide();
	}).data('datepicker');

	//******************** GETTING AVAILED SERVICES ********************//
	$('#btn_get_services').click(function() {
		var client_id = $('#select_client_id').val();
		$.ajax({
			ContentType : 'application/json',
			type : 'GET',
			url : 'api_getClientAvailedServices/' + client_id,
			success : function(client_service, status) {
				var data = JSON.parse(client_service);
				var total = 0, price = 0, discount = 0;
				var content = '<table class="table table-striped table-bordered">'
								+'<tr>'
									+'<th>Name</th>'
									+'<th>Price</th>'
									+'<th>Add Info</th>'
									+'<th>Discount</th>'
									+'<th>SLA</th>'
									+'<th>Start</th>'
									+'<th>End</th>'
									+'<th>Controls</th>'
								+'</tr>';

				for (var i in data.client_service) {
					var service = data.client_service[i];
					content += '<tr>'
								+'<td>'+ service.name +'</td>'
								+'<td>'+ service.price +'</td>'
								+'<td>'+ service.add_info +'</td>'
								+'<td>'+ service.discount +'</td>'
								+'<td>'+ service.sla +'</td>'
								+'<td>'+ service.date_start +'</td>'
								+'<td>'+ service.date_end +'</td>'
								+'<td>'
									+'<button value="'+ service.id +'" type="button" class="btn btn-primary" id="btn_update'+ service.id +'">Update</button>'
									+ '<button value="'+ service.id +'" type="button" class="btn btn-danger" id="btn_delete">Delete</button>'
								+'</td>';
					content += '</tr>';

					// validate appropriate values
					if (service.price)
						price = Number(service.price.replace(/[^0-9\.]+/g,"")); // convert currency formatted string to number
					if (service.discount)
						discount = parseFloat(service.discount);

					// compute for the exact amount to be paid
					total += price - (price * discount);
				}

				content += '</table>';
				content += '<div class="well" style="text-align:right;"><b>Total Price: '+ toUSD(total) +'</b></dv>';
				$('#output').html(content);

				//************************** UPDATE A SERVICE **********************//
				$('button[id^=btn_update]').click(function() {
					is_modify         = true;
					client_service_id = $(this).val();
					var service_id    = $('#select_service_id').val();
					var tableRowData  = $(this).parent().siblings('td').map(function() {
						return $(this).text();
					}).get();

					addServiceDataToFields(service_id, tableRowData);
				});

				//************************** DELETE A SERVICE **********************//
				$('button[id^=btn_delete]').click(function() {
					var client_service_id = $(this).val();
					var diag = confirm("Do you want to remove this service?");
					if (diag) {
						$.ajax({
							ContentType: 'application/json',
							type       : 'GET',
							url        : 'delete_clientservice/' + client_service_id,
							success    : function(data) {
								data = JSON.parse(data);
								if (data.result) {
									$('#btn_get_services').click();
								}
							}
					});
					}
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			}
		});
	});

	//**************************** SAVE A SERVICE ***********************//
	$('#btn_save_service').click(function() {
		var client_id  = $('#select_client_id').val();
		var service_id = $('#select_service_id').val();
		var date_start = $('#date_start').val();
		var date_end   = $('#date_end').val();
		var add_info   = $('#add_info').val();
		var url        = (is_modify) ? 'modify' : 'register';

		$.ajax({
			ContentType: 'application/json',
			type       : 'POST',
			url        : url,
			data       : {
				'id'        : client_service_id,
				'client_id' : client_id,
				'service_id': service_id,
				'date_start': date_start,
				'date_end'  : date_end,
				'add_info'  : add_info
			},
			success: function(){
				// reset the following globals to default values
				is_modify         = false;
				client_service_id = -1;

				// UI Updates
				$('#addModal').modal('hide');
				resetFields();
				$('#btn_get_services').click();
			}
		});
	});

	
	$('#btn_cancel').click(function() {
		alert('Delete Service');
	});

	function toUSD(number) {
		var number = number.toString(),
		dollars = number.split('.')[0],
		cents = (number.split('.')[1] || '') +'00';
		dollars = dollars.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
	    return '$' + dollars + '.' + cents.slice(0, 2);
	}
	
	function resetFields(){
		$("#select_service_id").val($("#select_service_id option:first").val());
		$("input[type=text]").html("");
		$("input[type=text]").val("");
		$("#add_info").html("");
		$("#add_info").val("");
	}

	function addServiceDataToFields(service_id, tableRowData) {
		var date_start = tableRowData[5];
		var date_end   = tableRowData[6];
		var add_info   = tableRowData[2];

		$('#addModal').modal('show');
		if (service_id)
			$('#select_service_id').val(service_id);
		if (date_start)
			$('#date_start').val(date_start);
		if (date_end)
			$('#date_end').val(date_end);
		if (add_info)
			$('#add_info').val(add_info);
	}
});
