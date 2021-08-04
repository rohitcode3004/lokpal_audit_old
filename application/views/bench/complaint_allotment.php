<?php //include(APPPATH.'views/templates/front/header4.php'); 
$elements = $this->label->view(1);

?>

  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-datepicker.css" rel="stylesheet" />
  <?php 
//$this->load->model('agency_model');
$filing_no=$filing_no;

 $part_A= $this->agency_model->getDisplayPar_A($filing_no);

//echo "<pre>";
//print_r($part_A);die;

 $part_a=(array)$part_A;

 $first_name=$part_a[0]->first_name ?? '';
 $mid_name=$part_a[0]->mid_name ?? '';
 $sur_name=$part_a[0]->sur_name ?? '';
 $name_of_complaint= $first_name.' '.$mid_name.' '.$sur_name;

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
//echo "<pre>";
//print_r($part_c);
 $ps_first_name =$part_c['ps_first_name'] ?? '';
 $ps_mid_name =$part_c['ps_mid_name'] ?? '';
 $ps_sur_name =$part_c['ps_sur_name'] ?? '';
$public_servant_name=$ps_first_name.' '.$ps_mid_name.' '.$ps_sur_name;
 $ps_desig =$part_c['ps_desig'] ?? '';
 $ps_orgn =$part_c['ps_orgn'] ?? '';

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

 $sum_fact_allegation_upload=$part_c['sum_fact_allegation_upload'] ?? '';
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
                        <h4 class="page-title">Complaints Allotment</h4>
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?php echo base_url('bench/dashboard_main'); ?>">Dashboad</a></li> 
                            <li class="breadcrumb-item active" aria-current="page">Complaints Allotment</li> 
                        </ol>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <span>
                              <strong>Complaint no.</strong> <?php echo get_complaintno($filing_no); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                              <strong>Diary no.</strong> <?php echo $filing_no; ?>
                            </span>
                            <ul class="more-action">
                              <li><a href="<?php echo base_url(); ?>bench/dashboard_main" class="previous">&laquo; Back</a></li>
                            </ul>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <form id="complaint_allotment" class="form-horizontal" role="form" method="post" action='<?= base_url();?>bench/benchcreation'  name="complaint_allotment" enctype="multipart/form-data">

                                  <input type="hidden" name="filing_no" value="<?php echo $filing_no; ?>">
 
                                  <div class="form_error">
                                    <?php echo validation_errors(); 


                                    ?>
                                  </div>
                                    
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
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Summary of complaint:</h4>
                                    </div>
                                    <div class="panel-body">
                                      <p><?php print_r($summary); ?></p>

                                      <ul class="blockquote-remark">
                                        <?php
                                          if(isset($last_remarks)) {
                                        ?>
                                        <li>
                                          <h5><?php echo "Remarks by ".$last_remarkedby; ?> :-</h5>
                                          <p><?php echo $last_remarks;?></p>
                                        </li>
                                        <?php } if(isset($remark_history)) { ?>
                                        <?php foreach($remark_history as $row):
                                        if($row->remarks != '') {
                                        ?>
                                        <li>
                                          <h5><?php echo "Remarks by ".get_remarkedby_name($row->remarkd_by); ?>:-</h5>
                                          <p><?php echo $row->remarks; ?></p>
                                        </li>
                                        <?php
                                        }
                                        endforeach;
                                        } 
                                        ?>
                                      </ul>                                     
                                    </div>
                                  </div>                                 
                                  <?php
                                    }
                                  ?>




                                  
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Part A Details -</h4>
                                    </div>
                                    <div class="panel-body">
                                      <table class="table border">
                                        <tbody id="parta-info">
                                          <tr>
                                            <td>
                                              <strong><?php print_r($this->label->get_short_name($elements, 8)); ?>:</strong>
                                              <span><?php echo $item1;?></span>
                                            </td>
                                            <td>
                                                <strong>Name of the complainant:</strong>
                                                <button class="btn btn-primary show-name" type="button" data-toggle="collapse" name="disbutton" id="disbutton" data-target="#demo">Show Name</button>
                                                <div id="demo" class="collapse">
                                                  <?php echo $name_of_complaint;?>
                                                </div>
                                            </td>
                                           <!--
                                            <td>
                                               <label for="tel_no"><?php print_r($this->label->get_short_name($elements, 44)); ?></label>
                                               <span style="" font-size:15px;> <b>- <?php echo $item101;?></b></span>
                                             </td>
                                              <td>
                                                <label for="mob_no"><?php print_r($this->label->get_short_name($elements, 45)); ?></label>
                                                <span style="" font-size:15px;> <b>- <?php echo $item102;?></b></span>
                                             </td>
                                          -->

                                             <?php 
                                           $data['scrutiny_url'] = $this->scrutiny_model->get_scrutiny_url($filing_no);
                                                      $myArray=(array)$data['scrutiny_url']; ?>
                                                     <?php if($myArray[0]['scrutiny_def_url'] ?? '' !=''){?>
                                                     <td><a href="<?php echo base_url();?><?php echo $myArray[0]['scrutiny_def_url'] ?? ''; ?>.pdf" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Show scrutiny sheet</strong> </a>
                                                     </td> 
                                                     <?php }
                                                        else {
                                                      ?> 
                                                    <td></td>

                                                   <?php } ?>
                                           
                                          </tr>


                                          <tr>
                                          <?php
                                          $data['pdf_url'] = $this->scrutiny_model->part_pdf_abc_url_pdf($filing_no);


                                          //echo "<pre>";
                                          //print_r($data['pdf_url']);

                                           //$data['pdf_url'][0]['partapdf'];

                                          ?>
                                          <?php if($data['pdf_url'][0]['partapdf'] ?? '' !=''){?>
                                            <td><a href="<?php echo base_url().$data['pdf_url'][0]['partapdf'] ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Part-A PDF detail</strong> </a></td>
                                            <?php }  else
                                            { ?>
                                            <td></td>
                                            <?php } if($data['pdf_url'][0]['partbpdf'] ?? '' !=''){?>
                                            <td><a href="<?php echo base_url().$data['pdf_url'][0]['partbpdf'] ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Part-B PDF detail </strong></a></td>
                                            <?php }
                                            else {
                                            ?>
                                            <td></td>  

                                            <?php } ?>
                                            <td></td>

                                          </tr>

                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Part C Details -</h4>
                                    </div>
                                    <div class="panel-body">
                                      <table class="table table-bordered table-striped table-hover">
                                        <tbody id="partc-info">
                                          <tr>
                                            <td style="width: 25%;">
                                              <strong>Name of the public servant:</strong>
                                              <button class="btn btn-primary show-name" type="button" data-toggle="collapse" name="disbuttonc" id="disbuttonc" data-target="#democ">Show Name</button>
                                              <div id="democ" class="collapse"><?php echo $public_servant_name;?></div>
                                            </td>
                                            <td style="width: 20%;">
                                              <strong>Designation: </strong>
                                              <span><?php echo $ps_desig; ?></span>
                                            </td>
                                            <td style="width: 55%;">
                                               <strong for="prov_viola">Relied Doc List: </strong>  
                                               <span><?php echo $relied_doc_list;?></span>          
                                            </td>
                                          </tr>

                                          <tr>
                                            <td>
                                              <strong><?php print_r($this->label->get_short_name($elements, 143)); ?>: </strong>
                                              <span><?php echo get_entrydate($item91);?></span>
                                            </td>
                                            <td>
                                              <strong><?php print_r($this->label->get_short_name($elements, 144)); ?>: </strong>
                                              <span><?php echo get_entrydate($item92);?></span>
                                            </td>
                                            <td>
                                               <strong>Any Other Info: </strong>  
                                               <span><?php echo $any_othInfo;?></span>          
                                            </td>
                                            
                                          </tr>

                                          <tr>
                                            <td>
                                              <strong>Department: </strong> 
                                              <span><?php echo $ps_orgn; ?></span>
                                            </td>
                                            <td>
                                              <strong><?php print_r("Place of Occurance"); ?>: </strong>       
                                              <span><?php echo $ps_pl_occ;?></span>
                                            </td>
                                            <td>
                                              <strong><?php print_r($this->label->get_short_name($elements, 147)); ?>: </strong> 
                                              <?php if($sum_fact_allegation_upload !=''){?> 
                                              <a href="<?php echo base_url();?><?php echo $sum_fact_allegation_upload ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Show uploaded facts</strong></a>
                                              <?php } ?> 
                                            </td>
                                            
                                          </tr>

                                          <tr>
                                            <td>
                                              <strong><?php print_r("State"); ?>: </strong>       
                                              <span><?php echo $name;?></span>
                                            </td>
                                            <td>
                                              <strong><?php print_r("District"); ?>: </strong>
                                              <span><?php echo $distt;?></span>
                                            </td>
                                            <td>
                                              <strong><?php print_r($this->label->get_short_name($elements, 148)); ?>: </strong>    
                                              <span><?php echo $det_offen;?></span>         
                                            </td>
                                          </tr>

                                          <tr>
                                            <?php if($data['pdf_url'][0]['partcpdf'] ?? '' !=''){?>
                                            <td><a href="<?php echo base_url().$data['pdf_url'][0]['partcpdf'] ?? ''; ?>" target="_blank" alt="">
                                              <strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Part-C PDF detail</strong></a>
                                            </td>
                                            <?php } else {?> 
                                            <td></td>
                                            <?php }?> 
                                            
                                            <?php if($affid_upl !='') {?>
                                            <td><a href="<?php echo base_url(),$affid_upl; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Show Affidavit uploaded</strong></a></td>
                                            <?php } else {?>
                                            <td>affidavit not uploaded</td>
                                            <?php } ?>

                                            <td>
                                              <strong for="sum_facalle">Preview complaint:</strong>  
                                              <span><a href="<?php echo base_url().'cdn/complainpdf/'.$ref_no.'.'.'pdf' ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Go to application</strong></a></span>      
                                            </td>
                                          </tr>

                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  



                                  <?php if($all_benches != 0) { ?>
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Previous bench details -</h4>
                                    </div>
                                    <div class="panel-body">
                                    <?php foreach ($all_benches as $key => $value) {
                                            if($value['bench_no'] == 0){
                                                      $bench_no_display = 'Full Bench';
                                            }else{
                                                      $bench_no_display = $value['bench_no'];
                                            }
                                     ?>

                                    <?php //print_r($coram);
                                    ?>
                                    <table class="table table-bordered table-striped table-hover">
                                      <tbody id="benches-his">
                                        <tr>
                                          <td colspan='4'><font color='#C70039'><b>Bench no: <?php echo $bench_no_display; ?></b></font></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3"><b>Hearing date: <?php echo get_displaydate($value['listing_date']); ?></b></td>
                                          <!--<td><b>Bench nature: <?php echo get_bench_nature($value['bench_nature']); ?></b></td>-->
                                          <td><!--<b>court no: <?php echo $value['court_no']; ?></b>--></td>
                                        </tr>
                                        <tr>
                                          <td colspan='3' align="center"><b><u>CORAM</u>:</b></td><td align="center"><b><u>Designation</u>:</b></td>
                                        </tr>
                                        <?php $sn = 1;
                                        foreach ($value['judges_array'] as $key => $value2) { ?>
                                          <tr>
                                            <td colspan='3' align="center"><b><?php echo $sn.'. '; ?></b><?php echo $value2['judge_name']; if($value2['judge_code'] == $value['presiding']) echo "(Presided by)" ?></td><td style="text-align:center"><b><?php echo $value2['judge_desg']; ?></b></td>
                                          </tr>
                                          <?php $sn ++; 
                                        } ?>
                                      </tbody>
                                    </table>
                                    <?php
                                     }
                                    ?>
                                    </div>
                                  </div>  
                                    <?php
                                     }
                                    ?>



                                  <?php if($last_proceeding != 0) { ?>
                                  <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Previous proceeding details -</h4>
                                    </div>
                                    <div class="panel-body">
                                      <table class="table table-bordered table-hover">
                                        <tbody id="proceeding-info">
                                          <tr class='error'>
                                            <th style="width:50px;">S no.</th>
                                            <th style="width:100px;">Order date</th>
                                            <th>Order type</th>
                                            <th>Agency</th>
                                            <th>Order preview</th>
                                          </tr>
                                          <?php
                                          $sno = 1;
                                          foreach($last_proceeding as $row):
                                            ?>
                                          <tr>
                                          <td><?php echo $sno++.'.'; ?></td>
                                          <td><?php echo get_displaydate($row->order_date); ?></td>
                                          <td><?php echo get_order_type($row->ordertype_code); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview uploaded report</a></td>
                                        </tr>
                                      <?php endforeach; 
                                      if($proceeding_his != 0){
                                          foreach($proceeding_his as $row):
                                      ?>
                                              <tr>
                                          <td><?php echo $sno++.'.'; ?></td>
                                          <td><?php echo get_displaydate($row->order_date); ?></td>
                                          <td><?php echo get_order_type($row->ordertype_code); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><a href="<?php echo base_url().$row->order_upload; ?>" target="_blank" alt="">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview uploaded report</a></td>
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

                                                   // echo "<pre>";
                                                    //print_r($agencydata);
                                          if($ct > 0)
                                          {
                                                /*
                                                     $ageData=(array)$agencydata;

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
                                    <div class="panel-heading">
                                      <h4 class="panel-title">Previous Agency Details -</h4>
                                    </div>
                                    <div class="panel-body">  
                                   
                                      <table class="table table-bordered table-hover">
                                        <tbody id="proceeding-info">
                                        <tr class='error'>
                                          <th style="width:50px;">S no.</th>
                                          <th>Date of Submission</th>
                                          <th>Agency</th><th>Submitted By</th>
                                          <th>Contact Number</th>
                                          <th>Email Id</th>
                                          <th>Preview report</th>
                                        </tr>
                                        <?php
                                        $sno = 1;
                                        foreach($agencydata as $row):
                                          ?>
                                        <tr>
                                          <td><?php echo $sno++.'.'; ?></td>
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded</a></td>
                                        </tr>
                                        <?php endforeach; 
                                        if($agencydatahis != 0){
                                          foreach($agencydatahis as $row):
                                        ?>
                                        <tr>
                                          <td><?php echo $sno++.'.'; ?></td>
                                          <td><?php echo get_displaydate($row->dt_submission); ?></td>
                                          <td><?php echo get_agn_name($row->agency_code); ?></td>
                                          <td><?php echo ($row->team_lead_nm); ?></td>
                                          <td><?php echo ($row->contact_no); ?></td>
                                          <td><?php echo $row->email_id; ?></td>
                                          <td><a href="<?php echo base_url().$row->report_upload; ?>" target="_blank" alt=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Preview report uploaded </a></td>
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
                                      <div class="panel-heading">
                                        <h4 class="panel-title">Bench Allocation -</h4>
                                      </div>
                                      <div class="panel-body">
                                        <?php if($user['id'] != 1303) { ?>
                                        <div class="row">
                                          <div class="col-md-4">
                                            <label for="order_date_allocation"><span style="color: red;">*</span>Order date</label>
                                            <input type="text" class="form-control order_date_allocation" style="width:90%;" name="order_date_allocation" id="order_date_allocation"  placeholder="Order date">
                                          </div>
                                          <div class="col-md-4">
                                            <label for="order_upload" class=""><span style="color: red;">*</span>Order Upload</label>
                                            <input type="file" style="" id="order_upload" name="order_upload" class="form-control" accept=".pdf,.jpg" size="20">
                                          </div>
                                        </div>
                                        <?php } ?> 

                                        <?php if($listed == 'f') { ?>

                                        <div> 
                                          <label class="m-r-25"> <input class="m-r-5" type="radio" name="bench_choice" value="existing"> Select existing bench</label> 
                                          <?php if($user['id'] == 1303) { ?>
                                          <label> <input class="m-r-5" type="radio" name="bench_choice" value="constitution"> Create new bench</label>
                                          <?php } ?>
                                        </div> 

                                        <div class="panel panel-primary existing selectt" style="display: none">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">Existing Bench</h4>
                                            </div>
                                          <div class="panel-body">
                                            <table class="table table-bordered table-striped table-hover">
                                              <tbody id="benches-info">

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>

                                        <div class="constitution selectt" style="display: none">
                                          <div class="panel panel-primary">
                                            <div class="panel-heading">
                                              <h4 class="panel-title">Bench constitution -</h4>
                                            </div>
                                            <div class="panel-body">
                                              <div class="row">
                                                <div class="col-md-7">
                                                  <h4>Select members</h4>
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <label class="control-label col-sm-4" for="order_date"><span style="color: red;">*</span>Order date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control order_date" name="order_date" id="order_date"  placeholder="Order date">
                                                    </div>
                                                  </div> 
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th style="width:30px;">S.no.</th>
                                                        <th style="width:50px;">Select</th>
                                                        <th style="width:500px;">Name</th>
                                                        <th>Designation</th>
                                                        <th>Total no. of pending cases</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody id="members">

                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div id="selected_members">
                                                    <h4>Coram</h4>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          

                                        </div>

                                        

                                      </div>

                                      

                                      <?php } ?>
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


 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
  <script src="<?php echo base_url();?>assets/customjs/bench_constitution.js"></script>
  <script type="text/javascript">
            // When the document is ready     
            function isNumberKey(evt){
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
              return true;
            }

            function ValidateAlpha(evt)
            {
              var keyCode = (evt.which) ? evt.which : evt.keyCode
              if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

                return false;
              return true;
            }

            $('.order_date').datepicker({
              format: "dd-mm-yyyy",
              //startDate: '-0d',
              //startDate: '-3d',
              autoclose: true,
              todayHighlight: true

            });  

            $('.order_date_allocation').datepicker({
              format: "dd-mm-yyyy",
              //startDate: '-0d',
              //startDate: '-3d',
              autoclose: true,
              todayHighlight: true

            }); 



/*
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(filingform.a_co_email_id.value))
  {
    return (true)
  }
    alert("You have entered an invalid email address!")
    return (false)
  }*/
            $(document).ready(function() { 
                $('input[type="radio"]').click(function() { 
                    var inputValue = $(this).attr("value"); 
                    if(inputValue == 'existing'){
                      //var list_date = $(this).val();
                      benches_all_existing();
                    }
                    var targetBox = $("." + inputValue); 
                    $(".selectt").not(targetBox).hide(); 
                    $(targetBox).show(); 
                }); 

                    select_coram();

    $(document).on("change", "input[name='member_namec[]']", function () {
      var $this = $(this);
      var inputVal = $this.attr("id");
      console.log(inputVal);
      var className = inputVal.replace(/ /g, '_');
      var inputArr = inputVal.split('_');

      if ($(this).prop('checked')) {
        $("#selected_members").append('<label class="span_' + className + '"><li>'+ inputArr[0] + '</p></li></label><br>');
      } else {
        $('.span_'+className).remove();
      }
    });

            });  

</script>

<script type="text/javascript">
  $('.show-name').click(function(){
    var $this = $(this);
    $this.toggleClass('show-name');
    if($this.hasClass('show-name')){
      $this.text('Show Name');     
    } else {
      $this.text('Hide Name');
    }
  });
</script>



 