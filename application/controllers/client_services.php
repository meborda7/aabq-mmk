<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					3);

class Client_services extends BaseController {
	
	public function index() {
		$data['title']    = 'Client Services | ' . APP_NAME;
		$data['content']  = 'content_client_services';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
        $this->load->view($this->layout, $data);
	}
}

/* End of file client_services.php */
/* Location: ./application/controllers/client_services.php */