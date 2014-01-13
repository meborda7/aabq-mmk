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
    
    public function _filter() {
        if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")) redirect('auth/login');
    }
    
    public function _isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return true; else return false;
    }
	
	function IsNullOrEmptyString($var){
		return (!isset($var) || trim($var)==='');
	}

}