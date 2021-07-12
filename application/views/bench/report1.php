<?php
//$elements = $this->label->view(1);
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/bootstrap/css/chosen.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/custom_style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  

  <style type="text/css">
   .navbar-nav>li .active {
    color: green !important;
  } 

  tr.error{
    background-color: #cd5c5c !important;
  }
/* 3a87ad73 */
  tr.onece {
  background-color: #8ff9f9 !important;
}

tr.secylce{
  background-color: #f2b9b9 !important;
}

  a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #0171b5;
  color: black;
}

    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

</style>

<script type="text/javascript">
     

        $(document).ready(function () {

            //"Show ID" for Associate Button Click
            $('.table tr > td').click(function () {
            });
        });

</script>

</head>
<body> 
      <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">List of complaints pending for listing</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">List of complaints already listed</button>
    </div>
  <section id="London" class="content tabcontent">

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

  <!-- SELECT2 EXAMPLE -->
  <div class="box box-default">
    <div class="box-header with-border">

      <a href="<?php echo base_url(); ?>bench/dashboard" class="previous">&laquo; Back</a>
      <br>
      <br>
      <!-- /.box-header -->
      <div class="box-body" >

       <fieldset>

         <div class="table-responsive">

          <span id="success_message"></span>
          <table id="mytable" class="table table-bordred table-striped">

           <thead>

             <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
             <th>Complaint no</th>
             <th>Diary no</th>
             <th>Complainant name</th>
             <th>Complaint against</th>
             <th>Date of Filing</th>
             <th>Date of Scrutiny</th>
             <th>Preview</th>
             <th>Action</th>
           </thead>
           <tbody class="panel">
            <?php
            $c = 0;
            foreach($chairperson_data as $row):
              $c = $c+1;
                $agency_count = getAgencyCount($row->filing_no);
              ?>
              <form action="<?php echo base_url();?>bench/benchcomposition" method="post" id="">
                <tr <?php if($agency_count == 1) { ?> class="onece" <?php } elseif($agency_count == 2) { ?> class="secylce" <?php } ?> data-toggle="collapse" data-target="#demo<?php echo $c ?>, #demo1<?php echo $c ?>, #demo2<?php echo $c ?>, #demo3<?php echo $c ?>, #demo4<?php echo $c ?>" data-parent="#myTable">
                  <td><?php echo $c.'.'; ?></td>
                  <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
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
                  <?php echo get_displaydate($row->dt_of_filing); ?>
                </td>
                <td>
                  <?php echo get_displaydate($row->scrutiny_date); ?>
                </td>
                <td>
                  <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                </td>
                <td>
                  <input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>">
                  <button class="btn btn-primary" type="submit" value="Submit">Details</button>
                </td>
              </tr>

              <?php 
              $all_benches = get_coram_all($row->filing_no);
              //$all_benches = json_encode($all_benches);
              //print("<pre>".print_r($all_benches,true)."</pre>");die;
              if(!empty($all_benches)){
              foreach ($all_benches as $key => $value) { 
                if($value['bench_no'] == 0){
                  $bench_no_display = 'Full Bench';
                }else{
                  $bench_no_display = $value['bench_no'];
          }?>
              <tr id="demo<?php echo $c ?>" class="collapse info">
                <td colspan='3' style="text-align:center"><font color='#C70039'><b>Bench no: <?php echo $bench_no_display; ?></b></font></td>
              </tr>
              <tr id="demo1<?php echo $c ?>" class="collapse info">
                <td colspan='' style="text-align:center"><b>Order date: <?php echo get_displaydate($value['order_date']); ?></b></td><td><b>Total no. of cases: <?php echo $value['tnoc']; ?></b></td><td style="text-align:center"><b>court no: <?php echo $value['court_no']; ?></b></td>
              </tr>
              <tr id="demo2<?php echo $c ?>" class="collapse info">
                <td colspan='3' style="text-align:center"><b><u>CORAM</u>:</b></td>
              </tr>
              <?php $sn = 1;
                foreach ($value['judges_array'] as $key => $value2) { ?>
              <tr id="demo3<?php echo $c ?>" class="collapse info"><td colspan='2' style="text-align:center"><b><?php echo $sn.'. '; ?></b><?php echo $value2['judge_name']; if($value2['judge_code'] == $value['presiding']) echo "(Presided by)" ?></td><td style="text-align:center"><b><?php echo $value2['judge_desg']; ?></b></td>
              </tr>
                <?php $sn ++; 
                 }
                 } 
                 }else{ ?>
                  <tr id="demo4<?php echo $c ?>" class="collapse info">
                <td colspan='4'><b>Not Available</b></td>
              </tr>
              <?php
                 }
                ?>


            </form>
          <?php endforeach;
            if(count($chairperson_data) == 0){ ?>
              <tr><td colspan="8"> <h3>Nothing left. </h3></td></tr>
           <?php }
           ?>
        </tbody>
        
      </table>

      <div class="clearfix"></div>

    </div>

      </fieldset>
</div>
</div>
</div>

<div class="col-md-2"> 
 </div>
</section>

<section id="Paris" class="content tabcontent">

    <!-- SELECT2 EXAMPLE -->
  <div class="box box-default">
    <div class="box-header with-border">

      <a href="<?php echo base_url(); ?>bench/dashboard" class="previous">&laquo; Back</a>
      <br>
      <br>
      <!-- /.box-header -->
      <div class="box-body" >

       <fieldset>

         <div class="table-responsive">

          <span id="success_message"></span>
          <table id="mytable" class="table table-bordred table-striped">

           <thead>

             <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
             <th>Complaint no</th>
             <th>Diary no</th>
             <th>Complainant name</th>
             <th>Complaint against</th>
             <th>Date of Filing</th>
             <th>Date of Scrutiny</th>
             <th>Preview</th>
             <th>Status</th>
             <th>Action</th>
           </thead>
           <tbody class="panel">
            <?php
            $c = 0;
            foreach($ongoing_comp_data as $row):
              $c = $c+1;
                $agency_count = getAgencyCount($row->filing_no);
              ?>
              <form action="<?php echo base_url();?>bench/benchcomposition" method="post" id="">
                <tr <?php if($agency_count == 1) { ?> class="onece" <?php } elseif($agency_count == 2) { ?> class="secylce" <?php } ?> data-toggle="collapse" data-target="#demo<?php echo $c ?>, #demo1<?php echo $c ?>, #demo2<?php echo $c ?>, #demo3<?php echo $c ?>, #demo4<?php echo $c ?>" data-parent="#myTable">
                  <td><?php echo $c.'.'; ?></td>
                  <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
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
                  <?php echo get_displaydate($row->dt_of_filing); ?>
                </td>
                <td>
                  <?php echo get_displaydate($row->scrutiny_date); ?>
                </td>
                <td>
                  <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                </td>
                <td>
                  <?php echo get_realtime_status($row->filing_no); ?>
                </td>
                <td>
                  <input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>">
                  <button class="btn btn-primary" type="submit" value="Submit">Details</button>
                </td>
              </tr>

              <?php 
              $all_benches = get_coram_all($row->filing_no);
              //$all_benches = json_encode($all_benches);
              //print("<pre>".print_r($all_benches,true)."</pre>");die;
              if(!empty($all_benches)){
              foreach ($all_benches as $key => $value) { 
                if($value['bench_no'] == 0){
                  $bench_no_display = 'Full Bench';
                }else{
                  $bench_no_display = $value['bench_no'];
          }?>
              <tr id="demo<?php echo $c ?>" class="collapse info">
                <td colspan='3' style="text-align:center"><font color='#C70039'><b>Bench no: <?php echo $bench_no_display; ?></b></font></td>
              </tr>
              <tr id="demo1<?php echo $c ?>" class="collapse info">
                <td colspan='' style="text-align:center"><b>Order date: <?php echo get_displaydate($value['order_date']); ?></b></td><td><b>Total no. of cases: <?php echo $value['tnoc']; ?></b></td><td style="text-align:center"><b>court no: <?php echo $value['court_no']; ?></b></td>
              </tr>
              <tr id="demo2<?php echo $c ?>" class="collapse info">
                <td colspan='3' style="text-align:center"><b><u>CORAM</u>:</b></td>
              </tr>
              <?php $sn = 1;
                foreach ($value['judges_array'] as $key => $value2) { ?>
              <tr id="demo3<?php echo $c ?>" class="collapse info"><td colspan='2' style="text-align:center"><b><?php echo $sn.'. '; ?></b><?php echo $value2['judge_name']; if($value2['judge_code'] == $value['presiding']) echo "(Presided by)" ?></td><td style="text-align:center"><b><?php echo $value2['judge_desg']; ?></b></td>
              </tr>
                <?php $sn ++; 
                 }
                 } 
                 }else{ ?>
                  <tr id="demo4<?php echo $c ?>" class="collapse info">
                <td colspan='4'><b>Not Available</b></td>
              </tr>
              <?php
                 }
                ?>


            </form>
          <?php endforeach;
            if(count($ongoing_comp_data) == 0){ ?>
              <tr><td colspan="8"> <h3>Nothing left. </h3></td></tr>
           <?php }
           ?>
        </tbody>
        
      </table>

      <div class="clearfix"></div>

    </div>

  </fieldset>
</div>
</div>
</div>

<div class="col-md-2"> 
 </div>
</section>
<div class="col-md-0"><div class="foo white"></div><font>first time</font></div>
<div class="col-md-0"><div class="foo blue"></div><font>second time</font></div>
<div class="col-md-0"><div class="foo red"></div><font>third time</font></div>
</body>
<style type="text/css">
  .foo {
  float: left;
  width: 20px;
  height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}

.white {
  background: #ffffff;
}

.blue {
  background: #8ff9f9;
}

.red {
  background: #f2b9b9;
}
</style>

<script type="text/javascript">
      function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
  
</script>
</script>
</html>