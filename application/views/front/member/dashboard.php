<?php include(APPPATH.'views/templates/front/template-top.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url('<?php echo base_url() ?>assets/front/img/bg.jpg')">
  <div class="container text-center">
    <h1 class="display-2 mb-4">My Dashboard</h1>
  </div>
</div>	<!-- Blog Section -->


<section id="blog">
    <div class="container">
      <div class="section-content">
        <div class="dasboard-nav row d-flex justify-content-center pb-4">           
            <?php include(APPPATH.'views/templates/front/member-menu.php'); ?>
        </div>
         <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <!-- Start of Calendar Section -->
                    <section id="blog">
                      <div class="title-wrap">
                        <h2 class="section-title text-left">Event Calendar</h2>
                        <p class="section-sub-title text-left">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                      </div>
                        <img src="img/google-calendar.png" alt="">
                    </section>
                    <!-- End of Calendar Section-->
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <div class="title-wrap">
                    <h2 class="section-title text-left">Training List</h2>
                    <p class="section-sub-title text-left">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                  </div>
                <div class="pt-3">
                    <div class="table-responsive-sm">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Training Name</th>
                                <th>Location</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>  
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training">View</a></td>
                            </tr>                                                                  
                        </tbody>                    
                    </table>
                </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
               <div class="title-wrap">
                    <h2 class="section-title text-left">Payment Evidence</h2>
                    <p class="section-sub-title text-left">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                  </div>
                <div class="pt-3">
                    <div class="table-responsive-sm">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Training Name</th>
                                <th>Location</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>  
                            <tr>
                                <td>Food Safety Management System Implementation Cours</td>
                                <td>Lagos</td>
                                <td>12 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>
                            <tr>
                                <td>Hazard Analysis and Critical Control Point Course</td>
                                <td>Rivers</td>
                                <td>15 Weeks</td>
                                <td>No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quality Management System for auditors and lead auditors</td>
                                <td>Akwa Ibom</td>
                                <td>24 Weeks</td>
                                <td>Yes</td>
                                <td><a href="<?php echo base_url() ?>member/training"> View</a></td>
                            </tr>                                                                  
                        </tbody>                    
                    </table>
                </div>
                </div>
              </div>
            </div>
  
      </div>
  </div>
</section>
<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>