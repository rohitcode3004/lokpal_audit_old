<?php //include(APPPATH.'views/templates/front/header2.php'); ?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/additional-methods.min.js"></script>
  
<script type="text/javascript">


   $().ready(function() {
    // validate signup form on keyup and submit
    $("#affidavitform").validate({
      onkeyup: false,
      rules: {  
                  
        affidavit_upload: {required: true, accept: "application/pdf"},
       email_id: {
        required:true,
        email: true,          
      },
 
      agree: "required",
      //affidavit_upload:{ accept: "application/pdf,image/jpg,image/jpeg" }     
    },
    messages: { 
     affidavit_upload:{ accept: "Only pdf formats are allowed" },       

    }

  });
    
  });
</script>

<?php
$chkdate= date("l jS \of F Y");
 $curYear = date('Y');
  $curMonth = date('m');
  $curDay = date('d');
  $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
  $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
  $comp_f_date="$curYear-$curMonth-$curDay";

  //echo "<pre>";
 // echo $user['role'];
 ?>



<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
    <!--  <h4 class="page-title">Filing Entry</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('counter/dashboard_main_registry'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Filing Entry</li> 
      </ol>-->
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php 
          $ref_no=$this->session->userdata('ref_no');
          include(APPPATH.'views/templates/front/stepwise_navigator.php');

          if(isset($ref_no))
          {
             $farma[0]->first_name;
             $farma[0]->mid_name;
             $farma[0]->sur_name;
             $name=$farma[0]->first_name.' '. $farma[0]->mid_name.' '. $farma[0]->sur_name;

             $farma[0]->age_years;
             $farma[0]->fath_name;
             $farma[0]->comp_f_date;
             $farma[0]->comp_f_place;
             $farma[0]->complaint_capacity_id;
          }
              
        ?>
        <div class="panel panel-warring">
          <div class="panel-heading text-center">AFFIDAVIT  DETAIL : (PART - D)</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">  

    
    <form id="affidavitform" class="form-horizontal" role="form" method="post" action='<?= base_url();?>/document/affidavitupload'  name="affidavitform" enctype="multipart/form-data">

      <div class="form_error">
        <?php echo validation_errors(); ?>
      </div>

      <div class="row">
        <div class="col-md-12 col-xs-12">                   
          <?php  
            if(!empty($success_msg)){ 
              echo "hello";
                echo '<p class="status-msg success" style="text-align: center;"><h3><span style="color: red">'.$success_msg.'</span></h3></p>'; 
            }elseif(!empty($error_msg)){ 

              echo "Hi";
                echo '<p class="status-msg error" style="text-align: center;"><h3>'.$error_msg.'</h3></p>'; 
            } 
            echo '<div>'.$this->session->flashdata('success_msg').'</div>';
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12"> 
          <h4 class="text-theme text-center">(to be sworn on a non-judicial stamp paper)</h4>


          <p style="font-size:18px; margin: 50px 0;">
            I 
            <strong style="border-bottom: 1px dashed #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong> 
            aged 
            <strong style="border-bottom: 1px dashed #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $farma[0]->age_years ?? ''; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> 
            years, s/o 
            <strong style="border-bottom: 1px dashed #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $farma[0]->fath_name ?? '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
            .r/o.
            <strong style="border-bottom: 1px dashed #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $farma[0]->comp_f_place ?? ''; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> do hearby solemnly affirm and declare on oath as under-</p>

          <ol class="list-counter">
            <?php if( $farma[0]->complaint_capacity_id ==1){ ?>
            <li>That I am filing this complaint on my own behalf</li>
            <?php } ?>
        
            <?php if ($farma[0]->complaint_capacity_id >1){ ?>
            <li>That I am filing this complaint on behalf of body/Board/ Corporation/ Authority/ Company/society/trust/association of persons/Non-Governmental Organisation/ Limited Liability Partnership (give its name and registration number, if any) having their office at (give contact address/email/phone/fax of the organization) and that I am authorized to sign and make this complaint vide its resolution dated …………..</li>
            <?php } ?>


            <li>That I have filed the present complaint under the provisions of the Lokpal and Lokayuktas Act, 2013 and the rules made thereunder.</li>

            <li>That I have gone through the provisions of the Lokpal and Lokayuktas Act, 2013 and do hereby affirm that the present complaint is in conformity therewith and I am fully aware that under the provisions of sections 46 and 47 of the Act making any false and frivolous or vexatious complaint is punishable with imprisonment for a term which may extend to one year and with fine which may extend to one lakh rupees.</li>

            <li>That neither I nor any other person in the organisation / institution / body that I represent in this complaint has filed any complaint in this matter before any Court or Committee of either House of Parliament or before any other Authority and this complaint does not attract the provisions of section 15 of the Act.</li>

            <li>I state that before filing this complaint I have collected and presented the information and supporting evidence to the best of my knowledge, ability and capacity which are relevant in support of the allegations of corruption against the concerned public servant and I further confirm that I have not concealed any data /material / information in this complaint.</li>
          </ul>


          <h4>Solemnly affirmed at …………………this…………….day of………….20……….</h4>
        </div>
      </div>

      <h3 class="text-right mt-50 mb-50">DEPONENT </h3>

      <h3 class="text-center mb-50">Verification </h3>

      <p style="font-size: 18px;"> I <b><?php echo $name ?? ''; ?></b>the above named deponent do hereby verify that the contents of the aforesaid paragraphs 1 to 5 are true and correct to the best of my knowledge and belief and nothing is concealed therefrom.</p>

      <h4>Verified at <b><?php echo  $farma[0]->comp_f_place ?? ''; ?></b> this…………….day of</h4>

      <h3 class="text-right">DEPONENT </h3>
  

      <div class="row">       
        <div class="col-md-4" align="left">
          <label for="affidavit_upload"><span class="text-danger">*</span>Affidavit Upload</label>
          <input type="file" id="affidavit_upload" name="affidavit_upload" class="form-control" accept=".pdf" size="20"> 
          <span class="text-danger">The File should not greater than 20 MB (Only pdf file allowed)</span>
          <div class="error" id="affidavit_upload_error"><?php echo form_error('affidavit_upload'); ?></div>
          <label for="affidavit_upload">
            <?php if($farma[0]->affidavit_upload !='')  {?>
            <a href="<?php echo base_url();?><?php echo $farma[0]->affidavit_upload; ?>" target="_blank" alt="">show uploded document </a>
            <?php } ?>
          </label>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-success mt-30" id="submitbtn">Click here to upload Affidavit</button>    
        </div>
      </div> 

      <div class="row">
        <div class="col-md-12 text-right">          
          <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("document/toPdf");?>'">Sample Affidavit</button>

            <?php if($user['role'] == '18'){ ?>
          <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("affidavit/affidavit_detail");?>'">Save &amp; Next</button>
        <?php } ?>

        
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12">   
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
    $('#date1').datepicker({
    format: "yyyy-mm-dd"
    });            
  }); 
</script>

<script type="text/javascript">
  $('input#affidavit_upload').bind('change', function() {
    // var maxSizeKB = 20; //Size in KB
    var maxSize =20000000; //File size is returned in Bytes
    if (this.files[0].size > maxSize) {
      $(this).val("");
      //alert("Max size exceeded");
      $('#affidavit_upload_error').text('Affidavit upload file must be less then 20 MB');
      return false;
    }else{
      $('#affidavit_upload_error').text('');
    }
  });
</script>




