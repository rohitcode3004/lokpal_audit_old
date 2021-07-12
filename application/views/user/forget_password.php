<?php include(APPPATH.'views/templates/front/template-top.php'); ?>

	<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
	  <div class="container text-center">
		<h1 class="display-2 mb-4">Recover Password</h1>
	  </div>
	</div>	
	<!-- Login Register Section -->
	<section id="blog" class="bg-grey">
		<div class="container">
		  <div class="section-content">
			<div class="top-content">          
				<div class="inner-bg">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 pr-5 middle-border">                          
							  <div class="form-box">
								<div class="form-top">
								  <div class="form-top-left">
									<h2>Forgot Your Password?</h2>
									  <p>Enter your registered email address below and we'll get you back on track</p>
								  </div>
								  </div>
								  <div class="form-bottom">
								  <form role="form" action="" method="post"  class="pwd-form" novalidate>
									<div class="form-group">
									  <label class="sr-only" for="form-email">Email</label>
										<input type="text" name="email" placeholder="Enter Your Email..." class="form-username form-control" id="email" required />
										<label for="email"></label>
									  </div>
									  <input class="btn btn-success btn-shadow btn-lg  mt-3" type="submit" name="submit" value="SEND ME PASSWORD" >
									  <div class="col-md-12 text-center">
											<label for="message"></label>
											<div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i></div>
									   </div>
									   <div class="col-md-12 info"></div>
									</form>                               
								  </div>
								</div>                   
							 
							</div>
							
							<div class="col-sm-12 col-md-5 col-lg-5 pl-4 icon-forgotpwd">
							  <img src="<?php echo base_url(); ?>/assets/front/img/forgot-passwword.png" alt="Forgot Password">
							  
							  
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		  </div>
	</div>
	</section>
<!-- End of Login Register Section-->

<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>