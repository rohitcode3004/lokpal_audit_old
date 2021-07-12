<html>
<head>
    <title>File Upload In Codeigniter</title>
</head>
<body>
<?php  echo $error;?> 


 <form id="filingform" class="form-horizontal" style="border: 1px solid #456073!important;" role="form" method="post" action='<?= base_url();?>Document/do_upload'  name="filingform" enctype="multipart/form-data">
<?php echo "<input type='file' name='userfile' size='20' />"; ?>
<?php echo "<input type='submit' name='submit' value='upload' /> ";?>
<?php echo "</form>"?>
</body>
</html>
