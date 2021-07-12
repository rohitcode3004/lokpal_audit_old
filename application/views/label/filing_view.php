<?php print "<pre>";
print_r($element);
print "</pre>";
//die('werinview'); ?>
   <div class="panel-default">
                <div class="panel-heading">
                    <span id="ContentPlaceHolder1_search" class="searchComplaint" placeholder="Search"></span>
                    <h5 class="panel-title">
                       
                        FORM OF COMPLAINT : (PART - A)
                    </h5>
                </div>
    <b><h2 class="searchComplaint"></h2></b>
    </div>

<form>
<div class="form-row">
  <div class="col-md-3">                   
  <label for="complaint_capacity_id"><span style="color: red;">*</span>Comp.Capacity</label>    
  <select type="text" class="form-control" style="width:90%;" name="complaint_capacity_id" id="complaint_capacity_id">
    <option value="">Select Complainant Capicity</option>
    <option value="1"> Individual </option>
    <option value="2"> Society </option>
    <option value="3"> Association of Persons </option>
    <option value="4"> Trust </option>
    <option value="5"> Company </option>
    <option value="6"> Limited Liability Partnership </option>
    <option value="7"> Board </option>
    <option value="8"> Body </option>
    <option value="9"> Corporation </option>
    <option value="10"> Authority </option>
    <option value="11"> Others </option>
  </select>                                           
  </div> 

  <div class="col-md-3 col-xs-12">                   
    <label for="complaintMode_id"><span style="color: red;">*</span>Complainant Mode</label>    
    <select type="text" class="form-control" style="width:90%;" name="complaintMode_id" id="complaintMode_id">
      <option value="">Select Complainant Mode</option>
      <option value="1"> In person </option>
      <option value="2"> By Post </option>
      <option value="3"> Electronically (A copy be submitted physically) </option>
    </select>        
  </div>
  </div>

  <br>
  <div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 75%; color: indianred;">Name of the Complainant -</b></legend>
  </div>

  <div class="form-row">
   <div class="col-md-3 col-xs-12">                   
   <label for="salutation_id"><span style="color: red;">*</span>Salutation</label>    
    <select type="text" class="form-control" style="width:90%;" name="salutation_id" id="salutation_id">
      <option value="">Select Salutation Name</option>
      <option value="1"> Shri </option>
      <option value="2"> Smt </option>
      <option value="4"> Mrs </option>
      <option value="5"> Kumari </option>
      <option value="7"> Proof </option>
      <option value="8"> Er.etc. </option>
      <option value="3"> Mr. </option>
      <option value="6"> Dr. </option>
    </select>        
    </div>

  <div class="col-md-3">
    <label for="sur_name"><span style="color: red;">*</span><?php echo $element[2]['field_name_long'] ?></label>
    <input type="text" class="form-control" name="sur_name" id="sur_name" style="width:90%;" maxlength="60" onkeypress="return ValidateAlpha(event)" placeholder="Enter Sur Name..">        
  </div>
  <div class="col-md-3">
    <label for="mid_name"><?php echo $element[3]['field_name_long'] ?></label><span style="color: red;">*</span>       
      <input type="text" class="form-control" style="width:90%;" name="mid_name" id="mid_name" onkeypress="return ValidateAlpha(event)" placeholder="Enter Middle Name..">        
  </div>

  <div class="col-md-3">
    <label for="first_name"><span style="color: red;">*</span><?php echo $element[4]['field_name_long'] ?> </label>
     <input type="text" class="form-control" name="first_name" id="first_name" maxlength="50" style="width:90%;" onkeypress="return ValidateAlpha(event)" placeholder="Enter First Name..">        
  </div> 
  </div>

  <br>
  <div class="form-row">        
   <div class="col-md-3 col-xs-12">                   
      <label for="gender_id"><span style="color: red;">*</span><?php echo $element[5]['field_name_long'] ?></label>    
      <select type="text" class="form-control" style="width:90%;" name="gender_id" id="gender_id">
       <option value="">Select Complainant Name</option>
       <option value="1"> Male </option>
       <option value="2"> Female </option>
       <option value="3"> Transgender </option>
      </select>        
   </div>
   <div class="col-md-3">
        <label for="age_years"><span style="color: red;">*</span><?php echo $element[6]['field_name_long'] ?></label>
           <input type="text" class="form-control" name="age_years" style="width:90%;" maxlength="3" id="age_years" onkeypress="return isNumberKey(event)" placeholder="Enter Your Age in Year..">
   </div>
   <div class="col-md-3">
     <label for="fath_name"><span style="color: red;">*</span><?php echo $element[7]['field_name_long'] ?></label>       
       <input type="text" class="form-control" name="fath_name" id="fath_name" maxlength="50" style="width:90%;" onkeypress="return ValidateAlpha(event)" placeholder="Enter Father Name..">        
   </div> 
   <div class="col-md-3 col-xs-12">                   
      <label for="nationality_id"><span style="color: red;">*</span><?php echo $element[8]['field_name_long'] ?></label>    
         <select type="text" class="form-control" style="width:90%;" name="nationality_id" id="nationality_idsss">
          <option value="">Select Nationality</option>
          <option value="1"> Citizen of India </option>
          <option value="2"> Not Citizen of India (Attach Copy of Passport) </option>
          </select>        
    </div>
   </div> 
   
   <br>
   <div class="searchComplaint">
   <legend style="" align="margin-left"><b style="font-size: 75%; color: indianred;">Detail of identity-</b></legend>   
   </div>

   <div class="row">   
      <div class="col-md-3">
         <label for="identity_proof_id">Identity Document</label><span style="color: red;">*</span>   
           <select type="text" class="form-control" style="width:90%;" name="identity_proof_id" id="identity_proof_id">
            <option value="" class="chosen-single">Select Identity Document</option>
            <option value="1">Driving License </option>
            <option value="3">Passbook with Photograph (Bank/ Post Office) </option>
            <option value="2">Service Identity Card with Photograph issued by Central/ State/ PSU, Public Limited Companies </option>
            <option value="4">PAN Card </option>
            <option value="5">Smart Card Issued by RGI under NPR </option>
            <option value="6">MNREGA Job Card </option>
            <option value="7">Health Insurance Card issued under the Scheme of Ministry of Labour </option>
            <option value="8">PPO with photograph </option>
            <option value="9">Official I-Card issued to MPs/ MLAs, MLCs </option>
            <option value="10">Aadhaar Card </option>
            <option value="11">Passport (Not a Citizen of India) </option>
           </select>        
      </div>

      <div class="col-md-3">
          <label for="identity_proof_no">Number</label><span style="color: red;">*</span>
             <input type="text" class="form-control" style="width:90%;" name="identity_proof_no" id="identity_proof_no" placeholder="Enter Identity proof number..">
      </div>

       <div class="col-md-3">
          <label for="identity_proof_doi">Date of Issue</label><span style="color: red;">*</span>
             <input type="text" class="form-control" style="width:90%;" name="identity_proof_doi" id="identity_proof_doi" placeholder="Enter Date of Issue..">
        </div>

     <div class="col-md-3">
          <label for="identity_proof_vupto">Validity Upto Date</label><span style="color: red;">*</span>
             <input type="text" class="form-control" style="width:90%;" name="identity_proof_vupto" id="identity_proof_vupto" placeholder="Enter Date of Validity..">
        </div>
   </div>

   <br>
   <div class="row">
     <div class="col-md-3">
           <label for="identity_proof_iauth">Issuing Authority</label>
           <input type="text" class="form-control" style="width:90%;" name="identity_proof_iauth" id="identity_proof_iauth" placeholder="Enter issue authority ..">
     </div>
     <div class="col-md-3">
          <label for="identity_proof_upload">Document Upload</label>
             <input type="file" style="width:90%;" id="identity_proof_upload" name="identity_proof_upload" class="form-control" size="20">     
     </div> 
        
  </div>

  <!-- <div class="form-group">
    for single box in row
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>-->

  <!-- <div class="form-row">
    for a row with mant boxes
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>-->
  <br>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Agree to term and conditions
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>