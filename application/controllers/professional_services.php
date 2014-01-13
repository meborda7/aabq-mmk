<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Professional_services extends BaseController {
	
	public function index() {
		$data['title']    = 'Professional Services | ' . APP_NAME;
		$data['content']  = 'prof_services/content_professional_services';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = 2;
		$data['services'] = $this->selectAll();
        $this->load->view($this->layout, $data);
	}

	public function selectAll() {         
		$this->load->model(MODEL_PROF_SERVICES);        
		return json_encode(array(RESULT => $this->ProfServicesModel->select()));
    }
}

/* End of file professional_services.php */
/* Location: ./application/controllers/professional_services.php */