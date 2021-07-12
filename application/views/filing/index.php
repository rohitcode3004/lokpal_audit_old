<?php include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
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
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  
 
  
 
 
  
 </head>
 
 <body> 
 
<?php 
//$array=$this->session->userdata('ref_no');
//print_r($array);
  //$array['ref_no'];

 // echo "<pre>";
 // print_r($complainant_type); 
  
  //var_dump($data['state']);

//echo "<pre>";
//print_r($parta);die;


  
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
                       
                        List of Case File
                    </h5>
                </div>
    <b><h2 class="searchComplaint"></h2></b>
    </div>


   <form id="indexform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" name="indexform" enctype="multipart/form-data"> 

    <h4 align="center"><b>Filing Report</b></h4>
    <table class="table table-striped table-bordered">
     <tr><td><strong>Referance No</strong></td><td><strong>Complaint Type</strong></td><td><strong>Complainant Filing Mode</strong></td>
      <td><strong>First Name</strong></td><td><strong>Sur Name</strong></td></tr> 
     <?php foreach($parta as $employee){?>
      <?php
      $cm=$employee->complaintMode_id;  
      $complaint_mode = $this->report_model->getComplaintMode($cm);
      $complaint_mode_desc=$complaint_mode['complaintMode_desc'];
       $cc=$employee->complaint_capacity_id;  
$pssalution = $this->report_model->getPublicsector($cc);
$ccapacity=$pssalution['complaint_capacity_desc'];

     ?>
     <tr><td><?=$employee->ref_no;?></td><td><?=$ccapacity;?></td><td><?=$complaint_mode_desc;?></td><td><?=$employee->first_name;?></td>
     <td><?=$employee->sur_name;?></td></tr>     
        <?php }?>  
    </table>
        
      </div>
    
    </div>
    </form>
   </fieldset> 

</section>

 </body></html>



