<?php include(APPPATH.'views/templates/front/header.php'); ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>XXXXXX</title>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="<?php echo base_url(); ?>assets/admin/css/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?php echo base_url(); ?>assets/admin/css/startmin.css" rel="stylesheet">

  <script type="text/javascript">
    var baseURL= "<?php echo base_url();?>";
  </script>
  <script src="<?php echo base_url(); ?>assets/customjs/otp.js"></script>

  <style type="text/css">
    html,
    body {
      height: 100%;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .second-box{
      display:none;
    }
    .field-error{
      color:red;
    }
    #loader2
    {
      left : 50%;
      top : 50%;
      position : absolute;
      z-index : 101;
      width : 32px;
      height : 32px;
      margin-left : -135px;
      margin-top : -135px;
    }
    #loader {
      width: 20%;
      height: 20%;
      top: 50%;
      left: 40%;
      position: fixed;
      display: block;
      opacity: 0.7;
      background-color: #fff;
      z-index: 99;
      text-align: center;
    }

    #loading-image {
      position: absolute;
      top: 100px;
      left: 240px;
      z-index: 100;
    }

    #uncover-otp {
      width: 10%;
      height: 10%;
      top: 40%;
      left: 80%;
      position: fixed;
      display: block;
      opacity: 0.7;
      background-color: #fff;
      z-index: 99;
      text-align: center;
    }
  </style>

</head>
<body>
  <div class="container">

    <div id='uncover-otp'>
      <span id="otpishere"></span>
      <input type="text" id="otp_see" class="form-control" name="otp_see" placeholder="10 digit mobile no" required autofocus>
      <input type="image" src="<?php echo base_url();?>assets/rohp/icon/sub_but.png" alt="" id="img-clck" style="width: 50px; height: 30px;" />
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <!-- Status message -->
        <?php  
        if(!empty($success_msg)){ 
          echo '<div class="alert alert-success">'.$success_msg.'</div>'; 
        }elseif(!empty($error_msg)){ 
          echo '<div class="alert alert-danger">'.$error_msg.'</div>'; 
        } 
        ?>
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><b>Please login or register with mobile</b></h3>
          </div>
          <div class="panel-body">
            <!-- Image loader -->
            <div id='loader' style='display: none'>
              <img src='<?php echo base_url(); ?>assets/images/loader.gif'>
            </div>
            <!-- Image loader -->
            <form>
              <fieldset>
                                  <!--<label>Mobile no:</label>
                                    <div class="form-group first-box">
                                          <input type="text" id="mobileno" class="form-control" name="mobile" placeholder="Mobile no" required autofocus>
                                          <span id="mobile-error" class="field-error"></span>
                                    </div>
                                    <label>Or</label><br>-->
                                    
                                    <div class="form-group first-box">
                                      <label>Mobile no:</label>
                                      <input type="text" id="emailid" class="form-control" name="email" placeholder="10 digit mobile no" required autofocus>
                                      <span id="email-error" class="field-error"></span>
                                    </div>

                                    <div class="form-group first-box">
                                      <button class="btn btn-lg btn-success btn-block" type="button" onclick="send_otp()">Send OTP</button>
                                    </div>

                                    <!---------------------------------------------------------------------------------------------------->

                                    <div class="form-group second-box">
                                      <label for="mobileno" class="sr-only">Otp</label>
                                      <input type="text" id="otp" class="form-control" name="otp" placeholder="OTP" required autofocus>
                                      <span id="otp-error" class="field-error"></span>
                                      <p id="otp-reminder" class="text-info" role="alert">
                                      </p>
                                    </div>

                                    <div class="form-group second-box">
                                      <button class="btn btn-lg btn-success btn-block" type="button" onclick="submit_otp()">Submit OTP</button>
                                    </div>
                                  </fieldset>
                                </form>
                              </div>
                              <div align="center">
                                <span>Login through username and password? <a href="<?php echo base_url(); ?>user/login" style="color:dodgerblue">Click here</a></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <br>
                      <br>
                      <?php include(APPPATH.'views/templates/front/footer.php'); ?>
                    </body>


                    <!----------------------------------------------------------->
                    <script type="text/javascript">
                      $(document).ready(function(){
                        function codeAddress() {
                          var emailid = jQuery('#otp_see').val();
                          jQuery.ajax({
                            url : baseURL+'user/otp_see',
                            type : 'post',
                            data : 'email='+emailid,
                            dataType : 'JSON',
                            success : function(result){
                              console.log(result);
                              jQuery('#otpishere').html(result[0].otp);
                            }
                          });

                        }
                        $("#img-clck").click(codeAddress);
                      });

                    </script>
                    <!----------------------------------------------->