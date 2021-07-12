<?php include(APPPATH.'views/templates/front/template-top.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4">Enroll with us..</h1>
  </div>
</div>	<!-- Blog Section -->

<?php //echo "<pre>";print_r($cities[]);die; ?>
<section id="blog" class="bg-grey">
	<form  method="post" class="register-form needs-validation" name="register-form" id="register-form" action="" method="post" novalidate>
    <div class="container">
		
        <div class="section-content">
         	<div class="row d-flex justify-content-center">
				<div class="col-md-10 mb-5 "> 
					<h3 class="mb-3">Register as...</h3>
						<div class="row">             
						  	<div class="col-md-3 mb-2 col-sm-4">
								<div class="custom-control custom-radio">
									<span>An Organization</span>
									<input id="comp" name="user_type" type="radio" class="custom-control-input" value="1" checked="" required>
									<label class="custom-control-label" for="comp"></label>
									
							  	</div>
						  	</div>
						  	<div class="col-md-3 mb-2 col-sm-4">
								<div class="custom-control custom-radio">
									<span>An Individual</span>
									<input id="ind" name="user_type" type="radio" class="custom-control-input" value="2" required>
									<label class="custom-control-label" for="ind"></label>	
								</div> 
						  	</div>    
						</div>   
				  	<hr class="my-4"> 
				  	<!--Start Company -->
					<div class="register-1">
				  		<h4 class="mb-3">Organization</h4>
				  		<div class="mb-3 form-group">
							<span>Organization name<font color="red">*</font></span>
							<input type="text" class="form-control reg-company-input" name="comp_name" id="comp_name" placeholder="Enter Name" value="" required />
							<label for="comp_name"></label>
						</div>
						<div class="mb-3 form-group">
							<span>Address<font color="red">*</font></span>
							<input type="text" class="form-control reg-company-input" placeholder="1234 Main St" id="comp_addr" name="comp_addr" required>
							<label for="comp_addr"></label>
						</div>

						<div class="mb-3 form-group">
						  	<span>Telephone<font color="red">*</font></span>
						  	                    
							<input class="form-control reg-company-input" type="text" placeholder="+234-809-5558-0" id="comp_phone" name="comp_phone" required />
							<label for="comp_phone"></label>
						  	
						</div>
						<div class="mb-3 form-group">
						  	<span>Email<font color="red">*</font></span>
						  	<input type="email" class="form-control reg-company-input" id="comp_email" placeholder="company@example.com" name="comp_email" required />
						  	<label for="comp_email"></label>
						</div>

						<div class="row">
							<div class="col-md-6 mb-3 form-group">
								<span>City<font color="red">*</font></span>
								<select class="custom-select d-block w-100 selectpicker reg-company-input" id="city_id" name="city_id" required />
									<?php 
										echo "<option value=''>-- Select --</option>";
										foreach($cities as $key=>$values){ 
											?>
											<optgroup label="<?php echo str_replace("_"," ",$key); ?>">
												<?php	
													foreach ($values as $value){
														$splitData = explode('###',$value);
														 echo '<option value="'.$splitData[1].'">-'.$splitData[0].'</option>';
													}
								?>
											</optgroup>
										<?php } ?>  
								</select>
								<label for="city_id"></label>
							</div>
							<div class="col-md-6 mb-3 form-group"></div> 
						</div>
					</div>	
					<!--Start Individual -->
					<div class="register-2" style="display: none;">

						<h4 class="mb-3">Individual</h4>
						<div class="mb-3 form-group">
							<span>Full Name<font color="red">*</font></span>
							<input type="text" class="form-control reg-individual-input" id="ind_name" name ="ind_name" placeholder="Enter Name" value="" required>
							<label for="ind_name"></label>
						</div>

						<div class="mb-3 form-group">
							<span>Email<font color="red">*</font></span>
							<input type="email" class="form-control reg-individual-input" id="ind_email" name="ind_email" placeholder="you@example.com" required>
							<label for="ind_email"></label>
						</div>

						<div class="mb-3 form-group">
						  	<span>Address<font color="red">*</font></span>
						  	<input type="text" class="form-control reg-individual-input" id="ind_addr" name="ind_addr" placeholder="1234 Main St" required>
						  	<label for="ind_addr"></label>
						</div>
						<div class="mb-3 form-group">
						 	<span>Telephone<font color="red">*</font></span>
						  	                  
							<input class="form-control reg-individual-input" type="text" name="ind_phone" id="ind_phone" placeholder="+234-809-5558-0" required>
							<label for="ind_phone"></label>
						  	</div>
						  	
						<div class="row"> 
						  	<div class="col-md-6 mb-3 form-group">
								<span for="ind_city">City<font color="red">*</font></span>
								<select class="custom-select d-block w-100 selectpicker reg-company-input" name="ind_city" id="ind_city" required >
								<?php 
										echo "<option value=''>-- Select --</option>";
										foreach($cities as $key=>$values){ 
											?>
											<optgroup label="<?php echo str_replace("_"," ",$key); ?>">
												<?php	
													foreach ($values as $value){
														$splitData = explode('###',$value);
														 echo '<option value="'.$splitData[1].'">-'.$splitData[0].'</option>';
													}
								?>
											</optgroup>
										<?php } ?> 
								</select>
								<label for="ind_city"></label>
						  	</div>
						  	<div class="col-md-6 mb-3 form-group">
							
						  	</div>                  
						</div>
					</div>
					<!--End Individual -->
					<hr class="mb-4">
					<div class="register-c">
						<h4 class="mb-3 form-group">Request for Training</h4>
							<div class="row">
								<div class="col-md-8 mb-3 form-group">
									<span>Choose a Training<font color="red">*</font></span>
									<select class="custom-select d-block w-100 selectpicker reg-company-input"  name="course" id="course" onChange="courseData(this);" required>
										 <?php 
												echo "<option value=''>-- Select --</option>";
												foreach($category as $key=>$values){ 
													?>
													<optgroup label="<?php echo str_replace("_"," ",$key); ?>">
														<?php	
														foreach ($values as $value){
															$splitD = explode('--',$value);
															
															 if($trainingPId[0]['category_id']==$splitD[1]){
																 
																 $seltd = 'selected';
																 
															  }else{
																 $seltd = '';
															  }
															 echo '<option value="'.$splitD[1].'"  '.$seltd.'>-'.$splitD[0].'</option>';
															 }
														 ?>
													</optgroup>
												<?php } ?> 
										</select>
						<label for="etraining_id"></label>
						<div class="invalid-feedback">
						  Please select a valid Trainings Course.
						</div>
					 </div> 
					  <div class="col-md-8 mb-3 form-group">
						<span>Choose a Course<font color="red">*</font></span>
						 <select class="form-group custom-select d-block w-100 selectpicker reg-company-input" id="etraining_id" name="etraining_id" required >
								<?php if($trainingId!=''){?>
								<option value='<?php echo $trainingId;?>'><?php echo $trainingPId[0]['name'];?></option>
								<?php }else{?>
								 <option value=''>-- Select --</option>
								<?php } ?>
						 </select>					
						<label for="course"></label>
					  </div>                 
					  <div class="col-md-4 mb-3 form-group">
						<span>No. of Delegates<font color="red">*</font></span>
						<select class="form-group custom-select d-block w-100 selectpicker reg-company-input" name="no_of_trn_delegates" id="no_of_trn_delegates" required />
						  <option value="" selected>Choose...</option>
						  <option value="0 - 5">0 - 5</option>
						  <option value="5 - 10">5 - 10</option>
						  <option value="10 - 25">10 - 25</option>
						  <option value="25 - 50">25 - 50</option>
						  <option value="50 and above">50 and above</option>
						</select>
						 <label for="no_of_trn_delegates"></label>                  
					  </div>
					</div> 

							<div class="mb-3 form-group">
								<span>Name of Delegates<font color="red">*</font></span>
								<textarea name="delegates" id="delegates" name="delegates" class="form-control reg-common-input" placeholder="Names of participants (Surname First), one in a row" required></textarea>
								<span class="small-txt">Atleast one delegate name required, and can be changes later on.</span>
								<label for="delegates"></label>
							</div>

<!--
							<div class="mb-3 form-group">
								<span>Preferred Course Start Date/Time<font color="red">*</font></span>
								<input type="text" class="form-control reg-common-input" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="pre_tr_sttime" id="pre_tr_sttime" required />
								<label for="pre_tr_sttime"></label>
							</div> 
							<div class="mb-3 form-group">
								<span>Preferred Course End Date/Time<font color="red">*</font></span>
								<input type="text" class="form-control reg-common-input" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="pre_tr_etime" id="pre_tr_etime" required />
								<label for="pre_tr_etime"></label>
							</div>
-->

				<div class="row">        
					<div class="col-md-6 mb-3 form-group">
						<span>Preferred Course Start/End Date<font color="red">*</font></span>
						<input type="text" class="form-control reg-company-input datepicker" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="tr_stdate" id="tr_stdate" required>
						<label for="tr_stdate"></label>
					</div>      
					<div class="col-md-6 mb-3 form-group">
						<span><font color="red">&nbsp;</font></span>
						<input type="text" class="form-control reg-company-input datepicker" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="tr_enddate" id="tr_enddate" required>
						<label for="pre_tr_etime"></label>
					</div>
					</div>
					 <div class="row">        
					<div class="col-md-6 mb-3 form-group">
						<span>Preferred Course Duration<font color="red">*</font></span>
						<input type="text" class="form-control reg-company-input datetimepicker" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="tr_sttime" id="tr_sttime" required>
						<label for="tr_sttime"></label>
					</div>      
					<div class="col-md-6 mb-3 form-group">
						<span><font color="red">&nbsp;</font></span>
						<input type="text" class="form-control reg-company-input datetimepicker" placeholder="10 Jan 2010, 9:00AM to 11:00AM" name="tr_etime" id="tr_etime" required>
						<label for="tr_etime"></label>
					</div>
					</div>
							<div class="mb-3 form-group">
							  	<span>Preferred Course Location<font color="red">*</font></span>
							  	<input type="text" class="form-control reg-common-input" id="pre_tr_loc" name="pre_tr_loc" placeholder="1234 Main St" required />
							 	<label for="pre_tr_loc"></label>
							</div>  
						<hr class="my-4">
					</div>	
					<div class="register-1">	
						<h4 class="mb-3">Requested by (Appropriate Authority)</h4>
						<div class="row">
							<div class="col-md-6 mb-3 form-group">
								<span>Full Name<font color="red">*</font></span>
								<input type="text" class="form-control reg-company-input" placeholder="" name="comp_cp_name" id="comp_cp_name" required />
								<label for="comp_cp_name"></label>
							</div>
							<div class="col-md-6 mb-3 form-group">
								<span>Position<font color="red">*</font></span>
								<input type="text" class="form-control reg-company-input" id="comp_cp_designation" placeholder="" value="" name="comp_cp_designation" required>
								<label for="comp_cp_designation"></label>
							</div>
						</div>
					   
						<div class="mb-3 form-group">
						  	<span>Telephone<font color="red">*</font></span>
						  	<!-- <div class="input-group"> -->                    
								<input class="form-control reg-company-input" type="text" placeholder="+234-809-5558-0" name="comp_cp_phone" id="comp_cp_phone" required>
								<label for="comp_cp_phone"></label>
						  	<!-- </div> -->
						</div>
						<hr class="mb-4">
					</div>
					<div class="register-c">
		            <h4 class="mb-3">Account Details</h4>             
		                <div class="mb-3 form-group">
		                  <span>Username<font color="red">*</font></span>
		                  <div class="input-group">
		                    <div class="input-group-prepend">
		                      <span class="input-group-text"></span>
		                    </div>
		                    <input type="text" class="form-control reg-common-input" id="cusername" name="cusername" placeholder="Username" required>
		                    <label for="cusername"></label>
		                  </div>
		                </div>

						<div class="mb-3 form-group">
						<span>Password<font color="red">*</font></span>
							<input class="form-control reg-common-input" type="password" placeholder="password" name="copassword" id="copassword" required>
							<label for="copassword"></label>
						</div>

						<div class="mb-3 form-group">
						<span>Confirm Password<font color="red">*</font></span>                   
							<input class="form-control reg-common-input" type="password" placeholder="confirm password" name="ccpassword" id="ccpassword" required>
							<label for="ccpassword"></label>
						</div>
						<hr class="my-4">
					</div>
				   	<!--End Company -->
					<input class="btn btn-success btn-lg" type="submit" value="SUBMIT" name="submit">
					<div class="col-md-12 text-center">
						<label for="message"></label>
						<div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i></div>
					</div>
					<div class="col-md-12 info"></div>
				</div>
        	</div>
    	</div>
	</div>
	</form>
</section>	

<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>
<!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$("[name=user_type]").on('change', function(event) {
		  var radioButton = $(event.currentTarget);
			  if(radioButton.val() == '1'){
				$('.register-1').show();
				$('.register-2').hide();
			  }else if(radioButton.val() == '2'){
				$('.register-2').show();
				$('.register-1').hide();
			  }
		  
		});

	});
	
function courseData(){
		
		var course = $('#course').val();
        
        var dataVal = course;
        var url_ = "<?php echo base_url("training/getCourse?etraining_id=");?>"+dataVal;
        var request = 	$.ajax({
                type: "POST",
                url: url_,
                data: { cod: dataVal},
                success: function(msg){
					
                        $("#etraining_id").html(msg);
                        
                }
            });	
	}		
	
$(function () {
        $('.datetimepicker').datetimepicker({
            format: 'LT'
        });
    });

   $(function () {
        var startDate = $('#tr_stdate').val();
        $("#tr_stdate").datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#tr_enddate').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('#tr_enddate').datepicker('setStartDate', null);
        });

        $("#tr_enddate").datepicker({
           format: 'dd-mm-yyyy',
           autoclose: true,
           startDate: startDate,
        }).on('changeDate', function (selected) {
           var endDate = new Date(selected.date.valueOf());
           $('#tr_stdate').datepicker('setEndDate', endDate);
        }).on('clearDate', function (selected) {
           $('#tr_stdate').datepicker('setEndDate', null);
        });
    });

	
</script>
