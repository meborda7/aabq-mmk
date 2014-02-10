<?php

class ClientModel extends BaseModel {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->table = TABLE_CLIENT;
	}

	function checkData($input_data = NULL) {
		$data = array();
		if ($input_data != NULL) {
			$fname   = strip_tags($this->input->post(FNAME));
			$lname   = strip_tags($this->input->post(LNAME));
			$uname   = strip_tags($this->input->post(UNAME));
			$pwd     = strip_tags($this->input->post(PWD));
			$address = strip_tags($this->input->post(ADDRESS));
			$email   = strip_tags($this->input->post(EMAIL));
			$contact = strip_tags($this->input->post(CONTACT));
			$flag    = TRUE;

			if( !$this->IsNullOrEmptyString($fname) ){
				$data[FNAME] = $fname;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($lname) ){
				$data[LNAME] = $lname;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($pwd) ){
				$data[PWD] = $pwd;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($uname) ){
				$data[UNAME] = $uname;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($address) ){
				$data[ADDRESS] = $address;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($email) ){
				$data[EMAIL] = $email;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($contact) ){
				$data[CONTACT] = $contact;
			} else {
				$flag = FALSE;
			}

			if( $flag  && $uname != NULL && !$this->isExistingUsername($uname) /*&& $pwd != NULL*/){
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
				return $data;
			} else if ( $flag == TRUE && isset($data) ) {
				return $data;
			}
		}

		return FALSE;
	}

	public function isExistingUsername($uname = NULL){
		if($uname != NULL){
			$this->load->model(MODEL_CLIENT);
			$result = $this->ClientModel->select(null, array(UNAME=>$uname));
			if($result != NULL && count($result) > 0){
				return TRUE;
			}
		}
		return FALSE;
	}
}

?>
