<?php include(APPPATH.'views/templates/front/fheader.php'); ?>



  <script type="text/javascript">
    var baseURL= "<?php echo base_url();?>";
  </script>
  <script src="<?php echo base_url(); ?>assets/customjs/otp.js"></script>

  <style type="text/css">

    .second-box{
      display:none;
    }
    .field-error{
      color:red;
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

<div id='uncover-otp'>
      <span id="otpishere"></span>
      <input type="text" id="otp_see" class="form-control" name="otp_see" placeholder="10 digit mobile no" required autofocus>
      <input type="submit" value="Submit" alt="" id="img-clck" onclick="codeAddress()" />
    </div>

<div class="login-box">
  <div class="login-form">
    <div class="login-main">
      <h6 class="sec-one">Make a Complaint Through <br>Mobile No. <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
      <div class="speci-login first-look">
        <img src="<?php echo base_url(); ?>assets/my_assets/images/user.png" alt="">
      </div>
    </div>
    <div class="login-content">
      <div class="row">
        <div class="col-md-12">
          <?php  
            if(!empty($success_msg)){ 
              echo '<div class="alert alert-success">'.$success_msg.'</div>'; 
            }elseif(!empty($error_msg)){ 
              echo '<div class="alert alert-danger">'.$error_msg.'</div>'; 
            }
          ?>
        </div>
      </div>
      <form class="form-horizontal" role="form" action="" method="">
        <div class="first-box">
          <input type="text" id="emailid" class="input-form" name="email" placeholder="Enter your 10 digit mobile no" required autofocus>
          <span id="email-error" class="field-error"></span>
        </div>
        <div class="first-box">
          <button class="loginhny-btn btn" type="button" onclick="send_otp()">Send OTP</button>
        </div>
        <!-- -------------- Second OTP box Opem ------------ -->

        <div class="second-box">
          <input type="text" id="otp" class="input-form" name="otp" placeholder="Enter Your OTP" required autofocus>
          <span id="otp-error" class="field-error"></span>
          <p id="otp-reminder" class="text-info" role="alert"></p>
        </div>
        <div class="second-box">
          <button class="loginhny-btn btn" type="button" onclick="submit_otp()">Submit OTP</button>
        </div>

        <p class="text-orange">If you are a new Complainant, Create your account to make a complaint <br>  <a href="#"><strong>Please Click Here</strong></a>  </p>
        <div class="login-divider"><span>OR</span></div>
        <p class="text-orange">If you want to go to the Home page <br> <a href="<?php echo base_url(); ?>home/index"><strong>Please click here!</strong></a></a></p>
      </form>
    </div>
  </div>
</div>


                    <!----------------------------------------------------------->
                    <script type="text/javascript">
                        function codeAddress() {
                          //alert('here');
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


                    </script>
                    <!----------------------------------------------->

<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>