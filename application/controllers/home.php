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
		$data['title']    = 'Home | ' . APP_NAME;
		$data['content']  = 'upload';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
        $this->load->view($this->layout, $data);	
	}
	
	public function do_upload(){
		var_dump($_FILES['file']);
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */