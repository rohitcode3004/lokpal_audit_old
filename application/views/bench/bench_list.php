<?php //include(APPPATH.'views/templates/front/header4.php'); 
$elements = $this->label->view(1);
?>
<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Total Benches</h4>
        <ol class="breadcrumb"> 
          <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
          <li class="breadcrumb-item active" aria-current="page">Total Benches</li> 
        </ol>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Total Benches
            <ul class="more-action">
              <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
          
                <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>bench/bench_mod'  name="complaint_allotment" enctype="multipart/form-data">
         
                  <div class="form_error">
                    <?php echo validation_errors(); ?>
                  </div>

                  <div class="span6" id="">
                    <table class="table table-bordered">
                      <tbody id="benches-info">

                      </tbody>
                    </table>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_constitution.js"></script>

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
              benches_all_existing();
            });  

</script>



