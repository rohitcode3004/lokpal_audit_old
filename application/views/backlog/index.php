<?php
//if(isset($legacy_data)) 
  //print_r($legacy_data);
?>
<!DOCTYPE html>
<html lang="en">
<head> 
   <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/bootstrap/css/chosen.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/custom_style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <!--<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>-->
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>


  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
</head>
<body>
  <section class="content">

        <?php
        if($this->session->flashdata('success_msg'))
        {
         echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>'.$this->session->flashdata('success_msg').'</h4></div>';
        }
        if($this->session->flashdata('error_msg'))
        {
         echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>
         <h4>'.$this->session->flashdata('error_msg').'</h4></div>';
        }
        if($this->session->flashdata('upload_error'))
        {
         echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>
         <h4>'.$this->session->flashdata('upload_error').'</h4></div>';
        }

        ?>

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
                 <?php if(isset($legacy_data)) { ?>
        
        <a href="<?php echo base_url(); ?>backlog/legacy_pdf" class="previous">&laquo; Back</a>
      <?php } ?>
        
        <!-- /.box-header -->
        <div class="box-body">
         
         <div class="col-md-2">  </div><br>
         <fieldset>
          
           <div class="panel-default">
            <div class="panel-heading">
              <span id="ContentPlaceHolder1_search" class="searchComplaint" placeholder="Search"></span>
              <h5 class="panel-title">
               
                Legacy Data Entry Form
              </h5>
            </div>
            <b><h2 class="searchComplaint"></h2></b>
          </div>

           <?php if(isset($legacy_data)) { ?>

          <form id="filingform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action="<?php echo base_url();?>backlog/update/<?php echo $legacy_data[0]->id; ?>" name="backlog-form" enctype="multipart/form-data" novalidate="">
            <input type="hidden" name="id" value="<?php echo $legacy_data[0]->id; ?>">
          <?php } else { ?>
            <form id="filingform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action="<?php echo base_url();?>backlog/create" name="backlog-form" enctype="multipart/form-data" novalidate="">
            <?php } ?>
               <div class="form_error">
              </div>

            <!--<div class="searchComplaint" style="float: right;    margin-right: 36px;">-->
                              
              <!--  <label for="complaintMode_id" >Refrence Number-</label>  
                <span style="color: red"><b>  286636292</b></span>-->
              <!--?php// } ?-->
            <!--</div>-->
        <br><br><br>
            <div style="padding: 10px 0px 0px 20px; font-size: 16px; color: #0171b5;">FURNISHED THE FOLLOWING DETAILS AS PER THE COMPLAINT</div><br>

           <div class="searchComplaint">
             <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">1. Serial No.-</b></legend>   

           </div>  

           <div class="row">

         <div class="col-md-3">
          <label for="serial_no">Serial No.<span style="color: red;">*</span></label>
          <input type="text" class="form-control" style="width:90%;" name="serial_no" id="serial_no" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->serial_no : ''; ?>" maxlength="50" placeholder="" <?php echo (isset($legacy_data)) ? 'readonly' : ''; ?>>
          <label class="error"><?php echo form_error('serial_no'); ?></label>
        </div>

    </div> 

      <div class="searchComplaint">
       <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">2. Name of the complainant-</b></legend>
     </div>
          <div class="row">
     
       <div class="col-md-3 col-xs-12">                   
        <label for="salutation_id" >Title<span style="color: red;">*</span></label>    
        <select type="text" class="form-control" style="width:90%;" class="chosen-single chosen-default" name="salutation_id" id="salutation_id">
          <option value="">Select Title</option>
          <?php foreach($salution as $row):?>          
            <?php if (!empty($sal)){             ?>
           <option value="<?php echo $row->salutation_id;?>" <?php echo ($sal == $row->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
         <?php }elseif (isset($legacy_data)){             ?>
           <option value="<?php echo $row->salutation_id;?>" <?php echo ($row->salutation_id == $legacy_data[0]->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
         <?php }else{?>
          <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
        <?php }?>
          <?php endforeach;?>
        </select>  
        <label><?php echo form_error('salutation_id'); ?></label>       
      </div>


      <div class="col-md-3">
        <label for="sur_name">Surname</label>       
        <input type="text" class="form-control" name="sur_name" id="sur_name" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->sur_name : ''; ?>" style="width:90%;" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

      <div class="col-md-3">
        <label for="mid_name">Middle Name</label>      
        <input type="text" class="form-control" style="width:90%;" name="mid_name" id="mid_name" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->mid_name : ''; ?>" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

      <div class="col-md-3">
        <label for="first_name">First Name<span style="color: red;">*</span> </label>       
        <input type="text" class="form-control" name="first_name" id="first_name" maxlength="50" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->first_name : ''; ?>" style="width:90%;" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">     
        <label class="error"><?php echo form_error('first_name'); ?></label>  
      </div>   

</div>

    <br>

<div class="searchComplaint">
 <legend style="font color: red:" align="margin-left"><b style="font-size: 125%;color: indianred;">3. Address of the Complainant-</b></legend> 
</div>

<div class="row">
  <div class="col-md-3">
    <label for="p_hpnl">House/Property Number/Locality</label>
    <input type="text" class="form-control" style="width:90%;" name="p_hpnl" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->p_hpnl : ''; ?>" id="p_hpnl" maxlength="100" placeholder="">
  </div>
<div class="col-md-3">
    <label for="p_Add1">Name of Village / City</label>
    <input type="text" class="form-control" style="width:90%;" name="p_add1" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->p_add1 : ''; ?>" id="p_add1" maxlength="100" placeholder="">
  </div>

  <div class="col-md-3">
    <label for="p_state_id" class="col-lg-3 control-label">State</label>  
    <select type="text" class="form-control" name="p_state_id" id="p_state_id"  class="chosen-single chosen-default" onchange="javascript:get_district();" >
      <option value="">-- Select state --</option>
      <?php foreach($state as $row):?>
          <?php if(!empty($state1)){ ?>
           <option value="<?php echo $row->state_code;?>" <?php echo ($state1 == $row->state_code) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
         <?php } elseif(isset($legacy_data)){ ?>
           <option value="<?php echo $row->state_code;?>" <?php echo ($row->state_code == $legacy_data[0]->p_state_id) ? 'selected' : '' ?>> <?php echo $row->name; ?> </option>
         <?php }else{?>
        <option value="<?php echo $row->state_code; ?>" <?php echo set_select('p_state_id',  $row->state_code); ?>><?php echo $row->name; ?></option>
         <?php }?>
      <?php endforeach;?>
    </select> 
     <label class="error"><?php echo form_error('p_state_id'); ?></label>   
  </div> 
  
  <div class="col-md-3">
    <label for="p_dist_id">District</label>
    <select type="text" class="form-control" class="chosen-single chosen-default" style="width:90%;" name="p_dist_id" id="p_dist_id">
      <option value="">-- Select District --</option>
    </select>
    <label class="error"><?php echo form_error('p_dist_id'); ?></label>    
  </div>  
</div>
<div class="row">   
  <div class="col-md-3">
   <label for="p_pin_code">Pin Code/Postal or Zonal Code</label>   
   <input type="text" class="form-control" name="p_pin_code" style="width:90%;" id="p_pin_code" maxlength="6" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->p_pin_code : ''; ?>" onkeypress="return isNumberKey(event)" placeholder=""> 
 </div>

 <div class="col-md-3">
   <label for="p_country_id">Country</label>   
   <select type="text" class="form-control" style="width:90%;" class="chosen-single chosen-default" name="p_country_id" id="p_country_id">
    <option value=""class="chosen-single">Select Country</option>
    <?php foreach($getcountry as $row):?>
  
<?php if (!empty($nationalty2)){             ?>
           <option value="<?php echo $row->country_id;?>" <?php echo ($nationalty2 == $row->country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
         <?php }elseif(isset($legacy_data)){ ?>
           <option value="<?php echo $row->country_id;?>" <?php echo ($row->country_id == $legacy_data[0]->p_country_id) ? 'selected' : '' ?>> <?php echo $row->country_desc; ?> </option>
         <?php }else{?>
     <option value="<?php echo $row->country_id; ?>" <?php echo set_select('p_country_id',  $row->country_id); ?>><?php echo $row->country_desc; ?></option>
        <?php }?>
   <?php endforeach;?>
 </select>  
  <label class="error"><?php echo form_error('p_country_id'); ?></label>       
</div>
</div>

<div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">4. Name of the public servant against whom complaint is being made-</b></legend>   

  </div>
  <div class="row">
 
 <div class="col-md-3">                   
              <label for="ps_salutation_id" >Title</label>    
               <select type="text" class="form-control" style="width:90%;" class="chosen-single chosen-default" name="ps_salutation_id" id="ps_salutation_id">
                <option value="">Select Title</option>
                        <?php foreach($salution as $row):?>              
              <?php if (!empty($sal)){ ?>
           <option value="<?php echo $row->salutation_id;?>" <?php echo ($sal == $row->salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
         <?php }elseif (isset($legacy_data)){ ?>
           <option value="<?php echo $row->salutation_id;?>" <?php echo ($row->salutation_id == $legacy_data[0]->ps_salutation_id) ? 'selected' : '' ?>> <?php echo $row->salutation_desc; ?> </option>
         <?php }else{?>
              <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('ps_salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>
        <?php } ?>
                        <?php endforeach;  ?>
               </select>
               <label class="error"><?php echo form_error('ps_salutation_id'); ?></label>        
      </div>



      <div class="col-md-3">
        <label for="ps_sur_name">Surname</label>       
          <input type="text" class="form-control" name="ps_sur_name" id="ps_sur_name" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->ps_sur_name : ''; ?>" style="width:90%;" maxlength="25" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

       <div class="col-md-3">
        <label for="ps_mid_name">Middle Name</label>      
          <input type="text" class="form-control" style="width:90%;" name="ps_mid_name" id="ps_mid_name" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->ps_mid_name : ''; ?>" onkeypress="return ValidateAlpha(event)" maxlength="25" placeholder="" oninput="this.value = this.value.toUpperCase()">        
      </div>

      <div class="col-md-3">
        <label for="ps_first_name">First Name</label>    
          <input type="text" class="form-control" name="ps_first_name" id="ps_first_name" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->ps_first_name : ''; ?>" maxlength="50" style="width:90%;" onkeypress="return ValidateAlpha(event)" placeholder="" oninput="this.value = this.value.toUpperCase()">
           <label class="error"><?php echo form_error('ps_first_name'); ?></label>       
      </div>
</div>
<br>

<div class="searchComplaint">
   <legend style="font color: red:" align="margin-left"><b style="font-size: 125%;color: indianred;">5. Details of the public servant against whom complaint is being made -
</b></legend> 
 </div>
<div class="row">
 
         <div class="col-md-4">
          <label for="ps_desig">Designation of the officer/employee</label>
             <input type="text" class="form-control" name="ps_desig" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->ps_desig : ''; ?>" id="ps_desig" maxlength="150" placeholder="">
        </div>

        <div class="col-md-4">
        <label for="ps_orgn" class="col-md-8">Organisation/Agency having administrative control over the said officer/employee</label>       
          <input type="text" class="form-control" name="ps_orgn" id="ps_orgn" maxlength="50" value="<?php echo (isset($legacy_data)) ? $legacy_data[0]->ps_orgn : ''; ?>" onkeypress="return ValidateAlpha(event)" placeholder="">        
      </div>

      <div class="col-md-4">   

              <label for="complaint_capacity_id" class="col-md-8">Category of the public servant against whom the complaint is being made <span style="color: red;">*</span></label>    

<select type="text" class="form-control" name="complaint_capacity_id" id="complaint_capacity_id"  class="chosen-single chosen-default">
      <option value="">-- Select --</option>
      <?php foreach($ps_category_le as $row):?>
          <?php if(!empty($ps_category_le1)){ ?>
           <option value="<?php echo $row->id;?>" <?php echo ($ps_category_le1 == $row->id) ? 'selected' : '' ?>> <?php echo $row->category_name ; ?> </option>
         <?php } elseif(isset($legacy_data)){ ?>
           <option value="<?php echo $row->id;?>" <?php echo ($row->id == $legacy_data[0]->complaint_capacity_id) ? 'selected' : '' ?>> <?php echo $row->category_name ; ?> </option>
         <?php }else{?>
        <option value="<?php echo $row->id; ?>" <?php echo set_select('complaint_capacity_id',  $row->id); ?>><?php echo $row->category_name; ?></option>
         <?php }?>
      <?php endforeach;?>
              </select> 

               <label class="error"></label>       
      </div>
</div>

           <div class="searchComplaint">
             <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">6. Complaint Details-</b></legend>   

           </div>  

           <div class="row">

        <div class="col-md-3">
          <label for="dt_of_complaint">Date of Complaint<span style="color: red;">*</span></label> 
        
         <input type="text" class="form-control" style="width:90%;" name="dt_of_complaint" id="dt_of_complaint" value="<?php echo (isset($legacy_data)) ? get_displaydate($legacy_data[0]->dt_of_complaint) : ''; ?>" placeholder="">
         <label class="error"><?php echo form_error('dt_of_complaint'); ?></label>
       </div>
         <div class="col-md-6">
 <label for="summary">Summary of Complaint</label><br>
 
    <textarea class="form-control valid" rows="10" cols="100" id="summary" name="summary" maxlength="1000" placeholder="type here..." aria-invalid="false"><?php echo (isset($legacy_data)) ? $legacy_data[0]->summary : ''; ?>      
  </textarea>
 
</div>

<div class="col-md-3">
  <label for="order_upload" class="">Order Upload<?php if(!isset($legacy_data)) { ?><span style="color: red;">*</span><?php } ?></label>
  <input type="file" style="" id="order_upload" name="order_upload" class="form-control" accept=".pdf,.jpg" size="20">
  <label><?php if(isset($legacy_data))  { ?>
   <a href="<?php echo base_url();?><?php echo $legacy_data[0]->order_upload; ?>" target="_blank" alt="">show Uploaded document </a>
 <?php } ?></label>
 
</div>

    </div>  
    <br>  
    <input type="hidden" value="<?php echo isset($legacy_data) ? $legacy_data[0]->p_dist_id : '' ?>" name="" id="c_dist_id">

        <div class="row">

        <div class="col-md-12" align="center">
          <!--<button type="submit" class="btn btn-success">Save & next</button> <a href="http://localhost/lokpal_dev/applet/appletfiling" class="btn btn-primary">Cancel</a>-->
       
      <label><button type="submit" class="btn btn-success" id="submitbtn">Submit</button></label>

        </div>

      <!--  <div class="col-md-4">
          <button type="submit" class="btn btn-success">Save & next</button> <a href="http://localhost/lokpal_dev/applet/appletfiling" class="btn btn-primary">Cancel</a>
       
      <button type="submit" class="btn btn-success" id="submitbtn">Next</button>

        </div>-->
      </div>

                    </form>
                  </fieldset>
                </div>
              </div>
            </div>
          

        
        <div class="col-md-2">  </div>
      

    </section>
  </body>

  <script type="text/javascript">
    function get_district()
    {
      let dist_id_selected = $('#c_dist_id').val();;
      let state_id = $('#p_state_id').children("option:selected").val();
      //alert(state_id);
      jQuery.ajax({
        url: baseURL+'user/getdistrict',
        cache: false,
        type : 'post',
        data : 'stateid='+state_id,
        dataType : 'html',
        success: function(response) {
          $("#p_dist_id").append(response);  
          $("#p_dist_id").val(dist_id_selected); 
          }
        });
    }


    $(document).ready(function () {
      get_district();
      autoclose: true,  
      $('#dt_of_complaint').datepicker({
          format: "dd-mm-yyyy"
      });  
    });
  </script>
  </html>