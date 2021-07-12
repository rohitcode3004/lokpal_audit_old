
  <!-- JQuery DataTable Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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

      <div class="app-content">
                <div class="main-content-app">
                  <div class="page-header">
                        <h4 class="page-title">Complaints for Allocation to benches</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Complaints for Allocation to benches</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

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
    if($this->session->flashdata('upload_error'))
    {
     echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>
     <h4>'.$this->session->flashdata('upload_error').'</h4></div>';
    }
    ?>

                
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                              <?php
                              if($flag == 'PIR')
                                echo "Complaints for which Public Servant's Report after Preliminary Inquiry has been <strong>Accepted</strong>";
                              elseif($flag == 'IR')
                                echo "Complaints for which Public Servant's Report after Investigation has been <strong>Accepted</strong>";
                              elseif($flag == 'AOA')
                                echo "Complaints for which Status/Additional Documents/Other Report has been <strong>Accepted</strong>";
                              else
                                echo 'List of complaints';
                              ?>

                            <ul class="more-action">
                            
                                <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                              <form action="<?php echo base_url();?>bench/benchcomposition" method="post" id="myForm">  </form>
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                  <thead>
                                    <tr>
                                     <th style="width: 10px;"><!--<input type="checkbox" id="checkall" />-->S.No.</th>
                                     <th style="width: 60px;">Complaint no.</th>
                                     <th style="width: 60px;">Diary no.</th>
                                     <th style="width: 150px;">Department of public servant</th>
                                     <th style="width: 130px;">Designation of public servant</th>
                                     <!--<th>D.o.Filing</th>-->
                                     <th title="Date when scrutiny completed" style="width: 60px;">Date of Scrutiny</th>
                                     <!--<th style="width: 80px;">Preview</th>-->
                                     <th style="width: 100px;">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $c = 1;
                                    foreach($chairperson_data as $row):
                                        $agency_count = getAgencyCount($row->filing_no);
                                      ?>
                                      
                                        <tr <?php if($agency_count == 1) { ?> class="onece" <?php } elseif($agency_count == 2) { ?> class="secylce" <?php } ?>>
                                          <td><?php echo $c++.'.'; ?></td>
                                          <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                                          <td><?php if($row->filing_no){
                                            echo $row->filing_no;
                                            //$against_name = get_against_name($row->filing_no);
                                          } ?></td>

                                          <?php //$full_name_comp = $row->first_name." ".$row->mid_name." ".$row->sur_name; ?>
                                          <td> <?php if($row->ps_orgn){
                                            echo $row->ps_orgn;
                                          } ?>
                                          </td>

                                          <td>
                                           <?php if($row->ps_desig){
                                            echo $row->ps_desig;
                                          } ?>
                                        </td>

                                        <!--<td>
                                          <?php echo get_displaydate($row->dt_of_filing); ?>
                                        </td>-->
                                        <td>
                                          <?php echo get_displaydate($row->scrutiny_date); ?>
                                        </td>
                                        <!--<td>
                                          <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                                        </td>-->
                                        <td>
                                          <!--<input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>" form="myForm">-->
                                          <button class="btn btn-primary" type="submit" value="<?php echo $row->filing_no; ?>" name="filing_no" form="myForm">Bench Allocation</button>
                                        </td>
                                      </tr>
                                  
                                  <?php endforeach;
                                    if(count($chairperson_data) == 0){ ?>
                                      <tr><td colspan="8"> <h3>No record available</h3></td></tr>
                                   <?php }
                                   ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                     <th style="width: 10px;"><!--<input type="checkbox" id="checkall" />-->S.No.</th>
                                     <th style="width: 60px;">Complaint no.</th>
                                     <th style="width: 60px;">Diary no.</th>
                                     <th style="width: 150px;">Department of public servant</th>
                                     <th style="width: 130px;">Designation of public servant</th>
                                     <!--<th>D.o.Filing</th>-->
                                     <th title="Date when scrutiny completed" style="width: 60px;">Date of Scrutiny</th>
                                     <!--<th style="width: 80px;">Preview</th>-->
                                     <th style="width: 100px;">Action</th>
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
            </div>  





