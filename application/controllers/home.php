<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					0);

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
	}
	
	public function do_upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|zip|rar|ACTIONSCRIPT|as';
		$config['max_size'] = '242048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['remove_spaces'] = 'TRUE';
		$this->upload->initialize($config);		  

		foreach($_FILES as $k => $f):
			$this->upload->do_upload($k);
		endforeach;
	}
	
	public function retrieves_files(){
		$map = directory_map('./uploads');
		echo json_encode($map);
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */