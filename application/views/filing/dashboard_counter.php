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

 </style>
  
 </head>
 <body> 
  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    
        
        <!-- /.box-header -->
        <div class="box-body" >
 
 <fieldset>
   <div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;">List of envelope recieved -</b></legend>   

  </div>

        <div class="table-responsive">

                <span id="success_message"></span>
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
                   <th>Date of recieving</th>
                   <!--<th>Reference no</th>-->
                   <th>Acknowledgement no</th>
                   <th>Diary no</th>
                     <th>Status</th>
              
                   </thead>
    <tbody>
        <?php
          $u = $user['id'];
          $c = 1;
            foreach($user_comps as $row):
              $r = $row->ref_no;
              $counter_det =  get_ackno($r);
      ?>
      <tr>
        <td><?php echo $c++; ?></td>
        <td><?php echo get_displaydate($counter_det->entry_date); ?></td>
        <!--<td><?php echo $r; ?></td>-->
        <td><?php echo $counter_det->ack_no.'/'.$counter_det->cur_year;
         ?></td>
        <td><?php if($row->filing_no){
          echo $row->filing_no;
           } ?></td>
        <td><?php if($row->filing_status == 't'){
                    echo "Application submitted";
                  }elseif($row->filing_status == 'f'){
                    echo "Not submitted";
                  }
            ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
        
</table>

<div class="clearfix"></div>
                
            </div>

   </fieldset>
        </div>
      </div>
    </div>

<div class="col-md-2">  </div>
</section>
</body></html>



