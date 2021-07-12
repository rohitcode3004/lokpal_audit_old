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
</head>
<body>
        <div class="container">
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
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="<?php echo base_url('admin/authenticate') ?>" method="post">
                                <fieldset>
                                    <label>Username:</label>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="username" name="username" type="text" autofocus>
                                    </div>
                                    <label>Password:</label>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                   <!-- <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>-->
                                    <!-- Change this to a button or input when using this as a form -->
                   
                                    <input class="btn btn-lg btn-success btn-block" type="submit" name="loginSubmit" value="login"/>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
<?php include(APPPATH.'views/templates/front/footer.php'); ?>