<?php //include(APPPATH.'views/templates/front/header2.php'); 
$elements = $this->label->view(1);
?>

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
 
 <?php 
$chkdate= date("l jS \of F Y");

if(isset($caseallocationdata))
{

//echo "<pre>"; print_r($caseallocationdata); 


//print_r($benchjudeg);die;
//print_r($listingjudeg);die;

$getComplainNo=(array)$caseallocationdata;
 $listing_date=$getComplainNo[0]->listing_date ?? '';
 $nameOfDay = date('D', strtotime($listing_date));
 $month_name =  ucfirst(strftime("%B", strtotime($listing_date)));
$date = DateTime::createFromFormat("Y-m-d", $listing_date);
 $year=$date->format("Y");
date_default_timezone_set('Asia/Kolkata');
$currentDateTime=date('m/d/Y H:i:s');
$newDateTime = date('h:i A', strtotime($currentDateTime));
 $newDateTime; 

//$arr = array($listing_date);
$dd=explode("-",$listing_date);

$dd[2];

}
if(isset($benchjudeg))
{
 $benchjudegcount=count($benchjudeg);
}
//$myArray=(array)$benchjudeg;
//  $myArray[0]->judge_name;

if(isset($listingjudeg))
{
$listingjudeg=(array)$listingjudeg;
//echo $myArray[0]->bench_no ?? '';
}
?>

<div class="app-content">
  <div class="main-content-app">
    <div class="page-header">
     <!-- <h4 class="page-title">View Cause List</h4>
      <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item">View Cause List</li>
      </ol>-->
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Generate Cause List 
            <ul class="more-action">
              <li><a href="<?php echo base_url(); ?>proceeding/dashboard_main" class="previous">&laquo; Back</a></li>
            </ul>
          </div>
          <div class="panel-body">
    <form id="causelist" class="form-horizontal" role="form" method="post" action='<?= base_url();?>causelist/view_causelist'  name="causelist" enctype="multipart/form-data">
      <div class="form_error">
        <?php echo validation_errors(); ?>
      </div>

      <?php  
        if(!empty($success_msg)){ 
            echo '<div class="alert alert-success">'.$success_msg.'</div>'; 
        }elseif(!empty($error_msg)){ 
            echo '<div class="alert alert-danger">'.$error_msg.'</div>'; 
        } 
      ?>

      <div class="row">
        <div class="col-md-3">
          <label for="from_list_date"><span style="color: red;">*</span>Date</label>
          <input type="text" class="form-control" name="from_list_date" id="from_list_date"  placeholder="">
        </div>

        <div class="col-md-3">
          <label for="venue" ><span style="color: red;">*</span>Select venue</label>    
          <select type="text" class="form-control chosen-single chosen-default" name="venue" id="venue" onchange="">
            <option value="">-- Select venue --</option>
            <?php foreach($venues as $venue):?>              
            <option value="<?php echo $venue->id;?>"> <?php echo $venue->name; ?> </option>
            <?php endforeach;?>
          </select> 
          <label class="error"><?php echo form_error('venue'); ?></label>
        </div>

        <div class="col-md-3">
          <label for="venue">Time</label>    
          <?php
            $start = "00:00"; //you can write here 00:00:00 but not need to it
            $end = "23:30";

            $tStart = strtotime($start);
            $tEnd = strtotime($end);
            $tNow = $tStart;
            echo '<select type="text" class="form-control chosen-single chosen-default" name="time" id="time">';
            while($tNow <= $tEnd){
                echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                $tNow = strtotime('+30 minutes',$tNow);
            }
            echo '</select>';
          ?>
        </div>
        <div class="col-md-3 mt-30">
          <button type="submit" class="btn btn-success" name="submitbtn" id="submitbtn">Submit</button>
        </div>
      </div>     
 

      <?php

        function group_by($key, $data) {
            $result = array();

            foreach($data as $val) {
                if(isset($val)){
                    $result[$val->$key][] = $val;
                }else{
                    $result[""][] = $val;
                }
            }

            return $result;
        }


        function sort_by_judge_type($listingjudeg) {
         
        $judge_type = array();
        foreach ($listingjudeg as $key => $row)
        {
            $judge_type[$key] = $row->judge_type;
        }
        array_multisort($judge_type, SORT_ASC, $listingjudeg);
        return $listingjudeg;
        }


         if(isset($listingjudeg)) {

        $new_listingjudeg = group_by('bench_no', $listingjudeg);
        //echo '<pre>'; print_r($new_listingjudeg);exit;

      ?>
      <div class="listingjudeg">
        <div align="center" style="font-size:150%;"> <B>LOKPAL OF INDIA</B></div>
        <div align="center" style="font-size:100%;"><b>Vasant Kunj<b></div>
        <div align="center" style="font-size:150%;"><b> *** </b></div>
        <div align="center" style="font-size:150%;"> <B><?php echo $nameOfDay.' ,'.' '.$dd[2].' '.$month_name.','.' '.$year.' '.'at' .' '.$newDateTime;?></B></div><br>
        <div align="center" style="font-size:150%;"> <B><U>CAUSE LIST</U></B></div><br><br>

        <!--<div align="center"> <B>Cause List for <?php echo $chkdate;?></B></div><br>-->
        <?php
          foreach($new_listingjudeg as $row)
          {
            $row = sort_by_judge_type($row);
            echo "<li>CORAM:</li>";
            foreach($row as $subRow)
            {
              echo "<ul>";
               if($subRow->judge_type=='C')
              {
                echo "<li> HON'BLE".$subRow->judge_name.'-'.'(HCP)'."</li>";
              }         

              if($subRow->judge_type=='J')
              {
                echo "<li> HON'BLE".$subRow->judge_name.'-'.'(HJM)'."</li>";
              } 
             
              if($subRow->judge_type=='M')
              {
                echo "<li>HON'BLE".$subRow->judge_name.'-'.'(HM)'."</li>";
              } 
              echo "</ul>";

          } 
        ?>


        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sr No</th>
              <th>Complaint No</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $i=1;
          foreach ($getComplainNo as $key => $complainNo)
          {
            if($row[0]->bench_no == $complainNo->bench_no){  
             echo "<tr><td>".$i."</td>";
             echo "<td>".get_complaintno($complainNo->filing_no)."</td>";
             
             echo "</tr>";
             $i++;
            }
            }
          ?>
          </tbody>
        </table>



        <?php }
        }
        ?>
      </div>

      <?php // } ?>

    </form>
 
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

     $('#from_list_date').datepicker({
                    format: "dd-mm-yyyy",
                    //startDate: '-0d',
                     autoclose: true,
                    todayHighlight: true

                });  



   </script>


