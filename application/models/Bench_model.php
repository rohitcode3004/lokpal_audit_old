<?php 

class Bench_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/

		
		function getPartc($ref_no)
		{ 
			$sql = "select * from public_servant_partc where ref_no='$ref_no' ";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
			return $query1;

		}

		function getRefNo($filing_no)
		{ 
			$sql = "select ref_no from complainant_details_parta where filing_no='".$filing_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			

		}


		public function getBenchNature(){					
			$sql = "select * from bench_nature";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}
		public function getJudge(){					
			$sql = "select * from judge_master where judge_type='J'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}

		public function getAd_Judge(){					
			$sql = "select * from judge_master where judge_type='M'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}

		public function getCh_Judge(){					
			$sql = "select * from judge_master where judge_type='C'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}

		function bench_composition($bench_compose){ 	
			$this->db->insert('bench', $bench_compose);
			return $this->db->insert_id();
			//return ($this->db->affected_rows() != 1) ? false : true;

		}

		function bench_composition_mod($bench_compose, $bid){ 	
			$this->db->where('id', $bid);
			$this->db->update('bench', $bench_compose); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;  

		}

		function judge_composition($judge_compose){ 	
			$this->db->insert('bench_judge', $judge_compose);
			//return $this->db->insert_id();
			return ($this->db->affected_rows() != 1) ? false : true;

		}

		function complaint_listing($listing_data){ 	
			$this->db->insert('case_allocation', $listing_data);
			//return $this->db->insert_id();
			return ($this->db->affected_rows() != 1) ? false : true;

		}


		public function getOfficebearParty($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}



		public function getAddparty($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from complainant_addl_parties where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}



		public function getWitness($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from public_servantpartc_witness where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}


		public function getAddWitness($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from public_servantpartc_witness where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}

		public function getFormadatb($refe_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from complainant_addl_partb1 where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}


		public function getfarmbPartc($refe_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

			$sql = "select * from public_servantpartc_witness where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}



		public function getOfficebeare($refe_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	
/*
   			$sql = "select * from complainant_addl_partb2 where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			*/

			$sql = "select * from complainant_addl_partb2
			LEFT JOIN gender ON gender.gender_id = complainant_addl_partb2.ob_gender_id
			LEFT JOIN salutation ON salutation.salutation_id = complainant_addl_partb2.ob_salutation_id
			LEFT JOIN country ON country.country_id = complainant_addl_partb2.ob_nationality_id
			LEFT JOIN identity_proof ON identity_proof.identity_proof_id = complainant_addl_partb2.ob_identity_proof_id
			LEFT JOIN identity_residence_proof ON identity_residence_proof.idres_proof_id = complainant_addl_partb2.ob_idres_proof_id
			where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}


		public function getAddparties($refe_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	
 			/*
   			$sql = "select * from complainant_addl_parties where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;*/

			$sql = "select * from complainant_addl_parties
			LEFT JOIN gender ON gender.gender_id = complainant_addl_parties.affect_gender_id
			LEFT JOIN country ON country.country_id = complainant_addl_parties.affect_country_id
			where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;

			

		}




/*
 function getUserName($ui)
 	{ 
      // echo  $ui;die;
	  $sql = "select * from users where id=".$ui."";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
	 return $query1;
	    
	}*/




	function getPartbdata($refe_no)
	{ 
		$sql = "select * from complainant_addl_partb1 where ref_no='$refe_no' ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getPartc_Witness($refe_no)
	{ 
	 // $sql = "select * from public_servantpartc_witness where ref_no='$refe_no' ";
		// 	$query = $this->db->query($sql);
		// 	$query1 = $query->row_array();
	 // return $query1;

		$sql = "select * from public_servantpartc_witness
		LEFT JOIN gender ON gender.gender_id = public_servantpartc_witness.w_gender_id
		LEFT JOIN country ON country.country_id = public_servantpartc_witness.w_country_id
		where ref_no='".$refe_no."'";
		$query 	= $this->db->query($sql)->result();
		return $query;

	}


	function getComplaincapicity($cp)
	{ 
		$sql = "select * from complaint_capacity where complaint_capacity_id=".$cp." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getComplaintMode($cm)
	{ 
		$sql = "select * from complaint_mode where complaintmode_id=".$cm." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getSalutation($st)
	{ 
		$sql = "select * from salutation where salutation_id=".$st." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}


	function getGender($gn)
	{ 
		$sql = "select * from gender where gender_id=".$gn." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}


	function getNationality($na)
	{ 
		$sql = "select * from nationality where nationality_id=".$na." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getIdentity($ide)
	{ 
		$sql = "select * from identity_proof where identity_proof_id=".$ide." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getResidence($rde)
	{ 
		$sql = "select * from identity_residence_proof where idres_proof_id=".$rde." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getPstate($pstate)
	{ 
		$sql = "select name from master_address where state_code =".$pstate." and district_code=0 and sub_dist_code=0 and                        village_code=0 and display='TRUE' order by name asc";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}


	function getPdistrict($pstate,$pdistrict)
	{ 
		$sql = "select name,district_code from master_address where state_code=".$pstate." and
		district_code=".$pdistrict." and sub_dist_code=0 and village_code=0 and display='TRUE' order by name asc";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getPublicsector($psectorid)
	{ 
		$sql = "select * from complaint_capacity where complaint_capacity_id=".$psectorid." ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getSubcategory($psectorid,$subcat)
	{ 
		$sql = "select * from ps_category where comlaint_capacity_id=".$psectorid." and ps_id=".$subcat."";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}


	function getOfficebearedata($ref_no,$modify_party)
	{ 
		$ref_no=$this->session->userdata('ref_no');
		$sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' and ob_party='".$modify_party."'";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;

	}

	function getDiaryNo($cur_year)
	{

		$sql = "select max(diary_no) from counter_filing where cur_year='".$cur_year."' ";
		$query = $this->db->query($sql);
		$query1 = $query->row_array();	
		return $query1;
	}	

	function getCounterFilingdata($ref_no)
	{
		$sql = "select * from counter_filing where ref_no='".$ref_no."'";
		$query = $this->db->query($sql);
		$query1 = $query->row_array(); 
		return $query1;

	}
	function get_presiding($array)
	{
		$p = array_pop(array_reverse($array));
		return $p;
	}

	function getmax_benchno($date)
	{
		$sql = "select max(bench_no) from bench where from_list_date='$date'";
		$query = $this->db->query($sql);
		return $query->row_array();	
	} 

	function getmax_time($date, $court_no)
	{
		$sql = "select max(from_time) from bench where from_list_date='$date' and court_no='$court_no'";
		$query = $this->db->query($sql);
		return $query->row_array();	
	} 

	function get_benches()
	{
		$this->db->select('*');
		$this->db->from('bench');
		$this->db->where('updated_at', NULL);
		$this->db->order_by('bench_no','ASC');


		return $query = $this->db->get();	
	} 

	function get_benches_count()
	{
		$this->db->select('*');
		$this->db->from('bench');
		$this->db->where('updated_at', NULL);
		$this->db->order_by('bench_no','ASC');


		$query = $this->db->get();	
		return $query->num_rows();
	} 

	function get_benche_ids($b_no)
	{
		$this->db->select('id');
		$this->db->from('bench');
		$this->db->where('bench_no', $b_no);
		//$this->db->where('from_list_date', $date);
		//$this->db->where('bench_no', $bn);
		
		return $query = $this->db->get();	
	} 

	function get_judges($id)
	{
		$this->db->select('*');
		$this->db->from('bench_judge');
		$this->db->where('bench_id', $id);
		//$this->db->where('from_list_date', $date);
		//$this->db->where('bench_no', $bn);
		
		return $query = $this->db->get();	
	} 

	function get_judge_name($code)
	{
		$this->db->select('judge_name');
		$this->db->from('judge_master');
		$this->db->where('judge_code', $code);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
		return $this->db->get()->row();
	}

	function get_chairperson_data(){  
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections, D.listed, S.scrutiny_date, P.ps_desig, P.ps_orgn');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('public.public_servant_partc P', 'S.filing_no = P.filing_no');
		$this->db->join('case_detail D', 'S.filing_no = D.filing_no');
		$this->db->where('S.scrutiny_status', 't');
		//$this->db->where('S.objections', 'No');
		$this->db->where('D.listed', 'f');
		$this->db->order_by('S.scrutiny_date','ASC');
		$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function get_report1_data(){  
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections, D.listed, S.scrutiny_date');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('case_detail D', 'S.filing_no = D.filing_no');
		$this->db->where('S.scrutiny_status', 't');
		//$this->db->where('S.objections', 'No');
		$this->db->where('D.listed', 't');
		$this->db->order_by('S.scrutiny_date','ASC');
		$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function casedet_upd($upd_data, $filing_no)
	{ 	
			//$query = $this->db->get('case_detail');
			/*foreach ($query->result() as $row) {
      			$this->db->insert('scrutiny_his',$row);
      		}*/
      		$this->db->where('filing_no', $filing_no);
			//$this->db->where('listed', 'f');//only update when not listed
      		$this->db->update('case_detail', $upd_data); 
			//print_r($r);die;
      		return ($this->db->affected_rows() != 1) ? false : true;   
      	}

      	function get_old_bench($id)
      	{
      		$this->db->select('*');
      		$this->db->from('bench');
      		$this->db->where('id', $id);
      		
      		return $query = $this->db->get()->row();;	
      	} 

      	function get_listing_tot_count()
      	{
      		$this->db->select('id');

      		$query = $this->db->get('case_detail');
      		return $query->num_rows();
      	}

      	function get_listing_pen_count()
      	{
      		$this->db->select('id');
      		$this->db->where('listed', 'f');


      		$query = $this->db->get('case_detail');
      		return $query->num_rows();
      	}

      	function get_listing_don_count()
      	{
      		$this->db->select('id');
      		$this->db->where('listed', 't');

      		$query = $this->db->get('case_detail');
      		return $query->num_rows();
      	}

      	function fetch_cn($filing_no)
      	{
			$this->db->select('complaint_no, complaint_year');
			$this->db->from('case_detail');
			$this->db->where('filing_no', $filing_no);
			return $this->db->get()->row();
      	}

      	function fetch_listing_count($filing_no)
      	{
      		$this->db->select('listing_count');
      		$this->db->from('case_detail');
      		$this->db->where('filing_no', $filing_no);
      		return $this->db->get()->row();
      	}

      	function fetch_bench_nature($code)
      	{
      		$this->db->select('bench_name');
      		$this->db->from('bench_nature');
      		$this->db->where('bench_code', $code);
      		return $this->db->get()->row();
      	}

      	function fetch_bench_nature_code($listing_date, $bench_no)
      	{
      		$this->db->select('bench_nature');
      		$this->db->from('bench');
      		$this->db->where('from_list_date', $listing_date);
      		$this->db->where('bench_no', $bench_no);
      		return $this->db->get()->row();
      	}

      	function get_all_benches($filing_no)
      	{	
		$this->db->select('*');
		$this->db->from('case_allocation A');
		$this->db->join('bench B', 'A.bench_id = B.id');
		$this->db->where('A.filing_no', $filing_no);
		$query = $this->db->get();
      	$count = $query->num_rows(); 
		if($count === 0)
			return 0;
		else
			return $query;
		}

	function search_bench($presiding)
	{
		$this->db->select('*');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('presiding', $presiding);

		//----*----(old-bench-bug) code start----*----
		$ids = array(115,116);
		$this->db->where_not_in('id', $ids);
		//----*----(old-bench-bug) code end----*----

		//Exp: Old bench created with bench no.0 are still present in bench table(id-115,116). Their ids exist in other table so can't be deleted. We can create new bench with same composition so the above code is a neccesity for time being. 

		$query = $this->db->get('bench');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	}

	function search_judges($check_bench, $member_names)
	{
		//$result = True; //bench is present
			//print_r($check_bench);die;
		foreach($check_bench as $row){
				//print_r($row->id);
			$this->db->select('judge_code');
			$this->db->where('bench_id', $row->id);
			$query = $this->db->get('bench_judge');
			$count =  $query->num_rows();
				//if($count === 0)
					//die('invalid bench');
				//else{
			$old_mem = $query->result();
			$old_mem_array = array();
			foreach ($old_mem as $value) 
				$old_mem_array[] = $value->judge_code;
			$s = sizeof($old_mem_array);
			$r = sizeof($member_names);
    				//print_r($row->id);
    				//if($row->id == 69){
  					//	print_r($old_mem_array);
    				//}
					//print_r($old_mem_array);die;
					//$old_mem = json_decode(json_encode($old_mem), TRUE);
					//print_r($old_mem);
					//echo "O".$row->id;
					//die;
			$result = 'found';
			foreach($member_names as $key => $value){
				if(!(in_array($value, $old_mem_array)))
					$result = 'notfound';
			}
				//}
			if($result == 'found' && $s == $r)
				return $row->id."/".$row->bench_no;
			elseif($result == 'found' && $s != $r)
				$result = 'notfound';
		}
		return $result;
	}

	function get_all_judges()
	{
		$this->db->select('*');
		$this->db->from('judge_master');
		//$this->db->where('judge_master.display', 't');
		$this->db->order_by('priority asc');
		
		return $query = $this->db->get();	
	}

	function fetch_bench_details($bn)
	{
		$this->db->select('*');
		$this->db->from('bench');
		$this->db->where('bench_no', $bn);
		
		return $query = $this->db->get();	
	}   

	function fetch_judges_details($bid)
	{
		$this->db->select('*');
		$this->db->from('bench_judge');
		$this->db->where('bench_id', $bid);
		
		return $query = $this->db->get();	
	}

	function get_max_bno(){ 	
		$sql = "select max(bench_no) from bench";
		$query = $this->db->query($sql);
		return $query1 = $query->row_array();	
	}

	function update_bench_his($bid){
		$this->db->where('id', $bid);
		$query = $this->db->get('bench');
		foreach ($query->result() as $row) {
			$this->db->insert('bench_history',$row);
		}
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	function update_judge_his($bid){
		$this->db->where('bench_id', $bid);
		$query = $this->db->get('bench_judge');
		foreach ($query->result() as $row) {
			$this->db->insert('bench_judge_history',$row);
		}
		return ($this->db->affected_rows() != 1) ? false : true;
	}   
	function delete_old_judges($bid)
	{ 	
		$this->db->where('bench_id', $bid);
		$this->db->delete('bench_judge'); 
			//print_r($r);die;
		return ($this->db->affected_rows() >= 1) ? true : false;   
	}  
	function get_total_cases($bid_array)
	{
		//$bid_array = implode(',', $bid_array);
		//$bid_array = (int)$bid_array;
		//die($bid_array);
		//$this->db->select('id');
		//$this->db->where_in('bench_id', $bid_array);
		//$this->db->where('proceeded', 'f');
		//$query = $this->db->get('case_allocation');
		//print_r($query);die;

		$sql1 = "select count(*) from case_allocation where bench_id in(".implode(',',$bid_array).") and proceeded=FALSE";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
		return $query1 = $query1['count'];
	}

	function fetch_memeber_type($code)
	{
		$this->db->select('judge_type ');
		$this->db->from('judge_master');
		$this->db->where('judge_code', $code);
		return $this->db->get()->row();
	}

	function fetch_nofcases_judges($code)
    {
      	$this->db->select('*');
		$this->db->from('case_allocation A');
		$this->db->join('bench_judge J', 'A.bench_id = J.bench_id');
		$this->db->where('J.judge_code', $code);
		$this->db->where('A.proceeded', 'f');
		$query = $this->db->get();
      	return $query->num_rows();
    }

    function fetch_listed_status($filing_no)
		{
			$this->db->select('listed');
			$this->db->from('case_detail');
			$this->db->where('filing_no', $filing_no);
			return $this->db->get()->row();
		}

	function fetch_current_bench_details($listing_date, $filing_no, $bench_id){
		    $this->db->select('*');
            $this->db->where('listing_date', $listing_date);
            $this->db->where('filing_no', $filing_no);
           // $this->db->where('bench_id', $bench_id);
            $query = $this->db->get('case_allocation');

          // echo $this->db->last_query();die;
            if ($query->num_rows() > 0){
                return $query->result();
            }
            else{
                die('No previous bench detail found');
            }
	}

	function fetch_judge_code($code)
		{
			$this->db->select('judge_code');
			$this->db->from('bench_judge');
			$this->db->where('bench_id', $code);
			return $this->db->get()->result_array();
		}

	function fetch_logged_judge_code($id)
	{
		$this->db->select('judge_code');
		$this->db->from('judge_master');
		$this->db->where('user_id', $id);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
		return $this->db->get()->row();
	}

	function fetch_logged_judge_code_pps($id)
	{
		$this->db->select('judge_code');
		$this->db->from('pps_to_judge');
		$this->db->where('user_id', $id);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
		return $this->db->get()->row();
	}


	function fetch_purpose_type()
		{
			$this->db->select('id, name, description');
			$this->db->from('purpose_master');
			$this->db->where('display', 't');
			$this->db->order_by('priority');
			$query = $this->db->get();
			return $query->result();
		}

	function fetch_venues()
		{
			$this->db->select('id, name, description');
			$this->db->from('venues_master');
			$this->db->where('display', 't');
			$this->db->order_by('priority');
			$query = $this->db->get();
			return $query->result();
		}


    function fetch_purpose_name($code)
		{
			$this->db->select('name');
			$this->db->from('purpose_master');
			$this->db->where('id', $code);
			return $this->db->get()->row();
		}

	function fetch_venue_name($code)
		{
			$this->db->select('name');
			$this->db->from('venues_master');
			$this->db->where('id', $code);
			return $this->db->get()->row();
		}

	function update_display_bench($id)
		{
			$data = [
				'display' => 'f',
			];
			$this->db->where('id', $id);
			$this->db->update('bench', $data);
		}

	function get_fresh_count()
      	{
      		$sql1 = "select count(*) from scrutiny s inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			$query1 = $query1['count'];
			//print_r($query1);die;
			$sql2 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE";
			$query2 = $this->db->query($sql2);
			$query2 = $query2->row_array();
			$query2 = $query2['count'];

			return $query1 - $query2;
      	}

    function get_complaints_data($flag){ 
    	if($flag=='F'){ 
			$sql1 = "select * from scrutiny s inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and s.filing_no not in(select distinct(c.filing_no) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE) order by d.complaint_year, d.complaint_no";
		}elseif($flag=='I'){
			$sql1 = "select * from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=1 order by d.complaint_year, d.complaint_no";
		}elseif($flag=='V'){
			$sql1 = "select * from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=2 order by d.complaint_year, d.complaint_no";
		}
		$query 	= $this->db->query($sql1)->result();
		return $query;
		//print_r($query);die;
	}


	function get_pre_inq_count()
      	{
      		$sql1 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join case_proceeding p on s.filing_no=p.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=1";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
      	}

    function get_inv_count()
      	{
      		$sql1 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join case_proceeding p on s.filing_no=p.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=2";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
      	}

    public function getComplaintStatus_data($case_no,$year){	
					
   			//$sql = "select * from case_detail where ack_no='$ack_no' and cur_year='$ackyear' ";
   			 $sql="select complaint_no,complaint_year,filing_no from case_detail where complaint_no='$case_no' and complaint_year='$year' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	 function getpartapartc_detail_data($filing_no)
 	{ 

 		  $sql = "SELECT cdp.first_name,cdp.filing_no,cdp.sur_name,cdp.mid_name,cdp.dt_of_filing,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name,sc.scrutiny_date FROM
			complainant_details_parta cdp
			LEFT JOIN public_servant_partc psc ON psc.filing_no = cdp.filing_no	
			LEFT JOIN scrutiny sc ON sc.filing_no = cdp.filing_no		
			WHERE
			cdp.filing_no = '".$filing_no."'";
		
			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
 }

 function case_status_data($case_no,$year)
 	{ 
 			/*
 		 echo $sql = "SELECT cd.complaint_no,cd.complaint_year,cd.case_status,ca.updated_at,ca.filing_no,ca.purpose,ca.listing_date,ca.bench_no,ca.next_list_date,name FROM	case_detail cd		
			LEFT JOIN case_allocation ca ON ca.filing_no = cd.filing_no	
			LEFT JOIN purpose_master ON purpose_master.id = ca.purpose 		
			WHERE cd.complaint_no = '".$case_no."' and cd.complaint_year = '".$year."'
			ORDER BY ca.updated_at DESC LIMIT 1";die;*/
		 $sql="select complaint_no,complaint_year,filing_no from case_detail where complaint_no='$case_no' and complaint_year='$year' ";
			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
 }


   function case_search_by_complainant_data($name_of_complainant)
 	{ 
 			//echo $sql="select filing_no from complainant_details_parta where first_name like '%$name_of_complainant%' where filing_no !='' ";die;


 			/*echo $sql="select filing_no from complainant_details_parta where first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%'
 			 or mid_name ilike '%$name_of_complainant%' and filing_no!='' ";*/

 			 $sql="SELECT cdp.filing_no,cd.complaint_no,cd.complaint_year FROM complainant_details_parta cdp
 			 RIGHT JOIN case_detail cd ON cd.filing_no = cdp.filing_no 
 			 where cdp.first_name ilike '%$name_of_complainant%' or cdp.sur_name ilike '%$name_of_complainant%'
 			 or cdp.mid_name ilike '%$name_of_complainant%' and cdp.filing_no is not null ";
 			$query 	= $this->db->query($sql)->result();
			return $query;	


 	}

 	  function case_search_by_publicservant_data($name_of_public_servant)
 	{ 
 			// $sql="select filing_no from public_servant_partc where ps_first_name like '%$name_of_public_servant%' where filing_no !='' ";

 			/*  $sql="select filing_no from public_servant_partc where ps_first_name ilike '%$name_of_public_servant%' or ps_sur_name ilike '%$name_of_public_servant%'
 			 or ps_mid_name ilike '%$name_of_public_servant%' and filing_no!=''";*/

 			  $sql="SELECT psc.filing_no FROM case_detail cd
 			 inner JOIN public_servant_partc psc ON psc.filing_no = cd.filing_no
 			 inner JOIN scrutiny s ON s.filing_no = cd.filing_no
 			 where psc.ps_first_name ilike '%$name_of_public_servant%' or psc.ps_sur_name ilike '%$name_of_public_servant%'
 			 or psc.ps_mid_name ilike '%$name_of_public_servant%' and cd.filing_no is not null and s.scrutiny_status=TRUE";



 			$query 	= $this->db->query($sql)->result();
			return $query;	


 	}


 function case_status_filingno_data($filing_no)
  {
  //echo $filing_no;die;
  // $sql="select complaint_no,complaint_year,filing_no from case_detail where filing_no='$filing_no'";


   $sql="select s.filing_no, p.agency_code, p.ordertype_code, a.listing_date, s.remarks, g.flag, s.scrutiny_status,d.listed, d.case_status, p.action, a.bench_id, p.due_date from scrutiny s inner join case_detail d on s.filing_no=d.filing_no left join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE left join case_proceeding p on s.filing_no=p.filing_no left join agency_data g on s.filing_no=g.filing_no where s.scrutiny_status=TRUE and s.filing_no='".$filing_no."'";

$query = $this->db->query($sql)->result();
return $query;
//$this->db->query_times; die;

  }

    function fetch_clist_date($fn)
	{
		$this->db->select('listing_date');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		$this->db->where('proceeded', 'f');
		$query = $this->db->get('case_allocation');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	}

	function fetch_cpurpose($fn)
	{
		$this->db->select('purpose');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		$this->db->where('proceeded', 'f');
		$query = $this->db->get('case_allocation');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();
	} 

//ysc code start here 8july


	function get_opportunity_ps_after_pi_receive_count()
      	{
      		 $sql1 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join case_proceeding p on s.filing_no=p.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=3";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
      	}


      	function get_opportunity_ps_after_inq_receive_count()
      	{
      		 $sql1 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join case_proceeding p on s.filing_no=p.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=7";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
      	}

      	function get_any_other_action_count_data()
      	{
      		 $sql1 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join case_proceeding p on s.filing_no=p.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=14";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
      	}


      	 function get_complaints_ops_data($flag){ 
    		if($flag=='PIR'){

			$sql1 = "select * from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=3 order by d.complaint_year, d.complaint_no";
		}elseif($flag=='IR'){
			$sql1 = "select * from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=7 order by d.complaint_year, d.complaint_no";
		}else
			$sql1 = "select * from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=FALSE and p.ordertype_code=14 order by d.complaint_year, d.complaint_no";
		$query 	= $this->db->query($sql1)->result();
		return $query;
		//print_r($query);die;
	}


	//ysc code end here


}