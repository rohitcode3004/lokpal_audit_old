<?php
// include(APPPATH.'views/templates/front/header2.php');
$elements = $this->label->view(1);
?>

<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <?php 

  //echo "<pre>";
  //print_r($partb);
  if(isset($partb))
  {
    $state2=$partb['o_state_id'] ?? '';
    $odistid=$partb['o_dist_id'] ?? '';

    $state1=$partb['ap_state_id'] ?? '';
    $ap_dist=$partb['ap_dist_id'] ?? '';

    $state3=$partb['ac_state_id'] ?? '';
    $c_dist_id=$partb['ac_dist_id'] ?? '';

  }
  else{

    $state2= '';
    $odistid= '';
    $state1='';
    $ap_dist='';

    $state3='';
    $c_dist_id='';
  }

  ?>

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Entry of Complaint (Part Wise)</h4>
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
          <div class="panel-heading text-center">FORM OF COMPLAINT : (PART - B)</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">     
                <form id="appletfilingform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>applet/save'  name="appletfilingform" enctype="multipart/form-data">
                  <div class="row">
                    <?php if (isset($ref_no)) {?>

                    <div class="col-md-12"> 
                      <div class="search">                  
                      <!-- <label for="complaintMode_id" >Refrance Number-</label>  
                        <span style="color: red"><b>  <?php echo $ref_no;?></b></span>  -->
                      </div>           
                    </div>

                    <?php } ?>
                  </div>

                  <div class="form_error">
                    <?php //echo validation_errors(); ?>
                  </div>
                  <div class="alert alert-danger"><h4 class="m-0">ADDITIONAL DETAILS TO BE FURNISHED BY THE SIGNATORY TO THE COMPLAINT IF THE COMPLAINT IS BEING FILED ON BEHALF OF A BODY OR BOARD OR CORPORATION OR AUTHORITY OR COMPANY, SOCIETY OR ASSOCIATION OF PERSONS OR TRUST OR LIMITED LIABILITY PARTNERSHIP</h4>
                  </div>
                    
                  <div class="row">
                    <div class="col-md-12 mb-15">  
                    <label class="text-orange">1. In case the complaint is made by a body or board or corporation or authority or company, society or association of persons or trust or limited liability partnership, then please indicate: -</label>
                      <?php $org_ref=$partb['orgn_referred_india'] ?? ''; ?>                 
                      <label for="orgn_referred_india" ><?php print_r($this->label->get_short_name($elements, 61)); ?><span class="text-danger">*</span></label>  

                      <div class="radio">
                        <label>
                          <input type="radio" name="orgn_referred_india" id="orgn_referred_india" value="1" <?php if ($org_ref=="1"){echo "checked=checked";}?>>
                          Yes
                        </label>
                        <label>
                          <input type="radio" name="orgn_referred_india" id="orgn_referred_india" value="2" <?php if ($org_ref=="2"){echo "checked=checked";}?>>
                          No
                        </label>
                      </div>  
                      <span><?php echo form_error('orgn_referred_india'); ?></span>     
                    </div>
                  </div> 

                  <div class="row certdiv" style="display: none;">
                    <div class="col-md-12 mb-15">     

                      <?php $cert=$partb['cert_regInc_encl'] ?? ''; ?> 

                      <label for="cert_regInc_encl">(b). If the answer to (a) above is “YES” then whether the certificate of registration/incorporation [<i>as issued by the authority competent to issue such certificate in India or by authority competent to issue such certificate as per the regulating law of the Foreign State, as the case may be</i>], in respect of such organisation has been
                       enclosed?<span class="text-danger">*</span></label>    
                      <div class="radio">
                        <label>
                          <input type="radio" name="cert_regInc_encl" id="Active" required="required" value="1" <?php if ($cert=="1"){echo "checked=checked";}?>>
                          Yes
                        </label>
                        <label>
                          <input type="radio" name="cert_regInc_encl" id="Inactive" required="required" value="2" <?php if ($cert=="2"){echo "checked=checked";}?>>
                          No
                        </label>
                      </div> 

                    </div>
                  </div>

                  <div class="row namecert_div" style="display: none;">

                    <div class="col-md-12 mb-15">
                      <label for="auth_iregInc"><?php print_r($this->label->get_short_name($elements, 64)); ?><span class="text-danger">*</span></label>       
                      <input type="text" class="form-control" name="auth_ireginc" id="auth_ireginc" onkeypress="return ValidateAlpha(event)"
                      value="<?php if(isset($partb)) echo $partb['auth_ireginc']; else echo set_value('auth_ireginc');?>" placeholder="" maxlength="1000">   
                      <span><?php echo form_error('auth_ireginc'); ?></span>          
                    </div>
                  </div>

                  <label><?php print_r($this->label->get_short_name($elements, 63)); ?></label>   

                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label for="o_hpnl"><?php print_r($this->label->get_short_name($elements, 66)); ?><span class="text-danger">*</span></label>       
                      <input type="text" class="form-control" name="o_hpnl" id="o_hpnl"             
                      value="<?php if(isset($partb)) echo $partb['o_hpnl']; else echo set_value('o_hpnl');?>"

                      maxlength="1000"  placeholder=""> 
                      <div class="error"><?php echo form_error('o_hpnl'); ?></div>       
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="o_vill_city"><?php print_r($this->label->get_short_name($elements, 106)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="o_vill_city" id="o_vill_city" maxlength="1000"
                      value="<?php if(isset($partb)) echo $partb['o_vill_city']; else echo set_value('o_vill_city');?>" onkeypress="return ValidateAlpha(event)" placeholder="">  
                      <div class="error"><?php echo form_error('o_vill_city'); ?></div>      
                    </div>  

                    <div class="col-md-4 mb-15">
                      <label for="o_state_id"><?php print_r($this->label->get_short_name($elements, 69)); ?><span class="text-danger">*</span></label>  
                      <select class="form-control chosen-single chosen-default" name="o_state_id" id="o_state_id" onChange="pageRefesh(this.value);" >
                        <option value="">Select state</option>       
                        <?php foreach($state as $row):?>
                          <?php if (!empty($state2)){ ?>
                           <option value="<?php echo $row->state_code;?>" <?php echo ($state2 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
                         <?php }else{?>
                          <option value="<?php echo $row->state_code; ?>" <?php echo set_select('o_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
                        <?php }?>
                      <?php endforeach;?>
                      </select>   
                      <div class="error"><?php echo form_error('o_state_id'); ?></div>  
                    </div>


                    <div class="col-md-4 mb-15">
                      <label for="o_dist_id"><?php print_r($this->label->get_short_name($elements, 67)); ?><span class="text-danger">*</span></label>
                      <select class="form-control" class="chosen-single chosen-default" name="o_dist_id" id="o_dist_id">  
                      </select>
                      <div class="error"><?php echo form_error('o_dist_id'); ?></div> 
                    </div> 
                  

    
                    <div class="col-md-4 mb-15">
                      <label for="o_pin_code"><?php print_r($this->label->get_short_name($elements, 70)); ?><span class="text-danger">*</span></label>   
                      <input type="text" class="form-control" name="o_pin_code" id="o_pin_code" maxlength="6"  
                     value="<?php echo set_value('o_pin_code', @$partb['o_pin_code'] ?? ''); ?>" onkeypress="return isNumberKey(event)" placeholder=""> 
                     <div class="error"><?php echo form_error('o_pin_code'); ?></div>  
                    </div>


                    <div class="col-md-4 mb-15">
                      <label for="o_country_id"><?php print_r($this->label->get_short_name($elements, 68)); ?><span class="text-danger">*</span></label>   
                      <?php $nationalty1=$partb['o_country_id'] ?? ''; ?>

                      <select type="text" class="form-control chosen-single chosen-default" name="o_country_id" id="o_country_id">
                        <option value=""class="chosen-single">Select Country</option>


                        <?php foreach($getcountry as $row):?>

                          <?php if (!empty($nationalty1)){             ?>
                          <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty1 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
                          <?php }else{?>
                          <option value="<?php echo $row->country_id; ?>" <?php echo set_select('o_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                          <?php }?>
                        <?php endforeach;?>        
                      </select>  
                      <div class="error"><?php echo form_error('o_country_id'); ?></div>       
                    </div> 
                  </div>         




                  <div class="row"> 
                    <div class="col-md-4 mb-15">
                      <label for="o_tel_no"><?php print_r($this->label->get_short_name($elements, 71)); ?></label>
                      <input type="text" class="form-control" name="o_tel_no" id="o_tel_no" value="<?php if(isset($partb)) echo $partb['o_tel_no']; else echo set_value('o_tel_no'); ?>"   onkeypress="return isNumberKey(event)" placeholder="" maxlength="15">
                    </div>


                    <div class="col-md-4 mb-15">
                      <label for="o_promob_no"><?php print_r($this->label->get_short_name($elements, 73)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="o_promob_no" id="o_promob_no" value="<?php if(isset($partb)) echo $partb['o_promob_no']; else echo set_value('o_promob_no');?>" maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="">
                      <div class="error"><?php echo form_error('o_promob_no'); ?></div>
                    </div>
                  
                    <div class="col-md-4 mb-15">
                      <label for="o_email_id"><?php print_r($this->label->get_short_name($elements, 72)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="o_email_id" id="o_email_id" required="required" value="<?php if(isset($partb)) echo $partb['o_email_id']; else echo set_value('o_email_id');?>" placeholder="" maxlength="500">
                    </div>
                  </div>
                  
                  <hr>

                  <div class="row"> 
                    <div class="col-md-12 mb-15">
                      <label class="text-orange">2. Personal details of office bearers and head of the organisation -</label>
                    
                      <div class="alert alert-info">
                        * furnish details in respect of each Office Bearer and Head of Organisation in the format as contained in Part A of this form.                   
                        <button type="button" class="btn btn-primary"  onclick="window.open('<?php echo site_url("applet/officebeared");?>')">Click here</button> 
                      </div>
                    </div>
                  </div>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 107)); ?> - </label>
                    </div>
                    <div class="col-md-4 mb-15">
                      <label for="h_first_name"><?php print_r($this->label->get_short_name($elements, 111)); ?><span class="text-danger">*</span></label>       
                      <input type="text" class="form-control" name="h_first_name" id="h_first_name" maxlength="500" value="<?php if(isset($partb)) echo $partb['h_first_name']; else echo set_value('h_first_name');?>" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">     
                      <div class="error"><?php echo form_error('h_first_name'); ?></div>      
                    </div>
                  </div>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 74)); ?> - </label>
                    </div>

                    <?php $sal=$partb['a_salutation_id'] ?? ''; ?>
                    <div class="col-md-2 mb-15">                   
                      <label for="a_salutation_id" ><?php print_r($this->label->get_short_name($elements, 75)); ?><span class="text-danger">*</span></label>    
                      <select type="text" class="form-control chosen-single chosen-default" name="a_salutation_id" id="a_salutation_id">
                        <option value="">Select Title</option>
                        <?php foreach($salution as $row):?>          
                          <?php if (!empty($sal)){             ?>
                           <option value="<?php echo $row->salutation_id;?>" <?php echo ($sal == $row->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
                         <?php }else{?>
                          <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('a_salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
                        <?php }?>
                      <?php endforeach;?>
                      </select> 
                      <div class="error"><?php echo form_error('a_salutation_id'); ?></div>          
                    </div>

                    <div class="col-md-2 mb-15">
                      <label for="a_sur_name"><?php print_r($this->label->get_short_name($elements, 76)); ?></label>       
                      <input type="text" class="form-control" name="a_sur_name" id="a_sur_name" value="<?php if(isset($partb)) echo $partb['a_sur_name']; else echo set_value('a_sur_name');?>" maxlength="200" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">        
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="a_mid_name"><?php print_r($this->label->get_short_name($elements, 77)); ?></label>     
                      <input type="text" class="form-control" name="a_mid_name" id="a_mid_name" value="<?php if(isset($partb)) echo $partb['a_mid_name']; else echo set_value('a_mid_name');?>" onkeypress="return ValidateAlpha(event)" maxlength="200" placeholder="" oninput="this.value = this.value.toUpperCase()">        
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="a_first_name"><?php print_r($this->label->get_short_name($elements, 78)); ?><span class="text-danger">*</span></label>      
                      <input type="text" class="form-control" name="a_first_name" id="a_first_name" maxlength="200" value="<?php if(isset($partb)) echo $partb['a_first_name']; else echo set_value('a_first_name');?>" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()"> 
                      <div class="error"><?php echo form_error('a_first_name'); ?></div>       
                    </div> 
                  </div>

                  <div class="row"> 
                    <?php $gender1=$partb['a_gender_id'] ?? ''; ?>
                    <div class="col-md-4 mb-15">                   
                      <label class="text-orange" for="a_gender_id"><?php print_r($this->label->get_short_name($elements, 79)); ?><span class="text-danger">*</span></label>    
                      <select type="text" class="form-control chosen-single chosen-default" name="a_gender_id" id="a_gender_id">
                        <option value="">Select Gender</option>
                        <?php foreach($gender as $row):?>   
                          <?php if (!empty($gender1)){             ?>
                           <option value="<?php echo $row->gender_id;?>" <?php echo ($gender1 == $row->gender_id) ? 'selected' : '' ?>> <?php echo $row->gender_desc; ?> </option>
                         <?php }else{?>
                          <option value="<?php echo $row->gender_id; ?>" <?php echo set_select('a_gender_id',  $row->gender_id); ?>><?php echo $row->gender_desc; ?></option>
                        <?php }?>

                      <?php endforeach;?>
                      </select> 
                      <div class="error"><?php echo form_error('a_gender_id'); ?></div>           
                    </div>

                    <div class="col-md-4 mb-15">
                      <label class="text-orange" for="a_age_years"><?php print_r($this->label->get_short_name($elements, 80)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="a_age_years" maxlength="3" id="a_age_years" value="<?php if(isset($partb)) echo $partb['a_age_years']; else echo set_value('a_age_years'); ?>" onkeypress="return isNumberKey(event)" placeholder=""> 
                      <div class="error"><?php echo form_error('a_age_years'); ?></div>        
                    </div>

                    <?php $nationalty1=$partb['a_nationality_id'] ?? ''; ?>
                    <div class="col-md-4 mb-15">                   
                      <label class="text-orange" for="a_nationality_id"><?php print_r($this->label->get_short_name($elements, 82)); ?><span class="text-danger">*</span></label>    
                      <select type="text" class="form-control chosen-single chosen-default" name="a_nationality_id" id="a_nationality_id" onchange="javascript:nationality_identity();">
                        <option value="">Select Nationality</option>
                        <?php foreach($nationality as $row):?> 
                          <?php if (!empty($nationalty1)){             ?>
                          <option value="<?php echo $row->nationality_id;?>" <?php echo ($nationalty1 == $row->nationality_id) ? 'selected' : '' ?>> <?php echo $row->nationality_desc; ?> </option>
                        <?php }else{?>
                        <option value="<?php echo $row->nationality_id; ?>" <?php echo set_select('a_nationality_id',  $row->nationality_id); ?>><?php echo $row->nationality_desc; ?></option>
                        <?php }?> 
                        <?php endforeach;?>
                      </select>       
                      <div class="error"><?php echo form_error('a_nationality_id'); ?></div>   
                    </div>
                  </div>  

                  <hr>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 81)); ?>- </label>
                    </div>

                    <div class="col-md-4 mb-15">
                      <?php  $identity1=$partb['aidentity_proof_id'] ?? ''; ?>

                      <label for="aidentity_proof_id"><?php print_r($this->label->get_short_name($elements, 83)); ?><span class="text-danger">*</span></label>
                      <select type="text" class="form-control chosen-single chosen-default" name="aidentity_proof_id" id="aidentity_proof_id">
                        <option value=""class="chosen-single">Select Identity Document</option>
                        <?php foreach($identityproof as $row):?>
                          <?php if (!empty($identity1)){   ?>
                           <option value="<?php echo $row->identity_proof_id;?>" <?php echo ($identity1 == $row->identity_proof_id) ? 'selected' : '' ?>> <?php echo $row->Identity_proof_desc; ?> </option>
                         <?php }else{?>
                           <option value="<?php echo $row->identity_proof_id; ?>" <?php echo set_select('aidentity_proof_id',  $row->identity_proof_id); ?>><?php echo $row->Identity_proof_desc; ?></option>
                         <?php }?>

                       <?php endforeach;?>
                      </select>    
                      <div class="error"><?php echo form_error('aidentity_proof_id'); ?></div>       
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="aidentity_proof_no"><?php print_r($this->label->get_short_name($elements, 84)); ?></label>
                      <input type="text" class="form-control" name="aidentity_proof_no" id="aidentity_proof_no" value="<?php if(isset($partb)) echo $partb['aidentity_proof_no']; else echo set_value('aidentity_proof_no');?>" placeholder="" maxlength="200">
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="aidentity_proof_doi"><?php print_r($this->label->get_short_name($elements, 85)); ?></label>
                      <input type="text" class="form-control" name="aidentity_proof_doi" value="<?php if(isset($partb)) echo get_displaydate($partb['aidentity_proof_doi']); else echo set_value('aidentity_proof_doi'); ?>" id="aidentity_proof_doi" placeholder="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label for="aidentity_proof_vupto"><?php print_r($this->label->get_short_name($elements, 86)); ?></label>
                      <input type="text" class="form-control" name="aidentity_proof_vupto" id="aidentity_proof_vupto" value="<?php if(isset($partb)) echo get_displaydate($partb['aidentity_proof_vupto']); else echo set_value('aidentity_proof_vupto'); ?>" placeholder="">
                    </div>

                    <div class="col-md-4 mb-15">
                     <label for="aidentity_proof_iauth"><?php print_r($this->label->get_short_name($elements, 87)); ?></label>
                     <input type="text" class="form-control" name="aidentity_proof_iauth" id="aidentity_proof_iauth" value="<?php  if(isset($partb)) echo $partb['aidentity_proof_iauth']; else echo set_value('aidentity_proof_iauth');?>" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="1000">
                    </div>

                    <?php  $identity_upload=$partb['identity_url_partb'] ?? ''; ?>
                    <div class="col-md-4 mb-15">
                      <label for="identity_proof_upload" class="col-md-12"><?php print_r($this->label->get_short_name($elements, 88)); ?><span class="text-danger">*</span></label>
                      <input type="file" id="identity_proof_upload" name="identity_proof_upload" class="form-control"> 
                      <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
                      <div class="error" id="identity_proof_upload_error"><?php echo form_error('identity_proof_upload'); ?></div>   
                      <div>
                        <?php if($identity_upload !='')  {?>
                        <a href="<?php echo base_url();?><?php echo $identity_upload; ?>" target="_blank" alt="">show Uploaded document </a>
                        <?php } ?>
                      </div>  
                    </div> 
                   
                    
                  </div>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 112)); ?>-</label>
                    </div>

                    <?php $idress=$partb['aidres_proof_id'] ?? ''; ?>
                    <div class="col-md-4 mb-15">
                      <label for="aidres_proof_id"><?php print_r($this->label->get_short_name($elements, 113)); ?><span class="text-danger">*</span></label>  
                      <select type="text" class="form-control chosen-single chosen-default" name="aidres_proof_id" id="aidres_proof_id">
                        <option value=""class="chosen-single">Select Residence Proof Document</option>
                        <?php foreach($residenceproof as $row):?>

                        <?php if (!empty($idress)){             ?>
                         <option value="<?php echo $row->idres_proof_id;?>" <?php echo ($idress == $row->idres_proof_id) ? 'selected' : '' ?>> <?php echo $row->idres_proof_desc; ?> </option>
                        <?php }else{?>

                        <option value="<?php echo $row->idres_proof_id; ?>" <?php echo set_select('aidres_proof_id',  $row->idres_proof_id); ?>><?php echo $row->idres_proof_desc; ?></option>
                        <?php }?>

                        <?php endforeach;?>
                      </select>      
                      <div class="error"><?php echo form_error('aidres_proof_id'); ?></div>    
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="aidres_proof_no"><?php print_r($this->label->get_short_name($elements, 114)); ?></label>
                      <input type="text" class="form-control" name="aidres_proof_no" id="aidres_proof_no" value="<?php   if(isset($partb)) echo $partb['aidres_proof_no']; else echo set_value('aidres_proof_no');?>" placeholder="" maxlength="200">
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="aidres_proof_doi"><?php print_r($this->label->get_short_name($elements, 115)); ?></label>
                      <input type="text" class="form-control" name="aidres_proof_doi" id="aidres_proof_doi" value="<?php if(isset($partb)) echo get_displaydate($partb['aidres_proof_doi']); else echo set_value('aidres_proof_doi');?>" placeholder="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label for="aidres_proof_vupto"><?php print_r($this->label->get_short_name($elements, 116)); ?></label>
                      <input type="text" class="form-control" name="aidres_proof_vupto" id="aidres_proof_vupto" value="<?php if(isset($partb)) echo get_displaydate($partb['aidres_proof_vupto']); else echo set_value('aidres_proof_vupto'); ?>" placeholder="">
                    </div>


                    <div class="col-md-4 mb-15">
                     <label for="aidres_proof_iauth"><?php print_r($this->label->get_short_name($elements, 117)); ?></label>
                     <input type="text" class="form-control" name="aidres_proof_iauth" id="aidres_proof_iauth" value="<?php if(isset($partb)) echo $partb['aidres_proof_iauth']; else echo set_value('aidres_proof_iauth');?>" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="1000">
                    </div>

                    <?php  $residence_upload=$partb['residence_url_partb'] ?? ''; ?>
                    <div class="col-md-4 mb-15">
                      <label for="aidres_proof_upload"><?php print_r($this->label->get_short_name($elements, 118)); ?><span class="text-danger">*</span></label>
                      <input type="file" id="aidres_proof_upload" name="aidres_proof_upload" class="form-control" size="20"> 
                      <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
                      <div class="error" id="aidres_proof_upload_error"><?php echo form_error('aidres_proof_upload'); ?></div>   
                      <div>
                        <?php if($residence_upload !='')  {?>
                        <a href="<?php echo base_url();?><?php echo $residence_upload; ?>" target="_blank" alt="">show Uploaded document </a>
                        <?php } ?>
                      </div>  
                    </div> 

                    
                  </div>
                  
                  <hr>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 89)); ?>-</label>
                    </div>
                    <div class="col-md-4 mb-15">
                      <label for="ap_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="ap_hpnl"  id="ap_hpnl" value="<?php  if(isset($partb)) echo $partb['ap_hpnl']; else echo set_value('ap_hpnl');?>" maxlength="1000" placeholder="">
                      <div class="error"><?php echo form_error('ap_hpnl'); ?></div>    
                    </div>      

                    <div class="col-md-4 mb-15">
                      <label for="ap_vill_city"><?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>   
                      <input type="text" class="form-control" name="ap_vill_city" id="ap_vill_city" maxlength="1000" onkeypress="return ValidateAlpha(event)" value="<?php  if(isset($partb)) echo $partb['ap_vill_city']; else echo set_value('ap_vill_city');?>" placeholder="">
                      <div class="error"><?php echo form_error('ap_vill_city'); ?></div>         
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="ap_state_id">State<span class="text-danger">*</span></label>  
                      <select class="form-control chosen-single chosen-default" name="ap_state_id" id="ap_state_id" onChange="pageRefesh1(this.value);" >
                       <option value="">Select state</option>       
                       <?php foreach($state as $row):?>
                        <?php if (!empty($state1)){ ?>
                         <option value="<?php echo $row->state_code;?>" <?php echo ($state1 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
                       <?php }else{?>
                        <option value="<?php echo $row->state_code; ?>" <?php echo set_select('ap_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
                        <?php }?>
                      <?php endforeach;?>
                      </select>  
                      <div class="error"><?php echo form_error('ap_state_id'); ?></div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label for="ap_dist_id">District<span class="text-danger">*</span></label>
                      <select class="form-control chosen-single chosen-default" name="ap_dist_id" id="ap_dist_id">  
                      </select>
                      <div class="error"><?php echo form_error('ap_dist_id'); ?></div>
                    </div>  
           
                    <div class="col-md-4 mb-15">
                     <label for="ap_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?></label>   
                     <input type="text" class="form-control" name="ap_pin_code" id="ap_pin_code"  value="<?php if(isset($partb)) echo $partb['ap_pin_code']; else echo set_value('ap_pin_code');?>" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder=""> 
                    </div>
                    <div class="col-md-4 mb-15">
                      <?php $nationalty2=$partb['ap_country_id'] ?? ''; ?>
                      <label for="ap_country_id"><?php print_r($this->label->get_short_name($elements, 119)); ?><span class="text-danger">*</span></label>  
                      <select type="text" class="form-control chosen-single chosen-default" name="ap_country_id" id="ap_country_id">
                        <option value=""class="chosen-single">Select Country</option>
                        <?php foreach($getcountry as $row):?>

                          <?php if (!empty($nationalty2)){             ?>
                           <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty2 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
                         <?php }else{?>
                           <option value="<?php echo $row->country_id; ?>" <?php echo set_select('ap_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                         <?php }?>
                       <?php endforeach;?>

                      </select>  
                      <div class="error"><?php echo form_error('ap_country_id'); ?></div>      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-info">
                        <input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)" />
                        <em>For same address please check this box.</em>
                      </div>
                    </div>
                  </div>

                  <div class="row"> 
                    <div class="col-md-12">
                      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 96)); ?> -</label>
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="ac_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="ac_hpnl" id="ac_hpnl" value="<?php  if(isset($partb)) echo $partb['ac_hpnl']; else echo set_value('ac_hpnl');?>" maxlength="1000" placeholder="">
                      <div class="error"><?php echo form_error('ac_hpnl'); ?></div>      
                    </div>      
                    <div class="col-md-4 mb-15">
                      <label for="ac_vill_city"> <?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>      
                      <input type="text" class="form-control" name="ac_vill_city" id="ac_vill_city" maxlength="50" onkeypress="return ValidateAlpha(event)" value="<?php  if(isset($partb)) echo $partb['ac_vill_city']; else echo set_value('ac_vill_city');?>" placeholder="">   
                      <div class="error"><?php echo form_error('ac_vill_city'); ?></div>           
                    </div>
                    <div class="col-md-4 mb-15">
                      <label for="ac_state_id" class="control-label">State<span class="text-danger">*</span></label>  
                      <select type="text" class="form-control chosen-single chosen-default" name="ac_state_id" id="ac_state_id" onChange="pageRefesh2(this.value);" >
                        <option value="">Select state</option>
                        <?php foreach($state as $row):?>
                          <?php if (!empty($state3)){ ?>
                           <option value="<?php echo $row->state_code;?>" <?php echo ($state3 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
                         <?php }else{?>
                          <option value="<?php echo $row->state_code; ?>" <?php echo set_select('ac_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
                        <?php }?>
                        <?php endforeach;?>
                      </select>   
                      <div class="error"><?php echo form_error('ac_state_id'); ?></div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label for="ac_dist_id">District<span class="text-danger">*</span></label>
                      <select type="text" class="form-control chosen-single chosen-default" name="ac_dist_id" id="ac_dist_id">                    
                      </select>
                      <div class="error"><?php echo form_error('ac_dist_id'); ?></div>
                    </div>  

                    <div class="col-md-4 mb-15">
                     <label for="ac_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?><span class="text-danger">*</span></label>   
                     <input type="text" class="form-control" name="ac_pin_code" id="ac_pin_code" maxlength="6"  onkeypress="return isNumberKey(event)" value="<?php  if(isset($partb)) echo $partb['ac_pin_code']; else echo set_value('ac_pin_code');?>" placeholder=""> 
                     <div class="error"><?php echo form_error('ac_pin_code'); ?></div>
                    </div>
                    <div class="col-md-4 mb-15">
                      <?php $nationalty2=$partb['ac_country_id'] ?? ''; ?>

                      <label for="ac_country_id"><?php print_r($this->label->get_short_name($elements, 119)); ?><span class="text-danger">*</span></label>  
                      <select type="text" class="form-control chosen-single chosen-default" name="ac_country_id" id="ac_country_id">
                      <option value=""class="chosen-single">Select Country</option>
                      <?php foreach($getcountry as $row):?>

                        <?php if (!empty($nationalty2)){             ?>
                         <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty2 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
                       <?php }else{?>
                         <option value="<?php echo $row->country_id; ?>" <?php echo set_select('ac_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                       <?php }?>
                       <?php endforeach;?>
                      </select> 
                      <div class="error"><?php echo form_error('ac_country_id'); ?></div>         
                    </div>
                  </div>

                  <hr>

                  <div class="row"> 
                    <div class="col-md-6 mb-15">
                      <label class="text-orange" for="aoccu_desig_avo"><?php print_r($this->label->get_short_name($elements, 99)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="aoccu_desig_avo" id="aoccu_desig_avo" onkeypress="return ValidateAlpha(event)"  value="<?php  if(isset($partb)) echo $partb['aoccu_desig_avo']; else echo set_value('aoccu_desig_avo');?>" placeholder="" maxlength="1000">
                      <div class="error"><?php echo form_error('aoccu_desig_avo'); ?></div>  
                    </div>

                    <div class="col-md-6 mb-15">
                      <label class="text-orange" for="atel_no"><?php print_r($this->label->get_short_name($elements, 100)); ?></label>
                      <input type="text" class="form-control" name="atel_no" id="atel_no" maxlength="15" value="<?php if(isset($partb)) echo $partb['atel_no']; else echo set_value('atel_no');?>" onkeypress="return isNumberKey(event)" placeholder="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-15">
                      <label for="amob_no"><?php print_r($this->label->get_short_name($elements, 101)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="amob_no" id="amob_no" maxlength="10"  onkeypress="return isNumberKey(event)" value="<?php if(isset($partb)) echo $partb['amob_no']; else echo set_value('amob_no');?>" placeholder="">
                      <div class="error"><?php echo form_error('amob_no'); ?></div> 
                    </div>
                    <div class="col-md-6 mb-15">
                      <label class="text-orange" for="email_id"><?php print_r($this->label->get_short_name($elements, 102)); ?><span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="email_id" id="email_id" required="required" value="<?php   if(isset($partb)) echo $partb['email_id']; else echo set_value('email_id');?>" placeholder="" maxlength="500">
                      <div class="error"><?php echo form_error('email_id'); ?></div>  
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <?php $auth_doc=$partb['auth_doc_encl'] ?? ''; ?>
                    <div class="col-md-6 mb-15">
                      <label class="text-orange" for="auth_doc_encl"><?php print_r($this->label->get_short_name($elements, 103)); ?><span class="text-danger">*</span></label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="auth_doc_encl" id="Active" required="required" value="1" <?php if ($auth_doc=="1"){echo "checked=checked";}?> checked="checked">
                          Yes
                        </label>
                        <label>
                          <input type="radio" name="auth_doc_encl" id="Inactive" required="required" value="2" <?php if ($auth_doc=="2"){echo "checked=checked";}?>>
                          No
                        </label>
                      </div>
                    </div>

                    <?php 
                    $auth_doc_upload=$partb['auth_doc_upload'] ?? ''; ?>
                    <div class="col-md-6 mb-15">
                      <label for="auth_doc_upload">Upload Authorization Document <span class="text-danger">*</span></label>
                      <input type="file" id="auth_doc_upload" name="auth_doc_upload" class="form-control" size="20">
                      <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
                      <div class="error" id="auth_doc_upload_error"><?php echo form_error('auth_doc_upload'); ?></div> 
                      <div><?php if($auth_doc_upload !='')  {?>
                       <a href="<?php echo base_url();?><?php echo $auth_doc_upload; ?>" target="_blank" alt="">show Uploaded document </a>
                       <?php } ?></div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-orange">15. Details of third party, if any, likely to be affected by the complaint -</label>
                      <div class="alert alert-info">
                        <strong>Note:</strong> Details of third party/ parties, if aware, whose interests are likely to be prejudicially affected by the said complaint as contemplated under Section 21 of the Act may also be separately furnished.
                        <button type="button" class="btn btn-primary" onclick="window.open('<?php echo site_url("applet/additionalparty");?>')">Click here</button>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 text-right">       
                      <button type="submit" class="btn btn-success" id="submitbtn">Save as Draft</button>
                      <button type="submit" class="btn btn-success" id="submitbtn">Save & Next</button>
                    </div>
                  </div>     
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script> 
<script type="text/javascript">
  //console.log(11);
  window.onload = function() {

   nationality_identity();

   if (document.getElementById('orgn_referred_india').checked) {
    test = document.getElementById('orgn_referred_india').value;
  //console.log(rate_value);
  if(test == 1){

    $("div.certdiv").show();
    $("div.namecert_div").show();
  }else if(test == 2){
   $("div.certdiv").hide();
   $("div.namecert_div").hide();
 }
}
var state2 ="<?= $state2; ?>"; 
var state1 ="<?= $state1; ?>"; 
var state3 ="<?= $state3; ?>"; 

if(state2 != '' )  {
  pageRefesh(state2); 
}
if(state1 != '' )  {
  pageRefesh1(state1); 
} 
if(state3 != '' )  {
  pageRefesh2(state3);
} 

$("input[name$='orgn_referred_india']").click(function() {
  var test = $(this).val();

  if(test == 1){

    $("div.certdiv").show();
    $("div.namecert_div").show();
  }else if(test == 2){
   $("div.certdiv").hide();
   $("div.namecert_div").hide();
 }
});

};

</script>

<script language="javascript"> 
  function pageRefesh(value)
  {
    var dist_id_selected = "<?= $odistid; ?>";
    var post_url= '<?php echo base_url('user/getdistrict1')?>';
    var request_method= 'POST';
    $("#o_dist_id").html('');
    $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+value,
    success: function(response){
      $("#o_dist_id").append(response); 
      if(dist_id_selected == ''){
        dist_id_selected = '<?php echo @$_POST["o_dist_id"];?>';//$('#p_dist_id').val();
      }
      $("#o_dist_id").val(dist_id_selected);  
      }    
      });
    
  }
  function pageRefesh1(value)
  {

     // alert(value.value);
     var dist_id_selected = "<?= $ap_dist; ?>";
     var post_url= '<?php echo base_url('user/getdistrict1')?>';
     var request_method= 'POST';
     $("#ap_dist_id").html('');
     $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+value,
    success: function(response){
      $("#ap_dist_id").append(response);  
      $("#ap_dist_id").val(dist_id_selected); 
      }     
    });
  }
  function pageRefesh2(state_id)
  {
    var db_c_dist_id = "<?= $c_dist_id; ?>";
    var post_url= '<?php echo base_url('user/getdistrict1')?>';
    var request_method= 'POST';
    $("#ac_dist_id").html('');
    $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+state_id,
      success: function(response){ //
        $("#ac_dist_id").append(response);
        if(db_c_dist_id !=''){
          $("#ac_dist_id").val(db_c_dist_id); 
        }else{
          $("#ac_dist_id").val($("[name='ap_dist_id']").val());
        }
      }
      });
    }

    function FillBilling(f) {
      if(f.billingtoo.checked == true) { 
       pageRefesh2(f.ap_state_id.value);   
   // f.ac_add1.value = f.ap_add1.value;
   f.ac_hpnl.value = f.ap_hpnl.value;
   f.ac_state_id.value=f.ap_state_id.value;
   f.ac_dist_id.value=f.ap_dist_id.value;
   f.ac_pin_code.value=f.ap_pin_code.value;
   f.ac_country_id.value=f.ap_country_id.value;
   f.ac_vill_city.value=f.ap_vill_city.value;
 }else{
      // $('#ac_add1').val('');
      $('#ac_hpnl').val('');
      $('#ac_pin_code').val('');
      $('#ac_country_id').val('');
      $('#ac_vill_city').val('');
      $('#ac_state_id').val('');
      $('#ac_dist_id').val('');
    }

  }

  var idleTime = 0;
  function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 1) { // 2 minutes
      alert('Please save your progress!');
    }
  }

  $(document).ready(function(){

          //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
      idleTime = 0;
    });
    $(this).keypress(function (e) {
      idleTime = 0;
    });


    setInterval(function(){
      alert('Please save your progress');

    },60000*5); 


    $("#submitbtn").click(function(){        
        $("#appletfilingform").submit(); // Submit the form
      });
  });


  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#appletfilingform").validate({
 
      onkeyup: false,

      rules: {  
       // orgn_referred_india: "required",   
        //cert_regInc_encl: "required",
        a_salutation_id:"required",
        o_country_id:"required",
        o_state_id:"required",
        o_dist_id:"required",
        nationality_id: "required",
        a_gender_id:"required",
        h_salutation_id:"required",
        h_first_name:"required",
        a_nationality_id:"required",
        a_first_name:"required",
        //aidentity_proof_vupto:"required",
        //aidentity_proof_doi:"required",
        ap_state_id:"required",
        ap_dist_id:"required",
        o_promob_no:"required",
        ap_country_id:"required",
        //aidres_proof_doi:"required",
        ac_state_id:"required",
        ac_dist_id:"required",
        //aidres_proof_vupto:"required",
        aidentity_proof_id:"required",
        ac_country_id:"required",
        amob_no:"required",
        a_age_years:"required",
       // auth_doc_encl:"required",
       // affect_3rdparty:"required",
        aidres_proof_id:"required",
        affect_office_beared:"required",
        notory_affi_annex:"required",
        complainant_victim:"required",
        orgn_referred_india:"required",
        auth_ireginc:"required",
        aoccu_desig_avo:"required",
        o_hpnl:"required",
        o_vill_city:"required",
        o_pin_code:"required",
        ap_hpnl:"required",
        ap_vill_city:"required",
        ap_pin_code:"required",
        ac_hpnl:"required",
        ac_vill_city:"required",
        ac_pin_code:"required",

        o_email_id: {
                email: true,          
        },

       email_id: {
                email: true,          
        },
           
        username: {
          required: true,
          minlength: 6,
          maxlength:12,     
         
        },
        password: {
          required: true,
          minlength: 8
        },
        confirm_password: {
          //required: false,
         // minlength: 8,
          equalTo: "#password"
        },
        a_co_email_id: {
                    email: true,          
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },

        phone:{ 
          required:true,
          minlength:10,
          maxlength:10

        },

        identity_proof_upload: {required: true, accept: "application/pdf"},
        aidres_proof_upload: {required: true, accept: "application/pdf"},
        auth_doc_upload: {required: true, accept: "application/pdf"},

        gender: { // <- NAME of every radio in the same group
            required: true
        },

        agree: "required",
        //identity_proof_upload:{ accept: "application/pdf" },
        //aidres_proof_upload:{ accept: "application/pdf" },
        //auth_doc_upload:{ accept: "application/pdf" }
      },



      messages: {
        groups_err: "Please select roll",
        fname_err: "Please enter your firstname",
        //lname_err: "Please enter your lastname",
        username_err: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 6 characters",
          remote: "UserName Already Exist"
        },
        password_err: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long"
        },
        cpassword_err: {
         // required: "Please provide a password",
          minlength: "Your confirm password must same as password",
          equalTo: "Please enter the same password as above"
        },
        email_err: {
          required: "Please provide a email address",
           email: "Please enter a valid email address",
           remote: "email address Already Exist"
        },
        phone_err: {
          required: "Please provide a phone no",
          minlength: "Your phone no must be at least 10 digit number",
          maxlength: "Your phone no must be at least 10 digit number"
        },
        gender_err: {
          required: "Please select at least one gender"
        },
        identity_proof_upload:{ accept: "Only pdf format are allowed" },
        aidres_proof_upload:{ accept: "Only pdf format are allowed" },
        auth_doc_upload:{ accept: "Only pdf format are allowed" }
      }
    });
    
  });
  

</script>

<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
             autoclose: true,  
             $('#aidentity_proof_doi').datepicker({
              format: "dd-mm-yyyy"
            });  

           });

            $('#aidentity_proof_doi').datepicker({
              format: "dd-mm-yyyy",
              endDate: new Date(),
              autoclose: true,
              todayHighlight: true

            });

            $(document).ready(function () {
             autoclose: true,  
             $('#aidentity_proof_vupto').datepicker({
              format: "dd-mm-yyyy"
            });  

           });


            $('#aidentity_proof_vupto').datepicker({
              format: "dd-mm-yyyy",
              startDate: '-0d',
              autoclose: true,
              todayHighlight: true

            }); 
            $(document).ready(function () {
             autoclose: true,  
             $('#aidres_proof_doi').datepicker({
              format: "dd-mm-yyyy"
            });  

           });


            $('#aidres_proof_doi').datepicker({
              format: "dd-mm-yyyy",
              endDate: new Date(),
              autoclose: true,
              todayHighlight: true

            });

            $(document).ready(function () {
             autoclose: true,  
             $('#aidres_proof_vupto').datepicker({
              format: "dd-mm-yyyy"
            });  

           });

            $('#aidres_proof_vupto').datepicker({
              format: "dd-mm-yyyy",
              startDate: '-0d',
              autoclose: true,
              todayHighlight: true

            });

            $('#a_date_of_issue').datepicker({
              format: "yyyy-mm-dd",
              endDate: new Date(),
              autoclose: true,
              todayHighlight: true

            }); 

            function isNumberKey(evt){
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
              return true;
            }

            function ValidateAlpha(evt)
            {
              var keyCode = (evt.which) ? evt.which : evt.keyCode
              if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

                return false;
              return true;
            }

            function nationality_identity()
            {     
              let nationality = $('#a_nationality_id').children("option:selected").val();
              if(nationality == 2){        
                document.getElementById("aidentity_proof_id").selectedIndex = "11"; 

                $("#aidentity_proof_id").css("pointer-events","none");              
              }else if(nationality == 1){
              //document.getElementById("identity_proof_id").selectedIndex = ""; 
               //$('#identity_proof_id').attr("readonly", false);
               $("#aidentity_proof_id").css("pointer-events","");
             }
           }


         </script>

         <script type="text/javascript">
  $('input#identity_proof_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#identity_proof_upload_error').text('Identity proof file must be less then 20 MB');
    return false;
  }else{
    $('#identity_proof_upload_error').text('');
  }
});

   $('input#aidres_proof_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#aidres_proof_upload_error').text('Residence proof file must be less then 20 MB');
    return false;
  }else{
    $('#aidres_proof_upload_error').text('');
  }
});

   $('input#auth_doc_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#auth_doc_upload_error').text('Authorized document file must be less then 20 MB');
    return false;
  }else{
    $('#auth_doc_upload_error').text('');
  }
});
    </script>


<?php //die;?>  



