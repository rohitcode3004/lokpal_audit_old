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
             echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>'.$this->session->flashdata('success_msg').'</h4></div>';
            }
            if($this->session->flashdata('error_msg'))
            {
             echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>
             <h4>'.$this->session->flashdata('error_msg').'</h4></div>';
            }
          ?>
        </div>
      </div>
      <form id="upd-pass-form" class="form-horizontal" role="form" method="post" action='<?= base_url();?>user/submit_user_pass'  name="upd-pass-form" enctype="multipart/form-data">
        <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
        <div class="box-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" name="username" class="input-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" value="<?php echo $user['username']; ?>">
        </div>

        <div class="box-group">
          <label for="exampleInputPassword1">New Password</label>
          <input type="password" name="password" class="input-form" id="exampleInputPassword1" placeholder="New Password">
        </div>

        <div class="box-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" name="password2" class="input-form" id="exampleInputPassword1" placeholder="Confirm Password">
        </div>
        <button type="submit" class="loginhny-btn btn" name="upd-pass-form" value="upd">Submit</button>
        
        <p class="text-orange"> <a href="<?php echo base_url(); ?>home/index">Please click here!</a> for go to Home Page</a></p>
      </form>
    </div>
  </div>
</div>



