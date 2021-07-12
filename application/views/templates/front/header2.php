<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"  lang="en" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"  lang="en" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"  lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"  lang="en" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!-->
<html dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#" class="js" lang="en"><!--<![endif]--><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="#" type="image/vnd.microsoft.icon">
	<meta name="Generator" content="Real Estate Appellate Tribunal">
	<link rel="alternate" type="application/rss+xml" title="Complaint Management System Lokpal of India" href="#">
	<title>Lok pal</title>

	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta name="viewport" content="width=device-width">
	<meta name="keywords" content="Real Estate Appellate Tribunal">
	<meta name="description" content="Real Estate Appellate Tribunal">
	<meta name="title" content="Real Estate Appellate Tribunal">
	<meta name="lang" content="en">
	<meta name="lang" content="hi">


	<noscript>	<link href="<?php echo base_url();?>assets/css/no-js.css" type="text/css" rel="stylesheet"></noscript>
	<link href="<?php echo base_url();?>assets/css/filter.css" type="text/css" rel="stylesheet">

	<!-- newr -->
	<link href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- end -->

	<!--<meta http-equiv="cleartype" content="on">-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/css_lQaZfjVpwP_oGNqdtWCSpJT1EMqXdMiU84ekLLxQnc4.css" media="all">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/css_CLKliH93sFmoWmVT-sIhKX9y0PnkPP7KGrcFsfzipuM.css" media="all">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/css_vAhJBu8YK_mNlZUKPPmuyIPFPnHVEN_YfmpXo3Ea5cE.css" media="all">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/css_qOI9NL4obraWy0fbbInPoiefKi1pc-8NhZo3Z0K7YF4.css" media="all">
	<script id="twitter-wjs" src="<?php echo base_url();?>assets/js/widgets.js"></script><script type="text/javascript" async="" defer="defer" src="<?php echo base_url();?>assets/js/piwik.js"></script><script src="<?php echo base_url();?>assets/js/js_x0MhBQfHNAIO1NwkQgzf_TGN4b8eMmKre3nqUfoQv3w.js"></script>
	<script src="<?php echo base_url();?>assets/js/js_R9UbiVw2xuTUI0GZoaqMDOdX0lrZtgX-ono8RVOUEVc.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/utf8_encode.js"></script>
	<script src="<?php echo base_url();?>assets/js/sha256.js" language="javascript" ></script>
	
	
	<script>
		var _paq = _paq || [];
		_paq.push(["trackPageView"]);
		_paq.push(["enableLinkTracking"]);
		(function() {
			var u="http://analytics.wrc.nic.in/cmfanalytics/";
			_paq.push(["setTrackerUrl", u+"analytics"]);
			var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
			g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"js/piwik.js"; s.parentNode.insertBefore(g,s);
		}
	)();</script>
	<script>var base_url ="#"; var themePath = "sites/all/themes/cmf"; var modulePath = "sites/all/modules/cmf/cmf_content";</script>

	<script>
		jQuery(document).ready(function(){
			var searchStr = "";
			if(searchStr != ""){
				fetchResult();
			}
		});	
		var currentKey = 0;
		settings = new Array();
		settings["searchServer"] = "http://goisearch.gov.in";
		settings["textBoxId"] = "q";
		settings["callBackFunction"] = "callBack";
		//loadSuggestionControls(settings);

		function callBack() {
			settings["q"] = document.getElementById("search_key").value;
			settings["count"] = "10";
			settings["site"] = "india.gov.in";
			loadResultControls(settings);
		}

		settings = new Array();
		settings["searchServer"] = "http://goisearch.gov.in";
		settings["textBoxId"] = "search_key";
		settings["site"] = "india.gov.in";
		settings["q"] = "";
		//loadResultControls(settings);

		function modifySettings(key1) {
			if (document.getElementById("search_key").value != null) {
				settings[key1] = document.getElementById("search_key").value;
				settings["count"] = "10";
				settings["site"] = "india.gov.in";
				loadResultControls(settings);
			}
			hideAutoComplete();
		}

		function fetchResult() {
			var str = window.document.URL.toString();
			str=escape(str);
			var q = str.indexOf("?search_key=") + 12;
			settings["q"] = str.slice(q);
			settings["count"] = "10";
			settings["site"] = "india.gov.in";
			loadResultControls(settings);
		}

		function escape(string) {
			return ("" + string).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/"/g, "&#x27;").replace(/\//g, "&#x2F;").replace(/\+/g," ");
		};
	</script>
	<script src="<?php echo base_url();?>assets/js/lightbox.js"></script>
	<script src="<?php echo base_url();?>assets/js/js_AuzNFKkB3ktEINBn-5LgISTbj7AfvOvbeolvPxhhOSo.js"></script>
	<script>jQuery.extend(Drupal.settings, {"basePath":"\/","pathPrefix":"","ajaxPageState":{"theme":"cmf","theme_token":"24Ldf2vj_0UU7kEsDCIYKb22olV0kmiMkbA-vcDbTJI","js":{"sites\/all\/modules\/cmf\/cmf_content\/assets\/js\/swithcer.js":1,"sites\/all\/modules\/contributed\/jquery_update\/replace\/jquery\/1.8\/jquery.min.js":1,"misc\/jquery.once.js":1,"misc\/drupal.js":1,"sites\/all\/modules\/contributed\/admin_menu\/admin_devel\/admin_devel.js":1,"0":1,"1":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/js\/font-size.js":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/js\/framework.js":1,"sites\/all\/modules\/cmf\/cmf_content\/goisearch\/js\/custom_result_jsversion.js":1,"sites\/all\/modules\/cmf\/cmf_content\/goisearch\/js\/auto_jsversion.js":1,"2":1,"sites\/all\/modules\/contributed\/lightbox2\/js\/lightbox.js":1,"sites\/all\/themes\/cmf\/js\/jquery.min.js":1,"sites\/all\/themes\/cmf\/js\/jquery.flexslider.js":1,"sites\/all\/themes\/cmf\/js\/custom.js":1,"sites\/all\/themes\/cmf\/js\/jquery.marquee.js":1,"sites\/all\/themes\/cmf\/js\/easyResponsiveTabs.js":1,"sites\/all\/themes\/cmf\/js\/site.js":1},"css":{"modules\/system\/system.base.css":1,"modules\/system\/system.menus.css":1,"modules\/system\/system.messages.css":1,"modules\/system\/system.theme.css":1,"sites\/all\/modules\/contributed\/calendar\/css\/calendar_multiday.css":1,"sites\/all\/modules\/contributed\/date\/date_api\/date.css":1,"sites\/all\/modules\/contributed\/date\/date_popup\/themes\/datepicker.1.7.css":1,"modules\/field\/theme\/field.css":1,"modules\/node\/node.css":1,"modules\/search\/search.css":1,"modules\/user\/user.css":1,"sites\/all\/modules\/contributed\/views\/css\/views.css":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/css\/base.css":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/css\/font.css":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/css\/flexslider.css":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/css\/base-responsive.css":1,"sites\/all\/modules\/cmf\/cmf_content\/assets\/css\/font-awesome.min.css":1,"sites\/all\/modules\/cmf\/content_statistic\/css\/content_statistic.css":1,"sites\/all\/modules\/contributed\/ctools\/css\/ctools.css":1,"sites\/all\/modules\/cmf\/cmf_content\/goisearch\/css\/custom_result.css":1,"http:\/\/goisas.nic.in\/content\/scripts\/jquery.1.8.7\/themes\/base\/jquery.ui.all.css":1,"sites\/all\/modules\/cmf\/cmf_content\/goisearch\/css\/add-css.css":1,"sites\/all\/modules\/contributed\/lightbox2\/css\/lightbox.css":1,"sites\/all\/modules\/contributed\/panels\/css\/panels.css":1,"sites\/all\/themes\/cmf\/system.menus.css":1,"sites\/all\/themes\/cmf\/system.messages.css":1,"sites\/all\/themes\/cmf\/system.theme.css":1,"sites\/all\/themes\/cmf\/css\/jquery.smartmarquee.css":1,"sites\/all\/themes\/cmf\/css\/site.css":1,"sites\/all\/themes\/cmf\/css\/site-responsive.css":1}},"encrypt_submissions":{"baseUrl":"http:\/\/dgft.gov.in"},"lightbox2":{"rtl":"0","file_path":"\/(\\w\\w\/)public:\/","default_image":"\/sites\/all\/modules\/contributed\/lightbox2\/images\/brokenimage.jpg","border_size":10,"font_color":"000","box_color":"fff","top_position":"","overlay_opacity":"0.8","overlay_color":"000","disable_close_click":true,"resize_sequence":0,"resize_speed":400,"fade_in_speed":400,"slide_down_speed":600,"use_alt_layout":false,"disable_resize":false,"disable_zoom":false,"force_show_nav":false,"show_caption":true,"loop_items":false,"node_link_text":"View Image Details","node_link_target":false,"image_count":"Image !current of !total","video_count":"Video !current of !total","page_count":"Page !current of !total","lite_press_x_close":"press \u003Ca href=\u0022#\u0022 onclick=\u0022hideLightbox(); return FALSE;\u0022\u003E\u003Ckbd\u003Ex\u003C\/kbd\u003E\u003C\/a\u003E to close","download_link_text":"","enable_login":false,"enable_contact":false,"keys_close":"c x 27","keys_previous":"p 37","keys_next":"n 39","keys_zoom":"z","keys_play_pause":"32","display_image_size":"original","image_node_sizes":"()","trigger_lightbox_classes":"","trigger_lightbox_group_classes":"","trigger_slideshow_classes":"","trigger_lightframe_classes":"","trigger_lightframe_group_classes":"","custom_class_handler":0,"custom_trigger_classes":"","disable_for_gallery_lists":true,"disable_for_acidfree_gallery_lists":true,"enable_acidfree_videos":true,"slideshow_interval":5000,"slideshow_automatic_start":true,"slideshow_automatic_exit":true,"show_play_pause":true,"pause_on_next_click":false,"pause_on_previous_click":true,"loop_slides":false,"iframe_width":600,"iframe_height":400,"iframe_border":1,"enable_video":false}});</script>
      <!--[if lt IE 9]>
    <script src="/sites/all/themes/zen/js/html5-respond.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.css">
<script src="<?php echo base_url();?>assets/js/jquery_002.js"></script>

<script>
	$(document).on('click', 'a.ab', function () {
		location.reload();
	});
  /*$(document).ready( function () {
  $('#table_id').DataTable();
} );*/
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/prettify.css"></head>
<body onLoad="myFunction()" class="html front not-logged-in two-sidebars page-node i18n-en lightbox-processed"><svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" id="viewbox-sprite" style="display:none"><symbol id="viewbox-close-icon" viewBox="0 0 50 50"><path d="M37.304 11.282l1.414 1.414-26.022 26.02-1.414-1.413z"></path><path d="M12.696 11.282l26.022 26.02-1.414 1.415-26.022-26.02z"></path></symbol><symbol id="viewbox-prev-icon" viewBox="0 0 50 50"><path d="M27.3 34.7L17.6 25l9.7-9.7 1.4 1.4-8.3 8.3 8.3 8.3z"></path></symbol><symbol id="viewbox-next-icon" viewBox="0 0 50 50"><path d="M22.7 34.7l-1.4-1.4 8.3-8.3-8.3-8.3 1.4-1.4 9.7 9.7z"></path></symbol><symbol id="viewbox-full-screen-icon" viewBox="0 0 50 50"><path d="M8.242 11.387v9.037h2.053v-6.986h9.197v-2.051H8.242zm22.606 0v2.05h9.367v6.987h2.05v-9.037H30.849zM8.242 29.747v8.866h11.25v-2.05h-9.197v-6.817H8.242zm31.973 0v6.816h-9.367v2.05h11.418v-8.867h-2.051z"></path></symbol></svg>
	﻿<!---************** Header area start here *****************-->
	<header>

		<div class="wrapper common-wrapper">
			<div class="container common-container">

				<div class="region region-header-top">
					<div id="block-cmf-content-header-region-block" class="block block-cmf-content first odd">


						<noscript class="no_scr">"JavaScript is a standard programming language that is included to provide interactive features, Kindly enable Javascript in your browser. For details visit help page"
						</noscript><div class="wrapper common-wrapper">
							<div class="container common-container four_content ">
								<div class="common-left clearfix">
									<ul>
										<li class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank" href="https://india.gov.in/hi/" title="भारत सरकार ( बाहरी वेबसाइट जो एक नई विंडो में खुलती है)">भारत सरकार</a></span><span class="li_eng responsive_go_eng"><a target="_blank" href="http://india.gov.in/" title="GOVERNMENT OF INDIA,External Link that opens in a new window">GOVERNMENT OF INDIA</a></span></li><li class="ministry"><span class="responsive_minis_hi" lang="hi"><a target="_blank" href="http://commerce.gov.in/" title="वाणिज्य एवं उद्योग मंत्रालय (बाहरी वेबसाइट जो एक नई विंडो में खुलती है)">
										शिकायत प्रबंधन प्रणाली</a></span><span class="li_eng responsive_minis_eng"><a target="_blank" href="http://commerce.gov.in/" title="MINISTRY OF COMMERCE AND INDUSTRY,External Link that opens in a new window">Complaint Management System at Lokpal of India</a></span></li></ul>
									</div>
									<div class="common-right clearfix">
										<ul id="header-nav">
											<li class="ico-skip cf"><a href="#skipCont" title="">Skip to main content</a>		      </li>
											<li class="ico-site-search cf"><a href="javascript:void(0);" id="toggleSearch" title="Site Search">

												<img class="top" src="<?php echo base_url();?>assets/images/ico-site-search.png" alt="Site Search"></a>

												<div class="search-drop goi-search" style="display: none;"><div class="find">
													<form name="searchForm" action="HTTPS://dgft.gov.in/goisearch">
														<label for="search_key" class="notdisplay">Search</label>
														<input type="text" name="search_key" id="search_key" onKeyUp="autoComplete()" autocomplete="off" required="">
														<input type="submit" value="Search" class="bttn-search">
													</form>
													<div id="auto_suggesion"></div>
												</div></div>
											</li><li class="ico-accessibility cf"><a href="javascript:void(0);" id="toggleAccessibility" title="Accessibility Dropdown">

												<img class="top" src="<?php echo base_url();?>assets/images/ico-accessibility.png" alt="Accessibility Dropdown">

											</a>
											<ul style="visibility: hidden;">
												<li> <a onClick="set_font_size('increase')" title="Increase font size" href="javascript:void(0);">A<sup>+</sup>
												</a> </li>
												<li> <a onClick="set_font_size()" title="Reset font size" href="javascript:void(0);">A<sup>&nbsp;</sup></a> </li>
												<li> <a onClick="set_font_size('decrease')" title="Decrease font size" href="javascript:void(0);">A<sup>-</sup></a> </li>
												<li> <a href="javascript:void(0);" class="high-contrast dark" title="High Contrast">A</a> </li>
												<li> <a href="javascript:void(0);" class="high-contrast light" title="Normal Contrast" style="display: none;">A</a> </li>
											</ul>
										</li>
										<li class="ico-social cf"><a href="javascript:void(0);" id="toggleSocial" title="Social Medias">
											<img class="top" src="<?php echo base_url();?>assets/images/ico-social.png" alt="Social Medias"></a>
											<ul style="visibility: hidden;"><li><a target="_blank" title="External Link that opens in a new window" href="https://twitter.com/dgftindia?ref_src=twsrc%5Etfw"><img alt="Twitter Page" src="<?php echo base_url();?>assets/images/ico-twitter.png"></a></li><li><a target="_blank" title="External Link that opens in a new window" href="https://www.youtube.com/channel/UCLy5FAB96ddnwpgKEIKu1aA"><img alt="youtube Page" src="<?php echo base_url();?>assets/images/ico-youtube.png"></a></li></ul>
										</li> <li class="ico-sitemap cf"><a href="#" title="Sitemap">

											<img class="top" src="<?php echo base_url();?>assets/images/ico-sitemap.png" alt="Sitemap"></a></li> <li class="hindi cmf_lan"><a href="javascript:;" title="Select Language">Language</a><ul style="visibility: hidden;"><li><a target="_blank" href="#" class="alink" title="Click here for हिन्दी version." lang="hi">हिन्दी</a></li></ul></li> </ul>
										</div>
									</div>
								</div>
							</div>
							<div id="block-block-11" class="block block-block last even">


  <!--style><p>#parentHorizontalTab a{<br />
    color: #36589c;<br />
}</p>
<p>#parentHorizontalTab a img{color:#000;}<br />
.high-contrast.dark {<br />
    background: #ffffff !important;}</p>
</style--><script type="text/javascript">
<!--//--><![CDATA[// ><!--

jQuery(document).ready(function(){


	jQuery("label[for='edit-field-start-date-value-min-datepicker-popup-0']").text('Start Date');
	jQuery("label[for='edit-field-start-date-value-min-datepicker-popup-0']").removeClass('element-invisible');
	jQuery("label[for='edit-field-start-date-value-max-datepicker-popup-0']").removeClass('element-invisible').text('End Date');
	jQuery("label[for='edit-field-start-date-value-min']").addClass('element-invisible');
	jQuery("label[for='edit-field-start-date-value-max']").addClass('element-invisible');
	jQuery("label[for='edit-field-start-date-value-value-datepicker-popup-0']").removeClass('element-invisible').text('Start Date');
	jQuery("label[for='edit-field-start-date-value']").addClass('element-invisible');

});

//--><!]]>
</script>
</div>
</div>
</div>
</div>
<!--Top-Header Section end-->

<section class="wrapper header-wrapper" role="region">

	<div class="container header-container">

		<h1 class="logo">
			<a href="http://localhost/lokpal/" title="Home" rel="home"><img src="<?php echo base_url();?>assets/images/emblem-dark.png" alt="logo" title="logo"><strong>शिकायत प्रबंधन प्रणाली</strong>

				Complaint Management System Lokpal of India <span></a>	</h1>



					<a class="toggle-nav-bar" href="javascript:void(0);"> <span class="menu-icon"></span> <span class="menu-text">Menu</span> </a>
					<div class="" style="float:right">
						<div class="">
							<div class="">
								<a href="https://swachhbharat.mygov.in/" class="sw-logo" title="Swachh Bharat, External Link that opens in a new window"><img src="<?php echo base_url();?>assets/images/swach-bharat.png" alt="Swachh Bharat"></a>		</div>
							</div>
						</div>
					</div>
				</section>


				<!--/.header-wrapper-->

				<nav class="wrapper nav-wrapper" role="navigation">
					<div class="container nav-container">
						<!--Main nav goes here-->


						<div id="main-menu">
							<div class="menu-block-wrapper menu-block-2 menu-name-main-menu parent-mlid-0 menu-level-1">
									<?php
//print_r($menus);die('l');
									 foreach ($menus as $menu): ?>			
								<ul class="menu" id="nav"> 

									<li class="menu__item is-expanded expanded menu-mlid-1505"><span title="Services" class="menu__link nolink"><?php echo $this->menus_lib->get_menu_name($menu->menu_id);?></span>

										<ul class="menu">
											<?php
												$sumenus = $this->menus_lib->get_submenus($menu->menu_id, $user['role']);
												foreach ($sumenus as $submenu):
											?>
											<li class="menu__item is-expanded expanded menu-mlid-2728">
												<a href="<?php echo base_url(); 
															echo $url = $this->menus_lib->get_submenu_url($submenu->submenu_id);
												?>" <?php if($url == 'filing/filing') { ?> onClick = "freshApp();"<?php } ?> title="Go to filing part" class="menu__link ab"><?php echo $this->menus_lib->get_submenu_name($submenu->submenu_id); ?></a>
											</li>
											<?php endforeach; ?>
										</ul>

	
									</li>

									</ul>
								<?php endforeach; ?>


								<!-----------report end here *****************************************---->


														<!----------- start logout section *********************** ------>																					   

<ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php if($user['username']){
                                echo $user['username'];
                              }else{
                                echo 'n/a';
                              }
                                 ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                        	<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-sign-out fa-fw"></i> Lokpal Home</a>
                            </li>
                            <li><a href="<?php echo base_url('user/update_user_pass'); ?>"><i class="fa fa-sign-out fa-fw"></i> Update password</a>
                            </li>
                            <li class="divider"></li>
                            <?php if($user['is_staff'] == 'f'){ ?> 
                            <li><a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                            <?php } else { ?>
                            <li><a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                            <?php } ?>	
                        </ul>
                    </li>
                </ul>




										</div>                 </div>
									</div>
								</nav>
							</header>
<!-- <div id="myModal" class="modal">

  Modal content
  <div class="modal-content gandhi">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>&nbsp;</h2>
    </div>
    <div class="modal-body">
     <p>Hello DGFT</p>
    </div>
    <div class="modal-footer">
      <h3>&nbsp;</h3>
    </div>
  </div>

</div>  -->

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal

function myFunction() {
    //modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}

var baseURL= "<?php echo base_url();?>";

function freshApp(){
		jQuery.ajax({
		url : baseURL+'filing/destroy_filing_session',
		success : function(result){
			console.log(result);
		},
			complete:function(data){
   			}
	});
}

</script>
<!--**************** Header area end here *********************-->
