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
                        <div class="panel-heading">List of Categories Complaints
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>report/category_of_complaints" class="previous">&laquo; Back</a></li>
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
                                            <th>Date of Allocation to the Bench</th>
                                            <th>Status of Complaints</th>
                                            <th>Bench/Agency/Authority/With whom Pending</th>
                                            <th>Due date for submission of Preliminary Inquiry or Investigation Report</th>
                                            
                                        </tr>
                                    </thead>
        <tbody>

                        <?php
                       // echo "<pre>";
                      //  print_r($list_data_cat);
            $c = 1;
            foreach($list_data_cat as $row):
              ?>
            <tr>
                <td><?php echo $c++.'.'; ?></td>
                <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                 <td>
                <?php
                    $allocation_date =  get_allocation_date($row->filing_no);
                    if($allocation_date != NULL)
                        echo date("d-m-Y", strtotime($allocation_date));
                    else
                        echo "n/a";
                 ?></td>
               
                <td><?php 
                    $matrix = create_stage_matrix($row->filing_no);//68/2020
                    echo $result = get_case_status_fed_matrix($matrix);
                 ?></td>
            <td><?php
                if($matrix[0][2] == 'P' || $matrix[0][5] == 'P'){
                    //echo $row->bench_id;
                    //echo $row->filing_no;
                 echo get_with_which_bench_pending(isset($row->bench_id) ? $row->bench_id : NULL, $row->filing_no); 
             }elseif($matrix[0][1] == 'P')
             {
                echo 'At Chairperson Level';
             }elseif($matrix[0][3] == 'P')
             {
                echo get_with_which_agency_pending(isset($row->ordertype_code) ? $row->ordertype_code : NULL, isset($row->agency_code) ? $row->agency_code : NULL);
             }else{
                echo 'n/a';
             }

                 ?></td>


                 <td><?php 

                        
                    if($row->cp_action=='t')
                    {
                   echo 'n/a';
                    }
                    else
                    {
                       echo isset($row->due_date) ? get_displaydate($row->due_date) : 'n/a';
                    }


                 ?></td>
                <!--<td><?php echo $row->remarks; ?></td>-->
                
            </tr>
             <?php endforeach;
            if(count($list_data_cat) == 0){ ?>
              <tr><td colspan="8"> <h3>No data found. </h3></td></tr>
           <?php }
           ?>
        </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Complaint No.</th>
                                            <th>Date of Allocation to the Bench</th>
                                            <th>Status of Complaints</th>
                                            <th>Bench/Agency/Authority/With whom Pending</th>
                                            <th>Due date for submission of Preliminary Inquiry or Investigation Report</th>
                                            
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
