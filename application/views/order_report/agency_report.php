      <!-- JQuery DataTable Css -->
      <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <div class="app-content">
        <div class="main-content-app">
            <div class="page-header">
                <h4 class="page-title">MIS Reports</h4>
                <ol class="breadcrumb"> 
                    <li class="breadcrumb-item"><a href="#">Dashboad</a></li> 
                    <li class="breadcrumb-item active" aria-current="page">MIS Reports</li> 
                </ol>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Agency Report
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>order_report/list_of_case" class="previous">&laquo; Back</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                           <!--<th>S.No.</th>-->
                                                <th> Date of Submission</th>
                                                <th>Agency</th>
                                                <th>Submitted By </th>
                                                <th>Contact Number  </th>   
                                                <th>Email Id </th>
                                                <th>Show Agency Report</th>
                                                                                       
                                            
                                        </tr>
                                    </thead>
        <tbody>

                        <?php
                       // echo "<pre>";
                       //print_r($agencydata);die;
            $c = 1;
            foreach($agencydata as $row):
              ?>
           <tr>
                                         <!-- <td><?php echo $sno++.'.'; ?></td>-->
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded</a></td>
                                        </tr>
             <?php endforeach;
            if(count($agencydata) == 0){ ?>
              <tr></tr>
           <?php }
           ?>



          <?php  if($agencydatahis != 0){
                                                  $c = 1;
                                          foreach($agencydatahis as $row):
                                      ?>
                                              <tr>
                                          <!--<td><?php echo $c++.'.'; ?></td>-->
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded </a></td>
                                        </tr>
                                        <?php endforeach; 
                                      }
                                        ?>



                                        <?php 
                                         if($anyotheractiondata != 0){
                                                  $c = 1;
                                          foreach($anyotheractiondata as $row):
                                      ?>
                                              <tr>
                                          <!--<td><?php echo $c++.'.'; ?></td>-->
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_order_type($row->ordertype_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded </a></td>
                                        </tr>
                                        <?php endforeach; 
                                      }
                                        ?>


                                         <?php 

                                         //echo "<pre>";
                                         //print_r($anyotheractiondata_report);
                                         if($anyotheractiondata_report != 0){
                                                  $c = 1;
                                          foreach($anyotheractiondata_report as $row):
                                      ?>
                                              <tr>
                                          <!--<td><?php echo $c++.'.'; ?></td>-->
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_order_type($row->ordertype_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded </a></td>
                                        </tr>
                                        <?php endforeach; 
                                      }
                                        ?>





        </tbody>
                                    <tfoot>
                                        <tr>
                                          <!-- <th>S.No.</th>-->
                                                <th> Date of Submission</th>
                                                <th>Agency</th>
                                                <th>Submitted By </th>
                                                <th>Contact Number  </th>   
                                                <th>Email Id </th>
                                                <th>Preview report</th>
                                            
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
        </div>
    </div>

  <!-- =================== Complaints for Allocation to benches =============== -->
    <!-- Select Plugin Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/bootstrap-select/js/bootstrap-select.js"></script>

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
