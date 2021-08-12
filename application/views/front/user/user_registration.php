
<?php include(APPPATH.'views/templates/front/fheader.php'); ?>
  <script type="text/javascript">
    var baseURL= "<?php echo base_url();?>";
  </script>
<script src="<?php echo base_url(); ?>assets/customjs/otp.js"></script>
  <div class="register-box">
    <div class="register-form">
      <div class="register-main">
        <h6 class="sec-one">Are you filling a complaint for first time <br>Please Register Here <i class="fa fa-hand-o-down" aria-hidden="true"></i></h6>
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
              echo '<div>'.$this->session->flashdata('success_msg').'</div>';

            ?>
            <form method="POST" action="<?php echo base_url('user/new_user_save') ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="salutation_id" >Title<span class="text-danger">*</span></label>    
                    <select type="text" class="form-control" name="salutation_id" id="salutation_id">
                      <option value="">Select Title</option>
                      <?php foreach($salution as $row):?>                     
                      <option value="<?php echo $row->salutation_id; ?>" <?php echo set_select('salutation_id',  $row->salutation_id); ?>><?php echo $row->salutation_desc; ?></option>                   
                      <?php endforeach;?>
                    </select>  
                    <div><?php echo form_error('salutation_id','<div class="text-danger">','</div>'); ?></div> 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Surname</label>
                    <input type="text" class="form-control" placeholder="Enter Sur Name" name="sur_name" maxlength="25" onkeypress="return ValidateAlpha(event)" value="<?php echo set_value('sur_name'); ?>" oninput="this.value = this.value.toUpperCase()">
                    <?php echo form_error('sur_name','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mid_name" maxlength="25" onkeypress="return ValidateAlpha(event)" value="<?php echo set_value('mid_name'); ?>" oninput="this.value = this.value.toUpperCase()">
                    <?php echo form_error('mid_name','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" maxlength="50" onkeypress="return ValidateAlpha(event)" value="<?php echo set_value('first_name'); ?>" oninput="this.value = this.value.toUpperCase()">
                    <?php echo form_error('first_name','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile no</label>
                    <div class="input-group mb-3">
                      <input type="text" id="mob_no" class="form-control" placeholder="Enter Mobile no" name="mobile" onkeypress="return isNumberKey(event)" maxlength="10" value="<?php echo set_value('mobile'); ?>">
                      <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="send_otp_new('mobile')">Send OTP</button>
                      </div>
                    </div>
                    <div class="text-info" id="otp-reminder_mob" role="alert"></div>
                    <span id="mobile-error" class="field-error"></span>
                    <?php echo form_error('mobile','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter Your Mobile OTP<span class="text-danger">*</span></label>     
                    <div class="input-group mb-3">               
                      <input type="text" id="otp-mobile" class="form-control" placeholder="Enter OTP Here" name="otp-mobile">
                      <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="submit_otp_new('mobile')">Submit OTP</button>
                      </div>
                    </div>
                      <span id="otp-error-mobile" class="field-error"></span>
                      
                  </div>
                </div>
              </div>

              <div class="row" id="mob-verified" style="display: none">
                <div class="col-md-12">
                  <div class="alert alert-success">Your Mobile no. is Verifyed Successfully! now submit your details to complete registeration.</div>
                </div>
              </div>



              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" id="emailid" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
                       
                      <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="send_otp_new('email')">Send OTP</button>
                      </div>
                    </div>
                    <?php echo form_error('email','<div class="text-danger">','</div>'); ?>
                    <div class="text-info" id="otp-reminder_email" role="alert"></div>
                    <span id="email-error" class="field-error"></span>
                   
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter Your Email OTP<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">                     
                    <input type="text" class="form-control" id="otp-email" placeholder="Enter OTP Here" name="OTP">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" onclick="submit_otp_new('email')">Submit OTP</button>
                    </div>
                  </div>
                  <p id="otp-reminder_email" class="text-info" role="alert"></p>
                  </div>
                </div>
              </div>

              <div class="row" id="email-verified" style="display: none">
                <div class="col-md-12">
                  <div class="alert alert-success">Your Email id is Verifyed Successfully! now submit your details to complete registeration.</div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">                  
                  <div class="form-group">
                    <label>Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password">
                    <?php echo form_error('password','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password2">
                    <?php echo form_error('password2','<div class="text-danger">','</div>'); ?>
                  </div>
                </div>
              </div>


              

              

              <div class="row">                   
                <div class="col-md-4 col-md-offset-4">
                  <button type="submit" class="loginhny-btn btn" name="submitform" value="subacc" align="center">Submit</button>
                </div>
              </div>
              <hr>
              <p class="text-orange mt-50">If you want to go back <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/git-workspace/lokpal?menu_bar?Lodge_Your_Complaints?0304"><strong>Please click here!</strong></a></p>
            </form>                                                                
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>