<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Affidavit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('filing_model');
    $this->load->model('report_model');
    $this->load->model('reports_model');
    $this->load->model('scrutiny_model');
    $this->load->model('common_model');
    $this->load->helper('url', 'form');
    $this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->library('session');
    $this->load->library('image_lib');
    $this->load->library('label');
    $this->load->library('html2pdf');
    $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    $this->load->library('Menus_lib');
    $this->load->model('login_model');
    $this->load->helper("compno_helper");
    $this->load->helper("parts_status_helper");

  }

  public function affidavit_detail($dash_ref_no=NULL){	

   if($this->isUserLoggedIn) 
   {
    $con = array( 
      'id' => $this->session->userdata('userId') 
    ); 
    $data['user'] = $this->login_model->getRows($con);
    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

   //$array=$this->session->userdata('ref_no');

    if($dash_ref_no == NULL ){
      $refe_no=$this->session->userdata('ref_no');
    }else{
          //$ref_no=$this->session->userdata('ref_no');
      $refe_no = $dash_ref_no;
      $this->session->set_userdata('ref_no',$refe_no);
    }
    
//$refe_no=$array['ref_no'];
//echo "here";	die;

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
    $data['public_servantc'] = $this->report_model->getPartc($refe_no);
    $data['witness_detail'] = $this->report_model->getPartc_Witness($refe_no);
    $data['public_servant_detail'] = $this->report_model->getPublic_servant_detail($refe_no);
    $data['farma'] = $this->common_model->getFormadata($refe_no);
    $data['farmb'] = $this->report_model->getFormadatb($refe_no);
    $data['officebeare'] = $this->report_model->getOfficebeare($refe_no);


    $data['addparty'] = $this->report_model->getAddparties($refe_no);
      $data['addpartyc'] = $this->report_model->getAddparties_partc($refe_no);
		//echo "<pre>";
		//print_r($data);die;
    $data['form_part'] = 'R';
    $this->load->view('templates/front/CE_Header.php',$data);
    $this->load->view('filing/affidavit.php',$data);
    $this->load->view('templates/front/CE_Footer.php',$data);
    
  }
  else{
    redirect('user/login'); 
  }

}


public function update_form_status(){ 
  //print_r($_POST);die();
 if($this->isUserLoggedIn) 
 {
  $con = array( 
    'id' => $this->session->userdata('userId') 
  ); 
  $data['user'] = $this->login_model->getRows($con);
  $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
  $user_id = $data['user']['id'];
  
  if($this->input->post('data_action'))
  {
    $data_action = $this->input->post('data_action');

    if($data_action == 'update_form')
    {
      $ts = date('Y-m-d H:i:s', time());
      $comp_data = $this->generate_filingno();

      //check counter validation
      if($comp_data['chk_cou'] == '')
      {
        $this->session->set_flashdata('error_msg', 'Counters does not matched.');
        $array = array(
          'error' => true,
        );
        echo json_encode($array);
        exit();
      }
      //end

      $upd_data1 = array(
        'filing_status' => 'true',
        'filing_no' => $comp_data['comp_no'],
        'dt_of_filing' => date('Y-m-d'),
        'openforedit' => 'false',
      );
      //print_r($upd_data['complaint_no']);die('FN');
      $query1 = $this->filing_model->update_complaint_status($upd_data1, $this->input->post('reference_no'), $user_id);  //we never ever update filing no
      //$query = 0;


      $ref_no=$this->session->userdata('ref_no');
      $comp_cap = get_parta_comptype($ref_no, $user_id);
      
      if($comp_cap != 1){
      $upd_data2 = array(
        'status' => 'true',
        'filing_no' => $comp_data['comp_no'],
      );
      //print_r($upd_data['complaint_no']);die('FN');
      $query2 = $this->filing_model->update_complaint_partb($upd_data2, $this->input->post('reference_no'), $user_id);  //we never ever update filing no
      //$query = 0;
    }else{
      $query2 = 1;
    }

      $upd_data3 = array(
        'status' => 'true',
        'filing_no' => $comp_data['comp_no'],
      );
      //print_r($upd_data['complaint_no']);die('FN');
      $query3 = $this->filing_model->update_complaint_partc($upd_data3, $this->input->post('reference_no'), $user_id);  //we never ever update filing no
      //$query = 0;


      if($query1 && $query2 && $query3){ 
        $upd_data = array(
          'filing_counter' => $comp_data['counter']
        );
        $this->filing_model->update_year_initialisation($comp_data['year'], $upd_data);

        $ts = date('Y-m-d H:i:s', time());
        $ip = $this->get_ip();
        $insert_data = array(
          'ref_no' => $this->input->post('reference_no'),
          'user_id' => $user_id,
          'filing_no' => $comp_data['comp_no'],
          'created_at' => $ts,
          'ip' => $ip,
        );
        $this->filing_model->update_fil_his($insert_data);

        $ins_data = array( 
        'filing_no'=>$comp_data['comp_no'],  
        'entry_date'=>$ts,
        'scrutiny_status'=>'f',
        'level'=>1,
         );
        $add_to_scrutiny = $this->scrutiny_model->scrutiny_ins($ins_data);
        //make a log file if insert is failed with data and error cause.
         //ysc code for db insertion of gazzette_notification_url cdn/complainpdf



        $gazzette_notification_url='cdn/complainpdf/'.$comp_data['comp_no'].'.pdf';

       // echo $gazzette_notification_url;die;

       // exportToPdf('1', $comp_data['comp_no']);

         

          //  $parta = $this->partapdf($filing_no);

        $gazzette_notification_data = array(
            'gazzette_notification_url' =>$gazzette_notification_url,
                );
        $gazzette_notification_update = $this->report_model->update_complaint_gazzette_notification($comp_data['comp_no'] ,$gazzette_notification_data);
        
        $this->session->set_flashdata('success_msg', 'Complainant submitted successfully'); 
        $array = array(
          'success' => true,
          'fn' => $comp_data['comp_no'],
        );
   
          
        //redirect('affidavit/affidavit_detail'); 
      }else{ 
        $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
        $array = array(
          'error' => true,
        );
        //redirect('affidavit/affidavit_detail');
        //$data['error_msg'] = 'Some problems occured, please try again.'; 
      }
      echo json_encode($array);
  //print_r($upd_data);die('lk');
    }
  }

}
else{
  redirect('admin/login'); 
}


}


public function exportToPdf(){ 
  $save_in_server = $this->input->post('save_in_server');
  $filename = $this->input->post('filename');
   //echo "in here pdf";die;

  //echo $save_in_server;

 // echo $filename;

  //die('@@@@@');

//$array=$this->session->userdata('ref_no');
  $this->load->helper("date_helper"); 
  $refe_no=$this->session->userdata('ref_no');
//$refe_no=$array['ref_no'];
  $chkdate= date("l jS \of F Y");

  $farmadata = $this->common_model->getFormadata($refe_no);
  $myArray=(array)$farmadata;
  $myArray[0]->first_name ?? '';
  $affidavit= $myArray[0]->affidavit_upload ?? '';
  $myArray[0]->age_years ?? '';
  $myArray[0]->fath_name ?? '';
  $myArray[0]->comp_f_place ?? '';
  $myArray[0]->comp_f_date ?? '';
  $cp=$myArray[0]->complaint_capacity_id ?? '';
  $cm=$myArray[0]->complaintmode_id ?? '';
  $st=$myArray[0]->salutation_id ?? '';
  $gn=$myArray[0]->gender_id ?? '';
  $na=$myArray[0]->p_country_id ?? '';
  $cn=$myArray[0]->c_country_id ?? '';
  $ide=$myArray[0]->identity_proof_id ?? '';
  $rde=$myArray[0]->idres_proof_id ?? '';
  $pstate=$myArray[0]->p_state_id ?? '';
  $cstate=$myArray[0]->c_state_id ?? '';
  $pdistrict=$myArray[0]->p_dist_id ?? '';
  $cdistrict=$myArray[0]->c_district_id ?? '';
  $pc=$myArray[0]->p_country_id ?? ''; 

  $dt_of_filing=$myArray[0]->dt_of_filing ?? '';
    $dt_of_filing=get_displaydate($dt_of_filing);

  $affidavit_upload=$myArray[0]->affidavit_upload ?? '';
   $affidavitupload=base_url().$affidavit_upload.'.'.'pdf';

  $ide_dateofissue=$myArray[0]->identity_proof_doi;
  $ide_dateofissue=get_displaydate($ide_dateofissue);

  $complaint_capacity = $this->report_model->getComplaincapicity($cp);
  $complaint_desc= $complaint_capacity['complaint_capacity_desc'];
  $complaint_mode = $this->report_model->getComplaintMode($cm);
  $complaint_mode_desc=$complaint_mode['complaintmode_desc'];
  $salutationdata = $this->report_model->getSalutation($st);
  $salutation_desc=$salutationdata['salutation_desc'];
  $genderdata = $this->report_model->getGender($gn);
  $gender_desc=$genderdata['gender_desc'];
  $nationaldata = $this->report_model->getNationality($na);
  $national_desc=$nationaldata['nationality_desc'];
  $identitydata = $this->report_model->getIdentity($ide);
  $ide_desc=$identitydata['Identity_proof_desc'];
  $residencedata = $this->report_model->getResidence($rde);
  $rde_desc=$residencedata['idres_proof_desc'];
  $pstatedata = $this->report_model->getPstate($pstate);
  $pstatename=$pstatedata['name'];
  $cstatedata = $this->report_model->getPstate($cstate);
  $cstatename=$cstatedata['name'];
  $pdistrict = $this->report_model->getPdistrict($pstate,$pdistrict);
  $pdistrictname=$pdistrict['name'];
  $cdistrict = $this->report_model->getPdistrict($cstate,$cdistrict);
  $cdistrictname=$cdistrict['name'];
  $pnationality=$this->report_model->getNationality($pc);
  $pnational_desc=$pnationality['nationality_desc'];
  $cnationality=$this->report_model->getNationality($cn);
  $cnational_desc=$cnationality['nationality_desc'];

  $notory_affi=$myArray[0]->notory_affi_annex ?? '';
  if($notory_affi==1)
  {

    $notory_affi='Yes';
  }
  else
  {
    $notory_affi='No';
  }

  $c_victim=$myArray[0]->complainant_victim ?? '';
  if($c_victim==1)
  {

    $c_victim='Yes';
  }
  else
  {
    $c_victim='No';
  }


  /*part c start */
  $datac = $this->report_model->getPartc($refe_no);
  $psid=$datac['ps_salutation_id'] ?? '';
  if($psid !='')
  {
    $pssalution = $this->report_model->getSalutation($psid);
    $pstitile_desc=$pssalution['salutation_desc'];
  }
  else
  {
   $pstitile_desc='';
 }
 $pssurname=$datac['ps_sur_name'] ?? '';
 $psmidname=$datac['ps_mid_name'] ?? '';
 $psfirstname=$datac['ps_first_name'] ?? '';

 $partcname=$psfirstname.' '.$psmidname.' '.$pssurname;
 $pssdsp=$datac['ps_dsp_lp'] ?? '';
 if($pssdsp=='1')
 {
  $pssdsp='Yes';
}
else
{
  $pssdsp='No';
}
$psdesig=$datac['ps_desig'] ?? '';
$psothcate=$datac['ps_othcate'] ?? '';
$psorgn=$datac['ps_orgn'] ?? '';
$psfingoi=$datac['tas_fingoi'] ?? '';
$present_ps_desig=$datac['present_ps_desig'] ?? '';


if($psfingoi =='1')
{
  $psfingoi='Yes';
}
elseif($psfingoi =='2')
{
  $psfingoi='No';
}
else
{
  $psfingoi='N/A';
}


$psonecr=$datac['anninc_onecr'] ?? '';
if($psonecr =='1')
{
  $psonecr='Yes';
}
elseif($psonecr =='2')
{
  $psonecr='No';
}
else
{
  $psonecr='N/A';
}
$psdonafs=$datac['dona_fs'] ?? '';
if($psdonafs =='1')
{
  $psdonafs='Yes';
}
elseif($psdonafs =='2')
{
  $psdonafs='No';
}
else
{
  $psdonafs ='N/A';
}


$ps_psssbbca=$datac['pss_sbbca'] ?? '';
if($ps_psssbbca ='1')
{
  $ps_psssbbca="Yes";

}
else
{
  $ps_psssbbca="No";

}

$postheld=$datac['psc_postheld'] ?? '';
$psectorid =$datac['complaint_capacity_id'] ?? '';
if($psectorid !='')
{
  $pssalution = $this->report_model->getPublicsector($psectorid);
  $ccapacity=$pssalution['complaint_capacity_desc'];
}
else
{
 $ccapacity='';
}
 
$subcat =$datac['ps_id'] ?? '';
if($subcat !='')
{
  $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
  $subcat_desc=$pssubcat['ps_desc'] ;
}
else
{
  $subcat_desc='';
}

$cstateid =$datac['ps_pl_stateid'] ?? '';
if($cstateid !='')
{
  $cstate = $this->report_model->getPstate($cstateid);
  $c_statename=$cstate['name'];
}
else
{
  $c_statename='';
}
$cdistid =$datac['ps_pl_dist_id'] ?? '';
if($cdistid !='')
{
  $cdist = $this->report_model->getPdistrict($cstateid,$cdistid);
  $c_districtname=$cdist['name'];
}
else
{
  $c_districtname='';
}
$periodf_coa=$datac['periodf_coa'] ?? '';
$periodf_coa=get_displaydate($periodf_coa);
$periodt_coa=$datac['periodt_coa'] ?? '';
$periodt_coa=get_displaydate($periodt_coa);
$ps_pl_occ=$datac['ps_pl_occ'] ?? '';
$sum_facalle=$datac['sum_facalle'] ?? '';
$det_offen=$datac['det_offen'] ?? '';
$prov_viola=$datac['prov_viola'] ?? '';
$any_othInfo=$datac['any_othInfo'] ?? '';
$relied_doc_list=$datac['relied_doc_list'] ?? '';
$doc_copy_attached=$datac['doc_copy_attached'] ?? '';

$doc_copy_attached=$datac['doc_copy_attached'] ?? '';
if($doc_copy_attached =='1')
{
  $doc_copy_attached='Yes';
}
else
{
  $doc_copy_attached='No';
}

$electronic_file=$datac['electronic_file'] ?? '';

$electronic_file=$datac['electronic_file'] ?? '';
if($electronic_file =='1')
{
  $electronic_file='Yes';
}
else
{
  $electronic_file='No';
}


/*end partc part*/

/*  start part witness detail  */

 




$datawitness = $this->report_model->getPartc_Witness($refe_no);
$witnesscount=count($datawitness);

$witnessesList ='';
$rowNo = 1;
if($datawitness){
  foreach ($datawitness as $key => $value) {
  
   $witnessesList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Witness - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(b) Name: <br> </td>
   <td style="border: 1px solid black;">'.$value->w_first_name.' '.$value->w_mid_name.' '.$value->w_sur_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(c) Gender: <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(d) Age: <br>

   </td><td style="border: 1px solid black;">'.$value->w_age_years.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(e) Full Address: <br>
   </td><td style="border: 1px solid black;">'.$value->w_hpnl.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(f) Mobile No: <br>

   </td><td style="border: 1px solid black;">'.$value->w_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(g) E-mail Id: <br>
   </td><td style="border: 1px solid black;">'.$value->w_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}
//echo "part b start";
//echo $cp;die;

if($cp >1)
{

  $datapartb = $this->report_model->getPartbdata($refe_no);

  $orgn_referred_india=$datapartb['orgn_referred_india'] ?? '';

  if($orgn_referred_india ==1)
  {

    $orgn_referred_india='Yes';
  }
  else
  {
    $orgn_referred_india='No';
  }
  $cert_regInc_encl=$datapartb['cert_regInc_encl'] ?? '';
  if($cert_regInc_encl ==1)
  {
    $cert_regInc_encl='Yes';
  }
  else
  {
    $cert_regInc_encl='No';
  }
  $auth_ireginc=$datapartb['auth_ireginc'] ?? '';
  $o_add1=$datapartb['o_add1'] ?? '';
  $o_hpnl=$datapartb['o_hpnl'] ?? '';
  $o_vill_city=$datapartb['o_vill_city'] ?? '';

  $wstate_id =$datapartb['o_state_id'] ?? '';

  if($wstate_id !='')
  {
    $wstate = $this->report_model->getPstate($wstate_id);
    $wstatenamee=$wstate['name'];
  }
  else
  {
    $wstatenamee='';
  }
  $wdist_id =$datapartb['o_dist_id'] ?? '';

  if($wdist_id !='')
  {
    $wdist = $this->report_model->getPdistrict($wstate_id,$wdist_id);
    $wdistrictnamee=$wdist['name'];
  }
  else
  {
    $wdistrictnamee='';
  }
  $o_pin_code=$datapartb['o_pin_code'] ?? '';
  $o_tel_no=$datapartb['o_tel_no'] ?? '';
  $o_promob_no=$datapartb['o_promob_no'] ?? '';
  $o_email_id=$datapartb['o_email_id'] ?? '';
  $o_country_id=$datapartb['o_country_id'] ?? '';
  $wcountry_id =$datapartb['o_country_id'] ?? '';
  if($wcountry_id !='')
  {
    $wcountry = $this->report_model->getNationality($wcountry_id);
    $wcountrynamee=$wcountry['nationality_desc'];
  }
  else
  {
    $wcountrynamee='';
  }
  $h_sur_name=$datapartb['h_sur_name'] ?? '';
  $h_mid_name=$datapartb['h_mid_name'] ?? '';
  $h_first_name=$datapartb['h_first_name'] ?? '';
  $h_salutation_id=$datapartb['h_salutation_id'] ?? '';
  $org_psid=$datapartb['h_salutation_id'] ?? '';
  if($org_psid !='')
  {
    $pssalution = $this->report_model->getSalutation($org_psid);
    $orgtile_desc=$pssalution['salutation_desc'];
  }
  else
  {
   $orgtile_desc='';
 }
 $a_sur_name=$datapartb['a_sur_name'] ?? '';
 $a_mid_name=$datapartb['a_mid_name'] ?? '';
 $a_first_name=$datapartb['a_first_name'] ?? '';
 $a_age_years=$datapartb['a_age_years'] ?? '';
 $psid=$datapartb['a_salutation_id'] ?? '';
 if($psid !='')
 {
  $pssalution = $this->report_model->getSalutation($psid);
  $pstitile_desc=$pssalution['salutation_desc'];
}
else
{
 $pstitile_desc='';
}
$org_gid=$datapartb['a_gender_id'] ?? '';
if($org_gid !='')
{
  $wgender = $this->report_model->getGender($org_gid);
  $org_gen_desc=$wgender['gender_desc'];
}
else
{
  $org_gen_desc='';
}

$aidentity_proof_vupto=$datapartb['aidentity_proof_vupto'] ?? '';
$aidentity_proof_vupto=get_displaydate($aidentity_proof_vupto);
$aidentity_proof_iauth=$datapartb['aidentity_proof_iauth'] ?? '';
$aidentity_proof_doi=$datapartb['aidentity_proof_doi'] ?? '';
$aidentity_proof_doi=get_displaydate($aidentity_proof_doi);

$aidentity_proof_no=$datapartb['aidentity_proof_no'] ?? '';     
$org_id=$datapartb['aidentity_proof_id'] ?? '';    
if($org_id !='')
{
  $org_identity = $this->report_model->getIdentity($org_id);
  $org_identity=$org_identity['Identity_proof_desc'] ?? '';
}
else
{
  $org_identity='';
}
$org_id=$datapartb['a_nationality_id'] ?? '';
if($org_id !='')
{
  $wcountry = $this->report_model->getNationality($org_id);
  $org_countryname=$wcountry['nationality_desc'];
}
else
{
  $org_countryname='';
}

$aidres_proof_no=$datapartb['aidres_proof_no'] ?? '';
$aidres_proof_doi=$datapartb['aidres_proof_doi'] ?? '';
$aidres_proof_vupto=$datapartb['aidres_proof_vupto'] ?? '';
$aidres_proof_iauth=$datapartb['aidres_proof_iauth'] ?? ''; 
$wc_id =$datapartb['aidres_proof_id'] ?? '';
if($wc_id !='')
{
  $wcountry = $this->report_model->getResidence($wc_id);
  $wcountryname=$wcountry['idres_proof_desc'];
}
else
{
  $wcountryname='';
}

$ap_add1=$datapartb['ap_add1'] ?? '';
$ap_hpnl=$datapartb['ap_hpnl'] ?? '';
$ap_vill_city=$datapartb['ap_vill_city'] ?? '';
$ap_pin_code=$datapartb['ap_pin_code'] ?? '';  
$org_wstateid =$datapartb['ap_state_id'] ?? '';
if($org_wstateid !='')
{
  $wstate = $this->report_model->getPstate($org_wstateid);
  $org_wstatename=$wstate['name'];
}
else
{
  $org_wstatename='';
}
$org_wdistid =$datapartb['ap_dist_id'] ?? '';

if($org_wdistid !='')
{
  $org_wdist = $this->report_model->getPdistrict($org_wstateid,$org_wdistid);
  $org_wdist=$org_wdist['name'];
}
else
{
  $org_wdist='';
}

$org_wc_id=$datapartb['ap_country_id'] ?? '';
if($org_wc_id !='')
{
  $org_wcountry = $this->report_model->getNationality($org_wc_id);
  $org_wcountry=$org_wcountry['nationality_desc'];
}
else
{
  $org_wcountry='';
}

$ac_add1=$datapartb['ac_add1'] ?? '';
$ac_hpnl=$datapartb['ac_hpnl'] ?? '';
$ac_vill_city=$datapartb['ac_vill_city'] ?? '';
$ac_pin_code=$datapartb['ac_pin_code'] ?? '';  
$org_per_id =$datapartb['ac_state_id'] ?? '';
if($org_per_id !='')
{
  $wstate = $this->report_model->getPstate($org_per_id);
  $org_per_state_name=$wstate['name'];
}
else
{
  $org_per_state_name='';
}
$org_co_id =$datapartb['ac_dist_id']  ?? '';

if($org_co_id !='')
{
  $wdist = $this->report_model->getPdistrict($org_per_id,$org_co_id);
  $org_co_dist_name=$wdist['name'];
}
else
{
  $org_co_dist_name='';
}

$org_co_country_id=$datapartb['ac_country_id'] ?? '';
if($org_co_country_id !='')
{
  $wcountry = $this->report_model->getNationality($org_co_country_id);
  $org_co_countryname=$wcountry['nationality_desc'];
}
else
{
  $org_co_countryname='';
}

$aoccu_desig_avo=$datapartb['aoccu_desig_avo'] ?? '';
$atel_no=$datapartb['atel_no'] ?? '';
$amob_no=$datapartb['amob_no'] ?? '';
$email_id=$datapartb['email_id'] ?? '';
$auth_doc_encl=$datapartb['auth_doc_encl'] ?? '';
if($auth_doc_encl =='1')
{
  $auth_doc_encl='Yes';
}
else
{
  $auth_doc_encl='No';
}
$affect_3rdparty=$datapartb['affect_3rdparty'] ?? '';
if($affect_3rdparty =='f')
{
  $affect_3rdparty='Yes';
}
else
{
  $affect_3rdparty='No';
}
$affect_office_beared=$datapartb['affect_office_beared'] ?? '';
/*form b end here */

/* Office beare start here  if necessary then we implment it*/



$officebeare = $this->report_model->getOfficebeare($refe_no);

$officebeareCount=count($officebeare);

$officebearsList ='';
$rowNo = 1;
if($officebeare){
  foreach ($officebeare as $key => $value) {
   $officebearsList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Office Bearer -  '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Name <br> </td>
   <td style="border: 1px solid black;">'.$value->ob_first_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->ob_age_years.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->ob_p_add1.'</td>
   </tr>

    <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Telephone Number(with std code) <br>

   </td><td style="border: 1px solid black;">'.$value->ob_tel_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Mobile Number <br>

   </td><td style="border: 1px solid black;">'.$value->ob_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">e-mail id: <br>
   </td><td style="border: 1px solid black;">'.$value->ob_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}


/*  additional party start here for part B  */

$addparty = $this->report_model->getAddparties($refe_no);

 $addpartyCount_b=count($addparty);


$additionalpartyList ='';
$rowNo = 1;
if($addparty){
  foreach ($addparty as $key => $value) {
   $additionalpartyList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Third Party - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(a)</td>
   <td style="border: 1px solid black;"> Name <br> </td>
   <td style="border: 1px solid black;">'.$value->affect_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;"> Gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(c)</td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->affect_ageyears.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(d)</td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->affect_hpnl.' , '.$value->affect_vill_city.'</td>
   </tr>

    <tr>
   <td style="border: 1px solid black;" align="center">(e)</td>
   <td style="border: 1px solid black;">Telephone Number(with std codes) <br>

   </td><td style="border: 1px solid black;">'.$value->affect_tel_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;">Mobile No <br>

   </td><td style="border: 1px solid black;">'.$value->affect_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(f)</td>
   <td style="border: 1px solid black;">e-mail Id <br>
   </td><td style="border: 1px solid black;">'.$value->affect_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}

}

/*  additional party start here for part C  */

$addparty_partc = $this->report_model->getAddparties_partc($refe_no);

$addpartyCount=count($addparty_partc);


$additionalpartyList_PartC ='';
$rowNo = 1;
if($addparty_partc){
  foreach ($addparty_partc as $key => $value) {
   $additionalpartyList_PartC .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Third Party - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(a)</td>
   <td style="border: 1px solid black;"> Name <br> </td>
   <td style="border: 1px solid black;">'.$value->affect_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;"> Gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(c)</td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->affect_ageyears.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(d)</td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->affect_hpnl.' , '.$value->affect_vill_city.'</td>
   </tr>

  <tr>
   <td style="border: 1px solid black;" align="center">(e)</td>
   <td style="border: 1px solid black;">Telephone Number(with std codes) <br>
   </td><td style="border: 1px solid black;">'.$value->affect_tel_no.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;">Mobile Number <br>
   </td><td style="border: 1px solid black;">'.$value->affect_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">email Id <br>
   </td><td style="border: 1px solid black;">'.$value->affect_email_id.'</td>
   </tr>';
   $rowNo++;
 }

}
 else
 {
   $additionalpartyList_PartC .= '
  <tr>
   <td style="border: 1px solid black;" align="center">Nil</td>
   </tr>';
 }


//$datawitness = $this->report_model->getPartc_Witness($refe_no);
$public_servant_detail = $this->report_model->getPublic_servant_detail($refe_no);
/*
echo "<pre>";
print_r($public_servant_detail);
*/


$pscount=count($public_servant_detail);
$publicservantdetail_list ='';
$rowNo = 1;
if($public_servant_detail){
  foreach ($public_servant_detail as $key => $value) {

   //echo $value->ad_present_ps_desig;die;
      if($value->ad_ps_dsp_lp==1)
      {
        $value->ad_ps_dsp_lp='Yes';
      }
      else
      {
        $value->ad_ps_dsp_lp='No';
      }
      if($value->ad_tas_fingoi==1)
      {
        $value->ad_tas_fingoi='Yes';
      }
      else
      {
        $value->ad_tas_fingoi='No';
      }
      if($value->ad_anninc_onecr==1)
      {
        $value->ad_anninc_onecr='Yes';
      }
      else
      {
        $value->ad_anninc_onecr='No';
      }

       if($value->ad_dona_fs==1)
      {
        $value->ad_dona_fs='Yes';
      }
      else
      {
        $value->ad_dona_fs='No';
      }

       if($value->ad_pss_sbbca==1)
      {
        $value->ad_pss_sbbca='Yes';
      }
      else
      {
        $value->ad_pss_sbbca='No';
      }

       $value->ad_ps_pl_stateid;
     
       $value->ad_ps_pl_dist_id;

      $pdist_name = $this->report_model->getPdistrict($value->ad_ps_pl_stateid,$value->ad_ps_pl_dist_id);
     $p_districtname=$pdist_name['name'];


   $publicservantdetail_list .= '
    <tr>
   
   <td style="border: 1px solid black;"><b>Public Servant </b></td>
   <td style="border: 1px solid black;">'.$rowNo.'</td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
  <td style="border: 1px solid black;" align="center">1.</td>
<td style="border: 1px solid black;">Name the public servent(s) against whome complaint is being made (in block letters)*:
</td>
   <td style="border: 1px solid black;">'.$value->ad_ps_first_name.' '.$value->ad_ps_mid_name.' '.$value->ad_ps_sur_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Present designation/status of the public servant(s) against whome complaint is being made:
</td>
   </td><td style="border: 1px solid black;">'.$value->ad_present_ps_desig.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Whether the complaint is against any
officer or employee or agency(including the Delhi Special Police Establishment), under or associated with the Lokpal ?
</td>
   </td>

   <td style="border: 1px solid black;">'.$value->ad_ps_dsp_lp.'</td>
   </tr>
       <tr>
<td style="border: 1px solid black;" align="center">4</td>
<td style="border: 1px solid black;">With respect to serial no. 2 above,indicate: </td><td style="border: 1px solid black;"></td>
</tr>

    <tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Designation of the officer/emplyee</td><td style="border: 1px solid black;">
'.$value->ad_ps_desig.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Organisation/Agency having administrative control over the said officer/employee</td>
<td style="border: 1px solid black;">
'.$value->ad_ps_orgn.'</td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">5(a).</td>
<td style="border: 1px solid black;">Category of the public servant against whome the complaint <br> is being made</td><td style="border: 1px solid black;">
'.$value->complaint_capacity_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Sub Category</td><td style="border: 1px solid black;">
'.$value->ps_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">5(b).</td>
<td style="border: 1px solid black;">In case the complaint is against any other category of public servant, specify
</td><td style="border: 1px solid black;">'.$value->ad_ps_othcate.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;">In case the complaint is against any Chairperson/Member <br>
Officer/Employee of or a trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">(a)</td>
<td style="border: 1px solid black;">Whether the organisation is wholly or partly financed by the <br>the Government      Officer/Employee of or a trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;">'.$value->ad_tas_fingoi.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(b)</td>
<td style="border: 1px solid black;">Whether the annual income of the organisation exceeds one crore rupees as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$value->ad_anninc_onecr.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(c)</td>
<td style="border: 1px solid black;">Whether the organisation is in receipt of any donation from any foreign source under the foreign contribution  income of the organisation exceeds one crore rupees <br>
as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$value->ad_dona_fs.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;">Please state, if aware, as to whether the public servant is presently serving the afair of the state or in any body or board or corruption or authority,etc establish by an act of the state legislature or wholly or partily financed by the State Government or controlled by it.
</td><td style="border: 1px solid black;">'.$value->ad_pss_sbbca.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;">Post held by the public servant at the time of commission of alleged offence under the Prevention of Corruption Act 1988.
</td><td style="border: 1px solid black;">'.$value->ad_psc_postheld.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;">Details of the Cause of Action/offence(under the Prevention of Corruption Act, 1988).
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(i) Period during which alleged misconduct was committed.
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">from
</td><td style="border: 1px solid black;">'.get_displaydate($value->ad_periodf_coa).'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">to
</td><td style="border: 1px solid black;">'.get_displaydate($value->ad_periodt_coa).'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(ii)Place of Occurrence:
</td><td style="border: 1px solid black;">'.$value->ad_ps_pl_occ.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iii) District:
</td><td style="border: 1px solid black;">'.$p_districtname.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iv) State:
</td><td style="border: 1px solid black;">'.$value->name.'</td>
</tr>';
   $rowNo++;
 }
}
else
 {
   $publicservantdetail_list .= '
  <tr>
   <td style="border: 1px solid black;" align="center">Nil</td>
   </tr>';
 }

$getallwidget =     
'
<div align="center"><b>ANNEXURE</b></div>
<div align="center">FORM OF COMPLAINT</div>
<br>
<div align="center">[See rule 3]</div>
<br>
<div align="center">PART A</div> 
<br>
<div>DETAILS TO BE FURNISHED BY THE COMPLAINT/SIGNATORY TO THE COMPLAINT</div>
<br><br>
<div align="right">Diary Number : <b>'.$myArray[0]->filing_no.' </b></div>

<div align="left">1.Specify if the complaint is being made by : <b>'.$complaint_desc.' </b></div>

<br> <br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">

<tr>
<td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Name of the Complainant(in block letters):<br><br>@attached an identity proof.
<br><br> '.$ide_desc.' </td><td></td>
</tr> 



<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Title(Shri/Smt/kum./Dr.etc.)</td><td style="border: 1px solid black;">'.$salutation_desc.' </td></tr>


<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Sur Name</td><td style="border: 1px solid black;">'.$myArray[0]->sur_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Middle Name</td><td style="border: 1px solid black;">'.$myArray[0]->mid_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">First Name</td><td style="border: 1px solid black;">'.$myArray[0]->first_name.'</td></tr>




<tr>
<td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Gender</td><td style="border: 1px solid black;"> '.$gender_desc.' </td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center">4.</td>
<td style="border: 1px solid black;" align"center">Age <br>[In complete years]</td><td style="border: 1px solid black;"> '.$myArray[0]->age_years.' </td></tr>
<tr>
<td style="border: 1px solid black;" align="center">5.</td>
<td style="border: 1px solid black;" align"center">Nationality</td><td style="border: 1px solid black;">'.$national_desc.' </td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;" align"center">Detail identity/residence proof to be enclosed with the complaint</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Document Attached</td><td style="border: 1px solid black;">'.$ide_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(a) Number</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_no.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(b) Date of issue</td><td style="border: 1px solid black;">'.$ide_dateofissue.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(c) Validity upto</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_vupto.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(d)Issuing Authority</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_iauth.' </td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;" align"center">Permanent Address</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">House/Property Number/Locality</td><td style="border: 1px solid black;">'.$myArray[0]->p_hpnl.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Village/District/City</td><td style="border: 1px solid black;">'.$pdistrictname.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">State</td><td style="border: 1px solid black;">'.$pstatename.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Country</td><td style="border: 1px solid black;">'.$pnational_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Pincode/Postal code or Zonal code</td><td style="border: 1px solid black;">'.$myArray[0]->p_pin_code.' </td>
</tr>



<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;" align"center">Address for Correspondence</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">House/Property Number/Locality</td><td style="border: 1px solid black;">'.$myArray[0]->c_hpnl.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Village/District/City</td><td style="border: 1px solid black;">'.$cdistrictname.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">State</td><td style="border: 1px solid black;">'.$cstatename.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Country</td><td style="border: 1px solid black;">'.$cnational_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Pincode/Postal code or Zonal code</td><td style="border: 1px solid black;">'.$myArray[0]->c_pin_code.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;" align"center">Occupation/designation/avocation</td><td style="border: 1px solid black;">'.$myArray[0]->occu_desig_avo.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">10.</td>
<td style="border: 1px solid black;" align"center">(a)Telephone Number (with ISD/STD) codes</td>
<td style="border: 1px solid black;">'.$myArray[0]->tel_no.'</td></tr>
<tr>
<td></td>
<td style="border: 1px solid black;">(b)Mobile Number (with Country code) </td>
<td style="border: 1px solid black;">'.$myArray[0]->mob_no.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">11.</td>
<td style="border: 1px solid black;" align"center">e-mail id</td>
<td style="border: 1px solid black;">'.$myArray[0]->email_id.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">12.</td>
<td style="border: 1px solid black;" align"center">Mode of presentation of the Complaint</td>
<td style="border: 1px solid black;">'.$complaint_mode_desc.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">13.</td>
<td style="border: 1px solid black;" align"center">Whether the duly notarized affidavit as annexed <br>to this form has been enclosed ?</td>
<td style="border: 1px solid black;">'.$notory_affi.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">14.</td>
<td style="border: 1px solid black;" align"center">Whether the complaint is the victim ?</td>
<td style="border: 1px solid black;">'.$c_victim.'</td></tr>


</table>                      
<br><br>
<div> It is certified that to the best of my knowedge, belief and information :</div> <br>
<div>(i) the alleged Offence in respect of which present complaint is being made is within the period of seven <br>
years [<i>limitations as laid down under section 53 of the Lokpal and lokayuktas Act, 2013]</i>; </div><br>
<div>(ii) no matter or proceeding related to allegation of corruption under the Prevention of Corruption Act,
1988 being made under this complaint is pending before any court or committee of either House of <br> Parliament or before any other authority and the complaint is not barred from being made before the Lokpal <br>
by section 15 of the Lokpal and Lokayuktas Act,2013. </div>
<br><br><br>
<div align="right"><b>                                              Signature of the complaint/<br>
authorised signatory    </div></b> 
<div>   Place :  '.$myArray[0]->comp_f_place.'</div>
<div>Date  : '.$dt_of_filing.'</div>



<br></br><br></br><br></br><br></br><br></br><br></br><br></br>
<br></br><br></br><br></br><br></br><br></br><br></br><br></br>

<br></br><br></br><br></br><br></br><br></br><br></br><br></br>
<br></br><br></br><br></br><br></br><br></br><br></br><br></br>

</br><br></br><br></br>


';                                                                          

if($cp >1){

  $getallwidget .= '

  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>

  <br></br><br></br><br></br><br></br><br></br>
  <div align="center"><b>PART B</b><br></div>

  <div>ADDITIONAL DETAILS TO BE FURNISHED BY THE SIGNATORY TO THE COMPLAINT IF THE <br>
  COMPLAINT IS BEING FILED ON BEHALF OF A BODY OR BOARD OR CORPORATION OR <br>
  AUTHORITY OR COMPANY, SOCIETY OR ASSOCIATION OF PERSONS OR TRUST OR LIMITED <br>
  LIABILITY PARTNERSHIP <br>
  </div><br>

  <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
  
  <tr>
  <td style="border: 1px solid black;" align="center">1.</td>
  <td style="border: 1px solid black;">In case the complaint is made by a body or board or <br> corporation or authority or company, society,assosiation of persons or trust or limited liability partnership,then please indicate:
  </td><td style="border: 1px solid black;"></td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(a)</td>
  <td style="border: 1px solid black;">Whether such organisation as referred to above is based in India ?
  </td><td style="border: 1px solid black;" align="center">'.$orgn_referred_india.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(b)</td>
  <td style="border: 1px solid black;">If the answer to (a) above is "YES" then whether the certificate <br> of registration/incorporation <br>
 <i> [ as issued by the authority competent to
issue such certificate in India or by
authority competent to issue such
certificate as per the regulating law of
the Foreign State, as the case may be],</i><br>
in respect of such organisation has been
enclosed?
  </td><td style="border: 1px solid black;" align="center">'.$cert_regInc_encl.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(c)</td>
  <td style="border: 1px solid black;">Indicate the name of the competent authority which has issue the certificate registration/incorporation of the organisation
  </td><td style="border: 1px solid black;">'.$auth_ireginc.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(d)</td>
  <td style="border: 1px solid black;">Address of correspondence with the organisation<br>                 
  </td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$o_hpnl.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$wdistrictnamee.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$wstatenamee.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$wcountrynamee.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">(f)</td>
  <td style="border: 1px solid black;">Telephone Number (with STD codes)<br>                 
  </td><td style="border: 1px solid black;">'.$o_tel_no.'</td></tr>               
  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Mobile Number                
  </td><td style="border: 1px solid black;">'.$o_promob_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">(g)</td>
  <td style="border: 1px solid black;">e-mail id              
  </td><td style="border: 1px solid black;">'.$o_email_id.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">2.</td>
  <td style="border: 1px solid black;">Personal details of office bearers <br>
  and head of the organisation                
  </td><td style="border: 1px solid black;">furnish details in respect of each Office Bearer and <br>
  Head of organisation in the format as contained in Part A of this form.<br>
  [please see section 47 of the Act] </td>         
  </tr>                    ';

  
  
  $getallwidget .='                    
  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Number of Office beare: <br>

  </td><td style="border: 1px solid black;">'.$officebeareCount.'</td>
  </tr>';

  $getallwidget .=$officebearsList;

  $getallwidget .='                            
  
  <tr>
  <td style="border: 1px solid black;" align="center">3.</td>
  <td style="border: 1px solid black;">Details of the person who has authorised the signatory<br>to file the complaint on 
  behalf of the organisation</td><td style="border: 1px solid black;">'.$h_first_name.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">4.</td>
  <td style="border: 1px solid black;">Name of the person authorising the signatory to file the complaint(in block letters)</td><td style="border: 1px solid black;"></td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Title<br>                 
  </td><td style="border: 1px solid black;">'.$pstitile_desc.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Sur Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_sur_name.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Mid Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_mid_name.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">First Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_first_name.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;" align="center">5.</td>
  <td style="border: 1px solid black;">Gender</td><td style="border: 1px solid black;">'.$org_gen_desc.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;" align="center">6.</td>
  <td style="border: 1px solid black;">Age</td><td style="border: 1px solid black;">'.$a_age_years.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;" align="center">7.</td>
  <td style="border: 1px solid black;">Nationality</td><td style="border: 1px solid black;">'.$org_countryname.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">8.</td>
  <td style="border: 1px solid black;">Details of identity/residence proof of the person authorising the signatory enclosed with the complaint</td><td style="border: 1px solid black;"></td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Document attached<br>                 
  </td><td style="border: 1px solid black;">'.$org_identity.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(a)Number<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(b)Date of Issue<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_doi.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(c)Validity upto<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_vupto.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(d)Issuing Authority<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_iauth.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">9.</td>
  <td style="border: 1px solid black;">Permanent Address of person authorising the signatory</td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$ap_hpnl.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$org_wdist.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$org_wstatename.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$org_wcountry.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Pincode/Postal code or Zonal Code<br>                 
  </td><td style="border: 1px solid black;">'.$ap_pin_code.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">10.</td>
  <td style="border: 1px solid black;">Address for correspondence</td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$ac_hpnl.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$org_co_dist_name.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$org_per_state_name.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$org_co_countryname.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Pincode/Postal code or Zonal Code<br>                 
  </td><td style="border: 1px solid black;">'.$ac_pin_code.'</td>
  </tr>
  
  <tr>
  <td style="border: 1px solid black;" align="center">11.</td>
  <td style="border: 1px solid black;">Occupation/designation/avocation:</td><td style="border: 1px solid black;">
  '.$aoccu_desig_avo.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">12(a).</td>
  <td style="border: 1px solid black;">Telephone Number(with STD codes)</td><td style="border: 1px solid black;">
  '.$atel_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">12(b).</td>
  <td style="border: 1px solid black;">Mobile Number</td><td style="border: 1px solid black;">
  '.$amob_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">13.</td>
  <td style="border: 1px solid black;">Email id</td><td style="border: 1px solid black;">
  '.$email_id.'</td>
  </tr>
  
  <tr>
  <td style="border: 1px solid black;" align="center">14.</td>
  <td style="border: 1px solid black;">Whether an authorisation document has been enclosed ?</td><td style="border: 1px solid black;">
  '.$auth_doc_encl.'</td>
  </tr>';



  $getallwidget .='
  
  <tr>
  <td style="border: 1px solid black;" align="center">15.</td>
  <td style="border: 1px solid black;">Details of third party, if any, likely to be
affected by the complaint <br>

  </td><td style="border: 1px solid black;">'.$addpartyCount_b.'</td>
  </tr>
  ';

  $getallwidget .=  $additionalpartyList;

}




$getallwidget .= '

</table>
<div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <br><br><br><br><br><br>

<div align="center"><b>PART C</b></div>

<div>DETAILS AS REGARDS THE PUBLIC SERVANT AGAINST WHOME THE COMPLAINT IS BEING MADE
</div><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">

<tr>
<td style="border: 1px solid black;" align="center">1.</td>
<td style="border: 1px solid black;">Name the public servent(s) against whome complaint is being made (in block letters)*:
</td><td style="border: 1px solid black;">'.$partcname.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Present designation/status of the public servant(s) against whome complaint is being made
</td><td style="border: 1px solid black;">'.$present_ps_desig.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Whether the complaint is against any officer or employee or agency (including the Delhi special police establishment), under or associated with the lokpal ?
</td><td style="border: 1px solid black;">'.$pssdsp.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">4.</td>
<td style="border: 1px solid black;">With respect to serial no. 2 above,indicate</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Designation of the officer/employee</td><td style="border: 1px solid black;">'.$psdesig.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Organisation/Agency having administrative control over the said officer/employee</td><td style="border: 1px solid black;">'.$psorgn.'</td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">5(a).</td>
<td style="border: 1px solid black;">Category of the public servant against whome the complaint <br> is being made</td><td style="border: 1px solid black;">
'.$ccapacity.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Sub Category</td><td style="border: 1px solid black;">
'.$subcat_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">5(b).</td>
<td style="border: 1px solid black;">In case the complaint is against any other category of public servant, specify
</td><td style="border: 1px solid black;">'.$psothcate.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;">In case the complaint is against any Chairperson/Member <br>
Officer/Employee of a Trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">(a)</td>
<td style="border: 1px solid black;">Whether the organisation is wholly or partly financed by the <br>the Government.
</td><td style="border: 1px solid black;">'.$psfingoi.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(b)</td>
<td style="border: 1px solid black;">Whether the annual income of the organisation exceeds one crore rupees as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$psonecr.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(c)</td>
<td style="border: 1px solid black;">Whether the organisation is in receipt of any donation from any <br> foreign source under the Foreign Contribution(Regulation) Act,2010
<br>in access of ten lakh rupees in a year ?<br>
</td><td style="border: 1px solid black;">'.$psdonafs.'</td>
</tr>                  
<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;">Please state, if aware, as to whether the public servant is presently serving the affairs of the State or in any body or Board or corporation or authority,etc. established by an Act of the State Legislature or wholly or partly financed by the State Government or controlled by it ?.
</td><td style="border: 1px solid black;">'.$ps_psssbbca.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;">Post held by the public servant at the time of commission of alleged offence under the Prevention of Corruption Act, 1988.
</td><td style="border: 1px solid black;">'.$postheld.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;">Details of the Cause of Action/Offence <br>(under the Prevention of Corruption Act,1988).
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(i)Period During which alleged misconduct was committed
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">From
</td><td style="border: 1px solid black;">'.$periodf_coa .'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">To
</td><td style="border: 1px solid black;">'.$periodt_coa.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(ii) Place of Occurrence:
</td><td style="border: 1px solid black;">'.$ps_pl_occ.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iii) District:
</td><td style="border: 1px solid black;">'.$c_districtname.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iv) State:
</td><td style="border: 1px solid black;">'.$c_statename.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">10.</td>
<td style="border: 1px solid black;">Summary of facts/allegations of corruption:
</td><td style="border: 1px solid black;">Facts and Circumstances: '.$sum_facalle.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Details of the offence alleged  under the Prevention of corruption Act <br>(Briefly indicate the facts and
consequential allegations against the
public servant which constitute
offence(s) under the Prevention of
Corruption Act, 1988) <br>

</td><td style="border: 1px solid black;">'.$det_offen.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Allegations: <br> if possible, indicate the statutory provision alleged to have
been violated by a particular act of commission or omission

</td><td style="border: 1px solid black;">'.$prov_viola.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">11.</td>
<td style="border: 1px solid black;">Name of Witness in support of the allegations,if any: <br>

</td><td style="border: 1px solid black;"></td>
</tr>

';                  

$getallwidget .='

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(a) Number of witnesses: <br>

</td><td style="border: 1px solid black;">'.$witnesscount.'</td>
</tr>';

$getallwidget .=  $witnessesList;

$getallwidget .='           

<tr>
<td style="border: 1px solid black;" align="center">12.</td>
<td style="border: 1px solid black;">Paticulars/List  of the documents relied upon by the <br>Complainant in support of the
allegation:
</td><td style="border: 1px solid black;">'.$relied_doc_list.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">13.</td>
<td style="border: 1px solid black;">Any other information, the complainant desires to furnish/disclose <bt>which may be
relevant  to inquiry/investigation into the allegation of corruption.
</td><td style="border: 1px solid black;">'.$any_othInfo.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">14.</td>
<td style="border: 1px solid black;">Whether copies of the documents and other material evidence <br>(including 
electronic evidence,if any) relied upon by the complainant and referred to in the complaint have been submitted ?

</td><td style="border: 1px solid black;">'.$doc_copy_attached.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">15.</td>
<td style="border: 1px solid black;">If the complaint is being filed electronically whether pdf formats of the documents and other matrial relied upon has been attached to the electronic format of the complaint
</td><td style="border: 1px solid black;">'.$electronic_file.'</td>
</tr>

</table>
<br><br><br>

<div><b>Additional Public Servant if any-</b>
</div><br><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $publicservantdetail_list;

$getallwidget .='
</table> 


<br><br><br>

<div><b>Third Party List of Part C (Respondent) if any-</b>
</div><br><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $additionalpartyList_PartC;

$getallwidget .='
</table> 

<br><br>
<div align="right"><b>                                              Signature of the complaint/<br>
authorised person </div></b> 

<br><br>




<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">            

<tr>
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Place </td><td style="border: 1px solid black;">'.$myArray[0]->comp_f_place.'</td>
</tr>
<tr>
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Date </td><td style="border: 1px solid black;">'.$dt_of_filing.'</td>
</tr>

</table> 




<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>
  <div>     </div><br>

'; 





$getallwidget .= '<div><div align="center"><b>AFFIDAVIT DETAIL : (PART - D)</b>
</div><br>
<br><br>

I  <b>'.$myArray[0]->first_name.' '.$myArray[0]->mid_name.' '.$myArray[0]->sur_name.' </b>  aged <b>'. $myArray[0]->age_years.' </b>  years, s/o <b>'. $myArray[0]->fath_name.'</b> .r/o.<b> '.$myArray[0]->comp_f_place.'</b> do hearby solemnly affirm and declare on oath as under-
<br></br><br>';

if($cp==1){
  $getallwidget .='

  1.That I am filing this complaint on my own behalf <br><br>

  ';}

  if($cp >1){

    $getallwidget .='

    1.That I am filing this complaint on my own behalf of Body / Board / Carporation /Authority /Company /Society /Association /of persons /Non Govermental Organization/Limited Liability Partnership (give its name and registration number, if any) having their office at (give contact address/email/phone/fax of the organization) and that i am authorized to sign and make this complaint vide its resolution date '.$chkdate.'
    <br></br><br>';}

    $getallwidget .='



    2. That I have filed the present complaint under the provisions of the Lokpal and Lokayuktas Act,2013 and the rules made thereunder.
    <br></br><br></br>
    3. That I have gone through the provisions of the Lokpal and Lokayuktas Act, 2013 and do hereby affirm that the present complaint is in conformity therewith and I am fully aware that under the provisions of sections 46 and 47 of the Act making any false and frivolous or vexatious complaint is Punishable with imprisonment for a term which may extend to one year and with fine which may extend to one lakh rupees.
    <br></br><br></br>
    4. That neither I nor any other person in the organisation / institution /body that I represent in this complaint has filed any complaint in this matter before any Court or Committee of either House of Parliament or befor any other Authority and this
    complaint does not attract the provisions of section 15 of the Act.
    <br></br><br></br>
    5.    I state that before filing this complaint I have collected and presented the information and supporting evidence to the best of my knowledge, ability and capacity which are relevant in support of the allegations of corruption against the concerned public servant and I further confirm that I have not concealed any data /material / information in this complaint.

    <br></br><br></br>
     
    Solemnly affirmed at …………………this…………….day of………….20……….
  <br></br><br></br>
    <div align="right"><b> DEPONENT </b></div>
    <br></br><br>
    <div align="center"><b> Verification  </b></div>

    <br></br><br>

    I <b>'.$myArray[0]->first_name.' '.$myArray[0]->mid_name.' '.$myArray[0]->sur_name.' </b>    the above named deponent do hereby verify that the contents of the aforesaid paragraphs 1 to 5 are true and correct to the best of my knowledge and belief and nothing is concealed therefrom.
    <br></br><br></br>
    Verified at <b> '.$myArray[0]->comp_f_place.' </b> this…………….day of …………………20……………   
    </div>
      <br></br><br>
      <div align="right"><b> DEPONENT </b></div>



    </div>     
    ';

                      // echo $getallwidget;die;
    ini_set('set_time_limit', 0);
    ini_set('memory_limit', '-1');
    ini_set('xdebug.max_nesting_level', 2000);
    $this->html2pdf->folder('./cdn/complainpdf/');
    $this->html2pdf->paper('A4', 'portrait', 'fr');
    if($filename){
      $filename = $filename;
    }else{
    $filename = $refe_no;
    }
     // $this->data['main_content']           =     'view_widget_report_pdf';
    $html = $getallwidget;

    $this->html2pdf->filename($filename.".pdf"); 
    $this->html2pdf->html($html);
    if($save_in_server == '1'){
      $this->html2pdf->create('save');
    }
    //$this->html2pdf->create('save');
    $this->html2pdf->create('open');
     // $ref_no=$this->session->userdata('ref_no');
    //$this->session->unset_userdata('ref_no');        
    //$this->session->sess_destroy(); 
    //return 1; 
    return $filename;   
  }


  private function generate_filingno(){
    $year = date("Y");
    $counter = $this->filing_model->get_filing_counter($year);
    $counter = $counter->filing_counter;
    if($counter == 0)
    {
      $segment1 ='00001';
      $chk_cou = 1;
    }
    elseif($counter > 0)
    {
      $counter_now = (int)$counter+1;
      $len = strlen($counter_now);
      $length =5-$len;
      for($i=0;$i<$length;$i++)
      {
        $counter_now = "0".$counter_now;
      }
      $segment1 = $counter_now;

      $chk_cou = $this->varify_counter($counter, $year);
    }else{
      die('Counter not set contact admin');
    }
    $array = array('comp_no' => $segment1.$year, 'year' => $year, 'counter' => $segment1, 'chk_cou' => $chk_cou);
    return $array;
  }

  private function varify_counter($counter, $year){
    $len = strlen($counter);
    $length =5-$len;
    for($i=0;$i<$length;$i++)
    {
      $counter = "0".$counter;
    }
    $segment2 = $counter;
    $init_compno = $segment2.$year;
    $exist_compno = $this->filing_model->get_max_compno($year);
      //print_r($exist_compno['max']);die('l');
    //print_r($init_compno);die;
    if($init_compno == $exist_compno['max']){
      return true;
    }else{
      return false;
    }
  }

  private function get_ip()
  {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      return $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      return $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      return $ip=$_SERVER['REMOTE_ADDR'];
    }
  }
}