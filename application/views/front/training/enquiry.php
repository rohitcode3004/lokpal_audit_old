<?php include(APPPATH.'views/templates/front/template-top.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4">Enquiry</h1>
  </div>
</div>	<!-- Blog Section -->

<?php 
   // echo "<pre>";print_r($getCompanyDetails);
    if($getCompanyDetails[0]->cus_type== '1'){
		
		$chkd =  'checked="checked"';
		
	}else{
		$chkd =  '';
	}
	
	if($getCompanyDetails[0]->cus_type== '2'){
		
		$chkdInd =  'checked="checked"';
		
	}else{
		$chkdInd =  '';
	}
    
    
      $trainingId  = $this->uri->segment(4);
	  $trainingPId = getTrainingDetails(decrypt($trainingId));

	  $course_name = $this->uri->segment(3);
	
?>
<section id="blog" class="bg-grey">
    <form  method="post" class="enq-form needs-validation" name="enq-form" id="enq-form" action="" method="post" novalidate>

    <div class="container">
		
        <div class="section-content">
         <div class="row d-flex justify-content-center">
				<div class="col-md-10 mb-5 "> 
					<h3 class="mb-3">Are you...</h3>
					<div class="row">             
					<div class="col-md-3 mb-2 col-sm-4">
                                <div class="custom-control custom-radio">
                                    <span>An Organization</span>
                                    <input id="comp" name="cus_type" type="radio" class="custom-control-input" value="1" <?php echo $chkd;?> required>
                                    <label class="custom-control-label" for="comp"></label>
                                    
                                  </div>
                              </div>
                              <div class="col-md-3 mb-2 col-sm-4">
                                <div class="custom-control custom-radio">
                                    <span>An Individual</span>
                                    <input id="ind" name="cus_type" type="radio" class="custom-control-input" value="2" <?php echo $chkdInd;?> required>
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
						<input type="text" class="form-control reg-company-input" name="comp_name" id="comp_name" placeholder="Organization name" value="<?php if($getCompanyDetails[0]->comp_name!=''){echo $getCompanyDetails[0]->comp_name;}else{ echo "";}?>" required>
						<label for="comp_name"></label>
					  </div>
					  <div class="mb-3 form-group">
					  <span>Address<font color="red">*</font></span>
					  <input type="text" class="form-control reg-company-input" placeholder="1234 Main St" id="comp_addr" name="comp_addr" value="<?php if($getCompanyDetails[0]->comp_addr!=''){echo $getCompanyDetails[0]->comp_addr;}else{ echo "";}?>" required>
					<label for="comp_addr"></label>
					</div>
					  <div class="mb-3 form-group">
					  <span>Comp. Phone No.<font color="red">*</font></span>
					  <div class="input-group">                    
						<input class="form-control reg-company-input" type="text" placeholder="+234-809-5558-0" id="comp_phone" name="comp_phone" value="<?php if($getCompanyDetails[0]->comp_phone!=''){echo $getCompanyDetails[0]->comp_phone;}else{ echo "";}?>" required />
						<label for="comp_phone"></label>
					  </div>
					</div>
					<div class="mb-3 form-group">
					 <span>Email <font color="red">*</font></span>
					  <input type="text" class="form-control reg-company-input" placeholder="company@example.com" id="comp_email" name="comp_email" value="<?php if($getCompanyDetails[0]->comp_email!=''){echo $getCompanyDetails[0]->comp_email;}else{ echo "";}?>" required />
					  <label for="comp_email"></label>
					</div>

					<div class="row">
					  <div class="col-md-6 mb-3 form-group">
						<span>City<font color="red">*</font></span>
						<select class="form-control custom-select d-block w-100 selectpicker" id="city_id" name="city_id" required>
						<?php 
										echo "<option value=''>-- Select --</option>";
										foreach($cities as $key=>$values){ 
											?>
											<optgroup label="<?php echo str_replace("_"," ",$key); ?>">
												<?php	
													foreach ($values as $value){
														$splitData = explode('###',$value);
														
														if($getCompanyDetails[0]->city_id== $splitData[0] && $getCompanyDetails[0]->city_id!='0'){
															
															$seltd =  'selected="selected"';
															
														}else{
															$seltd =  '';
														}
														
														 echo '<option value="'.$splitData[0].'" '.$seltd.'>-'.$splitData[0].'</option>';
													}
								?>
											</optgroup>
										<?php } ?> 
						</select>
						<label for="city_id"></label>
					  </div>
					  <div class="col-md-6 mb-3">
						
					  </div>                  
					</div>
				</div>	
				<!--Start Individual -->
				
				<div class="register-2" style="display: none;">

				 <h4 class="mb-3">Individual</h4>

						  <div class="mb-3 form-group">
							<span>Full Name<font color="red">*</font></span>
							<input type="text" class="form-control reg-company-input" id="ind_name" name="ind_name" placeholder="Full Name" value="<?php if($getCompanyDetails[0]->indv_name!=''){echo $getCompanyDetails[0]->indv_name;}else{ echo "";}?>" required> 
							<label for="ind_name"></label>
							<div class="invalid-feedback">
							  Valid first name is required.
							</div>
						  </div>

						<div class="mb-3 form-group">
						  <span>Email <font color="red">*</font></span>
						  <input type="text" class="form-control reg-company-input" id="ind_email" name="ind_email" placeholder="you@example.com" value="<?php if($getCompanyDetails[0]->indv_email!=''){echo $getCompanyDetails[0]->indv_email;}else{ echo "";}?>">
						  <label for="ind_email"></label>
						  <div class="invalid-feedback">
							Please enter a valid email address for shipping updates.
						  </div>
						</div>

						<div class="mb-3 form-group">
						  <span>Address<font color="red">*</font></span>
						  <input type="text" class="form-control reg-company-input" id="ind_address" name="ind_address" placeholder="1234 Main St" value="<?php if($getCompanyDetails[0]->indv_addr!=''){echo $getCompanyDetails[0]->indv_addr;}else{ echo "";}?>" required>
						  <label for="ind_address"></label>
						  <div class="invalid-feedback">
							Please enter your shipping address.
						  </div>
						</div>
						<div class="mb-3 form-group">
						  <span>Phone No.<font color="red">*</font></span>
						  <div class="input-group">                    
							<input class="form-control reg-company-input" type="text" placeholder="+234-809-5558-0" id="ind_phone" name="ind_phone" value="<?php if($getCompanyDetails[0]->indv_phone!=''){echo $getCompanyDetails[0]->indv_phone;}else{ echo "";}?>" required>
							<label for="phone"></label>
							<div class="invalid-feedback" style="width: 100%;">
							  Phone number is required.
							</div>
						  </div>
						</div>
						<div class="row">
							  <div class="col-md-6 mb-3 form-group">
								<span>City<font color="red">*</font></span>
								<select class="custom-select d-block w-100 selectpicker reg-company-input" id="ind_city" name="ind_city" required >
								<?php 
										echo "<option value=''>-- Select --</option>";
										foreach($cities as $key=>$values){ 
											?>
											<optgroup label="<?php echo str_replace("_"," ",$key); ?>">
												<?php	
													foreach ($values as $value){
														$splitData = explode('###',$value);
														
														//if($course_name==$splitData[0]){
															
															//$seltd = 'selected="selected"';
														//}
														
														if($getCompanyDetails[0]->city_id== $splitData[0] && $getCompanyDetails[0]->city_id!='0'){
															
															$seltd =  'selected="selected"';
															
														}else{
															$seltd =  '';
														}
														
														
														 echo '<option value="'.$splitData[0].'" '.$seltd.'>-'.$splitData[0].'</option>';
													}
								?>
											</optgroup>
										<?php } ?> 
								</select>
								<label for="ind_city"></label>
								<div class="invalid-feedback">
								  Please select a valid country.
								</div>
							  </div>
						  <div class="col-md-6 mb-3">
							
						  </div>                  
						</div>
					</div>
					<!--End Individual -->
				<hr class="mb-4">
				<div class="register-c">
					
					<h4 class="mb-3">Request for Training</h4>
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
						<textarea name="delegates" id="delegates" class="form-control reg-company-input" placeholder="Names of participants (Surname First), one in a row"  required ></textarea>
						<label for="delegates"></label>
						<span class="small-txt">Atleast one delegate name required, and can be changes later on.</span>
					 </div> 
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
					  <input type="text" class="form-control reg-company-input" id="pre_tr_loc" placeholder="1234 Main St" name="pre_tr_loc" required>
					 <label for="pre_tr_loc"></label>
					</div>  
					<hr class="my-4">
				</div>	
				<div class="register-1">	
					<h4 class="mb-3 form-group">Requested by (Appropriate Authority)</h4>
					<div class="row">
					  <div class="col-md-6 mb-3 form-group">
						<span>Full Name<font color="red">*</font></span>
						<input type="text" class="form-control reg-company-input" id="req_full_name" placeholder="" value="" name="req_full_name" id="r_full_name" required>
						<label for="req_full_name"></label>
					  </div>
					  <div class="col-md-6 mb-3 form-group">
						<span>Position<font color="red">*</font></span>
						<input type="text" class="form-control reg-company-input" id="comp_cp_designation" placeholder="" value="" name="comp_cp_designation" required>
						<label for="comp_cp_designation"></label>
					  </div>
					</div>
				   
					<div class="mb-3 form-group">
					  <span>Phone No.<font color="red">*</font></span>
					  <div class="input-group">                    
						<input class="form-control reg-company-input" type="text" placeholder="+234-809-5558-0" name="cp_phone" id="cp_phone" required>
						<label for="comp_cp_phone"></label>
					  </div>
					</div>
					<hr class="my-4">
				</div>
				   <!--End Company -->
					
					<button class="btn btn-success btn-lg" type="submit">SUBMIT ENQUIRY</button>
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
		$("[name=cus_type]").on('change', function(event) {
		
		  var radioButton = $(event.currentTarget);
			  userChk(radioButton.val());
			  
		});
		userChk('<?php echo $getCompanyDetails[0]->cus_type ?>');
	});
	
function userChk(radioval){
	
	if(radioval == '1'){
		$('.register-1').show();
		$('.register-2').hide();
	  }else if(radioval == '2'){
		$('.register-2').show();
		$('.register-1').hide();
	  }
}	
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
	}	//tr_sttime tr_etime
	 //$(function () {
      //var startDate = $('#tr_sttime').val();
        //$("#tr_sttime").datetimepicker({
          //format: 'LT',
          //autoclose: true,
        //}).on('changeDate', function (selected) {
            //var startDate = new Date(selected.date.valueOf());
            //$('#tr_etime').datetimepicker('setStartDate', startDate);
        //}).on('clearDate', function (selected) {
            //$('#tr_etime').datetimepicker('setStartDate', null);
        //});

        //$("#tr_etime").datetimepicker({
           //format: 'LT',
           //autoclose: true,
           //startDate: startDate,
        //}).on('changeDate', function (selected) {
           //var endDate = new Date(selected.date.valueOf());
           //$('#tr_sttime').datetimepicker('setEndDate', endDate);
        //}).on('clearDate', function (selected) {
           //$('#tr_sttime').datetimepicker('setEndDate', null);
        //});
    //});

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

	
	//tr_stdate tr_enddate tr_sttime tr_etime
</script>
