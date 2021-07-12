<style type="text/css">
  .help-block{
    color: #a94442 !important;
  }
  .status-msg{
    color: #a94442 !important;
  }
</style>
<?php include(APPPATH.'views/admin/templates/admin_header.php'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
              <div class="container-fluid">
              <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add New Permissions</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                        <?php  
        if(!empty($success_msg)){ 
            echo '<p class="status-msg success"><h3>'.$success_msg.'</h3></p>'; 
        }elseif(!empty($error_msg)){ 
            echo '<p class="status-msg error"><h3>'.$error_msg.'</h3></p>'; 
        } 
        echo '<p class="status-msg success"><h3>'.$this->session->flashdata('success_msg').'</h3></p>';

    ?>
                <div class="row">
                  <form method="POST" action="<?php echo base_url('menu/insert_perm') ?>">
                    <div class="col-lg-6">
                        <div class="form-group">
                         <label>Role Name</label>
                          <select class="form-control" name="role_name">
                            <option value="">--Select role--</option>
                          <?php foreach($roles as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                          <?php } ?>
                          </select>
                          <?php echo form_error('role_name','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                         <label>Menu Name</label>
                          <select class="form-control" name="menu_name" onChange="getsubmenu(this.value);">
                            <option value="">--Select menu--</option>
                          <?php foreach($menus as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->menu_name ?></option>
                          <?php } ?>
                          </select>
                          <?php echo form_error('menu_name','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                         <label>Submenu Name</label>
                          <select class="form-control" name="submenu_name" id="submenus">
                            <option value="">--Select submenu--</option>
                          <?php foreach($submenus as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->menu_name ?></option>
                          <?php } ?>
                          </select>
                          <?php echo form_error('menu_name','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>Display</label>
                          <select type="text" class="form-control" name="display" id="display">
                  <option value="t">On</option>
                  <option value="f"> Off </option>
                </select>
                          <?php echo form_error('display','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>
            
                                                                                
                     </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <button type="submit" class="btn btn-default" name="submitform" value="subm">Submit</button>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->


                            <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/raphael.min.js"></script>-->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/morris.min.js"></script>-->
        <!--<script src="<?php echo base_url(); ?>assets/admin/js/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>assets/admin/js/startmin.js"></script>

    </body>
        <script type="text/javascript">

      function getsubmenu(value)
        {  
          var post_url= '<?php echo base_url('menu/fetch_submenus')?>';
          var request_method= 'POST';
  
      $.ajax({
        url : post_url,
        type: request_method,
        data : 'menuid='+value,
      }).success(function(response){ //
        $("#submenus").html(response);
        
      });
   }
    </script>
</html>
