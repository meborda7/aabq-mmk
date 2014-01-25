<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					0);
//define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FPATH', __FILE__);
define('SELFIE', pathinfo(__FILE__, PATHINFO_BASENAME));
define('PUBPATH',str_replace( "application\controllers\\" . SELFIE,'',FPATH)); // added 

class Home extends BaseController {
    
    public function index() {
		$data['title']    = 'Home | ' . APP_NAME;
		$data['content']  = 'home';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
        $this->load->view($this->layout, $data);
    }

	public function upload(){
		$data['title']    = 'Upload | ' . APP_NAME;
		$data['content']  = 'upload';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['js']      = array(base_url() . 'assets/js/jquery.drag.drop.js', 
								base_url() . 'assets/js/upload.js');
		$data['activeId'] = NAV_ACTIVE_ID;		
        $this->load->view($this->layout, $data);	
		echo SELFIE . '<br>';
		echo PUBPATH;
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
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */