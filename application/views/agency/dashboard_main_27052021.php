<?php
//$elements = $this->label->view(1);
?>
<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Dashboard for Agency</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('agency/dashboard_main'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Dashboard for Agency</li> 
      </ol>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard for Agency</div>
          <div class="panel-body">
          	<span id="success_message"></span>
            <div class="row">
              <div class="col-md-12">  

				<div class="row">
				  <div class="col-md-4" id="divFY">
					<a href="<?php echo base_url('agency/dashboard'); ?>" class="widgets-card gd-blueviolet">
					  <div class="widgets-icon"><span id="ContentPlaceHolder1_lblTotalRegistration"><?php echo $agntot_comps; ?></span></div>
					  <div class="widgets-content">Total Complaints</div>
					  <i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
					</a>
				  </div>
				  <div class="col-md-4">
					<a href="<?php echo base_url('agency/dashboard'); ?>" class="widgets-card gd-hotpink">
					  <div class="widgets-icon"><span id="ContentPlaceHolder1_lblTotalPending"><?php echo $agnpen_comps; ?></span></div>
					  <div class="widgets-content">Pending for Reporting</div>
					  <i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
					</a>
				  </div>
				  <div class="col-md-4">
					<a href="#" class="widgets-card gd-goldyellow">
					  <div class="widgets-icon"><span id="ContentPlaceHolder1_lblNoOfSuMotoCases"><?php echo $agndon_comps;  ?></span></div>
					  <div class="widgets-content">Reporting Completed</div>
					  <i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
					</a>
				  </div>

				</div>	
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>