<?php 

class Search_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/

		
		
		public function getComplaintStatus($case_no,$year){	

   			//$sql = "select * from case_detail where ack_no='$ack_no' and cur_year='$ackyear' ";
			$sql="select complaint_no,complaint_year,filing_no from case_detail where complaint_no='$case_no' and complaint_year='$year' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}

		function getpartapartc_detail($filing_no)
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

		function case_status($case_no,$year)
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


		function case_search_by_complainant($name_of_complainant)
		{ 
 			/* $sql="select filing_no from complainant_details_parta where first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%'
 			or mid_name ilike '%$name_of_complainant%' and filing_no!='' ";*/

 			$sql="select filing_no from complainant_details_parta where (first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%' or mid_name ilike '%$name_of_complainant%') and filing_no is not null ";

 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}

 		function case_search_by_complainant_leg($name_of_complainant)
 		{ 
 			/* $sql="select filing_no from complainant_details_parta where first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%'
 			or mid_name ilike '%$name_of_complainant%' and filing_no!='' ";*/ 			
 			 $sql="select * from legacy_data where (first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%' or mid_name ilike '%$name_of_complainant%') ";

 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}

 		function case_search_by_publicservant($name_of_public_servant)
 		{ 
 			/* $sql="select filing_no from public_servant_partc where ps_first_name ilike '%$name_of_public_servant%' or ps_sur_name ilike '%$name_of_public_servant%'
 			or ps_mid_name ilike '%$name_of_public_servant%' and filing_no!=''";*/

 			$sql="select filing_no from public_servant_partc where (ps_first_name ilike '%$name_of_public_servant%' or ps_sur_name ilike '%$name_of_public_servant%'
 			or ps_mid_name ilike '%$name_of_public_servant%') and filing_no is not null";


 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}


 		function case_search_by_publicservant_leg($name_of_public_servant)
 		{ 
 			/* $sql="select filing_no from public_servant_partc where ps_first_name ilike '%$name_of_public_servant%' or ps_sur_name ilike '%$name_of_public_servant%'
 			or ps_mid_name ilike '%$name_of_public_servant%' and filing_no!=''";*/

 			$sql="select * from legacy_data where (ps_first_name ilike '%$name_of_public_servant%' or ps_sur_name ilike '%$name_of_public_servant%'
 			or ps_mid_name ilike '%$name_of_public_servant%') ";


 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}

 		function case_search_by_summary($summary_fact_allegation)
 		{ 
 			$sql="select filing_no from public_servant_partc where sum_facalle ilike '%$summary_fact_allegation%' and filing_no is not null";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}


 		function case_search_by_summary_leg($summary_fact_allegation)
 		{ 
 			$sql="select * from legacy_data where summary ilike '%$summary_fact_allegation%'";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}


 		function case_status_leg($filing_no)
 		{ 
 			echo $sql="select * from legacy_data where filing_no ='".$filing_no."'";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}

 		function case_search_by_department($department_name)
 		{ 
 			$sql="select filing_no,ps_orgn from public_servant_partc where ps_orgn ilike '%$department_name%' and filing_no is not null ";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}

 		function case_search_by_department_leg($department_name)
 		{ 
 			$sql="select * from legacy_data where ps_orgn ilike '%$department_name%'";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	


 		}


 		function case_search_by_date($dt_of_filing_from,$dt_of_filing_to)
 		{ 
 			echo $sql="select filing_no from complainant_details_parta where dt_of_filing BETWEEN '%$dt_of_filing_from%' and '$dt_of_filing_to' ";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	
 		}

 		function case_search_by_date_leg($dt_of_filing_from,$dt_of_filing_to)
 		{ 
 			echo $sql="select * from legacy_data where dt_of_complaint BETWEEN '%$dt_of_filing_from%' and '$dt_of_filing_to' ";
 			$query 	= $this->db->query($sql)->result();
 			return $query;	
 		}

 		function case_status_filingno($filing_no)
 		{
  //echo $filing_no;die;
  // $sql="select complaint_no,complaint_year,filing_no from case_detail where filing_no='$filing_no'";


 			$sql="SELECT cdp.first_name,cdp.filing_no,cdp.sur_name,cdp.mid_name,cdp.dt_of_filing,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name,psc.ps_orgn,psc.sum_facalle FROM
 			public_servant_partc psc
 			INNER JOIN complainant_details_parta cdp ON cdp.filing_no = psc.filing_no
 			WHERE psc.filing_no = '$filing_no'";


 			$query = $this->db->query($sql)->result();
 			return $query;
//$this->db->query_times; die;

 		}


 	}