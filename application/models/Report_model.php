<?php 

class Report_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/

		
	public function getObdata($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			 $sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' and office_bearer_organisation='1'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


	function getParta()
 	{ 
	  $this->db->select("ref_no,complaint_capacity_id,first_name,sur_name,complaintmode_id");
  $this->db->from('complainant_details_parta');
  $query = $this->db->get();
  return $query->result();
	    
 }


 public function getOfficebearParty_data($ref_no){
	 		$sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

		public function getOfficebearParty($ref_no,$office_bearer_organisation){
			//echo $office_bearer_organisation;die;	
			if($office_bearer_organisation==1)
			{
				$sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' and office_bearer_organisation='1'";
			}
			else
			{

				$sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' and office_bearer_organisation='2'";
			}

			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}



 public function getAddparty($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			$sql = "select * from complainant_addl_parties where ref_no='".$ref_no."' and party_cate='1'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


 public function getAddparty_c($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			 $sql = "select * from complainant_addl_parties where ref_no='".$ref_no."' and party_cate='2'";
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
   			where ref_no='".$refe_no."' and office_bearer_organisation='1'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	
 public function getAddparties($refe_no){
	 				
			 $sql = "select * from complainant_addl_parties
   			LEFT JOIN gender ON gender.gender_id = complainant_addl_parties.affect_gender_id
   			LEFT JOIN country ON country.country_id = complainant_addl_parties.affect_country_id
   			where ref_no='".$refe_no."' and party_cate='1'";
			$query 	= $this->db->query($sql)->result();
			return $query;
	}

public function getAddparties_partc($refe_no){
	 				
			 $sql = "select * from complainant_addl_parties
   			LEFT JOIN gender ON gender.gender_id = complainant_addl_parties.affect_gender_id
   			LEFT JOIN country ON country.country_id = complainant_addl_parties.affect_country_id
   			where ref_no='".$refe_no."' and party_cate='2'";
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


 	function getPartc($refe_no)
 	{ 
	 $sql = "select * from public_servant_partc where ref_no='$refe_no' ";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
	 return $query1;
	    
 }

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
 /*

 function getSubcategory($ps_id)
 	{ 
	  $sql = "select * from ps_category where ps_id=".$ps_id." ";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
	 return $query1;
	    
 }*/

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




function getAckNo($cur_year)
 	{
 $sql = "select max(ack_no) from counter_filing where cur_year='".$cur_year."' ";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
	 return $query1;
 	}	

function counterfilingadd($counter_filing){ 
	
	 $this->db->insert('counter_filing', $counter_filing);

	//print_r($this->db->last_query()); die;

	
	
	 return true;	    
 }



function getCounterData($ref_no)
 	{
 	 $sql = "select * from counter_filing where ref_no='".$ref_no."'";
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

 	
 function getCounterFilingAllData($userid)
 	{
 	 $sql = "select * from counter_filing where user_id=$userid";
     $query 	= $this->db->query($sql)->result();
			return $query;
 	}

 	
 	function update_complaint_affidavit($ref_no,$affidavit_data){ 	
				
			$this->db->where('ref_no', $ref_no);
			//$this->db->where('user_id', $user_id);
			$this->db->update('complainant_details_parta', $affidavit_data); 

//echo $this->db->last_query();

			//die("@@@@")	;		
			return ($this->db->affected_rows() != 1) ? false : true;

		}


		
 	function update_phisical_copy_complaint($ref_no,$phisical_copy_upload_data){ 	
				
			$this->db->where('ref_no', $ref_no);
			//$this->db->where('user_id', $user_id);
			$this->db->update('complainant_details_parta', $phisical_copy_upload_data); 

//echo $this->db->last_query();

			//die("@@@@")	;		
			return ($this->db->affected_rows() != 1) ? false : true;

		}


		function update_complaint_gazzette_notification($fn,$gazzette_notification_data){ 	
				
				//echo $gazzette_notification_url;
			$this->db->where('filing_no', $fn);
			//$this->db->where('user_id', $user_id);
			$this->db->update('complainant_details_parta', $gazzette_notification_data); 
			//echo $this->db->last_query();
			//die("@@@@")	;		
			return ($this->db->affected_rows() != 1) ? false : true;			
		}

		 public function getAdps_detail($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			$sql = "select * from additional_public_servant_partc where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	function addPsdata($form_ad_ps_detail=NULL){  

			$this->db->insert('additional_public_servant_partc', $form_ad_ps_detail);
			return true;

		}


 public function getAddps_detail($ref_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			$sql = "select * from additional_public_servant_partc where ref_no='".$ref_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getAddPsdetail($mod_party){

 	$ref_no=$this->session->userdata('ref_no');
	 				
   			 $sql = "select * from additional_public_servant_partc where ref_no='".$ref_no."' and ps_detail='".$mod_party."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


	function insert_partC_ps_his($rf_no,$modify_party){		
		$sql="select * from additional_public_servant_partc where ref_no='".$rf_no."' and ps_detail='$modify_party'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();
   
    foreach ($query as $row) {
    	
          $this->db->insert('additional_public_servant_partc_his',$row);
    }
    }

    function PsModify($formmodify,$modify_party){	

			$ref_no=$this->session->userdata('ref_no');
			$array = array('ref_no' => "$ref_no", 'ps_detail' => $modify_party);
			$this->db->where($array);
			$update = $this->db->update('additional_public_servant_partc', $formmodify); 
			return true;

		}

	function getPublic_servant_detail($refe_no)
 	{ 
	 // $sql = "select * from public_servantpartc_witness where ref_no='$refe_no' ";
		// 	$query = $this->db->query($sql);
		// 	$query1 = $query->row_array();
	 // return $query1;

		 $sql = "select * from additional_public_servant_partc
		 	LEFT JOIN salutation ON salutation.salutation_id = additional_public_servant_partc.ad_ps_salutation_id   		
   			LEFT JOIN complaint_capacity ON complaint_capacity.complaint_capacity_id = additional_public_servant_partc.ad_complaint_capacity_id
   			LEFT JOIN ps_category ON ps_category.comlaint_capacity_id = additional_public_servant_partc.ad_complaint_capacity_id and ps_category.ps_id = additional_public_servant_partc.ad_ps_id
   			LEFT JOIN master_address ON master_address.state_code = additional_public_servant_partc.ad_ps_pl_stateid and district_code=0 and sub_dist_code=0 and               village_code=0 and display='TRUE'
   			
   			where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
	    
 }

 public function getRecieved_by(){	
					
   			$sql = "select * from recieved_by_master";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	 public function getMode_by(){	
					
   			$sql = "select * from mode_master";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

 public function getStatus($ack_no,$ackyear){	
					
   			$sql = "select * from counter_filing where ack_no='$ack_no' and cur_year='$ackyear' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}
	 public function getFilingno($ref_no){	
					
   			$sql = "select filing_no from complainant_details_parta where ref_no='$ref_no'; ";
			$query 	= $this->db->query($sql)->result();

			return ($this->db->affected_rows() != 1) ? false : true;   
			//return $query;
			
	}


/*
	 function getPartyDetail($filing_no)
 	{ 

 		 /*$sql = "SELECT cdp.ref_no, cdp.first_name,cdp.sur_name,cdp.mid_name,cdp.filing_no,psc.ps_first_name, psc.ps_mid_name,psc.ps_sur_name FROM
			complainant_details_parta cdp
			LEFT JOIN public_servant_partc psc ON cdp.filing_no = psc.filing_no		
			WHERE cdp.filing_no = '$filing_no'";


		
			$query 	= $this->db->query($sql)->result();
			return $query;			
	    
 }*/

 	function upd_counter_filing($id)
		{ 			
			
			$this->db->where('id', $id);
			$upd_data = array(
									'phisical_copy_received' => 'true',
									//'bench_no' => '1',									
								);
			$this->db->update('counter_filing', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function get_counter_complaints_status($user_id=NULL){  

			$this->db->select('*')->from('complainant_details_parta A')->join('counter_filing C','A.ref_no = C.ref_no');
			if($user_id!=NULL)
			$this->db->where('C.user_id', $user_id);
			//$this->db->where('filing_status',FALSE);
			$this->db->where('C.phisical_copy_received',FALSE);
			//$this->db->or_where('C.phisical_copy_received','FALSE');
			//$this->db->or_where('C.phisical_copy_received','');
			//$this->db->or_where('FirstName','Ola');

			$this->db->order_by('ack_no asc'); 
			//$this->db->order_by('filing_no');
			$query = $this->db->get();
			return $query->result();

		}


 /* code ysc23072021 */

function get_ref_no_count($refe_no)
		{
			
			$this->db->where('ref_no',$refe_no);
		    $query = $this->db->get('complainant_details_parta');
		    if ($query->num_rows() > 0){
		        return $query->result();
		    }
		    else{
		        return 0;
		    }
		}

		function get_ref_no_count_nofificationurl($ref_no)
		{
			
			$this->db->where('ref_no',$ref_no);
		    $query = $this->db->get('complainant_details_parta');
		    if ($query->num_rows() > 0){
		        return $query->result();
		    }
		    else{
		        return 0;
		    }
		}




/* end ysc code 2307 */
 

}