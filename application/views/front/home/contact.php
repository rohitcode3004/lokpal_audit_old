<?php include(APPPATH.'views/templates/front/template-top.php'); ?>
<div class="jumbotron jumbotron-single d-flex align-items-center" style="background-image: url(<?php echo base_url(); ?>assets/front/img/bg.jpg)">
  <div class="container text-center">
    <h1 class="display-2 mb-4">Contact Us</h1>
  </div>
</div>		<!-- Contact Form Section -->
<section id="contact-form" class="bg-white">
    <div class="container"> 
        <div class="section-content">
            <!-- Section Title -->
            <div class="title-wrap">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-sub-title">Praesent commodo cursus magna, vel scelerisque nisl consectetur et. <br> pharetra augue. Donec id elit non mi.</p>
            </div>
            <!-- End of Section Title -->
            <div class="row">
                <!-- Contact Form Holder -->
                <div class="col-md-8 offset-md-2 contact-form-holder mt-4">
                    <form class="contact-form" method="post" name="contact-form" action="" novalidate >
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
								<label for="name"></label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required />
								<label for="email"></label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="phoneNumber" name="phone" placeholder="Phone" required />
								<label for="phone"></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Reason for contact" required />
								<label for="subject"></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your Message ..." required ></textarea>
								<label for="message"></label>
                            </div>
                            <div class="col-md-12 text-center">
                                <input class="btn btn-success btn-shadow btn-lg" type="submit" name="submit" value="SEND MESSAGE" > 
                            </div>
							<div class="col-md-12 text-center">
								<label for="message"></label>
								<div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i></div>
							</div>
							<div class="col-md-12 info"></div>
                        </div>
                    </form>
                </div>
                <!-- End of Contact Form Holder -->
            </div>
        </div>
        <div class="section-content pt-0">
            <div class="title-wrap">
                <h2 class="section-title">Where To Find Us?</h2>
            </div>
            <div class="row text-center mt-4">                
                <div class="col-md-4" data-aos-delay="200">
                    <span class="lnr lnr-clock fs-40 py-4 d-block"></span>
                    <h5>WORKING TIME</h5>
                    <p>Mon. - Fri.: 11AM - 19PM</p>
                </div>
                <div class="col-md-4" data-aos-delay="400">
                    <span class="lnr lnr-phone fs-40 py-4 d-block"></span>
                    <h5>CALL US</h5>
                    <p>123-45678</p>
                </div>
                <div class="col-md-4" data-aos-delay="600">
                    <span class="lnr lnr-phone fs-40 py-4 d-block"></span>
                    <h5>EMAIL</h5>
                    <p>info@e-training.com</p>
                </div>

            </div>
        </div>
    </div>
</section>
<?php include(APPPATH.'views/templates/front/template-bottom.php'); ?>
