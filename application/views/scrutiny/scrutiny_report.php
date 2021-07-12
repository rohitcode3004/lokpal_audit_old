<?php
//$elements = $this->label->view(1);
  $this->load->model('scrutiny_model');
?>
<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Scrutiny Report</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">Scrutiny Report</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Details of Scrutiny Report- 
            <ul class="more-action">
              <li><a href="<?php echo base_url('scrutiny/dashboard_main'); ?>" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <?php
                  if($this->session->flashdata('success_msg'))
                  {
                   echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4 class="m-0">'.$this->session->flashdata('success_msg').'</h4></div>';
                  }
                  if($this->session->flashdata('error_msg'))
                  {
                   echo '<div class="alert alert-damger"><button type="button" class="close" data-dismiss="alert">×</button>
                   <h4 class="m-0">'.$this->session->flashdata('error_msg').'</h4></div>';
                  }
                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
        <div class="table-responsive">
          <span id="success_message"></span>
          <table id="mytable" class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
               <th>S.No.</th>
                <th>Complaint no.</th>
               <th>Diary no</th>
               <th>Complainant name</th>
               <th>Complaint against</th>
               <th>Date of Filing</th>
               <th>Preview</th>
               <th>Pdf</th>
            </thead>
            <tbody>
              <?php
              $c = 1;
              foreach($scrpen_comps as $row):
              ?>
              <form action="<?php echo base_url();?>scrutiny/checklist" method="post" id="">
                <tr>
                  <td><?php echo $c++; ?></td>
                    <td><?php echo get_complaintno($row->filing_no);?></td>
                  <td><?php if($row->filing_no){
                    echo $row->filing_no;
                    $against_name = get_against_name($row->filing_no);
                  } ?></td>

                  <?php $full_name_comp = $row->first_name." ".$row->mid_name." ".$row->sur_name; ?>
                  <td><?php if($full_name_comp){
                    echo $full_name_comp;
                  } ?></td>

                  <td>
                   <?php if($against_name){
                    echo $against_name;
                    } ?>
                  </td>

                  <td>
                    <?php echo get_displaydate($row->dt_of_filing); 
                      $data['scrutiny_url'] = $this->scrutiny_model->get_scrutiny_url($row->filing_no);
                      $myArray=(array)$data['scrutiny_url'];
                    ?>
                  </td>

                  <td>
                    <a href="<?php echo base_url().'scrutiny/affidavit_detail_pre/'.$row->ref_no ?>" target="_blank">Application preview</a>
                  </td>               

                  <?php if($myArray[0]['scrutiny_def_url'] ?? '' !=''){?>
                  <td><a href="<?php echo base_url();?><?php echo $myArray[0]['scrutiny_def_url'] ?? ''; ?>.pdf" target="_blank" alt="">Show created pdf </a>
                  </td> 
                  <?php }
                  else {
                  ?> 
                  <td></td>

                  <?php } ?>

                </tr>
              </form>
              <?php endforeach; ?>
            </tbody>
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