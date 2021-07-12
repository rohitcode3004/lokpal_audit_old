<?php
//die('g');
$u = $user['id'];
 $comp_no=get_filing_no($ref_no);
echo  $status = $comp_no['status'];
$filing_no = $comp_no['complaint_no'];

 $parta_status = get_parts_status($ref_no, $u, 'A');
 $partb_status = get_parts_status($ref_no, $u, 'B');
 $partc_status = get_parts_status($ref_no, $u, 'C');

if($parta_status){
  echo "first";
  $comp_cap = get_parta_comptype($ref_no, $u);
}else{

  echo "second";
  $comp_cap = '';
}

$ref_no_b2=get_refno_b($ref_no);
?>
<nav class="wizard-navigation">
  <div class="wizard-navigation">    
    <ul class="nav nav-tabs">
      <li <?php if($status == 't') { ?> class="disabled" <?php } if($form_part == 'A') { ?> class="selected" <?php } ?>><a href="<?php echo base_url(); ?>filing/filing">Part - A</a></li>

      <li <?php if($status == 't' || $comp_cap == 1 || $ref_no != null) { ?> class="disabled" <?php } if($form_part == 'B') { ?> class="selected" <?php }?>><a href="<?php echo base_url(); ?>applet/appletfiling">Part - B</a></li> 
           
        

      <li <?php if($status == 't' || ($ref_no_b2 == null && $comp_cap != 1)) { ?> class="disabled" <?php } if($form_part == 'C') { ?> class="selected" <?php }?>><a href="<?php echo base_url(); ?>respondent/respondentfiling">Part - C</a></li>


<?php 

     $parta_status=1;
     $partc_status;

     ?>

      <?php if($parta_status && $partc_status) { ?>
      <li <?php if($form_part == 'Af') { ?> class="selected" <?php } ?>><a href="<?php echo base_url(); ?>document/testafidavit">Affidavit(Part - D)</a></li>
     
     
      <li <?php if($form_part == 'R') { ?> class="selected" <?php } ?>><a href="<?php echo base_url(); ?>affidavit/affidavit_detail">Preview Complaint log</a></li>
      <?php } ?>        
    </ul>
  </div>  
</nav>