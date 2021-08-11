<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>
<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  
<script type="text/javascript">
  setInterval(function(){
    alert('Please save data on regular basis');

  },300000);      

</script>

<?php 
 //echo "<pre>";
//print_r($partc);
$cat=$partc['ps_id'] ?? '';
?>

<script language="javascript"> 
  window.onload = function() { 
  var get_state_value = $("#ps_pl_stateid").val();
    getDistrict(get_state_value);

    var get_cp_id_value = $("#complaint_capacity_id").val();
    pagecomplain(get_cp_id_value);


    if("<?= $cat; ?>" == '23')  {
       $("#dvPassport").show();
    } 
   else
   {
    $("#dvPassport").hide();
   } 
    
  };
</script>
<script type="text/javascript">
  $(document).ready(function(){

    //   hide section
 $("#otherid").hide();
    $("#comhide").hide();

    $("#dvdatahide").hide();

      var mod_party=$('#complaint_capacity_id').val(); 
  //alert(mod_party);
          if (mod_party == "0") {    
             $("#comhide").hide();
          }
            if (mod_party == "2") {
               // $("#dvdatahide").show();
                 $("#comhide").show();
            }
             else  if (mod_party == "4") {
                $("#comhide").show();
                 $("#otherid").hide();

            }

           else  if (mod_party == "1") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if (mod_party == "3") {
               $("#comhide").hide();
                $("#otherid").hide();
            }
            else  if (mod_party == "5") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
            else  if (mod_party == "6") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if (mod_party == "7") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if (mod_party == "8") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if (mod_party == "9") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if (mod_party == "10") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
            else  if (mod_party == "11") {
                $("#otherid").show();
                                               

            }
             else {                
                 $("#dvdatahide").hide();
            }
    
      $(function () {        
        $("#complaint_capacity_id").change(function () {
          var mod_party=$('#complaint_capacity_id').val(); 
          if ($(this).val() == "0") {    
             $("#comhide").hide();
          }
            if ($(this).val() == "2") {
               // $("#dvdatahide").show();
                 $("#comhide").show();
            }
             else  if ($(this).val() == "4") {
                $("#comhide").show();
                 $("#otherid").hide();

            }

           else  if ($(this).val() == "1") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if ($(this).val() == "3") {
               $("#comhide").hide();
                $("#otherid").hide();
            }
            else  if ($(this).val() == "5") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
            else  if ($(this).val() == "6") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if ($(this).val() == "7") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if ($(this).val() == "8") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if ($(this).val() == "9") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
             else  if ($(this).val() == "10") {
                $("#comhide").hide();
                 $("#otherid").hide();
            }
            else  if ($(this).val() == "11") {
                $("#otherid").show();
                                               

            }
             else {                
                 $("#dvdatahide").hide();
            }
        });
    });
});

  </script>

  <?php 
   //echo ''
 if(isset($partc))
 {
 $ps=$partc['ps_pl_stateid'] ?? '';
 $ds=$partc['ps_pl_dist_id'] ?? ''; 
 $camp=$partc['complaint_capacity_id'] ?? '';  
 $psd=$partc['ps_id'] ?? '';
//echo '<pre>'; print_r($partc); exit; 
}
else
{
  $camp='';
  $ds='';
  $psd='';
}
 ?>
 <script type="text/javascript">
 window.onload = function() {  

    var stateid = "<?= $ps; ?>";    
    if(stateid != '' )  {
      getDistrict(stateid);
    }

   // alert('Cate:'+stateid + '  SubCat: '+psd);
   var camp ="<?=$camp; ?>";
     if(camp != '' )  {
      pagecomplain(camp);
    }
};

</script>

<!--
   <script type="text/javascript">
$(function () {
        $("#affect_3rdparty").change(function () {

            if ($(this).val() == "0") {
                $("#dvPassport").hide();
            } else {                
                 window.open('<?php echo base_url(); ?>respondent/additionalparty','_blank')
                 // window.location.href="<?php echo base_url(); ?>applet/additionalparty";
            }
        });
    });

</script>



<script type="text/javascript">
$(function () {
        $("#ps_affect_3rdparty").change(function () {

            if ($(this).val() == "0") {
                $("#dvPassport").hide();
            } else {                
                 window.open('<?php echo base_url(); ?>respondent/witnessdetail','_blank')
                 // window.location.href="<?php echo base_url(); ?>applet/additionalparty";
            }
        });
    });


$(function () {
        $("#ad_multiple_ps").change(function () {

            if ($(this).val() == "0") {
                $("#dvPassport").hide();
            } else {                
                 window.open('<?php echo base_url(); ?>respondent/ad_public_servant','_blank')
                 // window.location.href="<?php echo base_url(); ?>applet/additionalparty";
            }
        });
    });

</script>-->



<script type="text/javascript">

  function getDistrict(value)
  {     
  var ps_id_selected = "<?= $ds; ?>";
  var post_url= '<?php echo base_url('user/getdistrict1')?>';
  var request_method= 'POST';
   $("#ps_pl_dist_id").html('');
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      success: function(response){
        $("#ps_pl_dist_id").append(response);  
        $("#ps_pl_dist_id").val(ps_id_selected);
        }      
      });
   }
</script>

<script type="text/javascript">

 function pagecomplain(value)
  {
  var ps_id_selectedd = "<?= $psd; ?>";
  var post_url= '<?php echo base_url('user/getComplain')?>';
  var request_method= 'POST';
  //$("#ps_id").html('');  
  //alert(value + ':: '+ ps_id_selectedd);
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      success: function(response){ //
         $("#ps_id").html(response); 
         $("#ps_id").val(ps_id_selectedd); 
        }
      });
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
  });
</script>
 
<script type="text/javascript">

  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#respondentform").validate({
 
      onkeyup: false,

      rules: {  
        
        ps_salutation_id: "required",   
        complaint_capacity_id: "required",
        ps_id:"required",
        ps_first_name:"required",
        ps_dsp_lp:"required",        
        periodf_coa:"required",
        periodt_coa:"required",
        ps_pl_stateid:"required",
        ps_pl_dist_id:"required",  
        a_co_state_code:"required",
        a_co_pin_code:"required",
        a_co_occupation:"required",
        a_mode_of_complaint:"required",
        a_affidavit_attached:"required",
        present_ps_desig:"required",
        ps_desig:"required",
        ps_orgn:"required",
        psc_postheld:"required",
        ps_pl_occ:"required",
        relied_doc_list:"required",
        sum_facalle:"required",

        username: {
          required: true,
          minlength: 6,
          maxlength:12,     
         
        },
        
        a_co_email_id: {
                    email: true,          
        },
       

        phone:{ 
          required:true,
          minlength:10,
          maxlength:10

        },

        sum_fact_allegation_upload: {required: true, accept: "application/pdf"},
        detail_offence_upload: {required: true, accept: "application/pdf"},
        relevant_evidence_upload: {required: true, accept: "application/pdf"},

        gender: { // <- NAME of every radio in the same group
            required: true
        },

        agree: "required",
        //relevant_evidence_upload:{ accept: "application/pdf" },
        //sum_fact_allegation_upload:{ accept: "application/pdf" },
        //detail_offence_upload:{ accept: "application/pdf" }
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
        sum_fact_allegation_upload:{ accept: "Only pdf format are allowed" },
        detail_offence_upload:{ accept: "Only pdf formats are allowed" },
        relevant_evidence_upload:{ accept: "Only pdf formats are allowed" }
      }
    });
    
  });
</script>

 <?php 

//echo "<pre>";
//print_r($partc);

// $ps=$partc['ps_pl_stateid'];
 //$ds=$partc['ps_pl_dist_id'];

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
        <div class="panel  panel-warring">
          <div class="panel-heading text-center">FORM OF COMPLAINT : (PART - C)</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
  <form id="respondentform" class="form-horizontal" role="form" method="post" action='<?php echo base_url();?>respondent/save'  name="respondentform" enctype="multipart/form-data">
    <div class="alert alert-danger"><h4 class="m-0"><?php print_r($this->label->get_short_name($elements, 129)); ?></h4></div>


    <div class="row">
      <div class="col-md-12"> 
        <label class="text-orange">1. Name of the public servant(s) against whom complaint is being made (in block letters)* -</label>
      </div>
      <?php $sal=$partc['ps_salutation_id'] ?? ''; ?>

      <div class="col-md-3 mb-15">                   
        <label for="ps_salutation_id" ><?php print_r($this->label->get_short_name($elements, 108)); ?><span class="text-danger">*</span></label>    
        <select type="text" class="form-control chosen-single chosen-default" name="ps_salutation_id" id="ps_salutation_id">
          <option value="">Select Title</option>
          <?php foreach($salution as $row):?>              
          <?php if (!empty($sal)){             ?>
          <option value="<?php echo $row->salutation_id;?>" <?php echo ($sal == $row->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
          <?php }else{?>
          <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('ps_salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
          <?php } ?>
          </option>
          <?php endforeach;?>
        </select>
        <div class="error"><?php echo form_error('ps_salutation_id'); ?></div>        
      </div>

      <div class="col-md-3 mb-15">
        <label for="ps_sur_name"><?php print_r($this->label->get_short_name($elements, 109)); ?></label>       
        <input type="text" class="form-control" name="ps_sur_name" id="ps_sur_name" value="<?php if(isset($partc)) echo $partc['ps_sur_name']; else echo set_value('ps_sur_name');?>" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

      <div class="col-md-3 mb-15">
        <label for="ps_mid_name"><?php print_r($this->label->get_short_name($elements, 110)); ?></label>      
        <input type="text" class="form-control" name="ps_mid_name" id="ps_mid_name" value="<?php if(isset($partc)) echo $partc['ps_mid_name']; else echo set_value('ps_mid_name');?>" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

      <div class="col-md-3 mb-15">
        <label for="ps_first_name"><?php print_r($this->label->get_short_name($elements, 78)); ?><span class="text-danger">*</span></label>    
        <input type="text" class="form-control" name="ps_first_name" id="ps_first_name" value="<?php if(isset($partc)) echo $partc['ps_first_name']; else echo set_value('ps_first_name');?>" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">
        <div class="error"><?php echo form_error('ps_first_name'); ?></div>        
      </div>
    </div>

    <div class="alert alert-info">
      * attach a separate sheet in respect of each public servant against whom a complaint is being made. <button type="button" class="btn btn-success"  onclick="window.open('<?php echo site_url("respondent/ad_public_servant");?>')">Click here</button>
    </div>
    <div class="alert alert-info">
      Note: Details of third party/ parties, if aware, whose interests are likely to be prejudicially affected by the said complaint as contemplated under Section 21 of the Act may also be separately furnished. <button type="button" class="btn btn-success" onclick="window.open('<?php echo site_url("respondent/additionalparty");?>')">Click here</button>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange">2. Present designation/status of the public servant(s) against whom complaint is being made<span class="text-danger">*</span> -</label>
        <input type="text" class="form-control" name="present_ps_desig" id="present_ps_desig" value="<?php if(isset($partc)) echo $partc['present_ps_desig']; else echo set_value('present_ps_desig');?>" maxlength="1000" onkeypress="return ValidateAlpha(event)" placeholder="" >   
        <div class="error"><?php echo form_error('present_ps_desig'); ?></div> 
      </div>
    </div>

    <div class="row">
      <?php $dsp=$partc['ps_dsp_lp'] ?? ''; ?>
      <div class="col-md-12 mb-15">
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 130)); ?><span class="text-danger">*</span></label>
        <div class="radio">
          <label>
            <input type="radio" name="ps_dsp_lp" id="Active" checked="checked" required="required" value="1" <?php  echo set_value('ps_dsp_lp', $dsp) == 1 ? "checked" : ""; ?> />
                              Yes
          </label>
          <label>
            <input type="radio" name="ps_dsp_lp" required="required" value="2" <?php  echo set_value('ps_dsp_lp', $dsp) == 2 ? "checked" : ""; ?> /> No
          </label>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange">4. With respect to serial no. 2 above, indicate:</label>
      </div>
      <div class="col-md-6 mb-15">
        <label for="ps_desig"><?php print_r($this->label->get_short_name($elements, 131)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="ps_desig" value="<?php if(isset($partc)) echo $partc['ps_desig']; else echo set_value('ps_desig');?>" id="ps_desig" maxlength="1000" placeholder="">
        <div class="error"><?php echo form_error('ps_desig'); ?></div>
      </div>
      <div class="col-md-6 mb-15">
        <label for="ps_orgn"><?php print_r($this->label->get_short_name($elements, 132)); ?><span class="text-danger">*</span></label>       
        <input type="text" class="form-control" name="ps_orgn" id="ps_orgn" maxlength="1000" value="<?php if(isset($partc)) echo $partc['ps_orgn']; else echo set_value('ps_orgn');?>" onkeypress="return ValidateAlpha(event)" placeholder="">    
        <div class="error"><?php echo form_error('ps_orgn'); ?></div>    
      </div>
    </div>

    <div class="row">   
      <?php $camp=$partc['complaint_capacity_id'] ?? ''; ?>
      <div class="col-md-6 mb-15">
        <label class="text-orange" for="complaint_capacity_id"><?php print_r($this->label->get_short_name($elements, 133)); ?><span class="text-danger">*</span></label>    
        <select type="text" class="form-control" class="chosen-single chosen-default" name="complaint_capacity_id" id="complaint_capacity_id" onChange="pagecomplain(this.value);" >
          <option value="0">Select</option>
          <?php foreach($complainant_type as $row):?>
          <?php if (!empty($camp)){             ?>
          <option value="<?php echo $row->complaint_capacity_id;?>" <?php echo ($camp == $row->complaint_capacity_id) ? 'selected' : '' ?>> <?php echo $row->complaint_capacity_desc; ?> </option>
          <?php }else{?>
          <option value="<?php echo $row->complaint_capacity_id; ?>" <?php echo set_select('complaint_capacity_id',  $row->complaint_capacity_id); ?>><?php echo $row->complaint_capacity_desc; ?></option>
          <?php }?>

          </option>
          <?php endforeach;?>
        </select>  
        <div class="error"><?php echo form_error('complaint_capacity_id'); ?></div>       
      </div>     
        
      <div class="col-md-6 mb-15">
        <label for="ps_id"><?php print_r($this->label->get_short_name($elements, 134)); ?><span class="text-danger">*</span><br></label>
        <select type="text" class="form-control" class="chosen-single chosen-default" name="ps_id" id="ps_id">
        </select>  
        <div class="error"><?php echo form_error('ps_id'); ?></div>     
      </div>  
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12 mb-15">
        <div id="otherid">
          <label class="text-orange" for="ps_othcate"><?php print_r($this->label->get_short_name($elements, 135)); ?></label>
            <input type="text" class="form-control" name="ps_othcate" id="ps_othcate" value="<?php if(isset($partc)) echo $partc['ps_othcate']; else echo set_value('ps_othcate');?>" maxlength="50" placeholder="">
        </div>
      </div>
    </div>


    <div id="comhide">
      <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 136)); ?>-</label>
      <div class="row">
        <?php $tas=$partc['tas_fingoi'] ?? ''; ?>
        <div class="col-md-12 mb-15">                   
          <label for="tas_fingoi"><?php print_r($this->label->get_short_name($elements, 137)); ?><span class="text-danger">*</span></label>    
          <div class="radio">
            <label><input type="radio" name="tas_fingoi" required="required" value="1" <?php  echo set_value('tas_fingoi', $tas) == 1 ? "checked" : ""; ?> /> Yes </label>
            <label><input type="radio" name="tas_fingoi" required="required" value="2" <?php  echo set_value('tas_fingoi', $tas) == 2 ? "checked" : ""; ?> /> No </label>
          </div>
          <div class="error"><?php echo form_error('ps_id'); ?></div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-15"> 
          <?php $anninc=$partc['anninc_onecr'] ?? ''; ?>                  
          <label for="anninc_onecr"><?php print_r($this->label->get_short_name($elements, 138)); ?><span class="text-danger">*</span></label>
          <div class="radio">
            <label><input type="radio" name="anninc_onecr" required="required" value="1" <?php  echo set_value('anninc_onecr', $anninc) == 1 ? "checked" : ""; ?> /> Yes </label>
            <label><input type="radio" name="anninc_onecr" required="required" value="2" <?php  echo set_value('anninc_onecr', $anninc) == 2 ? "checked" : ""; ?> /> No </label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-15">    
          <?php $dona=$partc['dona_fs'] ?? ''; ?>
          <label for="dona_fs"><?php print_r($this->label->get_short_name($elements, 139)); ?><span class="text-danger">*</span></label>
          <div class="radio">
            <label><input type="radio" name="dona_fs" required="required" value="1" <?php  echo set_value('dona_fs', $dona) == 1 ? "checked" : ""; ?> /> Yes </label>
            <label><input type="radio" name="dona_fs" required="required" value="2" <?php  echo set_value('dona_fs', $dona) == 2 ? "checked" : ""; ?> /> No </label>
          </div>      
        </div>
      </div>
    </div>

    <div class="row"> 
      <?php $pss=$partc['pss_sbbca'] ?? ''; ?> 
      <div class="col-md-12 mb-15">
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 140)); ?></label>
        <div class="radio">
          <label><input type="radio" name="pss_sbbca" id="Active" checked="checked" value="1" <?php  echo set_value('pss_sbbca', $pss) == 1 ? "checked" : ""; ?> /> Yes </label>
          <label><input type="radio" name="pss_sbbca" value="2" <?php  echo set_value('pss_sbbca', $pss) == 2 ? "checked" : ""; ?> /> No </label>
        </div> 
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 141)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="psc_postheld" id="psc_postheld" value="<?php if(isset($partc)) echo $partc['psc_postheld']; else echo set_value('psc_postheld');?>" onkeypress="return ValidateAlpha(event)" maxlength="1000" placeholder="">   
        <div class="error"><?php echo form_error('psc_postheld'); ?></div>        
      </div>
    </div>

    <hr>

    <div class="row"> 
      <div class="col-md-12 mb-15">
        <label class="text-orange">9. Details of the Cause of Action/offence (under the Prevention of Corruption Act, 1988) -</label>
      </div>
      <div class="col-md-12">
        <label>(i). Period during which alleged misconduct was committed.<span class="text-danger">*</span></label>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="periodf_coa"><?php print_r($this->label->get_short_name($elements, 143)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="periodf_coa"
              value="<?php if(isset($partc)) echo get_displaydate($partc['periodf_coa']); else echo set_value('periodf_coa');?>" id="periodf_coa" placeholder="">
        <div class="error"><?php echo form_error('periodf_coa'); ?></div> 
      </div> 

      <div class="col-md-6 mb-15">
        <label for="periodt_coa"><?php print_r($this->label->get_short_name($elements, 144)); ?><span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="periodt_coa" id="periodt_coa" 
              value="<?php if(isset($partc)) echo get_displaydate($partc['periodt_coa']); else echo set_value('periodf_coa');?>" placeholder="">
        <div class="error"><?php echo form_error('periodt_coa'); ?></div> 
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="ps_pl_occ"><?php print_r($this->label->get_short_name($elements, 145)); ?><span class="text-danger">*</span></label>       
        <input type="text" class="form-control" name="ps_pl_occ" id="ps_pl_occ" value="<?php if(isset($partc)) echo $partc['ps_pl_occ']; else echo set_value('ps_pl_occ');?>" maxlength="150" onkeypress="return ValidateAlpha(event)" placeholder=""> 
        <div class="error"><?php echo form_error('ps_pl_occ'); ?></div>       
      </div>

      <?php $ps_pl_state=$partc['ps_pl_stateid'] ?? ''; ?>
      <div class="col-md-6 mb-15">
        <label for="ps_pl_stateid"><?php print_r($this->label->get_short_name($elements, 92)); ?><span class="text-danger">*</span></label>  
        <select type="text" class="form-control chosen-single chosen-default" name="ps_pl_stateid" id="ps_pl_stateid" onChange="getDistrict(this.value);" >
          <option value="">Select state</option>
            <?php foreach($state as $row):?>
            <?php if (!empty($ps_pl_state)){             ?>
            <option value="<?php echo $row->state_code;?>" <?php echo ($ps_pl_state == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
            <?php }else{?>
          <option value="<?php echo $row->state_code; ?>" <?php echo set_select('ps_pl_stateid',  $row->state_code); ?>><?php echo $row->name; ?></option>
            <?php } ?>
            <?php endforeach;?>
        </select>
        <div class="error"><?php echo form_error('ps_pl_stateid'); ?></div>    
      </div>
  
      <div class="col-md-6 mb-15">
        <label for="ps_pl_dist_id"><?php print_r($this->label->get_short_name($elements, 93)); ?><span class="text-danger">*</span></label>
        <select type="text" class="form-control chosen-single chosen-default" name="ps_pl_dist_id" id="ps_pl_dist_id">  
        </select>
        <div class="error"><?php echo form_error('ps_pl_dist_id'); ?></div>         
      </div>  
    </div> 

    <hr>

    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 146)); ?>-</label>
      </div>
      <div class="col-md-8 mb-15">
        <label for="sum_facalle"><?php print_r($this->label->get_short_name($elements, 147)); ?><span class="text-danger">*</span></label>
        <?php  $sum_facalle=$partc['sum_facalle'] ?? '';?>
        <textarea class="form-control" rows="4" cols="100" id="sum_facalle" name="sum_facalle" maxlength="3000" placeholder="type here...">
          <?php if(isset($partc)) echo $partc['sum_facalle']; else echo set_value('sum_facalle');?>  
        </textarea> 
        <div class="error"><?php echo form_error('sum_facalle'); ?></div>     
      </div>
      <?php    $sum_fact_allegation_upload=$partc['sum_fact_allegation_upload'] ?? ''; ?>
      <div class="col-md-4 mb-15">
        <label for="sum_fact_allegation_upload">Upload Summary of Fact/allegation <span class="text-danger">*</span></label>
        <input type="file" id="sum_fact_allegation_upload" name="sum_fact_allegation_upload" class="form-control" accept=".pdf" size="20">
        <span class="text-danger">The File should not greater than 20 MB (only pdf file allowed)</span>
        <div class="error" id="sum_fact_allegation_upload_error"><?php echo form_error('sum_fact_allegation_upload'); ?></div>
        <?php if($sum_fact_allegation_upload !='')  {?>
        <div><a href="<?php echo base_url().$sum_fact_allegation_upload; ?>" target="_blank" alt="">show uploaded document </a></div>
        <?php } ?>
      </div>
    </div>

    <div class="row">    
      <div class="col-md-8 mb-15">
        <label for="det_offen"><?php print_r($this->label->get_short_name($elements, 148)); ?></label><br>
        <?php  $det_offen=$partc['det_offen'] ?? '';?>
        <textarea class="form-control det_offen" rows="4" cols="100" id="det_offen" name="det_offen" maxlength="3000" placeholder="type here..." >
        <?php if(isset($partc)) echo $partc['det_offen']; else echo set_value('det_offen');?> 
        </textarea>
      </div>

      <?php    $detail_offence_upload=$partc['detail_offence_upload'] ?? ''; ?>
      <div class="col-md-4 mb-15">
        <label for="det_offen_upload">Upload Detail Offence <span class="text-danger">*</span></label> 
        <input type="file" id="detail_offence_upload" name="detail_offence_upload" class="form-control" accept=".pdf">
        <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
        <div class="error" id="detail_offence_upload_error"><?php echo form_error('detail_offence_upload'); ?></div>
        <?php if($detail_offence_upload !='')  {?>
        <div><a href="<?php echo base_url().$detail_offence_upload; ?>" target="_blank" alt="">show uploaded document </a></div>
      <?php } ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 mb-15">
        <label for="prov_viola"><?php print_r($this->label->get_short_name($elements, 149)); ?></label>       
          <input type="text" class="form-control" name="prov_viola" id="prov_viola" value="<?php if(isset($partc)) echo $partc['prov_viola']; else echo set_value('prov_viola');?>" maxlength="100" onkeypress="return ValidateAlpha(event)" placeholder="">        
      </div>
    </div>
    
    <hr>
    
    <div class="row">
      <div class="col-md-12 mb-15">
        <label class="text-orange">11. Names of Witnesses in support of the allegations, if any -</label>
        <div class="alert alert-info">
          * furnish details in respect of each Witnesses in support of the allegations.
          <button type="button" class="btn btn-success" onclick="window.open('<?php echo site_url("respondent/witnessdetail");?>')">Click here</button>
        </div>
      </div>
    </div>

    <div class="row">
      <?php  $reil_doc=$partc['relied_doc_list'] ?? '';?>
      <div class="col-md-8 mb-15">  
        <label class="text-orange">12. Particulars/List of the documents relied upon by the Complainant in support of the allegation: <span class="text-danger">*</span></label> 
        <textarea class="form-control" name="relied_doc_list" id="relied_doc_list" maxlength="500" rows="4" cols="100" wrap="hard">
         <?php if(isset($partc)) echo $partc['relied_doc_list']; else echo set_value('relied_doc_list');?>
        </textarea>  
      </div>

      <?php    $relevant_evidence_upload=$partc['relevant_evidence_upload'] ?? ''; ?>
      <div class="col-md-4 mb-15">
        <label for="relevant_evidence_upload">Upload Relevant evidence <span class="text-danger">*</span></label>
        <input type="file" id="relevant_evidence_upload" name="relevant_evidence_upload" class="form-control" accept=".pdf" size="20">
        <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
        <div class="error" id="relevant_evidence_upload_error"><?php echo form_error('relevant_evidence_upload'); ?></div>
        <div>
        <?php if($relevant_evidence_upload !='')  {?>
        <a href="<?php echo base_url().$relevant_evidence_upload; ?>" target="_blank" alt="">show uploaded document </a>
        <?php } ?>
        </div>
      </div>
    </div>

    <div class="row">     
      <div class="col-md-12 mb-15"> 
        <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 150)); ?>:</label>  
        <input type="text" class="form-control" name="any_othInfo" id="any_othInfo" value="<?php if(isset($partc)) echo $partc['any_othInfo']; else echo set_value('any_othInfo');?>"  maxlength="250"  placeholder="">        
      </div>
    </div>

    <hr>

    <div class="row">
    <?php $doc_copy=$partc['doc_copy_attached'] ?? ''; ?> 
      <div class="col-md-12 mb-15">
        <label class="text-orange"><span class="text-danger">*</span><?php print_r($this->label->get_short_name($elements, 151)); ?></label>
        <div class="radio">
          <label><input type="radio" name="doc_copy_attached" id="Active" checked="checked" required="required" value="1" <?php  echo set_value('doc_copy_attached', $doc_copy) == 1 ? "checked" : ""; ?> /> Yes </label>
          <label><input type="radio" name="doc_copy_attached" required="required" value="2" <?php  echo set_value('doc_copy_attached', $doc_copy) == 2 ? "checked" : ""; ?> /> No</label>
        </div>     
      </div>     
    </div>

    <div class="row">
      <div class="col-md-12 mb-15">   
        <label class="text-orange"><span class="text-danger">*</span><?php print_r($this->label->get_short_name($elements, 152)); ?></label>
        <?php $electronic=$partc['electronic_file'] ?? ''; ?>                 
        <div class="radio">
          <label><input type="radio" name="electronic_file" id="Active" checked="checked" required="required" value="1" <?php  echo set_value('electronic_file', $electronic) == 1 ? "checked" : ""; ?> /> Yes</label>
          <label><input type="radio" name="electronic_file" required="required" value="2" <?php  echo set_value('electronic_file', $electronic) == 2 ? "checked" : ""; ?> /> No</label>
        </div> 
      </div>
    </div>

    <?php 
      if(isset($farma))
        {
          $myArray=(array)$farma;                   
          $myArray[0]->comp_f_place;
          $curYear = date('Y');
          $curMonth = date('m');
          $curDay = date('d');
          $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
          $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
          //  $comp_f_date="$curYear-$curMonth-$curDay"; 
          $comp_f_date="$curDay-$curMonth-$curYear";  

        }
    ?>

    <div class="row">
      <div class="col-md-6 mb-15">
        <label for="comp_f_place"><?php print_r($this->label->get_short_name($elements, 49)); ?></label>
        <input type="text" class="form-control" name="comp_f_place"  value="<?php echo $myArray[0]->comp_f_place ?? '';?>" readonly="readonly"  >
      </div>
      <div class="col-md-6 mb-15" hidden="true">
        <label for="comp_f_date"><?php print_r($this->label->get_short_name($elements, 50)); ?></label>
        <input type="text" class="form-control" name="comp_f_date" value="<?php echo $comp_f_date ?? '';?>" readonly="readonly">
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 mb-15 text-right">
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


 






 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                 autoclose: true,  
                $('#periodf_coa').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
       

        $(document).ready(function () {
                 autoclose: true,  
                $('#periodt_coa').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });

               $('#periodf_coa').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  });

                $('#periodt_coa').datepicker({
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
function removeTextAreaWhiteSpace() {
var myTxtArea = document.getElementById('sum_facalle');
myTxtArea.value = myTxtArea.value.replace(/^\s*|\s*$/g,'');
}

function removeTextAreaWhiteSpace() {
var myTxtArea = document.getElementById('det_offen');
myTxtArea.value = myTxtArea.value.replace(/^\s*|\s*$/g,'');
}*/

function removeTextAreaWhiteSpace() {
var myTxtArea = document.getElementById('relied_doc_list');
myTxtArea.value = myTxtArea.value.replace(/^\s*|\s*$/g,'');
}

</script>

<script type="text/javascript">
  $('input#sum_fact_allegation_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#sum_fact_allegation_upload_error').text('Fact allegation file must be less then 20 MB');
    return false;
  }else{
    $('#sum_fact_allegation_upload_error').text('');
  }
});

   $('input#detail_offence_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#detail_offence_upload_error').text('Detail offence file must be less then 20 MB');
    return false;
  }else{
    $('#detail_offence_upload_error').text('');
  }
});

   $('input#relevant_evidence_upload').bind('change', function() {
 // var maxSizeKB = 20; //Size in KB
  var maxSize =20000000; //File size is returned in Bytes
  if (this.files[0].size > maxSize) {
    $(this).val("");
    //alert("Max size exceeded");
    $('#relevant_evidence_upload_error').text('Relevant Evidence file must be less then 20 MB');
    return false;
  }else{
    $('#relevant_evidence_upload_error').text('');
  }
});
</script>



