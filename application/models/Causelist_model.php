<?php 

class Causelist_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/

		
	function getBenchJudge($from_list_date)
 	{ 
 		    $sql = "select * from case_allocation
   			LEFT JOIN bench ON bench.id = case_allocation.bench_id

   			where listing_date='".$from_list_date."' ";
   	
   			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
 }

 function getListingJudge($from_list_date)
 	{ 
	
     $sql = "select distinct(case_allocation.bench_no),bench_judge.judge_code, judge_master.judge_name,judge_master.judge_type,bench.presiding from bench_judge
   			LEFT JOIN case_allocation ON case_allocation.bench_id = bench_judge.bench_id
   			LEFT JOIN judge_master ON judge_master.judge_code = bench_judge.judge_code
   			LEFT JOIN bench ON bench.id = case_allocation.bench_id
   			where listing_date='".$from_list_date."' and proceeded='false' ";  			
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	    
 }

 function getCaseAllocationData($from_list_date)
 	{ 

 		 $sql = "SELECT ca.filing_no, ca.listing_date,ca.bench_no,ca.proceeded,cdp.ref_no, cdp.first_name,cdp.sur_name,cdp.mid_name,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name FROM
			case_allocation ca
			LEFT JOIN complainant_details_parta cdp ON cdp.filing_no = ca.filing_no
			LEFT JOIN public_servant_partc psc ON cdp.filing_no = psc.filing_no
			WHERE
			listing_date = '".$from_list_date."' and ca.proceeded='false'";
		
			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
 }


  function getpartCdisplay($ref_no)
 	{ 
	 $sql = "select ps_first_name,ps_sur_name,ps_mid_name from public_servant_partc where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
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

	function fetch_allocation_cases($bi, $ld, $purpose_code, $venue)
	{  
		//$sql1 = "select * from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join bench b on a.bench_id=b.id where d.listed=TRUE and a.listing_date='".$ld."' and a.bench_id='".$bi."' and a.purpose='".$purpose_code."' and a.venue='".$venue."' order by d.complaint_year, d.complaint_no";
		$sql1 = "select * from case_allocation a inner join case_detail d on a.filing_no=d.filing_no inner join bench b on a.bench_id=b.id where d.listed=TRUE and a.listing_date='".$ld."' and a.bench_id='".$bi."' and a.purpose='".$purpose_code."' and a.venue='".$venue."' order by d.complaint_year, d.complaint_no";
		$query 	= $this->db->query($sql1)->result();
		return $query;
	}

	function fetch_all_benches()
	{  
		$this->db->select('*');
		$this->db->from('bench');
		$query = $this->db->get();
		return $query->result();
	}
	

 
}