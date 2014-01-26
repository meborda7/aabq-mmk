<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					3);

define('ID', 							'id');
define('CLIENT_ID', 					'client_id');
define('SERVICE_ID', 					'service_id');
define('DATE_START', 					'date_start');
define('DATE_END', 						'date_end');
define('REMARKS', 						'add_info');


class Client_services extends BaseController {

	public function index() {
		$data['title']           = 'Client Services | ' . APP_NAME;
		$data['content']         = 'client_services/content_client_services';
		$data['css']             = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']              = array(base_url() . 'assets/js/client_services.js',
										base_url() . 'assets/js/bootstrap-datepicker.js');
		$data['activeId']        = NAV_ACTIVE_ID;
		$data['client_data']     = $this->selectAll(MODEL_CLIENT);
		$this->load->view($this->layout, $data);
	}

	public function register($client_id = NULL){
		$this->load->model(MODEL_CLIENT_SERVICES);

		if( $client_id  == NULL ){
			$client_id   = strip_tags($this->input->post(CLIENT_ID));
		}
		$service_id  = strip_tags($this->input->post(SERVICE_ID));
		$date_start  = strip_tags($this->input->post(DATE_START));
		$date_end     = strip_tags($this->input->post(DATE_END));
		$date_end     = strip_tags($this->input->post(DATE_END));
		$remarks     = strip_tags($this->input->post(REMARKS));
		$data = array(
			CLIENT_ID 		=> 		$client_id,
			SERVICE_ID 		=> 		$service_id,
			DATE_START 		=> 		$date_start,
			DATE_END 		=> 		$date_end,
			REMARKS 		=> 		$remarks
		);
		echo json_encode(array(RESULT => $this->ClientServiceModel->insert($data)));
	}

	public function modify($id){
		$this->load->model(MODEL_CLIENT_SERVICES);
		$client_id  = strip_tags($this->input->post(CLIENT_ID));
		$service_id = strip_tags($this->input->post(SERVICE_ID));
		$date_start = strip_tags($this->input->post(DATE_START));
		$date_end   = strip_tags($this->input->post(DATE_END));
		$remarks   = strip_tags($this->input->post(REMARKS));
		$data       = array();
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
		if( !$this->IsNullOrEmptyString($remarks) ){
			$data[REMARKS] = $remarks;
		}

		if( isset($data) ){
			echo json_encode(array(RESULT => $this->ClientServiceModel->update($data, array(ID=>$id))));
		} else {
			echo json_encode(array(RESULT => FALSE));
		}
	}

	private function getAllClientServices() {
		$this->load->model(MODEL_CLIENT);
		$client_ids = $this->ClientModel->select(ID);
		$data = array();

		foreach ($client_ids as $row) {
			$data[] = $this->getClientAvailedServices($row->id);
		}

		return json_encode(array(RESULT => $data));
	}

	public function delete($id){
		echo $this->delete(MODEL_CLIENT_SERVICES, $id);
		echo '<br /><a href="'. base_url().'client_services/' .'">View Client Services</a>';
	}

	public function getClientAvailedServices($id){
		$this->load->model(MODEL_CLIENT_SERVICES);

		$join = array(
			array(
				TABLE     => TABLE_PROF_SERVICES,
				COLUMNS   => SERVICE_ID . "=" . TABLE_PROF_SERVICES . "." . ID,
				JOIN_TYPE => JOIN_RIGHT
			)
		);

		return json_encode(array("client_service" => $this->ClientServiceModel->select(NULL, array(CLIENT_ID => $id), NULL, $join )));
	}

	public function getServiceClients($id){
		$this->load->model(MODEL_CLIENT_SERVICES);

		$join = array(
			array(
				TABLE     => TABLE_CLIENT,
				COLUMNS   => CLIENT_ID . "=" . TABLE_CLIENT . "." . ID,
				JOIN_TYPE => JOIN_RIGHT
			)
		);

		echo json_encode(array(RESULT => $this->ClientServiceModel->select(NULL, array(SERVICE_ID => $id), NULL, $join )));
	}

	public function testLoop(){
		$json = json_decode($this->getClientAvailedServices(1), TRUE);
		foreach ($json['client_service'] as $item) {
			echo 'id ' . $item['id'] . '</br>';
		}
	}

	public function request_list() {
		$data['title']    = 'Request Service | ' . APP_NAME;
		$data['content']  = 'client_services/request_service_list';
		$data['js']      = array(base_url() . 'assets/js/bootstrap-datepicker.js', 
								base_url() . 'assets/js/client_services.js');
		$data['activeId'] = NAV_ACTIVE_ID;
		$this->load->model(MODEL_PROF_SERVICES);
		$data['services'] = json_encode(array(RESULT => $this->ProfServicesModel->select()));

		$this->load->view($this->layout, $data);
	}

	public function add($id) {
		$data['title']    = 'Request Service | ' . APP_NAME;
		$data['content']  = 'client_services/add_edit';
		$data['js']      = array(base_url() . 'assets/js/bootstrap-datepicker.js',
								base_url() . 'assets/js/client_services.js',
								base_url() . 'assets/js/client.js');
		$data['service_id']  =  $id;
		$this->load->model(MODEL_PROF_SERVICES);
		$service = $this->ProfServicesModel->select(null, array(ID=>$id));
		if(count($service) > 0){
			$data['name'] = $service[0]->name;
		}
		$data['activeId'] = NAV_ACTIVE_ID;

		$this->load->view($this->layout, $data);
	}

	public function update($id) {
		$data['title']    = 'Request Service | ' . APP_NAME;
		$data['content']  = 'client_services/add_edit';
		$data['js']      = base_url() . 'assets/js/bootstrap-datepicker.js';
		$data['js']          = base_url() . 'assets/js/client.js';
		$data['id']  =  $id;
		$service = $this->selectService($id);
		$service = json_decode($service, true);
		if( count($service[RESULT]) > 0){
			$data['service'] = $service[RESULT][0];
		}
		$data['activeId'] = NAV_ACTIVE_ID;

		$this->load->view($this->layout, $data);
	}

	public function selectService($id){
		$this->load->model(MODEL_CLIENT_SERVICES);

		$join = array(
			array(
				TABLE     => TABLE_PROF_SERVICES,
				COLUMNS   => SERVICE_ID . "=" . TABLE_PROF_SERVICES . "." . ID,
				JOIN_TYPE => JOIN_RIGHT			)
		);

		return json_encode(array(RESULT => $this->ClientServiceModel->select(NULL, array(TABLE_CLIENT_SERVICES . "." . ID => $id), NULL, $join )));
	}

	//******************** API CALLS ********************
	public function api_getClientAvailedServices($id = NULL) {
		if($this->requestFilter() == TRUE){
			echo $this->getClientAvailedServices($id);
		}
	}
}

/* End of file client_services.php */
/* Location: ./application/controllers/client_services.php */
