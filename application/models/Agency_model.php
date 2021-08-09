<?php 

class Agency_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_agency_data($roleid)
	{  
		$agncode = get_agncode($roleid);
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, P.filing_no, P.action, P.listing_date, P.bench_nature, P.bench_no, P.order_date, P.remarks');
		$this->db->from('case_proceeding P');
		$this->db->join('complainant_details_parta C', 'P.filing_no = C.filing_no');
		$this->db->where('P.action', 'f');
		$this->db->where_in('P.agency_code', $agncode);
		$query = $this->db->get();
		return $query->result();
	}

	function get_agency_data_bench($bench_ids, $flag)
	{  
		//$agncode = get_agncode($roleid);
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, A.filing_no, A.flag, A.listing_date, A.bench_no, P.bench_id');
		$this->db->from('agency_data A');
		$this->db->join('complainant_details_parta C', 'A.filing_no = C.filing_no');
		$this->db->join('case_proceeding P', 'A.filing_no = P.filing_no');
		$this->db->where('A.flag', 1);
		$this->db->where('P.action', 't');
		$this->db->where_in('P.bench_id', $bench_ids);
		//$this->db->where_in('P.agency_code', $agncode);
		if($flag == 'RI'){
			$this->db->where('P.ordertype_code', 1);
		}elseif($flag == 'RV'){
			$this->db->where('P.ordertype_code', 2);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result();
	}

	public function getDisplayPar_A($filing_no)
	{ 

		$sql = "select * from complainant_details_parta
		LEFT JOIN identity_proof ON identity_proof.identity_proof_id = complainant_details_parta.identity_proof_id
		LEFT JOIN complaint_capacity ON complaint_capacity.complaint_capacity_id = complainant_details_parta.complaint_capacity_id
		LEFT JOIN complaint_mode ON complaint_mode.complaintmode_id = complainant_details_parta.complaintmode_id
		where filing_no='".$filing_no."'";
		$query 	= $this->db->query($sql)->result();
		return $query;	    
	}

	public function getDisplayPar_C($filing_no)
	{  		
		$sql = "select * from public_servant_partc 
		LEFT JOIN master_address ON master_address.state_code = public_servant_partc.ps_pl_stateid and district_code=0 and sub_dist_code=0 and village_code=0 and display='TRUE'
			
		where filing_no='".$filing_no."'";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}


	public function getProceedingdata($filing_no)
	{	 				
		$sql = "select * from case_proceeding where filing_no='".$filing_no."'";
		$query 	= $this->db->query($sql)->result();
		return $query;			
	}



	function add_agency_data($agency_data_add=NULL){ 	
		$this->db->insert('agency_data', $agency_data_add);
		return true;

	}


	public function getAgencydata($filing_no)
	{	 
		$sql = "select * from agency_data			
		LEFT JOIN bench_nature ON bench_nature.bench_code = agency_data.bench_code
		where filing_no='".$filing_no."'";
		$query 	= $this->db->query($sql)->result();
		return $query;			
	}


	public function getAgencydata_his($filing_no)
	{	 
		 $sql = "select * from agency_data_his			
		LEFT JOIN bench_nature ON bench_nature.bench_code = agency_data_his.bench_code
		where filing_no='".$filing_no."'";		
		$query 	= $this->db->query($sql)->result();
		return $query;			
	}

	function insert_agency_data_his($filing_no){		
		$sql="select * from agency_data where filing_no='".$filing_no."'";    
		$query 	= $this->db->query($sql)->result();   
		foreach ($query as $row) {    	
			$this->db->insert('agency_data_his',$row);
		}
	}

	function modify_agency_data($agency_data_modify=NULL, $user_id,$filing_no){ 	

		$this->db->where('filing_no', $filing_no);
		$this->db->where('user_id', $user_id);
		$update = $this->db->update('agency_data', $agency_data_modify);
		return true;

	}

	function get_agency_tot_count($roleid)
		{
			$agncode = get_agncode($roleid);
			$this->db->select('filing_no');
			$this->db->from('case_proceeding');
			$this->db->where_in('agency_code', $agncode);

			$query = $this->db->get();
			return $query->num_rows();
		}

	function get_agency_pen_count($roleid)
		{
			$agncode = get_agncode($roleid);
			$this->db->select('id');
			$this->db->where('action', 'f');
			$this->db->where_in('agency_code', $agncode);

			$query = $this->db->get('case_proceeding');
			return $query->num_rows();
		}

	function get_agency_don_count($roleid)
		{
			$agncode = get_agncode($roleid);
			$this->db->select('filing_no');
			$this->db->where('action', 't');
			$this->db->where_in('agency_code', $agncode);

			$query = $this->db->get('case_proceeding');
			return $query->num_rows();
		}

	function upd_proce($filing_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);

			$this->db->update('case_proceeding', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;  
		}

	function get_agency_master($roleid)
		{
			$this->db->select('agency_code');
			$this->db->from('agency_master');
			$this->db->where('roleid', $roleid);
			$query = $this->db->get();
			return $query->result();
		}

	function casedethis_insert($filing_no){
    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('case_detail');
    	foreach ($query->result() as $row) {
          $this->db->insert('case_detail_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

    function upd_casedet($filing_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);

			$this->db->update('case_detail', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function upd_agency_data($filing_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);

			$this->db->update('agency_data', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function fetch_agency_count($filing_no)
		{
			$query = $this->db->get_where('agency_data', array(//making selection
            'filing_no' => $filing_no
        ));
			//$query = $this->db->get();
			$count = $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->row();
		}

		public function delete_agencydata($id){
	    $this->db->where('filing_no', $id);
	    $this->db->delete('agency_data');
	    return ($this->db->affected_rows() != 1) ? false : true;
	}

	 function fetch_agname($code)
		{
			$this->db->select('agency_name');
			$this->db->from('agency_master');
			$this->db->where('agency_code', $code);
			return $this->db->get()->row();
		}

	 function fetch_ordertype($code)
		{
			$this->db->select('ordertype_name');
			$this->db->from('ordertype_master');
			$this->db->where('ordertype_code', $code);
			return $this->db->get()->row();
		}
		function get_agency_data_bench_count()
	{  
		//$agncode = get_agncode($roleid);
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, A.filing_no, A.flag, A.listing_date, A.bench_no, P.bench_id');
		$this->db->from('agency_data A');
		$this->db->join('complainant_details_parta C', 'A.filing_no = C.filing_no');
		$this->db->join('case_proceeding P', 'A.filing_no = P.filing_no');
		$this->db->where('A.flag', 1);
		$this->db->where('P.action', 't');
		//$this->db->where_in('P.agency_code', $agncode);
		$query = $this->db->get();
		return $query->num_rows();
	}

	
		function ins_orders_agency_report($insert_data)
		{
			$this->db->insert('orders_agency_report',$insert_data);
    		return ($this->db->affected_rows() != 1) ? false : true;
		}


		public function getAnyOtherData($filing_no)
	{	 
		$query = $this->db->get_where('public_servant_detail', array(//making selection
            'filing_no' => $filing_no
        ));
			//$query = $this->db->get();
			$count = $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();	
	}


		public function getAnyOtherData_report($filing_no)
	{	 
		$query = $this->db->get_where('any_other_action_detail', array(//making selection
            'filing_no' => $filing_no
        ));
			//$query = $this->db->get();
			$count = $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();	
	}
}


