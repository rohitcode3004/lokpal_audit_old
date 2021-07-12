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
  
 
 
 <script language="javascript"> 
  
 function pageRefesh(value)
  {

  var post_url= '<?php echo base_url('user/getdistrict')?>';
  var request_method= 'POST';
  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      }).success(function(response){ //
        $("#w_dist_id").html(response);
        
      });
   }

   function pageRefesh1(value)
  {
   
  var post_url= '<?php echo base_url('user/getdistrict1')?>';
  var request_method= 'POST';
  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      }).success(function(response){ //
        $("#c_district_id").html(response);
        
      });
   }


  $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#allreportform").validate({
 
      onkeyup: false,

      rules: {  
        ref_no: "required",   
        w_salutation_id: "required",
        w_gender_id:"required",
        w_age_years:"required",
        w_state_id:"required",
        w_country_id: "required",
        w_mob_no:"required",
        a_comp_age:"required",
        a_comp_nationality:"required",
        a_doc_id:"required",
        a_document_number:"required",
        a_date_of_issue:"required",
        a_validity_up_to_date:"required",
        a_correspondence_country:"required",
        a_co_state_code:"required",
        a_co_pin_code:"required",
        a_co_occupation:"required",
        a_mode_of_complaint:"required",
        a_affidavit_attached:"required",
           
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
        a_co_email_id: {
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
 
  
  #allreportform label.error {
  color: red;
  margin-left: 80px;
  font-size:15px;
  padding: inherit;
  }
 
  </style>
  
 </head>
 
 <body> 
 <!--<nav class="navbar navbar-inverse">
  <div class="container-fluid">    
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url(); ?>filing/filing">Form:(Part - A)</a></li>
      <li><a href="<?php echo base_url(); ?>applet/appletfiling">Part- B</a></li>      
      <li><a href="<?php echo base_url(); ?>filing/respondent">Part -C</a></li>
      <li><a href="<?php echo base_url(); ?>declaration/declarationstmt">Declaration</a></li>
    <li><a href="<?php echo base_url(); ?>document/documentfiling">Document</a></li>
     <li><a href="<?php echo base_url(); ?>document/payment">Payment</a></li>
    </ul>
  </div>
</nav>-->

<?php 
$array=$this->session->userdata('ref_no');
//print_r($array);
  $array['ref_no'];

 // echo "<pre>";
 // print_r($complainant_type); 
  
  //var_dump($data['state']);
  
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
                       
                        Witness Detail
                    </h5>
                </div>
    <b><h2 class="searchComplaint"></h2></b>
    </div>


   <form id="allreportform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action='<?= base_url();?>casefilingreport/toPdfReport'  name="allreportform" enctype="multipart/form-data">
    <div class="form_error">
          <?php echo validation_errors(); ?>
    </div>
   

 <div class="row">
 
           

</div>

 <div class="row">
  <div class="col-md-3">              
               <label for="ref_no">Enter Refrance Number</label><span style="color: red;">*</span> 

             </div>
             <br><br>
             <div class="col-md-3">
               <input type="text" class="form-control" name="ref_no" id="ref_no" style="width:90%;" maxlength="60" onkeypress="return ValidateAlpha(event)" placeholder="">  
      </div> 

</div>

<br> 

      
    
<br>
      <div class="row">
       

       

<?php

 $curYear = date('Y');
  $curMonth = date('m');
  $curDay = date('d');
  $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
  $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
  $comp_f_date="$curYear-$curMonth-$curDay";
 ?>
        
    </div>
<br>

      <div class="row">
        <div class="col-lg-offset-6 col-lg-10">
          <!--<button type="submit" class="btn btn-success">Save & next</button> <a href="<?= base_url();?>applet/appletfiling" class="btn btn-primary">Cancel</a>-->
       <button type="submit" class="btn btn-success" id="submitbtn">Save & next</button>      
        </div>
        <br>
      </div>
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
            $(document).ready(function () {
                 autoclose: true,  
                $('#identity_proof_doi').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
       
                $('#identity_proof_Vupto').datepicker({
                    format: "yyyy-mm-dd",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });  



                $(document).ready(function () {
                 autoclose: true,  
                $('#idres_proof_doi').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });


                 $('#idres_proof_Vupto').datepicker({
                    format: "yyyy-mm-dd",
                    startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });




                $('#a_date_of_issue').datepicker({
                    format: "yyyy-mm-dd",
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



