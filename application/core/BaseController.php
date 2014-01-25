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
 * @license
*/

/**
 * Class BaseController
 *
 * @category Core
 * @package  core
 * @author   Meldy Eborda <meborda7@gmail.com>
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

    public function _isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return true; else return false;
    }

	function IsNullOrEmptyString($var){
		return (!isset($var) || trim($var)==='');
	}

    /**
     * Retrieves all data present in the dataModel.
     */
    public function selectAll($dataModel) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->select()));
    }

    /**
     * Retrieves one data value present in the data model.
     */
    public function select($dataModel, $id) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->select(null, array(ID=>$id))));
    }

    /**
     * Removes one data value from the dataModel.
     */
    public function delete($dataModel, $id) {
        $this->load->model($dataModel);
        return json_encode(array(RESULT => $this->$dataModel->delete(array(ID=>$id))));
    }
}
