<?php include(APPPATH.'views/templates/front/fheader.php'); ?>

<div class="login-box">
  <div class="login-form">
    <div class="login-main">
      <h6 class="sec-one">Make a Complaint <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
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
      <form class="form-horizontal" role="form" action="<?php echo base_url('user/login') ?>" method="post">
        <input class="input-form" placeholder="username" name="username" type="text" autofocus>
        <input class="input-form" placeholder="Password" name="password" type="password" value="">
        <input class="loginhny-btn btn" type="submit" name="userloginSubmit" value="login"/>

        <p class="text-orange">Make a Complaint Through Mobile No.<br><a href="<?php echo base_url(); ?>user/register"><strong>Please Click Here</strong></a></p>
        <div class="login-divider"><span>OR</span></div>
        <p class="text-orange">If you are a new Complainant, Create your account to make a Complaint <br> <a href="#"><strong>Please Click Here</strong></a>  </p>
      </form>
    </div>
  </div>
</div>

<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>