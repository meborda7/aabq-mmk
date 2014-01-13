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

class Client extends BaseController {

	public function index() {
		$data['title']    = 'Client | ' . APP_NAME;
		$data['content']  = 'client/content_client';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = 1;
		$data['clients']  = $this->selectAll();
		$this->load->view($this->layout, $data);
	}

	public function add() {
		$data['title']    = 'Add New CLient | ' . APP_NAME;
		$data['content']  = 'client/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = 1;
		$this->load->view($this->layout, $data);
	}

	public function update($id) {
		$data['title']    = 'Update CLient | ' . APP_NAME;
		$data['content']  = 'client/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = 1;
		$this->load->view($this->layout, $data);
	}
	
	public function register(){
		$this->load->model(MODEL_CLIENT);
		
		$fname = strip_tags($this->input->post(FNAME));
        $lname = strip_tags($this->input->post(LNAME));
        $uname = strip_tags($this->input->post(UNAME));
        $pwd = strip_tags($this->input->post(PWD));		
        $address = strip_tags($this->input->post(ADDRESS));
        $email = strip_tags($this->input->post(EMAIL));
        $contact = strip_tags($this->input->post(CONTACT));
		
		if( $uname != NULL && !$this-> isExistingUsername($uname) && $pwd != NULL){
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
		}
		else {
			echo json_encode(array(RESULT => FALSE));
		}
	}
	
	public function modify(){
		$this->load->model(MODEL_CLIENT);     
		$id = strip_tags($this->input->post(ID));	
		$fname = strip_tags($this->input->post(FNAME));	
        $lname = strip_tags($this->input->post(LNAME));
        $uname = strip_tags($this->input->post(UNAME));
        $address = strip_tags($this->input->post(ADDRESS));
        $email = strip_tags($this->input->post(EMAIL));
        $contact = strip_tags($this->input->post(CONTACT));
		$data = array(); 
		if( !$this->IsNullOrEmptyString($fname) ){
			$data[FNAME] = $fname;
		}
		if( !$this->IsNullOrEmptyString($lname) ){
			$data[lname] = $lname;
		}
		if( !$this->IsNullOrEmptyString($uname) ){
			$data[uname] = $uname;
		}
		if( !$this->IsNullOrEmptyString($address) ){
			$data[address] = $address;
		}
		if( !$this->IsNullOrEmptyString($email) ){
			$data[email] = $email;
		}
		if( !$this->IsNullOrEmptyString($contact) ){
			$data[contact] = $contact;
		}				
		if( isset($data) ){
			echo json_encode(array(RESULT => $this->ClientModel->update($data, array(ID=>$id))));
		} else {
			echo json_encode(array(RESULT => FALSE));
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
		echo json_encode(array(RESULT => $this->ClientModel->select(null, array(ID=>$id))));	
	}
	
	public function deleteClient($id){
		$this->load->model(MODEL_CLIENT);          	
		echo json_encode(array(RESULT => $this->ClientModel->delete(array(ID=>$id))));
	}
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */