<?php //include(APPPATH.'views/templates/front/header2.php'); ?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  
<script type="text/javascript">


   $().ready(function() {
    // validate signup form on keyup and submit
    $("#phisicalform").validate({
      onkeyup: false,
      rules: {  
                  
        phisicalcopy_upload: {required: true, accept: "application/pdf"},
       email_id: {
        required:true,
        email: true,          
      },
 
      agree: "required",
      //affidavit_upload:{ accept: "application/pdf,image/jpg,image/jpeg" }     
    },
    messages: { 
     phisicalcopy_upload:{ accept: "Only pdf formats are allowed" },       

    }

  });
    
  });
</script>

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <!--<h4 class="page-title">Filing Entry</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>-->
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php 
          $ref_no=$this->session->userdata('ref_no');
          include(APPPATH.'views/templates/front/stepwise_navigator.php');              
        ?>
        <div class="panel panel-warring">
          <div class="panel-heading text-center">Physical Complaint Copy Upload Form</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

    
    <form id="phisicalform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>/document/phisical_copy_upload'  name="phisicalform" enctype="multipart/form-data">

      <div class="form_error">
        <?php echo validation_errors(); ?>
      </div>

      <div class="row">
        <div class="col-md-12 col-xs-12">                   
          <?php  
            if(!empty($success_msg)){ 
              echo "hello";
                echo '<p class="status-msg success" style="text-align: center;"><h3><span style="color: red">'.$success_msg.'</span></h3></p>'; 
            }elseif(!empty($error_msg)){ 

              echo "Hi";
                echo '<p class="status-msg error" style="text-align: center;"><h3>'.$error_msg.'</h3></p>'; 
            } 
            echo '<div>'.$this->session->flashdata('success_msg').'</div>';
          ?>
        </div>
      </div>
      <div class="row">       
        <div class="col-md-6" align="left">
          <label for="phisicalcopy_upload"><span class="text-danger">*</span>Upload physical copy of complaint here</label>
          <input type="file" id="phisicalcopy_upload" name="phisicalcopy_upload" class="form-control" accept=".pdf" size="20"> 
          <span class="text-danger">File should not be greater than 20 MB</span>
          <div class="error" id="phisicalcopy_upload_error"><?php echo form_error('phisicalcopy_upload'); ?></div>
          <label for="phisicalcopy_upload">
            <?php if($farma[0]->physical_complaint_copy_url !='')  {?>
            <a href="<?php echo base_url();?><?php echo $farma[0]->physical_complaint_copy_url; ?>" target="_blank" alt="">click here to preview uploaded document </a>
            <?php } ?>
          </label>
        </div>
      </div> 

      <div class="row">
        <div class="col-md-6">          
          <button type="submit" class="btn btn-success" id="submitbtn">Click here to upload physical copy of complaint</button>         
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
  $(document).ready(function () {
    autoclose: true,  
    $('#date1').datepicker({
    format: "yyyy-mm-dd"
    });            
  }); 
</script>

<script type="text/javascript">
  $('input#phisicalcopy_upload').bind('change', function() {
    // var maxSizeKB = 20; //Size in KB
    var maxSize =20000000; //File size is returned in Bytes
    if (this.files[0].size > maxSize) {
      $(this).val("");
      //alert("Max size exceeded");
      $('#phisicalcopy_upload_error').text('Affidavit upload file must be less then 20 MB');
      return false;
    }else{
      $('#phisicalcopy_upload_error').text('');
    }
  });
</script>




