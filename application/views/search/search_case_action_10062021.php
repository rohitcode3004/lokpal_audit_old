
<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <?php   // echo "<pre>";
        //print_r($case_detail);die;?>

   
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
      <h4 class="page-title">Search Case Report</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">Search Case Report</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Search Case Report 
            <ul class="more-action">
              <li><a href="<?php echo base_url(); ?>search/search_case" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <?php 
                  if (isset($error)) {?>
                    <div class="alert alert-danger">
                      <h4 class="m-0"><?php echo $error;?></h4>
                    </div>           
                <?php } ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <tr>
                          <th>S.No.</th>
                          <th>Complaint No.</th>
                           <th>Complainant Name</th>
                           <th>Name of Public servant</th>
                           <th>Date of filing</th>
                            <th>Department name</th>
                          <th>Summary of facts/allegations</th>
                          <th>Legacy</th>
                      </tr>
                    </thead>
                     <tbody>
                      <?php
                        //$i=1;
                        $c=1;

                        if(isset($case_detail))
                        {
                        $ct=count($case_detail);


                        for($i=0;$i<$ct;$i++){  
                      ?>

                      <tr>
                        <td><?php echo $c++; ?></td>
                        
                        <td>
                          <?php 
                           echo get_complaintno($case_detail[$i]->filing_no);
                          ?> 
                        </td>
                        <td><?php echo ($case_detail[$i]->first_name.' '.$case_detail[$i]->mid_name.' '.$case_detail[$i]->sur_name); ?></td>
                        <td><?php echo ($case_detail[$i]->ps_first_name.' '.$case_detail[$i]->ps_mid_name.' '.$case_detail[$i]->ps_sur_name); ?></td>
                        <td>
                          <?php
                            if($case_detail[$i]->is_legacy ?? ''=='t')
                            {
                            echo get_displaydate($case_detail[$i]->dt_of_complaint ?? '');
                            }
                            else
                            {
                             $sql="select  dt_of_filing from complainant_details_parta where filing_no='".$case_detail[$i]->filing_no."'";                
                             $query   = $this->db->query($sql)->result();
                             echo get_displaydate($query[0]->dt_of_filing ?? '');
                            }
                          ?>
                        </td>
                        <td><?php echo $ps = isset($case_detail[$i]->ps_orgn) || $case_detail[$i]->ps_orgn == '' ? $case_detail[$i]->ps_orgn : 'n/a'; ?></td>
                        <td><?php echo ($case_detail[$i]->summary ?? 'na'); ?></td>
                        
                        <td><?php 

                          if($case_detail[$i]->is_legacy =='t')
                          {
                            echo "old case";
                          }
                          else
                          {
                            echo "Fresh case";
                          }
                       // echo ($case_detail[$i]->is_legacy ?? 'na'); ?></td>
                      </tr>
                      <?php  } ?> 
                    </tbody>   
                    <tfoot>
                      <tr>
                        <th>S.No.</th>
                        <th>Complaint No.</th>
                        <th>Complaint Name</th>
                        <th>Name of Public servant</th>
                        <th>Date of filing</th>
                        <th>Department name</th>
                        <th>Summary of facts/allegations</th>
                        <th>Legacy</th>
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
<?php }?>

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
