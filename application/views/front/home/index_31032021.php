<?php include(APPPATH.'views/templates/front/header.php'); ?>



<!-- End of Reservation Section -->	<!-- Features Section-->
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>

<section class="wrapper banner-wrapper" role="banner" style="margin-top:50px;">
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="<?php echo base_url();?>assets/images/images-lok.png" style="width:100%">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="<?php echo base_url();?>assets/images/images-lok.png" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="<?php echo base_url();?>assets/images/images-lok.png" style="width:100%">
  <div class="text">Caption Three</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
</section>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>






<!--*********Content wrapper start here *********************-->
<div id="skipCont" class="wrapper"></div>
<section id="fontSize" class="wrapper body-wrapper" role="main" style="font-size: 100%;">

  <!--<marquee style="color:black; font-size: 12pt; font-weight: bold; text-decoration: none;"  onmouseover="stop();" onmouseout="start();">
  <span><img src="HTTPS://dgft.gov.in/sites/all/themes/cmf/images/new.gif" alt="W3C web site"></span>Online Course on basics of Export/Import visit -<a href="http://niryatbandhu.iift.ac.in/exim/" target="_blank" style="color:black;">http://niryatbandhu.iift.ac.in/exim/</a>
	<span><img src="HTTPS://dgft.gov.in/sites/all/themes/cmf/images/new.gif" alt="W3C web site"></span>
 Trade Notice No.40/2019-20 dated 13th December, 2019 signed by Shri S.P. Roy, Jt.DGFT is under circulation. It is hereby clarified that no such Trade Notice has been issued by DGFT. It is a fake Trade Notice.
</marquee>-->


<div class="flash-news-wrapper"><div style="width: 100000px; margin-left: 1563px; animation: 60.1344s linear 0.001s infinite normal none running marqueeAnimation-2687434;" class="js-marquee-wrapper"><div class="js-marquee" style="margin-right: 0px; float: left;">
<ul class="flash-news">

 <!--<li><span><img src="HTTPS://dgft.gov.in/sites/all/themes/cmf/images/new.gif" alt="W3C web site"></span>AEO can apply for Advance Authorisation under para 4.07A FTP on self ratification basis -<a href="HTTPS://dgft.gov.in/sites/default/files/TN10.pdf" target="_blank" style="color:black;">Trade Notice no. 10/2019-20</a> ! check availability of RCMC data on DGFT server services->RCMC->view RCMC Detail-<a href="HTTPS://dgft.gov.in/sites/default/files/Trade%20notice%20No.%2012%20dated%2013.05.2019.pdf" target="_blank" style="color:black;">Trade Notice no. 12/2019-20</a></li>-->
<!--<li><span><img src="HTTPS://dgft.gov.in/sites/all/themes/cmf/images/new.gif" alt="new"></span>Online platform for Certificate of Origin CoO has been launched HTTPS://coo.dgft.gov.in.
All exporters are requested to register on eCoO portal at an early date. All CoOs  will be issued electronically in a phased manner and the new system will do away with the paper submissions and physical interface with the Govt agency. Exporters to note that from 25 September all CoOs for India Chile PTA will be issued electronically on this portal and no paper applications to EIA or any other agency will be allowed. Refer Trade Notice 34 dated 20.9.2019</li>
-->
<li>

  <span><img src="<?php echo base_url();?>assets/images/new-icon.gif" alt="new"></span>Former Supreme Court Judge Justice Pinaki Chandra Ghose is the First Lokpal
    </li>

    <li>

  <span><img src="<?php echo base_url();?>assets/images/new-icon.gif" alt="new"></span>Filling up of four post (subject to variation) in the cadre of Personal Assistant on deputation in the Office of Lokpal. 

    </li>

    <li>

  <span><img src="<?php echo base_url();?>assets/images/new-icon.gif" alt="new"></span>Filling up of one post (subject to variation) in the cadre of Section Officer on deputation in the Office of Lokpal.  

    </li>

    <li>

  <span><img src="<?php echo base_url();?>assets/images/new-icon.gif" alt="new"></span>Filling up of three post (subject to variation) in the cadre of Assistant Section Officer on deputation in the Office of Lokpal.  

    </li>

    <li>

  <span><img src="<?php echo base_url();?>assets/images/new-icon.gif" alt="new"></span>Advertisement for the post of Staff Car Driver  

    </li>


</ul>
</div></div></div>




    <div class="container body-container" style="padding-top: 0px !important;">
  <div class="bg-wrapper top-body-wrapper">

     

      <!--Left-content panel start here -->
      <div class="left-panel">
        <!--E-services panel start here -->
        <div class="e-services left-cont">
          <div class="e-services-heading">
            
                <h2>Quick Links</h2>

               <!--
            <div class="service-btn">
             <a href="/e-services" title="view all e-services" class="view">VIEW ALL</a>
             </div>
--->

            </div>


		   <section class="region region-sidebar-first column sidebar">
            <div id="block-menu-menu-quick-links" class="block block-menu first last odd" role="navigation">
                       <ul class="menu">
                        <li class="menu__item is-leaf first leaf">
                          <a href="https://sci.gov.in/" title="Supreme Court Of India" id="crsclass" class="menu__link crsclass" target="_blank">Supreme Court Of India</a>

                        </li>
                         <li class="menu__item is-leaf leaf"><a href="https://dopt.gov.in/" class="menu__link" title="Department of Personnel and Training">Department of Personnel and Training</a>
                         </li> 
                         <li class="menu__item is-leaf leaf"><a href="http://lawmin.gov.in/" title="Ministry of Law and Justice" class="menu__link" target="_BLANK">Ministry of Law and Justice</a></li> 
                         <li class="menu__item is-leaf leaf"><a href="https://www.cvc.nic.in/" title="Central Vigilance Commission" class="menu__link" target="_BLANK">Central Vigilance Commission</a>
                         </li>
                          <li class="menu__item is-leaf leaf"><a href="http://cbi.gov.in/" class="menu__link" target="_BLANK" title="Central Bureau on Investigation">Central Bureau on Investigation</a></li>
                           <li class="menu__item is-leaf leaf"><a href="https://www.india.gov.in/" class="menu__link" title="National Portal of India" target="_BLANK">National Portal of India</a></li>
                            <li class="menu__item is-leaf leaf"><a href="https://indiacode.nic.in/" title="Digital Repository Of All central And State Acts(India Code)" 
                              class="menu__link" target="_BLANK">Digital Repository Of All central And State Acts(India Code)</a></li> 

                              <!--<li class="menu__item is-leaf leaf"><a href="#" title="External site that opens in a new window" class="menu__link" target="_BLANK">Hausing Urban Planning Department</a>
                              </li> 
                              <li class="menu__item is-leaf leaf"><a href="#" title="External site that opens in a new window" class="menu__link" target="_BLANK">RERA Maharashtra</a></li> <li class="menu__item is-leaf leaf"><a href="#" title="Minutes of Meetings of various Committees at DGFT" class="menu__link">RERA Madhya Pradesh</a>
                              </li> 
                              <li class="menu__item is-leaf last leaf">
                                <a href="#" class="menu__link">Import of pulses from Mozambique under MOU</a>
                              </li> -->
                            </ul>
                             </div>   </section>      

          </div><!--Left-content panel end here -->

		<!--Main-content what's new panel start here -->
       

        <div class="mid-cont tab-cont">
          <div id="parentHorizontalTab" style="display: block; width: 100%; margin: 0px;">
		    <ul class="resp-tabs-list hor_1 clearfix">

			<li class="resp-tab-item hor_1 resp-tab-active" aria-controls="hor_1_tab_item-0" role="tab" style="background-color: white; border-color: rgb(193, 193, 193);"><a href="javascript:void(0)" title="Notification">Notification</a>
      </li>
        <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-1" role="tab" style="background-color: rgb(255, 255, 255);"><a href="javascript:void(0)" title="Public Notice">Public Notice</a>
        </li>
              <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-2" role="tab" style="background-color: rgb(255, 255, 255);"><a href="javascript:void(0)" title="Circular">Circular</a>
              </li>
                              <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-3" role="tab" style="background-color: rgb(255, 255, 255);"><a href="javascript:void(0)" title="Trade Notices">Orders</a>
                              </li>

                           </ul>


			<div class="resp-tabs-container hor_1" style="border-color: rgb(193, 193, 193);">
              <h2 class="resp-accordion hor_1 resp-tab-active" role="tab" style="background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; border-color: rgb(193, 193, 193);" aria-controls="hor_1_tab_item-0"><span class="resp-arrow"></span>
                <a href="javascript:void(0)" title="Notification">Notification</a></h2><div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0" style="display:block">
                  <div class="region region-home-tab1">   
                    <div id="block-views-de410b737a411fd81188b163c71be1f1" class="block block-views first last odd">
                               <div class="view view-dgft-e-learning-initiatives view-id-dgft_e_learning_initiatives view-display-id-block_4 view-dom-id-c3e4d77277881fd46d23c5d428b022b6">                    
                                 <div class="view-content">      
                                <div class="item-list">
                                    <ul>     
                                        
                                         <li class="views-row views-row-1 views-row-odd views-row-first">    
Draft Rules for Group 'C' posts-Multi Tasking Staff in Lokpal <a href="http://localhost/lokpal/pdfs/lokpal-270820191.PDF" target="_BLANK" title="Draft Rules for Group 'C' posts-Multi Tasking Staff in Lokpal">Download (101.35 KB) <img src="<?php echo base_url();?>assets/images/new.gif" alt="Amendment in Para 6.01(k) of Foreign Trade Policy 2015-20" width="16" height="16"></a>
</li> 

            <li class="views-row views-row-2 views-row-even">

               <div class="jq" style="display: none;">
  Notification No. 41</div>Notification regarding appointment of Chairperson, Lokpal <a href="http://localhost/lokpal/pdfs/lokpal_1273.pdf" target="_BLANK" title="Notification regarding appointment of Chairperson, Lokpal">Download (31.06.08 KB) <img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification No. 41" width="16" height="16"></a>
      </li>





                 <li class="views-row views-row-3 views-row-odd">
   <div class="jq" style="display: none;">Notification-39(E)
   </div> 
              Notification regarding appointment of Member, Lokpal               
                                <a href="http://localhost/lokpal/pdfs/lokpal_1287_0.pdf" target="_BLANK" title="Notification regarding appointment of Member, Lokpal">Download (127.27 KB) <img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification-39(E)" width="16" height="16">
                                </a>
                                    </li> 

                                <li class="views-row views-row-4 views-row-even">             
                                  <div class="jq" style="display: none;">Notification-40(E)</div>
                                                  Applications or Nominations for Chairperson and Members of Lokpal.               
                                                                <a href="http://localhost/lokpal/pdfs/Lokpal-Advertisement.pdf" target="_BLANK" title="Applications or Nominations for Chairperson and Members of Lokpal.">Download (7.06 KB)<img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification-40(E)" width="16" height="16">
                                                                </a>
                                                                    </li>  


                                                                <li class="views-row views-row-5 views-row-odd">
                                                                             <div class="jq" style="display: none;">Notification No. 38 
                                                                             </div>Constitution of Search Committee under Lokpal and Lokayuktas Act, 2013 
    <a href="http://localhost/lokpal/pdfs/407_02_2018-AVD-IVLP-27092018.pdf" target="_BLANK" title="Constitution of Search Committee under Lokpal and Lokayuktas Act, 2013
">Download (1.68 MB) <img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification No. 38 " width="16" height="16"></a>
        </li>          


         <li class="views-row views-row-6 views-row-even">
                     <div class="jq" style="display: none;">Notification No. 36</div>Declaration of Assets and Liabilities by public servants under amended section 44 of the Lokpal and Lokayuktas Act, 2013 - reg.
 <a href="http://localhost/lokpal/pdfs/407_16_2016-AVD-IV-LP-01122016A.pdf" target="_BLANK" title="Declaration of Assets and Liabilities by public servants under amended section 44 of the Lokpal and Lokayuktas Act, 2013 - reg.">Download (232.82 KB) <img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification No. 36" width="16" height="16"></a>
                         </li> 

                                   <li class="views-row views-row-7 views-row-odd">             
                                    <div class="jq" style="display: none;">Notificaiton No. 37
                                    </div>The Constitution (One Hundred and Sixteenth Amendment) Bill, 2011               
                                    <a href="http://localhost/lokpal/pdfs/3451LS. constn 116 eng.pdf" target="_BLANK" title="The Constitution (One Hundred and Sixteenth Amendment) Bill, 2011">Download
                                      <img src="<?php echo base_url();?>assets/images/new.gif" alt="Notificaiton No. 37" width="16" height="16"></a>    </li>


                                                 <li class="views-row views-row-8 views-row-even views-row-last">
                                                              <div class="jq" style="display: none;">Notification No. 35</div>The Lokpal and Lokayuktas Bill, 2011 as introduced on 22/12/2011
<a href="http://localhost/lokpal/pdfs/3450LS, lokpal eng.pdf" target="_BLANK" title="The Lokpal and Lokayuktas Bill">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Notification No. 35" width="16" height="16"></a>
                                                                  </li>
                                                                         </ul>
                                                                       </div>
                                                                           </div>


                                                                                              <div class="view-footer">       
                                                                                                <a href="#" title="view-all" class="view">View All</a>
                                                                                                      </div>      
                                                                                                 </div>
                                                                                                  </div>
                                                                                                     </div>  
                                                                                                                    <div class="clear">
                                                                                                                      
                                                                                                                    </div>
              </div>

			  <h2 class="resp-accordion hor_1" role="tab" style="background-color: rgb(255, 255, 255); border-color: rgb(193, 193, 193);" aria-controls="hor_1_tab_item-1"><span class="resp-arrow"></span><a href="javascript:void(0)" title="Public Notice">Public Notice</a></h2>
        <div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-1" style="border-color: rgb(193, 193, 193);">
                   <div class="region region-home-tab2">
                        <div id="block-views-fd390dade24394875d0e04048985584d" class="block block-views first last odd">           <div class="view view-dgft-e-learning-initiatives view-id-dgft_e_learning_initiatives view-display-id-block_15 view-dom-id-072aaa7ff7472ecd937bed4ac475ea00">                     
                         <div class="view-content">      
                          <div class="item-list">
                              <ul>
                                    <li class="views-row views-row-1 views-row-odd views-row-first">Filling up of four post (subject to variation) in the cadre of Personal Assistant on deputation in the Office of Lokpal<a href="http://localhost/lokpal/pdfs/PA_R20122019.pdf" target="_BLANK" title="Filling up of four post (subject to variation) in the cadre of Personal Assistant on deputation in the Office of Lokpal">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Filling up of four post (subject to variation) in the cadre of Personal Assistant on deputation in the Office of Lokpal" width="16" height="16"></a>
                                                      </li>

                                               <li class="views-row views-row-2 views-row-even">Filling up of one post (subject to variation) in the cadre of Section Officer on deputation in the Office of Lokpal.<a href="http://localhost/lokpal/pdfs/so_12122019.pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Filling up of one post (subject to variation) in the cadre of Section Officer on deputation in the Office of Lokpal." width="16" height="16"></a>                <div class="jq" style="display: none;">Filling up of one post (subject to variation) in the cadre of Section Officer on deputation in the Office of Lokpal. </div>  </li> 

                                               <li class="views-row views-row-3 views-row-odd">Filling up of three post (subject to variation) in the cadre of Assistant Section Officer on deputation in the Office of Lokpal<a 
                                                href="http://localhost/lokpal/pdfs/aso_12122019.pdf" target="_BLANK" title="Filling up of three post (subject to variation) in the cadre of Assistant Section Officer on deputation in the Office of Lokpal">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Public Notice No. 52" width="16" height="16"></a>                
                                                <div class="jq" style="display: none;">Filling up of three post (subject to variation) in the cadre of Assistant Section Officer on deputation in the Office of Lokpal</div>
                                                  </li> 


                                                  <li class="views-row views-row-5 views-row-odd">Advertisement for the post of Staff Car Driver + Corrigendum  + Extension of Date<a href=
                                                                      "http://localhost/lokpal/pdfs/driver_ext.pdf" target="_BLANK" title="Advertisement for the post of Staff Car Driver + Corrigendum  + Extension of Date">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="PN 51" width="16" height="16"></a>                <div class="jq" style="display: none;"></div>  </li> 


                                                         <li class="views-row views-row-4 views-row-even">Advertisement for the post of Court Master<a href="http://localhost/lokpal/pdfs/Court_Master.pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Advertisement for the post of Court Master" width="16" height="16"></a>                <div class="jq" style="display: none;"></div>
                                                           </li>





                                                                                          <li class="views-row views-row-6 views-row-even">Advertisement for the post of Court Steno<a href="http://localhost/lokpal/pdfs/Court_Steno.pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Advertisement for the post of Court Steno" width="16" height="16"></a>

                                                                                                          <div class="jq" style="display: none;">Public Notice No. 50<
                                                                                            /div>  


                                                                                          </li> 

                                                                                                    <li class="views-row views-row-7 views-row-odd views-row-last">Advertisement for the post of Consultant<a href=
                                                                                                      "http://localhost/lokpal/pdfs/adv_con23Oct.pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="PN-49" width="16" height="16"></a>                <div class="jq" style="display: none;">PN-49</div>

                                                                                                      </li>

                                                                                                       <li class="views-row views-row-7 views-row-odd views-row-last">Former Supreme Court Judge Justice Pinaki Chandra Ghose is the First Lokpal.<a href=
                                                                                                      "http://localhost/lokpal/pdfs/adv_con23Oct.pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="PN-49" width="16" height="16"></a>                <div class="jq" style="display: none;">PN-49</div>

                                                                                                      </li> 





                                                                                                            </ul>
                                                                                                          </div>
                                                                                                              </div>
                                                                                                                                 <div class="view-footer">       <a href="#" title="public-notices" class="view">View All</a>      </div>

                                                                                                                                        </div>
                                                                                                                                         </div>

                                                                                                                                            </div>                 <div class="clear"></div>
              </div>
			  <h2 class="resp-accordion hor_1" role="tab" style="background-color: rgb(255, 255, 255); border-color: rgb(193, 193, 193);" aria-controls="hor_1_tab_item-2">
          <span class="resp-arrow">
            
          </span><a href="javascript:void(0)" title="Circular">Circular</a>
        </h2>

        <div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-2" style="border-color: rgb(193, 193, 193);">
			                     <div class="region region-home-tab3">
    <div id="block-views-5cd71341d59c425413e417a0246a3e19" class="block block-views first last odd">

      
  <div class="view view-dgft-e-learning-initiatives view-id-dgft_e_learning_initiatives view-display-id-block_16 view-dom-id-b49fb008d30b6df22953f9d5e3e1b00c">
        
  
  
      <div class="view-content">

      <div class="item-list">
          <ul>
                    <li class="views-row views-row-1 views-row-odd views-row-first">  
         Board office circular dt. 26-July-2016 ...  regarding declaration of assets and liabilities by public servants under section 44 of Lokpal and Lokayuktas Act, 2013 - filing of returns on or before 31st July, 2016   
          <a href="http://localhost/lokpal/pdfs/filing-declar-assets-liab26july16.pdf" target="_blank">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Board office circular dt. 26-July-2016" width="16" height="16"></a>
    
          <div class="jq" style="display: none;">Policy Circular
          </div>
            </li>



          <li class="views-row views-row-2 views-row-even">  
          Board office circular dt. 20-July-2016...regarding declaration of assets and liabilities by public servants under section 44 of Lokpal and Lokayuktas Act, 2013 - filing of returns on or before 31st July, 2016    
          <a href="http://localhost/lokpal/pdfs/filing-declar-assets-liab20july16.pdf" target="_blank">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Board office circular dt. 20-July-2016" width="16" height="16"></a>    
          <div class="jq" style="display: none;">Policy Circular No-29</div>
            </li>


          <li class="views-row views-row-3 views-row-odd">  
          Declaration of assets and liabilities by public servants under Section 44 of the Lokpal and Lokayuktas Act, 2013 - Filing of Returns by public servants on or before 15th April, 2016.....   
          <a href="http://localhost/lokpal/pdfs/declaration-assts-liblties-ofc-memorndm.pdf" target="_blank">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Policy Circular" width="16" height="16"></a>    
          <div class="jq" style="display: none;">Policy Circular
          </div>
            </li>


          <li class="views-row views-row-4 views-row-even">  
          Information relating assets and liabilites by Public Servants under Provision of Section 44 of the Lokpal and lokayuktas act, 2013..  
          <a href="http://localhost/lokpal/pdfs/office-memorandum-Lokpal.PDF" target="_blank">Download<img  src="<?php echo base_url();?>assets/images/new.gif" alt="Circular No. 27" width="16" height="16"></a>
    
          <div class="jq" style="display: none;">Circular No. 27
          </div>

            </li>


          <li class="views-row views-row-5 views-row-odd">  
        The Lokpal and Lokayktas Act, 2013 - Submission of declaration of assets and liabilities by the public servants .....      
          <a href="http://localhost/lokpal/pdfs/submissn-assts-19jan.pdf" target="_blank">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Action for recovery of Penalty, Pending Appeals or Reviews" width="16" height="16"></a>
    
          <div class="jq" style="display: none;">The Lokpal and Lokayktas Act, 2013
          </div>
            </li>


          <li class="views-row views-row-6 views-row-even">  
          :   Board office letter dt.13-Jan-2015..  regarding clarification on filing of property returns in accordance with existing service rules for different categories of public servants  
          <a href="http://localhost/lokpal/pdfs/decln-assets-clarifn14012015.pdf" target="_blank">Download
           <img src="<?php echo base_url();?>assets/images/new.gif" alt="Policy circulars" width="16" height="16">
         </a>
    
          <div class="jq" style="display: none;">Policy circulars
          </div>
            </li>


          <li class="views-row views-row-7 views-row-odd">  
         Submission of Declaration of assets - Lok Pal Bill.....    
          <a href="http://localhost/lokpal/pdfs/Notification-Lokpal-14July-2014.pdf" target="_blank">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Policy Circular" width="16" height="16"></a>
    
          <div class="jq" style="display: none;">Policy Circular
          </div>
            </li>


          

      </ul>
    </div>

        </div>
  
  
  
  
      <div class="view-footer">
      <a href="#" title="view-all" class="view">View All</a>
          </div>
  
  
</div>
</div>
  </div>
			                  <div class="clear"></div>
              </div>
			  <h2 class="resp-accordion hor_1" role="tab" style="background-color: rgb(255, 255, 255); border-color: rgb(193, 193, 193);" aria-controls="hor_1_tab_item-3"><span class="resp-arrow"></span><a href="javascript:void(0)" title="Trade Notices">Orders</a></h2><div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-3" style="border-color: rgb(193, 193, 193);">
                   <div class="region region-home-tab4">
                        <div id="block-views-home-tabs-whats-new-block" class="block block-views first last odd"> 
                                  <div class="view view-home-tabs view-id-home_tabs view-display-id-whats_new_block view-dom-id-a0f066b7b8b8eab2d14df90de07ab742">                     
                                   <div class="view-content">      
                                    <div class="item-list"> 
                                       <ul> 
                                             <li class="views-row views-row-1 views-row-odd views-row-first">Central Staffing Scheme & Related Circulars<a href="https://doptcirculars.nic.in/Default.aspx?URL=x9m0gG8XcGfH%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="TN-45" width="16" height="16"></a>  

                                              <div class="jq" style="display: none;">TN-45</div> 
                                              </li>          

                                              <li class="views-row views-row-2 views-row-even"> Circulars Relating to Other ACC Appointments i.e. NON CSS<a href="https://doptcirculars.nic.in/Default.aspx?URL=yRu7THjM08aj%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="TN-44 dated-26.12.2019" width="16" height="16"></a>                
                                              
                                               </li> 


                                                        <li class="views-row views-row-3 views-row-odd">Circulars Relating to Empanelment <a href="https://doptcirculars.nic.in/Default.aspx?URL=HF5TTXj2QmHM%20" target="_BLANK" title="The pdf file open in new window">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Trade Notice" width="16" height="16"></a>               
                                                          <div class="jq" style="display: none;">Orders</div>
                                                            </li>   

                                                            <li class="views-row views-row-4 views-row-even">Orders Relating to Empanelment (Secretary)<a href="https://doptcirculars.nic.in/Default.aspx?URL=4OEyiHeeZAM6%20" target="_BLANK" title="The pdf file open in new window">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Trade Notice" width="16" height="16"></a>                 <div class="jq" style="display: none;">Trade Notice</div>

                                                              </li>      
                                                                   <li class="views-row views-row-5 views-row-odd">Orders Relating to Empanelment (Additional Secretary)<a href="https://doptcirculars.nic.in/Default.aspx?URL=uPaYp192HCX5%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Orders Relating to Empanelment (Additional Secretary)" width="16" height="16"></a>                
                                                                    
                                                                     </li> 


                                                                              <li class="views-row views-row-6 views-row-even">Orders Relating to Empanelment (Joint Secretary)<a href="https://doptcirculars.nic.in/Default.aspx?URL=1M7BgYe4dp7B%20" target="_BLANK" title="The pdf file open in new window">Download <img src="<?php echo base_url();?>assets/images/new.gif" alt="Orders Relating to Empanelment (Joint Secretary)" width="16" height="16"></a>                

                                                                               </li>   

                                                                                <li class="views-row views-row-7 views-row-odd">             Instructions on ACRs/PARs <a href="https://doptcirculars.nic.in/Default.aspx?URL=CjtrrNfOyzAi%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Incorrect Data in certain lECs - corrective action required from exporters" width="16" height="16"></a>  
                                                                                               
                                                                                                </li>  
                                                                                                        <li class="views-row views-row-8 views-row-even views-row-last">Instructions on IPRs <a href="https://doptcirculars.nic.in/Default.aspx?URL=52jzPkJK6hU8%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Instructions on IPRs" width="16" height="16"></a>                                      
                                                                                                                          </li> 

                                                                                                                           <li class="views-row views-row-8 views-row-even views-row-last">Vacancy Circulars <a href="https://doptcirculars.nic.in/Default.aspx?URL=wFJpTEk06p7x%20" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Vacancy Circulars" width="16" height="16"></a>                                      
                                                                                                                          </li> 
                                                                                                                           <li class="views-row views-row-8 views-row-even views-row-last">Compendium of Guidelines regarding Board level appointments in CPSEs - Updated as on 29.08.2017 <a href="http://localhost/lokpal/pdfs/Compendium-draft-final (1).pdf" target="_BLANK" title="The pdf file open in new window">Download<img src="<?php echo base_url();?>assets/images/new.gif" alt="Compendium of Guidelines regarding Board level appointments in CPSEs - Updated as on 29.08.2017" width="16" height="16"></a>                                      
                                                                                                                          </li> 


                                                                                                             </ul>
                                                                                                           </div> 
                                                                                                              </div>  
                                                                                                                               <div class="view-footer">       <a href="#" class="view" title="view all Trade Notice">View All</a>    </div>
                                                                                                                                      </div>
                                                                                                                                       </div>   </div>                 <div class="clear">
                                                                                                                                         
                                                                                                                                       </div>
              </div>
			</div>
          </div>
        </div>

        <div class="announcement left-cont">
             <section class="region region-sidebar-third column sidebar">
                  <div id="block-block-2" class="block block-block first last odd">
                             <p>
                              <a class="twitter-timeline" href="https://twitter.com/dgftindia" data-widget-id="733570381747904513" target="_BLANK" title="External site that opens in a new window">Tweets by @LOKPAL official</a>
                            </p>
                             <script>
                              <![CDATA[ >function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+":twitter.com/hashtag/lokpal?lang=en";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");]]> </script>
                               </div>
                                  </section>

                                  
                                   	<div class="w3-content" style="max-width:400px">

  <video width="320" height="270" controls muted autoplay>
  <source src="#" type="video/mp4">
</video>

</div> 
		</div>
          <!--DGFT E-Learning Initiatives panel start here -->
        <article class="dgft-learning mid-cont">

          <!--   <section class="region region-sidebar-forth column sidebar">     <div id="block-vie

            s-taxonomy-term-view-block-5" class="block block-views dgft-heading first last odd">          <h2 class="block__title block-title">DGFT E-Learning Initiatives</h2>        <div class="view view-taxonomy-term-view view-id-taxonomy_term_view view-display-id-block_5 view-dom-id-82822623865ea523b1629257008b2c19">                      <div class="view-content">       <div class="item-list">    <ul>          <li class="views-row views-row-1 views-row-odd views-row-first">             <a href="/schemes/niryat-bandhu-scheme" title="Niryat Bandhu Scheme"><img src="HTTPS://dgft.gov.in/sites/default/files/e-learning-viseos_0_0.jpg" alt="Niryat Bandhu Scheme">Niryat Bandhu Scheme</a>  </li>           <li class="views-row views-row-2 views-row-even">             <a href="/schemes/learn-basics-international-trade" title="Learn Basics of International Trade"><img src="HTTPS://dgft.gov.in/sites/default/files/online-cert-course_0.jpg" alt="Learn Basics of International Trade">Learn Basics of International Trade</a>  </li>           <li class="views-row views-row-3 views-row-odd">             <a href="/schemes/indian-trade-portal" title="Indian Trade Portal"><img src="HTTPS://dgft.gov.in/sites/default/files/indian-trade-portal_0.jpg" alt="Indian Trade Portal">Indian Trade Portal</a>  </li>           <li class="views-row views-row-4 views-row-even views-row-last">             <a href="/schemes/e-learning-videos-export-entrepreneurs" title="E-learning Videos for export entrepreneurs"><img src="HTTPS://dgft.gov.in/sites/default/files/e-learning-viseos_0.jpg" alt="E-learning Videos for export entrepreneurs">E-learning Videos for export entrepreneurs</a>  </li>       </ul></div>    </div>                   <div class="view-footer">       <a href="/e-learning" title="view-all" class="view" style="color: #fff;border: 1px solid;">VIEW ALL</a>    </div>       </div> </div>   </section>  -->




<div class="g_slide" id="slides">
  <div class="switch_main" style="left: 0px;">
           echo '<a class="item switch_item thumbnail" href="#" style="left: 0px; display: none;"><img src="<?php echo base_url();?>assets/images/PostNoon-Lokpal.jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="left: 0px; display: inline;"><img src="<?php echo base_url();?>assets/images/download.jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/images_first.jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/download_tt (1).jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/PostNoon-Lokpal.jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/images_first.jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/download_tt (1).jpg" alt="Click to view" title="dgft"></a>';
              echo '<a class="item switch_item thumbnail" href="#" style="display: none; left: 0px;"><img src="<?php echo base_url();?>assets/images/download_tt (1).jpg" alt="Click to view" title="dgft"></a>';
       
  </div>
<div class="switch_nav"><a class="switch_nav_item" href="javascript:;">1</a><a class="switch_nav_item switch_nav_item_current" href="javascript:;">2</a><a class="switch_nav_item" href="javascript:;">3</a><a class="switch_nav_item" href="javascript:;">4</a><a class="switch_nav_item" href="javascript:;">5</a><a class="switch_nav_item" href="javascript:;">6</a><a class="switch_nav_item" href="javascript:;">7</a><a class="switch_nav_item" href="javascript:;">8</a></div><div class="switch_page">		                            <a href="javascript:;" class="prev"></a><a href="javascript:;" class="next"></a>	                            </div></div>


        </article>
      </div>
      <!--left panel end here -->

	  <!--right panel start here -->
      <div class="right-panel clearfix">
        <!--ministry -->
        <div class="minister left-cont">

		     <section class="region region-sidebar-second column sidebar">
    <div id="block-views-our-minister-block" class="block block-views first last odd">

      
  <div class="view view-our-minister view-id-our_minister view-display-id-block minister-content view-dom-id-dc25d941839f3cefc8375120ce23b35a">
        
  
  
      <div class="view-content">
        <div>
      
          <div class="min-box">
<img typeof="foaf:Image" src="<?php echo base_url();?>assets/images/director.jpg" alt="Chairperson, Lokpal" title="Chairperson, Lokpal" width="150" height="150">
<div class="min-info">
<h4>Chairperson, Lokpal</h4>
<h5>Shri Justice Pinaki Chandra Ghose
</h5>
<ul><li><a href="#" title="Visit Profile" class="abhi">VIEW PROFILE</a></li></ul>
</div>
</div>    
              </div>
  <div>
      
          <div class="min-box">
<img typeof="foaf:Image" src="<?php echo base_url();?>assets/images/reva.jpg" alt="Lokayukta, Delhi  &amp; &amp;nbsp;&amp;nbsp;&amp;nbsp;" title="Chairperson, Lokpal &amp; &amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;   " width="96" height="96">
<div class="min-info">
<h4>Lokayukta, Delhi </h4>
<h5>Reva Khetrapal

</h5>

</div>
</div>    
         

            </div>
    </div>
  
  
  
  
  
  
</div>
</div>
  </section>

        </div>
        <!--block links -->
        <!--Helpdesk -->
          <section class="region region-sidebar-fifth column sidebar">
    <div id="block-block-10" class="block block-block helpdesk first last odd">

        <h2 class="block__title block-title">LOKPAL OFFICE</h2>
    
  <script>
jQuery(document).ready(function(){
	jQuery('.view-id-dgft_e_learning_initiatives.view-display-id-block_4 li,.view-id-dgft_e_learning_initiatives.view-display-id-block_15 li,.view-id-dgft_e_learning_initiatives.view-display-id-block_16 li,.view-id-home_tabs.view-display-id-whats_new_block li').each(function(){
		var title = jQuery(this).find('.jq').html();
		jQuery(this).find('img').prop("alt",title);
                jQuery(this).find('.jq').hide();
	});
});
</script><ul>
             <li><a href="<?php echo base_url(); ?>lokpal/contact_us" class="toll" target="_BLANK" title="External site that opens in a new window"><a osd@lokpal.gov.in img src="HTTPS://dgft.gov.in/sites/all/themes/cmf/images/freshdesk.png" alt="freshdesk"></a></li>
            <li><img src="<?php echo base_url();?>assets/images/ico-phone.png" alt="Phone"><a href="#" class="toll">+91 11 24100181 </a></li>
 </ul>
<div class="dgft-helpdesk">
<a href="https://play.google.com/store/apps/details?id=com.parkar&hl=en" target="_BLANK" title="External site that opens in a new window"><img src="<?php echo base_url();?>assets/images/android.png" style="width:186px;" alt="Google Play"></a>
<a href="https://play.google.com/store/apps/details?id=com.parkar&hl=en" target="_BLANK" title="External site that opens in a new window"><img src="<?php echo base_url();?>assets/images/iphone.png" style="width:186px;" alt="Apple app store"></a></div>


</div>
  </section>
      </div>
      <!--right panel end here -->

    </div>
  </div>


<!-- End of Features Section-->
<?php include(APPPATH.'views/templates/front/footer.php'); ?>

