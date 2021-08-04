<?php
//$elements = $this->label->view(1);
?>

<div class="app-content">
	<div class="main-content-app">
		<!--<div class="page-header">
			<h4 class="page-title">Dashboard for Scrutiny Section</h4>
			<ol class="breadcrumb"> 
				<li class="breadcrumb-item"><a href="#">Dashboard for Scrutiny</a></li>
			</ol>
		</div>-->
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">Dashboard for <?php  if($user['username']){
                                echo $user['username'];
                              }else{
                                echo 'n/a';
                              }?></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-6 col-sm-6 mb-15" id="divFY">
							  		<a href="<?php echo base_url('scrutiny/dashboard'); ?>" class="widgets-card gd-blueviolet">
							  			<div class="widgets-icon">
							  				<span id="ContentPlaceHolder1_lblTotalPending">
							  					<?php echo $scrpen_comps; ?>
							  				</span>
							  			</div>
							  			<div class="widgets-content">New Complaints for Scrutiny</div>
							  			<i class="fa fa-sitemap transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>
							  <div class="col-lg-6 col-sm-6 mb-15">
							  		<a href="<?php echo base_url('scrutiny/dashboard_def'); ?>" class="widgets-card gd-hotpink">
							  			<div class="widgets-icon"><span id="ContentPlaceHolder1_lblTotlaDistposed"> <?php echo $scrdef_comps;  ?></span></div>
							  			<div class="widgets-content">List of Defective Complaints</div>
							  			<i class="fa fa-files-o transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>
							  	
							</div>
 <?php   //print_r($data['user']['id']);
//echo $user['id'];

 //die;
 if($user['id']=='1317')
{
 ?>


					<div class="row">
                    	<div class="col-md-12">
                    		<div class="panel panel-default">
							  <div class="panel-heading">Report Received from External agency for the consideration of Bench</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-6 mb-15">
							  			<a href="<?php //echo base_url("proceeding/dashboard/$bench_no/RI");
							  				echo base_url("scrutiny/agency_report_chk/RI");

							  			 ?>" class="widgets-card gd-cyanblue" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $inq_report_count;  ?></span></div>
							  				<div class="widgets-content">Preliminary Inquiry</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-6 mb-15">
							  			<a href="<?php  //echo base_url("proceeding/dashboard/$bench_no/RV");
							  			echo base_url("scrutiny/agency_report_chk/RV");



							  			 ?>" class="widgets-card gd-green" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo  $inv_report_count; ?></span></div>
							  				<div class="widgets-content">Investigation Report</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>


							  		


							  		
							  		<!--<div class="col-md-4">
							  			<a href="<?php //echo base_url("proceeding/dashboard/$bench_no/V"); ?>" class="widgets-card gd-goldyellow">
							  				<div class="widgets-icon"><span><?php //echo $inv_data_count;  ?></span></div>
							  				<div class="widgets-content">Complaints in which investigation Report has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>-->
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="panel panel-default">
							  <div class="panel-heading">Opportunity to Public Servant</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-6 mb-15">
							  			<a href="<?php  //echo base_url("proceeding/dashboard/$bench_no/RV");
							  			echo base_url("scrutiny/ps_report_chk/OPI");



							  			 ?>" class="widgets-card gd-blue" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo  $oppertunity_ps_after_pi_count; ?></span></div>
							  				<div class="widgets-content">After Preliminary Inquiry</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>

							  		<div class="col-md-6 mb-15">
							  			<a href="<?php  //echo base_url("proceeding/dashboard/$bench_no/RV");
							  			echo base_url("scrutiny/ps_report_chk/OIR");

							  			 ?>" class="widgets-card gd-fuchsia" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo  $oppertunity_ps_after_IR_count; ?></span></div>
							  				<div class="widgets-content">After Investigation</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
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
							  <div class="panel-heading">Any Other Report Received</div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-6 mb-15">
							  			<a href="<?php  //echo base_url("proceeding/dashboard/$bench_no/RV");
							  			echo base_url("scrutiny/ps_report_chk/AOA");

							  			 ?>" class="widgets-card gd-peru" data-toggle="tooltip" data-placement="bottom" >
							  				<div class="widgets-icon"><span><?php echo  $any_other_action; ?></span></div>
							  				<div class="widgets-content">  Status Report/Additional Documents/Others  </div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>

                <?php } ?>




						</div>
				</div>
			</div>
		</div>
	</div>
</div>


