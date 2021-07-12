      <!-- JQuery DataTable Css -->
      <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">



      <div class="app-content">
        <div class="main-content-app">
            <div class="page-header">
                <h4 class="page-title">MIS Reports</h4>
                <ol class="breadcrumb"> 
                    <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                    <li class="breadcrumb-item active" aria-current="page">MIS Reports</li> 
                </ol>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Status of Complaints Under Consideration of Lokpal of India
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
                                                <th>Bench No.(Presided by)</th>
                                                <th>Fresh Complaints for Consideration[Sec 20(1)]</th>
                                                <th>Consideration of Preliminary Inquiry[Sec 20(3)]</th>
                                                <th>Consideration of Investigation Report[Sec 20(7)]</th>
                                                <th>Any Other Purpose</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c = 1;
                                            foreach($all_benches as $row):
                                              ?>
                                              <tr>
                                                <td><?php echo $c++.'.'; ?></td>
                                                <td><b><?php echo ($row->bench_no == 0) ? 'Full Bench' : $row->bench_no; ?> - (<?php echo get_judge_name($row->presiding); ?>)</b></td>
                                                <?php
                                                $bid_array = get_bench_ids_bybno($row->bench_no);
                        //$bid_array = array(112,115,116,117);
                                                ?>
                                                <td><a href="<?php echo base_url();?>report/list_of_complaints_2/F/<?php echo $row->bench_no; ?>"><?php echo $f = get_f_cases_u_loi_count($bid_array); ?></a></td>

                                                <td><a href="<?php echo base_url();?>report/list_of_complaints_2/I/<?php echo $row->bench_no; ?>"><?php echo $u = get_i_cases_u_loi_count($bid_array); ?></a></td>

                                                <td><a href="<?php echo base_url();?>report/list_of_complaints_2/V/<?php echo $row->bench_no; ?>"><?php echo $v = get_v_cases_u_loi_count($bid_array); ?></a></td>

                                                <td><a href="<?php echo base_url();?>report/list_of_complaints_2/O/<?php echo $row->bench_no; ?>"><?php echo $o = get_other_cases_u_loi_count($bid_array); ?></a></td>

                                                <td><?php echo $sum = $f+$u+$v+$o; ?></td>
                                            </tr>
                                        <?php endforeach;
                                        if(count($all_benches) == 0){  ?>
                                          <tr><td colspan="8"> <h3>No data found. </h3></td></tr>
                                      <?php }
                                      ?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Bench No.(Presided by)</th>
                                        <th>Fresh Complaints for Consideration[Sec 20(1)]</th>
                                        <th>Consideration of Preliminary Inquiry[Sec 20(3)]</th>
                                        <th>Consideration of Investigation Report[Sec 20(7)]</th>
                                        <th>Any Other Purpose</th>
                                        <th>Total</th>
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
