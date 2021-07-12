<?php //include(APPPATH.'views/templates/front/header2.php');
$this->load->helper("date_helper"); 
 ?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>



<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title"></h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php 
          $ref_no=$this->session->userdata('ref_no');
          include(APPPATH.'views/templates/front/stepwise_navigator.php');
        ?>
        <div class="panel panel-warring">
          <div class="panel-heading text-center">
            Preview Detail 
            <strong class="text-right">
              <?php if($status == 't') { ?>
                <span><b>Dairy no. </b><?php echo $filing_no; ?></span>
              <?php } ?>
            </strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  
              <!-- Image loader -->
              <div id='wait' style='display: none'>
                <img src='<?php echo base_url(); ?>assets/images/loader.gif'>
              </div>
            
  <form id="affidavitform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>affidavit/exportToPdf'  name="affidavitform" enctype="multipart/form-data">

    <h3 class="text-orange text-center mt-30 mb-30">FORM OF COMPLAINT : (PART - A)</h3>


    <h4 class="section-title text-theme">Complainant Detail -</h4>
    <table class="mytable mb-30">
      <tbody>
        <tr>
          <th>Complainant Capacity</th>
          <td>
            <?php 
              $cp=$farma[0]->complaint_capacity_id ?? '';
              $complaint_capacity = $this->report_model->getComplaincapicity($cp);
              $complaint_desc= $complaint_capacity['complaint_capacity_desc'];        
              echo $complaint_desc;
            ?>
          </td>
          <th>Complainant Mode</th>
          <td>
            <?php 
              $cm=$farma[0]->complaintmode_id ?? '';
              $complaint_mode = $this->report_model->getComplaintMode($cm);
              $complaint_mode_desc=$complaint_mode['complaintmode_desc'];
              echo $complaint_mode_desc; 
            ?>
          </td>
          <th>Salutation</th>
          <td>
            <?php   
              $wid=$farma[0]->salutation_id ?? '';        
              $wsalution = $this->report_model->getSalutation($wid);
              $w_desc=$wsalution['salutation_desc'];
              echo $w_desc;
            ?>
          </td>
        </tr>
        <tr>
          <th>Sur Name</th>
          <td><?php echo  $farma[0]->sur_name ?? ''; ?></td>
          <th>Middle Name</th>
          <td><?php echo  $farma[0]->mid_name ?? ''; ?></td>
          <th>First Name</th>
          <td><?php echo  $farma[0]->first_name ?? ''; ?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td>
            <?php 
              $scrutinyGender = $this->reports_model->getscrutinyGender($filing_no);         
              $sc_filing_no=$scrutinyGender[0]->filing_no ?? '';
              $sc_gender_desc=$scrutinyGender[0]->gender_desc ?? '';
              if (!empty($sc_gender_desc))
                { 
                  echo  $gender_desc=$sc_gender_desc;
                }
              else
                {
                  $w_gid =$farma[0]->gender_id;
                  $wgender = $this->report_model->getGender($w_gid);
                  $wgen_desc=$wgender['gender_desc'] ?? '';        
                  echo $wgen_desc;
                }
            ?>
          </td>
          <th>Age</th>
          <td><?php echo  $farma[0]->age_years ?? ''; ?></td>
          <th>Father Name</th>
          <td><?php echo  $farma[0]->fath_name ?? ''; ?></td>
        </tr>
        <tr>
          <th>Nationality</th>
          <td>
            <?php 
              $sql = "select * from nationality where nationality_id=".$farma[0]->nationality_id."";
              $query  = $this->db->query($sql)->result();
              echo $query[0]->nationality_desc; 
            ?>
          </td>
          <th></th>
          <td></td>
          <th></th>
          <td></td>
        </tr>
      </tbody>
    </table>
    <!--    gender change history                --->

    <?php if($status == 't' and $sc_gender_desc !='') { ?>
      <h4 class="section-title text-theme">Gender update history -</h4>
      <table class="table table-striped mb-30">
        <thead>
          <tr>       
            <th>Gender</th>               
        </tr>
        </thead>
      <tbody>
        <tr>         
          <td>
            <?php
              $w_gid =$farma[0]->gender_id;
              if(!empty($sc_gender_desc)){ 
              $wgender = $this->report_model->getGender($w_gid);
              $gender_desc_original=$wgender['gender_desc'] ?? '';
              echo  $gender_desc_original ?? ''; }?></td>        
            </tr>         
          </tbody>
        </table>
      <?php } ?>
      <!-------------end gender update history---------->

      <h4 class="section-title text-theme">Details of identity proof -</h4>          
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Identity Document</th>
            <th>Number</th>
            <th>Date of Issue</th>
            <th>Validity Upto Date</th>
            <th>Issuing Authority</th>
            <th>Identity Document Upload</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php         

              $wc_id =$farma[0]->identity_proof_id ?? '';
                 if($wc_id !='')
                 {
                $wcountry = $this->report_model->getIdentity($wc_id);
                $identitydesc=$wcountry['Identity_proof_desc'];
              }
              else
              {
                $identitydesc='';
              }
            ?>
            
            <td><?php echo  $identitydesc; ?></td>
            <td><?php echo  $farma[0]->identity_proof_no ?? ''; ?></td>
            <td><?php 
              $farma[0]->identity_proof_doi=get_displaydate($farma[0]->identity_proof_doi);
              echo  $farma[0]->identity_proof_doi ?? ''; ?></td>
            <td><?php echo  $farma[0]->identity_proof_vupto ?? ''; ?></td>       
            <td><?php echo  $farma[0]->identity_proof_iauth ?? ''; ?></td>
            <?php if ($farma[0]->identity_url_parta !='') { ?>
            <td> <a href="<?php echo base_url();?><?php echo $farma[0]->identity_url_parta ?? ''; ?>" target="_blank" alt="">show Uploaded identity </a></td>
          <?php } ?>
            
            
          </tr>
             
        </tbody>
      </table>

      <h4 class="section-title text-theme">Details of residence proof -</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Residence Proof ID</th>
            <th>Number</th>
            <th>Date of Issue</th>
            <th>Validity Upto Date</th>
            <th>Issuing Authority</th>
            <th>Residence Document Upload</th> 
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
              $wc_id =$farma[0]->idres_proof_id ?? '';
              if($wc_id !='')
              {
              $wcountry = $this->report_model->getResidence($wc_id);
              $identitydesc=$wcountry['idres_proof_desc'];
              }
              else
              {
              $identitydesc='';
              } 
            ?>     
            <td><?php echo  $identitydesc; ?></td>
            <td><?php echo  $farma[0]->idres_proof_no ?? ''; ?></td>
            <td><?php echo  get_displaydate($farma[0]->idres_proof_doi ?? ''); ?></td>
            <td><?php echo  $farma[0]->idres_proof_vupto ?? ''; ?></td>       
            <td><?php echo  $farma[0]->idres_proof_iauth ?? ''; ?></td>
            <?php if ($farma[0]->residence_url_parta !=''){?>
            <td><a href="<?php echo base_url();?><?php echo $farma[0]->residence_url_parta ?? ''; ?>" target="_blank" alt="">show Uploaded residence </a></td>
            <?php } ?>   
          </tr> 
        </tbody>
      </table>

      <h4 class="section-title text-theme">Permanent Address -</h4>
      <table class="table table-striped">
        <thead>
          <tr>        
            <th>House/Property Number/locality</th>
            <th>State</th>
            <th>District</th>
            <th>Pin Code</th>
            <th>Country</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>     

            
              <td><?php echo  $farma[0]->p_hpnl ?? ''; ?></td>
            <td><?php 
            $sql = "select name from master_address where state_code =".$farma[0]->p_state_id." and district_code=0 and sub_dist_code=0 and                        village_code=0 and display='TRUE' order by name asc";

           // $sql = "select * from identity_residence_proof where idres_proof_id =".$farma[0]->idres_proof_id."";
             $query  = $this->db->query($sql)->result();
           echo $query[0]->name; ?></td> 
           <td><?php 
            $sql="select name,district_code from master_address where state_code=".$farma[0]->p_state_id." and
             district_code=".$farma[0]->p_dist_id." and sub_dist_code=0 and village_code=0 and display='TRUE' order by name asc";

           // $sql = "select * from identity_residence_proof where idres_proof_id =".$farma[0]->idres_proof_id."";
             $query  = $this->db->query($sql)->result();
            echo $query[0]->name ?? ''; ?></td>
            
           <td><?php echo  $farma[0]->p_pin_code ?? ''; ?></td>
             <td><?php 
            $sql = "select * from nationality where nationality_id=".$farma[0]->p_country_id."";
             $query  = $this->db->query($sql)->result();
             echo $query[0]->nationality_desc ?? ''; ?></td>
          </tr>
             
        </tbody>

      </table>


      <h4 class="section-title text-theme">Correspondence Address -</h4>
      <table class="table table-striped">
        <thead>
          <tr>     
            <th>House/Property Number/locality</th>
            <th>State</th>
            <th>District</th>
            <th>Pin Code</th>
            <th>Country</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>     

           
              <td><?php echo  $farma[0]->c_hpnl; ?></td>
            <td><?php 
            $sql = "select name from master_address where state_code =".$farma[0]->c_state_id." and district_code=0 and sub_dist_code=0 and                        village_code=0 and display='TRUE' order by name asc";

           // $sql = "select * from identity_residence_proof where idres_proof_id =".$farma[0]->idres_proof_id."";
             $query  = $this->db->query($sql)->result();
           echo $query[0]->name; ?></td> 
           <td><?php 
            $sql="select name,district_code from master_address where state_code=".$farma[0]->c_state_id." and
             district_code=".$farma[0]->c_district_id." and sub_dist_code=0 and village_code=0 and display='TRUE' order by name asc";

           // $sql = "select * from identity_residence_proof where idres_proof_id =".$farma[0]->idres_proof_id."";
             $query  = $this->db->query($sql)->result();
            echo $query[0]->name; ?></td>
            
           <td><?php echo  $farma[0]->c_pin_code; ?></td>
             <td><?php 
            $sql = "select * from nationality where nationality_id=".$farma[0]->c_country_id."";
             $query  = $this->db->query($sql)->result();
             echo $query[0]->nationality_desc; ?></td>
          </tr>
             
        </tbody>

      </table>

      <h4 class="section-title text-theme">Other Details -</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Occupation/Designation/Avocation</th>
            <th>Telephone No</th>
            <th>Mobile No</th>
            <th>Email ID</th>
            <th>Duly Notarized affidavit</th>
            <th>complainant is the victim</th>
             <th>Place</th>
            <th>Date</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>  
            <td><?php echo  $farma[0]->occu_desig_avo; ?></td>
            <td><?php echo  $farma[0]->tel_no; ?></td>
            <td><?php echo  $farma[0]->mob_no; ?></td>
            <td><?php echo  $farma[0]->email_id; ?></td>
            <td>
              <?php 
                if($farma[0]->notory_affi_annex=='1')
                {
                  $farma[0]->notory_affi_annex='Yes';
                }
                else
                {
                  $farma[0]->notory_affi_annex='No';
                }
                echo  $farma[0]->notory_affi_annex ?? '';       
              ?>             
            </td>
            
            <td>
            <?php 
              if($farma[0]->complainant_victim=='1')
                {
                  $farma[0]->complainant_victim='Yes';
                }
              else
                {
                  $farma[0]->complainant_victim='No';
                }
              echo  $farma[0]->complainant_victim ?? ''; 
            ?>                
            </td>          
            <td><?php echo  $farma[0]->comp_f_place ?? ''; ?></td>
            <td><?php echo  get_displaydate($farma[0]->comp_f_date ?? ''); ?></td>
          </tr>
             
        </tbody>

      </table>

      <hr>

      <?php
      //echo "<pre>";

      //print_r($farmb);

      $frmb =count($farmb);

      //echo $farmb[0]->h_first_name;die;

      if($frmb >0)
      {
      ?>


      <!-- part a end her ************************************  -->

      <!-- part b start here  ************************************  -->

      <?php if ($farma[0]->complaint_capacity_id> '1')
      { ?> 
        <h3 class="text-orange text-center mt-30 mb-30">FORM OF COMPLAINT : (PART - B)</h3>        
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Is select organisation is registered in INDIA</th>
              <th>Certificate of registration/incorporation enclosed?</th>
              <th>Name of the Competent Authority</th>  
            </tr>
          </thead>
          <tbody>
            <tr>  
               <td><?php
                          if($farmb[0]->orgn_referred_india=='1')
                          {
                            $farmb[0]->orgn_referred_india='Yes';
                          }
                          else
                          {
                            $farmb[0]->orgn_referred_india='No';
                          }
                echo  $farmb[0]->orgn_referred_india ?? ''; ?></td>
                <td><?php 

                  if($farmb[0]->cert_regInc_encl=='1')
                  {
                    $farmb[0]->cert_regInc_encl='Yes';
                  }
                  else
                  {
                    $farmb[0]->cert_regInc_encl='No';
                  }
                echo $farmb[0]->cert_regInc_encl ?? ''; ?></td>
             <td><?php echo  $farmb[0]->auth_ireginc; ?></td>         
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Address for correspondence with the Organisation-</h4>
        <table class="mytable mb-30">
          <?php 
            $cstateid =$farmb[0]->o_state_id;
            $cdistid =$farmb[0]->o_dist_id;
            $cstate = $this->report_model->getPstate($cstateid);
            $statename=$cstate['name'];
            $cdistid =$farmb[0]->o_dist_id;
            $cdist = $this->report_model->getPdistrict($cstateid,$cdistid);
            $cdistrictname=$cdist['name'];    
          ?>
          <?php 
            $wc_id =$farmb[0]->o_country_id;
            if($wc_id !='')
            {
            $wcountry = $this->report_model->getNationality($wc_id);
            $wcountryname=$wcountry['nationality_desc'];
            }
            else
            {
            $wcountryname='';
            }
          ?>
          <tbody>
            <tr>      
              <th>House/Property Number/locality</th>  
              <td>:</td>   
              <td><?php echo $farmb[0]->o_hpnl; ?></td>
              <th>Name of village/City</th>
              <td>:</td>   
              <td><?php echo  $farmb[0]->o_vill_city; ?></td>
              <th>State</th>
              <td>:</td>   
              <td><?php echo  $statename; ?></td>
            </tr>
            <tr> 
              <th>District</th> 
              <td>:</td>   
              <td><?php echo $cdistrictname; ?></td>   
              <th>Pin Code/Zonal Code</th>
              <td>:</td>   
              <td><?php echo  $farmb[0]->o_pin_code; ?></td>
              <th>Country</th>
              <td>:</td>   
              <td><?php echo  $wcountryname; ?></td>
            </tr>
            <tr> 
              <th>Phone with STD</th>
              <td>:</td>   
              <td><?php echo  $farmb[0]->o_tel_no; ?></td>
              <th>Email ID</th> 
              <td>:</td>   
              <td><?php echo  $farmb[0]->o_email_id; ?></td>
              <th>Mobile No</th>
              <td>:</td>   
             <td><?php echo  $farmb[0]->o_promob_no; ?></td>         
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Details of the person who has authorised the signatory to file the complaint on behalf of the organisation -</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Designation</th>               
            </tr>
          </thead>
            <tbody>
            <tr>  
              <td><?php echo $farmb[0]->h_first_name; ?></td>                  
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Name of the person authorising the signatory to file the complaint -</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Title</th>
              <th>Surname</th>
              <th>Middle Name</th>
              <th>First Name</th> 
              <th>Gender</th>
              <th>Age</th>   
               <th>Nationality</th>           
            </tr>
          </thead>
        <?php
         $farmb[0]->a_salutation_id;
         
          $wid =$farmb[0]->a_salutation_id;
          if($wid !='')
          {
      $wsalution = $this->report_model->getSalutation($wid);
       $w_desc=$wsalution['salutation_desc'];
      }
      else
      {
        $w_desc='';
      }

      $w_gid =$farmb[0]->a_gender_id;
          if($w_gid !='')
         {
          $wgender = $this->report_model->getGender($w_gid);
          $wgen_desc=$wgender['gender_desc'];
          }
      else
      {
        $wgen_desc='';
      }

      $wc_id =$farmb[0]->a_nationality_id;
           if($wc_id !='')
           {
          $wcountry = $this->report_model->getNationality($wc_id);
          $wcountryname=$wcountry['nationality_desc'];
        }
        else
        {
          $wcountryname='';
        }

      ?>
          <tbody>
            <tr>  
              <td><?php echo $w_desc ?></td>
                <td><?php echo $farmb[0]->a_sur_name; ?></td>
                 <td><?php echo  $farmb[0]->a_mid_name; ?></td>
                <td><?php echo $farmb[0]->a_first_name; ?></td> 
                 <td><?php  echo $wgen_desc; ?></td>
                  <td><?php echo $farmb[0]->a_age_years; ?></td> 
                   <td><?php  echo $wcountryname; ?></td>           
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Details of identity proof-</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nationality</th>
              <th>Type Of Identity Document</th>
              <th>Document Identity Number</th>
              <th>Date of Issue</th>  
               <th>Validatity Date</th>
              <th>Issuing Authority</th>
               <th>Upload copy of Identity Document</th>                
            </tr>
          </thead>
        <?php 
          
         $wc_id =$farmb[0]->aidentity_proof_id;
           if($wc_id !='')
           {
          $wcountry = $this->report_model->getIdentity($wc_id);
          $identitydesc=$wcountry['Identity_proof_desc'];
        }
        else
        {
          $identitydesc='';
        }

       
      ?>

          <tbody>
            <tr>  
              <td><?php echo  $wcountryname; ?></td>
              <td><?php echo $identitydesc; ?></td>
              <td><?php echo  $farmb[0]->aidentity_proof_no; ?></td>
              <td><?php
              $farmb[0]->aidentity_proof_doi=get_displaydate($farmb[0]->aidentity_proof_doi);
                 echo $farmb[0]->aidentity_proof_doi ?? ''; ?></td>
              <td><?php 
                 $farmb[0]->aidentity_proof_vupto=get_displaydate($farmb[0]->aidentity_proof_vupto);
                 echo  $farmb[0]->aidentity_proof_vupto ?? ''; ?></td>
              <td><?php echo $farmb[0]->aidentity_proof_iauth; ?></td>
              <?php if($farmb[0]->identity_url_partb !=''){?>
              <td><a href="<?php echo base_url();?><?php echo $farmb[0]->identity_url_partb ?? ''; ?>" target="_blank" alt="">show Uploaded identity </a>
              </td>
              <?php } ?>               
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Detail of Residence proof-</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Residence Proof</th>
              <th>Document Number</th>
              <th>Date of Issue</th>  
               <th>Validatity Date</th>
              <th>Issuing Authority</th>
               <th>Upload copy of Residence Document</th>                
            </tr>
          </thead>
        <?php 
          $wc_id =$farmb[0]->aidres_proof_id;
           if($wc_id !='')
           {
          $wcountry = $this->report_model->getResidence($wc_id);
          $wcountryname=$wcountry['idres_proof_desc'];
        }
        else
        {
          $wcountryname='';
        }  
      ?>

          <tbody>
            <tr>  
               <td><?php echo  $wcountryname; ?></td>
                  <td><?php echo  $farmb[0]->aidres_proof_no; ?></td>
                <td><?php
                $farmb[0]->aidres_proof_doi=get_displaydate($farmb[0]->aidres_proof_doi); 

                echo $farmb[0]->aidres_proof_doi ?? ''; ?></td>
                 <td><?php 
                    $farmb[0]->aidres_proof_vupto=get_displaydate($farmb[0]->aidres_proof_vupto);
                 echo  $farmb[0]->aidres_proof_vupto ?? ''; ?></td>
                <td><?php echo $farmb[0]->aidres_proof_iauth; ?></td>
                <?php if($farmb[0]->residence_url_partb !='') { ?>
                 <td>
                    <a href="<?php echo base_url();?><?php echo $farmb[0]->residence_url_partb ?? ''; ?>" target="_blank" alt="">show Uploaded residence </a>
                  </td>

                <?php }?>
                     
            </tr>
               
          </tbody>

        </table>

        <h4 class="section-title text-theme">Permanent Address of person authorizing the signatory-</h4>
        <table class="table table-striped">
          <thead>
            <tr>      
              <th>House/Property Number/Locality</th>
              <th>Name of Village / City</th>
              <th>State</th>  
               <th>District</th>        
               <th>PinCode/ZonalCode</th>
               <th>Country</th>
                      
            </tr>
          </thead>
        <?php 
          $wc_id =$farmb[0]->ap_state_id;

           if($wc_id !='')
           {
          $cstate = $this->report_model->getPstate($wc_id);
          $statename=$cstate['name'];
        }
        else
        {
           $statename='';
        }
        $cdistid =$farmb[0]->ap_dist_id ?? '';

       if($cdistid !='')
       {
          $cdist = $this->report_model->getPdistrict($wc_id,$cdistid);
          $cdistrictname=$cdist['name']; 
        }
        else
        {
          $cdistrictname='';
        }

        $wc_id =$farmb[0]->ap_country_id;
           if($wc_id !='')
           {
          $wcountry = $this->report_model->getNationality($wc_id);
          $wcountryname=$wcountry['nationality_desc'];
        }
        else
        {
          $wcountryname='';
        }

      ?>

          <tbody>
            <tr>         
                <td><?php echo  $farmb[0]->ap_hpnl; ?></td>
                 <td><?php echo  $farmb[0]->ap_vill_city; ?></td>
               <td><?php echo  $statename; ?></td>
                <td><?php echo  $cdistrictname; ?></td>           
                <td><?php echo $farmb[0]->ap_pin_code; ?></td>
                 <td><?php echo  $wcountryname; ?></td>  
              
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Address of Correspondence-</h4>
        <table class="table table-striped">
          <thead>
            <tr>        
              <th>House/Property Number/Locality</th>
               <th>Name of Village / City</th>
              <th>State</th>  
               <th>District</th>
             
               <th>PinCode/ZonalCode</th>
               <th>Country</th>                
            </tr>
          </thead>
        <?php 
          $wc_id =$farmb[0]->ac_state_id ?? '';

           if($wc_id !='')
           {
          $cstate = $this->report_model->getPstate($wc_id);
          $statename=$cstate['name'];
        }
        else
        {
           $statename='';
        }
        $cdistid =$farmb[0]->ac_dist_id ?? '';

       if($cdistid !='')
       {
          $cdist = $this->report_model->getPdistrict($wc_id,$cdistid);
          $cdistrictname=$cdist['name']; 
        }
        else
        {
          $cdistrictname='';
        }

        $wc_id =$farmb[0]->ac_country_id ?? '';
           if($wc_id !='')
           {
          $wcountry = $this->report_model->getNationality($wc_id);
          $wcountryname=$wcountry['nationality_desc'];
        }
        else
        {
          $wcountryname='';
        }

      ?>

          <tbody>
            <tr>          
              <td><?php echo  $farmb[0]->ac_hpnl; ?></td>
              <td><?php echo  $farmb[0]->ac_vill_city; ?></td>
              <td><?php echo  $statename; ?></td>
              <td><?php echo  $cdistrictname; ?></td>          
              <td><?php echo $farmb[0]->ac_pin_code; ?></td>
              <td><?php echo  $wcountryname; ?></td>
            </tr>         
          </tbody>
        </table>

        <h4 class="section-title text-theme">Other details-</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Occupation/designation/avocation</th>
              <th>Telephone Number</th>
              <th>Mobile Number</th>  
               <th>Email</th>
              <th>Authorisation document has been enclosed?</th>
                             
            </tr>
          </thead>
          <tbody>
            <tr>  
               <td><?php echo  $farmb[0]->aoccu_desig_avo; ?></td>
                <td><?php echo  $farmb[0]->atel_no; ?></td>
                 <td><?php echo  $farmb[0]->amob_no; ?></td>
                  <td><?php echo  $farmb[0]->email_id; ?></td>
                <td><?php 
                  if($farmb[0]->auth_doc_encl =='1')
                  {
                    $farmb[0]->auth_doc_encl='Yes';
                  }
                  else
                  {
                    $farmb[0]->auth_doc_encl='No';
                  }
                echo $farmb[0]->auth_doc_encl ?? ''; ?></td>                          
                     
            </tr>
               
          </tbody>

        </table>

      <h4 class="section-title text-theme">Office Bearers Details-</h4>
      <table class="table table-striped">
        <tr>
          <th>Sr No</th>
          <th>Title</th>
          <th>Sur Name</th>
          <th>Middle Name</th>
          <th>First Name</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Nationality</th>
          <th>Tel No</th>
          <th>Mob No</th>    
        </tr>
        <?php
        $i=1;
        foreach($officebeare as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->salutation_desc ?? ''."</td>";
        echo "<td>".$row->ob_sur_name ?? ''."</td>";
        echo "<td>".$row->ob_mid_name ?? ''."</td>";
         echo "<td>".$row->ob_first_name ?? ''."</td>";
        echo "<td>".$row->gender_desc ?? ''."</td>";
        echo "<td>".$row->ob_age_years ?? ''."</td>";
         echo "<td>".$row->country_desc ?? ''."</td>";
        echo "<td>".$row->ob_tel_no ?? ''."</td>";
        echo "<td>".$row->ob_mob_no ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>

      <table class="table table-striped">
        <tr>
          <th>Sr No</th>
          <th>Identity Proof Id</th>
          <th>Identity Proof No</th>
          <th>Identity Date of Issue</th>
          <th>Identity Valid UPTO</th>
          <th>Identity Issuing Authority</th>
                 
        </tr>
        <?php
        $i=1;
        foreach($officebeare as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->Identity_proof_desc ?? ''."</td>";
        echo "<td>".$row->ob_identity_proof_no ?? ''."</td>";
        echo "<td>".get_displaydate($row->ob_identity_proof_doi ?? '')."</td>";
         echo "<td>".get_displaydate($row->ob_identity_proof_vupto ?? '')."</td>";
        echo "<td>".$row->ob_identity_proof_iauth ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>


      <table class="table table-striped">
        <tr>
          <th>Sr No</th>
          <th>Residence Proof Id</th>
          <th>Residence Proof No</th>
          <th>Residence Date of Issue</th>
          <th>Residence Valid UPTO</th>
          <th>Residence Issuing Authority</th>
                 
        </tr>
        <?php
        $i=1;
        foreach($officebeare as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->idres_proof_desc ?? ''."</td>";
        echo "<td>".$row->ob_idres_proof_no ?? ''."</td>";
        echo "<td>".get_displaydate($row->ob_idres_proof_doi ?? '')."</td>";
         echo "<td>".get_displaydate($row->ob_idres_proof_vupto ?? '')."</td>";
        echo "<td>".$row->ob_idres_proof_iauth ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>

        
      <?php
      /*
      echo "<pre>";
      print_r($addparty);

      die;*/
      ?>
      <hr>
      <h3 class="text-orange text-center mt-30 mb-30">THIRD PARTY DETAILS(PART - B)</h3>
      <table class="table table-striped">
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Mob No</th>
          <th>Pin Code</th>
          <th>Email-ID</th>
          <th>Address</th>
          <th>Teliphone No</th>
          <th>Country</th>
        </tr>
        <?php
        $i=1;
        foreach($addparty as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->affect_name ?? ''."</td>";
        echo "<td>".$row->gender_desc ?? ''."</td>";
        echo "<td>".$row->affect_ageyears ?? ''."</td>";
         echo "<td>".$row->affect_mob_no ?? ''."</td>";
        echo "<td>".$row->affect_pin_code ?? ''."</td>";
        echo "<td>".$row->affect_email_id ?? ''."</td>";
         echo "<td>".$row->affect_add1 ?? ''."</td>";
        echo "<td>".$row->affect_tel_no ?? ''."</td>";
        echo "<td>".$row->country_desc ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>


      <?php } } ?>


      <hr>

      <h3 class="text-orange text-center mt-30 mb-30">FORM OF COMPLAINT : (PART - C)</h3>

      <h4 class="section-title text-theme">Details as regards the public servant against whom the complaint is being made- -</h4>
      <table class="mytable mb-30">
          <?php 

          //echo "<pre>";
          //print_r($public_servantc);

          if(isset($public_servantc))
          {

          $psid =$public_servantc['ps_salutation_id'] ?? '';

          if($psid !='')
          {
          $pssalution = $this->report_model->getSalutation($psid);
          $pstitile_desc=$pssalution['salutation_desc'];
          }
          else
          {
          $pstitile_desc='';
          }
          ?>
          <tbody>
            <tr>  
              <th style="width: 25%">Title</th>
              <td>:</td>
              <td style="width: 25%"><?php echo  $pstitile_desc; ?></td>
              <th style="width: 25%">Name</th>
              <td>:</td>
              <td style="width: 25%"><?php echo  $public_servantc['ps_first_name'].' '.$public_servantc['ps_mid_name'].' '.$public_servantc['ps_sur_name'] ?></td>
            </tr>
            <tr>
              <th>Is officer or employee or agency (DP), under or associated with the Lokpal?</th>
              <td>:</td>
              <td><?php
              if($public_servantc['ps_dsp_lp']=='1')
              {
                $public_servantc['ps_dsp_lp']='Yes';
              }
              else
              {
                $public_servantc['ps_dsp_lp']='No';
              }
              echo  $public_servantc['ps_dsp_lp'] ?? ''; ?></td>
            
              <th>Present designation/status of the public servant</th>
              <td>:</td>
              <td><?php echo  $public_servantc['present_ps_desig'] ?? ''; ?></td>
            </tr>
            <tr>
              <th> Designation of the officer/employee</th>
              <td>:</td>
              <td><?php echo  $public_servantc['ps_desig'] ?? ''; ?></td>
              <th> Organisation/Agency having administrative control over the said officer/employee</th> 
              <td>:</td>
              <td><?php echo  $public_servantc['ps_orgn'] ?? ''; ?></td>
            </tr>
            <tr>
              <th>Category of the public servant against whom the complaint is being made</th>
              <td>:</td>
              <?php
                $getscrutinyCategory = $this->reports_model->getscrutinyCategory($filing_no);
                $sc_complaint_capacity_desc=$getscrutinyCategory[0]->complaint_capacity_desc ?? '';
                $sc_ps_desc=$getscrutinyCategory[0]->ps_desc ?? '';
                if (!empty($sc_complaint_capacity_desc))
                {
                  $ccapacity=$sc_complaint_capacity_desc;
                  $subcat_desc=$sc_ps_desc; ?>          
                  <td><?php echo $ccapacity; ?> </td>
                  <td><?php echo $subcat_desc; ?> </td>
                  <?php } else {
                    $psectorid =$public_servantc['complaint_capacity_id'] ?? '';

                    if($psectorid !='')
                    {
                    $pssalution = $this->report_model->getPublicsector($psectorid);
                    $ccapacity=$pssalution['complaint_capacity_desc'];
                    }
                    else
                    {
                    $ccapacity='';
                    }

                    $subcat =$public_servantc['ps_id'] ?? '';
                    if($subcat !='')
                    {
                    $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
                    $subcat_desc=$pssubcat['ps_desc'];
                    }
                    else
                    {
                    $subcat_desc='';
                    } 
                  ?>
                  <td><?php echo $ccapacity;?> </td>
                  <th>Public Sector</th>
                  <td>:</td>
                  <td><?php echo $subcat_desc; ?> </td>
                <?php } ?>
            </tr> 
            <tr>
              <th>If the complaint is made against any other category of PS, specify</th> 
              <td>:</td>
              <td><?php echo $public_servantc['ps_othcate'] ?? ''; ?></td>
            </tr>      
          </tbody>

        </table>

      <!-----------------category history detail------------------>

      <?php
       if($status == 't' and $sc_complaint_capacity_desc !='') { ?>
        <h4 class="section-title text-theme">Category update history -</h4>
        <table class="mytable">
          <tbody>
            <tr>       
              <th>Category of the public servant against whom the complaint is being made</th>
              <td>:</td>
              <td>
                <?php        
                $psectorid =$public_servantc['complaint_capacity_id'] ?? '';
                if($psectorid !='')
                  {
                    $pssalution = $this->report_model->getPublicsector($psectorid);
                    $ccapacity=$pssalution['complaint_capacity_desc'];
                  }
                  else
                  {
                  $ccapacity='';
                  }
                  $subcat =$public_servantc['ps_id'] ?? '';
                  if($subcat !='')
                  {
                  $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
                  $subcat_desc=$pssubcat['ps_desc'];
                  }
                  else
                  {
                  $subcat_desc='';
                  } 
                echo $ccapacity;
                ?>
              </td>                          
            </tr>
            <tr>         
              <th>Public Sector</th> 
              <td>:</td>
              <td><?php echo $subcat_desc; ?></td>       
            </tr>         
          </tbody>
        </table>
      <?php } ?>

      <!-----------end of category history detail ----------->


        <h4 class="section-title text-theme">In case the complaint is against any Chairperson/Member/ Officer/Employee of a Trust or an Association of Persons or Society, indicate -</h4>
        <table class="mytable mb-30">
          <tbody>
            <tr>  
              <th style="width:30%">Whether the organisation is wholly or partly financed by the Government</th>
              <td>:</td>
              <td><?php
                         if($public_servantc['tas_fingoi']=='1')
                        {
                          $public_servantc['tas_fingoi']='Yes';
                        }
                        elseif($public_servantc['tas_fingoi']=='2')
                        {
                          $public_servantc['tas_fingoi']='No';
                        }
                        else
                        {
                          $public_servantc['tas_fingoi']='N/A';
                        }



                 echo $public_servantc['tas_fingoi'] ?? ''; ?>
                   
              </td>
              <th style="width:30%">Whether the annual income of the organisation exceeds one crore rupees</th> 
              <td>:</td>
              <td>
                <?php 

                    if($public_servantc['anninc_onecr']=='1')
                    {
                      $public_servantc['anninc_onecr']='Yes';
                    }
                    elseif($public_servantc['anninc_onecr']=='2')
                    {
                        $public_servantc['anninc_onecr']='No';
                     }
                     else
                     {
                      $public_servantc['anninc_onecr']='N/A';
                     }
                echo $public_servantc['anninc_onecr'] ?? ''; ?>
                  
              </td>          
            </tr>
            <tr>
              <th>Whether the Org is in receipt of any donation from any foreign source</th>
              <td>:</td>
              <td>
                <?php
                  if($public_servantc['dona_fs']=='1')
                  {
                    $public_servantc['dona_fs']='Yes';
                  }
                  elseif($public_servantc['dona_fs']=='2')
                  {
                    $public_servantc['dona_fs']='No';
                  }
                  else
                  {
                    $public_servantc['dona_fs']='N/A';
                  }

                  echo $public_servantc['dona_fs'] ?? ''; 
                ?>
              </td> 
              <th>Whether the public servant is presently serving the affairs of the State or in any body or Board or corporation or authority, etc.</th>  
              <td>:</td>
              <td>
                <?php
                  if($public_servantc['pss_sbbca'] =='1')
                  {
                    $public_servantc['pss_sbbca']='Yes';
                  }
                  else
                  {
                    $public_servantc['pss_sbbca']='No';
                  }
                  echo $public_servantc['pss_sbbca'] ?? ''; 
                ?>
              </td>         
            </tr>  
          </tbody>
        </table>

        <h4 class="section-title text-theme">Period during which alleged misconduct was committed.-</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>From Date</th>
              <th>To Date</th>
              <th>Place of Occurrence</th>
              <th>State</th>
              <th>Village/City/District</th>               
               
            </tr>
          </thead>

          <?php 
           $cstateid =$public_servantc['ps_pl_stateid'] ?? '';
           if($cstateid !='')
           {
          $cstate = $this->report_model->getPstate($cstateid);
          $statename=$cstate['name'];
        }
        else
        {
          $statename='';
        }
          $cdistid =$public_servantc['ps_pl_dist_id'] ?? '';
          if($cdistid !='')
          {
          $cdist = $this->report_model->getPdistrict($cstateid,$cdistid);
          $cdistrictname=$cdist['name'];
        }
        else
        {
          $cdistrictname='';
        }
          ?>
          <tbody>
            <tr>  
               <td><?php 
                  $public_servantc['periodf_coa']=get_displaydate($public_servantc['periodf_coa']);

               echo  $public_servantc['periodf_coa'] ?? ''; ?></td>
                <td><?php 
                $public_servantc['periodt_coa']=get_displaydate($public_servantc['periodt_coa']);
                echo  $public_servantc['periodt_coa'] ?? ''; ?></td>
             <td><?php echo $public_servantc['ps_pl_occ'] ?? ''; ?></td>
             <td><?php echo $statename; ?></td>        
              <td><?php echo $cdistrictname; ?></td>
               
            </tr>
               
          </tbody>

        </table>

        <h4 class="section-title text-theme">Summary of facts/allegations of corruption-</h4>
        <table class="mytable mb-30">
          <tbody>
            <tr>  
              <th style="width: 15%;">Summary of Facts</th>
              <td>:</td>
              <td style="width: 15%;"><?php echo  $public_servantc['sum_facalle'] ?? ''; ?></td>

              <th style="width: 15%;">Show uploaded facts</th>
              <td>:</td>
              <?php if($public_servantc['sum_fact_allegation_upload'] !=''){?>
              <td style="width: 15%;"><a href="<?php echo base_url();?><?php echo $public_servantc['sum_fact_allegation_upload'] ?? ''; ?>" target="_blank" alt="">Show uploaded facts </a>
              </td>
              <?php } ?>  

              <th style="width: 15%;">Detail of Offence</th>  
              <td>:</td>     
              <td style="width: 15%;"><?php echo  $public_servantc['det_offen'] ?? ''; ?></td>
            </tr>

            <tr>
              <th>Show uploaded Detail Offence</th>
              <td>:</td>
              <?php if($public_servantc['detail_offence_upload'] !=''){?>
              <td><a href="<?php echo base_url();?><?php echo $public_servantc['detail_offence_upload'] ?? ''; ?>" target="_blank" alt="">Show uploaded detail offence </a>
              </td>
              <?php } ?>

              <th>Statutory provision alleged to have been violated by</th>
              <td>:</td>
              <td><?php echo $public_servantc['prov_viola'] ?? ''; ?></td>
              
              <th>Any Other Info</th> 
              <td>:</td>
              <td><?php echo $public_servantc['any_othInfo'] ?? ''; ?></td>
            </tr>

            <tr>
              <th>Document Copy Attached?</th>
              <td>:</td>
              <td>
                <?php 
                  if($public_servantc['doc_copy_attached']=='1')
                  {
                    $public_servantc['doc_copy_attached']='Yes';            
                  }
                  else
                  {
                  $public_servantc['doc_copy_attached']='No';
                  }
                  echo  $public_servantc['doc_copy_attached'] ?? ''; 
                ?>                 
              </td>

              <th>whether pdf formats of the documents and other material relied upon has been attached?</th>
              <td>:</td>
              <td>
                  <?php 
                    if($public_servantc['electronic_file']=='1')
                    {
                      $public_servantc['electronic_file']='Yes';
                    }
                    else
                    {
                      $public_servantc['electronic_file']='No';
                    }

                    echo  $public_servantc['electronic_file'] ?? ''; 
                  ?>
              </td> 

              <th>List of Relied Doc(Support)</th>
              <td>:</td>  
              <td><?php $public_servantc['relevant_evidence_upload'] ?? ''; ?></td>
            </tr>

            <tr>
              <th>Show list of relied doc uploaded</th>  
              <td>:</td> 
              <?php if($public_servantc['relevant_evidence_upload'] !=''){?>
              <td><a href="<?php echo base_url();?><?php echo $public_servantc['relevant_evidence_upload'] ?? ''; ?>" target="_blank" alt="">Show uploaded relied document </a>
              </td> 
              <?php } ?>         
            </tr>         
          </tbody>
        </table>
      <?php }?>



      <h4 class="section-title text-theme">Additional Public Servant Details-</h4>
      <table class="table table-striped mb-30">
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Designation</th>
          <th>Organization</th>
          <th>P.S Category</th>
          <th>P.S Sub Category</th>    
          <th>Post Held</th>
          <th>Offence From</th>
          <th>Offence To</th>
          <th>Place of occurance</th>
          <th>State</th>
         
        </tr>
        <?php
        $i=1;
        foreach($public_servant_detail as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
          

        echo "<td>".$row->ad_ps_first_name.' '.$row->ad_ps_mid_name.' '.$row->ad_ps_mid_name."</td>";
        echo "<td>".$row->ad_ps_desig ?? ''."</td>";
        echo "<td>".$row->ad_ps_orgn ?? ''."</td>";
         echo "<td>".$row->complaint_capacity_desc ?? ''."</td>";
        echo "<td>".$row->ps_desc ?? ''."</td>";
        echo "<td>".$row->ad_psc_postheld ?? ''."</td>";
         echo "<td>".get_displaydate($row->ad_periodf_coa ?? '')."</td>";
        echo "<td>".get_displaydate($row->ad_periodt_coa ?? '')."</td>";
        echo "<td>".$row->ad_ps_pl_occ ?? ''."</td>";
        echo "<td>".$row->name ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>


      <h4 class="section-title text-theme">Third Party Details(Part - C)</h4>
      <table class="table table-striped mb-30">
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Mob No</th>
          <th>Pin Code</th>
          <th>Email-ID</th>
          <th>Address</th>
          <th>Teliphone No</th>
          <th>Country</th>
        </tr>
        <?php
        $i=1;
        foreach($addpartyc as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->affect_name ?? ''."</td>";
        echo "<td>".$row->gender_desc ?? ''."</td>";
        echo "<td>".$row->affect_ageyears ?? ''."</td>";
         echo "<td>".$row->affect_mob_no ?? ''."</td>";
        echo "<td>".$row->affect_pin_code ?? ''."</td>";
        echo "<td>".$row->affect_email_id ?? ''."</td>";
         echo "<td>".$row->affect_add1 ?? ''."</td>";
        echo "<td>".$row->affect_tel_no ?? ''."</td>";
        echo "<td>".$row->country_desc ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>

      <h4 class="section-title text-theme">Witness Details-</h4>
      <table class="table table-striped mb-30">
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Mob No</th>
          <th>Pin Code</th>
          <th>Email-ID</th>
          <th>Address</th>
          <th>Teliphone No</th>
          <th>Country</th>
        </tr>
        <?php
        $i=1;

        foreach($witness_detail as $row)
        {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->w_first_name.' '.$row->w_mid_name.' '.$row->w_sur_name."</td>";
        echo "<td>".$row->gender_desc ?? ''."</td>";
        echo "<td>".$row->w_age_years ?? ''."</td>";
         echo "<td>".$row->w_mob_no ?? ''."</td>";
        echo "<td>".$row->w_pin_code ?? ''."</td>";
        echo "<td>".$row->w_email_id ?? ''."</td>";
         echo "<td>".$row->w_hpnl ?? ''."</td>";
        echo "<td>".$row->w_tel_no ?? ''."</td>";
        echo "<td>".$row->country_desc ?? ''."</td>";
        echo "</tr>";
        $i++;
        }
         ?>
      </table>

      <div class="row">
        <div class="col-md-6">
          <?php if($status == 'f') { ?>
            <button type="button" class="btn btn-primary"  onclick="window.open('<?php echo site_url("filing/filing");?>')">Edit application</button>     
          <?php } ?>
        </div>
        <div class="col-md-6 text-right">
          <button type="submit" class="btn btn-success" id="submitbtn">Generate Pdf</button>

          <?php if($status == 't') { ?>
            <button type="button" class="btn btn-success final_submit" disabled> ✓ Application submitted </button>
            <?php 
            } 
            else { ?>
              <button type="button" class="btn btn-danger final_submit" id="<?php echo $ref_no; ?>">Final Submit</button>
            <?php } 
          ?>
        </div>
      </div>
      

  </form>

  <div class="row">
    <div class="col-md-12 mt-30">  
      <?php
      //$complaint_no = '1000100100';
        if($this->session->flashdata('success_msg')){
        echo '<div class="alert alert-success"><h3 class="text-center">'.$this->session->flashdata('success_msg').'</h3></div>';
        echo '<h4 class="text-center">Your automatically generated Diary no. is : <b>'.$filing_no.'</h4> <h4 class="text-center">All the future communications will be possible with the help of diary no.</h4>';
        }
        echo '<h3 class="status-msg error text-center">'.$this->session->flashdata('error_msg').'</h3>'; 
      ?> 
      <div class="status-msg error text-center" id="error_message"></div>
    </div>
  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
      $(document).ajaxStart(function(){
    $("#wait").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait").css("display", "none");
  });
        $(document).on('click', '.final_submit', function(){
          if(confirm("Are you sure you want to submit application? No changes can be done after final submit."))
        {
        var reference_no = $(this).attr('id');

          $.ajax({
        url: '<?php echo site_url('affidavit/update_form_status'); ?>',
        type: 'POST',
        data:{reference_no:reference_no, data_action:'update_form'},
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data.success){
              console.log(data.success);
              window.location.reload();
            }
            if(data.error){
              $('#error_message').html('<div class="alert alert-error"><h4>Some problem occured on submitting application.</h4></div>');
            }
        }
    });
        }
      });
         });
</script>




