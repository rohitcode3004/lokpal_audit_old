<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>
<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>

<script language="javascript"> 

  function close_window() {
    if (confirm("Are you sure that you have saved the third party detail?")) {
      close();
    }
  }


  function modifyParty()
  {
    var mod_party=$('#modify_party').val();  
   // alert(mod_party);  
   var post_url= '<?php echo base_url('user/getModifyParty')?>';
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
     pageRefesh(json[0].affect_state_id, json[0].affect_dist_id);
     //console.log(JSON.stringify(response));
        //alert(json[0].affect_name);
        $('#affect_name').val(json[0].affect_name);
        $('#affect_gender_id').val(json[0].affect_gender_id);
        $('#party_cate').val(json[0].party_cate);
        $('#affect_ageyears').val(json[0].affect_ageyears); 
        $('#affect_add1').val(json[0].affect_add1);
        $('#affect_hpnl').val(json[0].affect_hpnl);
        $('#affect_vill_city').val(json[0].affect_vill_city);
       // $('#affect_dist_id').val(json[0].affect_dist_id);
       $('#affect_state_id').val(json[0].affect_state_id); 
       $('#affect_country_id').val(json[0].affect_country_id);
       $('#affect_pin_code').val(json[0].affect_pin_code);
       $('#affect_ccu_desig_avo').val(json[0].affect_ccu_desig_avo);
       $('#affect_tel_no').val(json[0].affect_tel_no);
       $('#affect_mob_no').val(json[0].affect_mob_no);
       $('#affect_email_id').val(json[0].affect_email_id);
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
      success : function(response){ //
        $("#affect_dist_id").html(response);
        $('#affect_dist_id').val(dist_id);
        }
      });
    }




  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#additionalparty").validate({
 
      onkeyup: false,

      rules: {  
        party_cate: "required",
        //affect_name:"required",   
        //affect_gender_id: "required",
        //affect_ageyears:"required",
        //affect_state_id:"required",
        //affect_country_id:"required",
        //affect_mob_no: "required",
        a_comp_gender:"required",
        a_comp_age:"required",
        a_comp_nationality:"required",
        a_doc_id:"required",
        a_document_number:"required",
        a_date_of_issue:"required",
        a_validity_up_to_date:"required",
        a_correspondence_country:"required",
        a_co_state_code:"required",
        a_co_pin_code:"required",
        a_co_occupation:"required",
        a_mode_of_complaint:"required",
        a_affidavit_attached:"required",

         affect_email_id: {
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

<div class="app-content">
  <div class="main-content-app">
    <!--<div class="page-header">
      <h4 class="page-title">Filing Entry</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>
    </div>-->

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-warring">
          <div class="panel-heading text-center">Third Party Details</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

                <form id="additionalparty" class="form-horizontal" role="form" method="post" action='<?= base_url();?>applet/addsave'  name="additionalparty" enctype="multipart/form-data">
                  <div class="form_error">
                    <?php // echo validation_errors(); ?>
                  </div>

                  <div class="alert alert-info"><strong>NOTE:</strong> cghfThis form can be filled multiple times if the number of third party EXCEEDS one</div>

                  <div class="row">       
                    <?php if (isset($ref_no)) {?>
                      <div class="col-md-3">                                
                      </div>
                    <?php } ?>
                  </div>

                  <?php  
                  if(!empty($success_msg)){ 
                    echo '<div>'.$success_msg.'</div>'; 
                  }elseif(!empty($error_msg)){ 
                    echo '<div>'.$error_msg.'</div>'; 
                  } 
                  echo '<div>'.$this->session->flashdata('success_msg').'</div>';

                  ?>
                  <?php if(!empty($addparty)) { ?>
                    <div class="row">
                      <div class="col-md-4 mb-15">                   
                        <label for="modify_party" class="text-orange">Select third party for modification</label> 
                          <select type="text" class="form-control chosen-single chosen-default" name="modify_party" id="modify_party" onChange="modifyParty(this.value);">
                            <option value="">-- Select third party --</option>
                            <?php foreach($addparty as $row):?>
                              <option value="<?php echo $row->add_party;?>"><?php echo $row->add_party; ?> </option>
                            <?php endforeach;?>
                          </select>        
                        </div>
                      </div>
                    <?php } ?>

                    <div class="row">
                      <div class="col-md-4 mb-15">
                        <label class="text-orange" for="affect_name"><?php print_r($this->label->get_short_name($elements, 127)); ?></label>     
                        <input type="text" class="form-control" name="affect_name" id="affect_name" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()" value="<?php echo set_value('affect_name') ?>"> 
                        <!--<div class="error"><?php echo form_error('affect_name'); ?></div>-->       
                      </div>

                      <div class="col-md-4 mb-15">                   
                        <label class="text-orange" for="affect_gender_id">(b) Gender</label> 
                        <select class="form-control chosen-single chosen-default" name="affect_gender_id" id="affect_gender_id">
                          <option value="">Select</option>
                          <?php foreach($gender as $row):?>
                           <option value="<?php echo $row->gender_id; ?>" <?php echo set_select('affect_gender_id',  $row->gender_id); ?>><?php echo $row->gender_desc; ?></option>
                         <?php endforeach;?>
                       </select>    
                       <!--<div class="error"><?php echo form_error('affect_gender_id'); ?></div>-->      
                     </div>

                     <div class="col-md-4 mb-15">
                      <label class="text-orange" for="affect_ageyears">(c) Age</label>
                      <input type="text" class="form-control" name="affect_ageyears" maxlength="3" id="affect_ageyears" onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('affect_ageyears') ?>">   
                      <!--<div class="error"><?php echo form_error('affect_ageyears'); ?></div>-->      
                    </div> 
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-orange">(d) Full Address:</label>
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="affect_hpnl"><?php print_r($this->label->get_short_name($elements, 91)); ?></label>
                      <input type="text" class="form-control" name="affect_hpnl" id="affect_hpnl" placeholder="" maxlength="50" value="<?php echo set_value('affect_hpnl') ?>">
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="affect_vill_city"><?php print_r($this->label->get_short_name($elements, 94)); ?></label>      
                      <input type="text" class="form-control" name="affect_vill_city" id="affect_vill_city" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" value="<?php echo set_value('affect_vill_city') ?>">     
                    </div>

                    <div class="col-md-4 mb-15">
                      <label for="affect_state_id">State</label>  
                      <select class="form-control chosen-single chosen-default" name="affect_state_id" id="affect_state_id" onChange="pageRefesh(this.value);" >
                        <option value="">Select state</option>
                        <?php foreach($state as $row):?>
                         <option value="<?php echo $row->state_code; ?>" <?php echo set_select('affect_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option> 
                       <?php endforeach;?>
                     </select>  
                     <!--<div class="error"><?php echo form_error('affect_state_id'); ?></div>  -->
                   </div>
                 </div> 

                 <div class="row">
                  <div class="col-md-4 mb-15">
                    <label for="affect_dist_id">District</label>
                    <select type="text" class="form-control chosen-single chosen-default" name="affect_dist_id" id="affect_dist_id">         
                    </select>
                    <!--<div class="error"><?php echo form_error('affect_dist_id'); ?></div> -->
                  </div>  

                  <div class="col-md-4 mb-15">
                    <label for="affect_pin_code"><?php print_r($this->label->get_short_name($elements, 95)); ?></label>   
                    <input type="text" class="form-control" name="affect_pin_code" id="affect_pin_code" maxlength="6"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('affect_pin_code') ?>"> 
                  </div>

                  <div class="col-md-4 mb-15">
                    <label for="affect_ccu_desig_avo"> Occupation/Designation/Avocation </label>
                    <input type="text" class="form-control" name="affect_ccu_desig_avo" id="affect_ccu_desig_avo" onkeypress="return ValidateAlpha(event)" placeholder="" maxlength="50" value="<?php echo set_value('affect_ccu_desig_avo') ?>">
                  </div>
                </div> 

                <div class="row">
                  <div class="col-md-4 mb-15">
                    <label for="affect_country_id"><?php print_r($this->label->get_short_name($elements, 119)); ?></label>  
                    <select class="form-control chosen-single chosen-default" name="affect_country_id" id="affect_country_id">
                      <option value=""class="chosen-single">Select Country</option>
                      <?php foreach($getcountry as $row):?>
                        <option value="<?php echo $row->country_id; ?>" <?php echo set_select('affect_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
                         <?php endforeach;?>
                      </select> 
                      <!--<div class="error"><?php echo form_error('affect_country_id'); ?></div>   -->    
                    </div>

                    <div class="col-md-4 mb-15">
                      <label class="text-orange" for="affect_tel_no">(e) Telephone Number ( with std codes)</label>
                      <input type="text" class="form-control" name="affect_tel_no" id="affect_tel_no" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('affect_tel_no') ?>">
                    </div>

                    <div class="col-md-4 mb-15">
                      <label class="text-orange" for="affect_mob_no"><?php print_r($this->label->get_short_name($elements, 101)); ?></label>
                      <input type="text" class="form-control" name="affect_mob_no" id="affect_mob_no" maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="" value="<?php echo set_value('affect_mob_no') ?>">
                      <!--<div class="error"><?php echo form_error('affect_mob_no'); ?></div> -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 mb-15">
                      <label class="text-orange" for="affect_email_id">(g) e-mail id</label>
                      <input type="text" class="form-control" name="affect_email_id" id="affect_email_id" placeholder="" maxlength="50" value="<?php echo set_value('affect_email_id') ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-15">
                      <?php if(!empty($addparty)){ ?>  
                      <button type="button" class="btn btn-primary"  onclick="window.open('<?php echo site_url("applet/additionalparty");?>')">Do you want to add more click here</button>
                    <?php }?>
                    </div>

                    <div class="col-md-6 text-right mb-15">   
                      <button type="submit" class="btn btn-success" id="submitbtn">Save third party details</button>     
                      <a class="btn btn-danger" href="javascript:close_window();">Close this windows</a>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
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



