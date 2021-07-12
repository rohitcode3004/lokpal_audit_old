	<?php
	//$elements = $this->label->view(1);
	//print("<pre>".print_r($chklst,true)."</pre>");die('dd');
	?>

<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {

         $("#gen_tr").hide();
         $("#cat_tr").hide();
   $(function(){
    $('input:radio').change(function(){
        if($(this).val() =="1") {           
            $("#gen_tr").show();
            $("#cat_tr").hide();
        }
        else {
            $("#cat_tr").show();
            $("#gen_tr").hide();
        } 
    	}); 
	});
	});
</script>


<script type="text/javascript">
 /*function pagecomplain(value)
  {
  var ps_id_selectedd = "<?= $psd; ?>";
  var post_url= '<?php echo base_url('user/getComplain')?>';
  var request_method= 'POST';
  //$("#ps_id").html('');  
  //alert(value + ':: '+ ps_id_selectedd);
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
      success: function(response){ //
         $("#ps_id").html(response); 
         $("#ps_id").val(ps_id_selectedd); 
        }
    });
  }*/
   

 function pageRefesh(value)
 	{     
 	var post_url= '<?php echo base_url('user/getComplain')?>';
  	var request_method= 'POST';
  	$.ajax({
        url : post_url,
        type: request_method,
        data : 'stateid='+value,
     success: function(response){ //
         $("#ps_id").html(response);  
         }           
      });   
  	}



 </script>

<script language="javascript"> 
			$().ready(function() {
	    // validate signup form on keyup and submit
	    $("#myForm").validate({

	    	onkeyup: false,

	    	rules: {  
	    		torole: "required",
	    		court_no:"required",   
	    		bench_nature: "required",
	    		newbench:"required",

	    		username: {
	    			required: true,
	    			minlength: 6,
	    			maxlength:12,     

	    		},

	    		messages: {
	    			torole: "Please select person to forward complaint",
	    			fname_err: "Please enter your firstname",
	        //lname_err: "Please enter your lastname",
		        username_err: {
		        	required: "Please enter a username",
		        	minlength: "Your username must consist of at least 6 characters",
		        	remote: "UserName Already Exist"
		        }
	    	}
		});
	    
	});
}
</script>

		<!-- Model popup -->
		<?php if(get_complaintno($filing_no) == 'n/a' ) { ?>
		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Scrutiny</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
					</div>
					<input type="hidden" id="fn" name="fn" value="<?php echo $filing_no ?>">
					<div class="modal-footer" style="text-align: left;">
						<button type="button" class="btn btn-danger submit-scrutiny">Submit scrutiny report<br> without complaint no.</button>
						<button type="button" class="btn btn-success submit-scrutiny-compno">Submit scrutiny report<br> and generate complaint no.</button>
					</div>
				</div>
			</div>
		</div>
		<?php } else { ?>
				<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Please click appropriate button to tell how you want to do scrutiny?
					</div>
					<input type="hidden" id="fn" name="fn" value="<?php echo $filing_no ?>">
					<div class="modal-footer" style="text-align: left;">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary submit-scrutiny">Submit scrutiny</button>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

<div class="app-content">
	<div class="main-content-app">
		<div class="page-header">
			<h4 class="page-title">Dashboard for Scrutiny</h4>
			<ol class="breadcrumb"> 
				<li class="breadcrumb-item"><a href="#">Dashboard for Scrutiny</a></li>
			</ol>
		</div>
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">
						Scrutiny for the Diary no. - <i><?php echo $filing_no; ?></i>
						<span class="pull-right">		
							<?php if(get_complaintno($filing_no) != 'n/a' ) { ?>
								Complaint no. - <i><?php echo get_complaintno($filing_no); ?></i>
							<?php } ?>
						</span>
					</div>
					<div class="panel-body">

			<!-- start: Accordion -->
			<form id="myForm" class="form-horizontal" action="<?php echo base_url();?>scrutiny/action" method="post" id="">
				<div class="panel-group" id="accordion">
					<?php if($comp_type == 1 || $comp_type == 2) {?>
						<div class="panel panel-primary">
						    <div class="panel-heading">
						      <h4 class="panel-title">
						        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
						        Part A</a>
						      </h4>
						    </div>
						    <div id="collapse1" class="panel-collapse collapse">
						      <div class="panel-body">
									<div class="accordion-inner">
										<table class="table table-bordered table-striped" id="my-table">
											<thead>
												<tr id="head_part">
													<th style="width: 5%;">
														Sl.No.
													</th>
													<th style="width: 30%;">
														Description
													</th>
													<th style="width: 15%;">
														Defect status
													</th>
													<th style="width: 20%;">
														Comments if any
													</th>
													<th style="width: 30%;">
														Information given by user
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sno = 1;
												foreach($chklst as $row): 
													if($row->subcode == 1 && $row->isheading == 't'){
														?>
														<tr id="body-part-a-<?php echo $row->serial_no; ?>">
															<td>
																<?php echo $row->serial_no."."; ?>
															</td>
															<td>
																<?php echo $row->description; ?>
															</td>
															<td>
																<select class="form-control" name="defects1[]">
																	<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																	<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																	<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																</select>
															</td>
															<td>
																<input class="form-control" type="text" name="comments1[]" value="<?php if(isset($row->comments)) echo $row->comments;  ?>">
															</td>
														</tr>

														<?php 
														foreach ($chklst as $subrow) {
															if($subrow->heading_code == $row->code && $subrow->isheading == 'f'){
																?>
																<tr class="warning" id="body_part">
																	<td>
																		<?php echo $subrow->serial_no."."; ?>
																	</td>
																	<td>
																		<?php echo $subrow->description; ?>
																	</td>
																	<td>
																		<select class="form-control" name="defects1[]">
																			<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																			<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																			<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																		</select>
																	</td>
																	<td>
																		<input class="form-control" type="text" name="comments1[]" value="<?php if(isset($subrow->comments)) echo $subrow->comments;  ?>">
																	</td>
																</tr>
																<input type="hidden" name="checklist_code1[]" value="<?php echo  $subrow->code; ?>">
																<?php
															}
														}
														?>
														<input type="hidden" name="checklist_code1[]" value="<?php echo  $row->code; ?>">
														<input type="hidden" name="comp_type" value="<?php echo  $comp_type; ?>">
														<input type="hidden" name="filing_no" value="<?php echo  $filing_no; ?>" id="filing_no">
														<?php 
													}
												endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<?php } 
						if($comp_type == 2) {
							?>
						<div class="panel panel-primary">
							<div class="panel-heading">
							    <h4 class="panel-title">
							        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
							        Part B</a>
							    </h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
							    <div class="panel-body">
									<div class="accordion-inner">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th style="width: 5%;">
														Sl.No.
													</th>
													<th style="width: 30%;">
														Description
													</th>
													<th style="width: 15%;">
														Defect status
													</th>
													<th style="width: 20%;">
														Comments if any
													</th>
													<th style="width: 30%;">
														Information given by user
													</th>
												</tr>
											</thead>
											<tbody>
													<?php
													$data_no = 1;
													foreach($chklst as $row): 
														if($row->subcode == 2 && $row->isheading == 't'){
															?>
															<tr id="body-part-b-<?php echo $data_no; ?>">
																<td>
																	<?php echo $row->serial_no."."; ?>
																</td>
																<td>
																	<?php echo $row->description; ?>
																</td>
																<td>
																	<select class="form-control" name="defects2[]">
																		<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																		<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																		<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																	</select>
																</td>
																<td>
																	<input class="form-control" type="text" name="comments2[]" value="<?php if(isset($row->comments))echo $row->comments;  ?>">
																</td>
																<input class="form-control" type="hidden" name="checklist_code2[]" value="<?php echo  $row->code; ?>">
															</tr>
															<?php 
															$data_no += 1;
															foreach ($chklst as $subrow) {
																if($subrow->heading_code == $row->code && $subrow->isheading == 'f'){
																	?>
																	<tr class="warning" id="body-part-b-<?php echo $data_no; ?>">
																		<td>
																			<?php echo $subrow->serial_no."."; ?>
																		</td>
																		<td>
																			<?php echo $subrow->description; ?>
																		</td>
																		<td>
																			<select class="form-control" name="defects2[]">
																				<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																				<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																				<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="comments2[]" value="<?php if(isset($subrow->comments)) echo $subrow->comments;  ?>">
																		</td>
																		<input class="form-control" type="hidden" name="checklist_code2[]" value="<?php echo  $subrow->code; ?>">
																	</tr>
																	<?php
																	$data_no += 1;
																}
															}
														}
													endforeach; ?>
											</tbody>
										</table>

									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if($comp_type == 1 || $comp_type == 2) {?>
								<div class="panel panel-primary">
								    <div class="panel-heading">
								      <h4 class="panel-title">
								        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								        Part C</a>
								      </h4>
								    </div>
								    <div id="collapse3" class="panel-collapse collapse">
								      <div class="panel-body">
											<div class="accordion-inner">
												<table class="table table-bordered table-striped">
													<thead>
														<tr>
															<th style="width: 5%;">
																Sl.No.
															</th>
															<th style="width: 30%;">
																Description
															</th>
															<th style="width: 15%;">
																Defect status
															</th>
															<th style="width: 20%;">
																Comments if any
															</th>
															<th style="width: 30%;">
																Information given by user
															</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$data_no = 1;
														foreach($chklst as $row): 
															if($row->subcode == 3 && $row->isheading == 't'){

																?>
																<tr id="body-part-c-<?php echo $data_no; ?>">
																	<td>
																		<?php echo $row->serial_no."."; ?>
																	</td>
																	<td>
																		<?php echo $row->description; ?>
																	</td>
																	<td>
																		<select class="form-control" name="defects1[]">
																			<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																			<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																			<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																		</select>
																	</td>
																	<td>
																		<input class="form-control" type="text" name="comments1[]" value="<?php if(isset($row->comments)) echo $row->comments;  ?>">
																	</td>
																</tr>

																<?php 
																$data_no+=1;
																foreach ($chklst as $subrow) {
																	if($subrow->heading_code == $row->code && $subrow->isheading == 'f'){
																		?>
																		<tr class="warning" id="body-part-c-<?php echo $data_no; ?>">
																			<td>
																				<?php echo $subrow->serial_no."."; ?>
																			</td>
																			<td>
																				<?php echo $subrow->description; ?>
																			</td>
																			<td>
																				<select class="form-control" name="defects1[]">
																					<option value="N" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'N') { echo 'selected'; } ?>>No</option>
																					<option value="Y" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'Y') { echo 'selected'; } ?>>Yes</option>
																					<option value="NA" <?php if(isset($row->defect_status)) if(trim($row->defect_status) == 'NA') { echo 'selected'; } ?>>N/A</option>
																				</select>
																			</td>
																			<td>
																				<input class="form-control" type="text" name="comments1[]" value="<?php if(isset($subrow->comments)) echo $subrow->comments;  ?>">
																			</td>
																		</tr>
																		<input class="form-control" type="hidden" name="checklist_code1[]" value="<?php echo  $subrow->code; ?>">
																		<?php
																		$data_no+=1;
																	}
																}
																?>
																<input class="form-control" type="hidden" name="checklist_code1[]" value="<?php echo  $row->code; ?>">
																<input class="form-control" type="hidden" name="comp_type" value="<?php echo  $comp_type; ?>">
																<input class="form-control" type="hidden" name="filing_no" value="<?php echo  $filing_no; ?>">
																<?php

															}

														endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
						<?php } ?>
				</div>
				<!--end: Accordion -->
				<div class="panel panel-primary">
					<div class="panel-heading">Correct Gender/Category. -</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 mb-30">                              
	                            <div class="radio">
	                                <label>
	                                	<input type="radio" name="display_tr" id="Active" value="1"> Gender Correction
	                                </label>
	                                <label>
	                                    <input type="radio" name="display_tr" id="Inactive" value="2">Category Correction
	                                </label>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row" id="gen_tr">
							<div class="col-md-12"> 
                        	<div class="form-group">
								<label class="control-label col-sm-2" for="gender_id">Gender</label>
								<div class="col-sm-3">
									<select type="text" class="form-control" name="gender_id" id="gender_id">
										<option value="">-- Select --</option>
										<?php foreach($gender as $row):?>  
										<option value="<?php echo $row->gender_id;?>"> <?php echo $row->gender_desc; ?>
										</option>       
										<?php endforeach;?>
									</select>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-success status_submit"> Update Gender</button>
								</div>
                            </div>
                        	</div>
                        </div>

                        <div class="row" style="display: none;" id="cat_tr">
                        	<div class="col-md-12 form-horizontal"> 
                        	<div class="form-group">
                        		<label class="control-label col-sm-2" for="complaint_capacity_id">Category</label>
                        		<div class="col-sm-3">
	                        		<select type="text" class="form-control" name="complaint_capacity_id" id="complaint_capacity_id" onChange="pageRefesh(this.value);">
	                        			<option value="">-- Select --</option>
	                        			<?php foreach($complainant_type as $crow):?>
	                        			<option value="<?php echo $crow->complaint_capacity_id;?>"> 
	                        				<?php echo $crow->complaint_capacity_desc; ?>
	                        			</option>       
	                        			<?php endforeach;?>
	                        		</select>
                        		</div>

                        		<label class="control-label col-sm-2" for="ps_id">Sub Category</label>
                        		<div class="col-sm-3">
                        			<select type="text" class="form-control" name="ps_id" id="ps_id"> </select>
                        		</div>
                        		<div class="col-sm-2">
                        			<button type="button" class="btn btn-success category_submit"> Update category </button>
                        		</div>
                        	</div>
                        		
                        	</div>
                        </div>

					</div>
				</div>
				<hr>

				<div class="form-group">
					<label class="control-label col-sm-2" title="Brief summary of the case">Summary: </label>
					<div class="col-sm-10">
					<textarea rows="3" class="form-control" name= "summary" placeholder="Write your summary here">
						<?php echo (isset($summary)) ?  $summary : '';  ?>
					</textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" title="remarks">Your remarks:</label>
					<div class="col-sm-10">
						<textarea rows="3" class="form-control" name= "remarks" placeholder="Write your remarks here"></textarea>
					</div>
				</div>

				<?php if(isset($last_remarkedby)) {?>
				<div class="form-group mb-15">
					<label>Last send by : <?php echo (isset($last_remarkedby)) ? $last_remarkedby : ''; ?> on <?php echo (isset($last_date)) ? $last_date : ''; ?> at <?php echo (isset($last_time)) ? $last_time : ''; ?></label>
				</div>
				<?php } ?>


				<div class="form-group" id="" style="">   
					<label for="torole" class="control-label col-sm-2" title="select officer to forward case to"><span style="color: red" data-darkreader-inline-color="">*</span>Forward to:</label>
					<div class="col-sm-10"> 
					<select class="torole form-control" style="" name="torole" id="torole" aria-invalid="false">
						<option value="">-- Select one --</option>
						<?php
							foreach($toroles as $row):
						?>
						<option value="<?php echo $row->level_id ?>"><?php echo $row->display_name ?></option>
						<?php endforeach;
						?>
					</select> 
					<label class="error"></label>
					</div>
				</div>
				<div class="form-group" id="" style="">  
					<div class="col-sm-12 text-right">  
						<button class="btn btn-danger" type="button" value="Submit" data-toggle="modal" data-target="#exampleModalCenter">Submit scrutiny</button>
					</div>
				</div>
			</form>



					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			<script type="text/javascript">
				$(document).ready(function(){

					function fetch_data(){

						var filing_no = document.getElementById("filing_no").value;
	       		//alert(filing_no);

	       		$.ajax({
	       			url:"<?php echo base_url(); ?>scrutiny/api_action",
	       			method: "POST",
	       			data: {filing_no:filing_no, data_action:'fetch_single'},
	       			dataType: "json",
	       			success: function(data){
	       				console.log(data.A)
	       				var row = document.getElementById("body-part-a-1");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.one;

	       				var row = document.getElementById("body-part-a-2");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.two;

	       				var row = document.getElementById("body-part-a-3");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.three;

	       				var row = document.getElementById("body-part-a-4");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.four;

	       				var row = document.getElementById("body-part-a-5");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.five;

	       				var row = document.getElementById("body-part-a-6");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = "Identity details: "+data.A.six.identity.type+", "+data.A.six.identity.no+", "+data.A.six.identity.from+", "+data.A.six.identity.upto+", "+data.A.six.identity.auth+'<a href="<?php echo base_url();?>'+data.A.six.identity.upd_path+'" target="_blank" alt="">show uploded document </a>'+"<br>Residence details: "+data.A.six.residence.type+", "+data.A.six.residence.no+", "+data.A.six.residence.from+", "+data.A.six.residence.upto+", "+data.A.six.residence.auth+'<a href="<?php echo base_url();?>'+data.A.six.residence.upd_path+'" target="_blank" alt="">show uploded document </a>';

	       				var row = document.getElementById("body-part-a-7");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.seven.house+", "+data.A.seven.city+", "+data.A.seven.district+", "+data.A.seven.state+", "+data.A.seven.pin+", "+data.A.seven.country;

	       				var row = document.getElementById("body-part-a-8");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.eight.house+", "+data.A.eight.city+", "+data.A.eight.district+", "+data.A.eight.state+", "+data.A.eight.pin+", "+data.A.eight.country;

	       				var row = document.getElementById("body-part-a-9");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.nine;

	       				var row = document.getElementById("body-part-a-10");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.ten;

	       				var row = document.getElementById("body-part-a-11");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.eleven;

	       				var row = document.getElementById("body-part-a-12");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.twelve;

	       				var row = document.getElementById("body-part-a-13");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.thirteen;

	       				var row = document.getElementById("body-part-a-14");
	       				var x = row.insertCell(-1);
	       				x.innerHTML = data.A.fourteen;

	  			//start of part c details

	  			var row = document.getElementById("body-part-c-1");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.one;

	  			var row = document.getElementById("body-part-c-2");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.two;

	  			var row = document.getElementById("body-part-c-3");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.three;

	  			var row = document.getElementById("body-part-c-4");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.four;

	  			var row = document.getElementById("body-part-c-5");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = '';

	  			var row = document.getElementById("body-part-c-6");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.five.category;

	  			var row = document.getElementById("body-part-c-7");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.five.other;

	  			var row = document.getElementById("body-part-c-8");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = '';

	  			var row = document.getElementById("body-part-c-9");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.six.fin_by_gov;

	  			var row = document.getElementById("body-part-c-10");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.six.ann_inc;

	  			var row = document.getElementById("body-part-c-11");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.six.foreign_source;

	  			var row = document.getElementById("body-part-c-12");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.seven;

	  			var row = document.getElementById("body-part-c-13");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.eight;

	  			var row = document.getElementById("body-part-c-14");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = '';

	  			var row = document.getElementById("body-part-c-15");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.nine.period;

	  			var row = document.getElementById("body-part-c-16");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.nine.pl_of_occ;

	  			var row = document.getElementById("body-part-c-17");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.nine.district;

	  			var row = document.getElementById("body-part-c-18");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.nine.state;

	  			/*var row = document.getElementById("body-part-c-19");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = "Summary: "+data.C.ten.summary+'<a href="<?php echo base_url();?>'+data.C.ten.sum_fact_allegation_upload+'.pdf" target="_blank" alt="">show uploaded document </a>'+"<br>Details: "+data.C.ten.det_of_offences_act+'<a href="<?php echo base_url();?>'+data.C.ten.detail_offence_upload+'.pdf" target="_blank" alt="">show uploaded document </a>'+"<br>Violated: "+data.C.ten.prov_violated;*/

	  			var row = document.getElementById("body-part-c-19");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = "Summary: "+data.C.ten.summary+"<br>Details: "+data.C.ten.det_of_offences_act+"<br>Violated: "+data.C.ten.prov_violated;

	  			/*var row = document.getElementById("body-part-c-20");
	  			var x = row.insertCell(-1);
	  			x.innerHTML ='<a href="<?php echo base_url();?>scrutiny/witnesses_details/'+filing_no+'" target="_blank" alt="">show uploaded document </a>';*/

	  			var row = document.getElementById("body-part-c-20");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.eleven;

	  			var row = document.getElementById("body-part-c-21");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.twelve.relied_docs; if(data.C.twelve.upd_path != '')+'<a href="<?php echo base_url();?>'+data.C.twelve.upd_path+'" target="_blank" alt="">show uploaded document </a>';

	  			var row = document.getElementById("body-part-c-22");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.thirteen;

	  			var row = document.getElementById("body-part-c-23");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.fourteen;

	  			var row = document.getElementById("body-part-c-24");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.C.fifteen;

	  			var row = document.getElementById("body-part-c-25");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = '<a href="<?php echo base_url();?>'+data.C.sixteen+'" target="_blank" alt="">show uploded document </a>';

	  			//start of part b details

	  			var row = document.getElementById("body-part-b-1");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = '';

	  			var row = document.getElementById("body-part-b-2");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.reffered;

	  			var row = document.getElementById("body-part-b-3");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.certificate;

	  			var row = document.getElementById("body-part-b-4");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.competent_auth_name;

	  			var row = document.getElementById("body-part-b-5");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.address_corres;

	  			var row = document.getElementById("body-part-b-6");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.tel_mob;

	  			var row = document.getElementById("body-part-b-7");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.one.e_mail;

	  			var row = document.getElementById("body-part-b-8");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.two;

	  			var row = document.getElementById("body-part-b-9");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.three;

	  			var row = document.getElementById("body-part-b-10");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.four;

	  			var row = document.getElementById("body-part-b-11");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.five;

	  			var row = document.getElementById("body-part-b-12");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.six;

	  			var row = document.getElementById("body-part-b-13");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.seven;

	  			var row = document.getElementById("body-part-b-14");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = "Identity details: "+data.B.eight.identity.type+", "+data.B.eight.identity.no+", "+data.B.eight.identity.from+", "+data.B.eight.identity.upto+", "+data.B.eight.identity.auth+'<a href="<?php echo base_url();?>'+data.B.eight.identity.upd_path+'" target="_blank" alt="">show uploded document </a>'+"<br>Residence details: "+data.B.eight.residence.type+", "+data.B.eight.residence.no+", "+data.B.eight.residence.from+", "+data.B.eight.residence.upto+", "+data.B.eight.residence.auth+'<a href="<?php echo base_url();?>'+data.B.eight.residence.upd_path+'" target="_blank" alt="">show uploded document </a>';

	  			var row = document.getElementById("body-part-b-15");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.nine.house+", "+data.B.nine.city+", "+data.B.nine.district+", "+data.B.nine.state+", "+data.B.nine.pin+", "+data.B.nine.country;

	  			var row = document.getElementById("body-part-b-16");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.ten.house+", "+data.B.ten.city+", "+data.B.ten.district+", "+data.B.ten.state+", "+data.B.ten.pin+", "+data.B.ten.country;

	  			var row = document.getElementById("body-part-b-17");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.eleven;

	  			var row = document.getElementById("body-part-b-18");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.twelve;

	  			var row = document.getElementById("body-part-b-19");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.thirteen;

	  			var row = document.getElementById("body-part-b-20");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.fourteen.auth_doc; if(data.B.fourteen.upd_path != '')+'<a href="<?php echo base_url();?>'+data.B.fourteen.upd_path+'" target="_blank" alt="">show uploded document </a>';

	  			var row = document.getElementById("body-part-b-21");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.fifteen;

	  			var row = document.getElementById("body-part-b-22");
	  			var x = row.insertCell(-1);
	  			x.innerHTML = data.B.sixteen;

	  		}
	  	});
}
fetch_data();
});


	$(document).on('click', '.submit-scrutiny-compno', function(event){
	        	//alert('here');

	        	var filing_no = document.getElementById("fn").value;
	        	//alert('y');
	        	$.ajax({
	        		url: '<?php echo site_url('scrutiny/action'); ?>',
	        		type: 'POST',
	        		data:$("#myForm").serialize()+"&par1=1",
	        		dataType: 'json',
	        		//async: false,
	        		success: function(data) {
	        			console.log(data);
	        			window.location.href= "<?php echo site_url('scrutiny/dashboard'); ?>";
	        			
	      }
	  });
	        });

	$(document).on('click', '.submit-scrutiny', function(event){
	        	//alert('here');
	        	$("#myForm").submit();

	        });
	    </script>


         <script type="text/javascript">
            $(document).ready(function() {
            $(document).on('click', '.status_submit', function(){
            var gender_id = document.getElementById("gender_id").value;
            var filing_no = "<?= $filing_no; ?>"; 
          $.ajax({
            url: '<?php echo site_url('scrutiny/updategender'); ?>',
            type: 'POST',          
           data: {gender_id: gender_id, filing_no: filing_no},
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.success == 'success'){
                   alert('Gender updated Successfully');
                   //window.location.reload(); 
                }else{
                  alert('Error');
                }                       
            }
          });   
            });
        });
</script>



 <script type="text/javascript">
            $(document).ready(function() {
            $(document).on('click', '.category_submit', function(){
            var complaint_capacity_id = document.getElementById("complaint_capacity_id").value;
            var ps_id = document.getElementById("ps_id").value;
            var filing_no = "<?= $filing_no; ?>";                
          $.ajax({
            url: '<?php echo site_url('scrutiny/updatecategory'); ?>',
            type: 'POST',          
           data: {complaint_capacity_id: complaint_capacity_id, ps_id: ps_id,filing_no:filing_no},
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.success == 'success'){
                   alert('Category updated Successfully');
                  // window.location.reload(); 
                }else{
                  alert('Error');
                }                       
            }
          });   
            });
        });

</script>




