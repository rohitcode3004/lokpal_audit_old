<?php //echo $flag;die('kk');  ?>

  <!-- JQuery DataTable Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<style type="text/css">
.alert-error{
  color: #e91e63;
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
  left: inherit!important;
  opacity: 1!important;
}
</style>

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <div class="app-content">
      <div class="main-content-app">
        <div class="page-header">
          <h4 class="page-title">Complaints for Hearing</h4>
          <ol class="breadcrumb"> 
          <li class="breadcrumb-item"><a href="#">Dashoard</a></li>
          <li class="breadcrumb-item">Complaints for Hearing</li>
          </ol>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <?php
                  if(isset($flag) == 'F')
                    echo 'Fresh Complaints';
                  elseif(isset($flag) == 'I')
                    echo 'Complaints in which Preliminary Inquiry has been Recieved';
                  elseif(isset($flag) == 'V')
                    echo 'Complaints in which Preliminary Investigation has been Recieved';
                  else
                    echo 'List of complaints';
                ?>

                <ul class="more-action">
                  <li><a href="<?php echo base_url(); ?>proceeding/dashboard_main_level2/0" class="previous">&laquo; Back</a></li>
                </ul>
                
              </div>
              <div class="panel-body">

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


      <form action="<?php echo base_url();?>proceeding/proceeding_form" method="post" id="myForm">  </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
            <tr>
             <th style="width: 10px;"><!--<input type="checkbox" id="checkall" />-->S.No.</th>
             <th style="width: 15px;">Select</th>
             <th>Date of hearing</th>
             <th style="width: 150px;">Purpose</th>
             <th style="width: 150px;">Venue</th>
             <th style="width: 60px;">Complaint no.</th>
             <th style="width: 60px;">Diary no.</th>
             <th style="width: 150px;">Department of public servant</th>
             <th style="width: 130px;">Designation of public servant</th>
             <!--<th>D.o.Filing</th>-->
             <th style="width: 60px;">Date of Allocation</th>
             <!--<th style="width: 80px;">Preview</th>-->
             <th style="width: 100px;">Action</th>
            </tr>
          </thead>
          <tbody>
              <?php

               // echo "<pre>";

             //  print_r($allocated_data);die;

                $c = 1;
                foreach($allocated_data as $row):
                  if($user['id'] != 1308){
                  $bench_id = $row->bench_id;
                  //echo $row->bench_id;die();
                  $judge_code_array = get_judge_code($bench_id);
                  //print_r($judge_code_array);die;
                  $flag = 0;
                  for($i=0; $i<count($judge_code_array); $i++){
                    if($judge_code_array[$i]['judge_code'] == $logged_judge_code)
                      $flag = 1;
                  }
                }else{
                  $flag = 1;
                }

                  if($flag == 1){
                  $agency_count = getAgencyCount($row->filing_no);
                  ?>
              
                <tr <?php if($agency_count == 1) { ?> class="onece" <?php } elseif($agency_count == 2) { ?> class="secylce" <?php } ?>>
                  <td><?php echo $c++.'.'; ?></td>
                  <td><input type="checkbox" name="mycheck_hearing_date[]" id="mycheck_hearing_date<?php echo $row->id;?>" value="<?php echo $row->id;?>"></td>
                  <td><b><?php echo get_displaydate($row->listing_date); ?></b></td>
                  <td><b><?php echo get_purpose_name($row->purpose); ?></b></td>
                  <td><b><?php echo get_venue_name($row->venue); ?></b></td>
                  <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                  <td><?php if($row->filing_no){
                    echo $row->filing_no;
                    //$against_name = get_against_name($row->filing_no);
                  } ?></td>

                  <?php //$full_name_comp = $row->first_name." ".$row->mid_name." ".$row->sur_name; ?>
                  <td> <?php if($row->ps_orgn){
                    echo $row->ps_orgn;
                  } ?>
                  </td>

                  <td>
                   <?php if($row->ps_desig){
                    echo $row->ps_desig;
                  } ?>
                </td>

                <!--<td>
                  <?php echo get_displaydate($row->dt_of_filing); ?>
                </td>-->
                <td>
                  <?php echo date('d-m-Y', strtotime($row->created_at)); ?>
                </td>
                <!--<td>
                  <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                </td>-->
                <td>
                  <!--<input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>" form="myForm">-->
                  <button class="btn btn-primary" type="submit" value="<?php echo $row->filing_no."||".$row->listing_date."||".$row->bench_id."||".$bench_no."||".$flag_case."||".""; ?>" name="filing_no" form="myForm">Bench Hearing</button>
                </td>
              </tr>
          
            <?php } endforeach;
              if(count($allocated_data) == 0){ ?>
                <tr>
                  <td colspan="11">
                    <div class="alert alert-danger text-center">
                      <h3 class="m-0">No record available. </h3>
                    </div>
                  </td>
                </tr>
             <?php }
             ?>
          </tbody>
          <tfoot>
            <tr>
             <th style="width: 10px;"><!--<input type="checkbox" id="checkall" />-->S.No.</th>
             <th style="width: 15px;">Select</th>
             <th>Date of hearing</th>
             <th style="width: 150px;">Purpose</th>
             <th style="width: 150px;">Venue</th>
             <th style="width: 60px;">Complaint no.</th>
             <th style="width: 60px;">Diary no.</th>
             <th style="width: 150px;">Department of public servant</th>
             <th style="width: 130px;">Designation of public servant</th>
             <!--<th>D.o.Filing</th>-->
             <th style="width: 60px;">Date of Allocation</th>
             <!--<th style="width: 80px;">Preview</th>-->
             <th style="width: 100px;">Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="row mt-30">

          <div class="col-md-12">
            <h4 class="section-title">Next Hearing</h4>  
          </div>
        <div class="col-md-3">
          <label for="purpose">Select purpose</label>    
            <select type="text" class="form-control" class="chosen-single chosen-default" name="purpose" id="purpose" onchange="javascript:other_purpose();">
              <option value="">-- Select purpose --</option>
              <?php foreach($purpose_type as $purpose):?>              
                <option value="<?php echo $purpose->id;?>"> <?php echo $purpose->name; ?> </option>
              <?php endforeach;?>
            </select> 
          <label class="error"><?php echo form_error('purpose'); ?></label>
        </div>
        <div class="col-md-3">
           <label for="venue" >Select venue</label>    
            <select type="text" class="form-control" class="chosen-single chosen-default" name="venue" id="venue" onchange="">
              <option value="">-- Select venue --</option>
              <?php foreach($venues as $venue):?>              
              <option value="<?php echo $venue->id;?>"> <?php echo $venue->name; ?> </option>
                <?php endforeach;?>
            </select> 
          <label class="error"><?php echo form_error('venue'); ?></label>
        </div>
        <div class="col-md-3">
           <label for="venue" >Select next hearing date</label> 
           <input type="text" class="hearing_date datepicker form-control" name="hearing_date" id="hearing_date" value=""  placeholder="dd-mm-yyyy">
        </div>
        <div class="col-md-3">
          <label for="venue" >Click to update</label> 
          <button type="button" class="btn btn-success final_submit form-control">
               Update
          </button> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-3" id="otherpurdiv" style="display: none;">
           <label for="other_purpose_name"><span style="color: red;">*</span>Type of purpose</label>
          <input type="text" class="form-control" name="other_purpose_name" id="other_purpose_name">
        </div>
      </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/admin_material/js/admin.js"></script>
    <script src="<?php echo base_url();?>assets/admin_material/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url();?>assets/admin_material/js/demo.js"></script>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
      $().ready(function() {
      $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
       // startDate: '-0d',
        autoclose: true,
        todayHighlight: true  
        }); 

        $(document).on('click', '.final_submit', function(){
          //alert('jjj');
          var venue_code = $('select[name=venue] option').filter(':selected').val();

          var purpose_code = $('select[name=purpose] option').filter(':selected').val();
          let otherpur = document.getElementById('other_purpose_name').value;

          let hearing_date = document.getElementById('hearing_date').value;

          var allids = [];
            $.each($("input[name='mycheck_hearing_date[]']:checked"), function(){
              allids.push($(this).val());
            });
            var myJSON = JSON.stringify(allids);
            console.log(myJSON);

            if(allids && allids.length && venue_code) {    
              $.ajax({
                url: '<?php echo site_url('proceeding/update_hearing_details'); ?>',
                type: 'POST',
                data : {allids:myJSON, venue_code:venue_code, purpose_code:purpose_code, other_purpose_name:otherpur, hearing_date:hearing_date},
                dataType: 'json',
              success: function(data) {
                console.log(data);
                if(data.success == 'success'){
                   alert('Details Successfully Updated!');
                   window.location.reload(); 
                }else{
                  alert('Error');
                }       
              }
              });
        }else{
          alert('Please select all options!');
        }
        });  
    });

      function other_purpose(){
        //alert('here');
        otherpurdiv.style.display="none";
        let purpose_code = $('#purpose').children("option:selected").val();
        if(purpose_code == 5){
          otherpurdiv.style.display="";
        }
      } 
    </script>
