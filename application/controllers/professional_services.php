<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Professional_services extends BaseController {
	
	public function index() {
		$data['title'] = 'Professional Services | ' . APP_NAME;
        $data['content'] = 'content_professional_services';
        $data['css'] = base_url() . 'assets/css/jumbotron-narrow.css';
        $this->load->view($this->layout, $data);
	}
}

/* End of file professional_services.php */
/* Location: ./application/controllers/professional_services.php */