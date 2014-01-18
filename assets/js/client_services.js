$(function(){
	$('.rq_btn').click(
		function(e){
			


	$.ajax({
		type            : 'GET',
		contentType : 'json',
		url              : 'http://localhost/nightjar/aabq-mmk/client_services/getClientAvailedServices/2/',
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
});
