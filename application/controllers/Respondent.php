<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Respondent extends CI_Controller {
	public function __construct(){
		parent::__construct();
      $this->load->library('File_upload');
      $this->load->helper('file');
    $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    if($this->isUserLoggedIn) 
    {
      $this->con = array( 
        'id' => $this->session->userdata('userId') 
      );
    }
    else{
      redirect('admin/login'); 
    }
    $this->load->library('label');
    $this->load->helper("compno_helper");
    $this->load->helper("parts_status_helper");
    $u = $this->session->userdata('userId');
    $ref_no=$this->session->userdata('ref_no');
    $comp_no=get_filing_no($ref_no, $u);
    $status = $comp_no['status'];
    //$filing_no = $comp_no['complaint_no'];

    if($status == 't'){
      die('not authorized');
    }

    $this->load->model('filing_model');
    $this->load->model('common_model');
    $this->load->model('report_model');
   $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->library('Menus_lib');
    $this->load->model('login_model');
  }
  


  
  public function respondentfiling(){

    $data['user'] = $this->login_model->getRows($this->con);	
    $this->load->library('label');
    $this->load->helper("date_helper"); 

    $ref_no=$this->session->userdata('ref_no');

    if($ref_no !='')
    {
      $data['partc'] = $this->report_model->getPartc($ref_no);

    }

  //echo "<pre>";
 // print_r($data['partc']);
    $data['farma'] = $this->common_model->getFormadata($ref_no);

    if (empty($data['partc'])) {
      /*first time*/

      $data['salution'] = $this->common_model->getSalution();
      $data['complainant_type'] = $this->common_model->getComplaint();
      $data['pscategory'] = $this->common_model->getPscategory();
      $data['gender'] = $this->common_model->getGender();
      $data['nationality'] = $this->common_model->getNationality();
      $data['identityproof'] = $this->common_model->getIdentityproof();
      $data['residenceproof'] = $this->common_model->getResidence();
      $data['getcountry'] = $this->common_model->getCountry();
      $data['complaintmode'] = $this->common_model->getComplaintmode();
      $data['identity_document_type'] = $this->common_model->getDocument_type();
      $data['applet'] = $this->common_model->getAppletName();
      $data['state'] = $this->common_model->getStateName();
      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
    }
    else
    {

     $data['salution'] = $this->common_model->getSalution();
     $data['pscategory'] = $this->common_model->getPscategory();
     $data['complainant_type'] = $this->common_model->getComplaint();
     $data['gender'] = $this->common_model->getGender();
     $data['nationality'] = $this->common_model->getNationality();
     $data['identityproof'] = $this->common_model->getIdentityproof();
     $data['residenceproof'] = $this->common_model->getResidence();
     $data['getcountry'] = $this->common_model->getCountry();
     $data['complaintmode'] = $this->common_model->getComplaintmode();
     $data['identity_document_type'] = $this->common_model->getDocument_type();
     $data['applet'] = $this->common_model->getAppletName();
     $data['state'] = $this->common_model->getStateName();
        //echo "<pre>";

     $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
   }
   $data['form_part'] = 'C';
   
   $this->load->view('templates/front/CE_Header.php',$data);
   $this->load->view('filing/respondent.php',$data);
   $this->load->view('templates/front/CE_Footer.php',$data);

 }

 public function witnessdetail(){  
 
    $data['user'] = $this->login_model->getRows($this->con);  
    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);    
    $this->load->library('label');
    $ref_no=$this->session->userdata('ref_no');
    $data['addparty'] = $this->report_model->getAddWitness($ref_no);
    $data['salution'] = $this->common_model->getSalution();
    $data['gender'] = $this->common_model->getGender();
    $data['nationality'] = $this->common_model->getNationality();
    $data['identityproof'] = $this->common_model->getIdentityproof();
    $data['residenceproof'] = $this->common_model->getResidence();
    $data['getcountry'] = $this->common_model->getCountry();
    $data['complaintmode'] = $this->common_model->getComplaintmode();
    $data['identity_document_type'] = $this->common_model->getDocument_type();
    $data['applet'] = $this->common_model->getAppletName();
    $data['state'] = $this->common_model->getStateName();
    //echo "<pre>";
    //print_r($data);die;
    $this->load->view('templates/front/CE_Header.php',$data);
    $this->load->view('filing/witnessdetail',$data);
    $this->load->view('templates/front/CE_Footer.php',$data);
    
}

public function witnessave(){

  $this->load->helper("date_helper");
  $this->load->helper("common_helper");
  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $modify_party= ($this->input->post('modify_party'));

  $ip = get_ip();
  $ip = $ip;
  $ts = date('Y-m-d H:i:s');
  $updated_at = $ts;

//if (!empty($modify_party)) {

  if($modify_party !=''){
    $this->form_validation->set_rules('w_first_name', 'First Name', 'required');
    $this->form_validation->set_rules('w_salutation_id', 'Title', 'required');
    $this->form_validation->set_rules('w_gender_id', 'Gender', 'required');
    $this->form_validation->set_rules('w_age_years', 'Age', 'required');
    $this->form_validation->set_rules('w_state_id', 'State', 'required');
    $this->form_validation->set_rules('w_dist_id', 'District', 'required');
    $this->form_validation->set_rules('w_country_id', 'Country', 'required');
    //$this->form_validation->set_rules('w_mob_no', 'Mobile no', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      if($this->isUserLoggedIn) 
      {
        $con = array( 
          'id' => $this->session->userdata('userId') 
        ); 
        $data['user'] = $this->login_model->getRows($con);
        $this->load->helper("date_helper");
        $data['complainant_type'] = $this->common_model->getComplaint();
        $data['salution'] = $this->common_model->getSalution();
        $data['gender'] = $this->common_model->getGender();
        $data['nationality'] = $this->common_model->getNationality();
        $data['identityproof'] = $this->common_model->getIdentityproof();
        $data['residenceproof'] = $this->common_model->getResidence();
        $data['getcountry'] = $this->common_model->getCountry();
        $data['complaintmode'] = $this->common_model->getComplaintmode();
        $data['state'] = $this->common_model->getStateName();                 
        $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
        $this->load->view('filing/witnessdetail.php',$data);
        $this->load->view('templates/front/CE_Header.php',$data);
        $this->load->view('templates/front/CE_Footer.php',$data);
        
      }
      else
      {
        redirect('admin/login'); 
      }
    }

    else
    {
      $curYear = date('Y');
      $complaint_year =$curYear;
      $ref_no=$ref_no;
      $user_id=$userid;
      $status='0';
      $w_salutation_id= ($this->input->post('w_salutation_id'));
      $w_sur_name= ($this->input->post('w_sur_name'));
      $w_mid_name= ($this->input->post('w_mid_name'));
      $w_first_name= ($this->input->post('w_first_name'));
      $w_gender_id= ($this->input->post('w_gender_id'));
      $w_age_years= ($this->input->post('w_age_years')); 
      $w_add1= ($this->input->post('w_add1'));
      $w_hpnl= ($this->input->post('w_hpnl'));
      $w_state_id= ($this->input->post('w_state_id'));
      $w_dist_id= ($this->input->post('w_dist_id'));
      $w_pin_code= ($this->input->post('w_pin_code'));
      $w_country_id= ($this->input->post('w_country_id'));
      $w_vill_city= ($this->input->post('w_vill_city'));
      $w_tel_no= ($this->input->post('w_tel_no'));
      $w_mob_no= ($this->input->post('w_mob_no'));
      $w_email_id= ($this->input->post('w_email_id'));
      $ip=$ip;
      $updated_at=$updated_at;

      $formwitnessDataModify = array(
        'status'=>'0',
        'complaint_year'=>$complaint_year,
        'ref_no' => $ref_no,
        'w_salutation_id'=> $w_salutation_id,
        'w_sur_name'=> $w_sur_name,
        'w_mid_name'=> $w_mid_name,
        'w_first_name'=>$w_first_name,
        'w_gender_id'=>$w_gender_id,
        'w_age_years'=>$w_age_years,
        'w_add1'=>$w_add1,    
        'w_hpnl'=> $w_hpnl,      
        'w_state_id'=> $w_state_id,     
        'w_dist_id'=> $w_dist_id,
        'w_pin_code'=> $w_pin_code,
        'w_country_id'=> $w_country_id,      
        'w_vill_city'=> $w_vill_city,
        'w_tel_no'=> $w_tel_no,
        'w_mob_no'=> $w_mob_no,      
        'w_email_id'=> $w_email_id,
        'user_id'=>$userid,
        'ip'=>$ip,
        'updated_at'=>$updated_at,
      );    


      $data = $this->filing_model->insert_partC_witness_his($ref_no,$modify_party);
      $additionalinfo = $this->filing_model->witnessModify($formwitnessDataModify,$modify_party);
      if($additionalinfo){ 
        $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">witness detail data has been successfully modified.</h4></div>'); 
         redirect('/respondent/witnessdetail',$data);
      } 
      else
      {
        echo "chk data";
      } 
    }
  }

    else
    {

   // echo "second";die();

      $this->form_validation->set_rules('w_first_name', 'First Name', 'required');
      $this->form_validation->set_rules('w_salutation_id', 'Title', 'required');
      $this->form_validation->set_rules('w_gender_id', 'Gender', 'required');
      $this->form_validation->set_rules('w_age_years', 'Age', 'required');
      $this->form_validation->set_rules('w_state_id', 'State', 'required');
      $this->form_validation->set_rules('w_dist_id', 'District', 'required');
      $this->form_validation->set_rules('w_country_id', 'Country', 'required');
      ///his->form_validation->set_rules('w_mob_no', 'Mobile no', 'required');
      if ($this->form_validation->run() == FALSE)
      {
        if($this->isUserLoggedIn) 
        {
          $con = array( 
            'id' => $this->session->userdata('userId') 
          ); 
          $data['user'] = $this->login_model->getRows($con);
          $this->load->helper("date_helper");
          $data['complainant_type'] = $this->common_model->getComplaint();
          $data['salution'] = $this->common_model->getSalution();
          $data['gender'] = $this->common_model->getGender();
          $data['nationality'] = $this->common_model->getNationality();
          $data['identityproof'] = $this->common_model->getIdentityproof();
          $data['residenceproof'] = $this->common_model->getResidence();
          $data['getcountry'] = $this->common_model->getCountry();
          $data['complaintmode'] = $this->common_model->getComplaintmode();
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $this->load->view('filing/witnessdetail.php',$data);
          $this->load->view('templates/front/CE_Header.php',$data);

$this->load->view('templates/front/CE_Footer.php',$data);
          }
        else
        {
          redirect('admin/login'); 
        }
      }

      else
      {
  //echo "here";die;
        $ip = get_ip();
        $ip = $ip;
        $ts = date('Y-m-d H:i:s');
        $created_at = $ts;
        $witness = $this->report_model->getWitness($ref_no);
        $ct=count($witness);
        $wt_data=$ct+1;
        $wt_data='witness'.$wt_data;


    //$array['user_id'];
        $curYear = date('Y');
        $complaint_year =$curYear;
        $ref_no=$ref_no;
        $user_id=$userid;
        $witness_detail=$wt_data;
        $status='0';
        $w_salutation_id= ($this->input->post('w_salutation_id'));
        $w_sur_name= ($this->input->post('w_sur_name'));
        $w_mid_name= ($this->input->post('w_mid_name'));
        $w_first_name= ($this->input->post('w_first_name'));
        $w_gender_id= ($this->input->post('w_gender_id'));
        $w_age_years= ($this->input->post('w_age_years')); 
        $w_add1= ($this->input->post('w_add1'));
        $w_hpnl= ($this->input->post('w_hpnl'));
        $w_state_id= ($this->input->post('w_state_id'));
        $w_dist_id= ($this->input->post('w_dist_id'));
        $w_pin_code= ($this->input->post('w_pin_code'));
        $w_country_id= ($this->input->post('w_country_id'));
        $w_vill_city= ($this->input->post('w_vill_city'));
        $w_tel_no= ($this->input->post('w_tel_no'));
        $w_mob_no= ($this->input->post('w_mob_no'));
        $w_email_id= ($this->input->post('w_email_id'));
        $ip=$ip;
        $created_at=$created_at;

        $formwitnessdata = array(
          'status'=>'0',
          'complaint_year'=>$complaint_year,
          'ref_no' => $ref_no,
          'w_salutation_id'=> $w_salutation_id,
          'w_sur_name'=> $w_sur_name,
          'w_mid_name'=> $w_mid_name,
          'w_first_name'=>$w_first_name,
          'w_gender_id'=>$w_gender_id,
          'w_age_years'=>$w_age_years,
          'w_add1'=>$w_add1,    
          'w_hpnl'=> $w_hpnl,      
          'w_state_id'=> $w_state_id,     
          'w_dist_id'=> $w_dist_id,
          'w_pin_code'=> $w_pin_code,
          'w_country_id'=> $w_country_id,      
          'w_vill_city'=> $w_vill_city,
          'w_tel_no'=> $w_tel_no,
          'w_mob_no'=> $w_mob_no,      
          'w_email_id'=> $w_email_id,
          'user_id'=>$userid,
          'witness_detail'=>$wt_data,
          'ip'=>$ip,
          'created_at'=>$created_at,

        );

        $employeeId = $this->filing_model->addWitnessdata($formwitnessdata);
        if($employeeId){ 
          $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Witness detail data has been successfully added.</h4></div>'); 
           redirect('/respondent/witnessdetail',$data); 
        }
        else
        {
            echo "chk data";
        }
      }

    }                  
   // redirect('/respondent/witnessdetail',$data); 
  // $this->load->view('filing/witnessdetail.php',$data);   

  }

public function validate_image($t,$parameter) {
      return $this->file_upload->validate_image($t,$parameter);
    }
  

public function save(){	

  //echo "in here first time";die;
  $this->load->helper("date_helper");
  $this->load->helper("common_helper");
  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $data['partc'] = $this->report_model->getPartc($ref_no);
$data['farma'] = $this->common_model->getFormadata($ref_no);
  $periodf_coa= ($this->input->post('periodf_coa'));
  if($periodf_coa !='')
  {
    $periodf_coa = get_entrydate($periodf_coa);
  }
  else
  {
    $periodf_coa = null;
  }
$periodt_coa= ($this->input->post('periodt_coa'));
if($periodt_coa !='')
{
  $periodt_coa = get_entrydate($periodt_coa);
}
else
{
  $periodt_coa = null;
}  
if (empty($data['partc']))
   {

    //echo "above";die('first');

    /*first time*/
        $ip = get_ip();
        $ip = $ip;
        $ts = date('Y-m-d H:i:s');
        $created_at = $ts;
        $tsnew=date('Y-m-d');
        $t=date("H:i:s");        
        $new_name = time().'_'.$ref_no.'_'.$tsnew;

//relevant data upload
           $filename=$_FILES['relevant_evidence_upload']['name'];
           $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename);
          if(!empty($_FILES['relevant_evidence_upload']['name']))
       {     
        // $config['encrypt_name'] = TRUE;  
          $config['upload_path']   = './cdn/relevant_evidence/'; 
          $config['allowed_types'] = 'gif|jpg|pdf';      
          //$config['max_size']      = 15000;
          $config['file_name'] = $new_name.$filename;
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
          if ( ! $this->upload->do_upload('relevant_evidence_upload'))
          {
             $error = array('error' => $this->upload->display_errors());            
          }
          else
          { 
            $uploadedImage = $this->upload->data();      
          } 
           $relevant_evidence_upload='cdn/relevant_evidence/'.$new_name.$filename.$ext;
        }      
        else
          {
            $relevant_evidence_upload='';
          } 

      //sum_fact_allegation_upload
         $filename=$_FILES['sum_fact_allegation_upload']['name'];
          $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename);
          if(!empty($_FILES['sum_fact_allegation_upload']['name']))
        {     
         
          $config['upload_path']   = './cdn/fact_allegation/'; 
          $config['allowed_types'] = 'pdf';      
          //$config['max_size']      = 15000;
           $config['file_name'] = $new_name.$filename;
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('sum_fact_allegation_upload'))
            {
              $error = array('error' => $this->upload->display_errors());               
            }
            else
            { 
              $uploadedImage = $this->upload->data();      
            }       
             $sum_fact_allegation_upload='cdn/fact_allegation/'.$new_name.$filename.$ext;
         }      
            else
            {
              $sum_fact_allegation_upload='';
            } 
       // detail_offence_upload
          $filename=$_FILES['detail_offence_upload']['name'];
          $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename); 
          if(!empty($_FILES['detail_offence_upload']['name']))
         {     
         
              $config['upload_path']   = './cdn/detail_offence/'; 
              $config['allowed_types'] = 'gif|jpg|pdf';      
              //$config['max_size']      = 9024;
               $config['file_name'] = $new_name.$filename;
              $this->upload->initialize($config);
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('detail_offence_upload'))
              {
                    $error = array('error' => $this->upload->display_errors()); 
                
              }
              else
              { 
                $uploadedImage = $this->upload->data();      
              }       
              $detail_offence_upload='cdn/detail_offence/'.$new_name.$filename.$ext;
           }      
            else
            {
              $detail_offence_upload='';
            }  
        $this->form_validation->set_rules('ps_salutation_id', 'Title', 'required');
        $this->form_validation->set_rules('ps_first_name', 'First Name', 'required');
        $this->form_validation->set_rules('complaint_capacity_id', 'Complaint Category', 'required');
        $this->form_validation->set_rules('ps_id', 'Complaint Sub Category', 'required');
        $this->form_validation->set_rules('periodf_coa', 'Offence From', 'required');
        $this->form_validation->set_rules('periodt_coa', 'Offence To', 'required');
        $this->form_validation->set_rules('ps_pl_stateid', 'State', 'required');
        $this->form_validation->set_rules('ps_pl_dist_id', 'District', 'required');
      
        if(!empty($_FILES['sum_fact_allegation_upload']['name']))
        {   
          $parameters = $_FILES['sum_fact_allegation_upload']['name']."||".$_FILES['sum_fact_allegation_upload']['size']."||".$_FILES['sum_fact_allegation_upload']['tmp_name'];      
          $this->form_validation->set_rules('sum_fact_allegation_upload', '', 'callback_validate_image['.$parameters.']');
        }
        
         if(!empty($_FILES['relevant_evidence_upload']['name']))
        {   
          $parameters = $_FILES['relevant_evidence_upload']['name']."||".$_FILES['relevant_evidence_upload']['size']."||".$_FILES['relevant_evidence_upload']['tmp_name'];      
          $this->form_validation->set_rules('relevant_evidence_upload', '', 'callback_validate_image['.$parameters.']');
        }
         
         if(!empty($_FILES['detail_offence_upload']['name']))
        {   
          $parameters = $_FILES['detail_offence_upload']['name']."||".$_FILES['detail_offence_upload']['size']."||".$_FILES['detail_offence_upload']['tmp_name'];      
          $this->form_validation->set_rules('detail_offence_upload', '', 'callback_validate_image['.$parameters.']');
        }


        if ($this->form_validation->run() == FALSE)
       {
                if($this->isUserLoggedIn) 
              { 

                        $con = array( 
                          'id' => $this->session->userdata('userId') 
                        ); 

                      $data['user'] = $this->login_model->getRows($this->con);  
                      $this->load->library('label');
                      $this->load->helper("date_helper");
                      $ref_no=$this->session->userdata('ref_no');
                      if($ref_no !='')
                      {
                        $data['partc'] = $this->report_model->getPartc($ref_no);
                      }
                      $data['salution'] = $this->common_model->getSalution();
                      $data['complainant_type'] = $this->common_model->getComplaint();
                      $data['pscategory'] = $this->common_model->getPscategory();
                      $data['gender'] = $this->common_model->getGender();
                      $data['nationality'] = $this->common_model->getNationality();
                      $data['identityproof'] = $this->common_model->getIdentityproof();
                      $data['residenceproof'] = $this->common_model->getResidence();
                      $data['getcountry'] = $this->common_model->getCountry();
                      $data['complaintmode'] = $this->common_model->getComplaintmode();
                      $data['identity_document_type'] = $this->common_model->getDocument_type();
                      $data['applet'] = $this->common_model->getAppletName();
                      $data['state'] = $this->common_model->getStateName();
                      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);      
                      $data['form_part'] = 'C';

                
                      //$this->load->view('templates/front/header2.php',$data);
                      $this->load->view('templates/front/CE_Header.php',$data);
                      $this->load->view('filing/respondent.php',$data);
                      $this->load->view('templates/front/CE_Footer.php',$data);
              }
                  else
                  {
                    redirect('admin/login'); 
                  }
          }
        else
        {   
        
                //echo "in here first time";

         
                $ref_no=$ref_no;
                $curYear = date('Y');
                $complaint_year =$curYear;
                $ref_no=$ref_no;
                $status='0';
                $user_id=$userid;
                $ps_salutation_id= ($this->input->post('ps_salutation_id'));
                $ps_sur_name= trim($this->input->post('ps_sur_name'));
                $ps_mid_name= trim($this->input->post('ps_mid_name'));
                $ps_first_name= trim($this->input->post('ps_first_name'));
                $ps_dsp_lp= ($this->input->post('ps_dsp_lp'));
                $ps_desig= trim($this->input->post('ps_desig')); 
                $ps_orgn= trim($this->input->post('ps_orgn'));
                $complaint_capacity_id= ($this->input->post('complaint_capacity_id'));
                $ps_id= ($this->input->post('ps_id'));
                $ps_othcate= trim($this->input->post('ps_othcate'));
                $tas_fingoi= ($this->input->post('tas_fingoi'));
                $anninc_onecr= ($this->input->post('anninc_onecr'));
                $dona_fs= ($this->input->post('dona_fs')); 
                $pss_sbbca= ($this->input->post('pss_sbbca'));
                $psc_postheld= trim($this->input->post('psc_postheld'));
                $periodf_coa=$periodf_coa;
                $periodt_coa=$periodt_coa;
                $ps_pl_occ= trim($this->input->post('ps_pl_occ'));
                $ps_pl_stateid= ($this->input->post('ps_pl_stateid'));
                $ps_pl_dist_id= ($this->input->post('ps_pl_dist_id')); 
                $sum_facalle= trim($this->input->post('sum_facalle'));
                $det_offen= trim($this->input->post('det_offen'));
                $prov_viola= trim($this->input->post('prov_viola'));
                $any_othInfo= trim($this->input->post('any_othInfo'));
                $doc_copy_attached= ($this->input->post('doc_copy_attached'));
                $electronic_file= ($this->input->post('electronic_file'));
                $relied_doc_list= trim($this->input->post('relied_doc_list'));
                $present_ps_desig= trim($this->input->post('present_ps_desig'));
                $ip=$ip;
                $created_at=$created_at;
                $relevant_evidence_upload =$relevant_evidence_upload;
                $sum_fact_allegation_upload =$sum_fact_allegation_upload;
                $detail_offence_upload =$detail_offence_upload;                
                $formrespondentdata = array(
                  'status'=>'0',
                  'complaint_year'=>$complaint_year,
                  'ref_no' => $ref_no,
                  'user_id'=>$userid,
                  'ps_salutation_id'=> $ps_salutation_id,
                  'ps_sur_name'=> $ps_sur_name,
                  'ps_mid_name'=>$ps_mid_name,
                  'ps_first_name'=>$ps_first_name,
                  'ps_dsp_lp'=>$ps_dsp_lp,
                  'ps_desig'=>$ps_desig,    
                  'ps_orgn'=> $ps_orgn,      
                  'complaint_capacity_id'=> $complaint_capacity_id,     
                  'ps_id'=> $ps_id,
                  'ps_othcate'=> $ps_othcate,
                  'tas_fingoi'=> $tas_fingoi,      
                  'anninc_onecr'=> $anninc_onecr,
                  'dona_fs'=> $dona_fs,
                  'pss_sbbca'=> $pss_sbbca,      
                  'psc_postheld'=> $psc_postheld,     
                  'periodf_coa'=> $periodf_coa, 
                  'periodt_coa'=>$periodt_coa,
                  'ps_pl_occ'=> $ps_pl_occ,      
                  'ps_pl_stateid'=> $ps_pl_stateid,
                  'ps_pl_dist_id'=> $ps_pl_dist_id,
                  'sum_facalle'=> $sum_facalle,      
                  'det_offen'=> $det_offen,     
                  'prov_viola'=> $prov_viola, 
                  'any_othInfo'=>$any_othInfo,
                  'doc_copy_attached'=> $doc_copy_attached,
                  'electronic_file'=> $electronic_file,
                  'relied_doc_list'=> $relied_doc_list,      
                  'present_ps_desig'=> $present_ps_desig,
                  'ip'=>$ip,
                  'created_at'=>$created_at,
                  'relevant_evidence_upload' =>$relevant_evidence_upload,
                  'sum_fact_allegation_upload' =>$sum_fact_allegation_upload,
                  'detail_offence_upload' =>$detail_offence_upload,                 
                );    
                $employeeId = $this->filing_model->addRespondent($formrespondentdata);
                redirect('/document/testafidavit');
                die();
           }       
       
     }
       else
         {

        //  echo "here below";die('second');

        $this->form_validation->set_rules('ps_salutation_id', 'Title', 'required');
        $this->form_validation->set_rules('ps_first_name', 'First Name', 'required');
        $this->form_validation->set_rules('complaint_capacity_id', 'Complaint Category', 'required');
        $this->form_validation->set_rules('ps_id', 'Complaint Sub Category', 'required');
        $this->form_validation->set_rules('periodf_coa', 'Offence From', 'required');
        $this->form_validation->set_rules('periodt_coa', 'Offence To', 'required');
        $this->form_validation->set_rules('ps_pl_stateid', 'State', 'required');
        $this->form_validation->set_rules('ps_pl_dist_id', 'District', 'required');
         if(!empty($_FILES['sum_fact_allegation_upload']['name']))
        {   
          $parameters = $_FILES['sum_fact_allegation_upload']['name']."||".$_FILES['sum_fact_allegation_upload']['size']."||".$_FILES['sum_fact_allegation_upload']['tmp_name'];      
          $this->form_validation->set_rules('sum_fact_allegation_upload', '', 'callback_validate_image['.$parameters.']');
        }
         if(!empty($_FILES['relevant_evidence_upload']['name']))
        {   
          $parameters = $_FILES['relevant_evidence_upload']['name']."||".$_FILES['relevant_evidence_upload']['size']."||".$_FILES['relevant_evidence_upload']['tmp_name'];      
          $this->form_validation->set_rules('relevant_evidence_upload', '', 'callback_validate_image['.$parameters.']');
        }
         if(!empty($_FILES['detail_offence_upload']['name']))
        {   
          $parameters = $_FILES['detail_offence_upload']['name']."||".$_FILES['detail_offence_upload']['size']."||".$_FILES['detail_offence_upload']['tmp_name'];      
          $this->form_validation->set_rules('detail_offence_upload', '', 'callback_validate_image['.$parameters.']');
        }
             
      
        if ($this->form_validation->run() == FALSE)
       {
                if($this->isUserLoggedIn) 
              { 

                        $con = array( 
                          'id' => $this->session->userdata('userId') 
                        ); 

                      $data['user'] = $this->login_model->getRows($this->con);  
                      $this->load->library('label');
                      $this->load->helper("date_helper");
                      $ref_no=$this->session->userdata('ref_no');
                      if($ref_no !='')
                      {
                        $data['partc'] = $this->report_model->getPartc($ref_no);
                      }
                      $data['salution'] = $this->common_model->getSalution();
                      $data['complainant_type'] = $this->common_model->getComplaint();
                      $data['pscategory'] = $this->common_model->getPscategory();
                      $data['gender'] = $this->common_model->getGender();
                      $data['nationality'] = $this->common_model->getNationality();
                      $data['identityproof'] = $this->common_model->getIdentityproof();
                      $data['residenceproof'] = $this->common_model->getResidence();
                      $data['getcountry'] = $this->common_model->getCountry();
                      $data['complaintmode'] = $this->common_model->getComplaintmode();
                      $data['identity_document_type'] = $this->common_model->getDocument_type();
                      $data['applet'] = $this->common_model->getAppletName();
                      $data['state'] = $this->common_model->getStateName();
                      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);      
                      $data['form_part'] = 'C';
                     // $this->load->view('templates/front/header2.php',$data);
                      $this->load->view('templates/front/CE_Header.php',$data);
                      $this->load->view('filing/respondent.php',$data);
                      $this->load->view('templates/front/CE_Footer.php',$data);
              }
                  else
                  {
                    redirect('admin/login'); 
                  }

          }
        else
        { 
          //echo "success";die;        
        $part_c = $this->report_model->getPartc($ref_no);
        $relevant_evidence_upload=$part_c['relevant_evidence_upload'];
        $ip = get_ip();
        $ip = $ip;
        $ts = date('Y-m-d H:i:s');
        $updated_at = $ts;
        $tsnew=date('Y-m-d');
        $t=date("H:i:s");         
        $new_name = time().'_'.$ref_no.'_'.$tsnew;
        //relevant data upload
       $filename=$_FILES['relevant_evidence_upload']['name'];
        $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename);
    if(!empty($_FILES['relevant_evidence_upload']['name']))
      {        
        $config['upload_path']   = './cdn/relevant_evidence/'; 
        $config['allowed_types'] = 'gif|jpg|pdf';      
        //$config['max_size']      = 15000;
        $config['file_name'] = $new_name.$filename;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('relevant_evidence_upload'))
        {
          $error = array('error' => $this->upload->display_errors()); 
          
        }else
        { 
          $uploadedImage = $this->upload->data();      
        } 
        $relevant_evidence_upload='cdn/relevant_evidence/'.$new_name.$filename.$ext;
       }      
        else
        {        
           $part_c = $this->report_model->getPartc($ref_no);
           $relevant_evidence_upload=$part_c['relevant_evidence_upload'];
        }         
      //sum_fact_allegation_upload
        $filename=$_FILES['sum_fact_allegation_upload']['name'];
        $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename);
         if(!empty($_FILES['sum_fact_allegation_upload']['name']))
      {            
              $config['upload_path']   = './cdn/fact_allegation/'; 
              $config['allowed_types'] = 'gif|jpg|pdf';      
              //$config['max_size']      = 15000;
               $config['file_name'] = $new_name.$filename;
              $this->upload->initialize($config);
              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('sum_fact_allegation_upload'))
              {
                $error = array('error' => $this->upload->display_errors()); 
                
              }else
              { 
                $uploadedImage = $this->upload->data();      
              } 
              $sum_fact_allegation_upload='cdn/fact_allegation/'.$new_name.$filename.$ext;
        }      
          else
          {
            $part_c = $this->report_model->getPartc($ref_no);
            $sum_fact_allegation_upload=$part_c['sum_fact_allegation_upload'];        
          }
      //detail_offence_upload
       $filename=$_FILES['detail_offence_upload']['name'];
         $ext = substr($filename, -4, strrpos($filename, '.'));
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = str_replace(' ','',$filename);  
        $filename = str_replace('.','',$filename);
      if(!empty($_FILES['detail_offence_upload']['name']))
       {            
          $config['upload_path']   = './cdn/detail_offence/'; 
          $config['allowed_types'] = 'gif|jpg|pdf';      
          //$config['max_size']      = 15000;
          $config['file_name'] = $new_name.$filename;
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('detail_offence_upload'))
            {
              $error = array('error' => $this->upload->display_errors()); 
              
            }
          else
            { 
              $uploadedImage = $this->upload->data();      
            } 
             $detail_offence_upload='cdn/detail_offence/'.$new_name.$filename.$ext;
       }      
        else
          {
            $part_c = $this->report_model->getPartc($ref_no);
            $detail_offence_upload=$part_c['detail_offence_upload'];        
          }
          $periodf_coa= ($this->input->post('periodf_coa'));
          if($periodf_coa !='')
          {
            $periodf_coa = get_entrydate($periodf_coa);
          }
           else
          {
            $periodf_coa = null;
          }
         $periodt_coa= ($this->input->post('periodt_coa'));
          if($periodt_coa !='')
          {
            $periodt_coa = get_entrydate($periodt_coa);
          }
          else
          {
            $periodt_coa = null;
          }
 //echo "in second time";die;
          
    $ref_no=$ref_no;
    $curYear = date('Y');
    $complaint_year =$curYear;
    $ref_no=$ref_no;
    $status='0';
    $user_id=$userid;
    $ps_salutation_id= ($this->input->post('ps_salutation_id'));
    $ps_sur_name= trim($this->input->post('ps_sur_name'));
    $ps_mid_name= trim($this->input->post('ps_mid_name'));
    $ps_first_name= trim($this->input->post('ps_first_name'));
    $ps_dsp_lp= ($this->input->post('ps_dsp_lp'));
    $ps_desig= trim($this->input->post('ps_desig')); 
    $ps_orgn= trim($this->input->post('ps_orgn'));
    $complaint_capacity_id= ($this->input->post('complaint_capacity_id'));
    $ps_id= ($this->input->post('ps_id'));
    $ps_othcate= trim($this->input->post('ps_othcate'));
    $tas_fingoi= ($this->input->post('tas_fingoi'));
    $anninc_onecr= ($this->input->post('anninc_onecr'));
    $dona_fs= ($this->input->post('dona_fs')); 
    $pss_sbbca= ($this->input->post('pss_sbbca'));
    $psc_postheld= trim($this->input->post('psc_postheld'));
    $periodf_coa=$periodf_coa;
    $periodt_coa=$periodt_coa;
    $ps_pl_occ= trim($this->input->post('ps_pl_occ'));
    $ps_pl_stateid= ($this->input->post('ps_pl_stateid'));
    $ps_pl_dist_id= ($this->input->post('ps_pl_dist_id')); 
    $sum_facalle= trim($this->input->post('sum_facalle'));
    $det_offen= trim($this->input->post('det_offen'));
    $prov_viola= trim($this->input->post('prov_viola'));
    $any_othInfo= trim($this->input->post('any_othInfo'));
    $doc_copy_attached= ($this->input->post('doc_copy_attached'));
    $electronic_file= ($this->input->post('electronic_file'));
    $relied_doc_list= trim($this->input->post('relied_doc_list'));
    $present_ps_desig= trim($this->input->post('present_ps_desig'));
    $ip=$ip;
    $updated_at=$updated_at;
    $relevant_evidence_upload =$relevant_evidence_upload;
    $sum_fact_allegation_upload =$sum_fact_allegation_upload;
     $detail_offence_upload =$detail_offence_upload;

    $formrespondentdata = array(
      'status'=>'0',
      'complaint_year'=>$complaint_year,
      'ref_no' => $ref_no,
      'user_id'=>$userid,
      'ps_salutation_id'=> $ps_salutation_id,
      'ps_sur_name'=> $ps_sur_name,
      'ps_mid_name'=>$ps_mid_name,
      'ps_first_name'=>$ps_first_name,
      'ps_dsp_lp'=>$ps_dsp_lp,
      'ps_desig'=>$ps_desig,    
      'ps_orgn'=> $ps_orgn,      
      'complaint_capacity_id'=> $complaint_capacity_id,     
      'ps_id'=> $ps_id,
      'ps_othcate'=> $ps_othcate,
      'tas_fingoi'=> $tas_fingoi,      
      'anninc_onecr'=> $anninc_onecr,
      'dona_fs'=> $dona_fs,
      'pss_sbbca'=> $pss_sbbca,      
      'psc_postheld'=> $psc_postheld,     
      'periodf_coa'=> $periodf_coa, 
      'periodt_coa'=>$periodt_coa,
      'ps_pl_occ'=> $ps_pl_occ,      
      'ps_pl_stateid'=> $ps_pl_stateid,
      'ps_pl_dist_id'=> $ps_pl_dist_id,
      'sum_facalle'=> $sum_facalle,      
      'det_offen'=> $det_offen,     
      'prov_viola'=> $prov_viola, 
      'any_othInfo'=>$any_othInfo,
      'doc_copy_attached'=> $doc_copy_attached,
      'electronic_file'=> $electronic_file,
      'relied_doc_list'=> $relied_doc_list,      
      'present_ps_desig'=> $present_ps_desig,
      'ip'=>$ip,
      'updated_at'=>$updated_at,
       'relevant_evidence_upload' =>$relevant_evidence_upload,
       'sum_fact_allegation_upload' =>$sum_fact_allegation_upload,
       'detail_offence_upload' =>$detail_offence_upload,
    ); 
    $data = $this->filing_model->insert_partC_his($ref_no);
    $employeeId = $this->filing_model->modify_form_C_filing($formrespondentdata);       
    redirect('/document/testafidavit');
    
   } 
  } 
  
}
public function employeelist(){
  $query = $this->HomeModel->getEmployee();
  if($query){
   $data['EMPLOYEES'] =  $query;
 }
 $this->load->view('result.php', $data);
}

public function getdistrict()
{
 $query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));
 
 //echo "<pre>";
 //print_r($query);
 if(!empty($query))
 {
   foreach($query as $value)
   {
     echo '<option value="'.$value->district_code.'">'.$value->name.'</option>';
   }
   
 }

}

public function getdistrict2()
{
 $query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));
 
 //echo "<pre>";
 //print_r($query);
 if(!empty($query))
 {
   foreach($query as $value)
   {
     echo '<option value="'.$value->district_code2.'">'.$value->name.'</option>';
   }
   
 }

}


public function getdistrict3()
{
 $query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));
 
 //echo "<pre>";
 //print_r($query);
 if(!empty($query))
 {
   foreach($query as $value)
   {
     echo '<option value="'.$value->district_code3.'">'.$value->name.'</option>';
   }
   
 }

}

 public function ad_public_servant(){  
 
    $data['user'] = $this->login_model->getRows($this->con);  
    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);    
    $this->load->library('label');
    $ref_no=$this->session->userdata('ref_no');
    $data['addparty'] = $this->report_model->getAddps_detail($ref_no);
    $data['salution'] = $this->common_model->getSalution();
    $data['gender'] = $this->common_model->getGender();
    $data['nationality'] = $this->common_model->getNationality();
    $data['identityproof'] = $this->common_model->getIdentityproof();
    $data['residenceproof'] = $this->common_model->getResidence();
    $data['getcountry'] = $this->common_model->getCountry();
    $data['complaintmode'] = $this->common_model->getComplaintmode();
    $data['identity_document_type'] = $this->common_model->getDocument_type();
    $data['applet'] = $this->common_model->getAppletName();
    $data['state'] = $this->common_model->getStateName();
    $data['complainant_type'] = $this->common_model->getComplaint();
    $data['pscategory'] = $this->common_model->getPscategory();

    //echo "<pre>";
    //print_r($data);die;
    $this->load->view('templates/front/CE_Header.php',$data);
    $this->load->view('filing/ad_public_servant.php',$data);
    $this->load->view('templates/front/CE_Footer.php',$data);
    
}


public function ad_ps_save(){

  $this->load->helper("date_helper");
  $this->load->helper("common_helper");
  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $modify_party= ($this->input->post('modify_party'));

  $ip = get_ip();
  $ip = $ip;
  $ts = date('Y-m-d H:i:s');
  $updated_at = $ts;

  if($modify_party !='')
  {
    //echo "in modify";die;

      $this->form_validation->set_rules('ad_ps_salutation_id', 'Title', 'required');
      $this->form_validation->set_rules('ad_ps_first_name', 'First Name', 'required');
      $this->form_validation->set_rules('ad_complaint_capacity_id', 'Category', 'required');
      $this->form_validation->set_rules('ad_ps_id', 'Sub Category', 'required');
      $this->form_validation->set_rules('ad_periodf_coa', 'From date', 'required');
      $this->form_validation->set_rules('ad_periodt_coa', 'To date', 'required');
      $this->form_validation->set_rules('ad_ps_pl_stateid', 'State', 'required');
      $this->form_validation->set_rules('ad_ps_pl_dist_id', 'District', 'required');
       if ($this->form_validation->run() == FALSE)
      {
        if($this->isUserLoggedIn) 
        {
          $con = array( 
            'id' => $this->session->userdata('userId') 
          ); 
          $data['user'] = $this->login_model->getRows($con);
          $this->load->helper("date_helper");
          $data['complainant_type'] = $this->common_model->getComplaint();
          $data['salution'] = $this->common_model->getSalution();
          $data['gender'] = $this->common_model->getGender();
          $data['nationality'] = $this->common_model->getNationality();         
          $data['getcountry'] = $this->common_model->getCountry();
          $data['complaintmode'] = $this->common_model->getComplaintmode();
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/ad_public_servant.php',$data);
          $this->load->view('templates/front/CE_Footer.php',$data);
          }
        else
        {
          redirect('admin/login'); 
        }
      }
else
{
    $curYear = date('Y');
    $complaint_year =$curYear;
    $ref_no=$ref_no;
    $user_id=$userid;   
    $status='0';
    $ad_ps_salutation_id= ($this->input->post('ad_ps_salutation_id'));
    $ad_ps_sur_name= ($this->input->post('ad_ps_sur_name'));
    $ad_ps_mid_name= ($this->input->post('ad_ps_mid_name'));
    $ad_ps_first_name= ($this->input->post('ad_ps_first_name'));
    $ad_ps_dsp_lp= ($this->input->post('ad_ps_dsp_lp'));
    $ad_ps_desig= ($this->input->post('ad_ps_desig')); 
    $ad_ps_orgn= ($this->input->post('ad_ps_orgn'));
    $ad_complaint_capacity_id= ($this->input->post('ad_complaint_capacity_id'));
    $ad_ps_id= ($this->input->post('ad_ps_id'));
    $ad_ps_othcate= ($this->input->post('ad_ps_othcate'));
    $ad_tas_fingoi= ($this->input->post('ad_tas_fingoi'));
    $ad_anninc_onecr= ($this->input->post('ad_anninc_onecr'));
    $ad_dona_fs= ($this->input->post('ad_dona_fs'));
    $ad_pss_sbbca= ($this->input->post('ad_pss_sbbca'));
    $ad_psc_postheld= ($this->input->post('ad_psc_postheld'));
    $ad_periodf_coa= ($this->input->post('ad_periodf_coa'));
    $ad_periodf_coa = get_entrydate($ad_periodf_coa);
    $ad_periodt_coa= ($this->input->post('ad_periodt_coa'));
    $ad_periodt_coa = get_entrydate($ad_periodt_coa);
    $ad_ps_pl_occ= ($this->input->post('ad_ps_pl_occ'));
    $ad_ps_pl_stateid= ($this->input->post('ad_ps_pl_stateid'));
    $ad_ps_pl_dist_id= ($this->input->post('ad_ps_pl_dist_id'));
    $ad_present_ps_desig= ($this->input->post('ad_present_ps_desig'));
    $ip=$ip;
    $updated_at=$updated_at;

    $formPsDataModify = array(
      'status'=>'0',
      'complaint_year'=>$complaint_year,
      'ref_no' => $ref_no,
      'ad_ps_salutation_id'=> $ad_ps_salutation_id,
      'ad_ps_sur_name'=> $ad_ps_sur_name,
      'ad_ps_mid_name'=> $ad_ps_mid_name,
      'ad_ps_first_name'=>$ad_ps_first_name,
      'ad_ps_dsp_lp'=>$ad_ps_dsp_lp,
      'ad_ps_desig'=>$ad_ps_desig,
      'ad_ps_orgn'=>$ad_ps_orgn,    
      'ad_complaint_capacity_id'=> $ad_complaint_capacity_id,      
      'ad_ps_id'=> $ad_ps_id,     
      'ad_ps_othcate'=> $ad_ps_othcate,
      'ad_tas_fingoi'=> $ad_tas_fingoi,
      'ad_anninc_onecr'=> $ad_anninc_onecr,      
      'ad_dona_fs'=> $ad_dona_fs,
      'ad_pss_sbbca'=> $ad_pss_sbbca,
      'ad_psc_postheld'=> $ad_psc_postheld,      
      'ad_periodf_coa'=> $ad_periodf_coa,
      'ad_periodt_coa'=> $ad_periodt_coa,
      'ad_ps_pl_occ'=> $ad_ps_pl_occ,      
      'ad_ps_pl_stateid'=> $ad_ps_pl_stateid,
      'ad_ps_pl_dist_id'=> $ad_ps_pl_dist_id,
      'ad_present_ps_desig'=> $ad_present_ps_desig,
      'user_id'=>$userid,     
      'ip'=>$ip,
      'updated_at'=>$updated_at,
    );    


    $data = $this->report_model->insert_partC_ps_his($ref_no,$modify_party);
    $additionalinfo = $this->report_model->PsModify($formPsDataModify,$modify_party);
    if($additionalinfo){ 
      $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Public Servant detail data has been successfully modified.</h4></div>'); 
       redirect('/respondent/ad_public_servant',$data);  
    }  
    else
    {
      echo "check data";
    }
  }
}

  else
  {

     $this->form_validation->set_rules('ad_ps_salutation_id', 'Title', 'required');
      $this->form_validation->set_rules('ad_ps_first_name', 'First Name', 'required');
      $this->form_validation->set_rules('ad_complaint_capacity_id', 'Category', 'required');
      $this->form_validation->set_rules('ad_ps_id', 'Sub Category', 'required');
      $this->form_validation->set_rules('ad_periodf_coa', 'From date', 'required');
      $this->form_validation->set_rules('ad_periodt_coa', 'To date', 'required');
      $this->form_validation->set_rules('ad_ps_pl_stateid', 'State', 'required');
      $this->form_validation->set_rules('ad_ps_pl_dist_id', 'District', 'required');
       if ($this->form_validation->run() == FALSE)
      {
        if($this->isUserLoggedIn) 
        {
          $con = array( 
            'id' => $this->session->userdata('userId') 
          ); 
          $data['user'] = $this->login_model->getRows($con);
          $this->load->helper("date_helper");
          $data['complainant_type'] = $this->common_model->getComplaint();
          $data['salution'] = $this->common_model->getSalution();
          $data['gender'] = $this->common_model->getGender();
          $data['nationality'] = $this->common_model->getNationality();         
          $data['getcountry'] = $this->common_model->getCountry();
          $data['complaintmode'] = $this->common_model->getComplaintmode();
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/ad_public_servant.php',$data);
          $this->load->view('templates/front/CE_Footer.php',$data);
          }
        else
        {
          redirect('admin/login'); 
        }
      }
else
{
    $ip = get_ip();
    $ip = $ip;
    $ts = date('Y-m-d H:i:s');
    $created_at = $ts;

    $ad_ps = $this->report_model->getAdps_detail($ref_no);
    $ct=count($ad_ps);
    $ps_data=$ct+1;
    $ps_data='public servant'.$ps_data;

   // echo $ps_data;die;
    //$array['user_id'];
    $curYear = date('Y');
    $complaint_year =$curYear;
    $ref_no=$ref_no;
    $user_id=$userid;
    $ps_detail=$ps_data;
    $status='0';
    $ad_ps_salutation_id= ($this->input->post('ad_ps_salutation_id'));
    $ad_ps_sur_name= ($this->input->post('ad_ps_sur_name'));
    $ad_ps_mid_name= ($this->input->post('ad_ps_mid_name'));
    $ad_ps_first_name= ($this->input->post('ad_ps_first_name'));
    $ad_ps_dsp_lp= ($this->input->post('ad_ps_dsp_lp'));
    $ad_ps_desig= ($this->input->post('ad_ps_desig')); 
    $ad_ps_orgn= ($this->input->post('ad_ps_orgn'));
    $ad_complaint_capacity_id= ($this->input->post('ad_complaint_capacity_id'));
    $ad_ps_id= ($this->input->post('ad_ps_id'));
    $ad_ps_othcate= ($this->input->post('ad_ps_othcate'));
    $ad_tas_fingoi= ($this->input->post('ad_tas_fingoi'));
    $ad_anninc_onecr= ($this->input->post('ad_anninc_onecr'));
    $ad_dona_fs= ($this->input->post('ad_dona_fs'));
    $ad_pss_sbbca= ($this->input->post('ad_pss_sbbca'));
    $ad_psc_postheld= ($this->input->post('ad_psc_postheld'));
    $ad_periodf_coa= ($this->input->post('ad_periodf_coa'));
    $ad_periodf_coa = get_entrydate($ad_periodf_coa);
    $ad_periodt_coa= ($this->input->post('ad_periodt_coa'));
    $ad_periodt_coa = get_entrydate($ad_periodt_coa);
    $ad_ps_pl_occ= ($this->input->post('ad_ps_pl_occ'));
    $ad_ps_pl_stateid= ($this->input->post('ad_ps_pl_stateid'));
    $ad_ps_pl_dist_id= ($this->input->post('ad_ps_pl_dist_id'));
    $ad_present_ps_desig= ($this->input->post('ad_present_ps_desig'));
    $ip=$ip;
    $created_at=$created_at;

    $form_ad_ps_detail = array(
      'status'=>'0',
      'complaint_year'=>$complaint_year,
      'ref_no' => $ref_no,
      'ad_ps_salutation_id'=> $ad_ps_salutation_id,
      'ad_ps_sur_name'=> $ad_ps_sur_name,
      'ad_ps_mid_name'=> $ad_ps_mid_name,
      'ad_ps_first_name'=>$ad_ps_first_name,
      'ad_ps_dsp_lp'=>$ad_ps_dsp_lp,
      'ad_ps_desig'=>$ad_ps_desig,
      'ad_ps_orgn'=>$ad_ps_orgn,    
      'ad_complaint_capacity_id'=> $ad_complaint_capacity_id,      
      'ad_ps_id'=> $ad_ps_id,     
      'ad_ps_othcate'=> $ad_ps_othcate,
      'ad_tas_fingoi'=> $ad_tas_fingoi,
      'ad_anninc_onecr'=> $ad_anninc_onecr,      
      'ad_dona_fs'=> $ad_dona_fs,
      'ad_pss_sbbca'=> $ad_pss_sbbca,
      'ad_psc_postheld'=> $ad_psc_postheld,      
      'ad_periodf_coa'=> $ad_periodf_coa,
      'ad_periodt_coa'=> $ad_periodt_coa,
      'ad_ps_pl_occ'=> $ad_ps_pl_occ,      
      'ad_ps_pl_stateid'=> $ad_ps_pl_stateid,
      'ad_ps_pl_dist_id'=> $ad_ps_pl_dist_id,
      'ad_present_ps_desig'=> $ad_present_ps_desig,
      'user_id'=>$userid,
      'ps_detail'=>$ps_data,
      'ip'=>$ip,
      'created_at'=>$created_at,

    );
    
    $employeeId = $this->report_model->addPsdata($form_ad_ps_detail);
    if($employeeId){ 
      $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Public Servant detail data has been successfully added.</h4></div>');
       redirect('/respondent/ad_public_servant',$data);  
    }
    else
    {
      echo "check data";
    }

  }  
  }                
 // redirect('/respondent/ad_public_servant',$data);    
  
}

public function getModify_ps()
  {

      //echo $this->input->post('mod_party');
      //echo "in here";
      //echo $mod_party;die;
    $query = $this->report_model->getAddPsdetail($this->input->post('mod_party'));
     //echo "<pre>";
    // print_r($query);die;
    //return json_encode($query);  

    echo json_encode($query);  

  }


  public function additionalparty(){
 
    $data['user'] = $this->login_model->getRows($this->con);
    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
    $ref_no=$this->session->userdata('ref_no');
    $data['addparty'] = $this->report_model->getAddparty_c($ref_no); 
    $this->load->library('label');
    $data['salution'] = $this->common_model->getSalution();
    $data['gender'] = $this->common_model->getGender();
    $data['nationality'] = $this->common_model->getNationality();
    $data['identityproof'] = $this->common_model->getIdentityproof();
    $data['residenceproof'] = $this->common_model->getResidence();
    $data['getcountry'] = $this->common_model->getCountry();
    $data['complaintmode'] = $this->common_model->getComplaintmode();
    $data['identity_document_type'] = $this->common_model->getDocument_type();
    $data['applet'] = $this->common_model->getAppletName();
    $data['state'] = $this->common_model->getStateName();
    //echo "<pre>";
    //print_r($data);die;
    $this->load->view('templates/front/CE_Header.php',$data);
    $this->load->view('filing/additionalparty',$data);
    $this->load->view('templates/front/CE_Footer.php',$data);
    
}


public function addsave(){  

  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $this->load->helper("common_helper");
   $modify_party= ($this->input->post('modify_party'));
  $party_cate='2';
  if($modify_party !='')
  {   
     $this->form_validation->set_rules('affect_name', 'Name', 'required');     
      $this->form_validation->set_rules('affect_gender_id', 'Gender', 'required');
      $this->form_validation->set_rules('affect_ageyears', 'Age', 'required');
      $this->form_validation->set_rules('affect_state_id', 'State', 'required');
      $this->form_validation->set_rules('affect_dist_id', 'District', 'required');
      $this->form_validation->set_rules('affect_country_id', 'Country', 'required');
    //$this->form_validation->set_rules('affect_mob_no', 'Mobile no', 'required');
      if ($this->form_validation->run() == FALSE)
      {
        if($this->isUserLoggedIn) 
        {
          $con = array( 
            'id' => $this->session->userdata('userId') 
          ); 
          $data['user'] = $this->login_model->getRows($con);                 
          $data['gender'] = $this->common_model->getGender();
          $data['nationality'] = $this->common_model->getNationality();        
          $data['getcountry'] = $this->common_model->getCountry();          
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/additionalparty.php',$data);
          $this->load->view('templates/front/CE_Footer.php',$data);
          }
        else
        {
          redirect('admin/login'); 
        }
      }
else
{
    $ip = get_ip();
    $ip = $ip;
    $ts = date('Y-m-d H:i:s');
    $updated_at = $ts;
    $curYear = date('Y');
    $complaint_year =$curYear; 
    $ref_no=$ref_no;
    $user_id=$userid;
    $status='0';   
    $affect_name= ($this->input->post('affect_name'));
    $affect_gender_id= ($this->input->post('affect_gender_id'));
    $affect_ageyears= ($this->input->post('affect_ageyears'));
    $affect_add1= ($this->input->post('affect_add1'));
    $affect_hpnl= ($this->input->post('affect_hpnl'));      
    $affect_state_id= ($this->input->post('affect_state_id'));      
    $affect_dist_id= ($this->input->post('affect_dist_id'));      
    $affect_pin_code= ($this->input->post('affect_pin_code')); 
    $affect_country_id= ($this->input->post('affect_country_id'));
    $affect_vill_city= ($this->input->post('affect_vill_city'));      
    $affect_ccu_desig_avo= ($this->input->post('affect_ccu_desig_avo'));
    $affect_tel_no= ($this->input->post('affect_tel_no'));
    $affect_mob_no= ($this->input->post('affect_mob_no'));
    $affect_email_id= ($this->input->post('affect_email_id'));
    $ip=$ip;
    $updated_at=$updated_at;
    $formmodify = array(
      'status'=>'0',
      'complaint_year'=>$complaint_year,
      'ref_no' => $ref_no,      
      'affect_name'=>$affect_name,
      'affect_gender_id'=>$affect_gender_id,
      'affect_ageyears'=>$affect_ageyears,
      'affect_add1'=> $affect_add1,
      'affect_hpnl'=> $affect_hpnl,   
      'affect_state_id'=>$affect_state_id,       
      'affect_dist_id'=> $affect_dist_id,     
      'affect_pin_code'=> $affect_pin_code, 
      'affect_country_id'=>$affect_country_id,
      'affect_vill_city'=> $affect_vill_city,    
      'affect_ccu_desig_avo'=> $affect_ccu_desig_avo,
      'affect_tel_no'=> $affect_tel_no,
      'affect_mob_no'=> $affect_mob_no,
      'affect_email_id'=> $affect_email_id,
      'user_id'=>$userid,
      'ip'=>$ip,
      'updated_at'=>$updated_at,

    );
    $data = $this->filing_model->insert_partB_additional_party_his($ref_no,$modify_party);
    $additionalinfo = $this->filing_model->additionalpartyModify($formmodify,$modify_party,$party_cate);

    if($additionalinfo){ 
      $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Third party detail has been successfully Modified.</h4></div>'); 
      redirect('/respondent/additionalparty',$data);
    } 
    else
    {
      echo "check data";
    }
}
  }

  else{     
      $this->form_validation->set_rules('affect_name', 'Name', 'required');     
      $this->form_validation->set_rules('affect_gender_id', 'Gender', 'required');
      $this->form_validation->set_rules('affect_ageyears', 'Age', 'required');
      $this->form_validation->set_rules('affect_state_id', 'State', 'required');
      $this->form_validation->set_rules('affect_dist_id', 'District', 'required');
      $this->form_validation->set_rules('affect_country_id', 'Country', 'required');
    //  $this->form_validation->set_rules('affect_mob_no', 'Mobile no', 'required');
      if ($this->form_validation->run() == FALSE)
      {
        if($this->isUserLoggedIn) 
        {
          $con = array( 
            'id' => $this->session->userdata('userId') 
          ); 
          $data['user'] = $this->login_model->getRows($con);                 
          $data['gender'] = $this->common_model->getGender();
          $data['nationality'] = $this->common_model->getNationality();        
          $data['getcountry'] = $this->common_model->getCountry();          
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
         $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/additionalparty.php',$data);
          $this->load->view('templates/front/CE_Footer.php',$data);
          }
        else
        {
          redirect('admin/login'); 
        }
      }
else
{
    $addparty = $this->report_model->getAddparty_c($ref_no);
    $ct=count($addparty);
    $ad_data=$ct+1;
    $ad_data='third party'.$ad_data;
    $data['salution'] = $this->common_model->getSalution();
    $data['gender'] = $this->common_model->getGender();
    $data['nationality'] = $this->common_model->getNationality();
    $data['identityproof'] = $this->common_model->getIdentityproof();
    $data['residenceproof'] = $this->common_model->getResidence();
    $data['getcountry'] = $this->common_model->getCountry();
    $data['complaintmode'] = $this->common_model->getComplaintmode();
    $data['identity_document_type'] = $this->common_model->getDocument_type();
    $data['applet'] = $this->common_model->getAppletName();
    $data['state'] = $this->common_model->getStateName(); 


    $ip = get_ip();
    $ip = $ip;
    $ts = date('Y-m-d H:i:s');
    $created_at = $ts;    

    $curYear = date('Y');
    $complaint_year =$curYear; 
    $ref_no=$ref_no;
    $user_id=$userid;
    $add_party=$ad_data;
    $status='0';
    $party_cate= '2';
    $affect_name= ($this->input->post('affect_name'));
    $affect_gender_id= ($this->input->post('affect_gender_id'));
    $affect_ageyears= ($this->input->post('affect_ageyears'));
    $affect_add1= ($this->input->post('affect_add1'));
    $affect_hpnl= ($this->input->post('affect_hpnl'));      
    $affect_state_id= ($this->input->post('affect_state_id'));      
    $affect_dist_id= ($this->input->post('affect_dist_id'));      
    $affect_pin_code= ($this->input->post('affect_pin_code')); 
    $affect_country_id= ($this->input->post('affect_country_id'));
    $affect_vill_city= ($this->input->post('affect_vill_city'));      
    $affect_ccu_desig_avo= ($this->input->post('affect_ccu_desig_avo'));
    $affect_tel_no= ($this->input->post('affect_tel_no'));
    $affect_mob_no= ($this->input->post('affect_mob_no'));
    $affect_email_id= ($this->input->post('affect_email_id'));
    $ip=$ip;
    $created_at=$created_at;


    $formbdata = array(
      'status'=>'0',
      'complaint_year'=>$complaint_year,
      'ref_no' => $ref_no,
      'party_cate'=>'2',
      'affect_name'=>$affect_name,
      'affect_gender_id'=>$affect_gender_id,
      'affect_ageyears'=>$affect_ageyears,
      'affect_add1'=> $affect_add1,
      'affect_hpnl'=> $affect_hpnl,   
      'affect_state_id'=>$affect_state_id,       
      'affect_dist_id'=> $affect_dist_id,     
      'affect_pin_code'=> $affect_pin_code, 
      'affect_country_id'=>$affect_country_id,
      'affect_vill_city'=> $affect_vill_city,    
      'affect_ccu_desig_avo'=> $affect_ccu_desig_avo,
      'affect_tel_no'=> $affect_tel_no,
      'affect_mob_no'=> $affect_mob_no,
      'affect_email_id'=> $affect_email_id,
      'user_id'=>$userid,
      'add_party'=>$ad_data,
      'ip'=>$ip,
      'created_at'=>$created_at,

    );
    $additionalinfo = $this->filing_model->additionalparty($formbdata); 
    if($additionalinfo){ 
      $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Third party detail has been successfully added.</h4></div>'); 
      redirect('/respondent/additionalparty',$data);
    } 
    else
    {
      echo "check data";
    }
  }
  }
 // $this->load->view('applet/additionalparty',$data);
 // redirect('/respondent/additionalparty',$data);

}




}