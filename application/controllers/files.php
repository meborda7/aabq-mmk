<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					4);
define('FPATH',							__FILE__);
define('SELFIE', 						pathinfo(__FILE__, PATHINFO_BASENAME));
define('PUBPATH',						str_replace( "application\controllers\\" . SELFIE,'',FPATH)); // added 
define('FILE_PATH', 					PUBPATH . 'uploads/' );

define('ID', 							'id');
define('CLIENT_ID', 					'client_id');
define('FILENAME', 						'filename');
define('EXTENSION', 					'ext');

class Files extends BaseController {

	public function index(){
		$data['title']    = 'Upload | ' . APP_NAME;
		$data['content']  = 'upload';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['js']      = array(base_url() . 'assets/js/jquery.drag.drop.js', 
								base_url() . 'assets/js/upload.js',
								base_url() . 'assets/js/client.js');
		$data['activeId'] = NAV_ACTIVE_ID;	
		$data['client_data'] = $this->selectAll(MODEL_CLIENT);	
        $this->load->view($this->layout, $data);	
	}
	
	public function do_upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'zip|rar|as|gif|jpg|png|jpeg|pdf|doc';
		$config['max_size'] = '542048';
		$config['remove_spaces'] = 'TRUE';
		$this->upload->initialize($config);		
		$data = array();
		foreach($_FILES as $k => $f):
			if($this->upload->do_upload($k)){
				array_push($data, $k);
			}
		endforeach;
		echo json_encode($data);
	}
	
	public function retrieves_files(){
		/*
		$map = directory_map('./uploads');
		echo json_encode($map);
		*/		
		$id = strip_tags($this->input->post("id"));
        $this->load->model(MODEL_FILE);
        echo json_encode($this->FileModel->select(null, array(CLIENT_ID=>$id)));
	}
	
	public function delete_file(){
		$filename = strip_tags($this->input->post("filename"));
		$filename = PUBPATH . 'uploads/' . $filename;
		if(is_file ( $filename ) ){
			echo json_encode(unlink($filename));
		}
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
		$this->load->model(MODEL_FILE);
		$file_id = strip_tags($this->input->post("file_id"));
		$old_name = strip_tags($this->input->post("old_name"));
		$new_name = strip_tags($this->input->post("new_name"));
		$filename = PUBPATH . 'uploads/' . $old_name;		
		if(is_file ( $filename ) ){
			rename(FILE_PATH . $old_name, FILE_PATH . $new_name);
			$fname = substr($new_name, 0, -4);
			$data = array(
				FILENAME	=> 		$fname
			);
			echo json_encode(array(RESULT => $this->FileModel->update($data, array(ID=>$file_id))));
		}
		echo json_encode(FALSE);
	}
	
	public function api_add_file(){		
		$this->load->model(MODEL_FILE);
		$filename = $this->input->post(FILENAME);
		echo json_encode($filename);
		$clientid = strip_tags($this->input->post(CLIENT_ID));
		foreach ($filename as $file){
			$arr = explode("_", $file);
			$fname = substr($file, 0, -4);
			$ext = $arr[count($arr)-1];
			$data = array(
				CLIENT_ID 	=> 		$clientid,
				FILENAME	=> 		$fname,
				EXTENSION	=> 		$ext
			);
			$result = $this->FileModel->insert($data);
		}		
		echo json_encode($result);
	}
}

/* End of file files.php */
/* Location: ./application/controllers/files.php */