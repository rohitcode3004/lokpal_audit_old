    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('convertToBase64'))
    {

        function get_status_complaint($ordertype_code, $cp_action, $ag_action, $listed, $case_status, $scrutiny_status)
        {
            //$CI =& get_instance();
            //$CI->load->model('report_model');
            //$type_row =  $CI->report_model->fetch_complaint_status($filing_no);
            if($ordertype_code == 1 && $cp_action ==FALSE)
                return 'Preliminary Enquiry Ordered';
            if($ordertype_code == 1 && $cp_action ==TRUE)
                return 'Preliminary Enquiry Under Consideration';
            if($ordertype_code == 2 && $cp_action ==FALSE)
                return 'Investigation Ordered';
            if($ordertype_code == 2 && $cp_action ==TRUE)
                return 'Investigation Report Under Consideration';
            if($scrutiny_status == TRUE && $case_status != 'D')
                return 'Complaint Under Consideration';
            if($listed == TRUE && $case_status == 'D')
                return 'Closed';
            
            return 'n/a';
        }

        function get_listing_dt_from_allocation($fn)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            $data =  $CI->reports_model->fetch_listing_dt($fn);
            if($data == 0)
                return NULL;
            else
                return $data[0]->listing_date;
        }

        function get_benchid_from_allocation($fn)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            $data =  $CI->reports_model->fetch_benchid($fn);
            if($data == 0)
                return NULL;
            else
                return $data[0]->bench_id;
        }

        function get_bench_name($bno){
            if($bno == 0){
                return 'Full Bench';
            }else{
                return 'Bench-'.$bno;
            }

        }

        function get_bench_no_from_bid($bid)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            $data =  $CI->reports_model->fetch_bench_no($bid);
            if($data == 0)
                return NULL;
            else
                return get_bench_name($data[0]->bench_no);
        }

        function get_allocation_date($fn)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            $data =  $CI->reports_model->fetch_allocation_date($fn);
            //print_r($data);die;
            if($data == 0)
                return NULL;
            else
                return $data[0]->max;
        }

        function get_bench_ids_bybno($bench_no)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            $ids =  $CI->reports_model->fetch_bench_ids($bench_no);
            //echo $g = count($ids);die;
            //print_r($ids);die;
            //$arr[];
            $arr=array();
            for($i=0;$i<count($ids);$i++){
                array_push($arr, $ids[$i]->id);
            }
            //print_r($a);die;
            return $arr;
        }

        function get_f_cases_u_loi_count($bench_ids)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            return $count =  $CI->reports_model->fetch_f_count_by_bench($bench_ids);
        }

        function get_i_cases_u_loi_count($bench_ids)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            return $count =  $CI->reports_model->fetch_i_count_by_bench($bench_ids);
        }

        function get_v_cases_u_loi_count($bench_ids)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            return $count =  $CI->reports_model->fetch_v_count_by_bench($bench_ids);
        }

        function get_other_cases_u_loi_count($bench_ids)
        {
            $CI =& get_instance();
            $CI->load->model('reports_model');
            return $count =  $CI->reports_model->fetch_other_cases_count_by_bench($bench_ids);
        }

        function get_with_whom_pending($ordertype_code, $agency_code, $bench_id, $fn)
        {
            //$CI =& get_instance();
            //$CI->load->model('report_model');
            //$type_row =  $CI->report_model->fetch_complaint_status($filing_no);
            if($ordertype_code == 1 || $ordertype_code == 2){
                $CI =& get_instance();
                $CI->load->helper('common_helper');
                return get_agname($agency_code);
            }
            elseif($ordertype_code == 3 || $ordertype_code == 4|| $ordertype_code == 6){
                $CI =& get_instance();
                $CI->load->helper('proceeding_helper');
                return get_order_type($ordertype_code);
            }
            else{
                $bench_id = get_benchid_from_allocation($fn);
                $bench_no = get_bench_no_from_bid($bench_id);
                return $bench_no;
            }
        }

        function get_with_which_bench_pending($bench_id, $fn){
            $bench_id = get_benchid_from_allocation($fn);
            $bench_no = get_bench_no_from_bid($bench_id);
            return $bench_no;
        }

        function get_with_which_agency_pending($ordertype_code, $agency_code){
            if($ordertype_code == 1 || $ordertype_code == 2){
                $CI =& get_instance();
                $CI->load->helper('common_helper');
                return get_agname($agency_code);
            }
        }

        /* key to remember
        [0]  scrutiny
        [1]  listing  (bogus or not neccessary to be geniune)
        [2]  proceeding  (should be genuine)
        [3]  agency status
        [4]  order type code
        [5]  agency report status
    
        */

        function create_stage_matrix($filing_no){
            $cycle = 1;
            $stage_matrix = array (
                array("N","N","N","N","N","N"),
                array("N","N","N","N","N","N"),
                array("N","N","N","N","N","N"),
                );
            //latest cycle
            $CI =& get_instance();
            $CI->load->model('reports_model');

            $data =  $CI->reports_model->fetch_scrutiny_status($filing_no);
            if($data == 0)
                $stage_matrix[0][0] = "N";
            elseif($data[0]->scrutiny_status == 'f')
                $stage_matrix[0][0] = "P";
             elseif($data[0]->scrutiny_status == 't')
                $stage_matrix[0][0] = "C";

            $data =  $CI->reports_model->fetch_listing_status($filing_no, $cycle);
            if($data == 0)
                $stage_matrix[0][1] = "N";
            elseif($data[0]->listed == 'f')
                $stage_matrix[0][1] = "P";
            elseif($data[0]->listed == 't'){
                $stage_matrix[0][1] = "C";

                $data =  $CI->reports_model->fetch_proceeding_status($filing_no, $cycle);
                //print_r($data);die;
                if($data == 0)
                    $stage_matrix[0][2] = "N";
                elseif($data[0]->proceeded == 'f'){
                    $stage_matrix[0][2] = "P";
                    //die('here');
                }
                elseif($data[0]->proceeded == 't'){
                    $listing_date_binded = $data[0]->listing_date;
                    //print_r($listing_date_binded);die;
                    $stage_matrix[0][2] = "C";
                    $data =  $CI->reports_model->fetch_proceeding_data($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[0][4] = "N";
                else
                    $stage_matrix[0][4] = $data[0]->ordertype_code;

                $data =  $CI->reports_model->fetch_agency_status($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[0][3] = "N";
                elseif($data[0]->action == 'f')
                    $stage_matrix[0][3] = "P";
                elseif($data[0]->action == 't'){
                    $stage_matrix[0][3] = "C";

                $data =  $CI->reports_model->fetch_report_status($filing_no, $listing_date_binded);
                //print_r($data);die;
                if($data == 0)
                    $stage_matrix[0][5] = "N";
                elseif($data[0]->flag == 1)
                    $stage_matrix[0][5] = "P";
                elseif($data[0]->flag == 0)
                    $stage_matrix[0][5] = "C";
                }
                }

            }
            $cycle += 1;

            //2nd last cycle
            $CI =& get_instance();
            $CI->load->model('reports_model');

            $data =  $CI->reports_model->fetch_scrutiny_status($filing_no);
            if($data == 0)
                $stage_matrix[1][0] = "N";
            elseif($data[0]->scrutiny_status == 'f')
                $stage_matrix[1][0] = "P";
             elseif($data[0]->scrutiny_status == 't')
                $stage_matrix[1][0] = "C";

            $data =  $CI->reports_model->fetch_listing_status($filing_no, $cycle);
            if($data == 0){
                $stage_matrix[1][1] = "N";
                //$data =  $CI->reports_model->fetch_proceeding_status($filing_no, $cycle);
            }
            elseif($data[0]->listed == 'f'){
                $stage_matrix[1][1] = "P";
                //$row_count_allocation =  $CI->reports_model->get_count_rows_allocation($filing_no);
                //if($row_count_allocation <= 2) 
                    //$data =  $CI->reports_model->fetch_proceeding_status($filing_no, 1); // take from 1st largest entry(special case)
                //else
                    $data =  $CI->reports_model->fetch_proceeding_status($filing_no, 1); 
            }
             elseif($data[0]->listed == 't'){
                $stage_matrix[1][1] = "C";
                //$row_count_allocation =  $CI->reports_model->get_count_rows_allocation($filing_no);
                //if($row_count_allocation <= 2) 
                    //$data =  $CI->reports_model->fetch_proceeding_status($filing_no, 1); // take from 1st largest entry(special case)
                //else
                if($stage_matrix[0][1] == 'P'){
                    $data =  $CI->reports_model->fetch_proceeding_status($filing_no, 1);
                }else{
                    $data =  $CI->reports_model->fetch_proceeding_status($filing_no, $cycle); 
                }
            }

            //print_r($data);
            if(!empty($data))
                $listing_date_binded = $data[0]->listing_date;
            else
                $listing_date_binded = NULL;

            //print_r($listing_date_binded);die;

            if($data == 0){
                $stage_matrix[1][2] = "N";
            }
            elseif($data[0]->proceeded == 'f')
                $stage_matrix[1][2] = "P";
             elseif($data[0]->proceeded == 't'){
                $stage_matrix[1][2] = "C";
            }

                $data =  $CI->reports_model->fetch_proceeding_data($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[1][4] = "N";
                else
                    $stage_matrix[1][4] = $data[0]->ordertype_code;

                $data =  $CI->reports_model->fetch_agency_status($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[1][3] = "N";
                elseif($data[0]->action == 'f')
                    $stage_matrix[1][3] = "P";
                elseif($data[0]->action == 't'){
                    $stage_matrix[1][3] = "C";

                $data =  $CI->reports_model->fetch_report_status($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[1][5] = "N";
                elseif($data[0]->flag == 1)
                    $stage_matrix[1][5] = "P";
                elseif($data[0]->flag == 0)
                    $stage_matrix[1][5] = "C";
                }
            

            $cycle += 1;

            //3rd last cycle
            $CI =& get_instance();
            $CI->load->model('reports_model');

            $data =  $CI->reports_model->fetch_scrutiny_status($filing_no);
            if($data == 0)
                $stage_matrix[2][0] = "N";
            elseif($data[0]->scrutiny_status == 'f')
                $stage_matrix[2][0] = "P";
             elseif($data[0]->scrutiny_status == 't')
                $stage_matrix[2][0] = "C";

            $data =  $CI->reports_model->fetch_listing_status($filing_no, $cycle);
            if($data == 0)
                $stage_matrix[2][1] = "N";
            elseif($data[0]->listed == 'f')
                $stage_matrix[2][1] = "P";
             elseif($data[0]->listed == 't')
                $stage_matrix[2][1] = "C";

            $data =  $CI->reports_model->fetch_proceeding_status($filing_no, $cycle);
            $listing_date_binded = NULL;
            if($data == 0)
                $stage_matrix[2][2] = "N";
            elseif($data[0]->proceeded == 'f')
                $stage_matrix[2][2] = "P";
             elseif($data[0]->proceeded == 't'){
                 $listing_date_binded = $data[0]->listing_date;
                $stage_matrix[2][2] = "C";
                $data =  $CI->reports_model->fetch_proceeding_data($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[2][4] = "N";
                else
                    $stage_matrix[2][4] = $data[0]->ordertype_code;

                $data =  $CI->reports_model->fetch_agency_status($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[2][3] = "N";
                elseif($data[0]->action == 'f')
                    $stage_matrix[2][3] = "P";
                elseif($data[0]->action == 't'){
                    $stage_matrix[2][3] = "C";

                $data =  $CI->reports_model->fetch_report_status($filing_no, $listing_date_binded);
                if($data == 0)
                    $stage_matrix[2][5] = "N";
                elseif($data[0]->flag == 1)
                    $stage_matrix[2][5] = "P";
                elseif($data[0]->flag == 0)
                    $stage_matrix[2][5] = "C";
                }
            }

            return $stage_matrix;


        }

    function get_case_status_fed_matrix($matrix)
        {
            //print_r($matrix);die;
        $prefix = '';
        $postfix = '';
        if($matrix[0][0] == 'N' or $matrix[0][0] == 'P')
            $postfix = 'At Scrutiny Level';
        
        if($matrix[0][0] == 'C'){
            $prefix = 'Complaint Under Consideration';
        }

        if($matrix[0][1] == 'P'){
            if($matrix[1][4] == 'N'){
                $prefix = 'Complaint Under Consideration';
                $postfix = 'At Chairperson Level';
            }
            if($matrix[1][4] == 1){
                $prefix = 'Preliminary Inquiry Under Consideration';
                $postfix = 'At Chairperson Level';
            }
            if($matrix[1][4] == 2){
                $prefix = 'Investigation Report Under Consideration';
                $postfix = 'At Chairperson Level';
            }
        }

        if($matrix[0][2] == 'P'){
            if($matrix[1][4] == 'N'){
                $prefix = 'Complaint Under Consideration';
                $postfix = 'At Bench Level';
            }
            if($matrix[1][4] == 1){
                $prefix = 'Preliminary Inquiry Under Consideration';
                $postfix = 'At Bench Level';
            }
            if($matrix[1][4] == 2){
                $prefix = 'Investigation Report Under Consideration';
                $postfix = 'At Bench Level';
            }
        }

        if(($matrix[0][4] == 5 or $matrix[0][4] == 8 or $matrix[0][4] == 9) and $matrix[1][4] == 'N'){
                $prefix = 'Closed After Preliminary Examination';
            }
            if(($matrix[0][4] == 5 or $matrix[0][4] == 8 or $matrix[0][4] == 9) and $matrix[1][4] == 1){
                $prefix = 'Closed After Consideration of Preliminary Inquiry';
            }
            if(($matrix[0][4] == 5 or $matrix[0][4] == 8 or $matrix[0][4] == 9) and $matrix[1][4] == 2){
                $prefix = 'Closed After Consideration of Investigation Report';
            }

        if($matrix[0][3] == 'P'){
            if($matrix[0][4] == 1){
                $prefix = 'Preliminary Inquiry Ordered';
                $postfix = 'At Agency Level';
            }
            if($matrix[0][4] == 2){
                $prefix = 'Investigation Ordered';
                $postfix = 'At Agency Level';
            }
        }

        if($matrix[0][3] == 'N'){
            if(($matrix[0][4] == 3 or $matrix[0][4] == 7) and $matrix[1][4] == 'N'){
                $prefix = 'Opportunity to Public Servant';   //this is not given in mom
                //$postfix = 'At Agency Level';
            }
            if(($matrix[0][4] == 3 or $matrix[0][4] == 7) and $matrix[1][4] == 1){
                $prefix = 'Opportunity to Public Servant after Preliminary Inquiry';
                //$postfix = 'At Agency Level';
            }
            if(($matrix[0][4] == 3 or $matrix[0][4] == 7) and $matrix[1][4] == 'N'){
                $prefix = 'Opportunity to Public Servant after Investigation';
                //$postfix = 'At Agency Level';
            }

            if($matrix[0][4] == 6){
                $prefix = 'Any Other Action';
                //$postfix = 'At Agency Level';
            }
        }

        if(isset($matrix[0][5]) ? $matrix[0][5] == 'P' : NULL){
            if($matrix[0][4] == 1){
                $prefix = 'Report Under Consideration After Preliminary Inquiry';    //this is not given in mom
                $postfix = 'At Bench Level';
            }
            if($matrix[0][4] == 2){
                $prefix = 'Report Under Consideration After Investigation';         //this is not given in mom
                $postfix = 'At Bench Level';
            }
        }

        //return $prefix.". ".$postfix;
        return $prefix;
        }

    }