<?php
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
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  
 
 <style type="text/css">
 .navbar-nav>li .active {
    color: green !important;
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
 
 <fieldset >

   <div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">Select the option -</b></legend>   

  </div>


 <div class="col-md-6 col-xs-12">                   
              <h5><b><a href="<?php echo base_url('filing/destroy_filing_session')?>">File a fresh complaint</a></b></h5>         
      </div>

       <div class="col-md-6 col-xs-12">   
          <?php foreach($user_comps as $row): 
            $r = $row->ref_no;
            ?>                
              <h5><b><a href="<?php echo base_url().'filing/filing/'.$r ?>"><?php echo 'Reference no: '.$row->ref_no; ?></a></b></h5><br>   
          <?php endforeach; ?> 
      </div>

   </fieldset>
        </div>
      </div>
    </div>

<div class="col-md-2">  </div>
</section>
</body></html>



