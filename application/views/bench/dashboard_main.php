<?php
//$elements = $this->label->view(1);
?>
			<div class="app-content">
                <div class="main-content-app">
                	<div class="page-header">
                        <h4 class="page-title">Dashboard of Hon’ble Chairperson</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="#">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Dashboard of Hon’ble Chairperson</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>
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
    if($this->session->flashdata('upload_error'))
    {
     echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>
     <h4>'.$this->session->flashdata('upload_error').'</h4></div>';
    }
    ?>
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="panel panel-default">
							  <div class="panel-heading">Complaints for Allocation to Benches</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints/F'); ?>" class="widgets-card gd-blueviolet">
							  				<div class="widgets-icon"><span><?php echo $fresh_comps;  ?></span></div>
							  				<div class="widgets-content">New Complaints</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints/I'); ?>" class="widgets-card gd-hotpink">
							  				<div class="widgets-icon"><span><?php echo $pre_inq_comps; ?></span></div>
							  				<div class="widgets-content">Complaints for which Preliminary-Inquiry Report has been <strong>Accepted</strong></div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints/V'); ?>" class="widgets-card gd-goldyellow">
							  				<div class="widgets-icon"><span><?php echo $inv_comps;  ?></span></div>
							  				<div class="widgets-content">Complaints for which Investigation Report has been <strong>Accepted</strong></div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints_ops/PIR'); ?>" class="widgets-card gd-purple">
							  				<div class="widgets-icon"><span><?php echo $opportunity_ps_after_pi_receive; ?></span></div>
							  				<div class="widgets-content">Complaints for which Public Servant's Report after Preliminary Inquiry has been <strong>Accepted</strong></div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints_ops/IR'); ?>" class="widgets-card gd-olive">
							  				<div class="widgets-icon"><span><?php echo $opportunity_ps_after_inq_receive;  ?></span></div>
							  				<div class="widgets-content">Complaints for which Public Servant's Report after Investigation has been <strong>Accepted</strong> </div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url('bench/get_complaints_ops/AOA'); ?>" class="widgets-card gd-navy">
							  				<div class="widgets-icon"><span><?php echo $any_other_action_count; ?></span></div>
							  				<div class="widgets-content">Complaints for which Status/Additional Documents/Other Report has been <strong>Accepted</strong> </div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>

                   <!--ysc code start here -->


                   <!--ysc code end here -->



                    <div class="row">
                    	<div class="col-md-4">
                    		<div class="panel panel-default">
							  <div class="panel-heading">Search Status of Complaint</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-12">
							  			<a href="<?php echo base_url('bench/search_case'); ?>" class="widgets-card gd-lightred" data-toggle="tooltip" data-placement="bottom" title="search complaint by complainant name, public servant name , complaint number">
							  				<div class="widgets-icon"><span><i class="fa fa-search" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">Search Status of Complaints</div>
							  				<i class="fa fa-search transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  	</div>
							  </div>
							</div>
                    	</div>
                    	<div class="col-md-8">
                    		<div class="panel panel-default">
							  <div class="panel-heading">Creation of New Bench/List of Existing Benches</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-6">
							  			<a href="<?php echo base_url('bench/benchcomposition_separate'); ?>" class="widgets-card gd-cyanblue">
							  				<div class="widgets-icon"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">Creation of a new Bench</div>
							  				<i class="fa fa-pencil-square-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-6">
							  			<a href="<?php echo base_url('bench/benches_all'); ?>" class="widgets-card gd-green">
							  				<div class="widgets-icon"><span><i class="fa fa-cubes" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">List of Existing Benches</div>
							  				<i class="fa fa-cubes transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="panel panel-default">
							  <div class="panel-heading">MIS Reports</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-4">
							  			<a href="<?php echo base_url('report/status_of_complaints'); ?>" class="widgets-card gd-blue">
							  				<div class="widgets-icon"><span><i class="fa fa-file-text-o" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">Status of All Complaints</div>
							  				<i class="fa fa-files-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4">
							  			<a href="<?php echo base_url('report/status_of_complaints_under_loi'); ?>" class="widgets-card gd-fuchsia">
							  				<div class="widgets-icon"><span><i class="fa fa-file-text" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">Status of Complaints under consideration with Lokpal of India</div>
							  				<i class="fa fa-files-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4">
							  			<a href="<?php echo base_url('report/category_of_complaints'); ?>" class="widgets-card gd-peru">
							  				<div class="widgets-icon"><span><i class="fa fa-files-o" aria-hidden="true"></i></span></div>
							  				<div class="widgets-content">Status of Complaints Category Wise</div>
							  				<i class="fa fa-files-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>

	<!--<section class="content">

		<div class="box box-default">
			<div class="box-header with-border">

				<div class="box-body" >

					<fieldset>

						<div class="table-responsive">

							<span id="success_message"></span>
							<div class="col-lg-12">
								<h2 class="pages_title">
									Dashboard of Chairperson<hr>
								</h2><div class="btn-group user-helper-dropdown open pull-right">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="" class=" waves-effect waves-block"><i class="material-icons">person</i><?php echo  $user['username']; ?></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url('user/update_user_pass'); ?>" class=" waves-effect waves-block"><i class="material-icons">input</i>Update Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url('admin/logout'); ?>" class=" waves-effect waves-block"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
							</div>
							<br>
							<br>
							<div class="card" style="background: red;">
								 <div class="card-body" style="background: red;">
							<div class="col-lg-6">
								<h3 class="pages_title">
									<font color="0171b5">
									Complaints for Allocation to Benches<hr></font>
								</h3>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box medium_sea_green hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/get_complaints/F'); ?>">
										<div class="padd">
											<div class="icon medium_sea_green1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4 style="color: #FFFFFF">Fresh complaints</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<a id="ContentPlaceHolder1_lblNoOfSuMotoCases" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$lblNoOfSuMotoCases','')" style="color:White;font-size:18px;"> <?php echo $fresh_comps;  ?></a>
												</div>
											</div>
						
										</div>
									</a>
										<div class="medium_sea_green1 more" style="background-color: #51adcf;">
										</div>
									
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box officers_bg hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/get_complaints/I'); ?>">
										<div class="padd">
											<div class="icon officers_bg1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>Complaints in which preliminary-inquiry<br>has been received</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<span id="ContentPlaceHolder1_lblTotalPending" style="font-size:18px;"><?php echo $pre_inq_comps; ?></span>
												</div>
											</div>
									
										</div>
									</a>
										<div class="officers_bg1 more" style="background-color: #51adcf;">
										</div>
									
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box medium_sea_green hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/get_complaints/V'); ?>">
										<div class="padd">
											<div class="icon medium_sea_green1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4 style="color: #FFFFFF">Complaints in which investigation<br>has been received</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<a id="ContentPlaceHolder1_lblNoOfSuMotoCases" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$lblNoOfSuMotoCases','')" style="color:White;font-size:18px;"><?php echo $inv_comps;  ?></a>
												</div>
											</div>
										
										</div>
									</a>
										<div class="medium_sea_green1 more" style="background-color: #51adcf;">
										</div>
								
									</div>
								</div>

							</div>
							</div>
							</div>

							<div class="col-lg-6" style="float: left;">
								<h3 class="pages_title"><font color="0171b5">
									Creation of New Bench<hr></font>
								</h3>

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box medium_sea_green hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/benchcomposition_separate'); ?>">
										<div class="padd">
											<div class="icon medium_sea_green1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4 style="color: #FFFFFF">Create a new</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<a id="ContentPlaceHolder1_lblNoOfSuMotoCases" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$lblNoOfSuMotoCases','')" style="color:White;font-size:18px;">bench</a>
												</div>
											</div>
									
										</div>
									</a>
										<div class="medium_sea_green1 more" style="background-color: #51adcf;">
										</div>
									
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box officers_bg hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/benches_all'); ?>">
										<div class="padd">
											<div class="icon officers_bg1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>Existing Benches</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<span id="ContentPlaceHolder1_lblTotalPending" style="font-size:18px;">4</span>
												</div>
											</div>
											
										</div>
									</a>
										<div class="officers_bg1 more" style="background-color: #51adcf;">
										</div>
									
									</div>
								</div>

							</div>

					</div>

					<div class="clearfix"></div>

						<div class="table-responsive">

							<span id="success_message"></span>
							<div class="card" style="background: red;">
								 <div class="card-body" style="background: red;">
							<div class="col-lg-6">
								<h3 class="pages_title">
									<font color="0171b5">
									Complaints Status<hr>
								</font>
								</h3>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box officers_bg hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('bench/search_case'); ?>">
										<div class="padd">
											<div class="icon" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>Search</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<span id="ContentPlaceHolder1_lblTotalPending" style="font-size:18px;"><?php echo 'Complaints'; ?></span>
												</div>
											</div>
									
										</div>
									</a>
										<div class="officers_bg1 more" style="background-color: #51adcf;">
										</div>
								
									</div>
								</div>

							</div>
							</div>
							</div>

							<div class="col-lg-6" style="float: left;">
								<h3 class="pages_title">
									<font color="0171b5">
									Mis Report<hr>
								</font>
								</h3>

									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box medium_sea_green hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('report/status_of_complaints'); ?>">
										<div class="padd">
											<div class="icon medium_sea_green1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4 style="color: #FFFFFF">Status of</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<a id="ContentPlaceHolder1_lblNoOfSuMotoCases" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$lblNoOfSuMotoCases','')" style="color:White;font-size:18px;">Complaints</a>
												</div>
											</div>
									
										</div>
									</a>
										<div class="medium_sea_green1 more" style="background-color: #51adcf;">
										</div>
								
									</div>
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="dashboard-box officers_bg hvr-glow" style="background-color: #51adcf;">
										<a href="<?php echo base_url('report/status_of_complaints_under_loi'); ?>">
										<div class="padd">
											<div class="icon officers_bg1 hvr-pulse" style="background-color: #51adcf;">
												<img src="<?php echo base_url();?>assets/rohp/icon/icon11.png" title="icon">
											</div>
											<div class="headlin">
												<div class="dashboard_name"> 
													<h4>Status of Complaints under consideration</h4>
												</div>
												<br><br>
												<div class="dashboard_reports">
													<span id="ContentPlaceHolder1_lblTotalPending" style="font-size:18px;">with Lokpal of India</span>
												</div>
											</div>
									
										</div>
									</a>
										<div class="officers_bg1 more" style="background-color: #51adcf;">
										</div>
								
									</div>
								</div>
														
							</div>

					</div>

			</fieldset>
		</div>

	</section>-->


                </div>
            </div>	

            <script>
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();  
});
</script>