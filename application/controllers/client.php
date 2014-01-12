<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends BaseController {
	
	public function index() {
		$data['title'] = 'Client | ' . APP_NAME;
        $data['content'] = 'content_client';
        $data['css'] = base_url() . 'assets/css/jumbotron-narrow.css';
        $this->load->view($this->layout, $data);
	}
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */