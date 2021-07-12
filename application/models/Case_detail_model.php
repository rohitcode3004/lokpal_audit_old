<?php 

class Case_detail_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    function upd_casedet($filing_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);

			$this->db->update('case_detail', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function casedethis_insert($filing_no){
    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('case_detail');
    	foreach ($query->result() as $row) {
          $this->db->insert('case_detail_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

}