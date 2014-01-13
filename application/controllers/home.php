<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends BaseController {
    
    public function index() {
		$data['title']    = 'Home | ' . APP_NAME;
		$data['content']  = 'home';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['activeId'] = 0;
        $this->load->view($this->layout, $data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */