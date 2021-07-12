<?php include(APPPATH.'views/templates/front/template-top.php');
 $pgtitle = (!empty($this->uri->segment(4))) ? str_ireplace("-"," ",ucwords($this->uri->segment(4))) : "All Courses";
?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4"><?php echo ucwords($page_title); ?></h1>
  </div>
</div>	
<div class="container">
	<nav class="breadcrumb">
	  <a class="breadcrumb-item" href="#">Training Courses</a>
	  <a class="breadcrumb-item" href="<?php echo base_url() ?>training/programs/<?php echo $this->uri->segment(3); ?>"><?php echo ucwords($page_title) ?></a>
	  <span class="breadcrumb-item active"><?php echo !empty($page_stitle) ?  $page_stitle : ucwords($pgtitle) ?></span>
	</nav>
</div>
<!-- Blog Section -->
<section id="blog" class="bg-grey">
    <div class="container">
        <div class="section-content">
			<div class="row">
				<div class="col-md-8">                
						<div class="title-wrap mb-5">
							<h2 class="section-title text-left"> <?php echo !empty($page_stitle) ?  $page_stitle : ucwords($pgtitle); ?></h2>
							<p class="section-sub-title text-left"><?php echo (!empty($courses)) ? sprintf("Total <b>%s</b> records found.",count($courses)) : "Sorry, no course found in the selected category." ?> </p>
						</div>
						<div class="row">
							<!-- Blog Item -->
							<?php if(!empty($courses)){
								//echo "<pre>";print_r($courses);
								foreach($courses as $crse){
									$dtlPath = trim($this->uri->segment(3))."/".preg_replace("/[^a-zA-Z0-9\s\-\:]/", "-",str_ireplace(" ","-",strtolower($crse['name'])))."/".encrypt($crse['id']);
							?>
							<div class="col-md-6 blog-item-wrapper">
								<div class="blog-item">
									<div class="blog-img">
										<a target="_blank" href="<?php echo base_url(); ?>training/course/<?php echo $dtlPath; ?>"><img src="<?php echo base_url(); ?>uploads/training_img/thumbnail/<?php echo !empty($crse['image']) ? $crse['image'] : "blog-1.jpg" ?>" alt=""></a>
									</div>
									<div class="blog-text">
										<div class="blog-title">
											<a target="_blank" href="<?php echo base_url(); ?>training/course/<?php echo $dtlPath; ?>"><h4><?php echo $crse['name']; ?></h4></a>                                       
										</div>
										<?php if(!empty($crse['certification'])){ ?>
										<div class="blog-tag">
											<h6><small><?php echo $crse['certification']; ?></small></h6>
										</div>
										<?php } ?>
										<div class="blog-desc">
											<p><?php echo substr(strip_tags($crse['description']),0, 100); ?>...</p>
										</div>
										<div class="blog-author">
											<a target="_blank" href="<?php echo base_url(); ?>training/course/<?php echo $dtlPath; ?>" class="btn btn-link p-0">
												<span>VIEW DETAILS</span>
												<span class="lnr lnr-arrow-right"></span>
											</a>
										</div>
										
									</div>
								</div>
							</div>
							<?php } } ?>
							<!-- End of Blog Item -->
						</div>            
				</div>
				<div class="col-md-4">
					<?php include(APPPATH.'views/templates/front/category.php'); ?>
				</div>
			</div>
		</div>
	</div>	
</section>
<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>
