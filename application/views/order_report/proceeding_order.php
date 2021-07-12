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
                        <div class="panel-heading">Proceeding Order
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
                                                <th>Order Date</th>
                                                <th>Order type</th>
                                                <th>Agency</th>
                                                <th>Order Preview</th>                                                
                                            
                                        </tr>
                                    </thead>
        <tbody>

                        <?php
                      //  echo "<pre>";
                       //print_r($last_proceeding);die;
            $c = 1;
            foreach($last_proceeding as $row):
              ?>
            <tr>
               <!-- <td><?php echo $c++.'.'; ?></td>-->
                <td><?php
                 echo get_displaydate($row->order_date); ?></td>               
                <td><?php echo get_order_type($row->ordertype_code); ?></td>                 
                 <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview uploaded report</a></td>      
                 
               
            </tr>
             <?php endforeach;
            if(count($last_proceeding) == 0){ ?>
              <tr><td colspan="8"> <h3>No data found. </h3></td></tr>
           <?php }
           ?>
          <?php  if($proceeding_his != 0){
                                                  $c = 1;
                                          foreach($proceeding_his as $row):
                                      ?>
                                              <tr>
                                          <!--<td><?php echo $c++.'.'; ?></td>-->
                                          <td><?php echo get_displaydate($row->order_date); ?></td>
                                          <td><?php echo get_order_type($row->ordertype_code); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt="">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview uploaded report</a></td>
                                        </tr>
                                        <?php endforeach; 
                                      }
                                        ?>
        </tbody>
                                    <tfoot>
                                        <tr>
                                          <!-- <th>S.No.</th>-->
                                                 <th>Order Date</th>
                                                <th>Order type</th>
                                                <th>Agency</th>
                                                <th>Order Preview</th>  
                                            
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
