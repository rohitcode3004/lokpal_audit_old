<?php include(APPPATH.'views/templates/front/header2.php'); ?><!DOCTYPE html>
<html lang="en">
 <head> 
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

   <link href="<?php echo base_url();?>assets/bootstrap/css/chosen.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bootstrap/css/custom_style.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>

 
  <style>
 
  
  #respondentform label.error {
  color: red;
  margin-left: 80px;
  font-size:15px;
  padding: inherit;
  }
 
  </style>
 
 
 </head>


<?php

$chkdate= date("l jS \of F Y");
 $curYear = date('Y');
  $curMonth = date('m');
  $curDay = date('d');
  $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
  $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
  $comp_f_date="$curYear-$curMonth-$curDay";
 ?>

 <body>
 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">    
    <ul class="nav navbar-nav">
      <li><a href="<?php echo base_url(); ?>filing/filing">Form:(Part - A)</a></li>
      <li><a href="<?php echo base_url(); ?>applet/appletfiling">Part- B</a></li>      
      <li><a href="<?php echo base_url(); ?>respondent/respondentfiling">Part -C</a></li>
      <!-- <li><a href="<?php echo base_url(); ?>affidavit/affidavit_detail">Affidavit</a></li>-->
      <li><a href="<?php echo base_url(); ?>document/testafidavit">Affidavit(Form - D)</a></li>
   <li><a href="<?php echo base_url(); ?>affidavit/affidavit_detail">Report</a></li>
    </ul>
  </div>
</nav>

<?php 
//$array=$this->session->userdata('ref_no');


$ref_no=$this->session->userdata('ref_no');
 
   ?>
   <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    
        
        <!-- /.box-header -->
        <div class="box-body" >
 <div class="col-md-2">  </div><br>
 <fieldset >      
   <div class="panel-default">
                <div class="panel-heading">
                    <span id="ContentPlaceHolder1_search" class="searchComplaint" placeholder="Search"></span>
                    <h5 class="panel-title">
                       
                  AFFIDAVIT  DETAIL : (PART - D)                    </h5>
                </div>
    <b><h2 class="searchComplaint"></h2></b>
    </div>
 <form id="affidavitform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action='<?= base_url();?>/document/toPdf'  name="affidavitform" enctype="multipart/form-data">

<div class="form_error">
          <?php echo validation_errors(); ?>
    </div>


 <div class="row">

        <?php if (isset($ref_no)) {?>

       <div class="col-md-4">                   
              <label for="complaintMode_id" >Refrance Number-</label>  
            <span style="color: red"><b>  <?php echo $ref_no; ?></b></span>  
                      
      </div>

    <?php } ?>
</div>
<style>
  hr{
display: block;
margin-top: 0.5em;
margin-bottom: 0.5em;
margin-left: auto;
margin-right: auto;
border-style: inset;
border-width: 1px;

  }


</style>
<hr>
 <div class="row">
<div class="container">


  
        <div class="form-group">
        <div class="col-lg-offset-6 col-lg-10">
          <button type="submit" class="btn btn-success">Export to Pdf</button> <a href="<?= base_url();?>document/toPdf"</a>
      
      <!-- <button type="submit" class="btn btn-success" id="submitbtn">Preview</button> -->
      </div>
        <br>
      </div>






    </form>
   </fieldset>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="col-md-2">  </div>
</div>

</div></section>
  
  
  <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                 autoclose: true,  
                $('#date1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>
    
    
 </body>
</html>
<!-- End of Login Register Section-->

