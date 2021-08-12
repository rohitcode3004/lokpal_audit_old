<?php //include(APPPATH.'views/templates/front/header2.php'); 
//$elements = $this->label->view(1);
?>

  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $("#otherid").hide();
    $("#otherpost").hide();
     $("#emailpost").hide();
   
    $('#recieved_by').on('change', function() {
       var value = $(this).val(); 
      // alert(value);
     // alert(#recieved_by.value);
      if ( this.value == '1')
      //.....................^.......
      {
        $("#otherid").show();
         $("#otherpost").hide();
           $("#emailpost").hide();
        
      }
      if ( this.value == '2')
      {
         $("#otherpost").show();
          $("#emailpost").hide();
        $("#otherid").hide();
      }
      if ( this.value == '3')
      {
        $("#emailpost").show();
        $("#otherid").hide();
         $("#otherpost").hide();
      }



    });
});
</script>
  
  
 <?php

 $curYear = date('Y');
  $curMonth = date('m');
  $curDay = date('d');
  $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
  $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
  //echo $cur_date="$curYear-$curMonth-$curDay";
   $cur_date="$curDay-$curMonth-$curYear";
  // echo "<pre>";
   //print_r($data['diary_counter']);
   ?>
 
 <script language="javascript"> 
    $().ready(function() {
 
    // validate signup form on keyup and submit
    $("#counterfiling").validate({
 
      onkeyup: false,

      rules: {  
        recieved_by: "required",
        s_name:"required", 
        sender_name:"required",  
        counter_mob_no: "required",
        mode_id:"required",
        email_from:"required",      
        email_date:"required",    
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

  
 
<?php 
$ref_no=$this->session->userdata('counter_ref_no');
//echo 'ref_no:'.$ref_no; 

   if (isset($ref_no)) {
 $sql = "select * from counter_filing where ref_no='".$ref_no."'";
      $query = $this->db->query($sql);
      $query1 = $query->row_array(); 
    $ack_no=$query1['ack_no'];
    $cur_year=$query1['cur_year'];


}
//echo '<pre>';
//print_r($received);
  //$array['ref_no'];
  //var_dump($data['state']);
  
   ?>
<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
      <h4 class="page-title">Recording of the Complaint</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="<?php echo base_url('filing/counterfiling.php'); ?>">Dashboad</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Recording of the Complaint</li> 
      </ol>
    </div>

<?php if ($role == 161 || $role == 162) { ?>
    <div class="row">
    <div class="panel-heading text-center">      
      <ul class="more-action">
        <li><a href="<?php echo base_url('scrutiny/dashboard_main'); ?>" class="previous">&laquo; Back</a></li>
      </ul>
    </div>
    </div>
      <br>
<?php } ?>
          
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-warring">

          <div class="panel-heading text-center">Recording of the Complaint

          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12"> 

  <form id="counterfiling" class="form-horizontal" role="form" method="post" action='<?= base_url();?>counter/countersave'  name="counterfiling" enctype="multipart/form-data">

    <div class="form_error">
          <?php echo validation_errors(); ?>
    </div>

    <div class="row">       
      <?php if (isset($ref_no)) {?>
      <div class="col-md-12">
        <div class="alert alert-success text-center">                   
          <h4 class="m-15">
            <strong>Acknowledgement Number- </strong>
            <span><?php echo $ack_no.'/'.$cur_year; ?></span>
          </h4>
          <?php  
            if(!empty($success_msg)){ 
            echo '<h5 class="m-15">'.$success_msg.'</h5>'; ?>             
            <?php
            }
            elseif(!empty($error_msg)){ 
              echo '<h5 class="m-15 text-danger">'.$error_msg.'</h5>'; 
            } 
            echo '<h5 class="m-15">'.$this->session->flashdata('success_msg').'</h5>';

          ?>    
          <a class="btn btn-primary" id="<?php echo $ref_no; ?>" href="<?php echo base_url() ?>counter/printacknowedment">Click for Reciept</a>               
        </div>
      </div>
      <?php } ?>
    </div>
 
    <div class="row"> 
      <div class="col-md-6 mb-15">
        <label for="from"><span class="text-danger">*</span>Mode of Receipt</label>     
        <select type="text" class="form-control chosen-single chosen-default" name="recieved_by" id="recieved_by">
          <option value="">-- Select --</option>
          <?php foreach($received as $row):?>                      
          <option value="<?php echo $row->id;?>"> <?php echo $row->name; ?> </option>       
          <?php endforeach;?>
        </select>       
      </div>
      <div class="col-md-6 mb-15">
        <label for="dt_of_filing">Date of entry</label>
        <input type="text" class="form-control" name="dt_of_filing" id="dt_of_filing" value="<?php echo $cur_date;?>" readonly="readonly">    
      </div> 
    </div>
    
    <div class="row" id="otherid">     
      <div class="col-md-6 mb-15">
        <label for="s_name"><span class="text-danger">*</span>Name</label>
        <input type="text" class="form-control" name="s_name" maxlength="50" id="s_name" placeholder="">        
      </div> 
      <div class="col-md-6 mb-15">
        <label for="counter_mob_no"><span class="text-danger">*</span>Mobile No</label>     
        <input type="text" class="form-control" name="counter_mob_no" id="counter_mob_no" maxlength="10"  onkeypress="return isNumberKey(event)" placeholder="">      
      </div>
    </div>

    <div class="row" id="otherpost">     
      <div class="col-md-6 mb-15">
        <label for="sender_name"><span class="text-danger">*</span>Sender Name</label>
        <input type="text" class="form-control" name="sender_name" maxlength="50" id="sender_name"
           placeholder="">        
      </div> 
      <div class="col-md-6 mb-15">
        <label for="from"><span class="text-danger">*</span>Mode</label>     
        <select type="text" class="form-control chosen-single chosen-default" name="mode_id" id="mode_id">
          <option value="">-- Select --</option>
          <?php foreach($mode as $row):?>                      
           <option value="<?php echo $row->mode_id;?>"> <?php echo $row->mode_desc; ?> </option>     
          <?php endforeach;?>
        </select>       
      </div>
    </div>

    <div class="row" id="emailpost">      
      <div class="col-md-6 mb-15">
        <label for="email_from"><span class="text-danger">*</span>Email-Id From</label>
        <input type="text" class="form-control" name="email_from" maxlength="50" id="email_from" placeholder="">        
      </div> 
      <div class="col-md-6 mb-15">   
        <label for="email_date"><span class="text-danger">*</span>Email Date</label>      
        <input type="text" class="form-control" name="email_date" id="email_date"  placeholder="">
      </div>
    </div> 

    <div class="row">
      <div class="col-md-12 mt-15 mb-15 text-center">
        <button type="submit" class="btn btn-success" id="submitbtn">Submit</button>      
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

     $(document).ready(function () {
                 autoclose: true,  
                $('#email_date').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
       $('#email_date').datepicker({
                    format: "dd-mm-yyyy",
                    endDate: new Date(),
                    autoclose: true,
                    todayHighlight: true

                  }); 


</script>




