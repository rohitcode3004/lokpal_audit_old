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
          <h4 class="page-title"> Report Received from External agency for the consideration of Bench</h4>
          <ol class="breadcrumb"> 
          <li class="breadcrumb-item"><a href="#">Dashoard</a></li>
          <li class="breadcrumb-item">Report Recieved from Agency</li>
          </ol>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <?php
                  if(isset($flag) == 'RI')
                    echo 'After Preliminary Inquiry';
                  elseif(isset($flag) == 'RV')
                    echo 'After Preliminary Investigation';
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
                        <th><!--<input type="checkbox" id="checkall" />-->S.No.</th>
                        <!--<th style="width: 15px;">Select</th>
                        <th>Date of hearing</th>-->
                        <th>Complaint no</th>
                        <th>Diary no.</th>
                        <th>Complainant name</th>
                        <th>Complaint against</th>
                        <!--<th>Bench Hearing date</th>-->
                        <!--<th>Bench nature</th>-->
                        <th>Preview</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $c = 1;
                      foreach($agency_data as $row):
                        $agency_count = getAgencyCount($row->filing_no);
                        ?>
                          <tr>
                            <td><?php echo $c++; ?></td>
                              <!--<td> <input type="checkbox" name="mycheck_hearing_date[]" id="mycheck_hearing_date<?php echo $row->id;?>"   value="<?php echo $row->id;?>"></td>
                             <td>                
                              <input type="text" class="hearing_date datepicker" name="hearing_date[]" id="hearing_date<?php echo $row->id;?>" value="<?php echo get_displaydate($row->listing_date); ?>"  placeholder="dd-mm-yyyy">
                                </td>-->
                            <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>

                            <td><?php if($row->filing_no){
                              echo $row->filing_no;
                              $against_name = get_against_name($row->filing_no);
                            } ?></td>

                            <?php $full_name_comp = $row->first_name." ".$row->mid_name." ".$row->sur_name; ?>
                            <td><?php if($full_name_comp){
                              echo $full_name_comp;
                            } ?></td>

                            <td>
                             <?php if($against_name){
                              echo $against_name;
                            } ?>
                          </td>

                          <!--<td>
                            <?php echo get_displaydate($row->listing_date); ?>
                          </td>-->
                          <!--<td>
                            <?php echo get_bench_nature($row->bench_nature); ?>
                          </td>-->
                          <td>
                            <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                          </td>
                          <td>
                            <input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>">
                            <input type="hidden" name="listing_date" value="<?php echo $row->listing_date; ?>">
                            <input type="hidden" name="bench_no" value="<?php echo $row->bench_no; ?>">
                            <input type="hidden" name="bench_id" value="<?php echo $row->bench_id; ?>">
                            <input type="hidden" name="recieved_from" value="A">
                            <button class="btn btn-primary" type="submit" value="<?php echo $row->filing_no."||".$row->listing_date."||".$row->bench_id."||".$bench_no."||".$flag_case."||"."A"; ?>" name="filing_no" form="myForm">Details</button>
                          </td>
                        </tr>
                        <?php endforeach;
                          if(count($agency_data) == 0){ ?>
                          <tr>
                            <td colspan="8">
                              <div class="alert alert-danger text-center">
                                <h3 class="m-0">No record available </h3>
                              </div>
                            </td>
                          </tr>
                          <?php }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><!--<input type="checkbox" id="checkall" />-->S.No.</th>
                        <!--<th style="width: 15px;">Select</th>
                        <th>Date of hearing</th>-->
                        <th>Complaint no</th>
                        <th>Diary no.</th>
                        <th>Complainant name</th>
                        <th>Complaint against</th>
                        <!--<th>Bench Hearing date</th>-->
                        <!--<th>Bench nature</th>-->
                        <th>Preview</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
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