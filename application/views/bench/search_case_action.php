<?php 
//echo "<pre>";
//print_r($case_detail);

 //$ct=count($case_detail);

//echo $case_detail['0']['complaint_no'] ?? '';die;
// $cp_year=$case_detail[0]->complaint_year ?? '';

//$complaint_no=$cp_no.'/'.$cp_year;die;

?>

  <!-- JQuery DataTable Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  
            <div class="app-content">
                <div class="main-content-app">
                    <div class="page-header">
                        <h4 class="page-title">Search Complaints</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Search Complaints</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Status of Complaints
                                <ul class="more-action">
                                    <li><a href="<?php echo base_url(); ?>bench/search_case" class="previous">&laquo; Back</a></li>
                                </ul>
                              </div>
                              <div class="panel-body">
                                <div class="row">
                                    <?php if (isset($error)) {?>
                                        <div class="col-md-12"> 
                                            <div class="search" style="float: left;  margin-left: 90px;  margin-bottom: 30px;">                  
                                                <span style="color: red"><b>  <?php echo $error;?></b></span>
                                            </div>           
                                        </div>
                                    <?php } ?>
                                </div>
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
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>

                                               
                                                <tbody>   

                                                 <?php
                                                    $c=1;

                                                    if(isset($case_detail))
                                                    {
                                                    $ct=count($case_detail);


                                                    for($i=0;$i<$ct;$i++){
                                                  
                                                   //echo $case_detail[$i]['filing_no']; die;
                                                    // $farmb[0]->o_pin_code;
                                                ?>                                                                       

                                                    <tr>
                                                        <td><?php echo $c++.'.'; ?></td>
                                                      
                                                        <td><?php echo get_complaintno($case_detail[$i]['filing_no'] ?? ''); ?></td>


                                                        <td>
                <?php
                    $allocation_date =  get_allocation_date($case_detail[$i]['filing_no'] ?? '');
                    if($allocation_date != NULL)
                        echo date("d-m-Y", strtotime($allocation_date));
                    else
                        echo "n/a";
                 ?></td>

                                                        <td><?php 
                                                                $matrix = create_stage_matrix($case_detail[$i]['filing_no'] ?? '');//68/2020
                                                                echo $result = get_case_status_fed_matrix($matrix);
                                                            ?></td>

                                                        <td><?php
                if($matrix[0][2] == 'P' || $matrix[0][5] == 'P'){
                    //echo $row->bench_id;
                    //echo $row->filing_no;
                    echo get_with_which_bench_pending($case_detail[$i]['bench_id'], $case_detail[$i]['filing_no']); 
                }elseif($matrix[0][1] == 'P')
                {
                    echo 'At Chairperson Level';
                }elseif($matrix[0][3] == 'P')
                {
                    echo get_with_which_agency_pending($case_detail[$i]['ordertype_code'], $case_detail[$i]['agency_code']);
                }else{
                    echo 'n/a';
                }

                 ?></td>
                                                        <td><?php echo isset($case_detail[$i]['due_date']) ? get_displaydate($case_detail[$i]['due_date']) : 'n/a'; ?></td>
                                                        <td><?php echo ($case_detail[$i]['remarks'] ?? 'na'); ?></td>
                                                    </tr>
                                                   
                                                    <?php  } ?> 
                                                </tbody>

                                              
                                                <tfoot>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Complaint No.</th>
                                                         <th>Date of Allocation to the Bench</th>
                                                         <th>Status of Complaints</th>
                                                         <th>Bench/Agency/Authority/With whom Pending</th>
                                                          <th>Due date for submission of Preliminary Inquiry or Investigation Report</th>
                                                        <th>Remarks</th>
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
  
   <?php }?>

