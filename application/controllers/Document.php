<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Document extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('filing_model');
		$this->load->model('common_model');
    $this->load->model('report_model');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('image_lib');
  //  $this->load->library('pdf');
    $this->load->library('html2pdf');
    $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    $this->load->library('Menus_lib');
    $this->load->model('login_model');
    $this->load->helper("compno_helper"); 
    $this->load->helper("parts_status_helper");
    $this->load->library('File_upload');
    $this->load->helper('file');

  }
  public function testafidavit() 
  { 
    if($this->isUserLoggedIn) 
    {
      $con = array( 
        'id' => $this->session->userdata('userId') 
      ); 
      $data['user'] = $this->login_model->getRows($con);
      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']); 
      
      $ref_no=$this->session->userdata('ref_no');

      if(isset($ref_no))
      {
        $data['farma'] = $this->common_model->getFormadata($ref_no);
      }
      $data['form_part'] = 'Af'; 
      $this->load->view('templates/front/CE_Header.php',$data);
      $this->load->view('filing/affidavit_form', $data);
      $this->load->view('templates/front/CE_Footer.php',$data);
      
    }
    else{
      redirect('user/login'); 
    }
  }

  public function toPdf() 
  { 
   // ob_clean();
   // ob_flush(); 
    $ref_no=$this->session->userdata('ref_no');
    $farmadata = $this->common_model->getFormadata($ref_no);
    $myArray=(array)$farmadata;
    $myArray[0]->first_name;
    $myArray[0]->age_years;
    $myArray[0]->fath_name;
    $myArray[0]->comp_f_place;
    $myArray[0]->comp_f_date;
     $cp=$myArray[0]->complaint_capacity_id ?? '';
    
    $chkdate= date("l jS \of F Y");

    ini_set('set_time_limit', 0);
    ini_set('memory_limit', '-1');
    ini_set('xdebug.max_nesting_level', 2000);
    $this->html2pdf->folder('./assets/');
    $this->html2pdf->paper('A4', 'portrait', 'fr');
    
    $getallwidget =     '<div><div align="center"><b>AFFIDAVIT DETAIL : (PART - D)</b>
    </div><br>

    <br></br><br></br>

    I  <b>'.$myArray[0]->first_name.' '.$myArray[0]->mid_name.' '.$myArray[0]->sur_name.' </b>  aged <b>'. $myArray[0]->age_years.' </b>  years, s/o <b>'. $myArray[0]->fath_name.'</b> .r/o.<b> '.$myArray[0]->comp_f_place.'</b> do hearby solemnly affirm and declare on oath as under-
    <br></br><br></br>';

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

                       //echo $getallwidget;die;
    
    $file                           =    $ref_no;
    $filename                       =     $file;
     // $this->data['main_content']           =     'view_widget_report_pdf';
    $html                       =     $getallwidget;
    $this->html2pdf->filename($filename.".pdf");
    $this->html2pdf->html($html);
    $this->html2pdf->create('open');
    exit;
    
  }

public function validate_image($t,$parameter) {
    
      return $this->file_upload->validate_image($t,$parameter);
    }
  

public function affidavitupload()
{

  if($this->isUserLoggedIn) 
 {
  $con = array( 
    'id' => $this->session->userdata('userId') 
  ); 
      $data['user'] = $this->login_model->getRows($con);
      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
      $user_id = $data['user']['id'];
      $ref_no=$this->session->userdata('ref_no');  
      $tsnew=date('Y-m-d');               
      $new_name = time().'_'.$ref_no.'_'.$tsnew;
      $filename=$_FILES['affidavit_upload']['name'];
      $ext = substr($filename, -4, strrpos($filename, '.'));
      $filename = substr($filename, 0, strrpos($filename, '.'));
      $filename = str_replace(' ','',$filename);  
      $filename = str_replace('.','',$filename);

    if(!empty($_FILES['affidavit_upload']['name']))
      {     
        // $config['encrypt_name'] = TRUE;  
        $config['upload_path']   = './cdn/affidavit/'; 
        $config['allowed_types'] = 'gif|jpg|pdf';      
       // $config['max_size']      = 15000;
         $config['file_name'] = $new_name.$filename;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('affidavit_upload'))
        {
          $error = array('error' => $this->upload->display_errors()); 
          
        }else
        { 
          $uploadedImage = $this->upload->data();      
        } 
         $affidavit_upload='cdn/affidavit/'.$new_name.$filename.$ext;
      }      
      else
      {
        $affidavit_upload='';
      } 
    $affidavit_upload =$affidavit_upload;

    if(!empty($_FILES['affidavit_upload']['name']))
        {   
          //echo "here";die;
          $parameters = $_FILES['affidavit_upload']['name']."||".$_FILES['affidavit_upload']['size']."||".$_FILES['affidavit_upload']['tmp_name'];      
          $this->form_validation->set_rules('affidavit_upload', '', 'callback_validate_image['.$parameters.']');
        }

        if ($this->form_validation->run() == FALSE)
       {
                if($this->isUserLoggedIn) 
              { 
                        $con = array( 
                          'id' => $this->session->userdata('userId') 
                        );                      
                      $this->load->library('label');
                      $this->load->helper("date_helper");
                      $ref_no=$this->session->userdata('ref_no');   
                          if(isset($ref_no))
                          {
                          $data['farma'] = $this->common_model->getFormadata($ref_no);
                          }
                          $data['form_part'] = 'Af';                          
                      $this->load->view('filing/affidavit_form', $data);
              }
                  else
                  {
                    redirect('admin/login'); 
                  }
          }
          else
          {


          //  echo "here";die;
                $affidavit_data = array(
                'affidavit_upload' =>$affidavit_upload,
                );
                $affi_update = $this->report_model->update_complaint_affidavit($ref_no,$affidavit_data);
                if($affi_update){ 
                   $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Affidavit successfully uploaded.</h4></div>'); 

                //$this->session->set_flashdata('success_msg', 'Affidavit successfully uploaded.'); 
                 $data['form_part'] = 'Af';
                // $this->load->view('templates/front/header2.php',$data);
              //  $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
                redirect('/document/testafidavit',$data);
                }
               
          }

  }     
  else
  {    
     redirect('admin/login'); 
  }


}


 public function phisical() 
  { 
    

   
    if($this->isUserLoggedIn) 
    {
      $con = array( 
        'id' => $this->session->userdata('userId') 
      ); 
      $data['user'] = $this->login_model->getRows($con);
      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']); 
      
      $ref_no=$this->session->userdata('ref_no');

      if(isset($ref_no))
      {
        $data['farma'] = $this->common_model->getFormadata($ref_no);
      }
       $data['form_part'] = 'PH';
      
      $this->load->view('templates/front/CE_Header.php',$data);
      $this->load->view('filing/phisical_file', $data);
      $this->load->view('templates/front/CE_Footer.php',$data);
      
    }
    else{
      redirect('user/login'); 
    }

  }


public function phisical_copy_upload()
{

  if($this->isUserLoggedIn) 
 {
  $con = array( 
    'id' => $this->session->userdata('userId') 
  ); 
      $data['user'] = $this->login_model->getRows($con);
      $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
      $user_id = $data['user']['id'];
      $ref_no=$this->session->userdata('ref_no');  
      $tsnew=date('Y-m-d');               
      $new_name = time().'_'.$ref_no.'_'.$tsnew;
      $filename=$_FILES['phisicalcopy_upload']['name'];
      $ext = substr($filename, -4, strrpos($filename, '.'));
      $filename = substr($filename, 0, strrpos($filename, '.'));
      $filename = str_replace(' ','',$filename);  
      $filename = str_replace('.','',$filename);

    if(!empty($_FILES['phisicalcopy_upload']['name']))
      {     
        // $config['encrypt_name'] = TRUE;  
        $config['upload_path']   = './cdn/physical_complaint_copy/'; 
        $config['allowed_types'] = 'gif|jpg|pdf';      
       // $config['max_size']      = 15000;
         $config['file_name'] = $new_name.$filename;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('phisicalcopy_upload'))
        {
          $error = array('error' => $this->upload->display_errors()); 
          
        }else
        { 
          $uploadedImage = $this->upload->data();      
        } 
         $physical_complaint_copy_url='cdn/physical_complaint_copy/'.$new_name.$filename.$ext;
      }      
      else
      {
        $physical_complaint_copy_url='';
      } 
    $physical_complaint_copy_url =$physical_complaint_copy_url;

    if(!empty($_FILES['phisicalcopy_upload']['name']))
        {   
          //echo "here";die;
          $parameters = $_FILES['phisicalcopy_upload']['name']."||".$_FILES['phisicalcopy_upload']['size']."||".$_FILES['phisicalcopy_upload']['tmp_name'];      
          $this->form_validation->set_rules('phisical_copy_upload', '', 'callback_validate_image['.$parameters.']');
        }

        if ($this->form_validation->run() == FALSE)
       {
                if($this->isUserLoggedIn) 
              { 
                        $con = array( 
                          'id' => $this->session->userdata('userId') 
                        );                      
                      $this->load->library('label');
                      $this->load->helper("date_helper");
                      $ref_no=$this->session->userdata('ref_no');   
                          if(isset($ref_no))
                          {
                          $data['farma'] = $this->common_model->getFormadata($ref_no);
                          }
                         // $data['form_part'] = 'Af';                          
                      $this->load->view('document/phisical', $data);
              }
                  else
                  {
                    redirect('admin/login'); 
                  }
          }
          else
          {


           // echo $physical_complaint_copy_url;die;

                $phisical_copy_upload_data = array(
                'physical_complaint_copy_url' =>$physical_complaint_copy_url,
                );
                $phisical_copy_update = $this->report_model->update_phisical_copy_complaint($ref_no,$phisical_copy_upload_data);
                if($phisical_copy_update){ 
                $this->session->set_flashdata('success_msg', '<div class="alert alert-success"><h4 class="m-0">Physical Complaint Copy Uploaded successfully.</h4></div>'); 
                 //$data['form_part'] = 'Af';
                // $this->load->view('templates/front/header2.php',$data);
              //  $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
                redirect('/document/phisical',$data);
                }
               
          }

  }     
  else
  {    
     redirect('admin/login'); 
  }


}


  public function index()
  {
    $this->load->view('welcome_message');
  }  
}
?>