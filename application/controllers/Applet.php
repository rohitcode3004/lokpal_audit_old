<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Applet extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('File_upload');
    $this->load->helper('file');
    $this->load->model('filing_model');
    $this->load->model('common_model');
    $this->load->model('report_model');
    $this->load->helper('url', 'form');
    $this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->library('session');
    $this->load->library('image_lib');
    $this->load->library('Menus_lib');
    $this->load->helper("common_helper"); 
    $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    $this->load->model('login_model');
    $this->load->helper("compno_helper"); 
    $this->load->helper("parts_status_helper");
    $this->load->library('label');
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
    $this->load->helper("date_helper");
    $this->load->library('Menus_lib');
    $this->load->model('login_model');

    $this->load->helper("compno_helper");
    $this->load->helper("parts_status_helper");
    
    $u = $this->session->userdata('userId');
    $ref_no=$this->session->userdata('ref_no');
    $comp_no=get_filing_no($ref_no, $u);
    $status = $comp_no['status'];
    //$filing_no = $comp_no['complaint_no'];

    $parta_status = get_parts_status($ref_no, $u, 'A');
    $partb_status = get_parts_status($ref_no, $u, 'B');
    $partc_status = get_parts_status($ref_no, $u, 'C');

    if($parta_status){
      $comp_cap = get_parta_comptype($ref_no, $u);
    }else{
      $comp_cap = '';
    }
    
    if($status == 't' || $comp_cap == 1){
      die('not authorized');
    }
  }
  
  public function validate_image($t,$parameter) {
    return $this->file_upload->validate_image($t,$parameter);
  }


  public function appletfiling(){

    $data['user'] = $this->login_model->getRows($this->con);  

    $this->load->library('label');
    $this->load->helper("date_helper");  

    $ref_no=$this->session->userdata('ref_no');

    if($ref_no !='')
    {
     $data['partb'] = $this->report_model->getPartbdata($ref_no);

   }

   if (empty($data['partb'])) {

  //echo "first";die;
    /*first time*/
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

    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

  }
  else
  {
    //echo "second";die;

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

    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
  }
  $data['form_part'] = 'B';
  $this->load->view('templates/front/CE_Header.php',$data);
  $this->load->view('filing/applet.php',$data);
  $this->load->view('templates/front/CE_Footer.php',$data);

}



public function respondent(){ 
  $this->load->library('label');
  
  $this->load->view('filing/respondent.php');
  
}


public function additionalparty(){

  $data['user'] = $this->login_model->getRows($this->con);
  $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
  $ref_no=$this->session->userdata('ref_no');
  $data['addparty'] = $this->report_model->getAddparty($ref_no);

    //echo "test";die;
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
  $this->load->view('filing/additionalparty_org',$data);
  $this->load->view('templates/front/CE_Footer.php',$data);
  
}


public function addsave(){  
  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $this->load->helper("common_helper");
  $modify_party= ($this->input->post('modify_party'));
  $party_cate='1';
  if($modify_party !='')
  {
    $this->form_validation->set_rules('affect_name', 'Name', 'required');     
    $this->form_validation->set_rules('affect_gender_id', 'Gender', 'required');
    $this->form_validation->set_rules('affect_ageyears', 'Age', 'required');
    $this->form_validation->set_rules('affect_state_id', 'State', 'required');
    $this->form_validation->set_rules('affect_dist_id', 'District', 'required');
    $this->form_validation->set_rules('affect_country_id', 'Country', 'required');
   // $this->form_validation->set_rules('affect_mob_no', 'Mobile no', 'required');
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
        $this->load->view('filing/additionalparty_org',$data);
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
        $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0"> Third party detail has been successfully Modified.</h4></div>'); 
        redirect('/applet/additionalparty',$data); 
      } 
      else
      {
        echo "check data";
      }
    }
  }

  else
  { 
    $this->form_validation->set_rules('affect_name', 'Name', 'required');     
    $this->form_validation->set_rules('affect_gender_id', 'Gender', 'required');
    $this->form_validation->set_rules('affect_ageyears', 'Age', 'required');
    $this->form_validation->set_rules('affect_state_id', 'State', 'required');
    $this->form_validation->set_rules('affect_dist_id', 'District', 'required');
    $this->form_validation->set_rules('affect_country_id', 'Country', 'required');
  //  $this->form_validation->set_rules('affect_mob_no', 'Mobile no', 'required');
    $addparty = $this->report_model->getAddparty($ref_no);
    $ct=count($addparty);
    $ad_data=$ct+1;
    $ad_data='third party'.$ad_data;   
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
        $this->load->view('filing/additionalparty_org',$data);
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
      $party_cate='1';
      $curYear = date('Y');
      $complaint_year =$curYear; 
      $ref_no=$ref_no;
      $user_id=$userid;
      $add_party=$ad_data;
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
      $created_at=$created_at;


      $formbdata = array(
        'status'=>'0',
        'complaint_year'=>$complaint_year,
        'ref_no' => $ref_no,
        'party_cate'=>'1',
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
        redirect('/applet/additionalparty',$data); 
      } 
      else
      {
        echo "check data";
      }
    }
  }
 // $this->load->view('applet/additionalparty',$data);
  //redirect('/applet/additionalparty',$data);

}




public function officebeared(){ 

  $data['user'] = $this->login_model->getRows($this->con);
  $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);    
  $this->load->library('label');
  $ref_no=$this->session->userdata('ref_no');
  $data['addparty'] = $this->report_model->getOfficebearParty_data($ref_no);

 // $data['addparty'] = $this->report_model->getOfficebearParty($ref_no);
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
  $this->load->view('filing/officebeared',$data);
  $this->load->view('templates/front/CE_Footer.php',$data);
}


public function officsave(){  
  $this->load->helper("common_helper");
  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];   
  $ref_no=$this->session->userdata('ref_no');
  $modify_party= ($this->input->post('modify_party'));
  

  if($modify_party !='')
  {
  //echo "in loop";
   $officebeare = $this->report_model->getOfficebearedata($ref_no,$modify_party);
   $tsnew=date('Y-m-d');
   $t=date("H:i:s");         
   $new_name = time().'_'.$ref_no.'_'.$tsnew;

  /*
   $ob_identity_proof_upload = $_FILES['ob_identity_proof_upload']['name'];   
   $baseurl=base_url();
   $ob_identity_proof_upload_url=$ob_identity_proof_upload;  
   $ob_identity_proof_upload_url=$officebeare['ob_identity_proof_upload_url'];
   if(!empty($_FILES['ob_identity_proof_upload']['name']))
   { 
    $config['upload_path']   = './cdn/officebearidentity/'; 
    $config['allowed_types'] = 'gif|jpg|png|pdf';      
    $config['max_size']      = 15000;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('ob_identity_proof_upload')) {
     $error = array('error' => $this->upload->display_errors()); 

   }else
    { 
    $uploadedImage = $this->upload->data();
    }  
  $ob_identity_proof_upload_url=$ob_identity_proof_upload;   
} 
else
{
 $ob_identity_proof_upload_url=$ob_identity_proof_upload_url;
}
*/

$filename=$_FILES['ob_identity_proof_upload']['name'];
$ext = substr($filename, -4, strrpos($filename, '.'));
$filename = substr($filename, 0, strrpos($filename, '.'));
$filename = str_replace(' ','',$filename);  
$filename = str_replace('.','',$filename);  
if(!empty($_FILES['ob_identity_proof_upload']['name']))
{        
  $config['upload_path']   = './cdn/officebearidentity/'; 
  $config['allowed_types'] = 'gif|jpg|pdf';      
                //$config['max_size']      = 15000;
  $config['file_name'] = $new_name.$filename;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_identity_proof_upload'))
  {
    $error = array('error' => $this->upload->display_errors()); 

  }
  else
  { 
    $uploadedImage = $this->upload->data();      
  } 
  $ob_identity_proof_upload_url='cdn/officebearidentity/'.$new_name.$filename.$ext;
}      
else
{         
  $ob_identity_proof_upload_url=$officebeare['ob_identity_proof_upload_url'];
} 
/*

$ob_idres_proof_upload = $_FILES['ob_idres_proof_upload']['name'];
 $ob_idres_proof_upload_url=$officebeare['ob_idres_proof_upload_url'];
  $ob_idres_proof_upload_url=$ob_idres_proof_upload;

if(!empty($_FILES['ob_idres_proof_upload']['name']))
{ 

  $config['upload_path']   = './cdn/officebearresidence/'; 
  $config['allowed_types'] = 'gif|jpg|png|pdf';      
  $config['max_size']      = 15000;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_idres_proof_upload')) {
   $error = array('error' => $this->upload->display_errors()); 

 }else { 
  $uploadedImage = $this->upload->data();
}
$ob_idres_proof_upload_url=$ob_idres_proof_upload;   
} 
else
{

 $ob_idres_proof_upload_url=$ob_idres_proof_upload_url;

}*/

$filename=$_FILES['ob_idres_proof_upload']['name'];
$ext = substr($filename, -4, strrpos($filename, '.'));
$filename = substr($filename, 0, strrpos($filename, '.'));
$filename = str_replace(' ','',$filename);  
$filename = str_replace('.','',$filename);  
if(!empty($_FILES['ob_idres_proof_upload']['name']))
{        
  $config['upload_path']   = './cdn/officebearresidence/'; 
  $config['allowed_types'] = 'gif|jpg|pdf';      
                //$config['max_size']      = 15000;
  $config['file_name'] = $new_name.$filename;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_idres_proof_upload'))
  {
    $error = array('error' => $this->upload->display_errors()); 

  }
  else
  { 
    $uploadedImage = $this->upload->data();      
  } 
  $ob_idres_proof_upload_url='cdn/officebearresidence/'.$new_name.$filename.$ext;
}      
else
{         
  $ob_idres_proof_upload_url=$officebeare['ob_idres_proof_upload_url'];
} 




$ob_identity_proof_doi= ($this->input->post('ob_identity_proof_doi'));
if($ob_identity_proof_doi !='')
{
  $ob_identity_proof_doi = get_entrydate($ob_identity_proof_doi);
}
else
{
  $ob_identity_proof_doi = null;
}

$ob_identity_proof_vupto= ($this->input->post('ob_identity_proof_vupto'));
if($ob_identity_proof_vupto !='')
{
  $ob_identity_proof_vupto = get_entrydate($ob_identity_proof_vupto);
}
else
{
  $ob_identity_proof_vupto = null;
}

$ob_idres_proof_doi= ($this->input->post('ob_idres_proof_doi'));
if($ob_idres_proof_doi !='')
{
  $ob_idres_proof_doi = get_entrydate($ob_idres_proof_doi);
}
else
{
  $ob_idres_proof_doi = null;
}

$ob_idres_proof_vupto= ($this->input->post('ob_idres_proof_vupto'));
if($ob_idres_proof_vupto !='')
{
  $ob_idres_proof_vupto = get_entrydate($ob_idres_proof_vupto);
}
else
{
  $ob_idres_proof_vupto = null;
}


      $this->form_validation->set_rules('ob_salutation_id', 'Title', 'required');     
      $this->form_validation->set_rules('ob_first_name', 'First Name', 'required');
      $this->form_validation->set_rules('ob_gender_id', 'Gender', 'required');
      $this->form_validation->set_rules('ob_age_years', 'Age', 'required');
      $this->form_validation->set_rules('ob_nationality_id', 'Nationality', 'required');
      $this->form_validation->set_rules('ob_identity_proof_id', 'Identity', 'required');
      $this->form_validation->set_rules('ob_idres_proof_id', 'Residence', 'required');
      $this->form_validation->set_rules('ob_p_state_id', 'Permanent State', 'required');
      $this->form_validation->set_rules('ob_p_dist_id', 'Permanent District', 'required');
      $this->form_validation->set_rules('ob_p_country_id', ' Permanent Country', 'required');
      $this->form_validation->set_rules('ob_c_state_id', 'Correspondence State', 'required');
      $this->form_validation->set_rules('ob_c_dist_id', 'Correspondence District', 'required');
      $this->form_validation->set_rules('ob_c_country_id', 'Correspondence Country', 'required');
     // $this->form_validation->set_rules('ob_mob_no', 'Mobile no', 'required');
       if(!empty($_FILES['ob_identity_proof_upload']['name']))
        {   
          $parameters = $_FILES['ob_identity_proof_upload']['name']."||".$_FILES['ob_identity_proof_upload']['size']."||".$_FILES['ob_identity_proof_upload']['tmp_name'];      
          $this->form_validation->set_rules('ob_identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
        }
         if(!empty($_FILES['ob_idres_proof_upload']['name']))
        {   
          $parameters = $_FILES['ob_idres_proof_upload']['name']."||".$_FILES['ob_idres_proof_upload']['size']."||".$_FILES['ob_idres_proof_upload']['tmp_name'];      
          $this->form_validation->set_rules('ob_idres_proof_upload', '', 'callback_validate_image['.$parameters.']');
        }

      
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
          $data['salution'] = $this->common_model->getSalution();       
          $data['getcountry'] = $this->common_model->getCountry();          
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $data['identityproof'] = $this->common_model->getIdentityproof();
           $data['residenceproof'] = $this->common_model->getResidence();         
          $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/officebeared.php',$data);
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
$ref_no=$ref_no;   
$curYear = date('Y');
$complaint_year =$curYear;       
$user_id=$userid;   
$status='0';      
$ob_salutation_id= ($this->input->post('ob_salutation_id'));
$ob_sur_name= ($this->input->post('ob_sur_name'));
$ob_mid_name= ($this->input->post('ob_mid_name'));
$ob_first_name= ($this->input->post('ob_first_name'));
$ob_gender_id= ($this->input->post('ob_gender_id'));
$ob_age_years= ($this->input->post('ob_age_years'));        
$ob_nationality_id= ($this->input->post('ob_nationality_id'));          
$ob_identity_proof_id= ($this->input->post('ob_identity_proof_id'));        
$ob_identity_proof_no= ($this->input->post('ob_identity_proof_no'));
$ob_identity_proof_doi=$ob_identity_proof_doi;
$ob_identity_proof_vupto=$ob_identity_proof_vupto;
$ob_identity_proof_iauth= ($this->input->post('ob_identity_proof_iauth'));
$ob_idres_proof_id= ($this->input->post('ob_idres_proof_id'));
$ob_idres_proof_no= ($this->input->post('ob_idres_proof_no'));
$ob_idres_proof_doi=$ob_idres_proof_doi;
$ob_idres_proof_vupto=$ob_idres_proof_vupto;
$ob_idres_proof_iauth= ($this->input->post('ob_idres_proof_iauth'));
$ob_p_add1= ($this->input->post('ob_p_add1'));          
$ob_p_hpnl= ($this->input->post('ob_p_hpnl'));
$ob_p_state_id= ($this->input->post('ob_p_state_id'));
$ob_p_dist_id= ($this->input->post('ob_p_dist_id'));           
$ob_p_pin_code= ($this->input->post('ob_p_pin_code'));          
$ob_p_country_id= ($this->input->post('ob_p_country_id')); 
$ob_p_vill_city= ($this->input->post('ob_p_vill_city'));
$ob_c_add1= ($this->input->post('ob_c_add1'));          
$ob_c_hpnl= ($this->input->post('ob_c_hpnl'));
$ob_c_state_id= ($this->input->post('ob_c_state_id'));
$ob_c_dist_id= ($this->input->post('ob_c_dist_id'));           
$ob_c_pin_code= ($this->input->post('ob_c_pin_code'));          
$ob_c_country_id= ($this->input->post('ob_c_country_id')); 
$ob_c_vill_city= ($this->input->post('ob_c_vill_city'));
$ob_occu_desig_avo= ($this->input->post('ob_occu_desig_avo'));          
$ob_tel_no= ($this->input->post('ob_tel_no'));
$ob_mob_no= ($this->input->post('ob_mob_no'));
$ob_email_id= ($this->input->post('ob_email_id'));
$office_bearer_organisation= ($this->input->post('office_bearer_organisation'));

$ip=$ip;
$updated_at=$updated_at; 


$formbdata = array(
  'status'=>'0',
  'complaint_year'=>$complaint_year, 
  'ob_identity_proof_upload_url'=>$ob_identity_proof_upload_url,
  'ob_idres_proof_upload_url'=>$ob_idres_proof_upload_url,
  'ob_salutation_id'=> $ob_salutation_id,
  'ob_sur_name'=> $ob_sur_name,
  'ob_mid_name'=>$ob_mid_name,
  'ob_first_name'=>$ob_first_name,
  'ob_gender_id'=>$ob_gender_id,
  'ob_age_years'=>$ob_age_years,      
  'ob_nationality_id'=> $ob_nationality_id,        
  'ob_identity_proof_id'=> $ob_identity_proof_id,         
  'ob_identity_proof_no'=> $ob_identity_proof_no,
  'ob_identity_proof_doi'=> $ob_identity_proof_doi,
  'ob_identity_proof_vupto'=> $ob_identity_proof_vupto,        
  'ob_identity_proof_iauth'=> $ob_identity_proof_iauth,
  'ob_idres_proof_id'=> $ob_idres_proof_id,
  'ob_idres_proof_no'=> $ob_idres_proof_no,        
  'ob_idres_proof_doi'=> $ob_idres_proof_doi,         
  'ob_idres_proof_vupto'=> $ob_idres_proof_vupto, 
  'ob_idres_proof_iauth'=>$ob_idres_proof_iauth,
  'ob_p_add1'=> $ob_p_add1,        
  'ob_p_hpnl'=> $ob_p_hpnl,
  'ob_p_state_id'=> $ob_p_state_id,
  'ob_p_dist_id'=> $ob_p_dist_id,      
  'ob_p_pin_code'=>$ob_p_pin_code,        
  'ob_p_country_id'=> $ob_p_country_id, 
  'ob_p_vill_city'=>$ob_p_vill_city,
  'ob_c_add1'=>$ob_c_add1,         
  'ob_c_hpnl'=>$ob_c_hpnl,
  'ob_c_state_id'=> $ob_c_state_id,
  'ob_c_dist_id'=>$ob_c_dist_id,       
  'ob_c_pin_code'=>$ob_c_pin_code,        
  'ob_c_country_id'=>$ob_c_country_id, 
  'ob_c_vill_city'=> $ob_c_vill_city,
  'ob_occu_desig_avo'=> $ob_occu_desig_avo,        
  'ob_tel_no'=> $ob_tel_no,
  'ob_mob_no'=> $ob_mob_no,
  'ob_email_id'=> $ob_email_id,
  'office_bearer_organisation'=> $office_bearer_organisation,
  'user_id'=>$userid,
  'ip'=>$ip,
  'updated_at'=>$updated_at,

);
//echo "herefffffffffffff";die;

$data = $this->filing_model->insert_partB2_officebearer_his($ref_no,$modify_party);
$officesavedata = $this->filing_model->officeModifiData($formbdata,$modify_party); 
if($officesavedata){  
  $this->session->set_flashdata('success_msg', ' <div class="alert alert-success"><h4 class="m-0">Data modified successfully.</h4></div>'); 
    redirect('/applet/officebeared',$data); 
}
else
{
  echo "check data";
}  

}
}

else
{

 $office_bearer_organisation= ($this->input->post('office_bearer_organisation'));
  $data['addparty_value'] = $this->report_model->getOfficebearParty($ref_no,$office_bearer_organisation);
 if($office_bearer_organisation !=2)
 {  
  
  $ct=count($data['addparty_value']);
  $ob_data=$ct+1;
  $ob_data='office bearer'.$ob_data;
}
else
{
   
  $ct=count($data['addparty_value']);
  $ob_data=$ct+1;
  $ob_data='Head of organization'.$ob_data;
}

//echo $ob_data;die;


/*
  $ob_identity_proof_upload = $_FILES['ob_identity_proof_upload']['name'];
  $ob_idres_proof_upload = $_FILES['ob_idres_proof_upload']['name'];
  $baseurl=base_url();
   $ob_identity_proof_upload_url=$ob_identity_proof_upload;
  $ob_idres_proof_upload_url=$ob_idres_proof_upload;
  if($ob_identity_proof_upload !='')
  {
    $config['upload_path']   = './cdn/officebearidentity/'; 
    $config['allowed_types'] = 'gif|jpg|png|pdf';      
    $config['max_size']      = 15000;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('ob_identity_proof_upload'))
     {
     $error = array('error' => $this->upload->display_errors());
     }
   else
    { 
    $uploadedImage = $this->upload->data();
  }
} */

$tsnew=date('Y-m-d');
$t=date("H:i:s");
$new_name = time().'_'.$ref_no.'_'.$tsnew;
$filename=$_FILES['ob_identity_proof_upload']['name'];
$ext = substr($filename, -4, strrpos($filename, '.'));
$filename = substr($filename, 0, strrpos($filename, '.'));
$filename = str_replace(' ','',$filename);  
$filename = str_replace('.','',$filename);
if(!empty($_FILES['ob_identity_proof_upload']['name']))
{            
  $config['upload_path']   = './cdn/officebearidentity/'; 
  $config['allowed_types'] = 'gif|jpg|pdf';      
                  //$config['max_size']      = 15000;
  $config['file_name'] = $new_name.$filename;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_identity_proof_upload'))
  {
    $error = array('error' => $this->upload->display_errors());          
  }
  else
  { 
    $uploadedImage = $this->upload->data();      
  } 
  $ob_identity_proof_upload='cdn/officebearidentity/'.$new_name.$filename.$ext;
}      
else
{
  $ob_identity_proof_upload='';
} 


/*
if($ob_idres_proof_upload !='')
{
  $config['upload_path']   = './cdn/officebearresidence/'; 
  $config['allowed_types'] = 'gif|jpg|png|pdf';      
  $config['max_size']      = 15000;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_idres_proof_upload')) {
   $error = array('error' => $this->upload->display_errors()); 

 }else { 
  $uploadedImage = $this->upload->data();

}       
}*/



$filename=$_FILES['ob_idres_proof_upload']['name'];
$ext = substr($filename, -4, strrpos($filename, '.'));
$filename = substr($filename, 0, strrpos($filename, '.'));
$filename = str_replace(' ','',$filename);  
$filename = str_replace('.','',$filename);
if(!empty($_FILES['ob_idres_proof_upload']['name']))
{            
  $config['upload_path']   = './cdn/officebearresidence/'; 
  $config['allowed_types'] = 'gif|jpg|pdf';      
                  //$config['max_size']      = 15000;
  $config['file_name'] = $new_name.$filename;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('ob_idres_proof_upload'))
  {
    $error = array('error' => $this->upload->display_errors());          
  }
  else
  { 
    $uploadedImage = $this->upload->data();      
  } 
  $ob_idres_proof_upload='cdn/officebearresidence/'.$new_name.$filename.$ext;
}      
else
{
  $ob_idres_proof_upload='';
} 



$ref_no=$this->session->userdata('ref_no');
$ob_identity_proof_doi= ($this->input->post('ob_identity_proof_doi'));
if($ob_identity_proof_doi !='')
{
  $ob_identity_proof_doi = get_entrydate($ob_identity_proof_doi);
}
else
{
  $ob_identity_proof_doi = null;
}

$ob_identity_proof_vupto= ($this->input->post('ob_identity_proof_vupto'));
if($ob_identity_proof_vupto !='')
{
  $ob_identity_proof_vupto = get_entrydate($ob_identity_proof_vupto);
}
else
{
  $ob_identity_proof_vupto = null;
}

$ob_idres_proof_doi= ($this->input->post('ob_idres_proof_doi'));
if($ob_idres_proof_doi !='')
{
  $ob_idres_proof_doi = get_entrydate($ob_idres_proof_doi);
}
else
{
  $ob_idres_proof_doi = null;
}

$ob_idres_proof_vupto= ($this->input->post('ob_idres_proof_vupto'));
if($ob_idres_proof_vupto !='')
{
  $ob_idres_proof_vupto = get_entrydate($ob_idres_proof_vupto);
}
else
{
  $ob_idres_proof_vupto = null;
}
      $this->form_validation->set_rules('office_bearer_organisation', 'Please select office bearer/Head of organization', 'required'); 
      $this->form_validation->set_rules('ob_salutation_id', 'Title', 'required');     
      $this->form_validation->set_rules('ob_first_name', 'First Name', 'required');
      $this->form_validation->set_rules('ob_gender_id', 'Gender', 'required');
      $this->form_validation->set_rules('ob_age_years', 'Age', 'required');
      $this->form_validation->set_rules('ob_nationality_id', 'Nationality', 'required');
      $this->form_validation->set_rules('ob_identity_proof_id', 'Identity', 'required');
      $this->form_validation->set_rules('ob_idres_proof_id', 'Residence', 'required');
      $this->form_validation->set_rules('ob_p_state_id', 'Permanent State', 'required');
      $this->form_validation->set_rules('ob_p_dist_id', 'Permanent District', 'required');
      $this->form_validation->set_rules('ob_p_country_id', ' Permanent Country', 'required');
      $this->form_validation->set_rules('ob_c_state_id', 'Correspondence State', 'required');
      $this->form_validation->set_rules('ob_c_dist_id', 'Correspondence District', 'required');
      $this->form_validation->set_rules('ob_c_country_id', 'Correspondence Country', 'required');
     // $this->form_validation->set_rules('ob_mob_no', 'Mobile no', 'required');

       if(!empty($_FILES['ob_identity_proof_upload']['name']))
        {   
          $parameters = $_FILES['ob_identity_proof_upload']['name']."||".$_FILES['ob_identity_proof_upload']['size']."||".$_FILES['ob_identity_proof_upload']['tmp_name'];      
          $this->form_validation->set_rules('ob_identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
        }
         if(!empty($_FILES['ob_idres_proof_upload']['name']))
        {   
          $parameters = $_FILES['ob_idres_proof_upload']['name']."||".$_FILES['ob_idres_proof_upload']['size']."||".$_FILES['ob_idres_proof_upload']['tmp_name'];      
          $this->form_validation->set_rules('ob_idres_proof_upload', '', 'callback_validate_image['.$parameters.']');
        }
      
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
          $data['salution'] = $this->common_model->getSalution();       
          $data['getcountry'] = $this->common_model->getCountry();          
          $data['state'] = $this->common_model->getStateName();           
          $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
          $data['identityproof'] = $this->common_model->getIdentityproof();
           $data['residenceproof'] = $this->common_model->getResidence();
           $this->load->view('templates/front/CE_Header.php',$data);
          $this->load->view('filing/officebeared.php',$data);
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

$ref_no=$ref_no;
   // $array['user_id'];
$curYear = date('Y');
$complaint_year =$curYear;
$ref_no=$ref_no;
$user_id=$userid;
$ob_party=$ob_data;
$status='0';
$ob_identity_proof_upload_url=$ob_identity_proof_upload;
$ob_idres_proof_upload_url=$ob_idres_proof_upload;
$ob_salutation_id= ($this->input->post('ob_salutation_id'));
$ob_sur_name= ($this->input->post('ob_sur_name'));
$ob_mid_name= ($this->input->post('ob_mid_name'));
$ob_first_name= ($this->input->post('ob_first_name'));
$ob_gender_id= ($this->input->post('ob_gender_id'));
$ob_age_years= ($this->input->post('ob_age_years'));      
$ob_nationality_id= ($this->input->post('ob_nationality_id'));      
$ob_identity_proof_id= ($this->input->post('ob_identity_proof_id'));      
$ob_identity_proof_no= ($this->input->post('ob_identity_proof_no')); 
/*
$ob_identity_proof_doi= ($this->input->post('ob_identity_proof_doi'));
$ob_identity_proof_doi= get_entrydate($ob_identity_proof_doi);
$ob_identity_proof_vupto= ($this->input->post('ob_identity_proof_vupto')); 
$ob_identity_proof_vupto= get_entrydate($ob_identity_proof_vupto);  
*/

$ob_identity_proof_doi=$ob_identity_proof_doi;
$ob_identity_proof_vupto=$ob_identity_proof_vupto;

$ob_identity_proof_iauth= ($this->input->post('ob_identity_proof_iauth'));
$ob_idres_proof_id= ($this->input->post('ob_idres_proof_id'));
$ob_idres_proof_no= ($this->input->post('ob_idres_proof_no')); 
/*      
$ob_idres_proof_doi= ($this->input->post('ob_idres_proof_doi'));
$ob_idres_proof_doi= get_entrydate($ob_idres_proof_doi);      
$ob_idres_proof_vupto= ($this->input->post('ob_idres_proof_vupto')); 
$ob_idres_proof_vupto= get_entrydate($ob_idres_proof_vupto); 
*/
$ob_idres_proof_doi=$ob_idres_proof_doi;
$ob_idres_proof_vupto=$ob_idres_proof_vupto;

$ob_idres_proof_iauth= ($this->input->post('ob_idres_proof_iauth'));
$ob_p_add1= ($this->input->post('ob_p_add1'));      
$ob_p_hpnl= ($this->input->post('ob_p_hpnl'));
$ob_p_state_id= ($this->input->post('ob_p_state_id'));
$ob_p_dist_id= ($this->input->post('ob_p_dist_id'));       
$ob_p_pin_code= ($this->input->post('ob_p_pin_code'));      
$ob_p_country_id= ($this->input->post('ob_p_country_id')); 
$ob_p_vill_city= ($this->input->post('ob_p_vill_city'));
$ob_c_add1= ($this->input->post('ob_c_add1'));      
$ob_c_hpnl= ($this->input->post('ob_c_hpnl'));
$ob_c_state_id= ($this->input->post('ob_c_state_id'));
$ob_c_dist_id= ($this->input->post('ob_c_dist_id'));       
$ob_c_pin_code= ($this->input->post('ob_c_pin_code'));      
$ob_c_country_id= ($this->input->post('ob_c_country_id')); 
$ob_c_vill_city= ($this->input->post('ob_c_vill_city'));
$ob_occu_desig_avo= ($this->input->post('ob_occu_desig_avo'));      
$ob_tel_no= ($this->input->post('ob_tel_no'));
$ob_mob_no= ($this->input->post('ob_mob_no'));
$ob_email_id= ($this->input->post('ob_email_id'));
$office_bearer_organisation= ($this->input->post('office_bearer_organisation'));
$ip=$ip;
$created_at=$created_at; 


$formbdata = array(
  'status'=>'0',
  'complaint_year'=>$complaint_year,
  'ref_no' => $ref_no,
  // 'user_id' => $user_id,
  'ob_identity_proof_upload_url'=>$ob_identity_proof_upload_url,
  'ob_idres_proof_upload_url'=>$ob_idres_proof_upload_url,
  'ob_salutation_id'=> $ob_salutation_id,
  'ob_sur_name'=> $ob_sur_name,
  'ob_mid_name'=>$ob_mid_name,
  'ob_first_name'=>$ob_first_name,
  'ob_gender_id'=>$ob_gender_id,
  'ob_age_years'=>$ob_age_years,    
  'ob_nationality_id'=> $ob_nationality_id,      
  'ob_identity_proof_id'=> $ob_identity_proof_id,     
  'ob_identity_proof_no'=> $ob_identity_proof_no,
  'ob_identity_proof_doi'=> $ob_identity_proof_doi,
  'ob_identity_proof_vupto'=> $ob_identity_proof_vupto,      
  'ob_identity_proof_iauth'=> $ob_identity_proof_iauth,
  'ob_idres_proof_id'=> $ob_idres_proof_id,
  'ob_idres_proof_no'=> $ob_idres_proof_no,      
  'ob_idres_proof_doi'=> $ob_idres_proof_doi,     
  'ob_idres_proof_vupto'=> $ob_idres_proof_vupto, 
  'ob_idres_proof_iauth'=>$ob_idres_proof_iauth,
  'ob_p_add1'=> $ob_p_add1,    
  'ob_p_hpnl'=> $ob_p_hpnl,
  'ob_p_state_id'=> $ob_p_state_id,
  'ob_p_dist_id'=> $ob_p_dist_id,    
  'ob_p_pin_code'=>$ob_p_pin_code,      
  'ob_p_country_id'=> $ob_p_country_id, 
  'ob_p_vill_city'=>$ob_p_vill_city,
  'ob_c_add1'=>$ob_c_add1,     
  'ob_c_hpnl'=>$ob_c_hpnl,
  'ob_c_state_id'=> $ob_c_state_id,
  'ob_c_dist_id'=>$ob_c_dist_id,     
  'ob_c_pin_code'=>$ob_c_pin_code,    
  'ob_c_country_id'=>$ob_c_country_id, 
  'ob_c_vill_city'=> $ob_c_vill_city,
  'ob_occu_desig_avo'=> $ob_occu_desig_avo,      
  'ob_tel_no'=> $ob_tel_no,
  'ob_mob_no'=> $ob_mob_no,
  'ob_email_id'=> $ob_email_id,
  'office_bearer_organisation'=>$office_bearer_organisation,
  'user_id'=>$userid,
  'ob_party'=>$ob_data,
  'ip'=>$ip,
  'created_at'=>$created_at,
);

$officesavedata = $this->filing_model->officesavedata($formbdata); 

if($officesavedata){ 
  $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Data successfully added.</h4></div>'); 
  redirect('/applet/officebeared',$data); 

} 
else
{
  echo "check data";
}
}
} 
 // $this->load->view('applet/additionalparty',$data);
//redirect('/applet/officebeared',$data); 

}


public function save(){  
 $this->load->helper("common_helper");
 $data['user'] = $this->login_model->getRows($this->con);
 $userid=$data['user']['id'];
 $ref_no=$this->session->userdata('ref_no');

 if($ref_no !='')
 {
   $data['partb'] = $this->report_model->getPartbdata($ref_no);

 }

 if (empty($data['partb']))
 {

  /*first time*/
  //echo "in here first time";die;
  $ip = get_ip();
  $ip = $ip;
  $ts = date('Y-m-d H:i:s');
  $created_at = $ts;  
  $tsnew=date('Y-m-d');
  $t=date("H:i:s");
  $new_name = time().'_'.$ref_no.'_'.$tsnew;
  $filename=$_FILES['identity_proof_upload']['name'];
  $ext = substr($filename, -4, strrpos($filename, '.'));
  $filename = substr($filename, 0, strrpos($filename, '.'));
  $filename = str_replace(' ','',$filename);  
  $filename = str_replace('.','',$filename);
  if(!empty($_FILES['identity_proof_upload']['name']))
  {     
          // $config['encrypt_name'] = TRUE;  
    $config['upload_path']   = './cdn/identityformb/'; 
    $config['allowed_types'] = 'gif|jpg|pdf';      
            //$config['max_size']      = 15000;
    $config['file_name'] = $new_name.$filename;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('identity_proof_upload'))
    {
      $error = array('error' => $this->upload->display_errors()); 

    }else
    { 
      $uploadedImage = $this->upload->data();      
    } 
    $identity_url_partb='cdn/identityformb/'.$new_name.$filename.$ext;
  }      
  else
  {
    $identity_url_partb='';
  }  



  $filename=$_FILES['aidres_proof_upload']['name'];
  $ext = substr($filename, -4, strrpos($filename, '.'));
  $filename = substr($filename, 0, strrpos($filename, '.'));
  $filename = str_replace(' ','',$filename);  
  $filename = str_replace('.','',$filename);  
  if(!empty($_FILES['identity_proof_upload']['name']))
  {     
          // $config['encrypt_name'] = TRUE;  
    $config['upload_path']   = './cdn/residenceformb/'; 
    $config['allowed_types'] = 'gif|jpg|pdf';      
              //$config['max_size']      = 15000;
    $config['file_name'] = $new_name.$filename;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('aidres_proof_upload'))
    {
     $error = array('error' => $this->upload->display_errors()); 
   }
   else
   { 
     $uploadedImage = $this->upload->data();      
   } 
   $residence_url_partb='cdn/residenceformb/'.$new_name.$filename.$ext;
 }      
 else
 {
  $residence_url_partb='';
} 

  //auth_doc_upload 
$filename=$_FILES['auth_doc_upload']['name'];
$ext = substr($filename, -4, strrpos($filename, '.'));
$filename = substr($filename, 0, strrpos($filename, '.'));
$filename = str_replace(' ','',$filename);  
$filename = str_replace('.','',$filename);
if(!empty($_FILES['auth_doc_upload']['name']))
{   
  $config['upload_path']   = './cdn/auth_doc_upload/'; 
  $config['allowed_types'] = 'gif|jpg|pdf';      
                //$config['max_size']      = 15000;
  $config['file_name'] = $new_name.$filename;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('auth_doc_upload'))
  {
    $error = array('error' => $this->upload->display_errors()); 

  }else
  { 
    $uploadedImage = $this->upload->data();      
  } 
  $auth_doc_upload='cdn/auth_doc_upload/'.$new_name.$filename.$ext;
}      
else
{
  $auth_doc_upload='';
} 


$aidentity_proof_doi= ($this->input->post('aidentity_proof_doi'));
if($aidentity_proof_doi !='')
{
  $aidentity_proof_doi = get_entrydate($aidentity_proof_doi);
}
else
{
 $aidentity_proof_doi = null;
}
$aidentity_proof_vupto= ($this->input->post('aidentity_proof_vupto'));
if($aidentity_proof_vupto !='')
{
 $aidentity_proof_vupto = get_entrydate($aidentity_proof_vupto);
}
else
{
  $aidentity_proof_vupto = null;
}
$aidres_proof_doi= ($this->input->post('aidres_proof_doi'));
if($aidres_proof_doi !='')
{
  $aidres_proof_doi = get_entrydate($aidres_proof_doi);
}
else
{
 $aidres_proof_doi = null;
}

$aidres_proof_vupto= ($this->input->post('aidres_proof_vupto'));
if($aidres_proof_vupto !='')
{
 $aidres_proof_vupto = get_entrydate($aidres_proof_vupto);
}
else
{
 $aidres_proof_vupto = null;
}


$this->form_validation->set_rules('o_state_id', 'Organization State', 'required');
$this->form_validation->set_rules('o_dist_id', 'Organization District', 'required');
$this->form_validation->set_rules('o_country_id', 'Organization Country', 'required');
$this->form_validation->set_rules('o_promob_no', 'Organization Mobile no', 'required');
$this->form_validation->set_rules('a_salutation_id', 'Mobile No', 'required');
$this->form_validation->set_rules('a_first_name', 'First Name', 'required');
$this->form_validation->set_rules('a_gender_id', 'Gender', 'required');
$this->form_validation->set_rules('a_age_years', 'Age Years', 'required');
$this->form_validation->set_rules('a_nationality_id', 'Nationality', 'required');
$this->form_validation->set_rules('aidentity_proof_id', 'Identity Proof', 'required');
$this->form_validation->set_rules('aidres_proof_id', 'Address Proof', 'required');
$this->form_validation->set_rules('ap_state_id', 'Permanent State', 'required');
$this->form_validation->set_rules('ap_dist_id', 'Permanent District', 'required');
$this->form_validation->set_rules('ap_country_id', 'Permanent Country Name', 'required');
$this->form_validation->set_rules('ac_state_id', 'Correspondance State', 'required');
$this->form_validation->set_rules('ac_dist_id', 'Correspondance District', 'required');
$this->form_validation->set_rules('ac_country_id', 'Correspondance Country Name', 'required');
$this->form_validation->set_rules('amob_no', 'Mobile No', 'required');
if(!empty($_FILES['identity_proof_upload']['name']))
{   
  $parameters = $_FILES['identity_proof_upload']['name']."||".$_FILES['identity_proof_upload']['size']."||".$_FILES['identity_proof_upload']['tmp_name'];      
  $this->form_validation->set_rules('identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
}

if(!empty($_FILES['aidres_proof_upload']['name']))
{   
  $parameters = $_FILES['aidres_proof_upload']['name']."||".$_FILES['aidres_proof_upload']['size']."||".$_FILES['aidres_proof_upload']['tmp_name'];      
  $this->form_validation->set_rules('aidres_proof_upload', '', 'callback_validate_image['.$parameters.']');
}

if(!empty($_FILES['auth_doc_upload']['name']))
{   
  $parameters = $_FILES['auth_doc_upload']['name']."||".$_FILES['auth_doc_upload']['size']."||".$_FILES['auth_doc_upload']['tmp_name'];      
  $this->form_validation->set_rules('auth_doc_upload', '', 'callback_validate_image['.$parameters.']');
}

if($this->form_validation->run() == FALSE)
{                  
  if($this->isUserLoggedIn) 
  {
   $con = array( 
    'id' => $this->session->userdata('userId') 
  ); 
   $data['user'] = $this->login_model->getRows($this->con);  
   $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
   $this->load->library('label');
   $this->load->helper("date_helper");
   $ref_no=$this->session->userdata('ref_no');

   if($ref_no !='')
   {
     $data['partb'] = $this->report_model->getPartbdata($ref_no);
   }
   $data['salution'] = $this->common_model->getSalution();                   
   $data['gender'] = $this->common_model->getGender();
   $data['nationality'] = $this->common_model->getNationality();
   $data['identityproof'] = $this->common_model->getIdentityproof();
   $data['residenceproof'] = $this->common_model->getResidence();
   $data['getcountry'] = $this->common_model->getCountry();
   $data['complaintmode'] = $this->common_model->getComplaintmode();
   $data['identity_document_type'] = $this->common_model->getDocument_type();                  
   $data['state'] = $this->common_model->getStateName();                                    
   $data['form_part'] = 'B';  


   //echo "echo here ffff";die;
 //  $this->load->view('templates/front/header2.php',$data);
  $this->load->view('templates/front/CE_Header.php',$data);
     $this->load->view('filing/applet.php',$data);
     $this->load->view('templates/front/CE_Footer.php',$data);

 }                 
 else
 {
  redirect('admin/login'); 
}

}           

else
{
 //echo "rrrrrrrrrrrrrrr";die;


             // $array['user_id'];
 $ref_no=$ref_no;
 $curYear = date('Y');
 $complaint_year =$curYear;
 $user_id=$userid;
 $status='0';
 $identity_url_partb=$identity_url_partb;
 $residence_url_partb=$residence_url_partb;
 $auth_doc_upload=$auth_doc_upload;
 $orgn_referred_india= ($this->input->post('orgn_referred_india'));
 $cert_regInc_encl= ($this->input->post('cert_regInc_encl'));
 $auth_ireginc= ($this->input->post('auth_ireginc'));
 $o_add1= ($this->input->post('o_add1'));
 $o_hpnl= ($this->input->post('o_hpnl'));
 $o_vill_city= ($this->input->post('o_vill_city'));      
 $o_country_id= ($this->input->post('o_country_id'));       
 $o_state_id= ($this->input->post('o_state_id'));      
 $o_dist_id= ($this->input->post('o_dist_id')); 
 $o_pin_code= ($this->input->post('o_pin_code'));
 $o_tel_no= ($this->input->post('o_tel_no'));     
 $o_email_id= ($this->input->post('o_email_id'));
 $o_promob_no= ($this->input->post('o_promob_no'));
 $h_salutation_id= ($this->input->post('h_salutation_id'));
 $h_sur_name= ($this->input->post('h_sur_name'));
 $h_mid_name= ($this->input->post('h_mid_name'));
 $h_first_name= ($this->input->post('h_first_name'));
 $a_salutation_id= ($this->input->post('a_salutation_id'));
 $a_sur_name= ($this->input->post('a_sur_name'));       
 $a_mid_name= ($this->input->post('a_mid_name'));
 $a_first_name= ($this->input->post('a_first_name'));
 $a_gender_id= ($this->input->post('a_gender_id'));
 $a_age_years= ($this->input->post('a_age_years'));
 $a_nationality_id= ($this->input->post('a_nationality_id'));
 $aidentity_proof_id= ($this->input->post('aidentity_proof_id'));
 $aidentity_proof_no= ($this->input->post('aidentity_proof_no'));
 $aidentity_proof_doi=$aidentity_proof_doi;
 $aidentity_proof_vupto=$aidentity_proof_vupto;
 $aidentity_proof_iauth= ($this->input->post('aidentity_proof_iauth'));
 $aidres_proof_id= ($this->input->post('aidres_proof_id'));
 $aidres_proof_no= ($this->input->post('aidres_proof_no'));
 $aidres_proof_doi=$aidres_proof_doi;
 $aidres_proof_vupto=$aidres_proof_vupto;
 $aidres_proof_iauth= ($this->input->post('aidres_proof_iauth'));
 $ap_add1= ($this->input->post('ap_add1'));
 $ap_hpnl= ($this->input->post('ap_hpnl'));
 $ap_state_id= ($this->input->post('ap_state_id'));
 $ap_dist_id= ($this->input->post('ap_dist_id'));
 $ap_pin_code= ($this->input->post('ap_pin_code'));
 $ap_country_id= ($this->input->post('ap_country_id'));
 $ap_vill_city= ($this->input->post('ap_vill_city'));
 $ac_add1= ($this->input->post('ac_add1'));
 $ac_hpnl= ($this->input->post('ac_hpnl'));
 $ac_state_id= ($this->input->post('ac_state_id'));
 $ac_dist_id= ($this->input->post('ac_dist_id'));
 $ac_pin_code= ($this->input->post('ac_pin_code'));
 $ac_country_id= ($this->input->post('ac_country_id'));
 $ac_vill_city= ($this->input->post('ac_vill_city'));
 $aoccu_desig_avo= ($this->input->post('aoccu_desig_avo'));
 $atel_no= ($this->input->post('atel_no'));
 $amob_no= ($this->input->post('amob_no'));
 $email_id= ($this->input->post('email_id'));
 $auth_doc_encl= ($this->input->post('auth_doc_encl'));
 $affect_3rdparty= ($this->input->post('affect_3rdparty'));
 $ip=$ip;
 $created_at=$created_at;
 $affect_office_beared= ($this->input->post('affect_office_beared')); 
 $formbdata = array(
   'status'=>'0',
   'complaint_year'=>$complaint_year,
   'ref_no' => $ref_no,
   'user_id'=>$userid,
   'identity_url_partb'=>$identity_url_partb,
   'residence_url_partb'=>$residence_url_partb,
   'auth_doc_upload'=>$auth_doc_upload,
   'orgn_referred_india' => $orgn_referred_india,
   'cert_regInc_encl' => $cert_regInc_encl,
   'auth_ireginc' => $auth_ireginc,
   'o_add1' => $o_add1,   
   'o_hpnl' => $o_hpnl,
   'o_vill_city' => $o_vill_city,
   'o_country_id' => $o_country_id,
   'o_state_id' => $o_state_id,
   'o_dist_id' => $o_dist_id,
   'o_pin_code' => $o_pin_code,
   'o_tel_no' => $o_tel_no,
   'o_email_id' => $o_email_id,   
   'o_promob_no' => $o_promob_no,
   'h_salutation_id' => $h_salutation_id,
   'h_sur_name' => $h_sur_name,
   'h_mid_name' => $h_mid_name,
   'h_first_name' => $h_first_name,
   'a_salutation_id' => $a_salutation_id,
   'a_sur_name' => $a_sur_name,
   'a_mid_name' => $a_mid_name,
   'a_first_name' => $a_first_name,   
   'a_gender_id' => $a_gender_id,
   'a_age_years' => $a_age_years,
   'a_nationality_id'=> $a_nationality_id,
   'aidentity_proof_id'=> $aidentity_proof_id,
   'aidentity_proof_no'=> $aidentity_proof_no,
   'aidentity_proof_doi'=> $aidentity_proof_doi,
   'aidentity_proof_vupto'=> $aidentity_proof_vupto,
   'aidentity_proof_iauth'=> $aidentity_proof_iauth,
   'aidres_proof_id'=> $aidres_proof_id,
   'aidres_proof_no'=> $aidres_proof_no,
   'aidres_proof_doi'=> $aidres_proof_doi,
   'aidres_proof_vupto'=> $aidres_proof_vupto,
   'aidres_proof_iauth'=> $aidres_proof_iauth,
   'ap_add1'=> $ap_add1,
   'ap_hpnl'=> $ap_hpnl,
   'ap_state_id'=> $ap_state_id,
   'ap_dist_id'=> $ap_dist_id,
   'ap_pin_code'=> $ap_pin_code,
   'ap_country_id'=> $ap_country_id,
   'ap_vill_city'=> $ap_vill_city,
   'ac_add1'=> $ac_add1,
   'ac_hpnl'=> $ac_hpnl,
   'ac_state_id'=> $ac_state_id,
   'ac_dist_id'=> $ac_dist_id,
   'ac_pin_code'=> $ac_pin_code,
   'ac_country_id'=> $ac_country_id,
   'ac_vill_city'=> $ac_vill_city,
   'aoccu_desig_avo'=> $aoccu_desig_avo,
   'atel_no'=> $atel_no,
   'amob_no'=> $amob_no,
   'email_id'=> $email_id,
   'auth_doc_encl'=> $auth_doc_encl,
   'affect_3rdparty'=> $affect_3rdparty,
   'ip'=>$ip,
   'created_at'=>$created_at,
   'affect_office_beared'=> $affect_office_beared,   
 );

 //echo "add";die;
 $employeeId = $this->filing_model->addFormbFiling($formbdata); 
        //redirect('/document/testafidavit');


                if($employeeId){ 
      //$this->session->set_flashdata('success_msg', 'Public Servant detail data has been successfully modified.'); 
       redirect('/respondent/respondentfiling');
    }  
    else
    {
      echo "check data";
    }

 //redirect('/respondent/respondentfiling');
 
}
}
else
{ 

  //echo "modify";die;

 // echo $this->input->post('auth_ireginc');
  $ip = get_ip();
  $ip = $ip;
  $ts = date('Y-m-d H:i:s');
  $updated_at = $ts;       
  $tsnew=date('Y-m-d');
  $t=date("H:i:s");         
  $new_name = time().'_'.$ref_no.'_'.$tsnew;

  $data['user'] = $this->login_model->getRows($this->con);
  $userid=$data['user']['id'];
  $ref_no=$this->session->userdata('ref_no');
  $datapartb = $this->report_model->getPartbdata($ref_no);
  $filename=$_FILES['identity_proof_upload']['name'];
  $ext = substr($filename, -4, strrpos($filename, '.'));
  $filename = substr($filename, 0, strrpos($filename, '.'));
  $filename = str_replace(' ','',$filename);  
  $filename = str_replace('.','',$filename);  

  if(!empty($_FILES['identity_proof_upload']['name']))
  {        
    $config['upload_path']   = './cdn/identityformb/'; 
    $config['allowed_types'] = 'gif|jpg|pdf';      
          //$config['max_size']      = 15000;
    $config['file_name'] = $new_name.$filename;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('identity_proof_upload'))
    {
      $error = array('error' => $this->upload->display_errors()); 

    }else
    { 
      $uploadedImage = $this->upload->data();      
    } 
    $identity_url_partb='cdn/identityformb/'.$new_name.$filename.$ext;
  }      
  else
  {        
          //$part_c = $this->report_model->getPartc($ref_no);
    $identity_url_partb=$datapartb['identity_url_partb'] ?? '';
  } 
  $filename=$_FILES['aidres_proof_upload']['name'];
  $ext = substr($filename, -4, strrpos($filename, '.'));
  $filename = substr($filename, 0, strrpos($filename, '.'));
  $filename = str_replace(' ','',$filename);  
  $filename = str_replace('.','',$filename);  

  if(!empty($_FILES['aidres_proof_upload']['name']))
  {        
    $config['upload_path']   = './cdn/identityformb/'; 
    $config['allowed_types'] = 'gif|jpg|pdf';      
          //$config['max_size']      = 15000;
    $config['file_name'] = $new_name.$filename;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('aidres_proof_upload'))
    {
      $error = array('error' => $this->upload->display_errors()); 

    }else
    { 
      $uploadedImage = $this->upload->data();      
    } 
    $residence_url_partb='cdn/identityformb/'.$new_name.$filename.$ext;
  }      
  else
  {        
          //$part_c = $this->report_model->getPartc($ref_no);
    $residence_url_partb=$datapartb['residence_url_partb'] ?? '';
  } 


          //auth_doc_upload

  $filename=$_FILES['auth_doc_upload']['name'];
  $ext = substr($filename, -4, strrpos($filename, '.'));
  $filename = substr($filename, 0, strrpos($filename, '.'));
  $filename = str_replace(' ','',$filename);  
  $filename = str_replace('.','',$filename);  

  if(!empty($_FILES['auth_doc_upload']['name']))
  {  

    $config['upload_path']   = './cdn/auth_doc_upload/'; 
    $config['allowed_types'] = 'gif|jpg|pdf';      
          //$config['max_size']      = 15000;
    $config['file_name'] = $new_name.$filename;
    $this->upload->initialize($config);
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('auth_doc_upload'))
    {
      $error = array('error' => $this->upload->display_errors()); 

    }else
    { 
      $uploadedImage = $this->upload->data();      
    } 
    $auth_doc_upload='cdn/auth_doc_upload/'.$new_name.$filename.$ext;
  }      
  else
  {           
    $auth_doc_upload=$datapartb['auth_doc_upload'] ?? ''; 
  } 



  $aidentity_proof_doi= ($this->input->post('aidentity_proof_doi'));
  if($aidentity_proof_doi !='')
  {
    $aidentity_proof_doi = get_entrydate($aidentity_proof_doi);
  }
  else
  {
    $aidentity_proof_doi = null;
  }

  $aidentity_proof_vupto= ($this->input->post('aidentity_proof_vupto'));
  if($aidentity_proof_vupto !='')
  {
    $aidentity_proof_vupto = get_entrydate($aidentity_proof_vupto);
  }
  else
  {
    $aidentity_proof_vupto = null;
  }

  $aidres_proof_doi= ($this->input->post('aidres_proof_doi'));
  if($aidres_proof_doi !='')
  {
    $aidres_proof_doi = get_entrydate($aidres_proof_doi);
  }
  else
  {
    $aidres_proof_doi = null;
  }

  $aidres_proof_vupto= ($this->input->post('aidres_proof_vupto'));
  if($aidres_proof_vupto !='')
  {
    $aidres_proof_vupto = get_entrydate($aidres_proof_vupto);
  }
  else
  {
    $aidres_proof_vupto = null;
  }


  $this->form_validation->set_rules('o_state_id', 'Organization State', 'required');
  $this->form_validation->set_rules('o_dist_id', 'Organization District', 'required');
  $this->form_validation->set_rules('o_country_id', 'Organization Country', 'required');
  $this->form_validation->set_rules('o_promob_no', 'Organization Mobile no', 'required');
  $this->form_validation->set_rules('a_salutation_id', 'Mobile No', 'required');
  $this->form_validation->set_rules('a_first_name', 'First Name', 'required');
  $this->form_validation->set_rules('a_gender_id', 'Gender', 'required');
  $this->form_validation->set_rules('a_age_years', 'Age Years', 'required');
  $this->form_validation->set_rules('a_nationality_id', 'Nationality', 'required');
  $this->form_validation->set_rules('aidentity_proof_id', 'Identity Proof', 'required');
  $this->form_validation->set_rules('aidres_proof_id', 'Address Proof', 'required');
  $this->form_validation->set_rules('ap_state_id', 'Permanent State', 'required');
  $this->form_validation->set_rules('ap_dist_id', 'Permanent District', 'required');
  $this->form_validation->set_rules('ap_country_id', 'Permanent Country Name', 'required');
  $this->form_validation->set_rules('ac_state_id', 'Correspondance State', 'required');
  $this->form_validation->set_rules('ac_dist_id', 'Correspondance District', 'required');
  $this->form_validation->set_rules('ac_country_id', 'Correspondance Country Name', 'required');
  $this->form_validation->set_rules('amob_no', 'Mobile No', 'required');
  if(!empty($_FILES['identity_proof_upload']['name']))
  {   
    $parameters = $_FILES['identity_proof_upload']['name']."||".$_FILES['identity_proof_upload']['size']."||".$_FILES['identity_proof_upload']['tmp_name'];      
    $this->form_validation->set_rules('identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
  }

  if(!empty($_FILES['aidres_proof_upload']['name']))
  {   
    $parameters = $_FILES['aidres_proof_upload']['name']."||".$_FILES['aidres_proof_upload']['size']."||".$_FILES['aidres_proof_upload']['tmp_name'];      
    $this->form_validation->set_rules('aidres_proof_upload', '', 'callback_validate_image['.$parameters.']');
  }

  if(!empty($_FILES['auth_doc_upload']['name']))
  {   
    $parameters = $_FILES['auth_doc_upload']['name']."||".$_FILES['auth_doc_upload']['size']."||".$_FILES['auth_doc_upload']['tmp_name'];      
    $this->form_validation->set_rules('auth_doc_upload', '', 'callback_validate_image['.$parameters.']');
  }
  if($this->form_validation->run() == FALSE)
  {                  
    if($this->isUserLoggedIn) 
    {
     $con = array( 
      'id' => $this->session->userdata('userId') 
    ); 
     $data['user'] = $this->login_model->getRows($this->con);  
     $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
     $this->load->library('label');
     $this->load->helper("date_helper");
     $ref_no=$this->session->userdata('ref_no');

     if($ref_no !='')
     {
       $data['partb'] = $this->report_model->getPartbdata($ref_no);
     }
     $data['salution'] = $this->common_model->getSalution();                   
     $data['gender'] = $this->common_model->getGender();
     $data['nationality'] = $this->common_model->getNationality();
     $data['identityproof'] = $this->common_model->getIdentityproof();
     $data['residenceproof'] = $this->common_model->getResidence();
     $data['getcountry'] = $this->common_model->getCountry();
     $data['complaintmode'] = $this->common_model->getComplaintmode();
     $data['identity_document_type'] = $this->common_model->getDocument_type();                  
     $data['state'] = $this->common_model->getStateName();                                    
     $data['form_part'] = 'B';  
    // $this->load->view('templates/front/header2.php',$data);
     $this->load->view('templates/front/CE_Header.php',$data);
     $this->load->view('filing/applet.php',$data);
     $this->load->view('templates/front/CE_Footer.php',$data);
   }                 
   else
   {
    redirect('admin/login'); 
  }

}
else
{          // $array['user_id'];
$ref_no=$ref_no;
$curYear = date('Y');
$complaint_year =$curYear;

$user_id=$userid;
$status='0';

$identity_url_partb=$identity_url_partb;
$residence_url_partb=$residence_url_partb;
$auth_doc_upload=$auth_doc_upload;
$orgn_referred_india= ($this->input->post('orgn_referred_india'));
$cert_regInc_encl= ($this->input->post('cert_regInc_encl'));
$auth_ireginc= ($this->input->post('auth_ireginc'));
$o_add1= ($this->input->post('o_add1'));
$o_hpnl= ($this->input->post('o_hpnl'));
$o_vill_city= ($this->input->post('o_vill_city'));      
$o_country_id= ($this->input->post('o_country_id'));      
$o_state_id= ($this->input->post('o_state_id'));      
$o_dist_id= ($this->input->post('o_dist_id')); 
$o_pin_code= ($this->input->post('o_pin_code'));
$o_tel_no= ($this->input->post('o_tel_no'));      
$o_email_id= ($this->input->post('o_email_id'));
$o_promob_no= ($this->input->post('o_promob_no'));
$h_salutation_id= ($this->input->post('h_salutation_id'));
$h_sur_name= ($this->input->post('h_sur_name'));
$h_mid_name= ($this->input->post('h_mid_name'));
$h_first_name= ($this->input->post('h_first_name'));
$a_salutation_id= ($this->input->post('a_salutation_id'));
$a_sur_name= ($this->input->post('a_sur_name'));      
$a_mid_name= ($this->input->post('a_mid_name'));
$a_first_name= ($this->input->post('a_first_name'));
$a_gender_id= ($this->input->post('a_gender_id'));
$a_age_years= ($this->input->post('a_age_years'));
$a_nationality_id= ($this->input->post('a_nationality_id'));
$aidentity_proof_id= ($this->input->post('aidentity_proof_id'));
$aidentity_proof_no= ($this->input->post('aidentity_proof_no'));

$aidentity_proof_doi=$aidentity_proof_doi;
$aidentity_proof_vupto=$aidentity_proof_vupto;

$aidentity_proof_iauth= ($this->input->post('aidentity_proof_iauth'));
$aidres_proof_id= ($this->input->post('aidres_proof_id'));
$aidres_proof_no= ($this->input->post('aidres_proof_no'));

$aidres_proof_doi=$aidres_proof_doi;
$aidres_proof_vupto=$aidres_proof_vupto;

$aidres_proof_iauth= ($this->input->post('aidres_proof_iauth'));
$ap_add1= ($this->input->post('ap_add1'));
$ap_hpnl= ($this->input->post('ap_hpnl'));
$ap_state_id= ($this->input->post('ap_state_id'));
$ap_dist_id= ($this->input->post('ap_dist_id'));
$ap_pin_code= ($this->input->post('ap_pin_code'));
$ap_country_id= ($this->input->post('ap_country_id'));
$ap_vill_city= ($this->input->post('ap_vill_city'));
$ac_add1= ($this->input->post('ac_add1'));
$ac_hpnl= ($this->input->post('ac_hpnl'));
$ac_state_id= ($this->input->post('ac_state_id'));
$ac_dist_id= ($this->input->post('ac_dist_id'));
$ac_pin_code= ($this->input->post('ac_pin_code'));
$ac_country_id= ($this->input->post('ac_country_id'));
$ac_vill_city= ($this->input->post('ac_vill_city'));
$aoccu_desig_avo= ($this->input->post('aoccu_desig_avo'));
$atel_no= ($this->input->post('atel_no'));
$amob_no= ($this->input->post('amob_no'));
$email_id= ($this->input->post('email_id'));
$auth_doc_encl= ($this->input->post('auth_doc_encl'));
$affect_3rdparty= ($this->input->post('affect_3rdparty'));
$ip=$ip;
$updated_at=$updated_at;
$affect_office_beared= ($this->input->post('affect_office_beared')); 


$formbdata_modify = array(
  'status'=>'0',
  'complaint_year'=>$complaint_year,
  'ref_no' => $ref_no,
  'user_id'=>$userid,
  'identity_url_partb'=>$identity_url_partb,
  'residence_url_partb'=>$residence_url_partb,
  'auth_doc_upload'=>$auth_doc_upload,
  'orgn_referred_india' => $orgn_referred_india,
  'cert_regInc_encl' => $cert_regInc_encl,
  'auth_ireginc' => $auth_ireginc,
  'o_add1' => $o_add1,   
  'o_hpnl' => $o_hpnl,
  'o_vill_city' => $o_vill_city,
  'o_country_id' => $o_country_id,
  'o_state_id' => $o_state_id,
  'o_dist_id' => $o_dist_id,
  'o_pin_code' => $o_pin_code,
  'o_tel_no' => $o_tel_no,
  'o_email_id' => $o_email_id,   
  'o_promob_no' => $o_promob_no,
  'h_salutation_id' => $h_salutation_id,
  'h_sur_name' => $h_sur_name,
  'h_mid_name' => $h_mid_name,
  'h_first_name' => $h_first_name,
  'a_salutation_id' => $a_salutation_id,
  'a_sur_name' => $a_sur_name,
  'a_mid_name' => $a_mid_name,
  'a_first_name' => $a_first_name,   
  'a_gender_id' => $a_gender_id,
  'a_age_years' => $a_age_years,
  'a_nationality_id'=> $a_nationality_id,
  'aidentity_proof_id'=> $aidentity_proof_id,
  'aidentity_proof_no'=> $aidentity_proof_no,
  'aidentity_proof_doi'=> $aidentity_proof_doi,
  'aidentity_proof_vupto'=> $aidentity_proof_vupto,
  'aidentity_proof_iauth'=> $aidentity_proof_iauth,
  'aidres_proof_id'=> $aidres_proof_id,
  'aidres_proof_no'=> $aidres_proof_no,
  'aidres_proof_doi'=> $aidres_proof_doi,
  'aidres_proof_vupto'=> $aidres_proof_vupto,
  'aidres_proof_iauth'=> $aidres_proof_iauth,
  'ap_add1'=> $ap_add1,
  'ap_hpnl'=> $ap_hpnl,
  'ap_state_id'=> $ap_state_id,
  'ap_dist_id'=> $ap_dist_id,
  'ap_pin_code'=> $ap_pin_code,
  'ap_country_id'=> $ap_country_id,
  'ap_vill_city'=> $ap_vill_city,
  'ac_add1'=> $ac_add1,
  'ac_hpnl'=> $ac_hpnl,
  'ac_state_id'=> $ac_state_id,
  'ac_dist_id'=> $ac_dist_id,
  'ac_pin_code'=> $ac_pin_code,
  'ac_country_id'=> $ac_country_id,
  'ac_vill_city'=> $ac_vill_city,
  'aoccu_desig_avo'=> $aoccu_desig_avo,
  'atel_no'=> $atel_no,
  'amob_no'=> $amob_no,
  'email_id'=> $email_id,
  'auth_doc_encl'=> $auth_doc_encl,
  'affect_3rdparty'=> $affect_3rdparty,
  'ip'=>$ip,
  'updated_at'=>$updated_at,
  'affect_office_beared'=> $affect_office_beared,   
);
$data = $this->filing_model->insert_partB_his($ref_no);
$employeeId = $this->filing_model->modifyFormbFiling($formbdata_modify);


                if($employeeId){ 
      //$this->session->set_flashdata('success_msg', 'Public Servant detail data has been successfully modified.'); 
       redirect('/respondent/respondentfiling');
    }  
    else
    {
      echo "check data";
    }
}
}
//redirect('/respondent/respondentfiling');

}


}
?>  





