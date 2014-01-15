<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					3);

define('ID', 							'id');
define('CLIENT_ID', 					'client_id');
define('SERVICE_ID', 					'service_id');
define('DATE_START', 					'date_start');
define('DATE_END', 						'date_end');


class Client_services extends BaseController {
	
	public function index() {
		$data['title']    = 'Client Services | ' . APP_NAME;
		$data['content']  = 'content_client_services';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
        $this->load->view($this->layout, $data);
	}
	
	
	public function register(){
		$this->load->model(MODEL_CLIENT_SERVICES);

		$client_id   = strip_tags($this->input->post(CLIENT_ID));
		$service_id  = strip_tags($this->input->post(SERVICE_ID));
		$date_start  = strip_tags($this->input->post(DATE_START));
		$date_end     = strip_tags($this->input->post(DATE_END));
		$data = array(
			CLIENT_ID 		=> 		$client_id,
			SERVICE_ID 		=> 		$service_id,
			DATE_START 		=> 		$date_start,
			DATE_END 		=> 		$date_end
		);
		echo json_encode(array(RESULT => $this->ClientServiceModel->insert($data)));
	}

	public function modify(){
		$this->load->model(MODEL_CLIENT_SERVICES);
		$id      = strip_tags($this->input->post(ID));
		$client_id   = strip_tags($this->input->post(CLIENT_ID));
		$service_id  = strip_tags($this->input->post(SERVICE_ID));
		$date_start  = strip_tags($this->input->post(DATE_START));
		$date_end     = strip_tags($this->input->post(DATE_END));
		$data    = array();
		if( !$this->IsNullOrEmptyString($client_id) ){
			$data[CLIENT_ID] = $client_id;
		}
		if( !$this->IsNullOrEmptyString($service_id) ){
			$data[SERVICE_ID] = $service_id;
		}
		if( !$this->IsNullOrEmptyString($date_start) ){
			$data[DATE_START] = $date_start;
		}
		if( !$this->IsNullOrEmptyString($date_end) ){
			$data[DATE_END] = $date_end;
		}
		
		if( isset($data) ){
			echo json_encode(array(RESULT => $this->ClientServiceModel->update($data, array(ID=>$id))));
		} else {
			echo json_encode(array(RESULT => FALSE));
		}
	}
	
}

/* End of file client_services.php */
/* Location: ./application/controllers/client_services.php */