<?php
//$elements = $this->label->view(1);
 ?>
  <!-- JQuery DataTable Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet"> 

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Complaints pending for filing in software.</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Acknowledgements received and pending for filing</li> 
      </ol>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">

                  <span id="success_message"></span>
                  <table id="mytable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                           
                    <thead>
                           
                      <th><!--<input type="checkbox" id="checkall" />-->S.No.</th>
                      <th style="width: 15px;">Select</th>
                      <th>Date of receipt at counter</th>
                      <th>Acknowledgement no</th>
                      <!--<th>Diary no</th>-->
                      <th>Status</th>
                      <th>Action</th>
                      <th>Physical copy received from receipt counter</th>
                              

                    </thead>
                    <tbody>
                        <?php
                          $u = $user['id'];
                          $c = 1;

                         // echo "<pre>";
                         // print_r($user_comps);
                            foreach($user_comps as $row):
                              $r = $row->ref_no;
                              $counter_det =  get_ackno($r);
                      ?>
                      <tr>
                        <td><?php echo $c++; ?></td>

                         <td> <input type="checkbox" name="mycheck_[]" value="<?php echo $row->id;?>"></td>

                        <td><?php echo get_displaydate($counter_det->entry_date); ?></td>
                        <!--<td><?php echo $r; ?></td>-->
                        <td><?php echo $counter_det->ack_no.'/'.$counter_det->cur_year;
                         ?></td>
                        <!--<td><?php if($row->filing_no){
                          echo $row->filing_no; 
                           }else{
                            echo "not generated";
                           } ?></td>-->
                        <td><?php if($row->filing_status == 't'){
                                    echo "Farwarded";
                                  }elseif($row->filing_status == 'f'){
                                    echo "Pending";
                                  }
                            ?></td>
                        <td>
                          <?php
                          $comp_no=get_filing_no($r, $u);
                          $status = $comp_no['status'];
                          if($status == 't' and $row->phisical_copy_received==''){ ?>
                          <a href="<?php echo base_url().'affidavit/affidavit_detail/'.$r ?>" target="_blank">Go to application</a>
                          <?php }elseif($row->phisical_copy_received=='t'){ ?>
                          <a href="<?php echo base_url().'filing/filing/'.$r ?>" target="_blank">Go to application for filing process</a>
                          <?php } ?>
                        </td>
                          
                          <td><?php if($row->phisical_copy_received=='f') {
                                    echo "No";
                                  }elseif($row->phisical_copy_received == 't'){
                                    echo "Yes";
                                  }
                                  elseif($row->phisical_copy_received == ''){
                                    echo "Please receive backlog data";
                                  }
                            ?></td>

                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                
                  </table>     
                </div>
                <button type="button" class="btn btn-success status_submit">
                   <!--<a href="<?php echo base_url() ?>affidavit/refsection">Click for Fresh case filing</a>-->
                    <!--Physical dak receive from Receipt Counter-->
                  Click to receive physical copy of complaint
                </button> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- =================== Complaints for Allocation to benches =============== -->
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
    <script src="<?php echo base_url();?>assets/admin_material/js/pages/tables/jquery-datatable.js"></script>


<script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click', '.status_submit', function(){

                var allids = [];
                $.each($("input[name='mycheck_[]']:checked"), function(){
                    allids.push($(this).val());
                });
                //alert("My favourite sports are: " + favorite.join(", "));



          var myJSON = JSON.stringify(allids);
         // alert(myJSON);

          if (allids && allids.length) {    

          $.ajax({
            url: '<?php echo site_url('counter/update_counter_filing_data'); ?>',
            type: 'POST',
           // data:{hearing_date:hearing_date, checkedValue:checkedValue},
            //data : myJSON,
            data : {allids:myJSON},
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.success == 'success'){
                   alert('Phisical dak received successfully for the selected case/s. You can procced to filing of complaint');
                   window.location.reload(); 
                }else{
                  alert('Error');
                }
                /*if(data.success){
                  console.log(data.success);
                  window.location.reload();
                }  */         
            }


          });
          }else{
            alert('Please select all options!');
          }
        });
      });

</script>


</html>



