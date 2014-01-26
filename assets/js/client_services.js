$(function(){
	
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

	$('#btn_get_services').click(function() {
		var client_id = $('#select_client').val();
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
									+'<th>Remarks</th>'
									+'<th>Discount</th>'
									+'<th>SLA</th>'
									+'<th>Start</th>'
									+'<th>End</th>'
								+'</tr>';

				for (var i in data.client_service) {
					var service = data.client_service[i];
					content += '<tr>'
								+'<td>'+ service.name +'</td>'
								+'<td>'+ service.price +'</td>'
								+'<td>'+ service.remarks +'</td>'
								+'<td>'+ service.discount +'</td>'
								+'<td>'+ service.sla +'</td>'
								+'<td>'+ service.date_start +'</td>'
								+'<td>'+ service.date_end +'</td>';
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
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			}
		});
	})

	function toUSD(number) {
		var number = number.toString(),
		dollars = number.split('.')[0],
		cents = (number.split('.')[1] || '') +'00';
		dollars = dollars.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
	    return '$' + dollars + '.' + cents.slice(0, 2);
	}
});
