<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					4);
//define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FPATH', __FILE__);
define('SELFIE', pathinfo(__FILE__, PATHINFO_BASENAME));
define('PUBPATH',str_replace( "application\controllers\\" . SELFIE,'',FPATH)); // added 
define('FILE_PATH', PUBPATH . 'uploads/' );

class Upload extends BaseController {

	public function index(){
		$data['title']    = 'Upload | ' . APP_NAME;
		$data['content']  = 'upload';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['js']      = array(base_url() . 'assets/js/jquery.drag.drop.js', 
								base_url() . 'assets/js/upload.js',
								base_url() . 'assets/js/client.js');
		$data['activeId'] = NAV_ACTIVE_ID;		
        $this->load->view($this->layout, $data);	
	}
	
	public function do_upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'zip|rar|as|gif|jpg|png|jpeg|pdf|doc';
		$config['max_size'] = '542048';
		$config['remove_spaces'] = 'TRUE';
		$this->upload->initialize($config);		  
		$data = "Files uploaded";
		foreach($_FILES as $k => $f):
			if(!$this->upload->do_upload($k)){
				$data = "Error uploading files";
			}
		endforeach;
		echo json_encode($data);
	}
	
	public function retrieves_files(){
		$map = directory_map('./uploads');
		echo json_encode($map);
	}
	
	public function delete_file(){
		$filename = strip_tags($this->input->post("filename"));
		$filename = PUBPATH . 'uploads/' . $filename;
		//if(is_file ( $filename ) ){
			echo json_encode(unlink($filename));
		//}
	}
	
	/**
	usage 
	$.ajax({
        type:'post',
        dataType: 'json',
        url: 'http://localhost/nightjar/aabq-mmk/upload/rename_file',
        data: {
            old_name : "DSC_6173.jpg",
            new_name : "new2.jpg"
        },
        async: false,
        success:
        function(result){
			alert(result);
        },
        error: function(request, status, error){}
	});	
	*/
	
	public function api_rename_file(){
		$old_name = strip_tags($this->input->post("old_name"));
		$new_name = strip_tags($this->input->post("new_name"));
		echo json_encode(rename(FILE_PATH . $old_name, FILE_PATH . $new_name));
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */