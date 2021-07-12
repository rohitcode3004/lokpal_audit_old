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
                        <div class="panel-heading">Status of Complaints against various Categories of Public Servants.
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); if($user['role'] == 138){ ?>bench/dashboard_main<?php } elseif($user['role'] == 147 || $user['role'] == 170){ ?>proceeding/dashboard_main<?php } ?>" class="previous">&laquo; Back</a></li>
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
                                            <th>Category of Public Servant</th>
                                            <th>Number of Complaints</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/M">Member of Parliament</a></td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/M"><?php echo $member_of_parliyament ?></a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/A">Group A or Group B officials</a></td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/A"><?php echo $officials_groupa_groupb ?></a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/E">Group 'C' & Group 'D' </a></td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/E"><?php echo $ex_group; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/C">Chairperson/Member/Officer/Employee in any body/<br>Board/Corporation/Authority/Company/Society/Trust/Autonomous Body <br> (established by an Act of Parliament or wholly or partially financed by the Central Government or controlled by it.</a></td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/C"><?php echo $cons_rest ?></a></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/O">Others (Which are not specifically covered under categories specified in section 14).</a></td>
                                            <td><a href="<?php echo base_url();?>report/list_of_categories/O"><?php echo $others; ?></a></td>
                                        </tr>    
                                        <tr>
                                            <td hidden="true">6</td>
                                            <td></td>
                                            <td>Total</td>
                                            <td><?php echo ($member_of_parliyament+$officials_groupa_groupb+$cons_rest+$others+$ex_group)?></td>
                                        </tr>       
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Category of Public Servant</th>
                                            <th>Number of Complaints</th>
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
