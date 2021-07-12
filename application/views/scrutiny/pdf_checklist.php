<?php
//$elements = $this->label->view(1);
//print("<pre>".print_r($chklst,true)."</pre>");die('dd');
//print_r($user['role']);
?>

	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>



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


</script>


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
						Scrutiny for the Complaint Diary no. - <i><?php echo $filing_no; ?></i>
						<span class="pull-right">		
							<?php if(get_complaintno($filing_no) != 'n/a' ) { ?>
								Complaint no. - <i><?php echo get_complaintno($filing_no); ?></i>
							<?php } ?>
						</span>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<iframe src="<?php echo base_url();?>cdn/scrutiny_df/<?php echo $filing_no; ?>.pdf" width="100%" height="600"></iframe>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
			<form id="myForm" class="form-horizontal" action="<?php echo base_url();?>scrutiny/action" method="post" id="">

						<div class="form-group">
							<!--<label><font color="#e70000;">Last summarised by : <?php echo (isset($last_remarkedby)) ? $last_remarkedby : ''; ?> on <?php echo (isset($last_date)) ? $last_date : ''; ?> at <?php echo (isset($last_time)) ? $last_time : ''; ?></font></label>-->
							<label class="control-label col-sm-4" title="Brief summary of the case">Summary of Complaint: </label>
							<div class="col-sm-8">
								<textarea class="form-control editable" rows="3" name="summary" placeholder="Write your summary here"><?php echo (isset($summary)) ?  $summary : '';  ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4" title="remarks"><font>Remarks: </font></label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="3" name= "remarks" placeholder="Write your remarks here"></textarea>
							</div>
						</div>



						<?php if(isset($last_remarks)) { ?>
						<div class="form-group">
							<label class="control-label col-sm-4 text-danger">Last send by : <?php echo (isset($last_remarkedby)) ? $last_remarkedby : ''; ?> on <?php echo (isset($last_date)) ? $last_date : ''; ?> at <?php echo (isset($last_time)) ? $last_time : ''; ?></label>
							<div class="col-sm-8">
								<textarea class="form-control disable" rows="3" name= "remarks_latest" placeholder="No remarks given" readonly><?php echo (isset($last_remarks)) ?  $last_remarks : '';  ?></textarea>
							</div>
						</div>

						<?php } if(isset($remark_history)) { ?>
						<?php foreach($remark_history as $row):
							if($row->remarks != '') {
						 ?>
						<div class="form-group">
							<label class="control-label col-sm-4">Previously remarks by : <?php echo get_remarkedby_name($row->remarkd_by); ?> on <?php echo get_remarkedby_his_datetime($row->updated_date, 'D'); ?> at <?php echo get_remarkedby_his_datetime($row->updated_date, 'T'); ?></label>
							<div class="col-sm-8">
								<textarea class="form-control disable" rows="3" name= "remarks_history" placeholder="No remarks given" readonly><?php echo $row->remarks;  ?></textarea>
							</div>
						</div>
						<?php
							}
						 endforeach;
						} 
						?>
						<br>
						<?php if($user['role'] == 147) { ?>
						<div class="form-group" id="" style="">  
						    <label class="control-label col-sm-2" for="doc_upload">Upload document if any</label>
						    <div class="col-sm-10">
						    <input type="file" class="form-control order_upload" name="doc_upload" id="doc_upload">
							</div>
						</div>
						<?php  } ?>

						<div class="form-group" id="" style="">   
					      	<label class="control-label col-sm-4" for="torole"><span style="color: red" data-darkreader-inline-color="">*</span>Forward to</label>
					      	<div class="col-sm-8">   
						      <select class="torole form-control" style="" name="torole" id="torole" aria-invalid="false"><option value="">-- Select one --</option>
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

 						<input type="hidden" name="filing_no" value="<?php echo  $filing_no; ?>">

						<!--<div class="form-group">
							<div class="col-sm-12">
								<input id="chbox" type="checkbox"> Check me out </label>
							</div>
						</div>-->

						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-danger" type="submit" value="Submit">Submit</button>
							</div>
						</div>
			</form>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

		<script type="text/javascript">
			$(function ()
			{
				$("#myForm").on('submit', function (e)
				{
					if (document.getElementById("chbox").checked)
					{
						let frd_value = $('#torole').children("option:selected").val();
						var r = true;
						if(frd_value == 4){
								$("#myForm").submit();
						}else{
							$("#myForm").submit();
						}
					}
					else
					{
						e.preventDefault();
						alert('Please check the box before submitting the form');
					}
				});
			});
		</script>




