<?php include(APPPATH.'views/templates/front/template-top.php'); ?>

<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4">Course Details</h1>
  </div>
</div>	
<div class="container">
	<nav class="breadcrumb">
	  <a class="breadcrumb-item" href="#">Training Courses</a>
	  <a class="breadcrumb-item" href="<?php echo base_url() ?>training/programs/<?php echo str_ireplace(" ","-",strtolower($this->data['course']['pname'])) ?>"><?php echo $this->data['course']['pname']; ?></a>
	  <a class="breadcrumb-item" href="<?php echo base_url() ?>training/programs/<?php echo str_ireplace(" ","-",strtolower($this->data['course']['pname'])) ?>/<?php echo preg_replace("/[^a-zA-Z0-9\s\-\:]/", "-",str_ireplace(" ","-",strtolower($this->data['course']['catname']))) ?>/<?php echo encrypt($this->data['course']['category_id']); ?>"><?php echo $this->data['course']['catname'] ?></a>
	  <span class="breadcrumb-item active"><?php echo $this->data['course']['name'] ?></span>
	</nav>
</div>
<section id="who-we-are" class="bg-grey">
	
    <div class="container">
        <div class="section-content">
        <div class="sh-portfolio-single row">
        <div class="sh-portfolio-single-right col-md-8">
        
			<h1 class="sh-portfolio-single-title"><?php echo $this->data['course']['name'] ?></h1>
			<?php if(!empty($this->data['course']['certification'])){ ?>
			<div class="blog-tag">
				<h6><small><?php echo $this->data['course']['certification']; ?></small></h6>
			</div>
			<?php } ?>
			
			<div class="sh-portfolio-single-description">
				<?php echo $this->data['course']['description'] ?>
			</div>
			<div class="sh-portfolio-single-description">
				<?php echo $this->data['course']['disclaimer'] ?>
			</div>
			<h5>Click the button below to enquire about this training course</h5>
			<div class="align-centre"><a href="<?php echo base_url(); ?>training/enquiry/<?php echo preg_replace("/[^a-zA-Z0-9\s\-\:]/", "-",str_ireplace(" ","-",strtolower($this->data['course']['name']))) ?>/<?php echo encrypt($this->data['course']['id']) ?>" class="btn btn-warning my-2 mx-2 my-sm-0 text-uppercase">ENQUIRY NOW</a></div>
        </div>
        <div class="category-single-left col-md-4">
           <?php include(APPPATH.'views/templates/front/category.php'); ?> 
        </div>
     </div>
   </div>
</div>

</section>	
<section id="blog" class="bg-grey">
    <div class="container">
        <div class="section-content">
         <div class="row">
            <div class="col-md-12">                
                    <div class="title-wrap mb-5">
                        <h2 class="section-title">Featured Training Programs</h2>
                        <p class="section-sub-title">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                    </div>
                    <div class="row">
                        <!-- Blog Item -->
                                <div class="col-md-3 blog-item-wrapper">
                                    <div class="blog-item">
                                        <div class="red-grad">
                                            <a class="grad-title" href="details.html">Introduction to Finance</a>
                                        </div>
                                        <div class="blog-text">
                                            <div class="blog-title">
                                                <a href="details.html"><h4>Introduction to Finance, Accounting, Modeling and Valuation Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet.Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet.</h4></a>                                       
                                            </div>
                                            <div class="blog-meta">
                                                <p class="blog-date">Lpsum dolor sit ame const</p>                                                 
                                            </div>
                                           
                                          
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Blog Item -->
                                <!-- Blog Item -->
                                <div class="col-md-3 blog-item-wrapper" data-aos-delay="200">
                                    <div class="blog-item">
                                       <div class="green-grad">
                                            <a class="grad-title" href="details.html">Communication Skills Master</a>
                                        </div>
                                        <div class="blog-text">
                                            <div class="blog-title">
                                                <a href="details.html"><h4>The Complete Communication Skills Master Class for Life</h4></a>
                                            </div>
                                            <div class="blog-meta">
                                                <p class="blog-date">Lpsum dolor sit ame const</p>
                                              
                                            </div>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Blog Item -->
                                <!-- Blog Item -->
                                <div class="col-md-3 blog-item-wrapper" data-aos-delay="400">
                                    <div class="blog-item">
                                        <div class="blue-grad">
                                            <a class="grad-title" href="details.html">Statement Analysis Training</a>
                                        </div>
                                        <div class="blog-text">
                                            <div class="blog-title">
                                                <a href="details.html"><h4>Accounting &amp; Financial Statement Analysis: Complete Training</h4></a>
                                            </div>
                                            <div class="blog-meta">
                                                <p class="blog-date">Lpsum dolor sit ame const</p>
                                               
                                            </div>
                                           
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Blog Item -->                                
                                
                                <!-- Blog Item -->
                                <div class="col-md-3 blog-item-wrapper">
                                    <div class="blog-item">
                                       <div class="purple-grad">
                                            <a class="grad-title" href="details.html">Modeling and Valuation</a>
                                        </div>
                                        <div class="blog-text">
                                            <div class="blog-title">
                                                <a href="details.html"><h4>Introduction to Finance, Accounting, Modeling and Valuation Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet.Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cras mattis consectetur purus sit amet.</h4></a>                                       
                                            </div>
                                            <div class="blog-meta">
                                                
                                                <p class="blog-date">Lpsum dolor sit ame const</p>
                                            </div>
                                            
                                          
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Blog Item -->
                            </div>            
            </div>
           
        </div>
    </div>
</div>
</section> 
<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>
