<script src="<?php echo base_url();?>assets/customjs/password_encryption.js"></script>
<?php include(APPPATH.'views/templates/front/fheader.php'); ?>

<div class="login-box">
  <div class="login-form">
    <div class="login-main">
      <h6 class="sec-one">Lodge a Complaint <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
      <div class="speci-login first-look">
        <img src="<?php echo base_url(); ?>assets/my_assets/images/user.png" alt="">
      </div>
    </div>
    <div class="login-content">
        <div class="row">
            <div class="col-md-12">
            <?php  
                if(!empty($success_msg)){ 
                    echo '<div>'.$success_msg.'</div>'; 
                }elseif(!empty($error_msg)){ 
                    echo '<div>'.$error_msg.'</div>'; 
                } 
            ?>
            </div>
        </div>
      <form class="form-horizontal" role="form" action="<?php echo base_url('user/login') ?>" method="post">
        <input class="input-form" placeholder="Email ID" name="username" type="text" autofocus>
        <input class="input-form" placeholder="Password" name="password" type="password" value="" id="pwd">
        <input class="loginhny-btn btn" type="submit" name="userloginSubmit" value="login" onclick="encode(this)">

        <p class="text-orange">Lodge a Complaint Through Mobile No.<br><a href="<?php echo base_url(); ?>user/register"><strong>Please Click Here</strong></a></p>
        <div class="login-divider"><span>OR</span></div>
        <p class="text-orange mt-50">If you want to go back? <br><a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/git-workspace/lokpal?menu_bar?Lodge_Your_Complaints?0304"><strong>Please click here!</strong></a></p>
        <!--<p class="text-orange">If you are a new Complainant, Create your account to make a Complaint <br> 
          <a href="<?php echo base_url(); ?>user/user_register"><strong>Please Click Here</strong></a>  </p>-->

          


      </form>
    </div>
  </div>
</div>

<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>