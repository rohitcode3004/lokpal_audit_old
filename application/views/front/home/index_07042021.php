<?php include(APPPATH.'views/templates/front/fheader.php'); ?>

  <div class="container home-main">
    <!-- ================== Start Header Section ============ -->
    <header class="header row">
      <div class="left-logo"><a href="<?php echo base_url(); ?>home/index"><img class="img-responsive" src="<?php echo base_url(); ?>assets/my_assets/images/lokpal_logo.png" alt="left-logo"></a></div>
      <div class="right-logo"><a href="<?php echo base_url(); ?>home/index"><img class="img-responsive" src="<?php echo base_url(); ?>assets/my_assets/images/logo_lokpal.png" alt="right-logo"></a> </div>
      <div class="projecttitle">
        <div class="hindi-title">LOKPAL ONLINE</div>
        <div class="english-title">Complaint's Management System</div>
      </div>
    </header>

    <!-- ================== Start Header Section ============ -->
    <section class="wapper-container row">
      <div class="col-md-9">

        <!-- ==============Start slider Section ================ -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
        
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
        
              <div class="item active">
                <img src="<?php echo base_url(); ?>assets/my_assets/images/Banner-1.jpg" alt="Los Angeles" style="width:100%;">
                <div class="carousel-caption">
                  <h3>Welcome to Lokpal Online-Complaint’s Management System</h3>
                </div>
              </div>
        
              <div class="item">
                <img src="<?php echo base_url(); ?>assets/my_assets/images/banner-2.jpg" alt="Chicago" style="width:100%;">
                <div class="carousel-caption">
                  <h3>Welcome to Lokpal Online-Complaint’s Management System</h3>
                </div>
              </div>

              <div class="item">
                <img src="<?php echo base_url(); ?>assets/my_assets/images/Banner-3.jpg" alt="Chicago" style="width:100%;">
                <div class="carousel-caption">
                  <h3>Welcome to Lokpal Online-Complaint’s Management System</h3>
                </div>
              </div>
          
            </div>
        
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
              <span class="sr-only">Next</span>
            </a>
        </div> 

        <div class="row">

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="count-box">
              <div class="count-icon">
                <i class="fa fa-file-archive-o" aria-hidden="true"></i>
              </div>
              <div class="count-caption">
                <h6>Total Complaint’s</h6>
                <h3 class="count-num">0</h3>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="count-box">
              <div class="count-icon">
                <i class="fa fa-spinner" aria-hidden="true"></i>
              </div>
              <div class="count-caption">
                <h6>Inprocess Complaint’s</h6>
                <h3 class="count-num">0</h3>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="count-box">
              <div class="count-icon">
                <i class="fa fa-cubes" aria-hidden="true"></i>
              </div>
              <div class="count-caption">
                <h6>Resolved Complaint’s</h6>
                <h3 class="count-num">0</h3>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="count-box">
              <div class="count-icon">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
              </div>
              <div class="count-caption">
                <h6>Forwarded Complaint’s</h6>
                <h3 class="count-num">0</h3>
              </div>
            </div>
          </div>

        </div>


      </div>
      <div class="col-md-3 bg-light-green">
        <div class="row">

          <div class="col-sm-12 mt-15">
            <a href="<?php echo base_url(); ?>admin/login" class="user-login">
              <div class="user-icon">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="user-title">Public User</div>
            </a>
          </div>

          <div class="col-sm-12">
            <a href="<?php echo base_url(); ?>admin/login" class="user-login">
              <div class="user-icon">
                <i class="fa fa-university" aria-hidden="true"></i>
              </div>
              <div class="user-title">Lokpal Internal</div>
            </a>
          </div>

          <div class="col-sm-12">
            <a href="<?php echo base_url(); ?>admin/login" class="user-login">
              <div class="user-icon">
                <i class="fa fa-address-book-o" aria-hidden="true"></i>
              </div>
              <div class="user-title">Admin Login</div>
            </a>
          </div>

        </div>
      </div>
    </section>

    <footer class="footer row">
      <p>Copyright &copy;2021, All Rights Reserved, Lokpal of India. Designed & developed by NIC.</p>
    </footer>
  </div>
<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/ffooter.php'); ?>

