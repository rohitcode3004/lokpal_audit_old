<?php //include(APPPATH.'views/templates/front/header4.php'); 
$elements = $this->label->view(1);

//$bn = 1;
?>

              <div class="app-content">
                <div class="main-content-app">
                    <div class="page-header">
                        <h4 class="page-title">Dashboard of Hon’ble Chairperson</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Create a New Bench</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            Creation of a new Bench
                            <ul class="more-action">
                              <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
                          <div class="panel-body">
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
                             if($this->session->flashdata('upload_error'))
                             {
                                echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>
                                <h4>'.$this->session->flashdata('upload_error').'</h4></div>';
                             }
                            ?>

                            <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>bench/benchcreation'  name="complaint_allotment" enctype="multipart/form-data">

                              <input type="hidden" name="new_saparate" value="1">

                              <div class="form_error">
                                <?php echo validation_errors(); ?>
                              </div>


                              <div class="constitution selectt">
                                <div class="searchComplaint">

                                  <div class="row">
                                    <div class="col-md-7">
                                      <h4>Select members</h4>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="control-label col-sm-4" for="order_date"><span style="color: red;">*</span>Order date</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control order_date" style="width:90%;" name="order_date" id="order_date"  placeholder="Order date">
                                        </div>
                                      </div>
                                    </div>
                                    <?php if($user['id'] != 1303) { ?>
                                     <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="control-label col-sm-4" for="order_upload"><span style="color: red;">*</span>Order Upload</label>
                                        <div class="col-sm-8">
                                          <input type="file" style="" id="order_upload" name="order_upload" class="form-control" accept=".pdf,.jpg" size="20">
                                        </div>
                                      </div>
                                    </div>
                                    <?php } ?>
                                  </div>



                                  <div class="span6">
                                    <table class="table">
                                      <thead>
                                        <th style="width:50px;">S.no.</th>
                                        <th style="width:100px;">Select</th>
                                        <th style="width:400px;">Name</th>
                                        <th>Desgnation</th>
                                        <th>Total no. of pending cases</th>
                                      </thead>
                                      <tbody id="members">

                                      </tbody>
                                    </table>
                                  </div>

                                  <div class="span6" id="">
                                    <div class="control-group" id="selected_members">  
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
  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_constitution.js"></script>

  <script language="javascript"> 
    $().ready(function() {

    // validate signup form on keyup and submit
    $("#complaint_allotment").validate({

      onkeyup: false,

      rules: {  
        order_date: "required",
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
      },
      order_date: {
        required: "Please select order date for bench constitution."
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

    select_coram();

    $(document).on("change", "input[name='member_namec[]']", function () {
      var $this = $(this);
      var inputVal = $this.attr("id");
      console.log(inputVal);
      var className = inputVal.replace(/ /g, '_');
      var inputArr = inputVal.split('_');

      if ($(this).prop('checked')) {
        $("#selected_members").append('<label class="span_' + className + '"><li>'+ inputArr[0] + '</p></li></label><br>');
      } else {
        $('.span_'+className).remove();
      }
    });

  });  

</script>



