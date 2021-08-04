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
    $("#complaint_allotment").validate({

      onkeyup: false,

      rules: {  
        order_date: "required",
        order_type:"required",   
        order_body: "required",
        newbench:"required",
        order_upload:{ accept: "application/pdf,image/jpg,image/jpeg" },

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
      order_upload:{ accept: "pdf,jpg and jpeg formats are allowed" },
    }
  });
    
  });


</script>

<style>


  #complaint_allotment div.error {
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
          <h4 class="page-title">Recording of Proceedings of the Hon'ble Bench
</h4>
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
                              <li><a href="<?php echo base_url(); ?>proceeding/dashboard_main_level2/0" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12"> 

        <?php if($recieved_from == 'A') { ?>
          <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>proceeding/action2'  name="complaint_allotment" enctype="multipart/form-data">
        <?php } else { ?>
          <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>proceeding/action'  name="complaint_allotment" enctype="multipart/form-data">
        <?php } ?>

                <div class="panel panel-primary">
                <div class="panel-heading">
                   <h4 class="panel-title">Any Other Previous Complaint:</h4>
                </div>

                <?php                      
                $previous_complaint_description=(array)$previous_complaint_description;
                $previous_complaint_description[0]->previous_complaint_description ?? '';
                if(isset($previous_complaint_description)) { 
                ?>                                  
                  <div class="panel-body">
                    <p><?php echo $previous_complaint_description[0]->previous_complaint_description ?? ''; ?></p>               
                  </div>
                </div>                                 
                <?php
                }
                ?>


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

        <?php if($last_proceeding != 0) { ?>
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


        <?php $agencydata= $this->agency_model->getAgencydata($filing_no);

          $agencydatahis= $this->agency_model->getAgencydata_his($filing_no);
          $ct=count($agencydata);
          if($ct > 0)
          {
             /*   $ageData=(array)$agencydata;

               // echo "<pre>";
                //print_r($ageData);
               $filing_no=$ageData[0]->filing_no ?? '';
               $bench_name=$ageData[0]->bench_name ?? '';
               $dt_submission=$ageData[0]->dt_submission ?? '';
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
          <div class="panel-heading">Fill Proceeding Details -</div>
          <div class="panel-body">
            <div class="row">
              <div class="error"><?php echo form_error('order_upload'); ?></div>
              <?php
                if($recieved_from == 'A'){
              ?>
              <div class="col-md-12 mb-15" id="">   
                <label for="select_an_option"><span style="color: red;">*</span>Select an option</label>    
                <select type="text" class="form-control chosen-single chosen-default" name="select_an_option" id="select_an_option" onchange="">
                  <option value="">--Select--</option>
                  <option value="1">Report is Complete</option>
                  <option value="2">Report is Incomplete</option>
                </select> 
                <div class="error"><?php echo form_error('select_an_option'); ?></div>
              </div>
            </div>

            <div class="row" id="" style="">
              <div class="col-md-6 mb-15">
                 <label for="order_date"><span style="color: red;">*</span>Order Date</label>
                <input type="text" class="form-control order_date datepicker" name="order_date" id="order_date"  placeholder="dd-mm-yyyy">
                <div class="error"><?php echo form_error('order_date'); ?></div>
              </div>

              <div class="col-md-6 mb-15">
                <label for="order_upload"><span style="color: red;">*</span>Order Upload</label>
                <input type="file" class="form-control order_upload" name="order_upload" id="order_upload">
              </div>
            </div>

            <div id="complete_div" style="display: none;" class="row">
              <div class="col-md-12">
                <div class="alert alert-info">Note: Complaint will be forwarded to HCP</div>
              </div>
            </div>
            <div class="row">
              <?php
                }else{
              ?>
              <div class="col-md-4 mb-15">
                <label for="order_date"><span style="color: red;">*</span>Order Date</label>
                <input type="text" class="form-control order_date datepicker" name="order_date" id="order_date"  placeholder="dd-mm-yyyy">
                <div class="error"><?php echo form_error('order_date'); ?></div>
              </div>

              <div class="col-md-4 mb-15">
                <label for="order_type" ><span style="color: red;">*</span>Order Type</label>    
                <select type="text" class="form-control order_type chosen-single chosen-default" name="order_type" id="order_type" onchange="javascript:concerned_agency();">
                  <option value="">-- Select Order Type --</option>
                  <?php foreach($order_type as $row):?>              
                   <option value="<?php echo $row->ordertype_code;?>"> <?php echo $row->ordertype_name; ?> </option>
                 <?php endforeach;?>
                </select> 
                <div class="error"><?php echo form_error('order_type'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="other_action_div" style="display: none;">
                <label for="other_action" ><span style="color: red;">*</span>Other Action</label>    
                <select type="text" class="form-control other_action chosen-single chosen-default" name="other_action" id="other_action" onchange="javascript:concerned_agency();">
                  <option value="">-- Select Other Action --</option>
                  <?php foreach($other_action  as $row):?>              
                   <option value="<?php echo $row->ordertype_code;?>"> <?php echo $row->ordertype_name; ?> </option>
                 <?php endforeach;?>
                </select> 
                <div class="error"><?php echo form_error('other_action'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="status_rep_dept_div" style="display: none;">
                <label for="status_rep_dept"><span style="color: red;">*</span>Concerned Department/Agency</label>
                <input type="text" class="form-control" name="status_rep_dept" id="status_rep_dept">
              </div>

              <div class="col-md-4 mb-15" id="additional_doc_div" style="display: none;">
                <label for="additional_doc"><span style="color: red;">*</span>Additional Documents</label>
                <input type="text" class="form-control" name="additional_doc" id="additional_doc">
              </div>

              <div class="col-md-4 mb-15" id="others_ordertype_div" style="display: none;">
                <label for="others_ordertype"><span style="color: red;">*</span>Detail of Action</label>
                <input type="text" class="form-control" name="others_ordertype" id="others_ordertype">
              </div>


              <div class="col-md-4 mb-15" id="conce_agencydiv" style="display: none;">   
                <label for="conce_agency" ><span style="color: red;">*</span>Concerned Agency</label>    
                <select type="text" class="form-control chosen-single chosen-default" name="conce_agency" id="conce_agency" onchange="javascript:other_agn();">
                  <option value="">Select concerned agency</option>
                </select> 
                <div class="error"><?php echo form_error('conce_agency'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="psdetailsdiv" style="display: none;">   
                <label for="conce_agency" ><span style="color: red;">*</span>PS Details</label>    
                <textarea class="form-control" id="psdetails" name="psdetails" rows="4" cols="50" readonly>
                </textarea> 
                <div class="error"><?php echo form_error('psdetails'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="otheragndiv" style="display: none;">
                <label for="other_agency_name"><span style="color: red;">*</span>Name of Department</label>
                <input type="text" class="form-control" name="other_agency_name" id="other_agency_name">
              </div>

              <div class="col-md-4 mb-15" id="duedate_div" style="display: none;">   
                <label for="duedate">Due Date</label>
                <input type="text" class="form-control duedate datepicker" name="duedate" id="duedate"  placeholder="dd-mm-yyyy">
                <div class="error"><?php echo form_error('duedate'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="closure_div" style="display: none;">   
                <label for="closure_type"><span style="color: red;">*</span>Do you want to proceed against the complainant under section 46?</label>    
                <select type="text" class="form-control chosen-single chosen-default" name="closure_type" id="closure_type">
                  <option value="">Select</option>
                  <option value="no">No</option>
                  <option value="yes">Yes</option>
                </select> 
                <div class="error"><?php echo form_error('closure_type'); ?></div>
              </div>

              <div class="col-md-4 mb-15" id="adj_div" style="display: none;">   
                <label for="adj_date"><span style="color: red;">*</span>Next date of hearing</label>
                <input type="text" class="form-control adj_date datepicker" name="adj_date" id="adj_date"  placeholder="dd-mm-yyyy">
                <div class="error"><?php echo form_error('adj_date'); ?></div>
              </div>

              <div class="col-md-4 mb-15">
                <label for="order_upload"><span style="color: red;">*</span>Order Upload</label>
                <input type="file" class="form-control order_upload" name="order_upload" id="order_upload">
              </div>
              <?php
                }
              ?>
            </div> 


            <div class="row">
              <div class="col-md-12 mb-15">
                 <label for="remarks">Remarks if any</label>
                <input type="text" class="form-control" name="remarks" id="remarks"  placeholder="remarks...">
              </div>
            </div>

            <input type="hidden" id="filing_no" value="<?php echo $filing_no; ?>" name="filing_no">
            <input type="hidden" value="<?php echo $listing_date; ?>" name="listing_date">
            <input type="hidden" value="<?php echo $bench_no; ?>" name="bench_no">
            <input type="hidden" value="<?php echo $flag; ?>" name="flag">
            <input type="hidden" value="<?php echo $coram[0]['bench_id']; ?>" name="bench_id">
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
      function concerned_agency()
    {
      otheragndiv.style.display="none";
      let concerned_div = document.getElementById('conce_agencydiv');
      let psdetails_div = document.getElementById('psdetailsdiv');
      let order_type = $('#order_type').children("option:selected").val();
      //alert(order_type);
      let order_type_2 = $('#other_action').children("option:selected").val();
      let filing_no = document.getElementById("filing_no");
      if(order_type == 1 || order_type == 2){
        status_rep_dept_div.style.display="none";
        additional_doc_div.style.display="none";
        other_action_div.style.display="none";
          closure_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          others_ordertype_div.style.display="none";
          concerned_div.style.display="";
          duedate_div.style.display="";
          jQuery.ajax({
            url: baseURL+'proceeding/get_concer_agency',
            cache: false,
            type : 'post',
            data : 'order_type='+order_type,
            dataType : 'JSON',
            success: function(data) {
              console.log(data);
              var agencyOptions = "";
              for (key in data) {
                agencyOptions += "<option value="+data[key]['agency_code']+">" + data[key]['agency_name'] + "</option>";
              }
              document.getElementById("conce_agency").innerHTML = agencyOptions;
            }
          });
         }
         else if(order_type == 3 || order_type == 7){
          //alert(filing_no.value);
          status_rep_dept_div.style.display="none";
          additional_doc_div.style.display="none";
          other_action_div.style.display="none";
          closure_div.style.display="none";
          concerned_div.style.display="none";
          adj_div.style.display="none";
          others_ordertype_div.style.display="none";
          psdetails_div.style.display="";
          duedate_div.style.display="";
          jQuery.ajax({
            url: baseURL+'proceeding/get_ps_data',
            cache: false,
            type : 'post',
            data : 'filing_no='+filing_no.value,
            dataType : 'JSON',
            success: function(data) {
              console.log(data.fullname);
              var content = "Name: "+data.fullname+"\n Designation: "+data.desg+"\n Organisation: "+data.org;
              $("#psdetails").val(content);
            }
          });
         }
         else if(order_type == 4){
          status_rep_dept_div.style.display="none";
          additional_doc_div.style.display="none";
          other_action_div.style.display="none";
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          closure_div.style.display="none";
          others_ordertype_div.style.display="none";
          duedate_div.style.display="none";
          adj_div.style.display="";
         }
         else if(order_type == 5 || order_type == 8 || order_type == 9){
          status_rep_dept_div.style.display="none";
          additional_doc_div.style.display="none";
          other_action_div.style.display="none";
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          others_ordertype_div.style.display="none";
          duedate_div.style.display="none";
          closure_div.style.display="";
         }
         else if(order_type_2 == 6){
          status_rep_dept_div.style.display="none";
          additional_doc_div.style.display="none";
          other_action_div.style.display="";
          additional_doc_div.style.display="none";
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          closure_div.style.display="none";
          duedate_div.style.display="";
          others_ordertype_div.style.display="";
         }
        else if(order_type_2 == 12){
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          closure_div.style.display="none";
          duedate_div.style.display="none";
          others_ordertype_div.style.display="none";
          other_action_div.style.display="";
          status_rep_dept_div.style.display="";
          additional_doc_div.style.display="none";
         }
        else if(order_type_2 == 13){
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          closure_div.style.display="none";
          duedate_div.style.display="none";
          others_ordertype_div.style.display="none";
          status_rep_dept_div.style.display="none";
          other_action_div.style.display="";
          additional_doc_div.style.display="";
          duedate_div.style.display="";
         }
        else if(order_type == 14){
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          adj_div.style.display="none";
          closure_div.style.display="none";
          duedate_div.style.display="none";
          others_ordertype_div.style.display="none";
          other_action_div.style.display="";
         }
         else{
          status_rep_dept_div.style.display="none";
          additional_doc_div.style.display="none";
          other_action_div.style.display="none";
          concerned_div.style.display="none";
          psdetails_div.style.display="none";
          closure_div.style.display="none";
          adj_div.style.display="none";
          others_ordertype_div.style.display="none";
          duedate_div.style.display="none";
         }
        }

  function other_agn()
    {
      let agn_name = $('#conce_agency').children("option:selected").val();
      if(agn_name == 4 || agn_name == 8){
          //alert(filing_no.value);
          //concerned_div.style.display="none";
          otheragndiv.style.display="";
         }
         else{
          //concerned_div.style.display="none";
          otheragndiv.style.display="none";
         }
        }

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
