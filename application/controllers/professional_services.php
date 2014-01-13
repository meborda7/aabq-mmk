<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('ID', 							'id');
define('NAME', 							'name');
define('DESCRIPTION',					'description');
define('PRICE', 						'price');
define('PWD', 							'password');
define('REMARKS', 						'remarks');
define('DISCOUNT', 						'discount');
define('SLA', 							'sla');

class Professional_services extends BaseController {
	
	public function index() {
		$data['title'] = 'Professional Services | ' . APP_NAME;
        $data['content'] = 'content_professional_services';
        $data['css'] = base_url() . 'assets/css/jumbotron-narrow.css';
        $this->load->view($this->layout, $data);
	}
	
	public function register(){
		$this->load->model(MODEL_CLIENT);
		$data = $this->input->post();
	}
}

/* End of file professional_services.php */
/* Location: ./application/controllers/professional_services.php */