<?php 

class Order_report_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/

		
		
		public function get_all_case($dt_of_order_from,$dt_of_order_to){	

   			//$sql = "select * from case_detail where ack_no='$ack_no' and cur_year='$ackyear' ";

			$sql = "SELECT cp.filing_no,cp.listing_date, cdp.first_name,cdp.sur_name,cdp.mid_name,cdp.dt_of_filing,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name FROM case_proceeding cp			
			LEFT JOIN complainant_details_parta cdp ON cdp.filing_no = cp.filing_no		
			LEFT JOIN public_servant_partc psc ON psc.filing_no = cp.filing_no
			where listing_date BETWEEN '%$dt_of_order_from%' and '$dt_of_order_to'";
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
			$sql="select complaint_no,complaint_year,filing_no from case_detail where complaint_no='$case_no' and complaint_year='$year' ";
			$query 	= $this->db->query($sql)->result();
			return $query;			

		}


		function case_search_by_complainant($name_of_complainant)
		{  			

			$sql="select filing_no from complainant_details_parta where (first_name ilike '%$name_of_complainant%' or sur_name ilike '%$name_of_complainant%' or mid_name ilike '%$name_of_complainant%') and filing_no is not null ";
			$query 	= $this->db->query($sql)->result();
			return $query;	


		}
		

		public function get_all_case_report_comp_no($filing_no){	
			
   			//$sql = "select * from case_detail where ack_no='$ack_no' and cur_year='$ackyear' ";

			$sql = "SELECT cp.filing_no,cp.listing_date, cdp.first_name,cdp.sur_name,cdp.mid_name,cdp.dt_of_filing,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name FROM case_proceeding cp			
			LEFT JOIN complainant_details_parta cdp ON cdp.filing_no = cp.filing_no		
			LEFT JOIN public_servant_partc psc ON psc.filing_no = cp.filing_no
			where cp.filing_no='$filing_no' ";
			$query 	= $this->db->query($sql)->result();
			return $query;	
		}

		


	}