	<?php 

	class Backlog_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		function insert($insert_data)
		{  
			$this->db->insert('legacy_data',$insert_data);
			//print_r($this->db->last_query());   die;
			return ($this->db->affected_rows() != 1) ? false : true;
		}

		function update($upd_data, $id)
		{  								
			$this->db->where('id', $id);
			$this->db->update('legacy_data', $upd_data); 
			//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function get_ps_category_legacy(){	

			$sql = "select * from ps_category_legacy where display=TRUE order by id ASC";
			$query 	= $this->db->query($sql)->result();
			return $query;

		}

		function fetch_complaint_capacity_name($code)
		{
			$this->db->select('category_name');
			$this->db->from('ps_category_legacy');
			$this->db->where('id', $code);
			return $this->db->get()->row();
		}

		function upd_verify_status($id)
		{ 							

			$this->db->where('id', $id);
			$upd_data = array(
				'verified' => 't',
										//'bench_no' => '1',									
			);
			$this->db->update('legacy_data', $upd_data); 
				//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;   
		}

		function get_legacy_data()
		{
			$sql="SELECT lg.id,lg.serial_no,lg.first_name,lg.sur_name,lg.mid_name,lg.salutation_id,lg.p_add1,lg.mid_name,lg.p_state_id,lg.p_dist_id,lg.ps_salutation_id,lg.ps_first_name,
			lg.ps_mid_name,lg.ps_sur_name,lg.ps_orgn,lg.ps_desig,lg.complaint_capacity_id,lg.summary,lg.order_upload,lg.verified,lg.dt_of_complaint,salutation_desc,Name FROM
			legacy_data lg
			LEFT JOIN salutation ON salutation.salutation_id = lg.salutation_id 
			LEFT JOIN master_address ON master_address.state_code = lg.p_state_id and district_code=0 and sub_dist_code=0 and village_code=0 and display='TRUE' where lg.verified = 'FALSE'
			";
			$query = $this->db->query($sql)->result();
			return $query;
	//$this->db->query_times; die;

		}


		function get_legacy_data_byId($id)
		{
			$sql="SELECT lg.id,lg.serial_no,lg.first_name,lg.sur_name,lg.mid_name,lg.salutation_id,lg.p_add1,lg.mid_name,lg.p_state_id,lg.p_dist_id,lg.ps_salutation_id,lg.ps_first_name,
			lg.ps_mid_name,lg.ps_sur_name,lg.ps_orgn,lg.ps_desig,lg.complaint_capacity_id,lg.summary,lg.p_hpnl,lg.order_upload,lg.p_pin_code,	lg.p_country_id,lg.dt_of_complaint,salutation_desc,Name FROM
			legacy_data lg
			LEFT JOIN salutation ON salutation.salutation_id = lg.salutation_id 
			LEFT JOIN master_address ON master_address.state_code = lg.p_state_id and district_code=0 and sub_dist_code=0 and village_code=0 and display='TRUE'
			where lg.id='$id'
			";
			$query = $this->db->query($sql)->result();
			return $query;
	//$this->db->query_times; die;

		}

		function save_path_report($path, $id){ 	
			$this->db->where('id', $bid);
			$this->db->update('path_to_legacy_report', $path); 
			print_r($this->db->last_query());   die;
				//print_r($r);die;
			return ($this->db->affected_rows() != 1) ? false : true;  

		}
	}