<?php 

class Dashboard_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

   public function getCountEtraningsData() 
	{
		$status ='1'; 
		$sql = "SELECT count(id) as id FROM etraining WHERE status = ?";
		$query = $this->db->query($sql, array($status));
		return $query->result_array();
	}
	
	public function getCountTrainingEnqData($curDate=NULL) 
	{
		$con .= "WHERE status='1'";
		
		if($curDate!=''){
			
			$con .= " AND created_on='".$curDate."'";
		}else{
			
			$con.="";
		}	
		
		$sql 		= "SELECT count(*) as id FROM enquiry ".$con;
		$query 		= $this->db->query($sql); 
		return $query->result_array();
	}
	
	public function getCountContactData($curDate=NULL) 
	{
		$con .= "WHERE status='1'";
		
		if($curDate!=''){
			
			$con .= " AND created_on='".$curDate."'";
		}else{
			
			$con.="";
		}	
		
		$sql 		= "SELECT count(*) as id FROM contacts ".$con;
		$query 		= $this->db->query($sql); 
		return $query->result_array();
	}
	
	
	
	
	
	
   public function getCountTotalRegCusData(){
	   
	    //$status ='1'; 
		$sql = "SELECT count(id) as id FROM company";
		$query = $this->db->query($sql);
		return $query->result_array();
	   
	  }
	  
	  
	  public function getTotalTrainingEnrollData($id=NULL,$curDate=NULL){
	   
			if($id!=''){
				$con = " WHERE status=".$id;
			}else{
				$con = "";
				}
	   
	   if($curDate!=''){
			
			$con .= " AND created_on='".$curDate."'";
		}else{
			
			$con.="";
		}	
	   
	   
	   
	        $sql 		= "SELECT count(*) as id FROM etraining_enroll ".$con;
		    $query 		= $this->db->query($sql);
		    $result 	= $query->result_array();
			if(isset($result[0]['id'])) return $result[0]['id'];
			return 0;
	   
	   
	   
	  }
	  
	  public function getTotalTrainedDelegatesData(){
		  
		$sql = "SELECT count(id) as id FROM delegates";
		$query = $this->db->query($sql);
		return $query->result_array();
		  
		 }



      public function getTotalStaffUserData(){
		  
		$sql = "SELECT count(id) as id FROM users";
		$query = $this->db->query($sql);
		return $query->result_array();
		  
		 }
		 
		public function getAllCustomerData(){
		  
		  
		    $sql 		= "SELECT count(*) as id FROM company";
		    $query 		= $this->db->query($sql);
		    $result 	= $query->result_array();
			if(isset($result[0]['id'])) return $result[0]['id'];
			return 0;
		  
		} 
		 public function getOrgCustomerData(){
			 
			$sql 		= "SELECT count(*) as id FROM company where cus_type='1'";
		    $query 		= $this->db->query($sql);
		    $result 	= $query->result_array();
			if(isset($result[0]['id'])) return $result[0]['id'];
			return 0;
		  
		} 
		public function getIndividualCustomerData(){
		  
			$sql 		= "SELECT count(*) as id FROM company where cus_type='2'";
		    $query 		= $this->db->query($sql);
		    $result 	= $query->result_array();
			if(isset($result[0]['id'])) return $result[0]['id'];
			return 0;
		  
		} 
		
		
		
		
		 
}
