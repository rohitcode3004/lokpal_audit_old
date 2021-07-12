<?php include(APPPATH.'views/templates/front/header2.php'); 
//$elements = $this->label->view(1);
?>
<!DOCTYPE html>
<html lang="en">
 <head> 
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

   <link href="<?php echo base_url();?>assets/bootstrap/css/chosen.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bootstrap/css/custom_style.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>

  
 <?php

 $curYear = date('Y');
  $curMonth = date('m');
  $curDay = date('d');
  $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
  $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
  //echo $cur_date="$curYear-$curMonth-$curDay";
   $cur_date="$curDay-$curMonth-$curYear";
  // echo "<pre>";
   //print_r($data['diary_counter']);
   ?>
 
 <script language="javascript"> 
    $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#counterfiling").validate({
 
      onkeyup: false,

      rules: {  
        ack_no_year: "required",
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
 
  
  #counterfiling label.error {
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
 <div class="col-md-2">  </div><br>
 <fieldset >      
   <div class="panel-default">
                <div class="panel-heading">
                    <span id="ContentPlaceHolder1_search" class="searchComplaint" placeholder="Search"></span>
                    <h5 class="panel-title">
                       
                        Status of Complaint
                    </h5>
                </div>
    <b><h2 class="searchComplaint"></h2></b>
    </div>

   <form id="counterfiling" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action='<?= base_url();?>counter/searchcase'  name="counterfiling" enctype="multipart/form-data">
      
    <div class="form_error">
          <?php echo validation_errors(); ?>
    </div>

<?php
//echo "<pre>";
//print_r($error);

//echo $error;
?>


  
 <div class="row">
 <div class="col-md-3">
         
        </div> 

      <div class="col-md-3">
        <label for="from"><span style="color: red;">*</span>Search by Acknowedgement No.</label>     
             
         <input type="text" class="form-control" style="width:90%;" name="ack_no_year" id="ack_no_year" maxlength="10"  placeholder="">      
       
      </div>
       </div>
      <div id="otherid">
 <div class="row">     
      <div class="col-md-3">         
        </div> 
       
      </div>
</div>
 

<br><br>

<div class="row">

        <div class="row">
        <div class="" align="center">
          <!--<button type="submit" class="btn btn-success">Save & next</button> <a href="<?= base_url();?>applet/appletfiling" class="btn btn-primary">Cancel</a>-->
       <button type="submit" class="btn btn-success" id="submitbtn">Submit</button>      
        </div>
          </div></br>

     


     
      </div>


<br>
      <div class="row">      
     
    </div>
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
</div>

</div></section>

 <script type="text/javascript">
            // When the document is ready     
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
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(filingform.a_co_email_id.value))
  {
    return (true)
  }
    alert("You have entered an invalid email address!")
    return (false)
}*/



        </script>
</body></html>



