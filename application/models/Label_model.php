<?php
class Label_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function fetch_all()
	{
		$this->db->order_by('id', 'ASC');
		return $this->db->get('labels_master');
	}

	function update_element($element_id, $data)
	{
		$this->db->where('id', $element_id);
		$this->db->update('labels_master', $data);
	}

	function insert_element($data)
	{
		$this->db->insert('labels_master', $data);
	}

	function fetch_single_element($element_id)
	{
		$this->db->where('id', $element_id);
		$query = $this->db->get('labels_master');
		return $query->result_array();
	}

//client own function
	public function get_element($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('labels_master');
			return $query->result_array();
		}

		$query = $this->db->get_where('labels_master', array('level_master_id' => $slug));
		return $query->result_array();
	}
}
?>