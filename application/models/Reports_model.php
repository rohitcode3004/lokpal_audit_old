<?php 

class Reports_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function get_prem_inq_count()
    {
      	$sql1 = "select count(*) from case_proceeding where ordertype_code=1 and action = FALSE";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_inves_count()
    {
      	$sql1 = "select count(*) from case_proceeding where ordertype_code=2 and action = FALSE";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_pros_sanctioned_count()
    {
      	$sql1 = "select count(*) from case_proceeding where action = FALSE";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_cons_lokpal_count()
    {
      	$sql1 = "select count(*) from case_detail d inner join scrutiny s on d.filing_no=s.filing_no left join case_proceeding p on d.filing_no=p.filing_no left join agency_data g on d.filing_no=g.filing_no where s.scrutiny_status=TRUE and d.case_status!='D' and d.filing_no NOT IN(select filing_no from case_proceeding where action=FALSE and ordertype_code!=4)";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_ord_dep_proc_count()
    {
      	$sql1 = "select count(*) from case_detail";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_closed_count()
    {
      	$sql1 = "select count(*) from scrutiny s inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=TRUE and d.case_status='D'";
			$query1 = $this->db->query($sql1);
			$query1 = $query1->row_array();
			return $query1 = $query1['count'];
    }

    function get_list_data($flag){ 
    	if($flag=='U'){ 
			$sql1 = "select d.filing_no,p.listing_date, p.agency_code, p.remarks, p.ordertype_code, p.action as cp_action, g.flag as ag_action, p.bench_id from case_detail d inner join scrutiny s on d.filing_no=s.filing_no left join case_proceeding p on d.filing_no=p.filing_no left join agency_data g on d.filing_no=g.filing_no where s.scrutiny_status=TRUE and d.case_status!='D' and d.filing_no NOT IN(select filing_no from case_proceeding where action=FALSE and ordertype_code!=4) order by d.complaint_year, d.complaint_no";
		}elseif($flag=='I'){
			$sql1 = "select s.filing_no, p.listing_date, p.agency_code, p.remarks, p.ordertype_code, p.action as cp_action, p.due_date, g.flag as ag_action, p.bench_id from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no left join agency_data g on s.filing_no=g.filing_no  where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=1 and p.action=FALSE order by d.complaint_year, d.complaint_no";
		}elseif($flag=='V'){
			$sql1 = "select s.filing_no, p.listing_date, p.agency_code, p.remarks, p.ordertype_code, p.action as cp_action, p.due_date, g.flag as ag_action, p.bench_id from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no inner join case_detail d on s.filing_no=d.filing_no left join agency_data g on s.filing_no=g.filing_no  where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=2 and p.action=FALSE order by d.complaint_year, d.complaint_no";
		}elseif($flag=='D'){
			$sql1 = "select * from scrutiny s inner join case_detail d on s.filing_no=d.filing_no inner join complainant_details_parta a on s.filing_no=a.filing_no inner join public_servant_partc c on s.filing_no=c.filing_no where s.scrutiny_status=TRUE and d.listed=TRUE and d.case_status='D' order by d.complaint_year, d.complaint_no";
		}
		$query 	= $this->db->query($sql1)->result();
		return $query;
		//print_r($query);die;
	}

	function get_list_data_2($flag, $bids){ 
    	if($flag=='F'){ 
			$sql1 = "select * from scrutiny s inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bids).") where s.scrutiny_status=TRUE and d.listed=TRUE and s.filing_no not in(select distinct(c.filing_no) from scrutiny s inner join case_proceeding c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and d.listed=TRUE)";
		}elseif($flag=='I'){
			$sql1 = "select p.filing_no, g.dt_submission, p.proceeding_count from case_proceeding p inner join agency_data g on p.filing_no=g.filing_no and g.flag=0 inner join case_allocation a on p.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bids).") left join case_proceeding_history ph on p.filing_no=ph.filing_no and ph.ordertype_code=1 and p.action=FALSE and p.ordertype_code=4  where p.ordertype_code=1 or p.ordertype_code=4 and p.filing_no not in(select filing_no from case_proceeding_history where ordertype_code=2)";
		}elseif($flag=='V'){
			$sql1 = "select p.filing_no, g.dt_submission, p.proceeding_count from case_proceeding p inner join agency_data g on p.filing_no=g.filing_no and g.flag=0 inner join case_allocation a on p.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bids).") left join case_proceeding_history ph on p.filing_no=ph.filing_no and ph.ordertype_code=2 and p.action=FALSE and p.ordertype_code=4  where p.ordertype_code=2 or p.ordertype_code=4";
		}elseif($flag=='O'){
			$sql1 = "select * from agency_data g inner join case_proceeding p on g.filing_no=p.filing_no and g.flag=1 and p.action=TRUE and p.bench_id in (".implode(',', $bids).")";
		}
		$query 	= $this->db->query($sql1)->result();
		return $query;
		//print_r($query);die;
	}

		function fetch_all_benches()
	{
		$sql1 = "select bench_no,presiding from bench where updated_at is NULL order by bench_no";
		$query 	= $this->db->query($sql1)->result();
		return $query;
	}

	    function fetch_f_count_by_bench($bench_ids)
    {
			//$sql2 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and c.bench_id in (".implode(',', $bench_ids).")";
			$sql2 = "select count(*) from scrutiny s inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bench_ids).") where s.scrutiny_status=TRUE and d.listed=TRUE and s.filing_no not in(select distinct(c.filing_no) from scrutiny s inner join case_proceeding c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and d.listed=TRUE)";
			$query2 = $this->db->query($sql2);
			$query2 = $query2->row_array();
			$query2 = $query2['count'];

			return $query2;
    }

    	function fetch_i_count_by_bench($bench_ids)
    {
			//$sql2 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and c.bench_id in (".implode(',', $bench_ids).")";
			$sql2 = "select count(*) from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no and p.action=TRUE inner join agency_data g on s.filing_no=g.filing_no and g.flag=0 inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bench_ids).") where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=1";
			$query2 = $this->db->query($sql2);
			$query2 = $query2->row_array();
			$query2 = $query2['count'];


			$sql1 = "select s.filing_no from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no and p.action=FALSE inner join agency_data g on s.filing_no=g.filing_no and g.flag=0 inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bench_ids).") where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=4";
			$results 	= $this->db->query($sql1)->result();
			//print_r($query1);
			$count2 = 0;
			foreach ($results as $row) {
				//print_r($row->filing_no);
				$sql3 = "select max(id) from case_proceeding_history where filing_no='".$row->filing_no."' and ordertype_code!=4";
				$query3 = $this->db->query($sql3);
				$results3 = $query3->row_array();
				$id = $results3['max'];

				$sql4 = "select ordertype_code from case_proceeding_history where id='".$id."'";
				$query4 = $this->db->query($sql4);
				$results4 = $query4->row_array();
				if($results4['ordertype_code'] == 1){
					$count2++;
				}
				
			}

			return $query2+$count2;
    }

        	function fetch_v_count_by_bench($bench_ids)
    {
			//$sql2 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and c.bench_id in (".implode(',', $bench_ids).")";
			$sql2 = "select count(*) from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no and p.action=TRUE inner join agency_data g on s.filing_no=g.filing_no and g.flag=0 inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bench_ids).") where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=2";
			$query2 = $this->db->query($sql2);
			$query2 = $query2->row_array();
			$query2 = $query2['count'];


			$sql1 = "select s.filing_no from scrutiny s inner join case_proceeding p on s.filing_no=p.filing_no and p.action=FALSE inner join agency_data g on s.filing_no=g.filing_no and g.flag=0 inner join case_detail d on s.filing_no=d.filing_no inner join case_allocation a on s.filing_no=a.filing_no and a.proceeded=FALSE and a.bench_id in (".implode(',', $bench_ids).") where s.scrutiny_status=TRUE and d.listed=TRUE and p.ordertype_code=4";
			$results 	= $this->db->query($sql1)->result();
			//print_r($query1);
			$count2 = 0;
			foreach ($results as $row) {
				//print_r($row->filing_no);
				$sql3 = "select max(id) from case_proceeding_history where filing_no='".$row->filing_no."' and ordertype_code!=4";
				$query3 = $this->db->query($sql3);
				$results3 = $query3->row_array();
				$id = $results3['max'];

				$sql4 = "select ordertype_code from case_proceeding_history where id='".$id."'";
				$query4 = $this->db->query($sql4);
				$results4 = $query4->row_array();
				if($results4['ordertype_code'] == 2){
					$count2++;
				}
				
			}

			return $query2+$count2;
    }

            function fetch_other_cases_count_by_bench($bench_ids)
    {
			//$sql2 = "select count(distinct(c.filing_no)) from scrutiny s inner join case_allocation c on s.filing_no=c.filing_no inner join case_detail d on s.filing_no=d.filing_no where s.scrutiny_status=TRUE and c.bench_id in (".implode(',', $bench_ids).")";
			$sql2 = "select count(*) from agency_data g inner join case_proceeding p on g.filing_no=p.filing_no and g.flag=1 and p.action=TRUE and p.bench_id in (".implode(',', $bench_ids).")";
			$query2 = $this->db->query($sql2);
			$query2 = $query2->row_array();
			$query2 = $query2['count'];

			return $query2;
    }

    function fetch_bench_ids($bench_no)
    {
    	$sql1 = "select id from bench where bench_no = $bench_no";
		$query 	= $this->db->query($sql1)->result();
		return $query;
    }

    function fetch_listing_dt($fn)
	{
		$this->db->select_max('listing_date');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		//$this->db->where('proceeded', 'f');
		$query = $this->db->get('case_allocation');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	} 

	function fetch_benchid($fn)
	{
		$this->db->select_max('id');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		//$this->db->where('proceeded', 'f');
		$query = $this->db->get('case_allocation');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			$row = $query->result();
			$id = $row[0]->id;	



		$this->db->select('bench_id');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('id', $id);
		$query = $this->db->get('case_allocation');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	} 

	function fetch_bench_no($bid)
	{
		$this->db->select('bench_no');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('id', $bid);
		$query = $this->db->get('bench');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	}

	function fetch_allocation_date($fn)
	{
		$sql = "select max(created_at) from case_allocation a inner join case_detail d on a.filing_no=d.filing_no where a.filing_no='".$fn."' and d.listed=TRUE";
		$query = $this->db->query($sql);
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();
	
	}  

	//new stage code start
	function fetch_scrutiny_status($fn)
	{
		$this->db->select('scrutiny_status');
			//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		$query = $this->db->get('scrutiny');
		$count =  $query->num_rows();
		if($count === 0)
			return 0;
		else
			return $query->result();	
	}

	function fetch_listing_status($fn, $cycle)
	{
		if($cycle == 1){
			$this->db->select('listed');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('filing_no', $fn);
			$query = $this->db->get('case_detail');
			$count =  $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();
		}elseif($cycle == 2){
			$sql = "select max(updated_date) from case_detail_history where filing_no='".$fn."'";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();
			$max = $query1['max'];
		}elseif($cycle == 3){
			$sql = "select max(updated_date) from case_detail_history where filing_no='".$fn."' and updated_date < (SELECT MAX(updated_date) FROM case_detail_history where filing_no='".$fn."')";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();
			$max = $query1['max'];
		}
			$this->db->select('listed');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('updated_date', $max);
			$query = $this->db->get('case_detail_history');
			$count =  $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();	
	}

	function fetch_proceeding_status($fn, $cycle)
	{
		if($cycle == 1){
			$sql = "select max(id) from case_allocation where filing_no='".$fn."' and last_list_date is null and (recieved_from is null or recieved_from = 'N')";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();
			$max = $query1['max'];
		}elseif($cycle == 2){
			$sql = "select max(id) from case_allocation where filing_no='".$fn."' and last_list_date is null and (recieved_from is null or recieved_from = 'N') and id < (SELECT MAX(id) FROM case_allocation where filing_no='".$fn."' and last_list_date is null and (recieved_from is null or recieved_from = 'N'))";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();
			$max = $query1['max'];
		}elseif($cycle == 3){
			$sql = "select id FROM case_allocation where filing_no='".$fn."' and last_list_date is null and (recieved_from is null or recieved_from = 'N') ORDER BY id DESC LIMIT 1 OFFSET 2";
			$query = $this->db->query($sql);
			$query1 = $query->row_array();
			$max = $query1['id'];
		}
			//print_r($max);die;
		    $this->db->select('proceeded, listing_date');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('id', $max);
			$query = $this->db->get('case_allocation');
			$count =  $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();	
	}

	function get_count_rows_allocation($fn)
	{
			$sql = "select * from case_allocation where filing_no='".$fn."' and last_list_date is null and (recieved_from is null or recieved_from = 'N')";
			$query = $this->db->query($sql);
			$count =  $query->num_rows();

    		//$str = $this->db->last_query();
    		return $count;
	}

	function fetch_proceeding_data($fn, $ld)
	{
			$this->db->select('ordertype_code');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('filing_no', $fn);
			$this->db->where('listing_date', $ld);
			$query = $this->db->get('case_proceeding');
			$count =  $query->num_rows();
			if($count === 0){
				$this->db->select('ordertype_code');
				//$this->db->where('bench_nature', $bench_nature);
				$this->db->where('filing_no', $fn);
				$this->db->where('listing_date', $ld);
				$query = $this->db->get('case_proceeding_history');
	
				$count =  $query->num_rows();
				if($count === 0)
					return 0;
				else
					return $query->result();	
				}
			else
				return $query->result();
	}

	function fetch_agency_status($fn, $ld)
	{
		$this->db->select('action');
		//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		$this->db->where('listing_date', $ld);
		$this->db->where("(ordertype_code=1 or ordertype_code=2)");
		$query = $this->db->get('case_proceeding');
		$count =  $query->num_rows();
		if($count === 0){
			$this->db->select('action');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('filing_no', $fn);
			$this->db->where('listing_date', $ld);
			$this->db->where("(ordertype_code=1 or ordertype_code=2)");
			$query = $this->db->get('case_proceeding_history');
			$count =  $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();
			}
			else
				return $query->result();	
	
	} 

	function fetch_report_status($fn, $ld)
	{
		$this->db->select('flag');
		//$this->db->where('bench_nature', $bench_nature);
		$this->db->where('filing_no', $fn);
		$this->db->where('listing_date', $ld);
		$query = $this->db->get('agency_data');
		$count =  $query->num_rows();
		if($count === 0){
			$this->db->select('flag');
			//$this->db->where('bench_nature', $bench_nature);
			$this->db->where('filing_no', $fn);
			$this->db->where('listing_date', $ld);
			$query = $this->db->get('agency_data_his');
			$count =  $query->num_rows();
			if($count === 0)
				return 0;
			else
				return $query->result();
			}
			else
				return $query->result();	
	
	} 

	/* by ysc 03/03/2021*****************/

		function getscrutinyGender($filing_no){
			$sql="SELECT sc.gender_id,sc.filing_no,gender_desc FROM
			scrutiny_correction_parta_partc sc
			LEFT JOIN gender ON gender.gender_id = sc.gender_id 
			WHERE sc.filing_no = '$filing_no'";
			$query = $this->db->query($sql)->result();
			return $query;
		}

		function getscrutinyCategory($filing_no){
			$sql="SELECT sc.complaint_capacity_id,sc.ps_id,sc.filing_no,ps_desc,complaint_capacity_desc FROM
			scrutiny_correction_parta_partc sc
			LEFT JOIN complaint_capacity ON complaint_capacity.complaint_capacity_id = sc.complaint_capacity_id
   			LEFT JOIN ps_category ON ps_category.comlaint_capacity_id = sc.complaint_capacity_id and ps_category.ps_id = sc.ps_id
			WHERE sc.filing_no = '$filing_no'";
			$query = $this->db->query($sql)->result();
			return $query;
		}

		
/* ysc update 03/03/2021  */
	function getfilingNo_pdf_abc($filing_no)
	{
		$this->db->select('*');
		//$this->db->from('scrutiny');
		$this->db->where('filing_no', $filing_no);
		$query = $this->db->get('part_pdf_abc');
		if ($query->num_rows() > 0){
	        return $query->result();;
	    }
	    else{
	        return false;
	    }
	}

	function partabc_insert($insert_data)
	{
		$this->db->insert('part_pdf_abc',$insert_data);

	//echo $this->db->last_query();
		//die;
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function partabc_update($upd_data,$filing_no)
	{
		$this->db->where('filing_no', $filing_no);	
  		$this->db->update('part_pdf_abc', $upd_data); 
	//echo	$this->db->last_query();
		//die;
  		return ($this->db->affected_rows() != 1) ? false : true;   
	}

	////////////////////ysc reports//////////////////

		function get_member_of_parliyament_count()
    {
		$sql1=" select count(*) FROM public_servant_partc psc
		LEFT JOIN scrutiny sc ON sc.filing_no = psc.filing_no
		WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='1' or psc.ps_id='2' or psc.ps_id='3' or psc.ps_id='4') and sc.scrutiny_status=TRUE";
		$query1 = $this->db->query($sql1);
		$query1 = $query1->row_array();
		return $query1 = $query1['count'];
    }


     function get_officials_count()
    {
      	
		$sql1="select count(*) FROM public_servant_partc psc
		LEFT JOIN scrutiny sc ON sc.filing_no = psc.filing_no
		WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='5') and sc.scrutiny_status=TRUE";
		$query1 = $this->db->query($sql1);
		$query1 = $query1->row_array();
		return $query1 = $query1['count'];
    }

     function get_ex_group_count()
    {     
		$sql1=" select count(*) FROM public_servant_partc psc
		LEFT JOIN scrutiny sc ON sc.filing_no = psc.filing_no
		WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='1' or psc.ps_id='6') and sc.scrutiny_status=TRUE";
		$query1 = $this->db->query($sql1);
		$query1 = $query1->row_array();
		return $query1 = $query1['count'];
    }

     function get_others_count()
    {      	
		$sql1=" select count(*) FROM public_servant_partc psc
		LEFT JOIN scrutiny sc ON sc.filing_no = psc.filing_no
		WHERE (psc.complaint_capacity_id='11' and  psc.ps_id='52') and sc.scrutiny_status=TRUE";
		$query1 = $this->db->query($sql1);
		$query1 = $query1->row_array();
		return $query1 = $query1['count'];
    }

    function get_rest_category_count()
    {
		$sql1 = "select count(*) FROM public_servant_partc psc
		LEFT JOIN scrutiny sc ON sc.filing_no = psc.filing_no
		WHERE ( psc.complaint_capacity_id='2' or psc.complaint_capacity_id='3' or psc.complaint_capacity_id='4' or psc.complaint_capacity_id='5' or psc.complaint_capacity_id='6' or psc.complaint_capacity_id='7' or psc.complaint_capacity_id='8' or psc.complaint_capacity_id='9' or psc.complaint_capacity_id='10' or complaint_capacity_id='1' and ps_id='54' or ps_id='53') and sc.scrutiny_status=TRUE";
		$query1 = $this->db->query($sql1);
		$query1 = $query1->row_array();
		return $query1 = $query1['count'];
    }

     function get_list_data_cat($flag){ 
    	if($flag=='M'){ 
         $sql1="SELECT psc.complaint_capacity_id,psc.ps_id,psc.filing_no,s.scrutiny_status,p.listing_date, p.agency_code,
p.remarks, p.ordertype_code, p.action as cp_action,p.bench_id, p.due_date,g.flag as ag_action,d.listed,d.case_status from public_servant_partc psc 
         LEFT JOIN scrutiny s ON s.filing_no = psc.filing_no
         INNER JOIN case_detail d on d.filing_no=psc.filing_no
         LEFT JOIN case_proceeding p ON p.filing_no = psc.filing_no
         LEFT JOIN agency_data g ON g.filing_no = psc.filing_no
         WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='1' or psc.ps_id='2' or psc.ps_id='3' or psc.ps_id='4') and s.scrutiny_status=true";

         		}elseif($flag=='A'){		
         $sql1="SELECT psc.complaint_capacity_id,psc.ps_id,psc.filing_no,s.scrutiny_status,p.listing_date, p.agency_code,
p.remarks, p.ordertype_code, p.action as cp_action,p.bench_id, p.due_date,g.flag as ag_action,d.listed,d.case_status from public_servant_partc psc 
         LEFT JOIN scrutiny s ON s.filing_no = psc.filing_no
         INNER JOIN case_detail d on d.filing_no=psc.filing_no
         LEFT JOIN case_proceeding p ON p.filing_no = psc.filing_no
         LEFT JOIN agency_data g ON g.filing_no = psc.filing_no
         WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='1' or psc.ps_id='5') and s.scrutiny_status=true";

		}elseif($flag=='E'){			

          $sql1="SELECT psc.complaint_capacity_id,psc.ps_id,psc.filing_no,s.scrutiny_status,p.listing_date, p.agency_code,
p.remarks, p.ordertype_code, p.action as cp_action,p.bench_id, p.due_date,g.flag as ag_action,d.listed,d.case_status from public_servant_partc psc 
         LEFT JOIN scrutiny s ON s.filing_no = psc.filing_no
         INNER JOIN case_detail d on d.filing_no=psc.filing_no
         LEFT JOIN case_proceeding p ON p.filing_no = psc.filing_no
         LEFT JOIN agency_data g ON g.filing_no = psc.filing_no
         WHERE (psc.complaint_capacity_id='1' and  psc.ps_id='1' or psc.ps_id='6') and s.scrutiny_status=true";

		}elseif($flag=='C'){			

         $sql1="SELECT psc.complaint_capacity_id,psc.ps_id,psc.filing_no,s.scrutiny_status,p.listing_date, p.agency_code,
p.remarks, p.ordertype_code, p.action as cp_action,p.bench_id,p.due_date,g.flag as ag_action,d.listed,d.case_status from public_servant_partc psc 
         LEFT JOIN scrutiny s ON s.filing_no = psc.filing_no
         INNER JOIN case_detail d on d.filing_no=psc.filing_no
         LEFT JOIN case_proceeding p ON p.filing_no = psc.filing_no
         LEFT JOIN agency_data g ON g.filing_no = psc.filing_no
         WHERE ( psc.complaint_capacity_id='2' or psc.complaint_capacity_id='3' or psc.complaint_capacity_id='4' or psc.complaint_capacity_id='5' or psc.complaint_capacity_id='6' or psc.complaint_capacity_id='7' or psc.complaint_capacity_id='8' or psc.complaint_capacity_id='9' or psc.complaint_capacity_id='10' or complaint_capacity_id='1' and ps_id='54' or ps_id='53') and s.scrutiny_status=true";

		}
		elseif($flag=='O'){	
          $sql1="SELECT psc.complaint_capacity_id,psc.ps_id,psc.filing_no,s.scrutiny_status,p.listing_date, p.agency_code,
p.remarks, p.ordertype_code, p.action as cp_action,p.bench_id, p.due_date,g.flag as ag_action,d.listed,d.case_status from public_servant_partc psc 
         LEFT JOIN scrutiny s ON s.filing_no = psc.filing_no
         INNER JOIN case_detail d on d.filing_no=psc.filing_no
         LEFT JOIN case_proceeding p ON p.filing_no = psc.filing_no
         LEFT JOIN agency_data g ON g.filing_no = psc.filing_no
         WHERE ( psc.complaint_capacity_id='11' and  psc.ps_id='52') and s.scrutiny_status=true";
		}
		$query 	= $this->db->query($sql1)->result();
		return $query;
		//print_r($query);die;
	}




}