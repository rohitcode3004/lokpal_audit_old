<?php
//$elements = $this->label->view(1);
?>
<!DOCTYPE html>
<html lang="en">
<head> 
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/rohp/css/style_dash.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
	<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
	</style>

</head>
<body> 
	<section class="content">

		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">


				<!-- /.box-header -->
				<div class="box-body" >

					<fieldset>

						<div class="table-responsive">

							<span id="success_message"></span>
							<div class="col-lg-12">
								<h3 class="pages_title">
									Dashboard for counter-filing<hr>
								</h3>
							</div>
							<div class="col-md-12">
								<div class="col-md-6" id="divFY">

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="dashboard-box orange hvr-glow">
											<a href="<?php echo base_url('counter/dashboard'); ?>"><div class="padd">
												<div class="icon orange1 hvr-pulse">
													<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
												</div>
												<div class="headlin">
													<div class="dashboard_name">
														<h4>Acknowledgement issued from reception counter</h4>
													</div>
													<br><br>
													<div class="dashboard_reports">
														<span id="ContentPlaceHolder1_lblTotalRegistration" style="font-size:18px;"><?php echo $total_log; ?></span>
													</div>
												</div>
											</div>
										</a>
										<div class="orange1 more">
										</div>
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box officers_bg hvr-glow">
										<div class="padd">
											<div class="icon officers_bg1 hvr-pulse">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>  Pending for Filing</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<span id="ContentPlaceHolder1_lblTotalPending" style="font-size:18px;"> <?php echo $pend_log; ?></span>
												</div>
											</div>
											<!-- padd End-->
										</div>
										<div class="officers_bg1 more">
										</div>
										<!-- dashboard-box End-->
									</div>
								</div>
							</div>


							<div class="col-md-6" id="divFY">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box medium_sea_green hvr-glow">
										<div class="padd">
											<div class="icon medium_sea_green1 hvr-pulse">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>Forwarded to Scrutiny</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<a id="ContentPlaceHolder1_lblNoOfSuMotoCases" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$lblNoOfSuMotoCases','')" style="color:White;font-size:18px;"> <?php echo $scr_log;  ?></a>
												</div>
											</div>
											<!-- padd End-->
										</div>
										<div class="medium_sea_green1 more">
										</div>
										<!-- dashboard-box End-->
									</div>
								</div>

							</div>

						</div>
					</div>

					<div class="clearfix"></div>

				</div>

			</fieldset>
		</div>
	</div>
</div>

<div class="col-md-2">  </div>
</section>
</body></html>