<?php
//$elements = $this->label->view(1);
?>
 <link href="<?php echo base_url();?>assets/admin_material/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Dashboard for Scrutiny</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">Details of complaints pending for scrutiny</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Details of complaints pending for scrutiny
            <ul class="more-action">
              <li><a href="<?php echo base_url('scrutiny/dashboard_main'); ?>" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <?php
              if($this->session->flashdata('success_msg'))
              {
               echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4 class="m-0">'.$this->session->flashdata('success_msg').'</h4></div>';
              }
              if($this->session->flashdata('error_msg'))
              {
               echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>
               <h4 class="m-0">'.$this->session->flashdata('error_msg').'</h4></div>';
              }
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <span id="success_message"></span>
                  <table id="mytable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <th>S.No.</th>
                       <th style="width: 15px;">Select</th>
                      <th>Diary no.</th>
                      <th>Complaint no.</th>
                      <th>Complainant name</th>
                      <th>Complaint against</th>
                      <th>Date of Filing</th>
                      <th>Preview</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php
                      $c = 1;
                      foreach($scrpen_comps as $row):
                        $last_remarked_by = get_last_rem_id($row->filing_no);
                        $remarks_history = get_rem_his_helper($row->filing_no);
                        $key = 'none';
                        if(!empty($remarks_history))
                          $key = array_search(6, array_column($remarks_history, 'remarkd_by'));
                        ?>
                      <form action="<?php echo base_url();?>scrutiny/checklist" method="post" id="">
                        <tr <?php if($last_remarked_by == 6 || $last_remarked_by == 7 || $key == 'remarkd_by') { ?> class="secylce" <?php } ?>>
                          <td><?php echo $c++; ?></td>
                          <td> <input type="checkbox" name="mycheck_[]" value="<?php echo $row->filing_no;?>"></td>
                          <td><?php if($row->filing_no){
                            echo $row->filing_no;
                            $against_name = get_against_name($row->filing_no);
                          } ?></td>
                          <td><b><?php echo get_complaintno($row->filing_no); ?></b></td>
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
                             <a href="<?php echo base_url().'scrutiny/affidavit_detail_pre/'.$row->ref_no ?>" target="_blank">Application preview</a>

                           <!-- <span><a href="<?php echo base_url().'cdn/complainpdf/'.$row->ref_no.'.pdf' ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> pdf</strong></a></span> -->
                          </td>
                          <td>
                            <input type="hidden" name="filing_no" value="<?php echo $row->filing_no; ?>">
                            <?php if($role == 161 || $role = 162){ ?>
                            <button class="btn btn-primary" type="submit" value="Submit">Scrutiny</button>
                            <?php }elseif($role == 163 || $role == 164) { ?>
                            <button class="btn btn-primary" type="submit" value="Submit">Details</button>
                          <?php } ?>
                          </td>
                        </tr>
                      </form>
                      <?php endforeach; ?>
                    </tbody>      
                  </table>
                </div>
                 <div class="row">
                  <div class="col-md-12 mb-30">
                    <button type="button" class="btn btn-success status_submit">                 
                     Mark As Defective
                    </button> 
                  </div>
                </div>


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
            url: '<?php echo site_url('scrutiny/update_scrutiny_as_defective'); ?>',
            type: 'POST',
           // data:{hearing_date:hearing_date, checkedValue:checkedValue},
            //data : myJSON,
            data : {allids:myJSON},
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.success == 'success'){
                   alert('Complaint successfully mark as Defective');
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
            alert('Please select at least one case for Defective !');
          }
        });
      });

</script>

                <!--<ul class="time-list">
                  <li><span class="list-red "></span> Recieved from scrutiny bench</li>
                </ul>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>







