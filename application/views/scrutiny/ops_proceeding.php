<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>

  <script language="javascript"> 
    $().ready(function() {
    $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '-3d'
    });

    // validate signup form on keyup and submit
    $("#ops_proceeding").validate({

      onkeyup: false,

      rules: { 
       dt_submission:"required",
        contact_no:"required",
        team_lead_nm: "required",
        report_upload:"required",
        email_id:"required",        
        report_upload:{ accept: "application/pdf,image/jpg,image/jpeg" },

        username: {
          required: true,
          minlength: 6,
          maxlength:12,     

        },
        password: {
          required: true,
          minlength: 8
        },
        confirm_password: {
          //required: false,
         // minlength: 8,
         equalTo: "#password"
       },
       a_co_email_id: {
        email: true,          
      },
      topic: {
        required: "#newsletter:checked",
        minlength: 2
      },

      phone:{ 
        required:true,
        minlength:10,
        maxlength:10

      },
       gender: { // <- NAME of every radio in the same group
        required: true
      },

      agree: "required"
    },



    messages: {
       select_an_option:"Please select option",
       contact_no:"Please enter contact detail",
       report_upload:"Please upload the order",
        team_lead_nm:"Please enter team lead name",
        email_id:"Please enter email-id",
      order_type: "Please select type of order",
      order_body: "Please enter order body",
      order_date: "Please enter date of order",
        username_err: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 6 characters",
          remote: "UserName Already Exist"
        },
        password_err: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long"
        },
        cpassword_err: {
         // required: "Please provide a password",
         minlength: "Your confirm password must same as password",
         equalTo: "Please enter the same password as above"
       },
       email_err: {
        required: "Please provide a email address",
        email: "Please enter a valid email address",
        remote: "email address Already Exist"
      },
      phone_err: {
        required: "Please provide a phone no",
        minlength: "Your phone no must be at least 10 digit number",
        maxlength: "Your phone no must be at least 10 digit number"
      },
      gender_err: {
        required: "Please select at least one gender"
      },
      report_upload:{ accept: "only pdf formats are allowed" },
    }
  });
    
  });


</script>

<style>


  #ops_proceeding div.error {
    color: red;
    margin-left: 80px;
    font-size:15px;
    padding: inherit;
  }
  .table{
    border: 1px solid #ddd;
  }

</style>



<?php 
            $curYear = date('Y');
            $curMonth = date('m');
            $curDay = date('d');
            $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
            $cur_date12 = $curDay.'-'.$curMonth.'-'.$curYear;
            $dt_submission=$cur_date12;
                            

  //$this->load->model('agency_model');
  $filing_no=$filing_no;

  $part_A= $this->agency_model->getDisplayPar_A($filing_no);

  //echo "<pre>";
  //print_r($part_A);

  $part_a=(array)$part_A;
  $item1=$part_a[0]->complaint_capacity_desc ?? '';
  $item2=$part_a[0]->Identity_proof_desc ?? '';
  $item101=$part_a[0]->tel_no ?? '';
  $item102=$part_a[0]->mob_no ?? '';
  $item11=$part_a[0]->email_id ?? '';
  $item12=$part_a[0]->complaintmode_desc ?? '';
  $item14=$part_a[0]->complainant_victim ?? '';
  $ref_no=$part_a[0]->ref_no ?? '';
  $affid_upl=$part_a[0]->affidavit_upload ?? '';
  if($item14=='1')
  {
    $item14='Yes';
  }
  else
  {
    $item14='No';
  }
  $part_c= $this->agency_model->getDisplayPar_C($filing_no);
  $item91 =$part_c['periodf_coa'] ?? '';
  $item92 =$part_c['periodt_coa'] ?? '';
  $ps_pl_occ =$part_c['ps_pl_occ'] ?? '';
  $name =$part_c['name'] ?? '';
  $sum_facalle =$part_c['sum_facalle'] ?? '';
  $det_offen =$part_c['det_offen'] ?? '';
  $prov_viola =$part_c['prov_viola'] ?? '';
  $relied_doc_list =$part_c['relied_doc_list'] ?? '';
  $any_othInfo =$part_c['any_othInfo'] ?? '';
  $doc_copy_attached =$part_c['doc_copy_attached'] ?? '';
  $electronic_file =$part_c['electronic_file'] ?? '';
  if($doc_copy_attached=='1')
  {
    $doc_copy_attached='Yes';
  }
  else
  {
    $doc_copy_attached='No';
  }
  
  if($electronic_file=='1')
  {
    $electronic_file='Yes';
  }
  else
  {
    $electronic_file='No';
  } 
  $ps_pl_stateid=$part_c['ps_pl_stateid'] ?? '';
  $ps_pl_dist_id=$part_c['ps_pl_dist_id'] ?? '';
  $sql="select name,district_code from master_address where state_code=".$ps_pl_stateid." and
            district_code=".$ps_pl_dist_id." and sub_dist_code=0 and village_code=0 and display='TRUE' order by name asc";      
            $query  = $this->db->query($sql)->result();
           $distt=$query[0]->name ?? '';  
?>


    <div class="app-content">
      <div class="main-content-app">
        <div class="page-header">
         <!-- <h4 class="page-title">Recording of Proceedings of the Hon'ble Bench
</h4>-->
         <!-- <ol class="breadcrumb"> 
          <li class="breadcrumb-item"><a href="#">Dashoard</a></li>
          <li class="breadcrumb-item">Complaint Proceedings Form</li>
          </ol>-->
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                            <span>
                              <strong>Complaint no.</strong> <?php echo get_complaintno($filing_no); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                              <strong>Diary no.</strong> <?php echo $filing_no; ?>
                            </span>
                            <ul class="more-action">
                              <li><a href="<?php echo base_url(); ?>scrutiny/ps_report_chk/<?php echo $flag;?>" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12"> 

      
          <form id="ops_proceeding" class="form-horizontal" role="form" method="post" action='<?= base_url();?>scrutiny/ops_proceeding_action'  name="ops_proceeding" enctype="multipart/form-data">
        <?php 
                  
          if(isset($summary)) { 
        ?>
        <div class="panel panel-primary">
          <div class="panel-heading">Summary of Complaint(By Scrutiny section) :
</div>
          <div class="panel-body">
            <div class="alert alert-success">
              <strong><?php print_r($summary); ?></strong>
            </div>

                <?php if(isset($last_remarks)) { ?>

                <div class="blockquote-remark">
                    <strong><?php  echo "Remarks by ".$last_remarkedby; ?> :-</strong>
                    <em><?php echo $last_remarks;?></em>
                </div>

                <?php } ?>
                <?php if(isset($remark_history)) { ?>
                <?php foreach($remark_history as $row):
                if($row->remarks != '') {
                ?>
                <div class="blockquote-remark">
                    <strong><?php echo "Remarks by ".get_remarkedby_name($row->remarkd_by); ?> :-</strong>
                    <em><?php echo $row->remarks; ?></em>
                </div>
                <?php
                }
                endforeach;
                } 
                ?>
          </div>
        </div>
        <?php
            }
        ?>
        <div class="panel panel-primary">
          <div class="panel-heading">Part A Details -</div>
          <div class="panel-body">
            <table class="table table-striped">
              <tbody id="parta-info">
                <tr>
                  <td style="width: 30%;">
                    <strong for="complaint_capacity_id"><?php print_r($this->label->get_short_name($elements, 8)); ?></strong>
                    
                  </td>
                  <td style="width: 1%;">:</td>
                  <td style="width: 19%;">
                    <span><?php echo $item1;?></span>
                  </td>

                  <td style="width: 30%;">
                    <strong for="identity_proof_id"><?php print_r($this->label->get_short_name($elements, 18)); ?></strong>
                    
                  </td>
                  <td style="width: 1%;">:</td>
                  <td style="width: 19%;">
                    <span><?php echo $item2;?></span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong for="tel_no"><?php print_r($this->label->get_short_name($elements, 44)); ?></strong>
                  </td>
                  <td>:</td>
                  <td><span><?php echo $item101;?></span></td>
                  <td>
                    <strong for="mob_no"><?php print_r($this->label->get_short_name($elements, 45)); ?></strong>
                  </td>
                  <td>:</td>
                  <td><span> <?php echo $item102;?></span></td>
                </tr>

                <tr>
                  <td>
                    <strong for="email_id"><?php print_r($this->label->get_short_name($elements, 46)); ?></strong>
                  </td>
                  <td>:</td>
                  <td><span> <?php echo $item11;?></span></td>
                  <td>
                    <strong for="complaintmode_id" ><?php print_r($this->label->get_short_name($elements, 9)); ?></strong>
                    
                  </td>
                  <td>:</td>
                  <td><span> <?php echo $item12;?></span></td>
                </tr>
                <tr>
                  <td>
                    <strong for="notory_affi_annex"><?php print_r($this->label->get_short_name($elements, 47)); ?></strong> 
                    
                  </td>
                  <td>:</td>
                  <td><span> <?php echo $item14;?></span></td>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Part C Details -</div>
          <div class="panel-body">
            <table class="table table-striped">
              <tbody id="partc-info">
                <tr>
                  <td style="width: 30%;">
                      <strong for="periodf_coa"><?php print_r($this->label->get_short_name($elements, 143)); ?></strong>
                      
                    </td>
                    <td style="width: 1%;">:</td>
                    <td style="width: 19%;">
                      <span> <?php echo get_entrydate($item91);?></span>
                    </td>

                    <td style="width: 30%;">
                      <strong for="periodt_coa"><?php print_r($this->label->get_short_name($elements, 144)); ?></strong>
                      
                    </td>
                    <td style="width: 1%;">:</td>
                    <td style="width: 19%;">
                      <span> <?php echo get_entrydate($item92);?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong for="ps_pl_occ"><?php print_r($this->label->get_short_name($elements, 145)); ?></strong>       
                      
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $ps_pl_occ;?></span>
                    </td>
                    <td>
                     <strong for="ps_pl_stateid"><?php print_r($this->label->get_short_name($elements, 92)); ?></strong>       
                      
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $name;?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <strong for="ps_pl_dist_id"><?php print_r($this->label->get_short_name($elements, 93)); ?></strong>
                      
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $distt;?></span>
                    </td>

                    <td>
                     <strong for="sum_facalle"><?php print_r($this->label->get_short_name($elements, 147)); ?></strong>   
                             
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $sum_facalle;?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong for="det_offen"><?php print_r($this->label->get_short_name($elements, 148)); ?></strong>    
                               
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $det_offen;?></span>
                    </td>
  
                    <td>
                      <strong for="prov_viola"><?php print_r($this->label->get_short_name($elements, 149)); ?></strong>  
                                
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $prov_viola;?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong for="prov_viola">Relied Doc List</strong>  
                                
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $relied_doc_list;?></span>
                    </td>
                    <td>
                      <strong for="prov_viola">Any Other Info</strong>  
                                
                    </td>
                    <td>:</td>
                    <td>
                      <span> <?php echo $any_othInfo;?></span>
                    </td>
                 </tr>

                <tr>
                  <td>
                    <strong for="doc_copy_attached"><?php print_r($this->label->get_short_name($elements, 151)); ?></strong>
                              
                  </td>
                  <td>:</td>
                  <td>
                    <span> <?php echo $doc_copy_attached;?></span>
                  </td>

                  <td>
                    <strong for="electronic_file"><?php print_r($this->label->get_short_name($elements, 152)); ?></strong> 
                              
                  </td>
                  <td>:</td>
                  <td><span> <?php echo $electronic_file;?></span></td>
                </tr>
                <tr>
                  <td>
                    <strong for="sum_facalle">Preview complaint:</strong>   
                        
                    </td>
                    <td>:</td>
                    <td colspan="4">
                      <a href="<?php echo base_url().'cdn/complainpdf/'.$ref_no.'.'.'pdf' ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Go to application</a>  
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="<?php echo base_url();?><?php echo $affid_upl; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Show Affidavit uploaded 
                      </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <?php if($all_benches != 0) { ?>
        <div class="panel panel-primary">
          <div class="panel-heading">Bench Details -</div>
          <div class="panel-body">

            <?php foreach ($all_benches as $key => $value) { 
              if($value['bench_no'] == 0){
              $bench_no_display = 'Full Bench';
              }else{
                $bench_no_display = $value['bench_no'];
              }
            ?>
            <div class="span6" id="">
            <?php //print_r($coram);
            ?>
              <table class="table table-bordered">
                <tbody id="benches-his" class="text-center">
                  <tr class='info'><td colspan='4'><b>Bench no: <?php echo $bench_no_display; ?></b></td></tr>
                  <tr class='info'><td><b>Hearing date: <?php echo get_displaydate($value['listing_date']); ?></b></td><!--<td><b>Nature: <?php echo get_bench_nature($value['bench_nature']); ?></b></td><td><b>court no: <?php echo $value['court_no']; ?></b></td>--></tr>
                  <tr class='info'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>
                  <?php $sn = 1;
                  foreach ($value['judges_array'] as $key => $value2) { ?>
                    <tr class='info'><td colspan='3'><b><?php echo $sn.'. '; ?></b><?php echo $value2['judge_name']; ?></td></tr>
                    <?php $sn ++; 
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php } 
         }
        ?>

        <?php 

          



        if($last_proceeding != 0) { ?>
        <div class="panel panel-primary">
          <div class="panel-heading">Previous proceeding details -</div>
          <div class="panel-body">
            <table class="table">
              <tbody id="proceeding-info">
                <tr class='error'>
                  <th style="width:10px;">S.No.</th>
                  <th style="width:100px;">Order date</th>
                  <th>Order type</th>
                  <th>Agency</th>
                  <th> Preview Order</th>
                </tr>
                <?php
                $sno = 1;
                foreach($last_proceeding as $row):
                  ?>
                <tr>
                  <td style="width:10px;"><?php echo $sno++.'.'; ?></td>
                  <td style="width:100px;"><?php echo get_displaydate($row->order_date); ?></td>
                  <td><?php echo get_order_type($row->ordertype_code); ?></td>
                  <td><?php echo get_agn_name($row->agency_code); ?></td>
                  <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt="">Preview uploaded order</a></td>
                </tr>
                <?php endforeach; 
                if($proceeding_his != 0){
                  foreach($proceeding_his as $row):
                ?>
                <tr>
                  <td style="width:10px;"><?php echo $sno++.'.'; ?></td>
                  <td style="width:100px;"><?php echo get_displaydate($row->order_date); ?></td>
                  <td><?php echo get_order_type($row->ordertype_code); ?></td><td><?php echo get_agn_name($row->agency_code); ?></td>
                  <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt="">Preview uploaded order</a></td>
                </tr>
                <?php endforeach; 
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>


        <?php 


        $agencydata= $this->agency_model->getAgencydata($filing_no);

          // echo "<pre>";
              //  print_r($agencydata);die;


          $agencydatahis= $this->agency_model->getAgencydata_his($filing_no);
          $ct=count($agencydata);
          if($ct > 0)
          {
             /*   $ageData=(array)$agencydata;

               // echo "<pre>";
                //print_r($ageData);
               $filing_no=$ageData[0]->filing_no ?? '';
               $bench_name=$ageData[0]->bench_name ?? '';
               $ops_proceeding=$ageData[0]->ops_proceeding ?? '';
               $team_lead_nm=$ageData[0]->team_lead_nm ?? '';
               $contact_no=$ageData[0]->contact_no ?? '';
               $email_id=$ageData[0]->email_id ?? '';
               $bench_no=$ageData[0]->bench_no ?? '';
               $listing_date=$ageData[0]->listing_date ?? '';
               $report_upload=$ageData[0]->report_upload ?? '';*/
                
        ?>

        <div class="panel panel-primary">
          <div class="panel-heading">Agency Details-</div>
          <div class="panel-body">
            <table class="table">
              <tbody id="proceeding-info">
                <tr class='error'>
                  <th style="width:10px;">S no.</th><th style="width:100px;">Date of Submission</th><th>Agency</th><th>Submitted by</th><th>Contact Number</th><th>Email Id</th><th> Preview Report</th>
                </tr>
                <?php
                $sno = 1;
                foreach($agencydata as $row):
                  ?>
                <tr>
                <td style="width:10px;"><?php echo $sno++.'.'; ?></td><td style="width:100px;"><?php echo get_displaydate($row->dt_submission); ?></td><td><?php echo get_agn_name($row->agency_code); ?></td><td><?php echo ($row->team_lead_nm); ?></td><td><?php echo ($row->contact_no); ?></td><td><?php echo $row->email_id; ?></td><td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt="">Preview uploaded report</a></td>
              </tr>
              <?php endforeach; 
                if($agencydatahis != 0){
                foreach($agencydatahis as $row):
              ?>
                    <tr>
                <td style="width:10px;"><?php echo $sno++.'.'; ?></td><td style="width:100px;"><?php echo get_displaydate($row->dt_submission); ?></td><td><?php echo get_agn_name($row->agency_code); ?></td><td><?php echo ($row->team_lead_nm); ?></td><td><?php echo ($row->contact_no); ?></td><td><?php echo $row->email_id; ?></td><td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt="">Preview uploaded report</a></td>
              </tr>
              <?php endforeach; 
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>

        <div class="panel panel-primary">
          <div class="panel-heading">Fill Public Servant Details -</div>
          <div class="panel-body">
          

          <div class="row">
            <div class="col-md-3 mb-15">
              <label for="dt_submission"><span class="text-danger">*</span>Date of Submission</label>
              <input type="text" class="form-control" name="dt_submission" id="dt_submission" value="<?php echo $dt_submission;?>" placeholder="">
            </div>
     
            <div class="col-md-6 mb-15">
              <label for="team_lead_nm"><span class="text-danger">*</span>Submitted by(Name of the officer with designation)</label>     
              <input type="text" class="form-control" name="team_lead_nm" id="team_lead_nm" maxlength="50" onkeypress="return ValidateAlpha(event)" placeholder="">        
            </div>

            <div class="col-md-3 mb-15">
              <label for="contact_no"><span class="text-danger">*</span>Contact No</label>
              <input type="text" class="form-control" name="contact_no" id="contact_no" maxlength="15"  onkeypress="return isNumberKey(event)" placeholder="">
            </div>
          </div>

            <div class="row">
            <div class="col-md-3 mb-15">
              <label for="email_id"><span class="text-danger">*</span>Email Id</label>
              <input type="text" class="form-control" name="email_id" id="email_id" maxlength="50" placeholder="">
            </div>
            <div class="col-md-3 mb-15">
              <label for="report_upload"><span class="text-danger">*</span>Report Upload</label>
              <input type="file" id="report_upload" name="report_upload" class="form-control" accept=".pdf" size="20">  
            </div>
            
          </div>

            <div class="row">
            <div class="col-md-12 mb-15">
              <label for="report_content">Remarks if any</label>      
              <textarea class="form-control" name="report_content" id="report_content" maxlength="500"  rows="3" cols="50" wrap="hard"></textarea>       
            </div>
          </div> 

         
            <div id="complete_div" style="display: none;" class="row">
              <div class="col-md-12">
                <div class="alert alert-info">Note: Complaint will be forwarded to HCP</div>
              </div>
            </div>

            <div class="row"> 
            

            <input type="hidden" id="filing_no" value="<?php echo $filing_no; ?>" name="filing_no">
            <input type="hidden" value="<?php echo $listing_date; ?>" name="listing_date">
            <input type="hidden" value="<?php // echo $bench_no; ?>" name="bench_no">
            <input type="hidden" value="<?php echo $flag; ?>" name="flag">
            <input type="hidden" value="<?php echo $coram[0]['bench_id']; ?>" name="bench_id">
            <input type="hidden" value="<?php echo $ordertype_code; ?>" name="ordertype_code">
            <input type="hidden" value="<?php echo $bench_no; ?>" name="bench_no">
            <!--<input type="hidden" value="<?php echo $bench_nature; ?>" name="bench_nature">
            <input type="hidden" value="<?php echo $coram[0]['court_no']; ?>" name="court_no">-->
            <input type="hidden" value="<?php echo get_complaintno($filing_no); ?>" name="complaint_no">


            <div class="row">
              <div class="col-md-12" align="center">      
                <button type="submit" class="btn btn-success" id="submitbtn">Confirm & Send</button>      
              </div>
            </div>
          </div>
        </div>

          </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">


   $(document).ready(function () {
                 autoclose: true,  
                $('#dt_submission').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });    

  function an_option()
    {
      let option_sel = $('#select_an_option').children("option:selected").val();
      let incomplete_div = document.getElementById('incomplete_div');
      if(option_sel == 1){   //complete
        incomplete_div.style.display="none";
        complete_div.style.display="";
        }
        else if(option_sel == 2){
          complete_div.style.display="none";
          incomplete_div.style.display="";
        }
      }
</script>
