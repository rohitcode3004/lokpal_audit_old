<?php
//$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  

<style type="text/css">
   .navbar-nav>li .active {
    color: green !important;
  } 

  tr.error{
    background-color: #cd5c5c !important;
  }
  /*  tr.onece {
  background: #8ff9f9 !important;
}

tr.secylce{
  background-color: #f2b9b9 !important;
}*/

.foo {
  float: left;
  width: 20px;
  height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}
.time-list{
  list-style: outside none;
  margin: 0;
  padding: 0;
}
.time-list li{
    display: inline;
    float: left;
    margin-right: 20px;
}
.time-list li span{
  float: left;
    width: 16px;
    height: 16px;
    margin-right: 10px;
    border: 1px solid #ddd;
}
.list-white {
  background: #ffffff;
}

.list-blue {
  background: #8ff9f9;
}

.list-red {
  background: #f2b9b9;
}
</style>

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Dashboard for Agency</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('agency/dashboard_main'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Dashboard for Agency</li> 
      </ol>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Details of complaints pending for agency  -
            
                            <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>agency/dashboard_main" class="previous">&laquo; Back</a></li>
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
     echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>
     <h4>'.$this->session->flashdata('error_msg').'</h4></div>';
    }
    if($this->session->flashdata('upload_error'))
    {
     echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>
     <h4>'.$this->session->flashdata('upload_error').'</h4></div>';
    }

    ?>                

        <div class="table-responsive">

          <span id="success_message"></span>
          <table id="mytable" class="table table-bordered table-striped">

            <thead>

              <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
              <th>Complaint no</th>
              <th>Complaint against</th>
              <th>Order date</th>
              <!--<th>Preview</th>-->
              <th>Action</th>
            </thead>
            <tbody>
              <?php
              $c = 1;
              foreach($agency_data as $row):
              $agency_count = getAgencyCount($row->filing_no);
              ?>
              <form action="<?php echo base_url();?>agency/inquiry_investigation" method="post" id="">
                <tr  <?php if($agency_count == 1) { ?> class="onece" <?php } elseif($agency_count == 2) { ?> class="secylce" <?php } ?>>
                  <td><?php echo $c."."; $c++; ?></td>
                  <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
                  <td>
                   <?php
                    $against_name = get_against_name($row->filing_no);
                    if($against_name){
                      echo $against_name;
                  } ?>
                  </td>

                  <td>
                  <?php echo get_displaydate($row->order_date); ?>
                  </td>
                  <!--<td>
                  <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$row->ref_no ?>" target="_blank">Application preview</a>
                  </td>-->
                  <td>
                    <input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>">
                    <input type="hidden" name="listing_date" value="<?php echo $row->listing_date; ?>">
                    <input type="hidden" name="bench_no" value="<?php echo $row->bench_no; ?>">
                    <button class="btn btn-primary" type="submit" value="Submit">Details</button>
                  </td>
                </tr>
              </form>
              <?php endforeach;
                if(count($agency_data) == 0){ ?>
                  <tr><td colspan="8"> <h3>Nothing left. </h3></td></tr>
               <?php }
              ?>
            </tbody>
          </table>
        </div>
        
        <!--<ul class="time-list">
          <li><span class="list-white">&nbsp;</span>First time</li>
          <li><span class="list-blue">&nbsp;</span>Second time</li>
          <li><span class="list-red">&nbsp;</span>Third time</li>
        </ul>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>