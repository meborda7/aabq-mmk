<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('NAV_ACTIVE_ID',					0);
//define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FPATH', __FILE__);
define('SELFIE', pathinfo(__FILE__, PATHINFO_BASENAME));
define('PUBPATH',str_replace( "application\controllers\\" . SELFIE,'',FPATH)); // added 

class Home extends BaseController {
    
    public function index() {
		$data['title']    = 'Home | ' . APP_NAME;
		$data['content']  = 'home';
		$data['css']      = base_url() . 'assets/css/bootstrap-min.css';
		$data['activeId'] = NAV_ACTIVE_ID;
        $this->load->view($this->layout, $data);
    }
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */