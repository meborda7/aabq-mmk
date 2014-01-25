$(document).ready(function() {
	
	var uploadOkay = function(resp) {
		alert("Upload successful");
		populate_table();
	};

	$('input[type="file"]').dropUpload({
		'uploadUrl'	: './do_upload',
		'uploaded'	: uploadOkay,
		'dropClass' 	: 'file-drop upload_space badge',
		'dropHoverClass': 'file-drop-hover',
		'defaultText'  	: 'Drop files here.. :)',
		'hoverText'	: 'Let go to upload.. :P'
	});
	populate_table();
	function populate_table(){
		$.ajax({
			type            : 'GET',
			contentType 	: 'json',
			url             : './retrieves_files',
			success       : function(result) {
				$('#tbody_uploaded_files').html('');
				result = JSON.parse(result);
				for (var key in result){
					$('#tbody_uploaded_files').append(
						'<tr>'+
							'<td>' + result[key] + '</td>' +
							'<td><button type="button" class="btn btn-danger">Delete</button></td>' +
						+'</tr>'
					);
				}
			}
		});
	}
});