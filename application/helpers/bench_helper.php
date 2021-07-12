    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('convertToBase64'))
    {

        function get_bench_nature($code)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $nature_row =  $CI->bench_model->fetch_bench_nature($code);
            return $nature_row->bench_name;
        }

        function get_bench_nature_code($listing_date, $bench_no)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $nature_row =  $CI->bench_model->fetch_bench_nature_code($listing_date, $bench_no);
            return $nature_row->bench_nature;
        }

        function get_coram($id)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');

            $judges = $CI->bench_model->get_judges($id);
            $judges = $judges->result_array();
                //print("<pre>".print_r($judges,true)."</pre>");die;
                //$benches_array["benches"][] = $benches[$i];
            $count_judges = count($judges);
            for($j=0;$j<$count_judges;$j++){        
                    //$benches_array["judges"][] = $judges[$j];
                $jrow = $CI->bench_model->get_judge_name($judges[$j]['judge_code']);
                $jname = $jrow->judge_name;

                $judges_array[] = array("judge_name" => $jname,
                    "list_date" => $judges[$j]['from_list_date'],
                    "court_no" => $judges[$j]['court_no'],
                    "from_time" => $judges[$j]['from_time'],
                    "bench_no" => $judges[$j]['bench_no'],
                    "bench_id" => $judges[$j]['bench_id'],
                    "judge_code" => $judges[$j]['judge_code'],
                );
            }
            return $result_array['judges']=$judges_array;

            //$nature_row =  $CI->bench_model->fetch_bench_nature($code);
            //return $nature_row->bench_name;
        }

        function get_coram_all($filing_no)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            //echo $filing_no;die;
            $total_benches = $CI->bench_model->get_all_benches($filing_no);
            if($total_benches === 0)
                return 0;
            $total_benches = $total_benches->result_array();
                //print("<pre>".print_r($total_benches,true)."</pre>");die;
            $count_benches = count($total_benches);
            //echo $count_benches;die;
            for($i=0;$i<$count_benches;$i++){

                $b_no = $total_benches[$i]['bench_no'];
                $all_bench_ids_with_same_bn = $CI->bench_model->get_benche_ids($b_no);
                $all_bench_ids_with_same_bn = $all_bench_ids_with_same_bn->result_array();
                $all_bench_ids_with_same_bn = array_column($all_bench_ids_with_same_bn, 'id');

                $total_cases = 0;
                $total_cases = $CI->bench_model->get_total_cases($all_bench_ids_with_same_bn);

                $total_benches_array[] = array("listing_date" => $total_benches[$i]['listing_date'],
                    "order_date" => $total_benches[$i]['order_date'],
                    "court_no" => $total_benches[$i]['court_no'],
                    "bench_no" => $total_benches[$i]['bench_no'],
                    "bench_id" => $total_benches[$i]['bench_id'],
                    "bench_nature" => $total_benches[$i]['bench_nature'],
                    "presiding" => $total_benches[$i]['presiding'],
                    "tnoc" => $total_cases,
                );
            //print_r($total_benches_array);die;

                $judges = $CI->bench_model->get_judges($total_benches[$i]['bench_id']);
                $judges = $judges->result_array();
                //print("<pre>".print_r($judges,true)."</pre>");die;
                //$benches_array["benches"][] = $benches[$i];
                $count_judges = count($judges);
                for($j=0;$j<$count_judges;$j++){        
                    //$benches_array["judges"][] = $judges[$j];
                    $jrow = $CI->bench_model->get_judge_name($judges[$j]['judge_code']);
                    $jname = $jrow->judge_name;

                    $total_benches_array[$i]['judges_array'][] = array("judge_name" => $jname,
                        "court_no" => $judges[$j]['court_no'],
                        "from_time" => $judges[$j]['from_time'],
                        "bench_no" => $judges[$j]['bench_no'],
                        "bench_id" => $judges[$j]['bench_id'],
                        "judge_code" => $judges[$j]['judge_code'],
                        "judge_desg" => get_member_type($judges[$j]['judge_code']),
                    );
                }
            }
            //print_r("<pre>".print_r($total_benches_array,true)."</pre>");die;
            return $total_benches_array;

            //$nature_row =  $CI->bench_model->fetch_bench_nature($code);
            //return $nature_row->bench_name;
        }

        function get_member_type($code)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $type_row =  $CI->bench_model->fetch_memeber_type($code);
            $type = $type_row->judge_type;
            if($type == 'C')
                return "Hon'ble Chairperson";
            elseif($type == 'J')
                return "Hon'ble Judicial Member";
            elseif($type == 'M')
                return "Hon'ble Member";
            else
                return "";
        }

        function get_judge_name($code)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $jrow = $CI->bench_model->get_judge_name($code);
            return $jrow->judge_name;
        }

        function get_current_bench_details($listing_date, $filing_no, $bench_id)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $bench_row = $CI->bench_model->fetch_current_bench_details($listing_date, $filing_no, $bench_id);
            return $bench_row;
        }

        function get_judge_code($code)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $judge_code_row = $CI->bench_model->fetch_judge_code($code);
            return $judge_code_row;
        }

        function get_logged_judge_code($id)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $jrow = $CI->bench_model->fetch_logged_judge_code($id);
            return $jrow->judge_code;
        }

        function get_logged_judge_code_pps($id)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $jrow = $CI->bench_model->fetch_logged_judge_code_pps($id);
            return $jrow->judge_code;
        }


        function get_purpose_name($code)
        {
        $CI =& get_instance();
        $CI->load->model('bench_model');
        $purpose_row =  $CI->bench_model->fetch_purpose_name($code);
        if(!empty($purpose_row))
            return $purpose_row->name;
        else
            return 'n/a';
        }

        function get_venue_name($code)
        {
        $CI =& get_instance();
        $CI->load->model('bench_model');
        $purpose_row =  $CI->bench_model->fetch_venue_name($code);
        if(!empty($purpose_row))
            return $purpose_row->name;
        else
            return 'n/a';
        }

        function get_clist_date($fn)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $data =  $CI->bench_model->fetch_clist_date($fn);
            if($data == 0)
                return NULL;
            else
                return $data[0]->listing_date;
        }

        function get_cpurpose($fn)
        {
            $CI =& get_instance();
            $CI->load->model('bench_model');
            $data =  $CI->bench_model->fetch_cpurpose($fn);
            if($data == 0)
                return NULL;
            else
                return $data[0]->purpose;
        }

    }