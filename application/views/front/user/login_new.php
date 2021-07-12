<?php include(APPPATH.'views/templates/front/header.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login-CI Login Registration</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">


		
  </head>
  
   <script type="text/javascript" src="<?php echo base_url();?>assets/js/utf8_encode.js"></script>
        <script src="<?php echo base_url();?>assets/js/sha256.js" language="javascript" ></script>
		
		
		
        <script type="text/javascript">
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


       
        var md5password = sha256_digest(sha256_digest(document.authform.password.value)+(document.authform.salt.value));
        document.authform.password.value = md5password;
        document.authform.salt.value="";
    }

</script>

  <body>

    <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Please do Login here</h3>
                </div>
                <?php
              $success_msg= $this->session->flashdata('success_msg');
              $error_msg= $this->session->flashdata('error_msg');

                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                  ?>

                <div class="panel-body">
                   <form action="<?php echo base_url('user/authenticate') ?>" method="post" name="authform" id="authform">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Enter E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Password" name="password" type="password">
                            </div>
							
							 <?php
                                            $_SESSION['salt'] = sha1(microtime());
                                            $saltbb = $_SESSION['salt'];
                                            ?>
										   <input name="salt" type="hidden" value="<?php echo htmlspecialchars(htmlentities($saltbb)); ?>"/>


                                <input class="btn btn-lg btn-success btn-block" name="submit" value="LOGIN" onClick="return check_validation();" />

                        </fieldset>
                    </form>
                <center><b>You are not registered ?</b> <br></b><a href="<?php echo base_url('user'); ?>">Register here</a></center><!--for centered text-->

                </div>
            </div>
        </div>
    </div>
</div>


  </body>
</html>
<!-- End of Login Register Section-->

<?php include(APPPATH.'views/templates/front/footer.php'); ?>// JavaScript Document