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
 <!--<div class="page-loader-wrapper">
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
    </div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->


    <?php 
//echo "<pre>";
//print_r($legacy_data);

 //$ct=count($case_detail);

//echo $legacy_data['0']->serial_no ?? '';die;
// $cp_year=$case_detail[0]->complaint_year ?? '';

//$complaint_no=$cp_no.'/'.$cp_year;die;

    ?>
    <section class="">
        <div class="container-fluid">
            <div class="col-lg-12">
                <h2 class="pages_title">
                    Legacy Data Report<hr>
                </h2>
            </div>
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
    ?>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Legacy Data
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
                                <form action="<?php echo base_url();?>backlog/verify" method="post" id="myForm">  </form>
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                   <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Serial No.</th>           
                                        <th>Complainant Name</th>
                                        <th>State</th>
                                        <th>District</th>
                                        <th>P.S. Name</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Date of Complaint</th>
                                        <th>Order Uploaded</th>
                                        <th>View Report</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php      
                                $c=1;
                                if(isset($legacy_data))
                                {
                                    $ct=count($legacy_data);
                                    for($i=0;$i<$ct;$i++){    
                                        ?>
                                            <tr>
                                                <td><?php echo $c++; ?></td>              
                                                <td><?php echo $legacy_data[$i]->serial_no ?? ''; ?></td>


                                                <td><?php echo ($legacy_data[$i]->salutation_desc.'. '.$legacy_data[$i]->first_name.' '.$legacy_data[$i]->mid_name.' '.$legacy_data[$i]->sur_name); ?></td>

                                                <td><?php echo $legacy_data[$i]->name ?? ''; ?></td>
                                                <?php 
                                                if($legacy_data[$i]->p_state_id!=NULL && $legacy_data[$i]->p_dist_id !=NULL){           
                                                    $sql='select name,district_code from master_address where state_code='.$legacy_data[$i]->p_state_id.' and district_code='.$legacy_data[$i]->p_dist_id.' and sub_dist_code=0 and village_code=0 and display=TRUE order by name asc';   
                                                    //print_r($sql);die;
                                                    $query  = $this->db->query($sql)->result();  
         //print_r($this->db->last_query());   die;        
                                                    $name=$query[0]->name ?? '';  
                                                }else{
                                                    $name = '';
                                                }         
                                                ?>

                                                <td><?php echo $name; ?></td>

                                                <?php   
                                                if($legacy_data[$i]->ps_salutation_id!=NULL){                       
                                                    $sql='select salutation_desc from salutation where salutation_id='.$legacy_data[$i]->ps_salutation_id;      
                                                    $query  = $this->db->query($sql)->result();          
                                                    $salutation_desc=$query[0]->salutation_desc ?? '';     
                                                }else{
                                                    $salutation_desc = '';
                                                }      
                                                ?>

                                                <td><?php echo ($salutation_desc.' '.$legacy_data[$i]->ps_first_name.' '.$legacy_data[$i]->ps_mid_name.' '.$legacy_data[$i]->ps_sur_name); ?></td>

                                                <td><?php echo $legacy_data[$i]->ps_desig ?? ''; ?></td>
                                                <td><?php echo $legacy_data[$i]->ps_orgn ?? ''; ?></td>

                                                <td><?php echo get_displaydate($legacy_data[$i]->dt_of_complaint); ?></td>  
                                                <td><a href="<?php echo base_url().$legacy_data[$i]->order_upload; ?>" target="_blank">View Order Uploaded</a></td>  

                                                <td> <a href="<?php echo base_url().'backlog/printpdf/'.$legacy_data[$i]->id; ?>" target="_blank">Download/Print pdf</a> </td>   
                                                 <td>
                                                    <?php
                                                    if($legacy_data[$i]->verified == 'f'){
                                                    ?>
                                                    <button class="btn btn-primary" value="<?php echo $legacy_data[$i]->id; ?>" name="id" form="myForm">Verify</button>
                                                    <?php } elseif($legacy_data[$i]->verified == 't') { ?>
                                                    <span>Verified</span>  
                                                    <?php } ?>  
                                                </td>  
                                                 <td><a href="<?php echo base_url().'backlog/edit/'.$legacy_data[$i]->id; ?>">Edit/View</</td>       
                                            </tr>

                                        <?php  } ?> 
                                    </tbody>


                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Serial No.</th>

                                            <th>Complainant Name</th>

                                            <th>State</th>
                                            <th>District</th>
                                            <th>P.S. Name</th>

                                            <th>Designation</th>
                                            <th>Department</th>

                                            <th>Date of Complaint</th>
                                            <th>Order Uploaded</th>

                                            <th>View Report</th>
                                            <th>Status</th>
                                            <th>Action</th>
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

    <?php } ?>
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