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
							'<td>' +
								'<button value="'+result[key]+'" data-toggle="modal" data-target="#modifyModal" type="button" class="btn btn-primary btn_rename_file">Rename</button>'+
								'<button value="'+result[key]+'" type="button" class="btn btn-danger btn_delete_file">Delete</button>'+
							'</td>' +
						+'</tr>'
					);
				}
				$('.btn_rename_file').click(function(){
					var me = $(this);
					var filename = me.val();
					update_modal(filename);
				});
				$('.btn_delete_file').click(function(){
					var me = $(this);
					var filename = me.val();
					delete_file(filename);
				});
			}
		});
	}
	
	$('#btn_save').click(function(){
		rename_file();
	});
				
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
	
	function update_modal(filename){
		$('#old_filename').val(filename);
	}
	
	function rename_file(){
		var oldfile = $('#old_filename').val();
		var newfile = $('#new_filename').val();
		if(newfile.trim() != ''){
			var oldlen = oldfile.split('.').length;
			var len = newfile.split('.').length;
			if(len > 0){
				var oext = oldfile.split('.')[len-1];
				var ext = newfile.split('.')[len-1];
				console.log(oext + "   " + ext);
				if( oext == ext){
					$.ajax({
						type:'post',
						dataType: 'json',
						url: './api_rename_file',
						data: {
							old_name : oldfile,
							new_name : newfile
						},
						async: false,
						success:
						function(result){
							$('#modifyModal').modal('hide');
							populate_table();
						},
						error: function(request, status, error){}
					});	
				} else {
					alert("incorrect file extension");
				}
			} else {
				alert("incorrect file extenstion");
			}
		}
	}
});