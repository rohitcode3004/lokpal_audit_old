<?php include(APPPATH.'views/templates/front/header.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>/assets/front/img/bg.jpg)">
  <div class="container text-left">
    <h1 class="display-2 mb-4">Login</h1>
  </div>
</div>	

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login-CI Login Registration</title>
	 <link href="<?= base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 <link href="<?= base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	 <link href="<?= base_url();?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">-->
		
 
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/utf8_encode.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/sha256.js" language="javascript" ></script>
		
		
		
		
      <!--  <script type="text/javascript">
    function check_validation()
    {

        if(document.authform.email.value=="")
        {
            alert("Please enter the Valid User Name");
            return false;
        }
        if(document.authform.password.value=="")
        {
            alert("Please enter the Valid Password");
            return false;
        }


       
       // var md5password = sha256_digest(sha256_digest(document.authform.password.value)+(document.authform.salt.value));
      //  document.authform.password.value = md5password;
       // document.authform.salt.value="";
    }



</script>
	-->
</head>


<!-- Login Register Section -->
<section id="blog" class="bg-grey">
    <div class="container">
      <div class="section-content">
        <div class="top-content">          
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-5 col-lg-6 pr-5 middle-border">				
						   <?php if($this->session->flashdata('success')): ?>
            
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>


          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>

          <?php endif; ?>
		  
            <div class="form-box">
								<div class="form-top">								
								  <div class="form-top-left">								
									  <p>Enter username and password to log on:</p>
								  </div>
								</div>


								<div class="form-bottom">
									<form action="<?php echo base_url('user/authenticate') ?>" method="post" name="authform" id="authform">
										
                    <div class="form-group">
											<input type="text" name="email" placeholder="Username..." class="form-control" id="email" required />
                      <span class="text-danger"><?php echo form_error('email'); ?></span>
											<label for="email"></label>
										</div>


										<div class="form-group">
											<input type="password" name="password" placeholder="Password..." class="form-control" id="password" required />
                      <span class="text-danger"><?php echo form_error('password'); ?></span>
											<label for="password">                        
                      </label>
										</div>


										 <?php
										 /*
                                            $_SESSION['salt'] = sha1(microtime());
                                            $saltbb = $_SESSION['salt'];
											*/
                                            ?>
									<input name="salt" type="hidden" value="<?php //echo htmlspecialchars(htmlentities($saltbb)); ?>"/>
										<input class="btn btn-success btn-shadow btn-lg  mt-3 px-5" type="submit" name="submit" value="LOGIN" onclick="return check_validation();" />
                    <?php  echo $this->session->flashdata("error");?>
								   
									  <center><b>You are not registered ?</b> <br></b><a href="<?php echo base_url('user/register');?>">Register here</a></center>
										
                    <div class="col-md-12 text-center">
											<label for="message"></label>                      
											<div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i>
                      </div>
                    </div>


									 </form>
								</div>


								
                            </div>                    
                         
                          
                        </div>
                        
                        
                    </div>               
                </div>

            </div>
            
      
      
</section>
<!-- End of Login Register Section-->
