<?php 

class Common_model extends CI_Model
{
	public function __construct() 
	{ 
		parent::__construct();
	}
	
		public function getStateName(){

   			$sql = "select name,state_code from master_address where state_code !=0 and district_code=0 and sub_dist_code=0 and 					             village_code=0 and display='TRUE' order by name asc";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


 public function getAddOfficeBycat($mod_party){

 	$ref_no=$this->session->userdata('ref_no');
	 				
   			 $sql = "select * from complainant_addl_partb2 where ref_no='".$ref_no."' and ob_party='".$mod_party."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

 public function getAddpartyBycat($mod_party){

 	$ref_no=$this->session->userdata('ref_no');
	 				
   			 $sql = "select * from complainant_addl_parties where ref_no='".$ref_no."' and add_party='".$mod_party."' and party_cate='1'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	 public function getAddpartyBycat_C($mod_party){

 	$ref_no=$this->session->userdata('ref_no');
	 				
   			 $sql = "select * from complainant_addl_parties where ref_no='".$ref_no."' and add_party='".$mod_party."' and party_cate='2'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


 public function getAddWitnessBycat($mod_party){

 	$ref_no=$this->session->userdata('ref_no');
	 				
   			 $sql = "select * from public_servantpartc_witness where ref_no='".$ref_no."' and witness_detail='".$mod_party."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}
	
	
	/*
	public function getDistrictName(){		
		
   			$sql = "select name,state_code from master_address where state_code !=0 and district_code=0 and sub_dist_code=0 and 					             village_code=0 and display='TRUE' order by name asc";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}*/
	
	public function getDistrictNameByID($stateID){			
   					
			$sql="select name,district_code from master_address where state_code=".$stateID." and district_code!=0	and sub_dist_code=0 			and village_code=0 and display='TRUE' order by name asc";		
			$query 	= $this->db->query($sql)->result();
			return $query;
			
		}
			
 public function getAppletName(){	
					
   			$sql = "select * from master_applicant_type order by applicant_type ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	 public function getFormadata($refe_no){
	 				//echo "in here";	
					//echo $refe_no;
					//die;select * from complainant_details_parta where ref_no='1112871981'	

   			$sql = "select * from complainant_details_parta where ref_no='".$refe_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


 public function getDocumentName(){					
    $sql = "select * from docu_type_master where display='TRUE' order BY docu_name Asc";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}


	public function getComplaint(){	
					
   			$sql = "select * from complaint_capacity";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}



	public function getComplainByID($stateID){	
					
   $sql = "select * from ps_category where comlaint_capacity_id=".$stateID."";
			$query 	= $this->db->query($sql)->result();
			return $query;			
	}


		public function getSalution(){	
					
   			$sql = "select * from salutation";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

public function getGender(){	
					
   			$sql = "select * from gender";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getNationality(){	
					
   			$sql = "select * from nationality";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getIdentityproof(){	
					
   			$sql = "select * from identity_proof";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getComplaintmode(){	
					
   			$sql = "select * from complaint_mode";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getResidence(){	
					
   			$sql = "select * from identity_residence_proof where display='t' ORDER BY idres_proof_desc ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getCountry(){	
					
   			$sql = "select * from country";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}



	public function getDocument_type(){	
					
   			$sql = "select * from identity_document_type order by name_of_doc ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

public function getTitle_type(){	
					
   			$sql = "select * from title_master order by title_name ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	public function getPscategory(){	
					
   			$sql = "select * from ps_category order by ps_id ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;
			
	}

	


	
		
}	
