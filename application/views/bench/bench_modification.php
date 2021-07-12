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
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>


  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_constitution.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_constitution_old.js"></script>

  <script language="javascript"> 
    $().ready(function() {

    // validate signup form on keyup and submit
    $("#complaint_allotment").validate({

      onkeyup: false,

      rules: {  
        from_list_date: "required",
        court_no:"required",   
        bench_nature: "required",
        newbench:"required",

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


  #complaint_allotment label.error {
    color: red;
    margin-left: 80px;
    font-size:15px;
    padding: inherit;
  }

    table.table-bench td, th {
      text-align:center;
  }


   .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
  border-top: 1px solid black;
  border: 1px solid black;
  width: 300px;
}

table label {
  margin-left: 1px;
}

tr.error {
  background: #F2DEDE;
}

tr.success {
  background: #4eb478;
}

  a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #0171b5;
  color: black;
}
</style>



</head>

<body> 

 <section class="content">
      <?php
    if($this->session->flashdata('success_msg'))
    {
     echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>'.$this->session->flashdata('success_msg').'</h4></div>';
    }
    if($this->session->flashdata('error_msg'))
    {
     echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>
     <h4>'.$this->session->flashdata('error_msg').'</h4></div>';
    }
    ?>

  <!-- SELECT2 EXAMPLE -->
  <div class="box box-default">
    <div class="box-header with-border">


      <!-- /.box-header -->
      <div class="box-body">
       <div class="col-md-2"></div><br>
       <fieldset >      
         <div class="panel-default">
          <div class="panel-heading">
            <h5 class="panel-title"><font size="3">
              Bench Modification Form</font>
            </h5>
          </div>
          <b><h2 class="searchComplaint"></h2></b>
        </div>

<br>
<br>
        <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>bench/benchcreation'  name="complaint_allotment" enctype="multipart/form-data">

          <input type="hidden" name="modification" value="1">
          <input type="hidden" name="bench_id" value="" id="bench_id">

          <div class="form_error">
            <?php echo validation_errors(); ?>
          </div>


  <div class="constitution selectt">
    <div class="searchComplaint">
     <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">Bench modification -</b></legend>   
   </div>


   <div class="row col-lg-12">
    <div class="col-md-4">
      <label for="bench_no"><span style="color: red;">*</span>Bench no</label>
      <input type="hidden" class="form-control bench_no" style="width:90%;" name="bench_no" id="bench_no"  placeholder="Bench no" readonly>
      <input type="text" class="form-control bench_no" style="width:90%;" name="bench_no_display" id="bench_no_display"  placeholder="Bench no" readonly>
    </div>
  </div>


   <div class="row col-lg-12">
    <div class="col-md-4">
      <label for="order_date"><span style="color: red;">*</span>Order date</label>
      <input type="text" class="form-control order_date" style="width:90%;" name="order_date" id="order_date"  placeholder="Order date">
    </div>
    <div class="col-md-4">                   
      <label for="noofmem" ><span style="color: red;">*</span>No. of members</label>    
      <select type="text" class="form-control" style="width:90%;" class="chosen-single chosen-default" name="noofmem" id="noofmem" onchange="javascript:select_coram_old();">
      <option value="">Select a no.</option>             
       <option value="2"> 2 </option>
       <option value="3"> 3 </option>
       <option value="4"> 4 </option>
       <option value="5"> 5 </option>
       <option value="6"> 6 </option>
       <option value="7"> 7 </option>
       <option value="8"> 8 </option>
       <option value="more"> more than 8 </option>
   </select>        
 </div>
  <div class="col-md-4" id="more_div" style="display: none;">
       <label for="more_mem"><span style="color: red;">*</span>Specify number</label>
      <input type="text" class="form-control" name="more_mem" id="more_mem" onkeyup="javascript:select_coram();">
    </div>
</div>    


<!--<div class="row col-lg-12" id="note_div" style="display: none;">
<label class="radio">
        <span style="color: red;">*</span>Topmost member will preside the bench. 
        </label>
</div>-->
<br>

<div class="row col-lg-6" id="coram_div" style="display: none;">

  <div class="control-group">  
    <label for="coram"><h4><b><i><u>CORAM</u>:</i></b></h4></label>  
  </div>

  <div class="control-group" id="members">                             
</div>

</div> 

</div>

<div class="span6" id="">
<br><br>
<br><br>
              <table class="table table-bench existing selectt">
                <tbody id="benches-info">

                </tbody>
              </table>
            </div>

            <br>

<br>
<div class="control-group" align="center">      
  <button type="submit" class="btn btn-success" id="submitbtn">Modify</button>      
</div>

</form>
</fieldset>
</div>
</div>


</div>

<div class="col-md-2">  </div>

</section>

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

            $('.order_date').datepicker({
              format: "dd-mm-yyyy",
              //startDate: '-0d',
              //startDate: '-3d',
              autoclose: true,
              todayHighlight: true

            });  



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
            $(document).ready(function() { 
              benche_mod("<?php echo $bno ?>");
            });  

</script>
</body></html>



