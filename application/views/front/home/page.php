<?php include(APPPATH.'views/templates/front/template-top.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg-about.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4"><?php echo $pgcontent['page_name'] ?></h1>
  </div>
</div>	<!-- Contact Form Section -->
<section id="single-content" class="bg-white">
    <div class="container">
        <div class="section-content blog-content">
            
            <div class="row">
                <!-- Single Content Holder -->
                <div class="col-md-8 offset-md-2 mt-4">
                    <?php echo $pgcontent['full_desc'] ?>
                </div>
                <!-- End of Contact Form Holder -->
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>
