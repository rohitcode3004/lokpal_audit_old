<?php include(APPPATH.'views/templates/front/header.php'); ?>

<head>
	<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
   <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>


      <a class="navbar-brand" target="_blank" href="http://india.gov.in/">भारत सरकार</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <!--
      <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="http://localhost/reracat/">Home</a></li>
        <li><a href="#" class="active">Jurisdiction</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact Us</a></li>
       
        
       
        
        
      </ul>-->
    </div><!-- /.navbar-collapse -->
      </div><!-- /.container-collapse -->
  </nav>
<div class="image-aboutus-banner"style="margin-top:70px">
   <div class="container">
    <div class="row">
        <div class="col-md-12">
         <h1 class="lg-text">About Lokpal</h1>
         <p class="image-aboutus-para">भारत का लोकपाल</p>
       </div>
    </div>
</div>
</div>
<div class="bread-bar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                         <li class="active">Citizen Corner </li>
                    </ol>
            	</div>
                <div class="col-md-4 col-sm-6 col-xs-4">
                </div>
            </div>
      	</div>
    </div>

<div class="aboutus-secktion paddingTB60">
    <div class="container">
        <div class="row">
                
                	<div class="col-md-8"> 
                    	<h1>Complaints Statistics</h1>
                       
                        <p align="justify">Although the form for filing complaint has not yet been notified, Lokpal decided to scrutinise all the complaints received in the office of Lokpal, in whatever form they were sent. 1065 complaints received till 30th September, 2019. Out of which 1000 have been heard and disposed of. </p>

                        <p align="justify">After scrutiny, complaints that did not fall within the mandate of the Lokpal were disposed off and complainants have been informed accordingly. </p>

                       
                    </div>

                     <div class="col-md-4">  

                          <h2>MENU BAR</h2>
                          
                          <table class="table">
                            
                            <tbody>
                              <tr>
                                <td><b><a href="<?php echo base_url(); ?>lokpal/about" title="About lokpal" class="menu__link">Introduction</a></b>

                                </td>
                               
                              </tr>      
                              
                              <tr class="danger">
                                <td><b><a href="<?php echo base_url(); ?>lokpal/jurisdiction" title="jurisdiction" class="menu__link">Jurisdiction and Functions of Lokpal</a></b></td>
                                
                              </tr>
                            
                              <tr class="info">
                                <td><b><a href="<?php echo base_url(); ?>lokpal/organization" title="organization" class="menu__link">Organization Structure</a></b></td>
                                
                              </tr>

                                <tr class="info">
                                <td><b><a href="<?php echo base_url(); ?>lokpal/logo_moto" title="logo moto" class="menu__link">Logo and motto/slogan</a></b></td>
                                
                              </tr>                             

                             <tr class="warning">
                                <td><b><a href="<?php echo base_url(); ?>lokpal/directory" title="organization" class="menu__link">Directory</a></b></td>
                                
                              </tr>


                              
                            </tbody>
                            </table>
                    </div>
                   
</div>
    </div>
</div>





  
<?php include(APPPATH.'views/templates/front/footer.php'); ?>

