<?php
//$elements = $this->label->view(1);
?>


<script language="javascript">    
  $().ready(function() {
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
   // startDate: '-0d',
   autoclose: true,
   todayHighlight: true  
 });  

  });        

  
</script>

<style type="text/css">
.navbar-nav>li .active {
  color: green !important;
} 

tr.error{
  background-color: #cd5c5c !important;
}

tr.onece {
  background-color: #8ff9f9 !important;
}

tr.secylce{
  background-color: #f2b9b9 !important;
}

td,th {
  text-align: center;
  vertical-align: top;
}


/*@media print
{
  body * { visibility: hidden; }
  .box * { visibility: visible; }
  .box { position: absolute; top:0px; left: 0px; width: 100% }
}*/
@media print {
  body * {
    visibility: hidden;
    margin: 0;
    padding: 0;
  }
  #printable-area * {
    visibility: visible;
  }
  #printable-area {
    position: relative;
    left: 0;
    top: 0;
  }
}
@page  
  { 
    size: auto;   /* auto is the initial value */ 

    /* this affects the margin in the printer settings */ 
    margin: -150px auto 0 auto;   
 }   

</style>


<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <!-- <h4 class="page-title">View Cause List</h4>
     <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">View Cause List</li>
      </ol>-->
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Cause List 
            <ul class="more-action">
              <li><a href="<?php echo base_url(); ?>causelist/genratecauselist" class="previous">&laquo; Back</a></li>
              <li><a href="#" onclick="window.print()">Print</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="row">
            </div>
           
            <div class="row">
              <div class="col-md-12">
              <div id="printable-area">
                <div class="table-responsive print-table">
                  <span id="success_message"></span>
                  <table id="" class="table" style="width: 100%;">
                    <tbody>
                      <tr><td style="border: none;padding: 0px !important;">
                        <img src="<?php echo base_url().'cdn/logo' ?>" style="height: 70px !important;width: 80px !important;margin-left:auto; margin-right:auto;display: block;"></td>
                      </tr>
                      <tr>
                        <td style="border: none;padding: 0px !important;"><b><font size="5">LOKPAL OF INDIA</font></b></td>
                      </tr>
                      <tr>
                        <td style="border: none;padding: 0px !important;"><font size="2">Vasant Kunj, New Delhi</font></td>
                      </tr>
                      <tr>
                        <td style="border: none;padding: 0px !important;"><b><font size="3"><?php echo date('l, j<\s\up>S</\s\up> F, Y', strtotime($listing_date))." at ".$time." AM"; ?></font></b></td>
                      </tr>
                      <tr>
                        <td style="border: none;padding: 0px !important;"><u><font size="3"><?php echo "Venue : ".get_venue_name($venue); ?></font></u></td>
                      </tr>
                      <tr>
                        <td style="border: none;padding: 8px !important;"><b><u><font size="3">CAUSE LIST</font></u></b></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="clearfix"></div>
                </div>

                <?php 
                $complaint_sn = 1;
                foreach($get_all_benches as $get_all_bench):
                              //print_r($get_all_bench->id);
                  $counter_coram = 0;
                  $counter_table_head = 0;
                  foreach($purpose_type as $purpose){
                    //print "<pre>";
                    //print_r($purpose);
                    //print "</pre>";
                    $get_allocation_cases = get_causelist_cases($get_all_bench->id, $listing_date, $purpose->id, $venue);
                              //print "<pre>";
                              //print_r($get_allocation_cases);
                              //print "</pre>";
                              //die;
                    if(!empty($get_allocation_cases)){
                      $coram = get_coram($get_all_bench->id);
                                //print "<pre>";
                              //print_r($coram);
                              //print "</pre>";
                              //die;
                      if($counter_coram == 0){
                       ?>
                       
                    <div class="table-responsive">
                        <span id="success_message"></span>
                        <table id="mytable" class="table table-bordered table-striped">
                          <tbody>
                            <?php 
                            if($get_all_bench->bench_no == 0){
                              $bench_no_display = 'Full Bench';
                            }else{
                              $bench_no_display = 'Bench no. '.$get_all_bench->bench_no;
                            }
                            ?>
                            <tr>
                              <th colspan="4" style="text-align: left;!important">CORAM: <?php echo $bench_no_display; ?></th>
                            </tr>
                            <?php
                            $sn = 1;
                            foreach($coram as $c):
                             ?>
                            <tr>
                              <td><b><?php echo $sn++."."; ?></b></td><td><b><?php echo $c['judge_name']; ?></b></td> <td>:</td><td><b><?php echo get_member_type($c['judge_code']); ?></b></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      <div class="clearfix"></div>
                    </div>
                    <?php } 
                    $counter_coram +=1;
                    ?>

                    

                  <div class="table-responsive">
                    <span id="success_message"></span>
                    <table id="mytable" class="table table-bordered table-striped">
                      <thead>
                        <?php if($counter_table_head == 0) { ?>
                          <tr>
                            <th>S.No.</th>
                            <th>Complaint No.</th>
                          </tr>
                          <?php 
                          $counter_table_head +=1;
                        } ?>

                        <tr>
                          <td class="text-left bg-info" colspan="2">
                            <?php
                            echo $purpose->name; ?>
                          </td>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php
                        //print "<pre>";
                        //print_r($get_allocation_cases);
                        //print "</pre>";
                        $complaint_sn = 1;
                        foreach($get_allocation_cases as $get_allocation_case): ?>
                          <tr>
                            <td><?php echo $complaint_sn++."."; ?></td>
                            <td><?php echo get_complaintno($get_allocation_case->filing_no); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <div class="clearfix"></div>
                  </div>
                    
                  <?php } } endforeach; ?>

                  <div class="table-responsive">
                    <span id="success_message"></span>
                    <table id="mytable" class="table table-striped">
                      <tbody>
                        <tr>
                          <td style="text-align:left; border: none;">New Delhi</td>
                          <td style="text-align:right;border: none;">Court Master</td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <ul class="time-list">
                  <li><span class="list-blue"></span> @lokpalofIndia</li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
