<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php
//print_r($user_profile);die;
//$r = $this->session->userdata('ref_no');
//$u = $user['id'];
//echo get_complaint_no($r, $u);
$elements = $this->label->view(1);
//print "<pre>";
//print_r($elements);
//print "</pre>";
//print_r($this->label->view(1));


if(isset($farma))
{
  $myArray=(array)$farma;

  //echo "<pre>";
  //print_r($myArray);

  $myArray[0]->first_name;
  $myArray[0]->age_years;
  $myArray[0]->fath_name;
  $myArray[0]->comp_f_place;
  $myArray[0]->complaintmode_id;
  $state1=$myArray[0]->p_state_id ?? '';
  $state3=$myArray[0]->c_state_id ?? '';
  $p_dist_id=$myArray[0]->p_dist_id ?? '';
  $c_dist_id=$myArray[0]->c_district_id ?? '';


}else{
  $state1= '';
  $state3='';
  $p_dist_id= '';
  $c_dist_id= '';
}
?>


<?php 

//echo $this->uri->segment(1);  exit;?>

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
          <div class="panel-heading text-center">FORM OF COMPLAINT : (PART - A)</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">

          <form id="filingform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>filing/create'  name="filingform" enctype="multipart/form-data">
            <div class="form_error">
              <?php //echo validation_errors(); ?>
            </div>

            <div class="alert alert-danger"><h4 class="m-0">DETAILS TO BE FURNISHED BY THE COMPLAINANT/ SIGNATORY TO THE COMPLAINT</h4></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 mb-15">
                <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 60)); ?><span style="color: red;">*</span></label>
                <select type="text" class="form-control" name="complaint_capacity_id" id="complaint_capacity_id">

                <?php
                  $capicity =$myArray[0]->complaint_capacity_id ?? '';
                ?>
                <option value="">-- Select --</option>
                <?php foreach($complainant_type as $row):?>
                <?php if (!empty($capicity)){             ?>
                <option value="<?php echo $row->complaint_capacity_id;?>" <?php echo ($capicity == $row->complaint_capacity_id) ? 'selected' : '' ?>> <?php echo $row->complaint_capacity_desc; ?> </option>
                <?php }else{?>        
                <option value="<?php echo $row->complaint_capacity_id; ?>" <?php echo set_select('complaint_capacity_id',  $row->complaint_capacity_id); ?>><?php echo $row->complaint_capacity_desc; ?></option>                                  
                <?php } endforeach;?>
                </select> 
                <span><?php echo form_error('complaint_capacity_id'); ?></span>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 54)); ?></label>
                <?php 
                  if(isset($user_profile[0]->salutation_id) && $user['role'] == 18){ $sal = $user_profile[0]->salutation_id;
                  }else{
                  $sal=$myArray[0]->salutation_id ?? '';
                  }
                ?>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-4 mb-15">
                    <label for="salutation_id" ><?php print_r($this->label->get_short_name($elements, 10)); ?><span class="text-danger">*</span></label>    
                    <select type="text" class="form-control" name="salutation_id" id="salutation_id" <?php if(isset($user_profile[0]->salutation_id) && $user['role'] == 18) echo 'disabled="true"'; ?>>
                      <option value="">Select Title</option>
                      <?php foreach($salution as $row):?>          
                        <?php if (!empty($sal)){             ?>
                       <option value="<?php echo $row->salutation_id;?>" <?php echo ($sal == $row->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
                     <?php }else{?>
                      <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
                    <?php }?>
                      <?php endforeach;?>
                    </select>  
                    <div><?php echo form_error('salutation_id'); ?></div> 
                  </div>
                  <div class="col-lg-2 col-md-5 col-sm-4 mb-15">
                    <label for="sur_name"><?php print_r($this->label->get_short_name($elements, 11)); ?></label>       
                    <input type="text" class="form-control" name="sur_name" id="sur_name" <?php if(isset($user_profile[0]->last_name) && $user['role'] == 18) echo 'readonly'; ?> value="<?php if(isset($user_profile[0]->last_name) && isset($user['role']) == 18){ echo $user_profile[0]->last_name;
                  }else{ set_value('mid_name', @$myArray[0]->sur_name); } ?>" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()"> 
                  </div>
                  <div class="col-lg-2 col-md-5 col-sm-4 mb-15">
                    <label for="mid_name"><?php print_r($this->label->get_short_name($elements, 12)); ?></label>      
                    <input type="text" class="form-control" name="mid_name" id="mid_name" <?php if(isset($user_profile[0]->middle_name) && $user['role'] == 18) echo 'readonly'; ?> value="<?php if(isset($user_profile[0]->middle_name) && $user['role'] == 18){ echo $user_profile[0]->middle_name;
                  }else{  echo set_value('mid_name', @$myArray[0]->mid_name); } ?>" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()"> 
                  </div>
                  <div class="col-lg-3 col-md-7 col-sm-6 mb-15">
                    <label for="first_name"><?php print_r($this->label->get_short_name($elements, 13)); ?><span class="text-danger">*</span> </label>       
                    <input type="text" class="form-control" name="first_name" id="first_name" maxlength="50" <?php if(isset($user_profile[0]->first_name) && $user['role'] == 18) echo 'readonly'; ?>
          value="<?php if(isset($user_profile[0]->first_name) && $user['role'] == 18){
                      echo $user_profile[0]->first_name;
                  }else{ echo set_value('first_name', @$myArray[0]->first_name); } ?>" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">     
                    <div class="error"><?php echo form_error('first_name'); ?></div> 
                  </div>
                  <div class="col-lg-3 col-md-5 col-sm-6 mb-15">
                    <label for="fath_name"><?php print_r($this->label->get_short_name($elements, 16)); ?> </label>     
                    <input type="text" class="form-control" name="fath_name" id="fath_name" value="<?php echo set_value('fath_name', @$myArray[0]->fath_name); ?>" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="">  
                  </div>
                </div>
              </div>
            </div>

         
          
        <div class="row">
         
          <div class="col-lg-3 col-md-4 col-sm-6 mb-15">   
           <?php $gender1=$myArray[0]->gender_id ?? ''; ?>                
            <label class="text-orange" for="gender_id"><?php print_r($this->label->get_short_name($elements, 14)); ?><span class="text-danger">*</span></label>    
            <select type="text" class="form-control" class="chosen-single chosen-default" name="gender_id" 
            id="gender_id">
            <option value="">Select gender</option>
            <?php foreach($gender as $row):?>       
              <?php if (!empty($gender1)){             ?>
                 <option value="<?php echo $row->gender_id;?>" <?php echo ($gender1 == $row->gender_id) ? 'selected' : '' ?>> <?php echo $row->gender_desc; ?> </option>
               <?php }else{?>
                <option value="<?php echo $row->gender_id; ?>" <?php echo set_select('gender_id',  $row->gender_id); ?>><?php echo $row->gender_desc; ?></option>
              <?php }?>
            <?php endforeach;?>
            </select>  
            <div class="error"><?php echo form_error('gender_id'); ?></div>       
          </div>
          <div class="col-lg-3 col-md-8 col-sm-6 mb-15">
            <label class="text-orange" for="age_years"><?php print_r($this->label->get_short_name($elements, 15)); ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="age_years" maxlength="3" value="<?php echo set_value('age_years', @$myArray[0]->age_years); ?>" id="age_years" onkeypress="return isNumberKey(event)" value="<?php echo set_value('age_years'); ?>" placeholder=""> 
             <div class="error"><?php echo form_error('age_years'); ?></div>         
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12 mb-15">  
            <?php $nationalty1=$myArray[0]->nationality_id ?? ''; ?>
            <label class="text-orange" for="nationality_id"><?php print_r($this->label->get_short_name($elements, 17)); ?><span class="text-danger">*</span></label>    
            <select type="text" class="form-control" name="nationality_id" id="nationality_idsss" onchange="javascript:nationality_identity();">
              <option value="">Select Nationality</option>
              <?php foreach($nationality as $row):?> 
              <?php if (!empty($nationalty1)){             ?>
              <option value="<?php echo $row->nationality_id;?>" <?php echo ($nationalty1 == $row->nationality_id) ? 'selected' : '' ?>> <?php echo $row->nationality_desc; ?> </option>
              <?php }else{?>
              <option value="<?php echo $row->nationality_id; ?>" <?php echo set_select('nationality_id',  $row->nationality_id); ?>><?php echo $row->nationality_desc; ?></option>
              <?php }?>       
              <?php endforeach;?>
            </select>    
            <div class="error"><?php echo form_error('nationality_id'); ?></div>    
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 55)); ?> <small class="text-theme">(@ attach an identity proof as per serial number 6.)</small></label>  
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php  $identity1=$myArray[0]->identity_proof_id ?? ''; ?>
                <label for="identity_proof_id"><?php print_r($this->label->get_short_name($elements, 18)); ?><span class="text-danger">*</span></label>   
                <select type="text" class="form-control" name="identity_proof_id" id="identity_proof_id">
                <option value="" class="chosen-single">Select Identity Document</option>
                <?php foreach($identityproof as $row):?>
                  <?php if (!empty($identity1)){   ?>
                       <option value="<?php echo $row->identity_proof_id;?>" <?php echo ($identity1 == $row->identity_proof_id) ? 'selected' : '' ?>> <?php echo $row->Identity_proof_desc; ?> </option>
                     <?php }else{?>
                 <option value="<?php echo $row->identity_proof_id; ?>" <?php echo set_select('identity_proof_id',  $row->identity_proof_id); ?>><?php echo $row->Identity_proof_desc; ?></option>
                    <?php }?>
                <?php endforeach;?>
                </select>  
                <div class="error"><?php echo form_error('identity_proof_id'); ?></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="identity_proof_no"><?php print_r($this->label->get_short_name($elements, 19)); ?></label>
                <input type="text" class="form-control" name="identity_proof_no" value="<?php echo set_value('identity_proof_no', @$myArray[0]->identity_proof_no); ?>" id="identity_proof_no" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="identity_proof_doi"><?php print_r($this->label->get_short_name($elements, 20)); ?></label>
                <input type="text" class="form-control" name="identity_proof_doi" id="identity_proof_doi" value="<?php echo set_value('identity_proof_doi', @$myArray[0]->identity_proof_doi); ?>"placeholder=""> 
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="identity_proof_vupto"><?php print_r($this->label->get_short_name($elements, 21)); ?></label>
                <input type="text" class="form-control" name="identity_proof_vupto" id="identity_proof_vupto" value="<?php echo set_value('identity_proof_vupto', @$myArray[0]->identity_proof_vupto); ?>" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="identity_proof_iauth"><?php print_r($this->label->get_short_name($elements, 22)); ?></label>
                <input type="text" class="form-control" name="identity_proof_iauth" value="<?php echo set_value('age_years', @$myArray[0]->identity_proof_iauth); ?>" id="identity_proof_iauth" onkeypress="return ValidateAlpha(event)" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php    $identity_upload=$myArray[0]->identity_url_parta ?? ''; ?>
                <label for="identity_proof_upload"><?php print_r($this->label->get_short_name($elements, 23)); ?><span class="text-danger">*</span></label>
                <input type="file" id="identity_proof_upload" name="identity_proof_upload" class="form-control" accept=".pdf" size="20">
                <span class="text-danger">The File should not greater than 20 MB(Only pdf file allowed)</span>
                <div class="error" id="identity_proof_upload_error"><?php echo form_error('identity_proof_upload'); ?></div>    
                <label><?php if($identity_upload !='')  {?>
                <a href="<?php echo base_url();?><?php echo $identity_upload; ?>" target="_blank" alt="">show Uploaded document </a>
                  <?php } ?>
                </label>
              </div>
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 56)); ?></label>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php $idress=$myArray[0]->idres_proof_id ?? ''; ?>
                <label for="idres_proof_id"><?php print_r($this->label->get_short_name($elements, 24)); ?><span style="color: red;">*</span></label>  
                <select type="text" class="form-control chosen-single chosen-default" name="idres_proof_id" id="idres_proof_id">
                  <option value=""class="chosen-single">Select Residence Document</option>
                  <?php foreach($residenceproof as $row):?>

                  <?php if (!empty($idress)){             ?>
                  <option value="<?php echo $row->idres_proof_id;?>" <?php echo ($idress == $row->idres_proof_id) ? 'selected' : '' ?>> <?php echo $row->idres_proof_desc; ?> </option>
                  <?php }else{?>

                  <option value="<?php echo $row->idres_proof_id; ?>" <?php echo set_select('idres_proof_id',  $row->idres_proof_id); ?>><?php echo $row->idres_proof_desc; ?></option>
                  <?php }?>
                <?php endforeach;?>
                </select> 
                <div class="error"><?php echo form_error('idres_proof_id'); ?></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="idres_proof_no"><?php print_r($this->label->get_short_name($elements, 25)); ?></label>
                <input type="text" class="form-control" name="idres_proof_no" id="idres_proof_no" value="<?php echo set_value('idres_proof_no', @$myArray[0]->idres_proof_no); ?>" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="idres_proof_doi"><?php print_r($this->label->get_short_name($elements, 26)); ?></label> 
                <input type="text" class="form-control" name="idres_proof_doi" id="idres_proof_doi" value="<?php echo set_value('idres_proof_doi', @$myArray[0]->idres_proof_doi); ?>" placeholder="">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="idres_proof vupto"><?php print_r($this->label->get_short_name($elements, 27)); ?></label>
                <input type="text" class="form-control" name="idres_proof_vupto" id="idres_proof_vupto" value="<?php echo set_value('idres_proof_vupto', @$myArray[0]->idres_proof_vupto); ?>" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="idres_proof_iauth"><?php print_r($this->label->get_short_name($elements, 28)); ?></label>
                <input type="text" class="form-control" name="idres_proof_iauth" id="idres_proof_iauth" value="<?php echo set_value('idres_proof_iauth', @$myArray[0]->idres_proof_iauth); ?>" maxlength="50" placeholder="">
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php   $residence_upload=$myArray[0]->residence_url_parta ?? ''; ?>
                <label for="a_affidavit_upload"><?php print_r($this->label->get_short_name($elements, 30)); ?><span class="text-danger">*</span></label>
                <input type="file" id="a_affidavit_upload" name="a_affidavit_upload" class="form-control" size="20"> 
                <span class="text-danger">The File should not greater than 20 MB(Only pdf file allowed)</span>
                <div class="error" id="affidavit_proof_upload_error"><?php echo form_error('a_affidavit_upload'); ?></div>

                <label><?php if($residence_upload !='')  {?>
                <a href="<?php echo base_url();?><?php echo $residence_upload; ?>" target="_blank" alt="">show Uploaded document </a>
                <?php } ?> </label> 
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 57)); ?></label>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="p_hpnl"><?php print_r($this->label->get_short_name($elements, 32)); ?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="p_hpnl" value="<?php echo set_value('p_hpnl', @$myArray[0]->p_hpnl); ?>" id="p_hpnl" maxlength="100" placeholder="">
                <div class="error"><?php echo form_error('p_hpnl'); ?></div>
              </div>  
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="p_Add1"><?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="p_add1" value="<?php echo set_value('p_add1', @$myArray[0]->p_add1); ?>" id="p_add1" maxlength="100" placeholder="">
                <div class="error"><?php echo form_error('p_add1'); ?></div>
              </div> 
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="p_state_id"><?php print_r($this->label->get_short_name($elements, 33)); ?><span class="text-danger">*</span></label>  
                <select type="text" class="form-control chosen-single chosen-default" name="p_state_id" id="p_state_id" onChange="pageRefesh(this.value);" >
                <option value="">Select state</option>
                <?php foreach($state as $row):?>
                  <?php if (!empty($state1)){ ?>
                   <option value="<?php echo $row->state_code;?>" <?php echo ($state1 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
                 <?php }else{?>
                <option value="<?php echo $row->state_code; ?>" <?php echo set_select('p_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
                 <?php }?>
                <?php endforeach;?>
                </select> 
                <div class="error"><?php echo form_error('p_state_id'); ?></div>  
              </div> 
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="p_dist_id"><?php print_r($this->label->get_short_name($elements, 34)); ?><span class="text-danger">*</span></label>
                <select type="text" class="form-control chosen-single chosen-default" name="p_dist_id" id="p_dist_id">
                  <option value=""> Please Select District</option>
                </select>
                <div class="error"><?php echo form_error('p_dist_id'); ?></div> 
              </div> 
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="p_pin_code"><?php print_r($this->label->get_short_name($elements, 35)); ?><span class="text-danger">*</span></label>   
                <input type="text" class="form-control" name="p_pin_code" id="p_pin_code" maxlength="6" value="<?php echo set_value('p_pin_code', @$myArray[0]->p_pin_code); ?>"  onkeypress="return isNumberKey(event)" placeholder="">
                <div class="error"><?php echo form_error('p_pin_code'); ?></div> 
              </div> 
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php $nationalty2=$myArray[0]->p_country_id ?? ''; ?>
                <label for="p_country_id"><?php print_r($this->label->get_short_name($elements, 36)); ?><span class="text-danger">*</span></label>   
                <select type="text" class="form-control chosen-single chosen-default" name="p_country_id" id="p_country_id">
                  <option value="" class="chosen-single">Select Country</option>
                  <?php foreach($getcountry as $row):?>
          
                  <?php if (!empty($nationalty2)){             ?>
                  <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty2 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
                  <?php }else{?>
                  <option value="<?php echo $row->country_id; ?>" <?php echo set_select('p_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                  <?php }?>
                  <?php endforeach;?>
                </select>  
                <div class="error"><?php echo form_error('p_country_id'); ?></div>
              </div>  
            </div>
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
            <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 58)); ?></label>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="c_hpnl"><?php print_r($this->label->get_short_name($elements, 38)); ?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="c_hpnl" id="c_hpnl" value="<?php echo set_value('c_hpnl', @$myArray[0]->c_hpnl); ?>" maxlength="100" placeholder="">
                <div class="error"><?php echo form_error('c_hpnl'); ?></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="c_add1"><?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="c_add1" id="c_add1" value="<?php echo set_value('c_add1', @$myArray[0]->c_add1); ?>" maxlength="100" placeholder="">
                <div class="error"><?php echo form_error('c_add1'); ?></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="c_state_id"><?php print_r($this->label->get_short_name($elements, 39)); ?><span class="text-danger">*</span></label>  
                <select type="text" class="form-control chosen-single chosen-default" name="c_state_id" id="c_state_id" onChange="pageRefesh1(this.value);" >
                  <option value="">Select state</option>
                  <?php foreach($state as $row):?> 

                  <?php if (!empty($state1)){ ?>
                       <option value="<?php echo $row->state_code;?>" <?php echo (@$state3 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
                     <?php }else{?>
                      <option value="<?php echo $row->state_code; ?>" <?php echo set_select('c_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
                     <?php }?>
                   
                  <!-- <option value="<?php echo $row->state_code;?>" <?php echo (@$state3 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>-->
                 <?php endforeach;?>
                </select> 
                <div class="error"><?php echo form_error('c_state_id'); ?></div> 
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="c_district_id"><?php print_r($this->label->get_short_name($elements, 40)); ?><span class="text-danger">*</span></label>
                <select class="form-control chosen-single chosen-default" name="c_district_id" id="c_district_id"> 
                <option value="">Select district</option>    
                </select>
                <div class="error"><?php echo form_error('c_district_id'); ?></div>  
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <label for="c_pin_code"><?php print_r($this->label->get_short_name($elements, 41)); ?><span class="text-danger">*</span></label>   
                 <input type="text" class="form-control" name="c_pin_code" id="c_pin_code" value="<?php echo set_value('c_pin_code', @$myArray[0]->c_pin_code); ?>" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder="">
                 <div class="error"><?php echo form_error('c_pin_code'); ?></div> 
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
                <?php $nationalty3=$myArray[0]->c_country_id ?? ''; ?>
                <label for="c_country_id"><?php print_r($this->label->get_short_name($elements, 42)); ?><span class="text-danger">*</span> </label>  
                <select type="text" class="form-control chosen-single chosen-default" name="c_country_id" id="c_country_id">
                  <option value=""class="chosen-single">Select Country</option>
                  <?php foreach($getcountry as $row):?>

                    <?php if (!empty($nationalty3)){             ?>
                  <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty3 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
                  <?php }else{?>

                  <option value="<?php echo $row->country_id; ?>" <?php echo set_select('c_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                  <?php }?>
                 <?php endforeach;?>
                </select>
                <div class="error"><?php echo form_error('c_country_id'); ?></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
            <label class="text-orange" for="occu_desig_avo"><?php print_r($this->label->get_short_name($elements, 43)); ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="occu_desig_avo" id="occu_desig_avo" value="<?php echo set_value('occu_desig_avo', @$myArray[0]->occu_desig_avo); ?>" onkeypress="return ValidateAlpha(event)" maxlength="100"  placeholder="">
            <div class="error"><?php echo form_error('occu_desig_avo'); ?></div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
            <label class="text-orange" for="tel_no"><?php print_r($this->label->get_short_name($elements, 44)); ?></label>
            <input type="text" class="form-control" name="tel_no" id="tel_no" value="<?php echo set_value('tel_no', @$myArray[0]->tel_no); ?>" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="">
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
            <label class="text-orange" for="mob_no"><?php print_r($this->label->get_short_name($elements, 45)); ?><span class="text-danger">*</span></label>
            <?php if($mobilenopublic!=0){ ?>
            <div class="icon medium_sea_green1 hvr-pulse">
              <img src="<?php echo base_url();?>assets/rohp/icon/varified.png" title="varified" >
            </div> 
            <?php } ?>

            <input type="text" class="form-control" name="mob_no" id="mob_no" <?php if($user['mobile'] && $user['role'] == 18) echo 'readonly'; ?> value="<?php
                  if($user['mobile'] && $user['role'] == 18){
                      echo $user['mobile'];
                  }else{
             echo set_value('mob_no', @$myArray[0]->mob_no); 
           }?>"  maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="">
            <div class="error"><?php echo form_error('mob_no'); ?></div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
            <label class="text-orange" for="email_id"><?php print_r($this->label->get_short_name($elements, 46)); ?><span class="text-danger">*</span></label>
             <?php if($user['email'] && $user['role'] == 18){ ?>
            <div class="icon medium_sea_green1 hvr-pulse">
              <img src="<?php echo base_url();?>assets/rohp/icon/varified.png" title="varified" >
            </div> 
            <?php } ?>
            <input type="text" class="form-control" name="email_id" required="required" id="email_id" <?php if($user['role'] == 18) echo ''; ?> value="<?php if(isset($user['email']) && $user['role'] == 18){
                      echo $user['email'];
                  }else{ echo set_value('email_id', @$myArray[0]->email_id); } ?>" maxlength="50" placeholder="">
          </div>   

          <div class="col-lg-4 col-md-6 col-sm-6 mb-15">                   
            <label class="text-orange" for="complaintmode_id"><?php print_r($this->label->get_short_name($elements, 9)); ?><span class="text-danger">*</span></label>    

            <select type="text" class="form-control chosen-single chosen-default" name="complaintmode_id" id="complaintmode_id" onchange="showDiv('hidden_div', this)">
              <?php $cam_mode=$myArray[0]->complaintmode_id ?? ''; ?>
              <option value="">-- Select --</option>
              <?php foreach($complaintmode as $row):?>
                <?php if (!empty($cam_mode)){
                          ?>
               <option value="<?php echo $row->complaintmode_id;?>" <?php echo ($cam_mode == $row->complaintmode_id) ? 'selected ' : '' ?><?php if($user['role']==18 && $row->complaintmode_id != 3) echo 'disabled' ?>> <?php echo $row->complaintmode_desc; ?> </option>
                <?php }else{                    
                  if($user['role']==18 && $row->complaintmode_id==3){
                  ?> 
                  <option value="<?php echo $row->complaintmode_id; ?>" selected><?php echo $row->complaintmode_desc; ?></option>
                <?php }else{ ?>
               <option value="<?php echo $row->complaintmode_id; ?>" <?php echo set_select('complaintmode_id',  $row->complaintmode_id); ?> <?php if($user['role']==18) echo 'disabled' ?>><?php echo $row->complaintmode_desc; ?></option>
               <?php } } ?> 
             <?php  endforeach;
             ?>
            </select> 
            <label class="error"><?php echo form_error('complaintmode_id'); ?></label>    
            <div id="hidden_div" style="font-size: 12px; color: #0171b5;"><label class="col-md-12"><i>NOTE: A PHYSICAL COPY IS TO BE SUBMITTED TO LOKPAL WITHIN A PERIOD OF FIFTEEN DAYS.</i></label></div>   


              <?php  if($user['role']==18) { ?> 
            <div style="font-size: 12px; color: #0171b5;"><label class="col-md-12"><i>NOTE: A PHYSICAL COPY IS TO BE SUBMITTED TO LOKPAL WITHIN A PERIOD OF FIFTEEN DAYS.</i></label></div> 

            <?php } ?> 

          </div>  
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
          <?php $notify=$myArray[0]->notory_affi_annex ?? ''; ?>
          <label class="text-orange" for="notory_affi_annex"><?php print_r($this->label->get_short_name($elements, 47)); ?><span class="text-danger">*</span></label> 
          <div class="radio">
            <label><input type="radio" name="notory_affi_annex" id="Active" required="required" checked="checked" value="1" <?php  echo set_value('notory_affi_annex', $notify) == 1 ? "checked" : ""; ?> /> Yes</label>
            <label><input type="radio" name="notory_affi_annex" required="required" value="2" <?php  echo set_value('notory_affi_annex', $notify) == 2 ? "checked" : ""; ?> /> No</label>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 mb-15">
          <?php $cmv=$myArray[0]->complainant_victim ?? ''; ?>
          <label class="text-orange" for="complainant_victim"><?php print_r($this->label->get_short_name($elements, 48)); ?><span class="text-danger">*</span></label>
          <div class="radio">
            <label><input type="radio" name="complainant_victim" id="Active" required="required" checked="checked" value="1" <?php  echo set_value('complainant_victim', $cmv) == 1 ? "checked" : ""; ?> /> Yes</label>
            <label><input type="radio" name="complainant_victim" required="required" value="2" <?php  echo set_value('complainant_victim', $cmv) == 2 ? "checked" : ""; ?> /> No</label>
          </div>
        </div>

      </div>


      <div class="row">
        <div class="col-lg-12 mb-15">
          <ul class="blockquote-remark">
            <h5>It is certified that to the best of my knowledge, belief and information:</h5>
          <li> 
            (i) the alleged offence in respect of which present complaint is being made is within the period of seven years [ <I>limitation as laid down under section 53 of the Lokpal and Lokayuktas Act, 2013];</I>
          </li>
          <li>(ii) no matter or proceeding related to allegation of corruption under the Prevention of Corruption Act, 1988 being made under this complaint is pending before any court or committee of either House of Parliament or before any other authority and the complaint is not barred from being made before the Lokpal by section 15 of the Lokpal and Lokayuktas Act, 2013.
            </li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-15">
          <label for="comp_f_place"><?php print_r($this->label->get_short_name($elements, 49)); ?><span class="text-danger">*</span></label>
         
          <input type="text" class="form-control" name="comp_f_place" value="<?php echo set_value('comp_f_place', @$myArray[0]->comp_f_place); ?>" id="comp_f_place" onkeypress="return ValidateAlpha(event)" placeholder="Enter place ...">
          <div class="error"><?php echo form_error('comp_f_place'); ?></div>
        </div>
        <?php
        $curYear = date('Y');
        $curMonth = date('m');
        $curDay = date('d');
        $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
        $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
        //  $comp_f_date="$curYear-$curMonth-$curDay"; 
        $comp_f_date="$curDay-$curMonth-$curYear";                        
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 mb-15" hidden="true">
          <label for="comp_f_date"><?php print_r($this->label->get_short_name($elements, 50)); ?></label>
          <input type="text" class="form-control" name="comp_f_date" id="comp_f_date" value="<?php echo $comp_f_date;?>" readonly="readonly" placeholder="Entet Date ...">
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
  <script language="javascript"> 
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 3 ? 'block' : 'none';
}
</script>


<script language="javascript"> 
  console.log(11);
  window.onload = function() {

    nationality_identity();

    var get_state_value = $("#p_state_id").val();
    pageRefesh(get_state_value);

    var get_cstate_value = $("#c_state_id").val();
    pageRefesh1(get_cstate_value);

    var state1 ="<?= $state1; ?>"; 
    var state3 ="<?= $state3; ?>"; 
    if(state1 != '' )  {
      pageRefesh(state1); 
    } 
    if(state3 != '' )  {
      pageRefesh1(state3);
    } 
    
  };
  
  function pageRefesh(state_id)
  {
    /*
    var dist_id_selected = "<?= $p_dist_id; ?>";
    var post_url= '<?php echo base_url('user/getdistrict')?>';
    var request_method= 'POST';
    $("#p_dist_id").html('');
    $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+value,
      dataType: 'html',
    }).success(function(response){
      $("#p_dist_id").append(response);  
      $("#p_dist_id").val(dist_id_selected);      
    });
    */

    var dist_id_selected = "<?= $p_dist_id; ?>";
    var post_url= '<?php echo base_url('user/getdistrict1')?>';
    var request_method= 'POST';
    $("#p_dist_id").html('');
    $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+state_id,
      success: function(response){ //
        $("#p_dist_id").append(response);
        if(dist_id_selected !=''){
          $("#p_dist_id").val(dist_id_selected); 
        }           
    }
    });
  }

  function pageRefesh1(state_id)
  {
    //alert(state_id);
    var db_c_dist_id = "<?= $c_dist_id; ?>";
    var post_url= '<?php echo base_url('user/getdistrict1')?>';
    var request_method= 'POST';
    $("#c_district_id").html('');
    $.ajax({
      url : post_url,
      type: request_method,
      data : 'stateid='+state_id,
      success: function(response){ //
        $("#c_district_id").append(response);
        if(db_c_dist_id !=''){
          $("#c_district_id").val(db_c_dist_id); 
        }           
    }
    });
  }

    
    function FillBilling(f) {
      if(f.billingtoo.checked == true) {
        //alert("hello");
        pageRefesh1(f.p_state_id.value);
        f.c_add1.value=f.p_add1.value;
        f.c_hpnl.value=f.p_hpnl.value;
        f.c_state_id.value=f.p_state_id.value;
        f.c_pin_code.value=f.p_pin_code.value;
        f.c_country_id.value=f.p_country_id.value;
      }else{
        $('#c_state_id').val('');
        $('#c_district_id').html('');
        $('#c_pin_code').val('');
        $('#c_country_id').val('');
        $('#c_hpnl').val('');
        $('#c_add1').val('');
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
        $("#filingform").submit(); // Submit the form
      });
    });


    $().ready(function() {
     
    // validate signup form on keyup and submit


    $("#filingform").validate({
     
      onkeyup: false,

      rules: { 
      
        complaint_capacity_id: "required",   
        complaintmode_id: "required",
        salutation_id:"required",
        first_name:"required",
        gender_id:"required",
        age_years:"required",
        nationality_id: "required",
        identity_proof_id:"required",
        idres_proof_id:"required",
        p_state_id:"required",
        p_dist_id:"required",
        c_district_id:"required",
        p_country_id:"required",
        c_state_id:"required",
        c_country_id:"required",
        occu_desig_avo:"required",
        mob_no:"required",
        p_hpnl:"required",
        p_add1:"required",
        p_pin_code:"required",
        c_hpnl:"required",
        c_add1:"required",
        c_pin_code:"required",
        comp_f_place:"required",

      //  identity_proof_doi:"required",
       // idres_proof_doi:"required",
       // idres_proof_vupto:"required",
       // notory_affi_annex:"required",
       // complainant_victim:"required",
       email_id: {
                email: true,          
      },
      
       a_co_email_id: {
        email: true,          
      },
      

      identity_proof_upload: {required: true, accept: "application/pdf"},
      a_affidavit_upload: {required: true, accept: "application/pdf"},
      
      gender: { // <- NAME of every radio in the same group
        required: true
      },

      agree: "required",
    },



    messages: {
     // complaint_capacity_id: "Please select Complainant Capicity",
     // complaintmode_id: "Please select complaint mode",
        //lname_err: "Please enter your lastname",
       /* identity_proof_upload: {
          required:"input type is required",                  
          extension:"select valied input file format"

        },*/
        
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
      identity_proof_upload:{ accept: "pdf formats are allowed" },
      a_affidavit_upload:{ accept: "pdf formats are allowed" }
    }
  });
    
  });
    

</script>

    <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
             autoclose: true,  
             $('#identity_proof_doi').datepicker({
              format: "dd-mm-yyyy"
            });  
             
           });
            
       /*
                $('#identity_proof_vupto').datepicker({
                    format: "dd-mm-yyyy",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true



                  });  */





                  $(document).ready(function () {
                   autoclose: true,  
                   $('#idres_proof_doi').datepicker({
                    format: "dd-mm-yyyy"
                  });  
                   
                 });

/*
                 $('#idres_proof_vupto').datepicker({
                    format: "dd-mm-yyyy",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                  });*/

                  $('#identity_proof_doi').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  });

                   $('#idres_proof_doi').datepicker({
                    format: "dd-mm-yyyy",
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


/*
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(filingform.a_co_email_id.value))
  {
    return (true)
  }
    alert("You have entered an invalid email address!")
    return (false)
  }*/

      function nationality_identity()
    {
      //otheragndiv.style.display="none";
      //let concerned_div = document.getElementById('conce_agencydiv');
      //let psdetails_div = document.getElementById('psdetailsdiv');
      let nationality = $('#nationality_idsss').children("option:selected").val();
      //alert(nationality);
      //let filing_no = document.getElementById("filing_no");
      if(nationality == 2){
          //closure_div.style.display="none";
          //psdetails_div.style.display="none";
          //adj_div.style.display="none";
          //concerned_div.style.display="";
         // jQuery.ajax({
            //url: baseURL+'proceeding/get_concer_agency',
           // cache: false,
            //type : 'post',
            //data : 'order_type='+order_type,
            //dataType : 'JSON',
            //success: function(data) {
              //console.log(data);
              //var identity_proof_id = "";
             // for (key in data) {
              //console.log('here');
              document.getElementById("identity_proof_id").selectedIndex = "11"; 
              //$('#identity_proof_id').attr("readonly", true);
              //$('option:not(:selected)').attr('disabled', true);
              $("#identity_proof_id").css("pointer-events","none");
                //identity_proof_id += "<option value="+data[key]['agency_code']+">" + data[key]['agency_name'] + "</option>";
              //}
              //document.getElementById("conce_agency").innerHTML = agencyOptions;
           // }
         // });
         }else if(nationality == 1){
              //document.getElementById("identity_proof_id").selectedIndex = ""; 
               //$('#identity_proof_id').attr("readonly", false);
               $("#identity_proof_id").css("pointer-events","");
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

   $('input#a_affidavit_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#affidavit_proof_upload_error').text('Residence proof file must be less then 20 MB');
    return false;
  }else{
    $('#affidavit_proof_upload_error').text('');
  }
});
    </script>



