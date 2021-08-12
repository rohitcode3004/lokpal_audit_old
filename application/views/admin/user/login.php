<script src="<?php echo base_url();?>assets/customjs/password_encryption.js"></script>
<?php include(APPPATH.'views/templates/front/fheader.php'); ?>

<div class="login-box">
  <div class="login-form">
    <div class="login-main">
      <h6 class="sec-one">Departmental User, <br> Please Enter Here! <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
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
      <form class="form-horizontal" role="form" action="<?php echo base_url('admin/authenticate') ?>" method="post">
        <input class="input-form" placeholder="username" name="username" type="text" autofocus>
        <input class="input-form" placeholder="Password" name="password" type="password" value="" id="pwd">
        <input class="loginhny-btn btn" type="submit" name="loginSubmit" value="login" onclick="encode(this)" />

        <p class="text-orange">If you want to go Home page <br><a href="<?php echo base_url(); ?>home/index"><strong>Please click here!</strong></a></a></p>
      </form>
    </div>
  </div>
</div>

<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>