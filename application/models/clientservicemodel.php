<?php

class ClientServiceModel extends BaseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = TABLE_CLIENT_SERVICES;
    }
}

?>