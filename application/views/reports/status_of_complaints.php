  <!-- JQuery DataTable Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">



            <div class="app-content">
                <div class="main-content-app">
                    <div class="page-header">
                        <h4 class="page-title">MIS Reports</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Status of Complaints</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Status of all Complaints Receive by Lokpal.
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
                                                        <tr>
                                            <td hidden="true">6</td>
                                            <td></td>
                                            <td>Total</td>
                                            <td><?php echo ($under_prem_inq+$under_inves+$cons_lokpal+$closed)?></td>
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
                        </div>
                    </div>
                </div>
            </div>
