<?php 

class Discount_response_model extends CI_Model{

	public $tableName;
	public function __construct()
	{
		parent::__construct();
		$this->tableName = "discount_responses";
	}

	public function get_all(){
		return json_encode($this->db->get($this->tableName)->result());
	}

	public function save($data = array()){
		return json_encode($this->db->insert($this->tableName, $data));
	}

	public function update($data = array(), $where = array()){
		return json_encode($this->db->where($where)->update($this->tableName, $data));
	}

	public function delete($where = array()){
		return json_encode($this->db->where($where)->delete($this->tableName));
	}
	
}

?>