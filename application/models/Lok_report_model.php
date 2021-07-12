<?php 

class Lok_report_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
		
	*/
	function fetch_realtime_status($filing_no)
	{
        $this->db->select('C.ref_no,C.sur_name, C.mid_name, C.first_name, C.dt_of_filing, S.filing_no, S.scrutiny_status, S.objections, D.listed, S.scrutiny_date');
        $this->db->from('scrutiny S');
        $this->db->join('complainant_details_parta C', 'S.filing_no = C.filing_no');
        $this->db->join('case_detail D', 'S.filing_no = D.filing_no');
        $this->db->where('S.scrutiny_status', 't');
        //$this->db->where('S.objections', 'No');
        $this->db->where('D.listed', 't');
        $this->db->where('S.filing_no', $filing_no);
        $query = $this->db->get();
        //print_r($query->result_array());

        $count = $query->num_rows(); 
        if($count === 0)
        	$status = 'Not in table';
        else
            {
            $this->db->select_max('id');
            $this->db->where('filing_no', $filing_no);
            $res1 = $this->db->get('case_allocation');
            $res2 = $res1->result_array();
            $id = $res2[0]['id'];
            //print_r($listing_date);

            $this->db->select('proceeded');
            $this->db->from('case_allocation');
            $this->db->where('filing_no', $filing_no);
            $this->db->where('id', $id);
            $res3 = $this->db->get()->row();
            $proceeded = $res3->proceeded;
            print_r($proceeded);

            if(!$proceeded){
                $hearing = $query->listing_date;
                if($hearing)
                    $status = 'Hearing on '.$hearing;
                else
                    $status = 'Hearing date not given';
            }
            elseif($proceeded)
                $status = 'Proceeding Completed';
            }
        return $status;
	}
}