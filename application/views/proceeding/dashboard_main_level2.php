<?php
//$elements = $this->label->view(1);
if (0 == $bench_no) {
	$bench_no_display = 'Full Bench';
} else {
	$bench_no_display = 'Bench no.-'.$bench_no;
} ?>
			<div class="app-content">
                <div class="main-content-app">
                	<div class="page-header">
                        <h4 class="page-title">Dashboard of <?php echo $bench_no_display; ?></h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url("proceeding/dashboard_main"); ?>">Dashboad of Bench</a></li> 
							<li class="breadcrumb-item active" aria-current="page">Complaints for Hearing</li> 
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
							  <div class="panel-heading">Complaints for the Consideration of Bench

							  <ul class="more-action">
                              <li><a href="<?php echo base_url(); ?>proceeding/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
							  </div>
							  <div class="panel-body">
							  	<div class="row">
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/F"); ?>" class="widgets-card gd-blueviolet">
							  				<div class="widgets-icon"><span><?php echo $allocated_data_count;  ?></span></div>
							  				<div class="widgets-content">New complaints</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/I"); ?>" class="widgets-card gd-hotpink" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $inq_data_count; ?></span></div>
							  				<div class="widgets-content">Complaints for which Preliminary-Inquiry  Report has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/V"); ?>" class="widgets-card gd-goldyellow" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $inv_data_count;  ?></span></div>
							  				<div class="widgets-content">Complaints for which Investigation Report has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/OPI"); ?>" class="widgets-card gd-purple" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $ops_inq_report_count;  ?></span></div>
							  				<div class="widgets-content">Complaints for which Public Servant's Report after Preliminary Inquiry has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/OPV"); ?>" class="widgets-card gd-olive" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $ops_inv_report_count; ?></span></div>
							  				<div class="widgets-content">Complaints for which Public Servant's Report after Investigation has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>	
							  		<div class="col-md-4 mb-15">
							  			<a href="<?php echo base_url("proceeding/dashboard/$bench_no/AOA"); ?>" class="widgets-card gd-navy" data-toggle="tooltip" data-placement="bottom">
							  				<div class="widgets-icon"><span><?php echo $aoa_report_count;  ?></span></div>
							  				<div class="widgets-content">Complaints for which Status/Additional Documents/Other Report has been received</div>
							  				<i class="fa fa-file-text-o transparent_icon" aria-hidden="true"></i>
							  			</a>
							  		</div>	
							  	</div>
							  </div>
							</div>
                    	</div>
                    </div>


<!--ysc code end 8july -->


                </div>
            </div>	
            <script>
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();  
});
</script>