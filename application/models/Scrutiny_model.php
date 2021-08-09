<?php
class Scrutiny_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function get_scrutiny_pen_complaints($role_id){  
		$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status,S.defective, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		$this->db->where('T.roleid', $role_id);
		$this->db->where('S.scrutiny_status', 'f');
		$this->db->where('S.defective', false);
		$this->db->order_by('C.dt_of_filing','ASC');
		//$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();

		//echo $this->db->last_query();die();
		return $query->result();
	}

	function get_scrutiny_pen_complaints_def(){  
		$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.gazzette_notification_url, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status,S.defective, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		//$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		//$this->db->where('T.roleid', $role_id);
		$this->db->where('S.scrutiny_status', 'f');
		$this->db->where('S.defective', true);
		$this->db->order_by('C.dt_of_filing','ASC');
		//$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();

			//echo $this->db->last_query();die();
		return $query->result();
	}


	function get_scrutiny_pen_complaints_bench($role_id, $user_id=NULL){  
		$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		$this->db->where('T.roleid', $role_id);
		$this->db->where('T.user_id', $user_id);
		$this->db->where('S.scrutiny_status', 'f');
		//$this->db->where('S.objections', null);
		$this->db->order_by('C.dt_of_filing','ASC');
		//$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();
		return $query->result();
	}

		function get_scrutiny_def_complaints($role_id){  
		$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		//$this->db->where('S.scrutiny_status', 't');
		$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		$this->db->where('T.roleid', $role_id);
		$this->db->where('S.scrutiny_status', 'f');
		$this->db->where('S.objections', 'Yes');	
		$query = $this->db->get();
		return $query->result();
	} 


	function get_checklist($comp_type){
		if($comp_type!=1){		
			$this->db->select('code, description, priority, subcode, display, isheading, heading_code, serial_no');
			$this->db->from('checklist_master');
			$this->db->where('display', 't');
			$this->db->order_by('priority');
		}else
		{
			$this->db->select('code, description, priority, subcode, display, isheading, heading_code, serial_no');
			$this->db->from('checklist_master');
			$this->db->where('display', 't');
			//$this->db->where('subcode', '1,3');
			$this->db->where("(subcode=1 OR subcode=3)");
			$this->db->order_by('priority');
		}
		$query = $this->db->get();
		return $query->result();
	}

	function check_parta_comp($filing_no)
		{
			$this->db->select('complaint_capacity_id');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_no',$filing_no);
			return $this->db->get()->row();
		}

	function fetch_ps_detail($ref_no, $user_id)
		{
			$this->db->select('ps_sur_name, ps_mid_name, ps_first_name');
			$this->db->from('public_servant_partc');
			$this->db->where('ref_no', $ref_no);
			$this->db->where('user_id', $user_id);
			return $this->db->get()->row();
		}

	function get_row($filing_no)
		{
			$this->db->select('ref_no, user_id');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_no', $filing_no);
			return $this->db->get()->row();
		}

	function objections_insert($insert_data)
		{
			$this->db->insert('objection_details',$insert_data);
    		return ($this->db->affected_rows() != 1) ? false : true;
		}

	function case_det_ins($insert_data)
		{
			$this->db->insert('case_detail',$insert_data);
    		return ($this->db->affected_rows() != 1) ? false : true;
		}

	function scrutiny_update($upd_data, $filing_no)
		{ 	
			$this->db->where('filing_no', $filing_no);
			$this->db->where('scrutiny_status', 'f');//we never ever update scrutiny when its true
			$this->db->update('scrutiny', $upd_data); 
			//print_r($r);die;
			//$str = $this->db->last_query();
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function scrutiny_ins($data){ 	
			$this->db->insert('scrutiny', $data);
			return true;	    
		}

	function getObjectiondetails($filing_no)
		{ 
			 $sql = "select * from objection_details
   			LEFT JOIN checklist_master ON checklist_master.code = objection_details.checklist_code
   			where filing_no='".$filing_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;
		}

	function get_scrutiny_tot_count()
		{
			$this->db->select('id');

			$query = $this->db->get('scrutiny');
			return $query->num_rows();
		}

	function get_scrutiny_pen_count($role_id)
		{
			/*
			$this->db->select('id');
			$this->db->where('scrutiny_status',FALSE);

			$query = $this->db->get('scrutiny');
			return $query->num_rows();*/

			$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status,S.defective, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		$this->db->where('T.roleid', $role_id);
		$this->db->where('S.scrutiny_status', 'f');
		$this->db->where('S.defective', false);
		$this->db->order_by('C.dt_of_filing','ASC');
		//$this->db->order_by('S.filing_no','ASC');
		$query = $this->db->get();

			//echo $this->db->last_query();die();
		//return $query->result();
		return $query->num_rows();


		}

	function get_scrutiny_undef_count()
		{
			$this->db->select('id');
			$this->db->where('scrutiny_status',TRUE);
			$this->db->where('objections','No');

			$query = $this->db->get('scrutiny');
			return $query->num_rows();
		}



	function get_scrutiny_def_count()
		{
			$this->db->select('id');
			$this->db->where('defective',TRUE);
			//$this->db->where('objections','Yes');

			$query = $this->db->get('scrutiny');

			//echo $this->db->last_query();die();
			return $query->num_rows();
		}
	function get_complaint_counter($year)
		{
			$this->db->select('complaint_counter');
			$this->db->from('year_initialisation');
			$this->db->where('year', $year);
			return $this->db->get()->row();
		}

	function get_max_compno($year){ 	
			$sql = "select max(complaint_no::integer) from case_detail where complaint_year='".$year."'";
			$query = $this->db->query($sql);
			return $query1 = $query->row_array();	
		}

	function update_comp_his($insert_data=NULL){ 	
			$this->db->insert('complaintno_history', $insert_data);
			return true;    
		}

	function update_year_initialisation($year, $upd_data){ 	
			$this->db->where('year', $year);
			$update = $this->db->update('year_initialisation', $upd_data);
			return true;    
		}

	function get_scr_roles($roleid)
		{
			$this->db->select('display_name, level_id');
			$this->db->from('scrutinyteam_master');
			$this->db->where('roleid !=', $roleid);
			if($roleid != 164){
				$exc = array(147);
				$this->db->where_not_in('roleid', $exc);
			}
			if($roleid == 147)
				$this->db->where('roleid =', 164); 
			$this->db->where('display', 't');
			$this->db->order_by('priority');
			return $this->db->get()->result();
		}

	function scrutiny_his_ins($filing_no){
    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('scrutiny');
    	foreach ($query->result() as $row) {
          $this->db->insert('scrutiny_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_torolename($level_id)
		{
			$this->db->select('display_name');
			$this->db->from('scrutinyteam_master');
			$this->db->where('level_id', $level_id);
			$this->db->where('display', 't');
			return $this->db->get()->result();
		}

	function get_last_rem_name($id)
		{
			$this->db->select('display_name');
			$this->db->where('id', $id);
			$this->db->where('display', 't');
			$query = $this->db->get('scrutinyteam_master');

			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}


	function get_last_rem($filing_no)
		{
			$this->db->select('remarks, remarkd_by, updated_date, summary, summary_ts');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('scrutiny');
			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}

	function get_remarksby($role_id)
		{
			$this->db->select('id');
			$this->db->from('scrutinyteam_master');
			$this->db->where('roleid', $role_id);
			//$this->db->where('display', 't');
			return $this->db->get()->result();
		}

	function chk_objdet_ent($filing_no)
		{
			$this->db->select('id');
			$this->db->where('filing_no',$filing_no);
			$query = $this->db->get('objection_details');
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

	function get_objdet_ent($filing_no){  
		$this->db->select('C.*, O.*');
		$this->db->from('objection_details O');
		$this->db->join('checklist_master C', 'O.checklist_code = C.code');
		$this->db->where('O.filing_no', $filing_no);
		$this->db->where('C.display', 't');
		$query = $this->db->get();
		return $query->result();
	}

	function chk_ent_exist($filing_no, $code)
		{
			$this->db->select('id');
			$this->db->where('filing_no',$filing_no);
			$this->db->where('checklist_code',$code);
			$query = $this->db->get('objection_details');
			if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

	function ins_ent_exist_his($filing_no, $code){
    	$this->db->where('filing_no', $filing_no);
    	$this->db->where('checklist_code', $code);
    	$query = $this->db->get('objection_details');
    	foreach ($query->result() as $row) {
          $this->db->insert('objection_details_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

    function del_ent_exist($filing_no, $code){
	    $this->db->where('filing_no', $filing_no);
	    $this->db->where('checklist_code', $code);
	    $this->db->delete('objection_details');
	    return ($this->db->affected_rows() != 1) ? false : true;
	}

	function get_rem_his($filing_no)
		{
			$this->db->select('remarks, remarkd_by, updated_date');
			$this->db->where('filing_no',$filing_no);
			$this->db->order_by('updated_date', 'DESC');
			$query = $this->db->get('scrutiny_history');
			if ($query->num_rows() > 0){
		        return $query->result();
		    }
		    else{
		        return false;
		    }
		}

	function is_first_time($filing_no)
		{
			$this->db->select('updated_date');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('scrutiny')->result_array();
			//print_r($query);die;
			$upd_date = $query[0]['updated_date'];
			if ($upd_date == null){
		        return true;
		    }
		    else{
		        return false;
		    }
		}


	function get_scrutiny_pdf($role_id){  
		$this->db->select('C.ref_no, C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections');
		$this->db->from('scrutiny S');
		$this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
		$this->db->join('scrutinyteam_master T', 'S.level = T.level_id');
		$this->db->order_by('C.dt_of_filing','ASC');
		//$this->db->where('T.roleid', $role_id);
		//$this->db->where('S.scrutiny_status', 'f');
		//$this->db->where('S.objections', null);
		$query = $this->db->get();
		return $query->result();
	}

	function get_scrutiny_url($filing_no){
		
		$this->db->select('scrutiny_def_url');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('objection_details')->result_array();
			//print_r($query);die;
			return $query;
	}


	function getObjectionremark_display($filing_no)
		{ 
			 $sql = "select * from objection_details
   			LEFT JOIN checklist_master ON checklist_master.code = objection_details.checklist_code
   			where filing_no='".$filing_no."' and defect_status='N' and checklist_master.subcode='1';";
			$query 	= $this->db->query($sql)->result();
			return $query;
		}

	function getObjectionremark_displayb($filing_no)
		{ 
			
			$sql = " SELECT ob.filing_no,ob.checklist_code,ob.comments,ob.defect_status,cm.serial_no,cm.description,cm.subcode,cm.code,cm.heading_code FROM
			objection_details ob
			LEFT JOIN checklist_master cm ON cm.code = ob.checklist_code			
			WHERE ob.filing_no = '".$filing_no."' and ob.defect_status = 'N' and cm.subcode='2' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
		}

	function getObjectionremark_displayc($filing_no)
		{ 
			
			$sql = " SELECT ob.filing_no,ob.checklist_code,ob.comments,ob.defect_status,cm.serial_no,cm.description,cm.subcode,cm.code,cm.heading_code FROM
			objection_details ob
			LEFT JOIN checklist_master cm ON cm.code = ob.checklist_code			
			WHERE ob.filing_no = '".$filing_no."' and ob.defect_status = 'N' and cm.subcode='3' ";
			$query 	= $this->db->query($sql)->result();
			return $query;
		}

		function get_scrutiny_summary($filing_no){
		
		$this->db->select('summary,remarks');			
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('scrutiny')->result_array();			
			return $query;
	}

	function get_scrutiny_rem_his($filing_no){	
			 $sql = "select * from scrutiny_history
   			LEFT JOIN scrutinyteam_master ON scrutinyteam_master.id = scrutiny_history.remarkd_by
   			where filing_no='".$filing_no."'";
			$query 	= $this->db->query($sql)->result();
			return $query;


	}

	function chk_exist_case_det($filing_no)
		{
			$this->db->select('*');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('case_detail');
			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}
		
		function getfiling_no($filing_no)
		{
			$this->db->select('*');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('scrutiny_correction_parta_partc');
			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}
		

		function gender_insert($gender_data)
		{
			$this->db->insert('scrutiny_correction_parta_partc',$gender_data);

		//echo $this->db->last_query();
			//die;
    		return ($this->db->affected_rows() != 1) ? false : true;
		}

		function gender_update($upd_data,$filing_no)
		{
    		$this->db->where('filing_no', $filing_no);	
      		$this->db->update('scrutiny_correction_parta_partc', $upd_data); 
		//echo	$this->db->last_query();
			//die;
      		return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function part_pdf_abc_url_pdf($filing_no)
		{
    		$this->db->select('*');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('part_pdf_abc')->result_array();
			//print_r($query);die;
			return $query;  
		}


 	function upd_scrutiny_data_as_defective($id)
		{ 

		//history			
			$ts = date('Y-m-d H:i:s', time());
			$this->db->where('filing_no', $id);
			$upd_data = array(
									'defective' => 'true',
									'updated_date' => $ts,									
								);
			$this->db->update('scrutiny', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}


		/* ysc code 26062021 */

		public function get_inq_report_count()
		{
			$sql1 = 'SELECT count(*) FROM agency_data A JOIN complainant_details_parta C ON A.filing_no = C.filing_no JOIN case_proceeding P ON A.filing_no = P.filing_no WHERE A.flag = 1 AND P.action = TRUE AND P.ordertype_code = 1';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}

		public function get_inv_report_count()
		{
			$sql1 = 'SELECT count(*) FROM agency_data A JOIN complainant_details_parta C ON A.filing_no = C.filing_no JOIN case_proceeding P ON A.filing_no = P.filing_no WHERE A.flag = 1 AND P.action = TRUE AND P.ordertype_code = 2';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}


		function get_agency_data_bench($flag)
	{  


		//$agncode = get_agncode($roleid);
		$this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, A.filing_no, A.flag, A.listing_date, A.bench_no, P.bench_id');
		$this->db->from('agency_data A');
		$this->db->join('complainant_details_parta C', 'A.filing_no = C.filing_no');
		$this->db->join('case_proceeding P', 'A.filing_no = P.filing_no');
		$this->db->where('A.flag', 1);
		$this->db->where('P.action', 't');
		//$this->db->where_in('P.bench_id', $bench_ids);
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


	public function get_oppertunity_ps_after_pi_count()
		{
			$sql1 = 'SELECT count(*) FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND P.ordertype_code = 3';
			$query = $this->db->query($sql1);
			$query = $query->row_array();

			//echo $this->db->last_query();die;
	
			return $query = $query['count'];
		}


		public function get_oppertunity_ps_after_IR_count()
		{
			$sql1 = 'SELECT count(*) FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND P.ordertype_code = 7';
			$query = $this->db->query($sql1);
			$query = $query->row_array();

			//echo $this->db->last_query();die;
	
			return $query = $query['count'];
		}


	public function get_any_other_action()
		{
			$sql1 = 'SELECT count(*) FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND (P.ordertype_code = 14 OR P.ordertype_code = 6)';
			$query = $this->db->query($sql1);
			$query = $query->row_array();

			//echo $this->db->last_query();die;
	
			return $query = $query['count'];
		}


public function get_agency_data_OPI($flag)
 {
			$sql = 'SELECT * FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND P.ordertype_code = 3';
			$query 	= $this->db->query($sql)->result();
			return $query;
		}


public function get_agency_data_OIR($flag)
 {
			$sql = 'SELECT * FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND P.ordertype_code = 7';
			$query 	= $this->db->query($sql)->result();
			return $query;
		}



	public function get_agency_data_AOA($flag)
 {
			$sql = 'SELECT * FROM case_proceeding P JOIN complainant_details_parta C ON P.filing_no = C.filing_no WHERE P.action = FALSE AND (P.ordertype_code = 14 OR P.ordertype_code = 6)';
			$query 	= $this->db->query($sql)->result();
			return $query;
		}


function ins_order_opertunity_to_ps_pi_report($insert_data)
		{
			$this->db->insert('public_servant_detail',$insert_data);


			//echo $this->db->last_query();
			//die;
    		return ($this->db->affected_rows() != 1) ? false : true;
		}



		function ins_any_other_action_data($insert_data)
		{
			$this->db->insert('any_other_action_detail',$insert_data);

			//echo $this->db->last_query();die;
			
    		return ($this->db->affected_rows() != 1) ? false : true;
		}


 function upd_casedet($filing_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);

			$this->db->update('case_detail', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}


		/* ysc code for 23072021 */

		function upd_scrutiny_data_as_defective_his($filing_no){

    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('scrutiny');
    	foreach ($query->result() as $row) {
          $this->db->insert('scrutiny_history',$row);
    	}    	
    	return ($this->db->affected_rows() != 1) ? false : true;
    }



		function upd_scrutiny_data_as_undefective_his($filing_no){			
    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('scrutiny');
    	foreach ($query->result() as $row) {
          $this->db->insert('scrutiny_history',$row);
    	}

    	
    	return ($this->db->affected_rows() != 1) ? false : true;
    }


 	function upd_scrutiny_data_as_undefective($id)
		{ 		

		//history	
			$ts = date('Y-m-d H:i:s', time());	
			$this->db->where('filing_no', $id);
			$upd_data = array(
									'defective' => 'false',	
									'updated_date' => $ts,																
								);
			$this->db->update('scrutiny', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}



function status_edit_open_complaint_history($filing_no, $flag){			
    	$this->db->where('filing_no', $filing_no);
    	if($flag == 1){
    	$query = $this->db->get('complainant_details_parta');
    	foreach ($query->result() as $row) {
          $this->db->insert('complainant_details_parta_his',$row);
    	}
    }elseif($flag == 2){
    	$query = $this->db->get('complainant_addl_partb1');
    	foreach ($query->result() as $row) {
          $this->db->insert('complainant_addl_partb1_his',$row);
    	}
    }elseif($flag == 3){
    	$query = $this->db->get('public_servant_partc');
    	foreach ($query->result() as $row) {
          $this->db->insert('public_servant_partc_his',$row);
    	}
    }else{
    	die('no table provided');
    }
    	
    	return ($this->db->affected_rows() != 1) ? false : true;
    }


function status_edit_open_complaint($id, $flag)
		{ 	
			$ts = date('Y-m-d H:i:s', time());	
			$this->db->where('filing_no', $id);
			if($flag == 1){
							$upd_data = array(
									'filing_status' => 'false',
									'openforedit' => 'true',
									'updated_at' => $ts,																			
								);
				$this->db->update('complainant_details_parta', $upd_data); 
			}
			elseif($flag == 2){
							$upd_data = array(
									'status' => 'false',
									'updated_at' => $ts,																			
								);
				$this->db->update('complainant_addl_partb1', $upd_data);
			}
			elseif($flag == 3){
							$upd_data = array(
									'status' => 'false',
									'updated_at' => $ts,																			
								);
				$this->db->update('public_servant_partc', $upd_data);
			}
			else
				die('No table provided');
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

function fetch_gadjet_report($filing_no)
		{
			$this->db->select('gazzette_notification_url');
			$this->db->from('complainant_details_parta');
			$this->db->where('filing_no',$filing_no);
			//echo $this->db->last_query();die('ooo');
			return $this->db->get()->row();
		}

function fetch_previous_gadjet_report($ref_no)
		{
			$this->db->select('gazzette_notification_url,filing_no');
			$this->db->from('complainant_details_parta_his');
			$this->db->where('ref_no', $ref_no);
			$this->db->where('filing_status','true');
			//echo $this->db->last_query();die('ooo');
			return $this->db->get()->result();
		}

function get_previous_complaint_remarks($fn)
		{
			$this->db->select('previous_complaint_description');
			$this->db->where('filing_no', $fn);
			$query = $this->db->get('scrutiny');

			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}


		function get_previous_complaint_description($filing_no)
		{
			$this->db->select('previous_complaint_description');
			//$this->db->from('scrutiny');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get('scrutiny');
			if ($query->num_rows() > 0){
		        return $query->result();;
		    }
		    else{
		        return false;
		    }
		}

		function get_public_servant_data_count($filing_no)
		{
			//$this->db->select('proceeding_count');
			//$this->db->from('case_proceeding');
			//$this->db->where('filing_no', $filing_no);
			//return $this->db->get()->row();

			$this->db->where('filing_no',$filing_no);
		    $query = $this->db->get('public_servant_detail');
		    if ($query->num_rows() > 0){
		        return $query->result();
		    }
		    else{
		        return 0;
		    }
		}
}
?>