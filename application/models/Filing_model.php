<?php 

class Filing_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
		function add_form_A_filing($form_A_filing=NULL){ 	
			$this->db->insert('complainant_details_parta', $form_A_filing);


			return true;

		}


	function insert_partB_additional_party_his($rf_no,$modify_party){
		
		$sql="select * from complainant_addl_parties where ref_no='".$rf_no."' and add_party='$modify_party'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
	$query 	= $this->db->query($sql)->result();   
    foreach ($query as $row) {    	
          $this->db->insert('complainant_addl_parties_his',$row);
    }
    }



		function additionalpartyModify($formmodify,$modify_party,$party_cate){	

			$ref_no=$this->session->userdata('ref_no');
			$array = array('ref_no' => "$ref_no", 'add_party' => $modify_party,'party_cate'=>$party_cate);
			$this->db->where($array);
			$update = $this->db->update('complainant_addl_parties', $formmodify);
			return true;

		}




		function insert_partB2_officebearer_his($rf_no,$modify_party){		
		$sql="select * from complainant_addl_partb2 where ref_no='".$rf_no."' and ob_party='$modify_party'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();   
    foreach ($query as $row) {
    	
          $this->db->insert('complainant_addl_partb2_his',$row);
    }
    }


		function officeModifiData($formbdata,$modify_party){	

			$ref_no=$this->session->userdata('ref_no');
			$array = array('ref_no' => "$ref_no", 'ob_party' => $modify_party);
			$this->db->where($array);
			$update = $this->db->update('complainant_addl_partb2', $formbdata);
			return true;

		}


	function insert_partC_witness_his($rf_no,$modify_party){
		
		$sql="select * from public_servantpartc_witness where ref_no='".$rf_no."' and witness_detail='$modify_party'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();
   
    foreach ($query as $row) {
    	
          $this->db->insert('public_servantpartc_witness_his',$row);
    }
    }


		function witnessModify($formmodify,$modify_party){	

			$ref_no=$this->session->userdata('ref_no');
			$array = array('ref_no' => "$ref_no", 'witness_detail' => $modify_party);
			$this->db->where($array);
			$update = $this->db->update('public_servantpartc_witness', $formmodify);
			return true;

		}


	function insert_partA_his($ref_no){

		$sql="select * from complainant_details_parta where ref_no='".$ref_no."'";


    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();
   
    foreach ($query as $row) {
    	
          $this->db->insert('complainant_details_parta_his',$row);
    }


    }


		function modify_form_A_filing($form_A_modify=NULL, $user_id){ 	

			//echo "in modify";die;

			$ref_no=$this->session->userdata('ref_no');

	//echo $ref_no;die;
			$this->db->where('ref_no', $ref_no);
			//$this->db->where('user_id', $user_id);
			 $update = $this->db->update('complainant_details_parta', $form_A_modify);
			//echo $this->db->last_query();die;

			return true;

		}
		function insert_partB_his($rf_no){
		
		$sql="select * from complainant_addl_partb1 where ref_no='".$rf_no."'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();
   
    foreach ($query as $row) {
    	
          $this->db->insert('complainant_addl_partb1_his',$row);
    }
    }



		function modifyFormbFiling($formbdata_modify=NULL){ 	
			$ref_no=$this->session->userdata('ref_no');	
			$this->db->where('ref_no', $ref_no);
			$update = $this->db->update('complainant_addl_partb1', $formbdata_modify);
			return true;

		}

		function insert_partC_his($rf_no){
		
		$sql="select * from public_servant_partc where ref_no='".$rf_no."'";
    //$query = $this->db->get('complainant_details_parta')->where('ref_no',$rf_no);
		$query 	= $this->db->query($sql)->result();
   
    foreach ($query as $row) {
    	
          $this->db->insert('public_servant_partc_his',$row);
    }
    }


		function modify_form_C_filing($formrespondentdata=NULL){ 	
			$ref_no=$this->session->userdata('ref_no');
	//echo $ref_no;die;
			$this->db->where('ref_no', $ref_no);
			$update = $this->db->update('public_servant_partc', $formrespondentdata);
			return true;

		}


		function getComplaintno($ref_no){ 	
			$sql = "select * from complainant_details_parta where ref_no='$ref_no' ";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();	
			return $query1;

		}


		function addFormbFiling($formbdata=NULL){	
			$this->db->insert('complainant_addl_partb1', $formbdata);
			return true;

		}

		function additionalparty($formbdata=NULL){	
			$this->db->insert('complainant_addl_parties', $formbdata);
			return true;

		}


		function officesavedata($formbdata=NULL){	
			$this->db->insert('complainant_addl_partb2', $formbdata);
			return true;

		}


		function addRespondent($formrespondentdata=NULL){  

			$this->db->insert('public_servant_partc', $formrespondentdata);
			return true;


		}





		function addWitnessdata($formwitnessdata=NULL){  

			$this->db->insert('public_servantpartc_witness', $formwitnessdata);
			return true;

		}


		function addDeclaration($declaration=NULL){  

			$this->db->insert('temp_declaration', $declaration);
			return true;

		}

		function get_user_complaints($user_id){  

			$this->db->select('ref_no, filing_status, filing_no');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_status',FALSE);
			$this->db->where('flag','EF');
			$this->db->where('ref_no is NOT NULL', NULL, FALSE);
			$this->db->where('filing_no is NULL', NULL, FALSE);
			$this->db->where('user_id',$user_id);
			$this->db->order_by('filing_no');
			$query = $this->db->get();
			return $query->result();

		} 

		function get_counter_complaints($user_id=NULL){  

			$this->db->select('*')->from('complainant_details_parta A')->join('counter_filing C','A.ref_no = C.ref_no');
			if($user_id!=NULL)
			$this->db->where('C.user_id', $user_id);
			$this->db->where('filing_status',FALSE);
			//$this->db->where('A.flag','CF');
			$this->db->order_by('ack_no asc');
			$query = $this->db->get();
			return $query->result();

		}

		function update_complaint_status($upd_data, $ref_no, $user_id){ 	
			$this->db->where('ref_no', $ref_no);
			$this->db->where('user_id', $user_id);
			$this->db->where('filing_status', 'f');//we never ever update complaint no when its true
			$this->db->update('complainant_details_parta', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function update_complaint_partb($upd_data, $ref_no, $user_id){ 	
			$this->db->where('ref_no', $ref_no);
			$this->db->where('user_id', $user_id);
			$this->db->where('status', 'f');//we never ever update complaint no when its true
			$this->db->update('complainant_addl_partb1', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function update_complaint_partc($upd_data, $ref_no, $user_id){ 	
			$this->db->where('ref_no', $ref_no);
			$this->db->where('user_id', $user_id);
			$this->db->where('status', 'f');//we never ever update complaint no when its true
			$this->db->update('public_servant_partc', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

//I am modifying this function
		function fetch_refno($reference_no, $user_id){
			$this->db->select('filing_no, filing_status');
			$this->db->from('complainant_details_parta');
			if($user_id!=NULL)
			$this->db->where('user_id', $user_id);
			$this->db->where('ref_no', $reference_no);
			$query = $this->db->get();
			return $query->result();
		}

		function fetch_refno_b($reference_no, $user_id){
			$this->db->select('ref_no');
			$this->db->from('complainant_addl_partb1');
			if($user_id!=NULL)
			$this->db->where('user_id', $user_id);
			$this->db->where('ref_no', $reference_no);
			$query = $this->db->get();
			return $query->result();
		}


		function get_filing_counter($year)
		{
			$this->db->select('filing_counter');
			$this->db->from('year_initialisation');
			$this->db->where('year', $year);
			return $this->db->get()->row();
		}


		function update_year_initialisation($year, $upd_data){ 	
			$this->db->where('year', $year);
			$update = $this->db->update('year_initialisation', $upd_data);
			return true;    
		}


		function check_part_data($reference_no, $user_id, $part)
		{
			$this->db->where('ref_no',$reference_no);
			$this->db->where('user_id',$user_id);
			if($part == 'A')
				$table = 'complainant_details_parta';
			elseif($part == 'B')
				$table = 'complainant_addl_partb1';
			elseif($part == 'C')
				$table = 'public_servant_partc';
			else
				return false;
			$query = $this->db->get($table);
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		function check_part_data_onid($user_id, $part)
		{
			$this->db->where('user_id',$user_id);
			if($part == 'A')
				$table = 'complainant_details_parta';
			elseif($part == 'B')
				$table = 'complainant_addl_partb1';
			elseif($part == 'C')
				$table = 'public_servant_partc';
			else
				return false;
			$query = $this->db->get($table);
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		function check_parta_comp($reference_no, $user_id)
		{
			$this->db->select('complaint_capacity_id');
			$this->db->from('complainant_details_parta');
			$this->db->where('ref_no',$reference_no);
			$this->db->where('user_id',$user_id);
			return $this->db->get()->row();
		}

		function check_parta_comp_fn($fn)
		{
			$this->db->select('complaint_capacity_id');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_no',$fn);
			return $this->db->get()->row();
		}

		function update_fil_his($insert_data=NULL){ 	
			$this->db->insert('filingno_history', $insert_data);
			return true;    
		}

		function get_max_compno($year){ 	
			$sql = "select max(filing_no) from complainant_details_parta where dt_of_filing between '".$year."-01-01' and '".$year."-12-31'";
			$query = $this->db->query($sql);
			return $query1 = $query->row_array();	
		}

		function compdet_parta_ins($counter_filing){ 	
			$this->db->insert('complainant_details_parta', $counter_filing);
			return true;	    
		}

		function fetch_counter_detail($ref_no)
		{
			$this->db->select('ack_no,cur_year,entry_date');
			$this->db->from('counter_filing');
			$this->db->where('ref_no', $ref_no);
			return $this->db->get()->row();
		}

		function get_refno($filing_no)
		{
			$this->db->select('ref_no');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_no', $filing_no);
			return $this->db->get()->row();
		}

		function get_total_cfiling($user_id=NULL)
		{
			$this->db->select('ref_no');
			if($user_id!=NULL)
			$this->db->where('user_id', $user_id);
			$query = $this->db->get('counter_filing');
			return $query->num_rows();
		}

		function get_pend_cfiling($user_id=NULL)
		{
			$this->db->select('A.ref_no')->from('complainant_details_parta A')->join('counter_filing C','A.ref_no = C.ref_no');
			if($user_id!=NULL)
			$this->db->where('C.user_id', $user_id);
			//$this->db->where('filing_status',FALSE);
			$this->db->where('A.flag','CF');

			$this->db->where('A.filing_status',FALSE);
			$this->db->where('A.flag','CF');

			$query = $this->db->get();
			return $query->num_rows();
		}

		function get_scr_cfiling($user_id=NULL)
		{
			$this->db->select('A.ref_no')->from('complainant_details_parta A')->join('counter_filing C','A.ref_no = C.ref_no');
			if($user_id!=NULL)
			$this->db->where('C.user_id', $user_id);
			//$this->db->where('filing_status',FALSE);
			$this->db->where('A.flag','CF');

			$this->db->where('A.filing_status',TRUE);
			$this->db->where('A.flag','CF');

			$query = $this->db->get();
			return $query->num_rows();
		}

		function get_total_filing($user_id)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('filing_status','t');

			$query = $this->db->get('complainant_details_parta');
			return $query->num_rows();
		}

		function get_pend_filing($user_id)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('filing_status',FALSE);
			$this->db->where('flag','EF');

			$query = $this->db->get('complainant_details_parta');
			return $query->num_rows();
		}

		function get_scr_filing($user_id)
		{
			$query = $this->db->select('*')->from('complainant_details_parta A')->join('scrutiny S','A.filing_no = S.filing_no','right');
			$this->db->where('S.scrutiny_status', 't');
			$this->db->where('A.user_id', $user_id);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function getRecieved_by($role){
				if($role==162 || $role==161)
				{
				$sql = "select * from recieved_by_master where flag='2'";
				}
				else
				{
				$sql = "select * from recieved_by_master where flag='1'";
				}
				$query = $this->db->query($sql)->result();
				return $query;

		}

public function getMode_by(){

    $sql = "select * from mode_master";
$query = $this->db->query($sql)->result();
return $query;

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

//print_r($this->db->last_query()); die('@@@@@@');



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
     $query = $this->db->query($sql)->result();
return $query;
  }


/* ysc code for public user dashboard */

function get_pub_pen_count($user_id)
		{
			
			$this->db->select('id');
			$this->db->where('user_id',$user_id);
			$this->db->where('filing_no is NULL', NULL, FALSE);
			$this->db->where('ref_no is NOT NULL', NULL, FALSE);
			$this->db->where('filing_status',false);

			$query = $this->db->get('complainant_details_parta');

			//echo $this->db->last_query();die();
			return $query->num_rows();
		}


function get_pub_completed_count($user_id)
		{
			
			$this->db->select('id');
			$this->db->where('user_id',$user_id);
			$this->db->where('filing_status',true);
			$query = $this->db->get('complainant_details_parta');
			//echo $this->db->last_query();die();
			return $query->num_rows();

		}	


		function get_pub_user_completed_complaints($user_id){  

			$this->db->select('ref_no, filing_status, filing_no,gazzette_notification_url');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_status',true);
			$this->db->where('flag','EF');
			$this->db->where('user_id',$user_id);
			$this->db->order_by('filing_no');
			$query = $this->db->get();
			return $query->result();

		} 

		/* ysc code on 2672021 */

		function get_re_entry($user_id)
		{
			$this->db->select('ref_no,filing_status, filing_no');			
			$this->db->where('user_id', $user_id);
			$this->db->where('filing_status',FALSE);
			$this->db->where('openforedit',true);
			$query = $this->db->get('complainant_details_parta');
			//echo $this->db->last_query();die();
			
			return $query->num_rows();
		}	

		function get_re_entry_complaints($user_id){  


			$this->db->select('ref_no, filing_status, filing_no');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_status',FALSE);		
			$this->db->where('ref_no is NOT NULL', NULL, FALSE);
			$this->db->where('openforedit', true);			
			$this->db->where('user_id',$user_id);
			$this->db->order_by('filing_no');
			$query = $this->db->get();

			//echo $this->db->last_query();die();
			return $query->result();

		} 


		function get_re_entry_complaints_count($user_id)
		{
			
			$this->db->select('id');
			$this->db->where('user_id',$user_id);
			$this->db->where('filing_no is NOT NULL', NULL, FALSE);
			$this->db->where('ref_no is NOT NULL', NULL, FALSE);
			$this->db->where('filing_status',false);

			$query = $this->db->get('complainant_details_parta');

			//echo $this->db->last_query();die();
			return $query->num_rows();
		}



}


