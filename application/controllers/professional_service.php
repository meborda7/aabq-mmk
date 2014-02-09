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

class Professional_service extends BaseController {

	public function index() {
		$data['title']        = 'Professional Services | ' . APP_NAME;
		$data['content']      = 'prof_service/content_professional_service';
		$data['css']          = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId']     = NAV_ACTIVE_ID;
		$data['service_data'] = $this->selectAll(MODEL_PROF_SERVICES);
        $this->load->view($this->layout, $data);
	}

	public function add($update_data = NULL, $error_data = NULL) {
		$data['title']    = 'Add New Service | ' . APP_NAME;
		$data['content']  = 'prof_service/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']       = base_url() . 'assets/js/client.js';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['isModify'] = FALSE;
		if ($update_data != NULL) {
			$data['service_data'] = $update_data;
			$data['error_data']   = $error_data;
		}
		$this->load->view($this->layout, $data);
	}

	public function update($id, $updateData = NULL, $error_data = NULL) {
		$data['title']    = 'Update Service | ' . APP_NAME;
		$data['content']  = 'prof_service/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']       = base_url() . 'assets/js/client.js';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['isModify'] = TRUE;
		if($updateData != null){
			$data['service_data'] = $updateData;
			$data['error_data']   = $error_data;
		} else {
			$data['service_data'] = $this->select(MODEL_PROF_SERVICES, $id);
		}
		$this->load->view($this->layout, $data);
	}

	public function register(){
		$this->load->model(MODEL_PROF_SERVICES);

		$data = $this->input->post();
		if($data){	
			$result = $this->ProfServiceModel->insert($data);
			if($result != FALSE) 
			echo json_encode(array(RESULT => $result ));
			echo '<br /><a href="'. base_url().'professional_service/' .'">View Professional Services</a>';
		} else {
			// if there are inappropriate values being inputted, we would like it to be reflected
			// in the UI and display the appropriate error messages..
			$this->add($data, $error_msg);
		}
	}

	public function modify(){
		$this->load->model(MODEL_PROF_SERVICES);
		$data = $this->input->post();
		$id   = strip_tags($this->input->post(ID));
		if( $data ){
			$result = $this->ProfServiceModel->update($data, array(ID=>$id));
			echo json_encode(array(RESULT => $result ));
			echo '<br /><a href="'. base_url().'professional_service/' .'">View Professional Services</a>';
		} else {
			$data[ID] = $id;
			$this->update($id, $data, $error_msg);
		}
	}

	/*
	public function select($id){
		if ($id != NULL) {
			return $this->select(MODEL_PROF_SERVICES, $id);
		}
	}
	*/
	public function delete($id){
		if ($id != NULL) {
			var_dump($id);
			if (is_array($id)) {
				return $this->delete(MODEL_PROF_SERVICES, NULL, $id);
			} else {
				return $this->delete(MODEL_PROF_SERVICES, $id, NULL);
			}
			echo '<br /><a href="'. base_url().'professional_service/' .'">View Professional Services</a>';
		}
	}

	public function deleteAll() {
		return $this->deleteAll(MODEL_PROF_SERVICES);
	}

	//******************** API CALLS ********************//
	public function api_selectAll() {
		if($this->requestFilter() == TRUE) {
			echo $this->selectAll(MODEL_CLIENT);
		}
	}

	public function api_select($id = NULL) {
		if($this->requestFilter() == TRUE && $id != NULL) {
			echo $this->select($id);
		}
	}

	public function api_delete() {
		$postData= $this->input->post(ID);
		if($this->requestFilter() == TRUE && $postData != NULL) {
			echo $this->delete($postData);
		}
	}

	public function api_deleteAll() {
		if($this->requestFilter() == TRUE && $id != NULL) {
			echo $this->deleteAll();
		}
	}
}

/* End of file professional_services.php */
/* Location: ./application/controllers/professional_services.php */
