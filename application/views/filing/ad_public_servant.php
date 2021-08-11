<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>
<!-- Bootstrap Datepicker  Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script> 
 

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

 <script language="javascript"> 
 function close_window() {
  if (confirm("Are you sure that you have saved the Additional Public Servant details?")) {
    close();
  }
}
</script>
 <script type="text/javascript">

  $(document).ready(function(){    //   hide section
  $("#otherid").hide();

  $("#comhide").hide();

    //$("#dvdatahide").hide();

      $(function () {        
        $("#ad_complaint_capacity_id").change(function () {
          var mod_party=$('#ad_complaint_capacity_id').val(); 
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
   <script type="text/javascript">

function PageComplain(value, value2)
 {
 var ps_id_selectedd=$('#ad_complaint_capacity_id').val();
 var post_url= '<?php echo base_url('user/getComplain')?>';
 var request_method= 'POST';
     $.ajax({
       url : post_url,
       type: request_method,
       data : 'stateid='+value,
    success: function(response){ //
        $("#ad_ps_id").html(response);          
        $("#ad_ps_id").val(value2);
       }
     });
  }

</script>

<script type="text/javascript">

 function modifyParty()
  {
    //alert("hello");
    var mod_party=$('#modify_party').val();  
   // alert(mod_party);  
  var post_url= '<?php echo base_url('respondent/getModify_ps')?>';
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
        //alert(json[0].w_first_name);
        pageRefesh(json[0].ad_ps_pl_stateid, json[0].ad_ps_pl_dist_id);
        PageComplain(json[0].ad_complaint_capacity_id, json[0].ad_ps_id);

        $('#ad_ps_salutation_id').val(json[0].ad_ps_salutation_id);
        $('#ad_ps_first_name').val(json[0].ad_ps_first_name);
        $('#ad_ps_sur_name').val(json[0].ad_ps_sur_name);
        $('#ad_ps_mid_name').val(json[0].ad_ps_mid_name); 
        $('#ad_ps_dsp_lp').val(json[0].ad_ps_dsp_lp);
         $('#ad_present_ps_desig').val(json[0].ad_present_ps_desig);
       
        var ad_ps_dsp_lp=(json[0].ad_ps_dsp_lp);       
        if(ad_ps_dsp_lp ==1)
          {            
            $('input[name="ad_ps_dsp_lp"][value="' + ad_ps_dsp_lp + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="ad_ps_dsp_lp"][value="' + ad_ps_dsp_lp + '"]').prop('checked', true);
          }   
     
        $('#ad_ps_desig').val(json[0].ad_ps_desig);
        $('#ad_ps_orgn').val(json[0].ad_ps_orgn);
        $('#ad_complaint_capacity_id').val(json[0].ad_complaint_capacity_id);
         $('#ad_ps_id').val(json[0].ad_ps_id); 
        // alert(json[0].w_state_id);
        $('#ad_ps_othcate').val(json[0].ad_ps_othcate);
        
       
        $('#ad_tas_fingoi').val(json[0].ad_tas_fingoi);
         var ad_tas_fingoi=(json[0].ad_tas_fingoi);       
        if(ad_tas_fingoi ==1)
          {            
            $('input[name="ad_tas_fingoi"][value="' + ad_tas_fingoi + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="ad_tas_fingoi"][value="' + ad_tas_fingoi + '"]').prop('checked', true);
          }  


        $('#ad_anninc_onecr').val(json[0].ad_anninc_onecr);
        var ad_anninc_onecr=(json[0].ad_anninc_onecr);       
        if(ad_anninc_onecr ==1)
          {            
            $('input[name="ad_anninc_onecr"][value="' + ad_anninc_onecr + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="ad_anninc_onecr"][value="' + ad_anninc_onecr + '"]').prop('checked', true);
          } 

        $('#ad_dona_fs').val(json[0].ad_dona_fs);
        var ad_dona_fs=(json[0].ad_dona_fs);       
        if(ad_dona_fs ==1)
          {            
            $('input[name="ad_dona_fs"][value="' + ad_dona_fs + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="ad_dona_fs"][value="' + ad_dona_fs + '"]').prop('checked', true);
          }

        $('#ad_pss_sbbca').val(json[0].ad_pss_sbbca);
         var ad_pss_sbbca=(json[0].ad_pss_sbbca);       
        if(ad_pss_sbbca ==1)
          {            
            $('input[name="ad_pss_sbbca"][value="' + ad_pss_sbbca + '"]').prop('checked', true);
          }
        else
          {           
              $('input[name="ad_pss_sbbca"][value="' + ad_pss_sbbca + '"]').prop('checked', true);
          } 

        $('#ad_psc_postheld').val(json[0].ad_psc_postheld);
         $('#ad_periodf_coa').val(json[0].ad_periodf_coa);
        $('#ad_periodt_coa').val(json[0].ad_periodt_coa);
        $('#ad_ps_pl_occ').val(json[0].ad_ps_pl_occ);

        $('#ad_ps_pl_stateid').val(json[0].ad_ps_pl_stateid);
        $('#ad_ps_pl_dist_id').val(json[0].ad_ps_pl_dist_id);
        }      
      });
   }



  

  function getDistrict(value)
  {     
  var ps_id_selected = "<?= $ds; ?>";
  var post_url= '<?php echo base_url('user/getdistrict1')?>';
  var request_method= 'POST';
   $("#ad_ps_pl_dist_id").html('');
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      success: function(response){
        $("#ad_ps_pl_dist_id").append(response);  
        $("#ad_ps_pl_dist_id").val(ps_id_selected);   
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
        $("#ad_ps_pl_dist_id").html(response);
        $('#ad_ps_pl_dist_id').val(dist_id); 
        }       
      });
   }
 

  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#ad_public_servant").validate({
 
      onkeyup: false,

      rules: {  
        ad_ps_salutation_id: "required",   
        ad_ps_first_name: "required",
        ad_complaint_capacity_id:"required",
        ad_ps_id:"required",
        ad_ps_pl_stateid: "required",
        ad_ps_pl_dist_id:"required",    
        ad_present_ps_desig:"required",  
        ad_ps_desig:"required", 
        ad_ps_orgn:"required", 
        ad_psc_postheld:"required", 
        ad_periodf_coa:"required", 
        ad_periodt_coa:"required", 
        ad_ps_pl_occ:"required",          
      },
      messages: {
        groups_err: "Please select roll",
        fname_err: "Please enter your firstname",
        //lname_err: "Please enter your lastname",
        
       
      }
    });
    
  });
   
      
 </script>
 
 <style>
 
  

 
  </style>


<?php 
$ref_no=$this->session->userdata('ref_no');
//print_r($array);
  //$array['ref_no'];

 // echo "<pre>";
 // print_r($complainant_type); 
  
  //var_dump($data['state']);
  
   ?>
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
          <div class="panel-heading text-center">Additional Public Servant Details</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">     


    <form id="ad_public_servant" class="form-horizontal" role="form" method="post" action='<?= base_url();?>respondent/ad_ps_save'  name="witnessform" enctype="multipart/form-data">
      <div class="form_error">
        <?php echo validation_errors(); ?>
      </div>

      <div class="alert alert-info">NOTE: This form can be filled multiple times if the number of public servants EXCEEDS one</div>

      <div class="row">      
        <?php if (isset($ref_no)) {?>
        <div class="col-md-3">                   
            <!--  <label for="complaintMode_id" >Reference Number-</label>  
            <span style="color: red"><b>  <?php echo $ref_no; ?></b></span>  -->     
        </div>
        <?php } ?>
      </div>

      <?php  
        if(!empty($success_msg)){ 
          echo "hello";
            echo '<div>'.$success_msg.'</div>'; 
        }elseif(!empty($error_msg)){ 

          echo "Hi";
            echo '<div>'.$error_msg.'</div>'; 
        } 
        echo '<div>'.$this->session->flashdata('success_msg').'</div>';
      ?>


      <?php
        if(count($addparty)) { ?>  
        <div class="row">
          <div class="col-md-12 col-xs-12">                   
            <label for="modify_party" ><span class="text-danger">Select additioal public servant for modification</label> 
            <select type="text" class="form-control chosen-single chosen-default" name="modify_party" id="modify_party" onChange="modifyParty(this.value);">
              <option value="">-- Select public servant --</option>
              <?php foreach($addparty as $row):?>
              <option value="<?php echo $row->ps_detail;?>"><?php echo $row->ps_detail; ?> </option>
              <?php endforeach;?>
            </select>        
          </div>
        </div>
      <?php } ?>

      <div class="row">
        <div class="col-md-12"> 
          <h4 class="text-theme mb-15"><?php print_r($this->label->get_short_name($elements, 129)); ?></h4>
          <label class="text-orange">1. Name of the public servant(s) against whom complaint is being made (in block letters)* -</label>
        </div>
        <div class="col-md-3 mb-15">                   
          <label for="ad_ps_salutation_id" ><?php print_r($this->label->get_short_name($elements, 75)); ?><span class="text-danger">*</span></label>    
          <select type="text" class="form-control chosen-single chosen-default" name="ad_ps_salutation_id" id="ad_ps_salutation_id">
            <option value="">Select Title</option>
            <?php foreach($salution as $row):?>
            <option value="<?php echo $row->salutation_id;?>"> <?php echo $row->salutation_desc; ?> </option>
            <?php endforeach;?>
          </select>        
        </div>

        <div class="col-md-3 mb-15">
          <label for="ad_ps_sur_name"><?php print_r($this->label->get_short_name($elements, 76)); ?></label>     
          <input type="text" class="form-control" name="ad_ps_sur_name" id="ad_ps_sur_name" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">        
        </div>

        <div class="col-md-3 mb-15">
          <label for="ad_ps_mid_name"><?php print_r($this->label->get_short_name($elements, 77)); ?></label>      
          <input type="text" class="form-control" name="ad_ps_mid_name" id="ad_ps_mid_name" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()">        
        </div>

        <div class="col-md-3 mb-15">
          <label for="ad_ps_first_name"> <?php print_r($this->label->get_short_name($elements, 78)); ?><span class="text-danger">*</span></label>      
          <input type="text" class="form-control" name="ad_ps_first_name" id="ad_ps_first_name" maxlength="50" onkeypress="return ValidateAlpha(event)" maxlength="50" placeholder="" oninput="this.value = this.value.toUpperCase()">        
        </div> 
      </div>

      <div class="row">
        <div class="col-md-12 mb-15">
          <label class="text-orange">2. Present designation/status of the public servant(s) against whom complaint is being made<span class="text-danger">*</span> -</label>
          <input type="text" class="form-control" name="ad_present_ps_desig" id="ad_present_ps_desig" value="<?php if(isset($partc)) echo $partc['ad_present_ps_desig']; else echo set_value('ad_present_ps_desig');?>" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="" >      
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-15">                   
          <label class="text-orange" for="ad_ps_dsp_lp"><?php print_r($this->label->get_short_name($elements, 130)); ?><span class="text-danger">*</span></label>    
          <div class="radio">
            <label><input type="radio" name="ad_ps_dsp_lp" id="Active" required="required" value="1" checked="checked"> Yes</label>
            <label><input type="radio" name="ad_ps_dsp_lp" id="Inactive" required="required" value="2" > No</label>
          </div>
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12">
          <label class="text-orange">4. With respect to serial no. 2 above, indicate:</label>
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-4 mb-15">
          <label for="ad_ps_desig"><?php print_r($this->label->get_short_name($elements, 131)); ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="ad_ps_desig"  id="ad_ps_desig" maxlength="150" placeholder="">
        </div>
        <div class="col-md-8 mb-15">
          <label for="ad_ps_orgn"><?php print_r($this->label->get_short_name($elements, 132)); ?><span class="text-danger">*</span></label>       
          <input type="text" class="form-control" name="ad_ps_orgn" id="ad_ps_orgn" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="">        
        </div>
      </div>

      <div class="row">   
        <div class="col-md-6 mb-15"> 
          <label class="text-orange" for="ad_complaint_capacity_id"><?php print_r($this->label->get_short_name($elements, 133)); ?><span class="text-danger">*</span></label>    
          <select type="text" class="form-control chosen-single chosen-default" name="ad_complaint_capacity_id" id="ad_complaint_capacity_id" onChange="PageComplain(this.value);" >
            <option value="">Select</option>
            <?php foreach($complainant_type as $row):?>
            <option value="<?php echo $row->complaint_capacity_id;?>"> <?php echo $row->complaint_capacity_desc; ?> </option>              
            <?php endforeach;?>
          </select>        
        </div> 
       
        <div class="col-md-6 mb-15">
          <label for="ad_ps_id"><?php print_r($this->label->get_short_name($elements, 134)); ?><span class="text-danger">*</span></label>
          <select type="text" class="form-control chosen-single chosen-default" name="ad_ps_id" id="ad_ps_id">
              
          </select>     
        </div>  

        <div class="col-md-6 mb-15">
          <div id="otherid">
            <label for="ad_ps_othcate"><?php print_r($this->label->get_short_name($elements, 135)); ?><span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="ad_ps_othcate" id="ad_ps_othcate" maxlength="50" placeholder="">
          </div>
        </div>
      </div>

      <div id="comhide">
        <div class="row"> 
          <div class="col-md-12">
            <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 136)); ?>-</label>
          </div>
        </div>

        <div class="row">
          <?php //$tas=$partc['tas_fingoi'] ?? ''; ?>
          <div class="col-md-6 mb-15">                   
            <label for="ad_tas_fingoi"><?php print_r($this->label->get_short_name($elements, 137)); ?><span class="text-danger">*</span></label>
            <div class="radio">
              <label><input type="radio" name="ad_tas_fingoi" id="Active" required="required" value="1"> Yes</label>
              <label><input type="radio" name="ad_tas_fingoi" id="Inactive" required="required" value="2"> No</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-15"> 
            <?php // $anninc=$partc['anninc_onecr'] ?? ''; ?>                  
            <label for="ad_anninc_onecr"><?php print_r($this->label->get_short_name($elements, 138)); ?><span class="text-danger">*</span></label>    
            <div class="radio">
              <label><input type="radio" name="ad_anninc_onecr" id="Active" required="required" value="1"> Yes</label>
              <label><input type="radio" name="ad_anninc_onecr" id="Inactive" required="required" value="2"> No</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-15">    
          <?php // $dona=$partc['dona_fs'] ?? ''; ?> 
            <label for="ad_dona_fs"><?php print_r($this->label->get_short_name($elements, 139)); ?><span class="text-danger">*</span></label>
            <div class="radio">
              <label><input type="radio" name="ad_dona_fs" id="Active" required="required" value="1"> Yes</label>
              <label><input type="radio" name="ad_dona_fs" id="Inactive" required="required" value="2"> No</label>
            </div>      
          </div>
        </div>
      </div>

      <div class="row"> 
        <?php // $pss=$partc['pss_sbbca'] ?? ''; ?> 
        <div class="col-md-12 mb-15">
          <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 140)); ?></label>
          <div class="radio">
            <label><input type="radio" name="ad_pss_sbbca" id="Active" value="1" checked="checked"> Yes</label>
            <label><input type="radio" name="ad_pss_sbbca" id="Inactive" value="2"> No</label>
          </div> 
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12 mb-15"> 
          <label class="text-orange"><?php print_r($this->label->get_short_name($elements, 141)); ?><span class="text-danger">*</span></label>      
          <input type="text" class="form-control" name="ad_psc_postheld" id="ad_psc_postheld" value="<?php echo $partc['psc_postheld'] ?? '';?>" onkeypress="return ValidateAlpha(event)" maxlength="150" placeholder="">        
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12 mb-15">
          <label class="text-orange">9. Details of the Cause of Action/offence (under the Prevention of Corruption Act, 1988) -</label><br>
          <label for="periodf_coa">(i). Period during which alleged misconduct was committed.</label>
        </div> 
        <div class="col-md-6 mb-15">
          <label for="ad_periodf_coa"><?php print_r($this->label->get_short_name($elements, 143)); ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="ad_periodf_coa" value="<?php
                if(isset($partc)){
              echo get_displaydate($partc['ad_periodf_coa']) ?? ''; } ?>" id="ad_periodf_coa" placeholder="">
        </div> 

        <div class="col-md-6 mb-15">
          <label for="ad_periodt_coa"><?php print_r($this->label->get_short_name($elements, 144)); ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="ad_periodt_coa" id="ad_periodt_coa" value="<?php if(isset($partc)){
              echo get_displaydate($partc['ad_periodt_coa']) ?? ''; }?>" placeholder="">
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-6 mb-15">
          <label for="ad_ps_pl_occ"><?php print_r($this->label->get_short_name($elements, 145)); ?><span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="ad_ps_pl_occ" id="ad_ps_pl_occ" maxlength="150" onkeypress="return ValidateAlpha(event)" placeholder="">        
        </div>

        <?php $ps_pl_state=$partc['ps_pl_stateid'] ?? ''; ?>
        <div class="col-md-6 mb-15">
          <label for="ad_ps_pl_stateid"><?php print_r($this->label->get_short_name($elements, 92)); ?><span class="text-danger">*</span></label>  
          <select type="text" class="form-control" name="ad_ps_pl_stateid" id="ad_ps_pl_stateid" class="chosen-single chosen-default" onChange="getDistrict(this.value);" >
            <option value="">Select state</option>
            <?php foreach($state as $row):?>
            <option value="<?php echo $row->state_code;?>" <?php echo ($ps_pl_state == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
            <?php endforeach;?>
          </select>   
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-15">
          <label for="ad_ps_pl_dist_id"><?php print_r($this->label->get_short_name($elements, 93)); ?><span class="text-danger">*</span></label>
          <select type="text" class="form-control chosen-single chosen-default" name="ad_ps_pl_dist_id" id="ad_ps_pl_dist_id">  
              
          </select> 
        </div>  
      </div> 


      <div class="row">

           <?php if(!empty($addparty)){ ?>  
        <div class="col-md-6 mb-15">
          <button type="button" class="btn btn-primary"  onclick="window.open('<?php echo site_url("respondent/ad_public_servant");?>')">Do you want to add more click here</button>
              <?php  }?>
          
        </div>
        <div class="col-md-12 mb-15 text-right">
          <button type="submit" class="btn btn-success" id="submitbtn">Save public servant details</button>
          <a class="btn btn-danger" href="javascript:close_window();"><span>Close this windows</span></a>
        </div>
      </div>  

      <?php
       $curYear = date('Y');
        $curMonth = date('m');
        $curDay = date('d');
        $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
        $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
        $comp_f_date="$curYear-$curMonth-$curDay";
      ?>
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
                $('#ad_periodf_coa').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
       

        $(document).ready(function () {
                 autoclose: true,  
                $('#ad_periodt_coa').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });

               $('#ad_periodf_coa').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  });

                $('#ad_periodt_coa').datepicker({
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

        </script>


</body></html>



