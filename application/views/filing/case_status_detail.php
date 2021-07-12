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

  //echo "<pre>";
//print_r($Receipt_Data);
if (isset($Receipt_Data))
{
  $entry_date=$Receipt_Data[0]->entry_date ?? '';
 $ack_no=$Receipt_Data[0]->ack_no ?? '';
 $cur_year=$Receipt_Data[0]->cur_year ?? '';
 $phisical_copy_received=$Receipt_Data[0]->phisical_copy_received ?? '';
if($phisical_copy_received=='t')
{
  $phisical_copy_received='Received';
}
else
{
   $phisical_copy_received='Not Received';
}


}
   ?>
  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    
        
        <!-- /.box-header -->

        <a href="<?php echo base_url(); ?>counter/casestatus" class="previous">&laquo; Back</a>
        <div class="box-body">
 <div class="col-md-2"></div><br>
 <fieldset >      
   <div class="panel-default">
                <div class="panel-heading">
                    <span id="ContentPlaceHolder1_search" class="searchComplaint" placeholder="Search"></span>
                    <h5 class="panel-title">
                       
                     Status of Complaint
                    </h5>
                </div>  
    </div>
 
<div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 125%; color: indianred;"></b></legend>   
  </div>

<br><br>

  <?php  
        if(!empty($success_msg)){ 
            echo '<div class="alert alert-success">'.$success_msg.'</div>'; 
        }elseif(!empty($error_msg)){ 
            echo '<div class="alert alert-danger">'.$error_msg.'</div>'; 
        } 
    ?>

 <div class="row">
        <?php if (isset($error)) {?>

       <div class="col-md-12"> 
            <div class="search" style="float: left;  margin-left: 90px;  margin-bottom: 30px;">                  
            
              <span style="color: red"><b>  <?php echo $error;?></b></span>
           </div>           
      </div>

    <?php } ?>
</div>
  
<br>
 <div class="table-responsive">
  <table id="mytable" class="table table-bordred table-striped">
<thead>
  <th>Date of Recieving</th>
    <th>Acknowedgement No.</th>
    <th>Physical Copy Received at Scrutiny Section</th>   
     </tr>
   </thead> 
  <tbody>
      <tr>

        <td>
          
          <?php echo get_displaydate($entry_date); ?></td>
        </td>
         <td align="center"><?php 
         echo $ack_no.'/'.$cur_year;
         ?>
        </td>       
<td align="center"><?php 
        
      echo $phisical_copy_received;
       ?>
     </td>
      </tr>
    </tbody>  
</table>
</div>
<br><br><br><br>

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



