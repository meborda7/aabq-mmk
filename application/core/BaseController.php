<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * File: BaseController.php
 *
 * PHP version
 *
 * @category Core
 * @package  core
 * @author   Meldy Eborda <meborda7@gmail.com>
 * @author   Ahdzlee Formentera <f.ahdzlee@gmail.com>
 * @license
*/

/**
 * Class BaseController
 *
 * @category Core
 * @package  core
 * @author   Meldy Eborda <meborda7@gmail.com>
 * @author   Ahdzleebee Formentera <f.ahdzlee@gmail.com>
 **/
class BaseController extends CI_Controller {

    public $layout;

    public function __construct() {
        parent::__construct();
        $this->layout = "layout/master";
    }

	
    public function requestFilter(){
		if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")) 
			return FALSE;
		return TRUE;
	}

	/**
	 * Checks if request methos is POST
	 */
    public function isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return TRUE; else return FALSE;
    }

	/**
	 * Checks if string is empty or not
	 */
	function IsNullOrEmptyString($var = NULL){
		return (!isset($var) || trim($var)==='');
	}

    /**
     * Retrieves all data present in the dataModel.
     */
    public function selectAll($dataModel = NULL) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->select()));
    }

    /**
     * Retrieves one data value present in the data model.
     */
    public function select($dataModel = NULL, $id = NULL) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->select(null, array(ID=>$id))));
    }

    /**
     * Removes row/s from the dataModel.
     */
    public function delete($dataModel = NULL, $id = NULL, $ids = NULL) {
        $this->load->model($dataModel);
		if($id != NULL){
			return json_encode(array(RESULT => $this->$dataModel->delete(array(ID=>$id))));
		} else {
			return json_encode(array(RESULT => $this->$dataModel->delete(null, $ids)));			
		}
    }

    /**
     * Removes all rows from the dataModel.
     */
    public function deleteAll($dataModel = NULL) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->deleteAll()));
    }
}
