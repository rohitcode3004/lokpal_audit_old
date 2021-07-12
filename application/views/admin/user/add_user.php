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
                            <h1 class="page-header">Add New Admin User</h1>
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
                  <form method="POST" action="<?php echo base_url('admin/save') ?>">
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" placeholder="Enter Username" name="username">
                          <?php echo form_error('username','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email">
                        <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mobile no</label>
                        <input type="text" class="form-control" placeholder="Enter Mobile no" name="mobile">
                        <?php echo form_error('mobile','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Enter Password" name="password">
                          <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Enter Confirm Password" name="passweord2">
                        <?php echo form_error('passweord2','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Select Role</h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                         <label>Role</label>
                          <select class="form-control" name="role">
                            <option value="">--Select role--</option>
                          <?php foreach($roles as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                          <?php } ?>
                          </select>
                          <?php echo form_error('role','<p class="help-block">','</p>'); ?>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="data_action" id="data_action" value="insert">
            <button type="submit" class="btn btn-default" name="submitform" value="subacc">Submit</button>
                    </form>
                                                                                
                     </div>
                        <!-- /.col-lg-12 -->
                    </div>
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
      $(document).ready(function(){

        });
    </script>
</html>
