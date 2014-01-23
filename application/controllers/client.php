<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('ID', 							'id');
define('FNAME', 						'first_name');
define('LNAME', 						'last_name');
define('UNAME', 						'username');
define('PWD', 							'password');
define('ADDRESS', 						'address');
define('EMAIL', 						'email');
define('CONTACT', 						'contact_no');
define('PHOTO', 						'photo');
define('DATE_CREATED', 					'date_created');
define('DATE_MODIFIED', 				'date_modified');
define('NAV_ACTIVE_ID',					1);

class Client extends BaseController {

	public function index() {
		$data['title']    = 'Client | ' . APP_NAME;
		$data['content']  = 'client/content_client';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['clients']  = $this->selectAll();
		$this->load->view($this->layout, $data);
	}

	public function add($update_data = NULL, $error_data = NULL)  {
		$data['title']    = 'Add New CLient | ' . APP_NAME;
		$data['content']  = 'client/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['isModify'] = FALSE;
		if($update_data != NULL){
			$data['client_data'] = $update_data;
			$data['error_data'] = $error_data;
		}
		$this->load->view($this->layout, $data);
	}

	public function update($id, $updateData = NULL, $error_data = NULL) {
		$data['title']       = 'Update CLient | ' . APP_NAME;
		$data['content']     = 'client/add_edit';
		$data['css']         = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId']    = NAV_ACTIVE_ID;
		$data['isModify'] 	 = TRUE;
		if($updateData != null){
			$data['client_data'] = $updateData;
			$data['error_data'] = $error_data;
		} else {
			$data['client_data'] = $this->selectClient($id);
		}
		$this->load->view($this->layout, $data);
	}

	public function register(){
		$this->load->model(MODEL_CLIENT);
		$flag = TRUE;

		$fname   = strip_tags($this->input->post(FNAME));
		$lname   = strip_tags($this->input->post(LNAME));
		$uname   = strip_tags($this->input->post(UNAME));
		$pwd     = strip_tags($this->input->post(PWD));
		$address = strip_tags($this->input->post(ADDRESS));
		$email   = strip_tags($this->input->post(EMAIL));
		$contact = strip_tags($this->input->post(CONTACT));
		$data    = array();
		$error_msg = array();

		if( !$this->IsNullOrEmptyString($fname) ){
			$data[FNAME] = $fname;
			$error_msg[FNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[FNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($lname) ){
			$data[LNAME] = $lname;
			$error_msg[LNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[LNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($pwd) ){
			$data[PWD] = $pwd;
			$error_msg[PWD] = "";
		} else {
			$flag = FALSE;
			$error_msg[PWD] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($uname) ){
			$data[UNAME] = $uname;
			$error_msg[UNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[UNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($address) ){
			$data[ADDRESS] = $address;
			$error_msg[ADDRESS] = "";
		} else {
			$flag = FALSE;
			$error_msg[ADDRESS] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($email) ){
			$data[EMAIL] = $email;
			$error_msg[EMAIL] = "";
		} else {
			$flag = FALSE;
			$error_msg[EMAIL] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($contact) ){
			$data[CONTACT] = $contact;
			$error_msg[CONTACT] = "";
		} else {
			$flag = FALSE;
			$error_msg[CONTACT] = ERROR_MSG;
		}
		
		if( $flag  && $uname != NULL && !$this->isExistingUsername($uname) && $pwd != NULL){
			$pwd = hash ( PASSWORD_ENCODING, $pwd );
			$data = array(
				FNAME 		=> 		$fname,
				LNAME 		=> 		$lname,
				UNAME 		=> 		$uname,
				PWD 		=> 		$pwd,
				ADDRESS 	=> 		$address,
				EMAIL 		=> 		$email,
				CONTACT 	=> 		$contact
			);
			echo json_encode(array(RESULT => $this->ClientModel->insert($data)));
			echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
		}
		else {
			$this->add($data, $error_msg);
		}
	}

	public function modify(){
		$this->load->model(MODEL_CLIENT);
		$flag 	 = TRUE;
		$id      = strip_tags($this->input->post(ID));
		$fname   = strip_tags($this->input->post(FNAME));
		$lname   = strip_tags($this->input->post(LNAME));
		$uname   = strip_tags($this->input->post(UNAME));
		$pwd     = strip_tags($this->input->post(PWD));
		$address = strip_tags($this->input->post(ADDRESS));
		$email   = strip_tags($this->input->post(EMAIL));
		$contact = strip_tags($this->input->post(CONTACT));
		$data    = array();
		$error_msg = array();

		if( !$this->IsNullOrEmptyString($fname) ){
			$data[FNAME] = $fname;
			$error_msg[FNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[FNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($lname) ){
			$data[LNAME] = $lname;
			$error_msg[LNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[LNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($uname) ){
			$data[UNAME] = $uname;
			$error_msg[UNAME] = "";
		} else {
			$flag = FALSE;
			$error_msg[UNAME] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($pwd) ){
			$data[PWD] = $pwd;
			$error_msg[PWD] = "";
		} else {
			$flag = FALSE;
			$error_msg[PWD] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($address) ){
			$data[ADDRESS] = $address;
			$error_msg[ADDRESS] = "";
		} else {
			$flag = FALSE;
			$error_msg[ADDRESS] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($email) ){
			$data[EMAIL] = $email;
			$error_msg[EMAIL] = "";
		} else {
			$flag = FALSE;
			$error_msg[EMAIL] = ERROR_MSG;
		}
		if( !$this->IsNullOrEmptyString($contact) ){
			$data[CONTACT] = $contact;
			$error_msg[CONTACT] = "";
		} else {
			$flag = FALSE;
			$error_msg[CONTACT] = ERROR_MSG;
		}
		
		if( $flag == TRUE && isset($data) ){
			echo json_encode(array(RESULT => $this->ClientModel->update($data, array(ID=>$id))));
			echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
		} else {
			$data[ID] = $id;
			$this->update($id, $data, $error_msg);
		}

	}

	public function isExistingUsername($uname = NULL){
		$this->load->model(MODEL_CLIENT);
		if($uname != NULL){
			$result = $this->ClientModel->select(null, array(UNAME=>$uname));
			if($result != NULL && count($result) > 0){
				return TRUE;
			}
		}
		return FALSE;
	}

	public function selectAll() {
		$this->load->model(MODEL_CLIENT);
		return json_encode(array(RESULT => $this->ClientModel->select()));
	}

	public function selectClient($id){
		$this->load->model(MODEL_CLIENT);
		return json_encode(array(RESULT => $this->ClientModel->select(null, array(ID=>$id))));
	}

	public function deleteClient($id){
		$this->load->model(MODEL_CLIENT);
		echo json_encode(array(RESULT => $this->ClientModel->delete(array(ID=>$id))));
		echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
	}
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */
