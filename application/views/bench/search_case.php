<?php //include(APPPATH.'views/templates/front/header2.php'); 
//$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
 
 <script language="javascript"> 
      $().ready(function() {
   
      // validate signup form on keyup and submit
      $("#search_case_data").validate({
   
        onkeyup: false,

        rules: {  
          search_case: "required",         
          name_of_complainant:"required",
          name_of_public_servant:"required",
          complaint_number:"required",
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
 
              <div class="app-content">
                <div class="main-content-app">
                  <div class="page-header">
                        <h4 class="page-title">Search Complaints</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Search Complaints</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">Select a search criteria
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
                          <div class="panel-body">

                            <form id="search_case_data" class="form-horizontal" role="form" method="post" action='<?= base_url();?>bench/search_case_detail'  name="search_case_data" enctype="multipart/form-data">
      
                     <?php  
       if(!empty($success_msg)){
         echo "hello";
         echo '<div>'.$success_msg.'</div>';
       }
       elseif(!empty($error_msg)){
         echo "Hi";
         echo '<div>'.$error_msg.'</div>';
         }
         echo '<div>'.$this->session->flashdata('success_msg').'</div>';
     ?>
                              <div class="row">
                     
                                <div class="col-md-12">   
                                  <ul class="radio-search">
                                    <li>
                                      <label>                           
                                        <input type="radio" name="search_case" id="search_case" value="1">
                                        Name of Complainant
                                      </label>
                                    </li>
                                    <li>
                                      <label>                           
                                        <input type="radio" name="search_case" id="search_case" value="2">
                                        Name of Public Servant 
                                      </label>
                                    </li>
                                    <li>
                                      <label>                          
                                        <input type="radio" name="search_case" id="search_case" value="3">
                                        Complaint Number
                                      </label>
                                    </li>
                                  </ul>                    
                                </div>
                        
                              </div>
     
                              <div class="form-group" id="cpname">    
                                <label class="control-label col-md-4 col-lg-3" for="name_of_complainant"><span style="color: red;">*</span>Name of Complainant:</label>
                                <div class="col-md-7 col-lg-5">
                                  <input type="text" class="form-control" name="name_of_complainant" maxlength="50" id="name_of_complainant"
                                       placeholder="">  
                                  <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
                                </div>   
                              </div>

                              <div class="form-group" id="psname">   
                                <label class="control-label col-md-4 col-lg-3" for="name_of_public_servant"><span style="color: red;">*</span>Name of Public Servant:</label>
                                <div class="col-md-7 col-lg-5">
                                  <input type="text" class="form-control" name="name_of_public_servant" maxlength="50" id="name_of_public_servant" placeholder="">    
                                  <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>    
                                </div> 
                              </div>

                              <div class="form-group" id="cpnumber">    
                                <label class="control-label col-md-4 col-lg-3" for="complaint_number"><span style="color: red;">*</span>Complaint Number:</label>
                                <div class="col-md-7 col-lg-5">
                                  <div class="text-danger">Please Enter Complaint Number / Year Format</div> 
                                <input type="text" class="form-control" name="complaint_number" maxlength="50" id="complaint_number" placeholder="">  
                                <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>         
                                </div> 
                              </div>

                              <div class="row">
                                <div class="col-md-4 col-lg-3 col-md-offset-4 col-lg-offset-3">
                                   
                                </div>     
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>


    <!-- =================== Search Complaints =============== -->
  <script type="text/javascript">
    $(document).ready(function(){
       $("#psname").hide();
       $("#cpname").hide();
       $("#cpnumber").hide();
       

       // $('#search_case').on('click', function() {
        $('input[type="radio"]').click(function() {

           var value = $(this).val(); 
          // alert(value);
         // alert(#recieved_by.value);
         
          if ( this.value == '1')
          //.....................^.......
          {
             $("#cpname").show();
            $("#psname").hide();      
            $("#cpnumber").hide();        
          }

          if ( this.value == '2')
          {
             $("#psname").show();
            $("#cpnumber").hide();
             $("#cpname").hide();
          }
          if ( this.value == '3')
          {
            $("#cpnumber").show();
            $("#psname").hide();
             $("#cpname").hide();
          }

        });
    });
  </script>

 

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



