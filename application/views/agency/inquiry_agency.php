<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  
  
<style type="text/css">
  .navbar-nav>li .active {
    color: green !important;
  } 

  #inquiry_agency label.error {
    color: red;
    margin-left: 80px;
    font-size:15px;
    padding: inherit;
  }

.table{
  border: 1px solid #ddd;
}
.table > thead > tr > th, .table > tbody > tr > th, 
.table > tfoot > tr > th, .table > thead > tr > td, 
.table > tbody > tr > td, .table > tfoot > tr > td {
  width: 300px;
}

table label {
  margin-left: 1px;
}

tr.error {
  background: #F2DEDE;
}

tr.success {
  background: #4eb478;
}

</style>


<script src="<?php echo base_url();?>assets/customjs/bench_comp.js"></script>
<script type="text/javascript">

   $().ready(function() {
    // validate signup form on keyup and submit
    $("#inquiry_agency").validate({
      onkeyup: false,
      rules: {  
        dt_submission: "required",
        dt_of_dispatched: "required",
        team_lead_nm:"required",   
        contact_no: "required",
            
        report_upload: {required: true, accept: "application/pdf"},
        forwarding_letter_upload: {required: true, accept: "application/pdf"},
       email_id: {
        required:true,
        email: true,          
      },
 
      agree: "required",
      //report_upload:{ accept: "application/pdf,image/jpg,image/jpeg" }     
    },
    messages: { 
     report_upload:{ accept: "pdf formats are allowed only" },  
    forwarding_letter_upload:{ accept: "pdf formats are allowed only" },       

    }

  });
    
  });
</script>

<?php 
//$this->load->model('agency_model');

//$filing_no='000332020';
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
  if($item14=='1')
  {
    $item14='Yes';
  }
  else
  {
    $item14='No';
  }
$part_c= $this->agency_model->getDisplayPar_C($filing_no);


  $psid=$part_c['ps_salutation_id'] ?? '';
  if($psid !='')
  {
    $pssalution = $this->report_model->getSalutation($psid);
    $pstitile_desc=$pssalution['salutation_desc'];
  }
  else
  {
   $pstitile_desc='';
 }

$psectorid =$part_c['complaint_capacity_id'] ?? '';
if($psectorid !='')
{
  $pssalution = $this->report_model->getPublicsector($psectorid);
 $ccapacity=$pssalution['complaint_capacity_desc'];
}
else
{
 $ccapacity='';
}
 
$subcat =$part_c['ps_id'] ?? '';
if($subcat !='')
{
  $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
   $subcat_desc=$pssubcat['ps_desc'] ;
}
else
{
  $subcat_desc='';
}

$salutation_desc =$part_c['salutation_desc'] ?? '';
$ps_first_name =$part_c['ps_first_name'] ?? '';
$ps_mid_name =$part_c['ps_mid_name'] ?? '';
$ps_sur_name =$part_c['ps_sur_name'] ?? '';
$name_detail=$ps_first_name.'.'.$ps_mid_name.'.'.$ps_sur_name;
$ps_dsp_lp =$part_c['ps_dsp_lp'] ?? '';
if($ps_dsp_lp =='1')
{
  $ps_dsp_lp='Yes';
}
else
{
  $ps_dsp_lp='No';
}
$ps_desig =$part_c['ps_desig'] ?? '';
$ps_orgn =$part_c['ps_orgn'] ?? '';

//echo $ps_desc =$part_c['ps_desc'] ?? '';
$ps_othcate =$part_c['ps_othcate'] ?? '';

$anninc_onecr =$part_c['anninc_onecr'] ?? '';
if($anninc_onecr =='1')
{
  $anninc_onecr='Yes';
}
else
{
  $anninc_onecr='No';
}

$tas_fingoi =$part_c['tas_fingoi'] ?? '';
if($tas_fingoi =='1')
{
  $tas_fingoi='Yes';
}
else
{
  $tas_fingoi='No';
}

$dona_fs =$part_c['dona_fs'] ?? '';
if($dona_fs =='1')
{
  $dona_fs='Yes';
}
else
{
  $dona_fs='No';
}

$pss_sbbca =$part_c['pss_sbbca'] ?? '';
if($pss_sbbca =='1')
{
  $pss_sbbca='Yes';
}
else
{
  $pss_sbbca='No';
}

$psc_postheld =$part_c['psc_postheld'] ?? '';
echo $sum_fact_allegation_upload =$part_c['sum_fact_allegation_upload'] ?? '';
$detail_offence_upload =$part_c['detail_offence_upload'] ?? '';

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
  $relevant_evidence_upload=$part_c['relevant_evidence_upload'] ?? '';
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
     $proceedingdata= $this->agency_model->getProceedingdata($filing_no);     
      $prodata=(array)$proceedingdata;
      $filing_no=$prodata[0]->filing_no ?? '';
      $listing_date=$prodata[0]->listing_date ?? '';
      $bench_no=$prodata[0]->bench_no ?? '';
      $bench_id=$prodata[0]->bench_id ?? '';
      $court_no=$prodata[0]->court_no ?? '';
      $court_no=1;
      $bench_code=$prodata[0]->bench_nature ?? '';
      $bench_code=0;
      $ordertype_code=$prodata[0]->ordertype_code ?? '';
      $agency_code=$prodata[0]->agency_code ?? '';
      $agn_name = get_agname($agency_code);
      $ordertype_name = get_ordertype($ordertype_code);
      //print_r($agn_name.$ordertype_name);die();
?>

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title"></h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('agency/dashboard_main'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Dashboard for Agency</li> 
      </ol>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <?php echo $agn_name; ?> Form for <?php echo $ordertype_name; ?>
             <span align="text-right">
                              <strong>Complaint no.</strong> <?php echo get_complaintno($filing_no); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                              <strong>Diary no.</strong> <?php echo $filing_no; ?>
                            </span>
                             <ul class="more-action">
                                <li><a href="<?php echo base_url(); ?>agency/dashboard" class="previous">&laquo; Back</a></li>
                            </ul>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

    <form id="inquiry_agency" class="form-horizontal" role="form" method="post" action='<?= base_url();?>agency/agency_action'  name="witnessform" enctype="multipart/form-data">
      <div class="form_error">
        <?php echo validation_errors(); ?>
      </div>
  
      <div class="panel panel-primary">
        <div class="panel-heading">Part C Details -</div>
        <div class="panel-body">
          <table class="table table-striped">
            <tbody id="partc-info">
              <tr>
                <td style="width: 30%;">
                  <strong for="ps_salutation_id"><?php print_r($this->label->get_short_name($elements, 108)); ?></strong>
                </td>
                <td style="width: 1%;">:</td>
                <td style="width: 19%;"><span><?php echo $pstitile_desc;?></span></td>
                <td style="width: 30%;">
                  <strong for="ps_first_name">Full Name</strong>
                </td>
                <td style="width: 1%;">:</td>
                <td style="width: 19%;"><span><?php echo $name_detail;?></span></td>
              </tr>
              <tr>
                <td>
                  <strong for="ps_dsp_lp"><?php print_r($this->label->get_short_name($elements, 130)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $ps_dsp_lp;?></span></td>
                <td>
                 <strong for="ps_desig"><?php print_r($this->label->get_short_name($elements, 131)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $ps_desig;?></span></td>
              </tr>

              <tr>
                <td>
                  <strong for="ps_orgn"><?php print_r($this->label->get_short_name($elements, 132)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $ps_orgn;?></span></td>
                <td>
                  <strong for="ps_desc"><?php print_r($this->label->get_short_name($elements, 133)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $subcat_desc;?></span></td>
              </tr>
              <tr>
                <td>
                  <strong for="ps_othcate"><?php print_r($this->label->get_short_name($elements, 135)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $ps_othcate;?></span></td>
                <td>
                 <strong for="tas_fingois"><?php print_r($this->label->get_short_name($elements, 137)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $tas_fingoi;?></span></td>
              </tr>

              <tr>
                <td>
                  <strong for="anninc_onecr"><?php print_r($this->label->get_short_name($elements, 138)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $anninc_onecr;?></span></td>
                <td>
                  <strong for="dona_fs"><?php print_r($this->label->get_short_name($elements, 139)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $dona_fs;?></span></td>
              </tr>
              <tr>
                <td>
                  <strong for="pss_sbbca"><?php print_r($this->label->get_short_name($elements, 140)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $pss_sbbca;?></span></td>
                <td>
                 <strong for="psc_postheld"><?php print_r($this->label->get_short_name($elements, 141)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $psc_postheld;?></span></td>
              </tr>

              <tr>
                <td>
                  <strong for="periodf_coa"><?php print_r($this->label->get_short_name($elements, 143)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo get_entrydate($item91);?></span></td>
                <td>
                  <strong for="periodt_coa"><?php print_r($this->label->get_short_name($elements, 144)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo get_entrydate($item92);?></span></td>
              </tr>
              <tr>
                <td>
                  <strong for="ps_pl_occ"><?php print_r($this->label->get_short_name($elements, 145)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $ps_pl_occ;?></span></td>
                <td>
                 <strong for="ps_pl_stateid"><?php print_r($this->label->get_short_name($elements, 92)); ?></strong>       
                </td>
                <td>:</td>
                <td><span><?php echo $name;?></span></td>
              </tr>

              <tr>
                <td>
                  <strong for="ps_pl_dist_id"><?php print_r($this->label->get_short_name($elements, 93)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $distt;?></span></td>
                <td>
                  <strong for="sum_facalle"><?php print_r($this->label->get_short_name($elements, 147)); ?></strong>   
                </td>
                <td>:</td>
                <td><span><?php echo $sum_facalle;?></span> </td>
              </tr>
              <tr>
                <td>
                  <strong for="sum_facalle">Show Fact/allegation Report if any</strong>     
                </td>
                <td>:</td>
                             <?php if($sum_fact_allegation_upload !=''){?>

                <td>
                  <span><a href="<?php echo base_url().$sum_fact_allegation_upload ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i></strong>Show Report</a></span> 
                </td>
                <?php }  else
                                            { ?>
                                            <td></td>
                                          <?php } ?>
                <td>
                  <strong for="det_offen"><?php print_r($this->label->get_short_name($elements, 148)); ?></strong>           
                </td>
                <td>:</td>
                <td><span><?php echo $det_offen;?></span></td>
              </tr>

              

              <tr>
                <td>
                  <strong for="sum_facalle">Show Detail offence Report if any</strong>   
                </td>
                <td>:</td>



                         <?php if($detail_offence_upload !=''){?>

                <td>
                  <span><a href="<?php echo base_url().$detail_offence_upload ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i></strong>Show Report</a></span>
                </td>
                <?php }  else
                                            { ?>
                                            <td></td>
                                          <?php } ?>



                <td>
                  <strong for="prov_viola"><?php print_r($this->label->get_short_name($elements, 149)); ?></strong>      
                </td>
                <td>:</td>
                <td><span><?php echo $prov_viola;?></span></td>
              </tr>
              <tr>
                <td>
                  <strong for="prov_viola">Relied Doc List</strong>  
                </td>
                <td>:</td>
                <td><span><?php echo $relied_doc_list;?></span> </td>
                <td>
                  <strong for="prov_viola">Any Other Info</strong>          
                </td>
                <td>:</td>
                <td><span><?php echo $any_othInfo;?></span></td>
              </tr>

              <tr>
                <td>
                  <strong for="doc_copy_attached"><?php print_r($this->label->get_short_name($elements, 151)); ?></strong>
                </td>
                <td>:</td>
                <td><span><?php echo $doc_copy_attached;?></span></td>
                <td>
                <strong for="sum_facalle">Show Detail evidence Report if any</strong>   
                </td>
                <td>:</td>

                    <?php if($relevant_evidence_upload !=''){?>

                <td>
                  <span><a href="<?php echo base_url().$relevant_evidence_upload ?? ''; ?>" target="_blank" alt=""><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i></strong>Show Report</a></span>  
                </td>
                  <?php }  else
                                            { ?>
                                            <td></td>
                                          <?php } ?>



              </tr>
              <tr>
                <td>
                  <strong for="electronic_file"><?php print_r($this->label->get_short_name($elements, 152)); ?></strong>   
                </td>
                <td>:</td>
                <td><span><?php echo $electronic_file;?></span></td>
                <td colspan="3">
                          
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="panel panel-primary">
        <div class="panel-heading">Submit Agency Report:</div>
        <div class="panel-body">
          <input type="hidden" name="filing_no" value="<?php echo $filing_no; ?>">
          <input type="hidden" name="bench_code" value="<?php echo $bench_code; ?>">
          <input type="hidden" name="listing_date" value="<?php echo $listing_date; ?>">
          <input type="hidden" name="bench_no" value="<?php echo $bench_no; ?>">
          <input type="hidden" name="court_no" value="<?php echo $court_no; ?>">
          <input type="hidden" name="ordertype_code" value="<?php echo $ordertype_code; ?>">
          <input type="hidden" name="agency_code" value="<?php echo $agency_code; ?>">

          <?php

            $curYear = date('Y');
            $curMonth = date('m');
            $curDay = date('d');
            $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
            $cur_date12 = $curDay.'-'.$curMonth.'-'.$curYear;
            $dt_submission=$cur_date12;
                            
          ?>

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
              <input type="file" id="report_upload" name="report_upload" class="form-control" accept=".pdf,.jpg" size="20">  
            </div>
            <div class="col-md-3 mb-15">
              <label for="forwarding_letter_upload"><span class="text-danger">*</span>Forwarding Letter</label>
              <input type="file" id="forwarding_letter_upload" name="forwarding_letter_upload" class="form-control" accept=".pdf,.jpg" size="20">  
            </div>
            <div class="col-md-3 mb-15">
              <label for="dt_of_dispatched"><span class="text-danger">*</span>Letter Dispatched Date</label>
              <input type="text" class="form-control" name="dt_of_dispatched" id="dt_of_dispatched"  placeholder="">
            </div>
          </div>
           <div class="row">
            <div class="col-md-12 mb-15">
              <label for="report_content">Remarks if any</label>      
              <textarea class="form-control" name="report_content" id="report_content" maxlength="500"  rows="3" cols="50" wrap="hard"></textarea>       
            </div>
          </div> 

          <div class="row">
            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-success" id="submitbtn">Confirm & Send</button>      
            </div>
          </div>

          <div class="row"> 
            <div class="col-md-6">
            <?php

              $curYear = date('Y');
              $curMonth = date('m');
              $curDay = date('d');
              $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
              $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
              $comp_f_date="$curYear-$curMonth-$curDay";
            ?> 
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
            // When the document is ready
            $(document).ready(function () {
                 autoclose: true,  
                $('#dt_submission').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });                


 $(document).ready(function () {
                 autoclose: true,  
                $('#dt_of_dispatched').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            }); 
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


        </script>



