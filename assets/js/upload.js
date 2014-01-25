$(document).ready(function() {
	
	var uploadOkay = function(resp) {
		alert(resp);
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
							'<td><button value="'+result[key]+'" type="button" class="btn btn-danger btn_delete_file">Delete</button></td>' +
						+'</tr>'
					);
				}
				$('.btn_delete_file').click(function(){
					var me = $(this);
					var filename = me.val();
					delete_file(filename);
				});
			}
		});
	}
	
	function delete_file(filename){
		$.ajax({
			type            : 'POST',
			contentType 	: 'json',
			data 			: {'filename' : filename},
			url             : './delete_file',
			success       : function(result) {
				alert(result);
				populate_table();
			}
		});
	}
});