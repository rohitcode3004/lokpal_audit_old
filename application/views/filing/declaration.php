<?php include(APPPATH.'views/templates/front/header2.php'); ?>
<!DOCTYPE html>
<html lang="en">
 <head> 
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/bootstrap/css/bootstrap-datepicker.css"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"> </script>
 
  <script language="javascript">
 
    $( "#datepicker" ).datepicker();      
$(document).ready(function(){
    $("#submitbtn").click(function(){        
        $("#declarationform").submit(); // Submit the form
    });
});

  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#declarationform").validate({
 
      onkeyup: false,

      rules: {   
		name:"required",
       f_name:"required",
        date1: "required",
        place: "required",
		
		
		
        
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
        email: {
          required: true,
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
  <style>
 
  
  #declarationform label.error {
    /*
    margin-left: 10px;
    width: auto;
    color: red;
    display: inline;
    */

  color: red;
  margin-left: 5px;
  font-size:15px;
  }
 
  </style>
 
 
 </head> 
 <body>
 
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url(); ?>filing/filing">Form:(Part - A)</a></li>

      <?php if ($this->session->userdata('a_complainant_id') !='1') { ?>
      <li><a href="<?php echo base_url(); ?>applet/appletfiling">Part- B</a></li>


    <?php }?>
      <li><a href="<?php echo base_url(); ?>respondent/respondentfiling">Part -C</a></li>
      <li><a href="<?php echo base_url(); ?>declaration/declarationstmt">Declaration</a></li>
	 <!-- <li><a href="<?php echo base_url(); ?>document/documentfiling">Document</a></li>
	   <li><a href="<?php echo base_url(); ?>document/payment">Payment</a></li>-->
   
    </ul>
  </div>
</nav>


  <div class="container">
 
   <fieldset>
      <legend>Declaration</legend>
    <form class="form-horizontal" role="form" action='<?= base_url();?>declaration/save' method="post" id="declarationform">
	
 
<div class="container">
  <h3>Project Registration Number:</h3>
   <h3>Complaint Number:</h3>
  <div class="panel-heading">
    <div class="panel-body">In case of indivisual write first party and in case of organization please write authorized ############## name</div>
	
	<div class="panel-body">
	
    I <input type="text" name="name" id="name"> son/daughter of <input type="text" name="f_name" id="f_name">the first party do here by verify that all inforamtion provided by me are true to my personal knowledge and belive and that i have not ############.
	</div>
	
	<div class="panel-body" align="left">
	I further declare that all the provided parties have provided consent to initiate the appeal procedings and ########## of the case ( along with supporting ) have been shared with other #### party /parties.
	</div>
	
<div class="panel-body" align="left">
	I further declare that the earlier ###### which #####
	</div>
	
	
	
  </div>
</div>

 <h4>Place:</h4><input type="text" name="place" id="place">
 <h4>Date:</h4> <input type="text" id="date1" name="date1">

	
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

