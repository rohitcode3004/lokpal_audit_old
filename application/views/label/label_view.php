<?php include(APPPATH.'views/templates/front/header2.php'); ?>
<script src="<?php echo base_url();?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

<div class="container">
<div class="row">     
        <div class="col-md-12">
        <h4>Master Labels Datatable</h4>
        <div class="col-md-6" align="right">
          <button type="button" id="add_button" class="btn btn-info btn-xs">Add</button>
        </div>
        <br>
        <br>
        <div class="table-responsive">

                <span id="success_message"></span>
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
                   <th>Unique Id</th>
                   <th>Form</th>
                     <th>Label Long Name</th>
                     <th>Label Short Name</th>
                     <th>Description</th>
                     <th>Display</th>
                     <th>Edit</th>
                      
                     <th>Delete</th>
                   </thead>
    <tbody>
    
      
    </tbody>
        
</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
</ul>
                
            </div>
            
        </div>
	</div>
</div>

<div class="modal fade" id="elementModel" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" id="element_form">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading"></h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
            <label>Level:</label>
        <select type="text" class="form-control" name="level" id="level">
          <option value="">Select Level</option>
          <option value="1"> Filling </option>
          <option value="2"> Scrutiny </option>
        </select>
        <span id="level_error" class="text-danger"></span>
        </div>

        <div class="form-group">
        <label>Long Name:</label>
        <input class="form-control " type="text" placeholder="Long name" name="longname" id="longname">
        <span id="longname_error" class="text-danger"></span>
        </div>

        <div class="form-group">
        <label>Short Name:</label>
        <input class="form-control " type="text" placeholder="Short name" name="shortname" id="shortname">
        <span id="shortname_error" class="text-danger"></span>
        </div>

        <div class="form-group">
          <label>Description:</label>
        <input class="form-control " type="text" placeholder="Description" name="description" id="description">
        </div>

        <div class="form-group">
          <label>Display:</label>
        <select type="text" class="form-control" name="display" id="display">
          <option value="t">On</option>
          <option value="f"> Off </option>
        </select>
        <span id="display_error" class="text-danger"></span>
        </div>

          <div class="modal-footer ">
            <input type="hidden" name="element_id" id="element_id">
            <input type="hidden" name="data_action" id="data_action" value="insert">
            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" style="width: 100%;">
            <br><br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </form>
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
</div>

    <script type="text/javascript">
      $(document).ready(function(){
        function fetch_data()
        {
          $.ajax({
            url: "<?php echo base_url(); ?>test_label/action",
            method: "POST",
            data: {data_action:'fetch_all'},
            success:function(data)
            {
              $('tbody').html(data);
            }
          })
        }
        fetch_data();

        $('#add_button').click(function(){
          $('#element_form')[0].reset();
          $('.modal-title').text("Add Label");
          $('#action').val('Add');
          $('#data_action').val('insert');
          $('#elementModel').modal('show');

          $('#level_error').html('');
          $('#longname_error').html('');
          $('#shortname_error').html('');
          $('#display_error').html('');
        });

        //works for both insert and update
        $(document).on('submit', '#element_form', function(event){
          event.preventDefault();
          $.ajax({
            url:"<?php echo base_url(); ?>test_label/action",
            method: "POST",
            data: $(this).serialize(),
            daatType: "json",
            success: function(data){
              obj= JSON.parse(data);
              //console.log(obj);
              if(obj.success){
                $('#element_form')[0].reset();
                $('#elementModel').modal('hide');
                fetch_data();
                if($('#data_action').val() == "insert"){
                  $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                }
                if($('#data_action').val() == "edit"){
                  $('#success_message').html('<div class="alert alert-success">Data Updated</div>');
                }
              }
              if(obj.error){
                $('#level_error').html(obj.level);
                $('#longname_error').html(obj.long_name);
                $('#shortname_error').html(obj.short_name);
                $('#display_error').html(obj.display);
              }
            }
          })
        });

      $(document).on('click', '.edit', function(){
        var element_id = $(this).attr('id');
          $.ajax({
            url:"<?php echo base_url(); ?>test_label/action",
            method: "POST",
            data: {element_id:element_id, data_action:'fetch_single'},
            daatType: "json",
            success: function(data){
              obj= JSON.parse(data);
              //console.log(obj.serial_no);
              $('#elementModel').modal('show');
              $('#level').val(obj.level);
              $('#longname').val(obj.long_name);
              $('#shortname').val(obj.short_name);
              $('#description').val(obj.description);
              $('#display').val(obj.display);
              $('.modal-title').text('Edit Label');   
              $('#element_id').val(element_id);   
              $('#action').val('Edit');   
              $('#data_action').val('edit');

              $('#level_error').html('');
              $('#longname_error').html('');
              $('#shortname_error').html('');
              $('#display_error').html('');

              }
          })
        });

      });
    </script>