$(document).ready(function() {
	
	var uploadOkay = function(resp) {
		var arr = JSON.parse(resp);
		var clientid = $('#select_client_id').val();
		$.ajax({
			type:'post',
			dataType: 'json',
			url: 'http://localhost/nightjar/files/api_add_file',
			data: {
				filename : arr,
				client_id : clientid
			},
			async: false,
			success:
			function(result){
				alert(result);
			},
			error: function(request, status, error){
			
			}
		});	
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
		var clientid = $('#select_client_id').val();
		$.ajax({
			type:'post',
			dataType: 'json',
			url             : 'http://localhost/nightjar/files/retrieves_files',
			data: {
				id : clientid
			},
			async: false,
			success       : function(result) {
				console.log(result);
				$('#tbody_uploaded_files').html('');
				for (var key in result){
					$('#tbody_uploaded_files').append(
						'<tr>'+
							'<td id="file'+ result[key].id +'">' + result[key].filename + '.' + result[key].ext +'</td>' +
							'<td>' +
								'<button value="'+result[key].id  +'" data-toggle="modal" data-target="#modifyModal" type="button" class="btn btn-primary btn_rename_file">Rename</button>'+
								'<button value="'+result[key].id +'" type="button" class="btn btn-danger btn_delete_file">Delete</button>'+
							'</td>' +
						+'</tr>'
					);
				}
				$('.btn_rename_file').click(function(){
					resetFields();
					var me = $(this);
					var id = me.val();
					var filename = $('#file'+ id).html();
					update_modal(filename, id);
				});
				$('.btn_delete_file').click(function(){
					var me = $(this);
					var id = me.val();
					var filename = $('#file'+ id).html();
					delete_file(filename, id);
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
	
	function update_modal(filename, id){
		$('#old_filename').val(filename);
		$('#btn_save').val(id);
	}
	
	function rename_file(){
		var oldfile = $('#old_filename').val();
		var newfile = $('#new_filename').val();
		var id = $('#btn_save').val();
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
							file_id : id,
							old_name : oldfile,
							new_name : newfile
						},
						async: false,
						success:
						function(result){
							$('#modifyModal').modal('hide');
							alert(result);
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
	
	function resetFields(){		
		$('#old_filename').val('');
		$('#new_filename').val('');
		$('#new_filename').html('');
		$('#new_filename').html('');
	}
});