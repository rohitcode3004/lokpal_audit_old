<?php include(APPPATH.'views/admin/templates/admin_header.php'); ?>
            <div id="page-wrapper">
                                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Menus</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div id="success_message">
                                        
                        </div>
                        <?php echo '<p class="status-msg success"><h3>'.$this->session->flashdata('success_msg').'</h3></p>'; ?>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Menus and Submenus
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                           <th><!--<input type="checkbox" id="checkall" />-->Sno.</th>
                                           <th>Menu Name</th>
                                             <th>Submenu</th>
                                             <th>Url</th>
                                             <th>Menu Priority</th>
                                             <th>Diplay</th>
                                             <th>Edit</th>
                                             <th>Delete</th>
                                            </thead>
                                            <tbody>
                                                <!--<tr class="odd gradeA">
                                                    <td>Trident</td>
                                                    <td>Internet Explorer 4.0</td>
                                                    <td>Win 95+</td>
                                                    <td class="center">4</td>
                                                    <td class="center">X</td>
                                                </tr>-->
                                                <!--<tr class="even gradeC">
                                                    <td>Trident</td>
                                                    <td>Internet Explorer 5.0</td>
                                                    <td>Win 95+</td>
                                                    <td class="center">5</td>
                                                    <td class="center">C</td>
                                                </tr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!--start modal-->   
      <div class="modal fade" id="elementModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
          <form method="post" id="element_form">
            <div class="modal-content">
               <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            <div class="modal-body mx-3">
                <div class="form-group">
                <label>Menu Name:</label>
                <input class="form-control " type="text" placeholder="Menu name" name="menuname" id="menuname">
                <span id="menuname_error" class="text-danger"></span>
              </div>

              <div class="form-group">
                <label>Priority:</label>
                <input class="form-control " type="text" placeholder="priority" name="priority" id="priority">
                <span id="priority_error" class="text-danger"></span>
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
            </div>
          </form>
         </div>
      </div>

                            <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/raphael.min.js"></script>-->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/morris.min.js"></script>-->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/startmin.js"></script>

    </body>
        <script type="text/javascript">
      $(document).ready(function(){

          $('#dataTables-example').DataTable({
             responsive: true
        });


        function fetch_data()
        {
          $.ajax({
            url: "<?php echo base_url(); ?>admin/action",
            method: "POST",
            data: {data_action:'fetch_all'},
            success:function(data)
            {
              $('tbody').html(data);
            }
          })
        }
        fetch_data();

        $('#create_menu').click(function(){
          $('#element_form')[0].reset();
          $('.modal-title').text("Create Menu");
          $('#action').val('Add');
          $('#data_action').val('insert_menu');
          $('#elementModel').modal('show');

          $('#menuname_error').html('');
          $('#priority_error').html('');
          $('#display_error').html('');
        });

        //works for both insert and update
        $(document).on('submit', '#element_form', function(event){
          event.preventDefault();
          $.ajax({
            url:"<?php echo base_url(); ?>admin/action",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
              obj= data;
              //console.log(obj);
              if(obj.success){
                $('#element_form')[0].reset();
                $('#elementModel').modal('hide');
                fetch_data();
                if($('#data_action').val() == "insert_menu"){
                  $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                }
                if($('#data_action').val() == "edit"){
                  $('#success_message').html('<div class="alert alert-success">Data Updated</div>');
                }
              }
              if(obj.error){
                $('#menuname_error').html(obj.menu_name);
                $('#priority_error').html(obj.priority);
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
            dataType: "json",
            success: function(data){
              obj= data;
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
</html>
