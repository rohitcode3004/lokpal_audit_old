<?php //include(APPPATH.'views/templates/front/header2.php');
$elements = $this->label->view(1);
?>
<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  
<script type="text/javascript">
  
  $(document).ready(function() {
   $('#imgURL').hide();
    $('#imgURL2').hide();
});

</script>
 
  <script type="text/javascript">
  console.log(11);
  window.onload = function() {

       nationality_identity();
     }

     </script>
 

 <script language="javascript"> 
  
   function close_window() {
  if (confirm("Are you sure that you have saved the office bearers/Head of organisation details?")) {
    close();
  }
}




 function modifyParty()
  {
    $('#imgURL').show();
     $('#imgURL2').show();
    var mod_party=$('#modify_party').val();  
    //alert(mod_party);  
  var post_url= '<?php echo base_url('user/getModifyOfficeBear')?>';
  var request_method= 'POST';  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'mod_party='+mod_party,
      success: function(response){ //
       // $("#affect_dist_id").html(response);
      // alert(response.status);
     // alert(jsonstri)
     var json=$.parseJSON(response);
     console.log(json);
     pageRefesh(json[0].ob_p_state_id, json[0].ob_p_dist_id);
      pageRefesh1(json[0].ob_c_state_id, json[0].ob_c_dist_id);
     //console.log(JSON.stringify(response));
      //  alert(json[0].office_bearer_organisation);

        var office_bearer_organisation=(json[0].office_bearer_organisation);       
        if(office_bearer_organisation ==1)
          {            
            $('input[name="office_bearer_organisation"][value="' + office_bearer_organisation + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="office_bearer_organisation"][value="' + office_bearer_organisation + '"]').prop('checked', true);
          }   

        $('#ob_salutation_id').val(json[0].ob_salutation_id);
        $('#ob_sur_name').val(json[0].ob_sur_name);
        $('#ob_mid_name').val(json[0].ob_mid_name);
        $('#ob_first_name').val(json[0].ob_first_name); 
        $('#ob_gender_id').val(json[0].ob_gender_id);
        $('#ob_age_years').val(json[0].ob_age_years);
        $('#ob_nationality_id').val(json[0].ob_nationality_id);
       // $('#affect_dist_id').val(json[0].affect_dist_id);
         $('#affect_state_id').val(json[0].affect_state_id); 
        $('#ob_identity_proof_id').val(json[0].ob_identity_proof_id);
        $('#ob_identity_proof_no').val(json[0].ob_identity_proof_no);
        $('#ob_identity_proof_doi').val(json[0].ob_identity_proof_doi);
        $('#ob_identity_proof_vupto').val(json[0].ob_identity_proof_vupto);
        $('#ob_identity_proof_iauth').val(json[0].ob_identity_proof_iauth);
        $('#ob_idres_proof_id').val(json[0].ob_idres_proof_id);

         $('#ob_idres_proof_no').val(json[0].ob_idres_proof_no); 
        $('#ob_idres_proof_doi').val(json[0].ob_idres_proof_doi);
        $('#ob_idres_proof_vupto').val(json[0].ob_idres_proof_vupto);
        $('#ob_idres_proof_iauth').val(json[0].ob_idres_proof_iauth);
        $('#ob_p_add1').val(json[0].ob_p_add1);
        $('#ob_p_hpnl').val(json[0].ob_p_hpnl);
        $('#ob_p_vill_city').val(json[0].ob_p_vill_city);

        // $('#ob_p_dist_id').val(json[0].ob_p_dist_id); 
        $('#ob_p_state_id').val(json[0].ob_p_state_id);
        $('#ob_p_country_id').val(json[0].ob_p_country_id);
        $('#ob_p_pin_code').val(json[0].ob_p_pin_code);
        $('#ob_c_add1').val(json[0].ob_c_add1);
        $('#ob_c_hpnl').val(json[0].ob_c_hpnl);
      //  $('#ob_c_vill_city').val(json[0].ob_c_vill_city);

       // $('#ob_c_dist_id').val(json[0].ob_c_dist_id); 
        $('#ob_c_state_id').val(json[0].ob_c_state_id);
        $('#ob_c_country_id').val(json[0].ob_c_country_id);
        $('#ob_c_pin_code').val(json[0].ob_c_pin_code);
        $('#ob_occu_desig_avo').val(json[0].ob_occu_desig_avo);
        $('#ob_tel_no').val(json[0].ob_tel_no);
        $('#ob_mob_no').val(json[0].ob_mob_no);

         $('#ob_email_id').val(json[0].ob_email_id); 
        //alert(json[0].ob_identity_proof_upload_url);
        var imgName =  json[0].ob_identity_proof_upload_url;
        // alert(imgName);
        var imgURL = '<?php echo base_url();?>'+ imgName;        
        // $("#imagePreview").attr("src",imgURL);pdf
        if(imgName !='')
        {
         $("#imgURL").attr("href",imgURL); 
        }
        else
        {
          $("#imgURL").hide();
        }


        $('#ob_idres_proof_upload_url').val(json[0].ob_idres_proof_upload_url);
         var imgName2 =  json[0].ob_idres_proof_upload_url;                
        var imgURL2 = '<?php echo base_url();?>'+ imgName2; 
             
        // $("#imagePreview2").attr("src",imgURL2);
           if(imgName2 !='')
         {

         $("#imgURL2").attr("href",imgURL2);    
       }
        else
        {
         $("#imgURL2").hide();
        }
      }
    });
   }


 function pageRefesh(state_id, dist_id)
  {

  var post_url= '<?php echo base_url('user/getdistrict')?>';
  var request_method= 'POST';
  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+state_id,
      success: function(response){ //
        $("#ob_p_dist_id").html(response);
         $('#ob_p_dist_id').val(dist_id);
        }
      });
   }

   function pageRefesh1(state_id, dist_id)
  {
   
  var post_url= '<?php echo base_url('user/getdistrict1')?>';
  var request_method= 'POST';  
      $.ajax({
        url : post_url,
        type: request_method,
         data : 'stateid='+state_id,
      success: function(response){ //
        $("#ob_c_dist_id").html(response);
         $('#ob_c_dist_id').val(dist_id);
        }
      });
   }


function FillBilling(f) {

  if(f.billingtoo.checked == true) {    
   pageRefesh1(f.ob_p_state_id.value);  
  
    f.ob_c_add1.value = f.ob_p_add1.value;
    f.ob_c_hpnl.value = f.ob_p_hpnl.value;
    f.ob_c_state_id.value=f.ob_p_state_id.value;
    f.ob_c_dist_id.value=f.ob_p_dist_id.value;
    f.ob_c_pin_code.value=f.ob_p_pin_code.value;
    f.ob_c_country_id.value=f.ob_p_country_id.value;
    //f.ob_c_vill_city.value=f.ob_p_vill_city.value;
  }

  else{
        $('#ob_c_add1').val('');
        $('#ob_c_hpnl').val('');
        $('#ob_c_state_id').val('');
        $('#ac_country_id').val('');
        $('#ob_c_dist_id').val('');
        $('#ob_c_pin_code').val('');
        $('#ob_c_country_id').val('');
        $('#ob_c_vill_city').val('');
      }

 // pageRefesh1(f.ob_p_state_id.value);
   //pageRefesh1(f.ob_p_dist_id.value);

}


  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#officebeared").validate({
 
      onkeyup: false,

      rules: {  
        office_bearer_organisation:"required",
        ob_salutation_id: "required",   
        ob_gender_id: "required",
        ob_first_name:"required",
        ob_age_years:"required",
        ob_nationality_id:"required",
        ob_identity_proof_id:"required",
        //ob_identity_proof_doi:"required",
        //ob_identity_proof_vupto: "required",
        ob_idres_proof_id:"required",
       // ob_idres_proof_doi:"required",
       // ob_idres_proof_vupto:"required",
        ob_p_state_id:"required",
        ob_p_dist_id:"required",
        ob_p_country_id:"required",
        ob_c_state_id:"required",
        ob_c_dist_id:"required",
        ob_c_country_id:"required",
        ob_mob_no:"required",
        a_co_state_code:"required",
        a_co_pin_code:"required",
        a_co_occupation:"required",
        a_mode_of_complaint:"required",
        a_affidavit_attached:"required",
        ob_p_hpnl:"required",
        ob_p_add1:"required",
        ob_p_pin_code:"required",
        ob_c_hpnl:"required",
        ob_c_add1:"required",
        ob_c_pin_code:"required",
        ob_occu_desig_avo:"required",
        ob_occu_desig_avo:"required",
        ob_email_id:"required",

           
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

        ob_email_id: {
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

      ob_identity_proof_upload: {required: true, accept: "application/pdf"},
      ob_idres_proof_upload: {required: true, accept: "application/pdf"},

       gender: { // <- NAME of every radio in the same group
            required: true
        },

        agree: "required",
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
      ob_identity_proof_upload:{ accept: "Only pdf formats are allowed" },
      ob_idres_proof_upload:{ accept: "Only pdf formats are allowed" }
      }
    });
    
  });
   
      
 </script>
  
 
<?php 
$ref_no=$this->session->userdata('ref_no');
//print_r($array);
  //$array['ref_no'];

 // echo "<pre>";
 //print_r($salution); 
  
  //var_dump($data['state']);
  
   ?>
<div class="app-content">
  <div class="main-content-app">
   <!-- <div class="page-header">
      <h4 class="page-title">Filing Entry</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>
    </div>-->

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-warring">
          <div class="panel-heading text-center">Personal details of office bearers / Head of the organisation</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

  <form id="officebeared" class="form-horizontal" role="form" method="post" action='<?= base_url();?>applet/officsave'  name="officebeared" enctype="multipart/form-data">

    <div class="form_error">
      <?php //echo validation_errors(); ?>
    </div>

    <div class="row">
      <div class="col-md-12"> 
        <div class="alert alert-info">
          <h4 class="m-0">
            <strong>NOTE:</strong> This form can be filled multiple times if the number of office bearers and head of the organisation EXCEEDS one
          </h4>
        </div>
      </div>
    </div>
 
    <div class="row">
      <?php if (isset($ref_no)) {?>
      <div class="col-md-12">    
        <div class="searchComplaint" >               
          <?php  
          if(!empty($success_msg)){ 
              echo '<div>'.$success_msg.'</div>'; 
          }elseif(!empty($error_msg)){ 
              echo '<div>'.$error_msg.'</div>'; 
          } 
          echo '<div>'.$this->session->flashdata('success_msg').'</div>';
          ?>
                        
        </div>
      </div>
      <?php } ?>
    </div>

    <?php if(!empty($addparty)) { ?>
    <div class="row">
      <div class="col-md-12">                   
        <label for="modify_party"><span class="text-danger">Select office bearers/Head of organizarion for modification</span></label> 
        <select type="text" class="form-control chosen-single chosen-default" name="modify_party" id="modify_party" onChange="modifyParty(this.value);">
          <option value="">-- Select office bearers/Head of organizarion --</option>
            <?php foreach($addparty as $row):?>
          <option value="<?php echo $row->ob_party;?>"><?php echo $row->ob_party; ?> </option>
            <?php endforeach;?>           
        </select>
      </div>
    </div>
    <?php } ?>

   

    <div class="row">
      <div class="col-md-12">
        <label for="office_bearer_organisation" class="text-danger"><span>*</span>Select office bearers / Head of organisation</label>
        <div class="radio">
          <label><input type="radio" name="office_bearer_organisation" id="office_bearer_organisation" value="1" <?php 
    echo set_value('office_bearer_organisation', 'office_bearer_organisation') == 1 ? "checked" : ""; 
?> > Office bearers</label>
          <label><input type="radio" name="office_bearer_organisation" id="office_bearer_organisation" value="2" <?php 
    echo set_value('office_bearer_organisation', 'office_bearer_organisation') == 2 ? "checked" : ""; 
?> > Head of organisation</label>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 120)); ?>-</label>
      </div>
      <div class="col-md-6 mb-15">                   
        <label for="ob_salutation_id" ><?php print_r($this->label->get_short_name($elements, 75)); ?>
          <span class="text-danger">*</span>
        </label>    
        <select class="form-control chosen-single chosen-default" name="ob_salutation_id" id="ob_salutation_id">
          <option value="">Select Title</option>
          <?php foreach($salution as $row):?>
          <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('ob_salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
          <?php endforeach;?>
        </select>   
        <div class="error"><?php echo form_error('ob_salutation_id'); ?></div>       
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_sur_name"><?php print_r($this->label->get_short_name($elements, 76)); ?></label>       
        <input type="text" class="form-control" name="ob_sur_name" id="ob_sur_name" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('ob_sur_name') ?>">        
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_mid_name"><?php print_r($this->label->get_short_name($elements, 77)); ?></label>       
        <input type="text" class="form-control" name="ob_mid_name" id="ob_mid_name" onkeypress="return ValidateAlpha(event)" maxlength="50" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('ob_mid_name') ?>">        
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_first_name"><?php print_r($this->label->get_short_name($elements, 78)); ?><span class="text-danger">*</span></label>     
        <input type="text" class="form-control" name="ob_first_name" id="ob_first_name" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('ob_first_name') ?>"> 
        <div class="error"><?php echo form_error('ob_first_name'); ?></div>     
      </div> 
    </div>
    
    <hr>
 
    <div class="row">
      <div class="col-md-6 mb-15">                   
        <label for="ob_gender_id" class="text-orange">2.Gender <span style="color: red;">*</span></label>    
        <select class="form-control chosen-single chosen-default" name="ob_gender_id" id="ob_gender_id"> 
          <option value="">Select Gender</option> 
          <?php foreach($gender as $row):?>
          <option value="<?php echo $row->gender_id; ?>" <?php echo set_select('ob_gender_id',  $row->gender_id); ?>><?php echo $row->gender_desc; ?></option>
          <?php endforeach;?>
        </select>   
        <div class="error"><?php echo form_error('ob_gender_id'); ?></div>       
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_age_years" class="text-orange">3. Age [in complete years] <span class="text-danger">*</span></label>
           <input type="text" class="form-control" name="ob_age_years" maxlength="3" id="ob_age_years"
           onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('ob_age_years') ?>">  
           <div class="error"><?php echo form_error('ob_age_years'); ?></div> 
      </div>       
    </div>


    <div class="row">
      <div class="col-md-6 mb-15">                   
        <label for="ob_nationality_id" class="text-orange">4. Nationality <span class="text-danger">*</span></label>    
        <select class="form-control chosen-single chosen-default" name="ob_nationality_id" id="ob_nationality_id" onchange="javascript:nationality_identity();">
          <option value="">Select Nationality</option>
          <?php foreach($nationality as $row):?>
          <option value="<?php echo $row->nationality_id; ?>" <?php echo set_select('ob_nationality_id',  $row->nationality_id); ?>><?php echo $row->nationality_desc; ?></option>
          <?php endforeach;?>
        </select> 
         <div class="error"><?php echo form_error('ob_nationality_id'); ?></div>          
      </div>
    </div>
   
    <hr>

    <div class="row">
      <div class="col-md-12">
        <label class="text-orange">5. Details of identity proof-</label>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_identity_proof_id"><?php print_r($this->label->get_short_name($elements, 83)); ?><span style="color: red;">*</span></label> 
        <select class="form-control chosen-single chosen-default" name="ob_identity_proof_id" id="ob_identity_proof_id">
          <option value=""class="chosen-single">Select Identity Document</option>
          <?php foreach($identityproof as $row):?>
         <option value="<?php echo $row->identity_proof_id; ?>" <?php echo set_select('ob_identity_proof_id',  $row->identity_proof_id); ?>><?php echo $row->Identity_proof_desc; ?></option>
          <?php endforeach;?>
        </select>   
         <div class="error"><?php echo form_error('ob_identity_proof_id'); ?></div>      
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_identity_proof_no">(a). Number</label>
        <input type="text" class="form-control" name="ob_identity_proof_no" id="ob_identity_proof_no" placeholder="" maxlength="50" value="<?php echo set_value('ob_identity_proof_no') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_identity_proof_doi">(b). Date of Issue</label>
        <input type="text" class="form-control" name="ob_identity_proof_doi" id="ob_identity_proof_doi" placeholder="" value="<?php echo set_value('ob_identity_proof_doi') ?>">
      </div>
      <div class="col-md-6  mb-15">
        <label for="ob_identity_proof_vupto">(c). Validity Upto</label>
        <input type="text" class="form-control" name="ob_identity_proof_vupto" id="ob_identity_proof_vupto" placeholder="" value="<?php echo set_value('ob_identity_proof_vupto') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_identity_proof_iauth">(d). Issuing Authority</label>
        <input type="text" class="form-control" name="ob_identity_proof_iauth" id="ob_identity_proof_iauth" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="50" value="<?php echo set_value('ob_identity_proof_iauth') ?>">
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_identity_proof_upload"><?php print_r($this->label->get_short_name($elements, 88)); ?><span class="text-danger">*</span></label>
        <input type="file" id="ob_identity_proof_upload" name="ob_identity_proof_upload" class="form-control" size="20"> 
         <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
         <div class="error" id="identity_proof_upload_error"><?php echo form_error('ob_identity_proof_upload'); ?></div> 
        <div><label><a href="#" id="imgURL" target="_blank" alt="" >show uploaded document </a></label></div>
      </div>   
    </div>


    <div class="row"> 
      <div class="col-md-12">
        <label class="text-orange">Details of residence proof-</label>
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_id"><?php print_r($this->label->get_short_name($elements, 113)); ?> <span class="text-danger">*</span></label>
        <select class="form-control chosen-single chosen-default" name="ob_idres_proof_id" id="ob_idres_proof_id">
          <option value=""class="chosen-single">Select Residence Document</option>
          <?php foreach($residenceproof as $row):?>
          <option value="<?php echo $row->idres_proof_id; ?>" <?php echo set_select('ob_idres_proof_id',  $row->idres_proof_id); ?>><?php echo $row->idres_proof_desc; ?></option>
          <?php endforeach;?>
        </select>    
         <div class="error"><?php echo form_error('ob_idres_proof_id'); ?></div>        
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_no"><?php print_r($this->label->get_short_name($elements, 114)); ?></label>
        <input type="text" class="form-control" name="ob_idres_proof_no" id="ob_idres_proof_no" placeholder="" maxlength="50" value="<?php echo set_value('ob_idres_proof_no') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_doi"><?php print_r($this->label->get_short_name($elements, 115)); ?></label>
        <input type="text" class="form-control" name="ob_idres_proof_doi" id="ob_idres_proof_doi" placeholder="" value="<?php echo set_value('ob_idres_proof_doi') ?>">
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_vupto"><?php print_r($this->label->get_short_name($elements, 116)); ?></label>
        <input type="text" class="form-control" name="ob_idres_proof_vupto" id="ob_idres_proof_vupto" placeholder="" value="<?php echo set_value('ob_idres_proof_vupto') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_iauth"><?php print_r($this->label->get_short_name($elements, 117)); ?></label>
       <input type="text" class="form-control" name="ob_idres_proof_iauth" id="ob_idres_proof_iauth" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="50" value="<?php echo set_value('ob_idres_proof_iauth') ?>">
       </div>

      <div class="col-md-6 mb-15">
        <label for="ob_idres_proof_upload"><?php print_r($this->label->get_short_name($elements, 118)); ?><span class="text-danger">*</span></label>
        <input type="file" id="ob_idres_proof_upload" name="ob_idres_proof_upload" class="form-control" size="20">
         <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
         <div class="error" id="ob_idres_proof_upload_error"><?php echo form_error('ob_idres_proof_upload'); ?></div>
        <label><a href="#" id="imgURL2" target="_blank" >show uploaded document </a></label>
      </div>          
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <label class="text-orange">6. Permanent Address -</label>
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_p_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_p_hpnl" id="ob_p_hpnl" placeholder="" maxlength="50" value="<?php echo set_value('ob_p_hpnl') ?>">
        <div class="error"><?php echo form_error('ob_p_hpnl'); ?></div> 
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_p_add1"><?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_p_add1" id="ob_p_add1" placeholder="" maxlength="50" value="<?php echo set_value('ob_p_add1') ?>">
        <div class="error"><?php echo form_error('ob_p_add1'); ?></div> 
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_p_state_id">State <span class="text-danger">*</span></label>  
        <select class="form-control chosen-single chosen-default" name="ob_p_state_id" id="ob_p_state_id" onChange="pageRefesh(this.value);" >
          <option value="">Select state</option>
          <?php foreach($state as $row):?>
         <option value="<?php echo $row->state_code; ?>" <?php echo set_select('ob_p_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
          <?php endforeach;?>
        </select> 
        <div class="error"><?php echo form_error('ob_p_state_id'); ?></div>  
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_p_dist_id">District <span class="text-danger">*</span></label>
        <select class="form-control chosen-single chosen-default" name="ob_p_dist_id" id="ob_p_dist_id">  
        </select>
        <div class="error"><?php echo form_error('ob_p_dist_id'); ?></div> 
      </div>   
    </div>


    <div class="row">       
      <div class="col-md-6 mb-15">
          <label for="ob_p_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?><span class="text-danger">*</span></label>   
          <input type="text" class="form-control" name="ob_p_pin_code" id="ob_p_pin_code" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('ob_p_pin_code') ?>"> 
          <div class="error"><?php echo form_error('ob_p_pin_code'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_p_country_id"><?php print_r($this->label->get_short_name($elements, 119)); ?><span class="text-danger">*</span></label>  
        <select class="form-control chosen-single chosen-default" name="ob_p_country_id" id="ob_p_country_id">
          <option value=""class="chosen-single">Select Country</option>
          <?php foreach($getcountry as $row):?>
          <option value="<?php echo $row->country_id; ?>" <?php echo set_select('ob_p_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
          <?php endforeach;?>
        </select>  
        <div class="error"><?php echo form_error('ob_p_country_id'); ?></div>        
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 mb-15">
        <div class="alert alert-info">
          <input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)" />
          For same address please check this box.
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange">7. Address for Correspondence</label>
      </div>
      <div class="col-md-6 mb-15">
        <label for="ob_c_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_c_hpnl" id="ob_c_hpnl" placeholder="" maxlength="50" value="<?php echo set_value('ob_c_hpnl') ?>">
        <div class="error"><?php echo form_error('ob_c_hpnl'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_c_add1"><?php print_r($this->label->get_short_name($elements, 94)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_c_add1" id="ob_c_add1" placeholder="" maxlength="50" value="<?php echo set_value('ob_c_add1') ?>">
        <div class="error"><?php echo form_error('ob_c_add1'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_c_state_id">State <span class="text-danger">*</span></label>  
        <select class="form-control chosen-single chosen-default" name="ob_c_state_id" id="ob_c_state_id" onChange="pageRefesh1(this.value);" >
          <option value="">Select state</option>
          <?php foreach($state as $row):?>
          <option value="<?php echo $row->state_code; ?>" <?php echo set_select('ob_c_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
          <?php endforeach;?>
        </select> 
         <div class="error"><?php echo form_error('ob_c_state_id'); ?></div>    
        </div>
        <div class="col-md-6 mb-15">
          <label for="ob_c_dist_id">District <span class="text-danger">*</span></label>
          <select class="form-control chosen-single chosen-default" name="ob_c_dist_id" id="ob_c_dist_id">  
          <?php ?>
          </select> 
           <div class="error"><?php echo form_error('ob_c_dist_id'); ?></div>  
      </div>  
    </div>

    <div class="row">    
      <div class="col-md-6 mb-15">
        <label for="ob_c_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?><span class="text-danger">*</span></label>   
        <input type="text" class="form-control" name="ob_c_pin_code" id="ob_c_pin_code" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('ob_c_pin_code') ?>"> 
        <div class="error"><?php echo form_error('ob_c_pin_code'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_c_country_id"><?php print_r($this->label->get_short_name($elements, 119)); ?><span class="text-danger">*</span></label>
        <select class="form-control chosen-single chosen-default" name="ob_c_country_id" id="ob_c_country_id">
          <option value=""class="chosen-single">Select Country</option>
          <?php foreach($getcountry as $row):?>
         <option value="<?php echo $row->country_id; ?>" <?php echo set_select('ob_c_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
          <?php endforeach;?>
        </select>   
         <div class="error"><?php echo form_error('ob_c_country_id'); ?></div>      
      </div>
    </div>
    <hr>    
    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_occu_desig_avo" class="text-orange">8. Occupation/Designation/Avocation <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_occu_desig_avo" id="ob_occu_desig_avo" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="50" value="<?php echo set_value('ob_occu_desig_avo') ?>">
        <div class="error"><?php echo form_error('ob_occu_desig_avo'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_tel_no" class="text-orange">9(a) Telephone Number ( with std codes)</label>         
        <input type="text" class="form-control" name="ob_tel_no" id="ob_tel_no" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('ob_tel_no') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ob_mob_no" class="text-orange">9(b) Mobile Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_mob_no" id="ob_mob_no" maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('ob_mob_no') ?>">
         <div class="error"><?php echo form_error('ob_mob_no'); ?></div>
      </div>

      <div class="col-md-6 mb-15">
        <label for="ob_email_id" class="text-orange">10. e-mail id <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ob_email_id" id="ob_email_id" required="required" placeholder="" maxlength="50" value="<?php echo set_value('ob_email_id') ?>">
        <div class="error"><?php echo form_error('ob_email_id'); ?></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">

           <?php if(!empty($addparty)){ ?>  
        <button type="button" class="btn btn-primary"  onclick="window.open('<?php echo site_url("applet/officebeared");?>')">Do you want to add more click here</button> 
      <?php } ?>
             
      </div>

      <div class="col-md-6 text-right mb-15">
        <button type="submit" class="btn btn-success" id="submitbtn">Save details</button>
        <a class="btn btn-danger" href="javascript:close_window();">Close this windows</a>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <?php

         $curYear = date('Y');
          $curMonth = date('m');
          $curDay = date('d');
          $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
          $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
          $comp_f_date="$curYear-$curMonth-$curDay";
         ?>
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

 <script type="text/javascript">
            // When the document is ready
          
            $(document).ready(function () {
                 autoclose: true,  
                $('#ob_identity_proof_doi').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });

             $('#ob_identity_proof_doi').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  });            
                
                $(document).ready(function () {
                 autoclose: true,  
                $('#ob_idres_proof_doi').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });


                 $('#ob_idres_proof_doi').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  });




             $(document).ready(function () {
                 autoclose: true,  
                $('#ob_identity_proof_vupto').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });              
        $('#ob_identity_proof_vupto').datepicker({
                    format: "dd-mm-yyyy",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });


                  $(document).ready(function () {
                 autoclose: true,  
                $('#ob_idres_proof_doi').datepicker({
                    format: "dd-mm-yyyy"
                   });             
                     });                  

                
                
                 $('#ob_idres_proof_vupto').datepicker({
                    format: "dd-mm-yyyy",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });

                 $(document).ready(function () {
                 autoclose: true,  
                $('#ob_idres_proof_vupto').datepicker({
                    format: "dd-mm-yyyy"
                   });             
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
      let nationality = $('#ob_nationality_id').children("option:selected").val();
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
              document.getElementById("ob_identity_proof_id").selectedIndex = "11"; 
              //$('#identity_proof_id').attr("readonly", true);
              //$('option:not(:selected)').attr('disabled', true);
              $("#ob_identity_proof_id").css("pointer-events","none");
                //identity_proof_id += "<option value="+data[key]['agency_code']+">" + data[key]['agency_name'] + "</option>";
              //}
              //document.getElementById("conce_agency").innerHTML = agencyOptions;
           // }
         // });
         }else if(nationality == 1){
              //document.getElementById("identity_proof_id").selectedIndex = ""; 
               //$('#identity_proof_id').attr("readonly", false);
               $("#ob_identity_proof_id").css("pointer-events","");
         }
       }



        </script>
  <script type="text/javascript">
  $('input#ob_identity_proof_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#ob_identity_proof_upload_error').text('Identity proof file must be less then 20 MB');
    return false;
  }else{
    $('#ob_identity_proof_upload_error').text('');
  }
});

   $('input#ob_idres_proof_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#ob_idres_proof_upload_error').text('Residence proof file must be less then 20 MB');
    return false;
  }else{
    $('#ob_idres_proof_upload_error').text('');
  }
});
    </script>
</body></html>



