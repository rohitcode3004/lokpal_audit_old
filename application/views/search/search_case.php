<?php //include(APPPATH.'views/templates/front/header2.php'); 
//$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  $("#psname").hide();
  $("#cpname").hide();
  $("#cpnumber").hide();
  $("#fact_allegation").hide();
  $("#dep_name").hide();
  $("#filingdate").hide();
   

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
        $("#fact_allegation").hide();
        $("#dep_name").hide(); 
         $("#filingdate").hide();      
      }

      if ( this.value == '2')
      {
         $("#psname").show();
        $("#cpnumber").hide();
         $("#cpname").hide();
         $("#fact_allegation").hide();
         $("#dep_name").hide();
          $("#filingdate").hide();
      }
      if ( this.value == '3')
      {
        $("#cpnumber").show();
        $("#psname").hide();
         $("#cpname").hide();
         $("#dep_name").hide();
         $("#fact_allegation").hide();
          $("#filingdate").hide();
      }

      if ( this.value == '4')
      {
         $("#fact_allegation").show();
        $("#cpnumber").hide();
        $("#psname").hide();
         $("#cpname").hide();
          $("#dep_name").hide();
           $("#filingdate").hide();
        
      }

      if ( this.value == '5')
      {
         $("#dep_name").show();
        $("#cpnumber").hide();
        $("#psname").hide();
         $("#cpname").hide();
         $("#fact_allegation").hide();
          $("#filingdate").hide();
        
      }
       if ( this.value == '6')
      {
         $("#filingdate").show();
         $("#dep_name").hide();
        $("#cpnumber").hide();
        $("#psname").hide();
         $("#cpname").hide();
         $("#fact_allegation").hide();
        
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
 
<script language="javascript"> 
    $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#search_case").validate({
 
      onkeyup: false,

      rules: {  
        search_case: "required",
        agree: "required",
        name_of_complainant:"required",
        name_of_public_servant:"required",
        complaint_number:"required",
        summary_fact_allegation:"required",
        department_name:"required",
        dt_of_filing_from:"required",
        dt_of_filing_to:"required",
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
<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Search Case</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">Search Case</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Search Critaria
            <ul class="more-action">
              <li><a href="<?php echo base_url('scrutiny/dashboard_main'); ?>" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">

    <form id="search_case" class="form-horizontal" role="form" method="post" action='<?= base_url();?>search/search_case_detail_leg'  name="search_case" enctype="multipart/form-data">
      
     <?php
      //echo "<pre>";
      //print_r($error);

      //echo $error;
      ?>

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

      <div class="row radio">
        <div class="col-md-4 mb-15">
          <label><input type="radio" name="search_case" id="search_case" value="1"> Name of Complainant</label> 
        </div>
        <div class="col-md-4 mb-15">
          <label><input type="radio" name="search_case" id="search_case" value="2"> Name of Public Servant</label>
        </div>
        <div class="col-md-4 mb-15">
          <label><input type="radio" name="search_case" id="search_case" value="3"> Complaint Number</label>
        </div>
        <div class="col-md-4 mb-15">
          <label><input type="radio" name="search_case" id="search_case" value="4"> Summary of facts/allegations</label>
        </div>
        <div class="col-md-4 mb-15">
          <label><input type="radio" name="search_case" id="search_case" value="5"> Department name</label>
        </div>
        <div class="col-md-4 mb-15">
          <td><label><input type="radio" name="search_case" id="search_case" value="6"> Filing Date</label></td>
        </div>
      </div>     
     
      <div class="row" id="cpname">     
        <div class="col-md-8 col-md-offset-2 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-4" for="name_of_complainant"><span style="color: red;">*</span>Name of Complainant</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name_of_complainant" maxlength="50" id="name_of_complainant" placeholder=""> 
              <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
            </div> 
          </div>      
        </div> 
      </div>

      <div class="row" id="psname">     
        <div class="col-md-8 col-md-offset-2 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-4" for="name_of_public_servant"><span style="color: red;">*</span>Name of Public Servant</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name_of_public_servant" maxlength="50" id="name_of_public_servant" placeholder="">
              <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
            </div> 
          </div>      
        </div>  
      </div>


      <div class="row" id="cpnumber">       
        <div class="col-md-8 col-md-offset-2 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-4" for="complaint_number"><span style="color: red;">*</span>Complaint Number</label>
           <div class="col-sm-8">
            <div class="text-danger">Please Enter Complaint Number / Year Format</div>
            <input type="text" class="form-control" name="complaint_number" maxlength="50" id="complaint_number" placeholder="">  
            <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
           </div> 
          </div>      
        </div>  
      </div>

      <div class="row" id="fact_allegation">     
        <div class="col-md-8 col-md-offset-2 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-4" for="summary_fact_allegation"><span style="color: red;">*</span>Summary of facts/allegations</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="summary_fact_allegation" maxlength="50" id="summary_fact_allegation" placeholder="">
              <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
            </div> 
          </div>      
        </div> 
      </div>

      <div class="row" id="dep_name">     
        <div class="col-md-8 col-md-offset-2 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-4" for="department_name"><span style="color: red;">*</span>Department name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="department_name" maxlength="50" id="department_name" placeholder="">
              <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>
            </div> 
          </div>      
        </div> 
      </div>

      <div class="row" id="filingdate">     
        <div class="col-md-10 col-md-offset-1 mt-50 mb-15">
          <div class="form-group">
            <label class="col-sm-3" for="dt_of_filing"><span style="color: red;">*</span>Filing Date From</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="dt_of_filing_from" id="dt_of_filing_from"
               placeholder=""> 
            </div>
            <label class="col-sm-3" for="dt_of_filing_to"><span style="color: red;">*</span>Filing Date To</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="dt_of_filing_to" id="dt_of_filing_to" placeholder="">   
            </div>
          </div> 
          <div class="form-group">
            <div class="col-sm-12 text-center">
              <button type="submit" class="btn btn-success mt-15" id="submitbtn">Submit</button>  
            </div>
          </div>  
        </div> 
      </div>

      <!--<div class="row">
        <div class="col-md-12 text-center">
          <button type="submit" class="btn btn-success" id="submitbtn">Submit</button>  
        </div>
      </div>-->
    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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

</script>


<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                 autoclose: true,  
                $('#dt_of_filing_from').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
       

         $(document).ready(function () {
                 autoclose: true,  
                $('#dt_of_filing_to').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
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


</script>





