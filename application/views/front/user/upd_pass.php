<?php
//$r = $this->session->userdata('ref_no');
//$u = $user['id'];
//echo get_complaint_no($r, $u);
//$elements = $this->label->view(1);
//print "<pre>";
//print_r($elements);
//print "</pre>";
//print_r($this->label->view(1));
?>

<script src="<?php echo base_url();?>assets/customjs/password_encryption.js"></script>
<div class="login-box">
  <div class="login-form">
    <div class="login-main">
      <h6 class="sec-one">Update Your Password! <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
      <div class="speci-login first-look">
        <img src="<?php echo base_url(); ?>assets/my_assets/images/user.png" alt="">
      </div>
    </div>
    <div class="login-content">
      <div class="row">
        <div class="col-md-12">
          <?php
            if($this->session->flashdata('success_msg'))
            {
             echo '<div>'.$this->session->flashdata('success_msg').'</div>';
            }
            if($this->session->flashdata('error_msg'))
            {
             echo '<div>'.$this->session->flashdata('error_msg').'</div>';
            }
          ?>
        </div>
      </div>
      <form id="upd-pass-form" class="form-horizontal" role="form" method="post" action='<?= base_url();?>user/submit_user_pass'  name="upd-pass-form" enctype="multipart/form-data">
        <div class="alert alert-danger text-center update-pass-message">
          <?php echo validation_errors(); ?>
        </div>
        <div class="box-group">
          <label for="exampleInputEmail1">Email Id</label>
          <input type="text" name="username" class="input-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email Id" value="<?php echo $user['username']; ?>" readonly>
        </div>

        <div class="box-group">
          <label for="exampleInputPassword1">Old Password</label>
          <input type="password" name="password_old" class="input-form" id="pwd_old" placeholder="Old Password">
        </div>

        <div class="box-group">
          <label for="exampleInputPassword1">New Password</label>
          <input type="password" name="password" class="input-form" id="pwd" placeholder="New Password">
        </div>

        <div class="box-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" name="password2" class="input-form" id="pwd2" placeholder="Confirm Password">
        </div>
        <button type="submit" class="loginhny-btn btn" name="upd-pass-form" value="upd" onclick="encode_upd_pass('pwd_old', 'pwd', 'pwd2')">Submit</button>
        <hr>
        <p class="text-orange">If you want to go back? <a href="<?php echo base_url(); ?>filing/dashboard">Please click here!</a></a></p>
      </form>
    </div>
  </div>
</div>



