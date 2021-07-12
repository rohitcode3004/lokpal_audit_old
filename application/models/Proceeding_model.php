<?php 

class Proceeding_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_allocated_data($bench_ids, $flag)
    {
        if($flag == 'F'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no where a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') and a.filing_no not in(select a.filing_no from case_allocation a inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where a.proceeded=FALSE and d.listed=TRUE and cp.ordertype_code!=4 and a.bench_id in ('.implode(',', $bench_ids).')) order by d.complaint_year, d.complaint_no';
        }
        elseif($flag == 'I'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=1 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') order by d.complaint_year, d.complaint_no';
        }
        elseif($flag == 'V'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=2 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') order by d.complaint_year, d.complaint_no';
        }
        elseif($flag == 'OPI'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=3 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') order by d.complaint_year, d.complaint_no';
        }
        elseif($flag == 'OPV'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=7 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') order by d.complaint_year, d.complaint_no';
        }
        elseif($flag == 'AOA'){
            $sql1 = 'select a.bench_id, a.filing_no, a.id, a.listing_date, a.purpose, a.venue, a.created_at, c.first_name, c.mid_name, c.sur_name, a.bench_no, c.ref_no, p.ps_desig, p.ps_orgn from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=14 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).') order by d.complaint_year, d.complaint_no';
        }

        return $this->db->query($sql1)->result();
        //echo $this->db->last_query();die;
        /*$this->db->select('*');
        $this->db->from('case_allocation A');
        $this->db->join('complainant_details_parta C', 'A.filing_no = C.filing_no');
        $this->db->join('case_detail D', 'A.filing_no = D.filing_no');
        $this->db->where('A.proceeded', 'f');
        //$this->db->where('S.objections', 'No');
        $this->db->where('D.listed', 't');
        $this->db->order_by('D.complaint_no');
        $this->db->order_by('D.complaint_year');
        $query = $this->db->get();
        return $query->result();*/
    }

	function fetch_order_type($codes)
		{
			$this->db->select('ordertype_code, ordertype_name');
			$this->db->from('ordertype_master');
			$this->db->where('display', 't');
			$this->db->where('parent_id', null);
			if(!empty($codes))
				$this->db->where_not_in('ordertype_code', $codes);
			$this->db->order_by('priority');
			$query = $this->db->get();
			return $query->result();
		}

	function fetch_other_action($codes)
		{
			$this->db->select('ordertype_code, ordertype_name');
			$this->db->from('ordertype_master');
			$this->db->where('display', 't');
			$this->db->where('parent_id !=', null);
			if(!empty($codes))
				$this->db->where_not_in('ordertype_code', $codes);
			$this->db->order_by('priority');
			$query = $this->db->get();
			return $query->result();
		}

	function fetch_concer_agency($code)
		{
			$this->db->select('agency_name, agency_code');
			$this->db->from('agency_master');
			$this->db->where('ordertype_code', $code);
			$this->db->where('display', 't');
			$this->db->order_by('priority');
			$query = $this->db->get();
			return $query->result();
		}

	function fetch_psdet($filing_no)
		{
			$this->db->select('ps_salutation_id, ps_first_name, ps_mid_name, ps_sur_name, ps_desig, ps_orgn');
			$this->db->from('public_servant_partc');
			$this->db->where('filing_no', $filing_no);
			$query = $this->db->get();
			return $query->result();
		}

	function fetch_sal($code)
		{
			$this->db->select('salutation_desc');
			$this->db->from('salutation');
			$this->db->where('salutation_id', $code);
			$query = $this->db->get();
			return $query->result();
		}

	function get_proc_count($filing_no)
		{
			//$this->db->select('proceeding_count');
			//$this->db->from('case_proceeding');
			//$this->db->where('filing_no', $filing_no);
			//return $this->db->get()->row();

			$this->db->where('filing_no',$filing_no);
		    $query = $this->db->get('case_proceeding');
		    if ($query->num_rows() > 0){
		        return $query->result();
		    }
		    else{
		        return 0;
		    }
		}

	function proceeding_exists($filing_no)
		{
		    $this->db->where('filing_no',$filing_no);
		    $query = $this->db->get('case_proceeding');
		    if ($query->num_rows() > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

	function proceeding_insert($insert_data)
		{
			$this->db->insert('case_proceeding',$insert_data);
    		return ($this->db->affected_rows() != 1) ? false : true;
		}

	function upd_alloc($filing_no, $listing_date, $bench_no, $upd_data)
		{ 	
			$this->db->where('filing_no', $filing_no);
			$this->db->where('listing_date', $listing_date);
			$this->db->where('bench_no', $bench_no);

			$this->db->update('case_allocation', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}


	function updhis_insert($filing_no, $listing_date, $bench_no){
    	$this->db->where('filing_no', $filing_no);
    	$this->db->where('listing_date', $listing_date);
    	$this->db->where('bench_no', $bench_no);
    	$query = $this->db->get('case_allocation');
    	foreach ($query->result() as $row) {
          $this->db->insert('case_allocation_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_proce_tot_count()
		{
			$this->db->distinct();
			$this->db->select('A.filing_no');
			$this->db->from('case_allocation A');
			$this->db->join('case_detail D', 'A.filing_no = D.filing_no');
			$this->db->where('D.listed', 't');

			$query = $this->db->get();
			return $query->num_rows();
		}

	function get_proce_pen_count()
		{
			$this->db->distinct();
			$this->db->select('filing_no');
			$this->db->where('proceeded', 'f');


			$query = $this->db->get('case_allocation');
			return $query->num_rows();
		}

	function get_proce_don_count()
		{
			$this->db->distinct();
			$this->db->select('filing_no');
			$this->db->where('proceeded', 't');

			$query = $this->db->get('case_allocation');
			return $query->num_rows();
		}

	function get_last_proceeding($filing_no){  
		$query = $this->db->get_where('case_proceeding', array(//making selection
            'filing_no' => $filing_no
        ));
			//$query = $this->db->get();
			$count = $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();
	}

	function fetch_ordertype_name($code)
		{
			$this->db->select('ordertype_name');
			$this->db->from('ordertype_master');
			$this->db->where('ordertype_code', $code);
			return $this->db->get()->row();
		}

	function fetch_agn_name($code)
		{
			$this->db->select('agency_name');
			$this->db->from('agency_master');
			$this->db->where('agency_code', $code);
			return $this->db->get()->row();
		}

	function get_proceeding_his($filing_no){  
		$query = $this->db->get_where('case_proceeding_history', array(//making selection
            'filing_no' => $filing_no
        ));
			//$query = $this->db->get();
			$count = $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();
	}

	function proceeding_history_insert($filing_no){
    	$this->db->where('filing_no', $filing_no);
    	$query = $this->db->get('case_proceeding');
    	foreach ($query->result() as $row) {
          $this->db->insert('case_proceeding_history',$row);
    	}
    	return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function delete_proceeding($id){
	    $this->db->where('filing_no', $id);
	    $this->db->delete('case_proceeding');
	    return ($this->db->affected_rows() != 1) ? false : true;
	}

	


	function upd_allocation_listing($id, $listing_date)
		{ 							
			
			$this->db->where('id', $id);
			$upd_data = array(
									'listing_date' => $listing_date,
									//'bench_no' => '1',									
								);
			$this->db->update('case_allocation', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function fetch_current_proc_details($filing_no){
		    $this->db->select('*');
            $this->db->where('filing_no', $filing_no);
            $query = $this->db->get('case_proceeding');

            if ($query->num_rows() > 0){
                return $query->result();
            }
            else{
                die('No previous proceeding detail found');
            }
	}


	function upd_allocation_purpose($id, $purpose_code)
		{ 							
			
			$this->db->where('id', $id);
			$upd_data = array(
									'purpose' => $purpose_code,
									//'bench_no' => '1',									
								);
			$this->db->update('case_allocation', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function insert_new_purpose($insert_array){
		$this->db->insert('purpose_master', $insert_array);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function get_max_priority(){ 	
			$sql = "select max(priority) from purpose_master where priority < (select max(priority) from purpose_master);";
			$query = $this->db->query($sql);
			return $query1 = $query->row_array();	
		}

	function upd_allocation_venue($id, $venue_code)
		{ 							
			
			$this->db->where('id', $id);
			$upd_data = array(
									'venue' => $venue_code,
									//'bench_no' => '1',									
								);
			$this->db->update('case_allocation', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

	function get_next_listdate($filing_no){ 	
			$sql = "SELECT ca.updated_at,ca.filing_no,ca.purpose,ca.listing_date,ca.next_list_date,ca.last_list_date,name from case_allocation ca
LEFT JOIN purpose_master ON purpose_master.id = ca.purpose 
 where ca.filing_no='$filing_no'
ORDER BY ca.updated_at DESC 
LIMIT 1";
			$query = $this->db->query($sql);
			return $query1 = $query->row_array();	
		}

		public function get_all_benches()
		{
			$sql1 = 'select * from bench where updated_at is null order by bench_no';
	
			return $this->db->query($sql1)->result();
		}

		public function get_allocated_data_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join case_detail d on a.filing_no=d.filing_no where a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
				$query1 = $this->db->query($sql1);
				$query1 = $query1->row_array();
				$query1 = $query1['count'];
				//print_r($query1);die;
				$sql2 = 'select count(*) from case_allocation a inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
				$query2 = $this->db->query($sql2);
				$query2 = $query2->row_array();
				$query2 = $query2['count'];
	
				return $query1 - $query2;
		}

		public function get_inq_data_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=1 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}

		public function get_inv_data_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=2 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}

		public function get_inq_report_count($bench_ids)
		{
			$sql1 = 'SELECT count(*) FROM agency_data A JOIN complainant_details_parta C ON A.filing_no = C.filing_no JOIN case_proceeding P ON A.filing_no = P.filing_no WHERE A.flag = 1 AND P.action = TRUE AND P.bench_id IN('.implode(',', $bench_ids).') AND P.ordertype_code = 1';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}

		public function get_inv_report_count($bench_ids)
		{
			$sql1 = 'SELECT count(*) FROM agency_data A JOIN complainant_details_parta C ON A.filing_no = C.filing_no JOIN case_proceeding P ON A.filing_no = P.filing_no WHERE A.flag = 1 AND P.action = TRUE AND P.bench_id IN('.implode(',', $bench_ids).') AND P.ordertype_code = 2';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}

		public function upd_hearing_details($id, $venue_code, $purpose_code, $listing_date)
		{
			$this->db->where('id', $id);
			$upd_data = [
				'venue' => $venue_code,
				'purpose' => $purpose_code,
				'listing_date' => $listing_date,
				//'bench_no' => '1',
			];
			$this->db->update('case_allocation', $upd_data);
			//print_r($r);die;
			return (1 != $this->db->affected_rows()) ? false : true;
		}

		/* ysc code start here 8july */

		public function get_ops_inq_report_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=3 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}
			

		public function get_ops_inv_report_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=7 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}


		public function get_aoa_report_count($bench_ids)
		{
			$sql1 = 'select count(*) from case_allocation a inner join complainant_details_parta c on a.filing_no=c.filing_no inner join public_servant_partc p on a.filing_no=p.filing_no inner join case_detail d on a.filing_no=d.filing_no inner join case_proceeding cp on a.filing_no=cp.filing_no where cp.ordertype_code=14 and a.proceeded=FALSE and d.listed=TRUE and a.bench_id in ('.implode(',', $bench_ids).')';
			$query = $this->db->query($sql1);
			$query = $query->row_array();
	
			return $query = $query['count'];
		}


		/*ysc code end here */
}