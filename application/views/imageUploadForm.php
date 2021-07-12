<!DOCTYPE html>
<html> 
<head> 
  <title>Codeignier 3 Image Upload with Resize Example from Scratch</title> 
</head>


<body> 


  <?php //echo $error;?> 
  <?php echo form_open_multipart('document/uploadImage');?> 
     <input type="file" name="image1" size="20" />
      <input type="file" name="image2" size="20" />
     <input type="submit" value="upload" /> 
  </form> 


</body>
</html>

