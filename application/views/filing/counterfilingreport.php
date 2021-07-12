<?php include(APPPATH.'views/templates/front/header2.php');
$this->load->helper("date_helper"); 
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
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
 
 
 <?php
    $myArray=(array)$counter_filing_data; 
 ?>
 
 <style>
 
  
  #affidavitform label.error {
  color: red;
  margin-left: 80px;
  font-size:15px;
  padding: inherit;
  }
 
  </style>
  
 </head>
 
 <body> 

  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    
        
        <!-- /.box-header -->
        <div class="box-body" >
 <fieldset> 
 

<div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:fixed;top:50%;left:50%;padding:2px;"><img src="<?php echo base_url();?>assets/images/loader.gif" width="64" height="64" /><br>Loading..</div>

   <form id="conterfilingreport" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action='<?= base_url();?>counter/exportpdf'  name="conterfilingreport" enctype="multipart/form-data">
<br>
    <div class="col-md-2">  </div>
    <br>
    
    <div class="form_error">
          <?php echo validation_errors(); ?>
    </div>
  <div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Complaint Submission Report
</b></legend> 
  </div>

<table width="600" border="1" cellspacing="5" cellpadding="5">
  <tr style="background:#CCC">
    <th>Sr No</th>
    <th>From</th>
    <th>To</th>
    <th>Diary No</th>   
    <th>Mobile No</th>
    <th>Date of Filing</th>
        
  </tr>
  <?php

  //echo "<pre>";
  //print_r($myArray);die;
  $i=1;
  foreach($myArray as $key => $value)
  {
    //$dt_of_filing= get_entrydate($dt_of_filing);
  echo "<tr>";
  echo "<td>".$i."</td>";
  echo "<td>".$value->from."</td>";
  echo "<td>".$value->to ?? ''."</td>";
  echo "<td>".$value->diary_no.'/'.$value->cur_year."</td>"; 
  echo "<td>".$value->counter_mob_no."</td>";
  echo "<td>".get_entrydate($value->entry_date)."</td>"; 
   
  echo "</tr>";
  $i++;
  }
   ?>
</table> 
     
<br>

      <div class="searchComplaint">
       <div class="col-lg-offset-6 col-lg-10">
         <!-- <button type="submit" class="btn btn-success">Export to Pdf</button> <a href="<?= base_url();?>document/toPdf"</a>-->
           <button type="submit" class="btn btn-success">Export to Pdf</button>      
      <!-- <button type="submit" class="btn btn-success" id="submitbtn">Preview</button> -->
      </div>
          <!--<button type="submit" class="btn btn-success">Save & next</button> <a href="<?= base_url();?>applet/appletfiling" class="btn btn-primary">Cancel</a>-->
         
      </div>
      <br>
      <br>
      <br>

    </form>
   </fieldset>
        </div>
      </div>
</div>
</div>
</div>
<div class="col-md-2">  </div>
<br>
 
</div>
</div>
</section>

</body></html>



