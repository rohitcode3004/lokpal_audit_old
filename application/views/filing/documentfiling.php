<?php include(APPPATH.'views/templates/front/header2.php'); ?>
<!DOCTYPE html>
<html lang="en">
 <head> 
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
 
  
 </head> 
 <body>
 
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url(); ?>filing/filing">Form: (Part - A)</a></li>

      <?php if ($this->session->userdata('a_complainant_id') !='1') { ?>

      <li><a href="<?php echo base_url(); ?>applet/appletfiling">Part-B</a></li>

  <?php } ?>
      <li><a href="<?php echo base_url(); ?>respondent/respondentfiling">Part -C</a></li>
      <li><a href="<?php echo base_url(); ?>declaration/declarationstmt">Declaration</a></li>
	  <li><a href="<?php echo base_url(); ?>document/documentfiling">Document</a></li>
	  <li><a href="<?php echo base_url(); ?>document/payment">Payment</a></li>
	
    </ul>
  </div>
</nav>

<?php 

//echo "<pre>";
	//print_r($docu_name);
		
		$arrlength = count($docu_name);
		
		
 ?>


  <div class="container">
 
   <fieldset>
      <legend>Document Filing</legend>
    <form class="form-horizontal" role="form" action='<?= base_url();?>document/save' method="post">
	
		
	 <div class="row">
	
	<?php for($x = 0; $x < $arrlength; $x++){?>	
	
     <div class="col-md-3 col-sm-6 col-xs-12 form-group">
             
        <input type="hidden" name="thisvalue" class="col-lg-3 control-label">
								
									<label>Document Type:</label>
									<textarea disabled="disabled" type="button" value="" rows="2" cols="10" class="from form-control input-sm"><?php echo $docu_name[$x]->docu_name;?></textarea>		
									
									    
      
	  
       
	  </div>
	  
	 <div class="col-md-3 col-sm-6 col-xs-12 form-group">
             
        <input type="hidden" name="thisvalue" class="col-lg-3 control-label">
								
									<label>Description (Short):</label>
									<textarea type="text" rows="2" cols="10" class="from form-control input-sm" /></textarea>							
						 
	  </div>
	  
	   <div class="col-md-3 col-sm-6 col-xs-12 form-group">
             
        <input type="hidden" name="thisvalue" class="col-lg-3 control-label">
								
									<label>From:</label>
									<textarea type="text" rows="2" cols="10" class="from form-control input-sm" /></textarea>							
						 
	  </div>
	  
	  <div class="col-md-2 col-sm-6 col-xs-12 form-group">
             
        <input type="hidden" name="thisvalue" class="col-lg-3 control-label">
								
									<label>To:</label>
									<textarea type="text" rows="2" cols="10" class="from form-control input-sm" /></textarea>							
						 
	  </div>
	  
	  <div class="col-md-1 col-sm-6 col-xs-12 form-group">
             
       <label for="file"><span class="btn" style="padding:inherit; background-color:#b4cef2;">UPOLOAD DOCUMENT</span></label>
								<input style="visibility: hidden; position: absolute;" id="file" type="file"  name="file" accept="application/pdf">					
						 
	  </div>
	  
	  
      

	 
	  <?php } ?> 
	  	</div>
	
	  
	  
	  
        <div class="form-group">
        <div class="col-lg-offset-6 col-lg-10">
          <!--<button type="submit" class="btn btn-success">Save & next</button> <a href="<?= base_url();?>respondent/save" class="btn btn-primary">Cancel</a>-->
		  
		   <button type="submit" class="btn btn-success" id="submitbtn">Save & Next</button> 
        </div>
      </div>
    
    </form>
   </fieldset>
        </div>
  </div>
 </body>
</html>
<!-- End of Login Register Section-->

