    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Lokpal of India</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/admin_material/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/admin_material/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/admin_material/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url();?>assets/admin_material/css/themes/all-themes.css" rel="stylesheet" />
<body class="theme-red">
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

    <section class="">
        <div class="container-fluid">
            <div class="col-lg-12">
                <h2 class="pages_title">
                    MIS Report<hr>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a>
                        <div class="header">
                            <h2>
                                Status of Complaints
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                     <thead>
            <tr>
                <th>S.No.</th>
                <th>Action</th>
                <th>Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/I">Under Preliminary Inquiry</a></td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/I"><?php echo $under_prem_inq ?></a></td>
            </tr>
            <tr>
                <td>2</td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/V">Under Investigation</a></td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/V"><?php echo $under_inves ?></a></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Prosecution Sanctioned</td>
                <td><?php echo '0'; ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/U">Under Consideration of Lokpal</a></td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/U"><?php echo $cons_lokpal ?></a></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Ordered Departmental Proceedings</td>
                <td><?php echo '0'; ?></td>
            </tr>
            <tr>
                <td>6</td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/D">Closed</a></td>
                <td><a href="<?php echo base_url();?>report/list_of_complaints/D"><?php echo $closed ?></a></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Action</th>
                <th>Number</th>
            </tr>
        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>assets/admin_material/plugins/bootstrap/js/bootstrap.js"></script>

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
</body>
