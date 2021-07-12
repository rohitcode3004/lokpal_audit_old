<?php
//die('g');
$u = $user['id'];
$comp_no=get_filing_no($ref_no);
$status = $comp_no['status'];
$filing_no = $comp_no['complaint_no'];

$parta_status = get_parts_status($ref_no, $u, 'A');
$partb_status = get_parts_status($ref_no, $u, 'B');
$partc_status = get_parts_status($ref_no, $u, 'C');

if($parta_status){
  $comp_cap = get_parta_comptype($ref_no, $u);
}else{
  $comp_cap = '';
}

$ref_no_b2=get_refno_b($ref_no);
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">    
    <ul class="nav navbar-nav">
      <li <?php if($status == 't') { ?> class="disabled" <?php } if($form_part == 'A') { ?> class="selected" <?php } ?> style="width: 143px; padding-top: 10px;"><center><font size="3"><b><a href="<?php echo base_url(); ?>filing/filing">Part - A</a></b></font></center></li>

      <li <?php if($status == 't' || $comp_cap == 1 || $ref_no == null) { ?> class="disabled" <?php } if($form_part == 'B') { ?> class="selected" <?php }?> style="
    width: 143px; padding-top: 10px;"><center><font size="3"><b><a href="<?php echo base_url(); ?>applet/appletfiling">Part - B</a></b></font></center></li> 
           
      <li <?php if($status == 't' || ($ref_no_b2 == null && $comp_cap != 1)) { ?> class="disabled" <?php } if($form_part == 'C') { ?> class="selected" <?php }?> style="width: 143px; padding-top: 10px;"><center><font size="3"><b><a href="<?php echo base_url(); ?>respondent/respondentfiling">Part - C</a></b></font></center></li>

      <?php if($parta_status && $partc_status) { ?>
      <li <?php if($form_part == 'Af') { ?> class="selected" <?php } ?> style="
    width: 200px; padding-top: 10px;"><center><font size="3"><b><a href="<?php echo base_url(); ?>document/testafidavit">Affidavit(Part - D)</a></b></font></center></li>
     
      <li <?php if($form_part == 'R') { ?> class="selected" <?php } ?> style="
    width: 200px; padding-top: 10px;"><center><font size="3"><b><a href="<?php echo base_url(); ?>affidavit/affidavit_detail">Preview Complaint log</a></b></font></center></li>
      <?php } ?>
         <!-- <li><a href="<?php echo base_url(); ?>document/testimg">Document</a></li>
     <li><a href="<?php echo base_url(); ?>document/payment">Payment</a></li>-->
    </ul>
  </div>  
</nav>

<style type="text/css">
  .disabled{
    pointer-events:none;
    opacity:0.7;
    padding-top: 10px;
}
  .selected{
    background-color: rgba(255, 153, 36, 0.5);
    padding-top: 10px;
}
</style>
<!--background-color: rgba(255, 153, 36, 0.5);-->