<?php
/**
* File: BaseModel.php
* 
* PHP version 
*
* @category Core
* @package  core
* @author   Meldy Eborda <meborda7@gmail.com>
* @license  
*/
 
/**
 * Class BaseModel
 *
 * @category Core
 * @package  core
 * @author   Meldy Eborda <meborda7@gmail.com>
 **/
class BaseModel extends CI_Model{
	
	/**
	 * Default constructor; also used to load set database
	 */
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Retrieves data from database
	 *
	 * @access	publicpublicpublicpublicpublic
	 * @param	array
	 * @param	array
	 * @param	array
	 * @param	array
	 * @param	int
	 * @param	int
	 *
	 * @return	array
	 */
	function select($columns = NULL, $conditions = NULL, $group_by = NULL, $join_conditions = NULL, $limit = NULL, $offset = NULL){
	
		if($columns != NULL){
			$this->db->select($columns);
		}
		
		if($conditions != NULL){
			$this->db->where($conditions); 
		}
		
		if($group_by != NULL){
			$this->db->group_by($group_by); 
		}
		
		if($join_conditions != NULL){
			foreach($join_conditions as $arr){
				$this->db->join($arr[TABLE], $arr[COLUMNS], $arr[JOIN_TYPE]);
			}
		}
		
		if(is_numeric($limit) && $limit >= 0){
			if(is_numeric($offset) && $offset >= 0){
				$query = $this->db->get($this->table, $limit, $offset);
			} else {
				$query = $this->db->get($this->table, $limit);
			}
		} else {
			$query = $this->db->get($this->table);		
		}
		return $query->result();
	}
	
	/**
	 * Inserts data from database
	 *
	 * @access	public
	 * @param	array
	 *
	 * @return	
	 */
	function insert($arg_data = NULL){
		if($arg_data != NULL){
			$result=$this->db->insert($this->table,$arg_data);
			return $result;
		}
		return FALSE;
	} 
	
	/**
	 * Updates specific row in the database based on the condition added
	 *
	 * @access	public
	 * @param	array
	 *
	 * @return
	 */
	function update($arg_data = NULL, $conditions = NULL){
		if($arg_data != NULL){
			$this->db->set($arg_data);
			if($conditions != NULL){
				$this->db->where($conditions); 
			}
			$result = $this->db->update($this->table); 
			return $result;
		}
		return FALSE;
	}
    
	/**
	 * Deletes specific row in the database based on the condition added
	 *
	 * @access	public
	 * @param	array
	 *
	 * @return
	 */
    function delete($conditions = NULL) {
		if($conditions != NULL){
			$result=$this->db->delete($this->table, $conditions);
		}
		return FALSE;
    }
	
}

?>