<?php
//$elements = $this->label->view(1);


//echo "<pre>";
 $user['id'];


?>

<div class="app-content">
	<div class="main-content-app">
		<div class="page-header">
			<h4 class="page-title">Dashboard for Complainant</h4>
			<ol class="breadcrumb"> 
				<li class="breadcrumb-item"><a href="#">Dashboard for Complainant</a></li>
			</ol>
		</div>
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading"></div>
						<div class="panel-body">
							<div class="row">			

	

							  	<div class="col-lg-4 col-sm-4 mb-15">
							  		<a href="#" class="widgets-card gd-cyanblue widgets-contentt">
							  			<div class="widgets-icon">
							  				<span>
							  					<i class="fa fa-file-text-o" aria-hidden="true"></i>
							  				</span>
							  			</div>
							  			<div class="widgets-content" id="xyz">Lodge a new Complaint</div>
							  			<i class="fa fa-sitemap transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>


								<div class="col-lg-4 col-sm-4 mb-15" id="divFY">
							  		<a href="<?php echo base_url('filing/dashboard_new'); ?>" class="widgets-card gd-blueviolet">
							  			<div class="widgets-icon">
							  				<span id="ContentPlaceHolder1_lblTotalPending">
							  					<?php echo $pen_comps; ?>
							  				</span>
							  			</div>
							  			<div class="widgets-content">Complete the Draft Complaints</div>
							  			<i class="fa fa-sitemap transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>


							  <div class="col-lg-4 col-sm-4 mb-15">
							  		<a href="<?php echo base_url('filing/dashboard_completed_complaint'); ?>" class="widgets-card gd-hotpink">
							  			<div class="widgets-icon"><span id="ContentPlaceHolder1_lblTotlaDistposed"> <?php echo $completed_comps;  ?></span></div>
							  			<div class="widgets-content">Check the status of  Complaints</div>
							  			<i class="fa fa-files-o transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>



							  	<div class="col-lg-4 col-sm-4 mb-15" id="divFY">
							  		<a href="<?php echo base_url('filing/dashboard_re_entry_complaint'); ?>" class="widgets-card gd-blueviolet">
							  			<div class="widgets-icon">
							  				<span id="ContentPlaceHolder1_lblTotalPending">
							  					<?php echo $re_edit_comp; ?>
							  				</span>
							  			</div>
							  			<div class="widgets-content">List of Complaint open for editing</div>
							  			<i class="fa fa-sitemap transparent_icon" aria-hidden="true"></i>
							  		</a>
							  	</div>



							 <!--	<div class="col-lg-4 col-sm-4 mb-15">
								<a href="<?php //echo base_url('Filing/dashboard_re_entry_complaint'); 

									echo "<pre>";
									print_r($re_edit_comp);
								?>" class="widgets-card gd-blueviolet">
							  		<div class="widgets-icon"><span id="ContentPlaceHolder1_lblTotalRegistration"><?php echo $re_edit_comp; ?></span></div>
							  	<div class="widgets-content">List of Complaint open for editing</div>
							  		<i class="fa fa-address-card-o transparent_icon" aria-hidden="true"></i>
							  	</a>
							</div>-->


							  	



							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
      $(document).ready(function() {
      $('#xyz').click(function(){
      	//alert('g');
      $.ajax({
            url: '<?php echo site_url('filing/check_pending_complaints'); ?>',
            type: 'POST',
           // data:{hearing_date:hearing_date, checkedValue:checkedValue},
            //data : myJSON,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.is_pending > 3){
                  alert('Complete existing complaint first to lodge a fresh complaint');
                  // window.location.reload(); 
                }else if(data.is_pending <= 3){
                  //alert('Do filing');
                  window.location='filing'

                  
                }
                /*if(data.success){
                  console.log(data.success);
                  window.location.reload();
                }  */         
            }


          });

        });
      });

</script>

