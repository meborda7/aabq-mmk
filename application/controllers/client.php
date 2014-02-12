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
		$data['clients']  = $this->selectAll(MODEL_CLIENT);
		$this->load->view($this->layout, $data);
	}

	public function add($update_data = NULL, $error_data = NULL)  {
		$data['title']    = 'Add New CLient | ' . APP_NAME;
		$data['content']  = 'client/add_edit';
		$data['css']      = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
		$data['js']       = base_url() . 'assets/js/client.js';
		$data['isModify'] = FALSE;
		if($update_data != NULL){
			$data['client_data'] = $update_data;
			$data['error_data']  = $error_data;
		}
		$this->load->view($this->layout, $data);
	}

	public function update($id, $updateData = NULL, $error_data = NULL) {
		$data['title']       = 'Update CLient | ' . APP_NAME;
		$data['content']     = 'client/add_edit';
		$data['css']         = base_url() . 'assets/css/bootstrap-theme.min.css';
		$data['js']          = base_url() . 'assets/js/client.js';
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
		
		$data   = $this->input->post();
		$result = FALSE;

		if ($data) {
			$result = $this->ClientModel->insert($data);
			if($result != FALSE) 
				echo json_encode(array(RESULT => $result));
			echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
		}
		if ($result == FALSE) {
			// if there are inappropriate values being inputted, we would like it to be reflected
			// in the UI and display the appropriate error messages..
			$this->add($data, $error_msg);
		}
	}

	public function modify(){
		$this->load->model(MODEL_CLIENT);
		$data   = $this->input->post();
		$result = FALSE;

		if( $data ){
			$id   = strip_tags($this->input->post(ID));
			$result = $this->ClientModel->update($data, array(ID=>$id));
			echo json_encode(array(RESULT => $result));
			echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
		}
		if ($result == FALSE) {
			$data[ID] = $id;
			$this->update($id, $data, $error_msg);
		}
	}

	public function selectClient($id = NULL){
		if( $id != NULL ){
			return $this->select(MODEL_CLIENT, $id);
		}
	}

	public function deleteClient($id = NULL){
		if( $id != NULL ){
			var_dump($id);
			if( is_array($id) ){
				return $this->delete(MODEL_CLIENT, NULL, $id);
			} else{
				return $this->delete(MODEL_CLIENT, $id, NULL);
			}
			echo '<br /><a href="'. base_url().'client/' .'">View Clients</a>';
		}
	}

	public function deleteAllClients(){
		return $this->deleteAll(MODEL_CLIENT);
	}

	//******************** API CALLS ********************//

	public function api_selectAll() {
		if($this->requestFilter() == TRUE){
			echo $this->selectAll(MODEL_CLIENT);
		}
	}

	public function api_selectClient($id = NULL){
		if($this->requestFilter() == TRUE && $id != NULL){
			echo $this->selectClient($id);
		}
	}
	/* sample for delete array
	$.ajax({
        type:'post',
        dataType: 'json',
        url: 'http://localhost/nightjar/client/api_deleteClients',
        data: {
            id : [20,21]
        },
        async: false,
        success:
        function(result){
			alert(result);
        },
        error: function(request, status, error){}
    });
	*/
	public function api_deleteClients(){
		$postData= $this->input->post(ID);
		if($this->requestFilter() == TRUE && $postData != NULL){
			echo $this->deleteClient($postData);
		}
	}

	public function api_deleteAllClients(){
		if($this->requestFilter() == TRUE && $id != NULL){
			echo $this->deleteAllClients();
		}
	}

}

/* End of file client.php */
/* Location: ./application/controllers/client.php */
