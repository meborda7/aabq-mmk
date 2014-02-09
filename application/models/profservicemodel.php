<?php

class ProfServiceModel extends BaseModel {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = TABLE_PROF_SERVICES;
    }
	
	function checkData($input_data = NULL){		
		$data        = array();
		if($input_data != NULL){
			$name        = strip_tags($input_data[NAME]);
			$description = strip_tags($input_data[DESCRIPTION]);
			$price       = strip_tags($input_data[PRICE]);
			$remarks     = strip_tags($input_data[REMARKS]);
			$discount    = strip_tags($input_data[DISCOUNT]);
			$sla         = strip_tags($input_data[SLA]);
			$flag        = TRUE;

			if( !$this->IsNullOrEmptyString($name) ){
				$data[NAME] = $name;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($description) ){
				$data[DESCRIPTION] = $description;
			} else {
				$flag = FALSE;
			}

			if( !$this->IsNullOrEmptyString($price) ){
				$data[PRICE] = $price;
			}

			if( !$this->IsNullOrEmptyString($remarks) ){
				$data[REMARKS] = $remarks;
			}

			if( !$this->IsNullOrEmptyString($discount) ){
				$data[DISCOUNT] = $discount;
			}

			if( !$this->IsNullOrEmptyString($sla) ){
				$data[SLA] = $sla;
			}

			if ($flag == TRUE) {
				return $data;
			}
		}		
		return FALSE;
	}
}

?>
