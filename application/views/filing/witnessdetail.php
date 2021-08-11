<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>
<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script> 
 
 <script language="javascript"> 
 function close_window() {
  if (confirm("Are you sure that you have saved the witness details?")) {
    close();
  }
}
 function modifyParty()
  {
    var mod_party=$('#modify_party').val();  
   
  var post_url= '<?php echo base_url('user/getModifyWitness')?>';
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
     //console.log(JSON.stringify(response));
       // alert(json[0].w_first_name);
        pageRefesh(json[0].w_state_id, json[0].w_dist_id);

        $('#w_salutation_id').val(json[0].w_salutation_id);
        $('#w_first_name').val(json[0].w_first_name);
        $('#w_sur_name').val(json[0].w_sur_name);
        $('#w_mid_name').val(json[0].w_mid_name); 
        $('#w_gender_id').val(json[0].w_gender_id);
        $('#w_age_years').val(json[0].w_age_years);
        $('#w_add1').val(json[0].w_add1);
        $('#w_hpnl').val(json[0].w_hpnl);
         $('#w_vill_city').val(json[0].w_vill_city); 
        // alert(json[0].w_state_id);
        $('#w_state_id').val(json[0].w_state_id);
        
        $('#w_country_id').val(json[0].w_country_id);
        $('#w_tel_no').val(json[0].w_tel_no);
        $('#w_mob_no').val(json[0].w_mob_no);
        $('#w_email_id').val(json[0].w_email_id);
        
        //$('#w_dist_id').val(json[0].w_dist_id);

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
      success: function(response){
        $("#w_dist_id").html(response);
        $('#w_dist_id').val(dist_id);
        }
      });
   }

   function pageRefesh1(value)
  {
   
  var post_url= '<?php echo base_url('user/getdistrict1')?>';
  var request_method= 'POST';
  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      }).success(function(response){ //
        $("#c_district_id").html(response);
        
      });
   }


  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#witnessform").validate({
 
      onkeyup: false,

      rules: {  
        //w_salutation_id: "required",   
        //w_salutation_id: "required",
        //w_first_name: "required",
        //w_gender_id:"required",
        //w_age_years:"required",
        //w_state_id:"required",
        //w_dist_id: "required",
        //w_country_id: "required",
        // w_mob_no:"required",
       

         w_email_id: {
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
       gender: { // <- NAME of every radio in the same group
            required: true
        },

        agree: "required"
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
        }
      }
    });
    
  });
   
      
 </script>

<?php 
$ref_no=$this->session->userdata('ref_no');
   ?>

<div class="app-content">
  <div class="main-content-app">
   <!-- <div class="page-header">    
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>
    </div>-->

    <div class="row">
      <div class="col-md-12">
        <div class="panel  panel-warring">
          <div class="panel-heading text-center">Witness Details</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

  <form id="witnessform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>respondent/witnessave'  name="witnessform" enctype="multipart/form-data">
      <div class="form_error">
            <?php //echo validation_errors(); ?>
      </div>

      <div class="alert alert-info"><strong>NOTE:</strong> This form can be filled multiple times if the number of witnesses exceeds one</div>

      <div class="row">       
        <?php if (isset($ref_no)) {?>
        <div class="col-md-3">                    
        </div>
        <?php } ?>
      </div>

      <?php  
        if(!empty($success_msg)){ 
          echo "hello";
          echo '<div>'.$success_msg.'</div>'; 
        }
        elseif(!empty($error_msg)){ 
          echo "Hi";
          echo '<div>'.$error_msg.'</div>'; 
          } 
          echo '<div>'.$this->session->flashdata('success_msg').'</div>';
      ?>
    
      <?php if(!empty($addparty)){ ?>  
      <div class="row">
        <div class="col-md-4">                   
          <label for="modify_party" >Select witness for modification</label> 
          <select type="text" class="form-control chosen-single chosen-default" name="modify_party" 
                 id="modify_party" onChange="modifyParty(this.value);">
            <option value="">-- Select Witness --</option>
            <?php foreach($addparty as $row):?>
            <option value="<?php echo $row->witness_detail;?>"><?php echo $row->witness_detail; ?> </option>
                          <?php endforeach;?>
          </select>        
        </div>

      </div>
      <?php } ?>

      <hr>

      <div class="row">
        <div class="col-md-12">      
          <label>(b) Name of the witness- </label>
        </div>

        <div class="col-md-4 mb-15">                   
          <label for="w_salutation_id" ><?php print_r($this->label->get_short_name($elements, 75)); ?></label>    
          <select type="text" class="form-control chosen-single chosen-default" name="w_salutation_id" id="w_salutation_id">
            <option value="">Select Title</option>
            <?php foreach($salution as $row):?>
            <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('w_salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
            <?php endforeach;?>
          </select>      
          <!--<div class="error"><?php echo form_error('w_salutation_id'); ?></div>   -->
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_sur_name"><?php print_r($this->label->get_short_name($elements, 76)); ?></label>
          <input type="text" class="form-control" name="w_sur_name" id="w_sur_name" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('w_sur_name') ?>">        
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_mid_name"><?php print_r($this->label->get_short_name($elements, 77)); ?></label>
          <input type="text" class="form-control" name="w_mid_name" id="w_mid_name" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()"  value="<?php echo set_value('w_mid_name') ?>">        
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4 mb-15">
          <label for="w_first_name"><?php print_r($this->label->get_short_name($elements, 78)); ?></label>      
          <input type="text" class="form-control" name="w_first_name" id="w_first_name" maxlength="50" onkeypress="return ValidateAlpha(event)" maxlength="50" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('w_first_name') ?>"> 
          <!--<div class="error"><?php echo form_error('w_first_name'); ?></div>       -->   
        </div> 

        <div class="col-md-4 mb-15">                   
          <label for="w_gender_id">(c) Gender:</label>    
          <select type="text" class="form-control chosen-single chosen-default" name="w_gender_id" id="w_gender_id">
            <option value="">Select</option>
            <?php foreach($gender as $row):?>
             <option value="<?php echo $row->gender_id; ?>" <?php echo set_select('w_gender_id',  $row->gender_id); ?>><?php echo $row->gender_desc; ?></option>
            <?php endforeach;?>
          </select>  
          <!--<div class="error"><?php echo form_error('w_gender_id'); ?></div> -->     
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_age_years">(d) Age:</label>
          <input type="text" class="form-control" name="w_age_years" maxlength="3" id="w_age_years" onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('w_age_years') ?>">        
        </div>
        <!--<div class="error"><?php echo form_error('w_age_years'); ?></div> -->
      </div>

      <hr>
      
      <div class="row">
        <div class="col-md-12">
          <label>(e) Full Address:</label>
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?></label>
          <input type="text" class="form-control" name="w_hpnl" id="w_hpnl" maxlength="50" placeholder="" value="<?php echo set_value('w_hpnl') ?>">
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_vill_city"> <?php print_r($this->label->get_short_name($elements, 94)); ?></label>
          <input type="text" class="form-control" name="w_vill_city" id="w_vill_city" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" value="<?php echo set_value('w_vill_city') ?>">      
        </div> 

        <div class="col-md-4 mb-15">
          <label for="w_state_id">State</label>  
          <select class="form-control chosen-single chosen-default" name="w_state_id" id="w_state_id" onChange="pageRefesh(this.value);" >
            <option value="">Select state</option>
            <?php foreach($state as $row):?>
            <option value="<?php echo $row->state_code; ?>" <?php echo set_select('w_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
            <?php endforeach;?>
          </select>   
          <!--<div class="error"><?php echo form_error('w_state_id'); ?></div>-->
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-15">
          <label for="w_dist_id">District</label>
          <select class="form-control chosen-single chosen-default" name="w_dist_id" id="w_dist_id">              
          </select>
          <!--<div class="error"><?php echo form_error('w_dist_id'); ?></div> -->
        </div> 

        <div class="col-md-4 mb-15">
           <label for="w_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?></label>   
            <input type="text" class="form-control" name="w_pin_code" id="w_pin_code" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('w_pin_code') ?>"> 
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_country_id"> <?php print_r($this->label->get_short_name($elements, 119)); ?></label>  
          <select class="form-control chosen-single chosen-default" name="w_country_id" id="w_country_id">
            <option value=""class="chosen-single">Select Country</option>
            <?php foreach($getcountry as $row):?>              
            <option value="<?php echo $row->country_id; ?>" <?php echo set_select('w_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
            <?php endforeach;?>          
          </select>      
          <!--<div class="error"><?php echo form_error('w_country_id'); ?></div>  -->  
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-15">
          <label for="w_tel_no">Telephone Number with std</label>
          <input type="text" class="form-control" name="w_tel_no" id="w_tel_no" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('w_tel_no') ?>">
        </div>

        <div class="col-md-4 mb-15">
          <label for="w_mob_no">(f) Mobile No:</label>
             <input type="text" class="form-control" name="w_mob_no" id="w_mob_no" maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('w_mob_no') ?>">
              <div class="error"><?php echo form_error('w_mob_no'); ?></div> 
        </div>
        

        <div class="col-md-4 mb-15">
          <label for="w_email_id">(g) E-mail Id:</label>
          <input type="text" class="form-control" name="w_email_id" id="w_email_id" maxlength="50" placeholder="" value="<?php echo set_value('w_email_id') ?>">
        </div>
      </div>

      <div class="row">




          <?php if(!empty($addparty)){ ?>  

          <div class="col-md-6">
            <button type="button" class="btn btn-primary" id="mySubmit" onclick="window.open('<?php echo site_url("respondent/witnessdetail");?>')">Do you want to add more click here</button>
          </div>

    <?php  }?>


        <div class="col-md-6 text-right">
          <button type="submit" class="btn btn-success" id="submitbtn">Save witness details</button> 
          <a class="btn btn-danger" href="javascript:close_window();"><span>Close this windows</span></a>
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
                $('#identity_proof_doi').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
       
                $('#identity_proof_Vupto').datepicker({
                    format: "yyyy-mm-dd",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });  



                $(document).ready(function () {
                 autoclose: true,  
                $('#idres_proof_doi').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });


                 $('#idres_proof_Vupto').datepicker({
                    format: "yyyy-mm-dd",
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



        </script>
</body></html>



