<div class="app-content">
                <div class="main-content-app">
                  <div class="page-header">
                        <h4 class="page-title">Dashboad</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Search Order/Report</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            Search Order/Report
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
                          <br>
                          <div class="panel-body">

     <form id="search_cases" class="form-horizontal" role="form" method="post" action='<?= base_url();?>order_report/search_case_action'  name="search_case" enctype="multipart/form-data">     
  
           
      <div class="panel panel-primary">
        <div class="panel-heading">Search Order/Report </div>
        <div class="panel-body">
           <div class="row">     
              <div class="col-md-6 mb-15">
                <label for="dt_of_filing"><span style="color: red;">*</span>Order Date From</label>
                   <input type="text" class="form-control" name="dt_of_order_from" id="dt_of_order_from"
                   placeholder="">        
              </div> 

              <div class="col-md-6 mb-15">
                <label for="dt_of_filing_to"><span style="color: red;">*</span>Order Date To</label>
                   <input type="text" class="form-control" name="dt_of_order_to" id="dt_of_order_to"
                   placeholder="">        
              </div>  
          </div>
          <div class="row">     
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-success" id="submitbtn">Submit</button> 
            </div>
          </div>
        </div>
      </div>


    </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
 <script language="javascript"> 
    $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#search_cases").validate({
 
      onkeyup: false,

      rules: {        
        dt_of_order_from:"required",
        dt_of_order_to:"required",
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

 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                 autoclose: true,  
                $('#dt_of_order_from').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });       

         $(document).ready(function () {
                 autoclose: true,  
                $('#dt_of_order_to').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
        </script>



