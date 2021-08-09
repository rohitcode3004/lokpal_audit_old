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
                        <div class="panel-heading">List of Cases
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
                                           <th>S.No.</th>
                                                <th>Complaint No</th>
                                                 <th>Listing Date</th>
                                                <th>Name of the complainant</th>
                                                <th>Name of public servant</th>
                                                <th>Date of filing</th>
                                                 <th>Order</th>
                                                  <th>Report</th>
                                            
                                        </tr>
                                    </thead>
        <tbody>

                        <?php
                        //echo "<pre>";
                       //print_r($case_list);
            $c = 1;
            foreach($case_list as $row):
              ?>
            <tr>
                <td><?php echo $c++.'.'; ?></td>
                <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                 <td><b><?php echo get_displaydate($row->listing_date); ?></b></td>
                 <td>
                <?php
                    echo $row->first_name.' '.$row->mid_name.' '.$row->sur_name; ?></td>
               
                <td><?php                    
                      echo $row->ps_first_name.' '.$row->ps_mid_name.' '.$row->ps_sur_name; ?>
                 </td>
            <td><?php
                 echo get_displaydate($row->dt_of_filing); ?>

                </td>
                 
               <td><a href="<?php echo base_url();?>order_report/display_order_proc/<?php echo $row->filing_no ?>">Show order</a></td>
                 <td><a href="<?php echo base_url();?>order_report/display_report_agency/<?php echo $row->filing_no ?>">Show report</a></td>
            </tr>
             <?php endforeach;
            if(count($case_list) == 0){ ?>
              <tr><td colspan="8"> <h3>No data found. </h3></td></tr>
           <?php }
           ?>
        </tbody>
                                    <tfoot>
                                        <tr>
                                           <th>S.No.</th>
                                                <th>Complaint No</th>
                                                 <th>Listing Date</th>
                                                <th>Name of the complainant</th>
                                                <th>Name of public servant</th>
                                                <th>Date of filing</th>
                                                <th>Order</th>
                                                  <th>Report</th>
                                            
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
