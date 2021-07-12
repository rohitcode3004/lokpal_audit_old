      <!-- JQuery DataTable Css -->
      <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">



      <div class="app-content">
        <div class="main-content-app">
            <div class="page-header">
                <h4 class="page-title">MIS Reports</h4>
                <ol class="breadcrumb"> 
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>bench/dashboard_main">Dashboad</a></li> 
                    <li class="breadcrumb-item active" aria-current="page">MIS Reports</li> 
                </ol>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">List of Complaints Under Consideration with Lokpal of India
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>report/status_of_complaints_under_loi" class="previous">&laquo; Back</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Complaint No.</th>
                                                    <th>Date of Allocation/Submission of Preliminary inquiry/Investigation Report</th>
                                                    <th>No. of Hearing till Now</th>
                                                    <th>Date of next Hearing</th>
                                                    <th>Purpose of next hearing</th>
                                                    <!--<th>Remarks</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $c = 1;
                                                //print_r($list_data);
                                                foreach($list_data as $row):
                                                  ?>
                                                <tr>
                                                    <td><?php echo $c++.'.'; ?></td>
                                                    <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                                                    <td>
                                                    <?php
                                                        //echo $clisting_date = get_displaydate(get_clist_date($row->filing_no));
                                                        $allocation_date =  get_allocation_date($row->filing_no);
                                                        if($allocation_date != NULL)
                                                            echo date("d-m-Y", strtotime($allocation_date));
                                                        else
                                                            echo 'na';
                                                        if(isset($row->dt_submission)){
                                                            $submission_date = $row->dt_submission;
                                                            echo "/".date("d-m-Y", strtotime($submission_date));
                                                        }else{
                                                            echo "/"."na";
                                                        }
                                                     ?></td>
                                                    <!--<td><?php echo get_status_complaint(isset($row->ordertype_code) ? $row->ordertype_code : NULL, isset($row->cp_action) ? $row->cp_action : NULL, isset($row->ag_action) ? $row->ag_action : NULL, isset($row->listed) ? $row->listed : NULL, isset($row->case_status) ? $row->case_status : NULL, isset($row->scrutiny_status) ? $row->scrutiny_status : NULL); ?></td>-->
                                                    <td><?php 
                                                        echo isset($row->proceeding_count) ? $row->proceeding_count : 0;
                                                     ?></td>
                                                    <td><?php
                                                             $clisting_date = get_displaydate(get_clist_date($row->filing_no));
                                                             if($clisting_date != NULL)
                                                                echo $clisting_date;
                                                             else
                                                                echo 'na';
                                                     ?></td>
                                                 
                                                    <td><?php 
                                                            $cpurpose = get_cpurpose($row->filing_no);
                                                            if($cpurpose != NULL){
                                                                echo get_purpose_name($cpurpose);
                                                            }
                                                             else
                                                                echo 'na';
                                                     ?></td>
                                                    <!--<td><?php echo $row->remarks; ?></td>-->
                                                </tr>
                                                <?php endforeach;
                                                    if(count($list_data) == 0){ ?>
                                                      <tr><td colspan="8"> <h3>No data found. </h3></td></tr>
                                                   <?php }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Complaint No.</th>
                                                    <th>Date of Allocation/Submission of Preliminary inquiry/Investigation Report</th>
                                                    <th>No. of Hearing till Now</th>
                                                    <th>Date of next Hearing</th>
                                                    <th>Purpose of next hearing</th>
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
