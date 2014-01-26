<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('ID', 							'id');
define('NAME', 							'name');
define('DESCRIPTION',					'description');
define('PRICE', 						'price');
define('REMARKS', 						'remarks');
define('DISCOUNT', 						'discount');
define('SLA', 							'sla');
define('NAV_ACTIVE_ID',					2);

class Professional_services extends BaseController {

	public function index() {
		$data['title']    = 'Professional Services | ' . APP_NAME;
		$data['content']  = 'prof_services/content_professional_services';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['services'] = $this->selectAll();
        $this->load->view($this->layout, $data);
	}

	public function add() {
		$data['title']    = 'Add New Service | ' . APP_NAME;
		$data['content']  = 'prof_services/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']          = base_url() . 'assets/js/client.js';
		$data['activeId'] = NAV_ACTIVE_ID;
		$this->load->view($this->layout, $data);
	}

	public function update($id) {
		$data['title']        = 'Update Service | ' . APP_NAME;
		$data['content']      = 'prof_services/add_edit';
		$data['css']          = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']          = base_url() . 'assets/js/client.js';
		$data['activeId']     = NAV_ACTIVE_ID;
		$data['service_data'] = $this->select($id);
		$this->load->view($this->layout, $data);
	}

	public function register(){
		$this->load->model(MODEL_PROF_SERVICES);

		$name        = strip_tags($this->input->post(NAME));
		$description = strip_tags($this->input->post(DESCRIPTION));
		$price       = strip_tags($this->input->post(PRICE));
		$remarks     = strip_tags($this->input->post(REMARKS));
		$discount    = strip_tags($this->input->post(DISCOUNT));
		$sla         = strip_tags($this->input->post(SLA));
		$flag = TRUE;
		$data    = array();
		$error_msg = array();
		
		if( !$this->IsNullOrEmptyString($name) ){
			$data[NAME] = $name;
			$error_msg[NAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[NAME] = ERROR_MSG;
		}
		
		if( !$this->IsNullOrEmptyString($description) ){
			$data[DESCRIPTION] = $description;
			$error_msg[DESCRIPTION] = "";
		} else {
			$flag = FALSE;
			$error_msg[DESCRIPTION] = ERROR_MSG;
		}
		
		if( !$this->IsNullOrEmptyString($price) ){
			$data[PRICE] = $price;
		} 
		
		if( !$this->IsNullOrEmptyString($remarks) ){
			$data[REMARKS] = $remarks;
		} 
		
		if( !$this->IsNullOrEmptyString($discount) ){
			$data[DISCOUNT] = $discount;
		} 
		
		if( !$this->IsNullOrEmptyString($sla) ){
			$data[SLA] = $sla;
		} 

		if ($flag == TRUE) {	
			echo json_encode(array(RESULT => $this->ProfServicesModel->insert($data)));
		} else {
			echo json_encode(array(RESULT => FALSE));
		}

		echo '<br /><a href="'. base_url().'professional_services/' .'">View Professional Services</a>';
	}
	
	public function selectAll() {
		$this->load->model(MODEL_PROF_SERVICES);
		return json_encode(array(RESULT => $this->ProfServicesModel->select()));
    }
	
	public function select($id){
		$this->load->model(MODEL_PROF_SERVICES);
		return json_encode(array(RESULT => $this->ProfServicesModel->select(null, array(ID=>$id))));
	}

	public function delete($id){
		$this->load->model(MODEL_PROF_SERVICES);
		echo json_encode(array(RESULT => $this->ProfServicesModel->delete(array(ID=>$id))));
		echo '<br /><a href="'. base_url().'professional_services/' .'">View Professional Services</a>';
	}

	public function modify(){
		$this->load->model(MODEL_PROF_SERVICES);
		$id       = strip_tags($this->input->post(ID));
		$name     = strip_tags($this->input->post(NAME));
		$desc     = strip_tags($this->input->post(DESCRIPTION));
		$price    = strip_tags($this->input->post(PRICE));
		$remarks  = strip_tags($this->input->post(REMARKS));
		$discount = strip_tags($this->input->post(DISCOUNT));
		$sla      = strip_tags($this->input->post(SLA));
		$data     = array();
		if( !$this->IsNullOrEmptyString($name) ){
			$data[NAME] = $name;
		}
		if( !$this->IsNullOrEmptyString($desc) ){
			$data[DESCRIPTION] = $desc;
		}
		if( !$this->IsNullOrEmptyString($price) && is_numeric($price)){
			$data[PRICE] = $price;
		}

		// remarks can be null
		$data[REMARKS] = $remarks;

		if( !$this->IsNullOrEmptyString($discount) && is_numeric($discount)){
			$data[DISCOUNT] = $discount;
		}
		if( !$this->IsNullOrEmptyString($sla) ){
			$data[SLA] = $sla;
		}
		if( isset($data) ){
			echo json_encode(array(RESULT => $this->ProfServicesModel->update($data, array(ID=>$id))));
		} else {
			echo json_encode(array(RESULT => FALSE));
		}

		echo '<br /><a href="'. base_url().'professional_services/' .'">View Professional Services</a>';
	}
}

/* End of file professional_services.php */
/* Location: ./application/controllers/professional_services.php */
