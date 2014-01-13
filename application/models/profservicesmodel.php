<?php

class ProfServicesModel extends BaseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = TABLE_PROF_SERVICES;
    }
}

?>