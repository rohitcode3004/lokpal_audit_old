<?php include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
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
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
   
  <script language="javascript"> 
    $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#causelist").validate({
 
      onkeyup: false,

      rules: {  
        from_list_date: "required",
        //court_no:"required",   
        bench_nature: "required",
                
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
        groups_err: "Please select roll",
        fname_err: "Please enter your firstname",
        //lname_err: "Please enter your lastname",
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
        }
      }
    });
    
  });
   
      
 </script>
 
 <style>
 
  
  #causelist label.error {
  color: red;
  margin-left: 80px;
  font-size:15px;
  padding: inherit;
  }
  td, th {
    padding: 10px;
}
 
  </style>
  
 </head>
 
 <body> 
 
<?php 

 // echo "<pre>";
//print_r($partapartc_detail);die;
if (isset($complaint_status))
{
 $first_name=$partapartc_detail[0]->first_name ?? '';
$sur_name=$partapartc_detail[0]->sur_name ?? '';
$mid_name=$partapartc_detail[0]->mid_name ?? '';
$complainant_name=$first_name.' '.$mid_name.' '.$sur_name;
$dt_of_filing=$partapartc_detail[0]->dt_of_filing ?? '';

$ps_first_name=$partapartc_detail[0]->ps_first_name ?? '';
$ps_mid_name=$partapartc_detail[0]->ps_mid_name ?? '';
$ps_sur_name=$partapartc_detail[0]->ps_sur_name ?? '';
$public_servant_name=$ps_first_name.' '.$ps_mid_name.' '.$ps_sur_name;
$scrutiny_date=$partapartc_detail[0]->scrutiny_date ?? '';

   $filing_no=$complaint_status[0]->filing_no ?? '';
 //$ack_no=$complaint_status[0]->ack_no ?? '';
 //$cur_year=$complaint_status[0]->cur_year ?? '';
 //
  /*$phisical_copy_received=$Receipt_Data[0]->phisical_copy_received ?? '';
if($phisical_copy_received=='t')
{
  $phisical_copy_received='Received';
}
else
{
   $phisical_copy_received='Not Received';
}

//echo get_complaintno($row->filing_no);
*/
}
   ?>
  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    
        
        <!-- /.box-header -->

        <a href="<?php echo base_url(); ?>bench/case_status" class="previous">&laquo; Back</a>
        <div class="box-body">
 <div class="col-md-2"></div><br>
 <fieldset >      
   
    <div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Filing Detail</b></legend> 
  </div> 
 

<br><br>

 <div class="row">
        <?php if (isset($error)) {?>

       <div class="col-md-12"> 
            <div class="search" style="float: left;  margin-left: 90px;  margin-bottom: 30px;">                  
            
              <span style="color: red"><b>  <?php echo $error;?></b></span>
           </div>           
      </div>

    <?php } ?>
</div>
 <div class="table-responsive">
  <table id="mytable" class="table table-bordred table-striped">
<thead>
  <th>Date of Filing</th>
   <th>Diary no.</th>
 <!-- <th>Complainant Name</th>  
   <th>Public Servant Name</th> -->  
      </tr>
   </thead> 
  <tbody>
      <tr>
        <td>          
          <?php echo get_displaydate($dt_of_filing); ?>
        </td>

        <td>          
          <?php echo  $filing_no; ?>
        </td>               

<!--<td align="center"><?php         
    
//echo $complainant_name;
       ?>
     </td>
     <td align="center"><?php         
   
//echo $public_servant_name;
       ?>
     </td>-->
      </tr>
    </tbody>  
</table>
</div>

 <div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Scrutiny Detail</b></legend> 
  </div>

  <div class="table-responsive">
  <table id="mytable" class="table table-bordred table-striped">
<thead>
  <th>Scrutiny Date</th>
   <th> Complaint no.</th>
        </tr>
   </thead> 
  <tbody>
      <tr>
        <td>          
          <?php echo get_displaydate($scrutiny_date); ?>
        </td>
                      
<td align="center"><?php         
    echo get_complaintno($filing_no);
       ?>
     </td>
     
      </tr>
    </tbody>  
</table>
</div>


<div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Next listing detail</b></legend> 
  </div>

<?php 
//echo "<pre>";
//print_r($next_listing_date);
 $listing_date=$next_listing_date['listing_date'] ?? '';
 $name=$next_listing_date['name'] ?? '';

?>
  <div class="table-responsive">
  <table id="mytable" class="table table-bordred table-striped">
<thead>
  <th>listing Date</th>
   <th> Purpose</th>
        </tr>
   </thead> 
  <tbody>
      <tr>
        <td>          
          <?php 

            if($listing_date !=''){
          echo get_displaydate($listing_date); ?>
       <?php  }else { 

        echo "listing date not given";} ?>


        </td>


                      
<td align="center"><?php         
    echo $name;
       ?>
     </td>
     
      </tr>
    </tbody>  
</table>
</div>


<?php if($last_proceeding != 0) { ?>
   

    <div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Proceeding Details</b></legend> 
  </div>

   <table class="table">
       <tbody id="proceeding-info">
        <tr class='error'>
          <th style="width:10px;">S no.</th><th style="width:100px;">Order date</th><th>Order type</th><th>Order By</th><th>Order preview</th>
        </tr>
        <?php
        $sno = 1;
        foreach($last_proceeding as $row):
          ?>
        <tr>
        <td style="width:10px;"><?php echo $sno++.'.'; ?></td><td style="width:100px;"><?php echo get_displaydate($row->order_date ?? ''); ?></td><td><?php echo get_order_type($row->ordertype_code ?? ''); ?></td>

          <?php if($row->agency_code != '')
          { ?>
        <td><?php echo get_agn_name($row->agency_code ?? ''); ?></td>

          <?php } else {?>

            <td><?php echo 'Bench' ?></td>
          <?php } ?>

        <td><a href="<?php echo base_url().$row->order_upload ?? ''; ?>" target="_blank" alt="">Preview uploaded report</a>

        </td>
      </tr>
    <?php endforeach; 
    if($proceeding_his != 0){
        foreach($proceeding_his as $row):
    ?>
            <tr>
        <td style="width:10px;"><?php echo $sno++.'.'; ?></td><td style="width:100px;"><?php echo get_displaydate($row->order_date ?? ''); ?></td><td><?php echo get_order_type($row->ordertype_code); ?></td><td><?php echo get_agn_name($row->agency_code ?? ''); ?></td><td><a href="<?php echo base_url().$row->order_upload ?? ''; ?>" target="_blank" alt="">Preview uploaded report</a></td>
      </tr>
      <?php endforeach; 
    }
      ?>
    </tbody>
  </table>
<?php } 

  else{
?>

    <div class="searchComplaint">
   <legend style="" align="center"><b style="font-size: 125%; color: indianred;">Proceeding Details</b></legend> 
  </div>
<table class="table">
       <tbody id="proceeding-info">
        <tr class='error'>
          <th style="width:10px;"></th>
        </tr>
        <tr>
          <td>Proceeding not done</td>
        </tr>
</tbody>
</table>
        <?php } ?>







   </form>
   </fieldset>
        </div>
     </div>

</div></section>

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

     $('#from_list_date').datepicker({
                    format: "dd-mm-yyyy",
                    //startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });  



   </script>





  


</body></html>



