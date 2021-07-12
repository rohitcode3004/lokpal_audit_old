<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casefilingreport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('filing_model');
    $this->load->model('report_model');
		$this->load->model('common_model');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->library('label');
		$this->load->library('html2pdf');

	}
	
	public function index(){	

$array=$this->session->userdata('ref_no');

$data['parta']= $this->report_model->getParta();


   // echo "in here of list of report";die;

/*
   $array=$this->session->userdata('ref_no');
$refe_no=$array['ref_no'];
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

$data['farma'] = $this->common_model->getFormadata($refe_no);
		//echo "<pre>";
		//print_r($data);die;
		$this->load->view('filing/affidavit.php',$data)

    */

      $this->load->view('filing/index.php',$data);
	
	}




	 public function getReport(){

 $this->load->view('filing/allreport.php');

   }
	
  public function toPdfReport(){ 

  	echo "in here pdf";die;

$array=$this->session->userdata('ref_no');
$refe_no=$array['ref_no'];
$chkdate= date("l jS \of F Y");

 $cp=$array['complaint_capacity_id'];
 $cm=$array['complaintMode_id'];
 $st=$array['salutation_id'];
 $gn=$array['gender_id'];
 $na=$array['p_country_id'];
  $cn=$array['c_country_id'];
$ide=$array['identity_proof_id'];
$rde=$array['idres_proof_id'];
$pstate=$array['p_state_id'];
$cstate=$array['c_state_id'];
$pdistrict=$array['p_dist_id'];
$cdistrict=$array['c_district_id'];
$pc=$array['p_country_id'];

 $complaint_capacity = $this->report_model->getComplaincapicity($cp);
$complaint_desc= $complaint_capacity['complaint_capacity_desc'];
$complaint_mode = $this->report_model->getComplaintMode($cm);
$complaint_mode_desc=$complaint_mode['complaintMode_desc'];
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


/*part c start */
 $datac = $this->report_model->getPartc($refe_no);
 $psid=$datac['ps_salutation_id'];
$pssalution = $this->report_model->getSalutation($psid);
 $pstitile_desc=$pssalution['salutation_desc'];
$pssurname=$datac['ps_sur_name'];
 $psmidname=$datac['ps_mid_name'];
$psfirstname=$datac['ps_first_name'];
 $pssdsp=$datac['ps_dsp_lp'];
$psdesig=$datac['ps_desig'];
$psorgn=$datac['ps_orgn'];
$psfingoi=$datac['tas_fingoi'];
$psonecr=$datac['anninc_onecr'];
$psdonafs=$datac['dona_fs'];
$ps_psssbbca=$datac['pss_sbbca'];
$psectorid =$datac['complaint_capacity_id'];
$pssalution = $this->report_model->getPublicsector($psectorid);
$ccapacity=$pssalution['complaint_capacity_desc'];
 $subcat =$datac['ps_id'];
$pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
$subcat_desc=$pssubcat['ps_desc'];
$psothcate=$datac['ps_othcate'];
    $cstateid =$datac['ps_pl_stateid'];
    $cstate = $this->report_model->getPstate($cstateid);
    $c_statename=$cstate['name'];
    $cdistid =$datac['ps_pl_dist_id'];
    $cdist = $this->report_model->getPdistrict($cstateid,$cdistid);
    $c_districtname=$cdist['name'];
  $periodf_coa=$datac['periodf_coa'];
  $periodt_coa=$datac['periodt_coa'];
  $ps_pl_occ=$datac['ps_pl_occ'];
  $sum_facalle=$datac['sum_facalle'];
  $det_offen=$datac['det_offen'];
  $prov_viola=$datac['prov_viola'];
  $any_othInfo=$datac['any_othInfo'];
  $doc_copy_attached=$datac['doc_copy_attached'];
  $electronic_file=$datac['electronic_file'];
/*end partc part*/

/*  start part witness detail  */

 $datawitness = $this->report_model->getPartc_Witness($refe_no);
$wsid=$datawitness['w_salutation_id'];
$wsalution = $this->report_model->getSalutation($wsid);
 $wtitile_desc=$wsalution['salutation_desc'];
 $w_sur_name=$datawitness['w_sur_name'];
 $w_mid_name=$datawitness['w_mid_name'];
 $w_first_name=$datawitness['w_first_name'];
 $w_gid =$datawitness['w_gender_id'];
  $w_age =$datawitness['w_age_years'];
   $w_add1 =$datawitness['w_add1'];
    $w_hpnl =$datawitness['w_hpnl'];
     $w_vill_city =$datawitness['w_vill_city'];
     $wstateid =$datawitness['w_state_id'];
    $wstate = $this->report_model->getPstate($wstateid);
    $wstatename=$wstate['name'];
    $wdistid =$datawitness['w_dist_id'];
    $wdist = $this->report_model->getPdistrict($wstateid,$wdistid);
    $wdistrictname=$wdist['name'];
    $w_vill_city =$datawitness['w_vill_city'];

     $w_pin =$datawitness['w_pin_code'];
     $w_tel =$datawitness['w_tel_no'];
     $w_mob =$datawitness['w_mob_no'];
      $w_email =$datawitness['w_email_id'];
       $wc_id =$datawitness['w_country_id'];
    $wcountry = $this->report_model->getNationality($wc_id);
    $wcountryname=$wcountry['nationality_desc'];

  

$wgender = $this->report_model->getGender($w_gid);
 $wgen_desc=$wgender['gender_desc'];

   // echo "in loop";die;
    ini_set('set_time_limit', 0);
    ini_set('memory_limit', '-1');
    ini_set('xdebug.max_nesting_level', 2000);
    $this->html2pdf->folder('./assets/');
    $this->html2pdf->paper('A4', 'portrait', 'fr');
$elements = $this->label->view(1);
$elements['17']['long_name'];



      $getallwidget =     
      				'<div align="center"><b>Report detail</b></div>
              <br><br>
      				<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
          
              <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Complaint is Being Made by    :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Complainant Filing Mode       :</b></th>
                  </tr> 
                  <tr style="border: 1px solid black; ">   
                  <td style="border: 1px solid black; " align="center">'.$complaint_desc.'</td>
                  <td style="border: 1px solid black; " align="center">'.$complaint_mode_desc.'</td> 
                  </tr> 					
      				 </table>					
      					<br><br>
               <div align=center><b>Complainant Detail</b>
               <br> 
               <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Salutation:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Sur Name :</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Mid Name :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>First Name:</b></th>
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$salutation_desc.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['sur_name'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['mid_name'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['first_name'].'</td>
                  </tr>
                   <tr style="border: 1px solid black;">
                  <th style="border-left: 1px solid; width: 20%;"><b>Gender    :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Age       :</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Father Name    :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>nationality      :</b></th>
                  </tr>
                  <tr style="border: 1px solid black; ">
                  <td style="border: 1px solid black; " align="center">'.$gender_desc.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['age_years'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['fath_name'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$national_desc.'</td>
                  </tr>
                    </table>
                   <br><br>
                   <div align=center><b>Identity of the Complainant..</b></div>
                   <br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Identity Document:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Number:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Date of Issue:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Validity Upto Date:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Issuing Authority:</b></th>
                 
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$ide_desc.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['identity_proof_no'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['identity_proof_doi'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['identity_proof_vupto'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$array['identity_proof_iauth'].'</td>
                 
                  </tr>
                  </table>

                   <br><br>
                   <div align=center><b>Address Proof of Permanent Address of the Complainant</b></div><br>
                   <br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Type of Address Proof of Document:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Document Number:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Date of Issue:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Validity Date:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Issuing Authority:</b></th>
                 
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$rde_desc.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['idres_proof_no'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['idres_proof_doi'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['idres_proof_vupto'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$array['idres_proof_iauth'].'</td>
                 
                  </tr>
                  </table>

                   <br><br>
                   <div align=center><b>Permanent Address of the Complainant-</b></div>
                   <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Address Line 1:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Address Line 2:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>State:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Village/City/District:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>PinCode/ZonalCode:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Country:</b></th>
                 
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$array['p_add1'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['p_hpnl'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$pstatename.'</td>
                   <td style="border: 1px solid black; " align="center">'.$pdistrictname.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['p_pin_Code'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$pnational_desc.'</td>
                 
                  </tr>
                  </table>
                   <br><br><br>
                   <div align=center><b>Correspondence Address of the Complainant-</b></div>
                   <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Address Line 1:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Address Line 2:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>State:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Village/City/District:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>PinCode/ZonalCode:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Country:</b></th>
                 
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$array['c_add1'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['c_hpnl'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$cstatename.'</td>
                   <td style="border: 1px solid black; " align="center">'.$cdistrictname.'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['c_pin_code'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$cnational_desc.'</td>
                 
                  </tr>
                  </table>
                  <br><br>
                   <div align=center><b>Other Details-</b></div>
                   <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Occu/Desi/Avo:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Telephone No:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Mobile No:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Email ID:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Duly Notarized affidavit as enclosed:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Whether the complainant is the victim:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Place:</b></th>
                 
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$array['occu_desig_avo'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['tel_no'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['mob_no'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$array['email_id'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$array['notory_affi_annex'].'</td>
                  <td style="border: 1px solid black; " align="center">'.$array['complainant_victim'].'</td>
                   <td style="border: 1px solid black; " align="center">'.$array['comp_f_place'].'</td>
                 
                  </tr>
                  </table>
                  <br><br><br><br><br><br><br>
                   <div align=center><b>FORM OF COMPLAINT : (PART - C)</b></div>
                   <br><br>
                    <div><b>Details as regards the public servant against whom the complaint is being made-</b></div>
                    <br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Title:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Surname:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Middle Name:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>First Name:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Is officer or employee or agency (DP), under or associated with the Lokpal?:</b></th>
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$pstitile_desc.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$pssurname.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$psmidname.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$psfirstname.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$pssdsp.'</td>
                          
                 
                  </tr>
                  </table>
                  <br>
                  <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Present designation/status of the public servant(s) against whom complaint is made:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Org/Agency having administrative control over the said officer/employee:</b></th>         
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$psdesig.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$psorgn.'</td>                                           
                 
                  </tr>
                  </table>
                  <br>
                   <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Category of the public servant against whom the complaint is being made:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Public Sector:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>If the complaint is made against any other category of PS, specify:</b></th>         
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$ccapacity.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$subcat_desc.'</td> 
                    <td style="border: 1px solid black; " align="center" >'.$psothcate.'</td>                                           
                 
                  </tr>
                  </table>
                    <br><br>
                   <div><b>In case the complaint is against any Chairperson/Member/ Officer/Employee of a Trust or an Association of Persons or Society, indicate-</b></div>
                   <br>
                     <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Whether the organisation is wholly or partly financed by the Government:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Whether the annual income of the organisation exceeds one crore rupees:</b></th>         
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$psfingoi.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$psonecr.'</td>                                           
                 
                  </tr>
                  </table>

                   <br>
                     <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Whether the Org is in receipt of any donation from any foreign source:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Whether the public servant is presently serving the affairs of the State or in any body or Board or corporation or authority, etc:</b></th>         
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$psdonafs.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$ps_psssbbca.'</td>                                           
                 
                  </tr>
                  </table>

                  <br><br>
                    <div align="center"><b>Period during which alleged misconduct was committed.</b></div>
                    <br></br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>From date:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>To Date:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Place of Occurrence:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>State:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Village/City/District</b></th>
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$periodf_coa.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$periodt_coa.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$ps_pl_occ.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$c_statename.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$c_districtname.'</td>
                          
                 
                  </tr>
                  </table>            
                  <br><br>
                    <div align="center"><b>Summary of facts/allegations of corruption-.</b></div>
                    <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Summary of Facts:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Detail of Offence:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Statutory provision alleged to have been violated by:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Any Other Info:</b></th>
                  

                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$sum_facalle.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$det_offen.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$prov_viola.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$any_othInfo.'</td>
                    
                          
                 
                  </tr>
                  </table>
                  
                   <br>
                     <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Document Copy Attached?:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>whether pdf formats of the documents and other material relied upon has been attached:</b></th>         
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$doc_copy_attached.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$electronic_file.'</td>                                           
                 
                  </tr>
                  </table>

                  <br><br>
                    <div align="center"><b>Witness Detail.</b></div>
                    <br></br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Title:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Surname:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Middle Name:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>First Name:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Gender</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Age (in Year)</b></th>
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$wtitile_desc.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_sur_name.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_mid_name.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_first_name.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$wgen_desc.'</td>
                     <td style="border: 1px solid black; " align="center" >'.$w_age.'</td>
                         
                 
                  </tr>
                  </table>   


                    <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>Address Line 1 :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>House/Property/Number/Locality :</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>State:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Village/City/District:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Taluka Name</b></th>
                 
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$w_add1.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_hpnl.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$wstatename.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$wdistrictname.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_vill_city.'</td>
                    
                         
                 
                  </tr>
                  </table>  


                    <br><br>
                    <table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
               <tr style="border: 1px solid black; ">
                  <th style="border-left: 1px solid; width: 20%;"><b>PinCode/ZonalCode:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Country:</b></th>
                   <th style="border-left: 1px solid; width: 20%;"><b>Phone with STD :</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Mobile No:</b></th>
                  <th style="border-left: 1px solid; width: 20%;"><b>Email ID</b></th>
                 
                                  
                  </tr> 
                  <tr style="border: 1px solid black; ">
                   <td style="border: 1px solid black; " align="center" >'.$w_pin.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$wcountryname.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_tel.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_mob.'</td>
                    <td style="border: 1px solid black; " align="center" >'.$w_email.'</td>    
                         
                 
                  </tr>
                  </table>   

 



                  
                  ';

                       //echo $getallwidget;die;
    
    $file                           =    $array['ref_no'];
    $filename                       =     $file;
     // $this->data['main_content']           =     'view_widget_report_pdf';
      $html                       =     $getallwidget;
      $this->html2pdf->filename($filename.".pdf");
      $this->html2pdf->html($html);
      $this->html2pdf->create('open');
        exit;
//$data['state'] = $this->common_model->getStateName();

  	
  }
  

  
  
	
}
?>
 
			
			

	
