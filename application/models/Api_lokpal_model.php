<?php
class Api_lokpal_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	/*function fetch_all()
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
	}*/

	function fetch_single_element($filing_no, $part)
	{
		$this->db->where('filing_no', $filing_no);
		if($part == 'A')
			$query = $this->db->get('complainant_details_parta');
		elseif($part == 'C')
			$query = $this->db->get('public_servant_partc');
		elseif($part == 'B')
			$query = $this->db->get('complainant_addl_partb1');
		return $query->result_array();
	}

	function fetch_complainant_type($code)
    {
      		$this->db->select('complaint_capacity_desc');
      		$this->db->from('complaint_capacity');
      		$this->db->where('complaint_capacity_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_gender($code)
    {
      		$this->db->select('gender_desc');
      		$this->db->from('gender');
      		$this->db->where('gender_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_nationality($code)
    {
      		$this->db->select('nationality_desc');
      		$this->db->from('nationality');
      		$this->db->where('nationality_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_identity_proof($code)
    {
      		$this->db->select('Identity_proof_desc');
      		$this->db->from('identity_proof');
      		$this->db->where('identity_proof_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_residence_proof($code)
    {
      		$this->db->select('idres_proof_desc');
      		$this->db->from('identity_residence_proof');
      		$this->db->where('idres_proof_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_state($code)
    {
      		$this->db->select('name');
      		$this->db->from('master_address');
      		$this->db->where('state_code', $code);
      		$this->db->where('district_code', 0);
      		return $this->db->get()->row();
    }

    function fetch_district($code, $scode)
    {
      		$this->db->select('name');
      		$this->db->from('master_address');
      		$this->db->where('district_code', $code);
      		$this->db->where('sub_dist_code', 0);
      		$this->db->where('village_code', 0);
          $this->db->where('state_code', $scode);
      		return $this->db->get()->row();
    }

    function fetch_country($code)
    {
      		$this->db->select('country_desc');
      		$this->db->from('country');
      		$this->db->where('country_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_complaint_mode($code)
    {
      		$this->db->select('complaintmode_desc');
      		$this->db->from('complaint_mode');
      		$this->db->where('complaintmode_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_salutation($code)
    {
      		$this->db->select('salutation_desc');
      		$this->db->from('salutation');
      		$this->db->where('salutation_id', $code);
      		return $this->db->get()->row();
    }

    function fetch_ps_designation($code)
    {
      		$this->db->select('ps_desc');
      		$this->db->from('ps_category');
      		$this->db->where('ps_id', $code);
      		return $this->db->get()->row();
    }

    //start of witnessess api

   function fetch_witnesses($filing_no)
   {
    $this->db->where('ref_no', $filing_no);
  
      $query = $this->db->get('public_servantpartc_witness');

    return $query->result_array();
   }

   function check_witness_details($code)
    {
      $this->db->select('*');
      $this->db->where('ref_no', $code);


      $query = $this->db->get('public_servantpartc_witness');
      return $query->num_rows();
    }

    function check_third_details($code, $part)
    {
      $this->db->select('*');
      $this->db->where('ref_no', $code);

      if($part == 'B')
        $this->db->where('party_cate', 1);
      elseif($part == 'C')
        $this->db->where('flag', 2);
      $query = $this->db->get('complainant_addl_parties');  
      return $query->num_rows();
    }

    function check_ob_hod_details($code)
    {
      $this->db->select('*');
      $this->db->where('ref_no', $code);


      $query = $this->db->get('complainant_addl_partb2');
      return $query->num_rows();
    }

//client own function
	/*
	public function get_element($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('labels_master');
			return $query->result_array();
		}

		$query = $this->db->get_where('labels_master', array('level_master_id' => $slug));
		return $query->result_array();
	}*/
}
?>