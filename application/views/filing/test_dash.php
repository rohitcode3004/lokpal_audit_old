<?php
//$elements = $this->label->view(1);
?>
<!DOCTYPE html>
<html lang="en">
<head> 
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

	<link href="<?php echo base_url();?>assets/bootstrap/css/chosen.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/css/custom_style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/css/hover.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/prettify.css" rel="stylesheet">
	<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.validate.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<style type="text/css">
		label {
    display: inline-block;
    max-width: 100%;
    font-weight: 700;
    margin-top:9px;

}
.webcomplaint_checkbox{ width:100%; float:left; background:#efefef; padding:5px; margin-bottom:10px;}

.webcomplaint_checkbox input[type="checkbox"]{margin: 1px 0 0;}

   .bg2
        {
            border: solid 1px #578ebe;
            width: 100%;
            float: left;
            padding: 10px;
        }
        .hed2bg
        {
            background: #ccc;
            width: 100%;
            float: left;
            padding: 5px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
.visit_registration input[type="checkbox"]{
    width: 20px;
    height: 20px;
    float:left;
    margin:6px;
}
.visit_registration input, textarea{ width:auto; float:left; margin-right:6px}
.btn-info1
{
    background-color: #0a467c;
    color: #fff;
    height: auto;
  
    width:100%;
}

hr
{
    margin-top: 6px;
    margin-bottom: 21px;
    border-top: 1px solid #be1b47;
}
p
{
    font-family: Arial;
    font-size: 15px;
    color: #333;
}
a:focus, a:hover
{
    text-decoration: none;
    outline: none;
}

.float_left
{
    float:left !important;
}
.float_right
{
    float:right !important;
}

/*.modal-open{
    overflow-x: auto;
    overflow-y: scroll;
}
*/

.modal-dialog
{
    margin:0;
    width: 600px;
}
.marg_bott20
{
    margin-bottom: 20px;
}
.marg_bott10
{
    margin-bottom: 15px !important;
    float: left;
    width: 100%;

}
.modal-header
{
    background: #578ebe;
    color: #fff;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}
.list
{
    width: 100%;
    float: left;
    margin-bottom: 15px;
}
.list li
{
    width: 100%;
    float: left;
    font-size: 14px;
    margin-bottom: 13px;
    padding-left: 26px;
    list-style: none;
    background: url("../images/favicon-16x16.png") no-repeat scroll 0 7px rgba(0, 0, 0, 0);
}

.list1
{
    width: 100%;
    float: left;
    margin:0px; padding:0px;
}
.list1 li
{
    width: 100%;
    float: left;
    font-size: 13px;
    margin-bottom: 10px;
    list-style: none;
}
.banner_bg{background: url("../images/banner.jpg") no-repeat scroll 0 7px rgba(0, 0, 0, 0); width:100%; height:100%; float:left}
.footer
{
    position:absolute; /* standard */
	position:inherit\9; /* IE 8 and below */
	*position:inherit; /* IE 7 and below */
	_position:inherit; /* IE 6 */
    bottom: 0;
    width: 100%;
    height: 0;
}

*
{
    padding: 0px;
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
html
{
    min-height: 100%;
    position: relative;
}
.carousel-caption
{
    text-shadow: none;
}
body
{
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    color: #333;
    margin-bottom: 160px; 
    /*padding:5px; background#d7d7d7;*/
}
/*.container{ width:auto;}*/
.position_absolute {
    position: absolute;
    z-index: 9999; 
}
.page-content-wrapper, .page-footer, .page-header, .page-sidebar-wrapper
{
    float: left;
    width: 100%;
    margin: 0;
    padding: 0; background:#fff;
}
.page-content-wrapper { padding-bottom:30px;}
.footer_fixed
{
    position: inherit;
    bottom: 0;
}
.width75p
{
    width: 75%;
    float: right;
}
.hr_min
{
    text-align: center;
    line-height: 35px;
}
.top_bg{ background: #be1b47; border-bottom:2px solide #be1b47;}
.top_nav{ width:auto; float:right; margin:0px; padding:0px;}
.top_nav li{ width:auto; padding:7px 10px; float:left; list-style:none;}
.top_nav li a{ color:#ffffff; float:left; font-size:12px;}
.header_bg
{
    background:#fff; border:none; /*position:fixed;*/
        border: 1px solid #c7c7c7;
}
.logo
{
    padding: 6px 0;
    float: left;
    margin-left:10px;
}
.logo span
{font-size:18px; color:#575757;}

.top_bg_Menu{padding: 0px;margin-left: 0px;margin-right: 0px;margin-bottom: 0px;}


.help
{
    float: right;
    padding: 1% 2%;
}
.web_pagehead
{
    font-size: 30px;
    color: #FFF;
    float: left;
    margin: 10px 0 0 17px;
    font-family: Trebuchet MS;
}

.npi_login
{
    width:auto;
    float: right;
    padding: 3px 0;
}
.nav1
{
    float: right;
    margin: 0px;
    padding: 0px;

}
.nav1 li
{
    width: auto;
    float: left;
    list-style: none;
  
    margin: 5px;
    border-radius: 4px;
    padding: 0px 7px;
}
.nav1 li a
{
    font-size: 13px;
    color: #ffffff;
    
}
.nav1 li:hover
{
    background: #none;
}
.nav1 li a:hover
{
    text-decoration: none;
}


.navbar-default
{
    background-color: inherit;
    border-color: transparent;
}
.navbar
{
    margin-bottom: 0; min-height:inherit!important;
}
.navbar-nav > li > a
{
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
    color:#fff!important;
    line-height: normal; 
    font-weight:normal;
    padding: 30px 15px;
}

.navbar-nav > li > a:hover
{
    color: #f7f7f7!important;
}
.silder
{
    width: 100%;
     background: url(../images/banner.jpg) right bottom no-repeat #be1b47;
     margin-bottom:30px;
}

.login
{
    float: left;
    text-align: left;
    color: #fff;
    padding-top: 50px;
    padding-bottom: 50px;
}
.login h3{ font-size:30px; margin-bottom:40px;}
.login_list{ float:left; }

.login_list li{ font-family:auto; font-size:18px; margin-bottom:17px;  font-weight: 900; list-style:none;}

.login1
{
    float: left;
    text-align: left;
    color: #fff;
    padding: 20px 50px;
    width:100%;
}
.login_box_shadow
{
    background: url(../images/shadow.png) bottom no-repeat;
    color: #666;
    min-height: 500px;
    width: 100%;
    padding: 5px;
    border-radius: 4px;
}
.login_box
{
    width: 100%;
    float: left;
    background: #f6f6f6;
    color: #666;
    padding: 10px;
    border-radius: 4px;
    min-height: 470px;
}
.login_boxbg
{
    width: 100%;
    float: left;
    padding: 10px;
    background: #4F81BD;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    color: #fff;
    margin-bottom: 10px;
}
.login_boxbg h2
{
    font-family: Trebuchet MS;
    font-size: 24px;
    margin: 15px 0;
    float: left;
    width: 100%;
}


.navbar-nav>li
{
   /* background:#447eaf;*/
    margin-right:3px;
    margin-left:3px;
    margin-top:20px;
    height:40px;
} 
.navbar-nav>li:hover
{
    color:#2a608e;
}
.navbar-nav>li>a
{
    line-height:0px;
    padding-top:21px;
    color:#2a608e!important;
    font-weight:bold;
}
.navbar-nav>li>a:hover
{
    color:#2a608e!important;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
    .navbar-nav>li
    {
        margin-right:3px;
        margin-left:3px;
        margin-top:10px;
        height:40px;
    } 
    .navbar-nav>li:hover
    {
        color:#2a608e;
    }
    .navbar-nav>li>a
    {
        padding-top: 19px!important;
        padding-left: 31px!important;
    }
}

/* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 600px) {
    .navbar-nav>li
    {
        margin-right:3px;
        margin-left:3px;
        margin-top:10px;
        height:40px;
    } 
    .navbar-nav>li:hover
    {
        color:#2a608e;
    }
    .navbar-nav>li>a
    {
        padding-top: 19px!important;
        padding-left: 31px!important;
    }
}

.marg9p
{
    margin-top: 29%;
}
.marg35p
{
    margin-top: 55%;
}
.pages_title
{
    font-family: Arial,Helvetica,sans-serif;
    color: #be1b47;
    text-align: left;
}
.services_bg
{
    width: 90px;
    height: 90px;
    float: left;
    background: #d8ad0b;
    text-align: center;
    margin-bottom: 20px;
    border-radius: 100%;
    margin-right: 10px;
    margin-top: 17px;
    font-size:50px;
    color:#fff;
    line-height:90px;
}
.services_bg img
{
    margin-top: 20px;
}
.services_bg h4
{
    font-size: 15px;
    color: #FFF;
    font-weight: 600;
    margin: 20px 0 0;
}
.services_bg h4:hover
{
    text-decoration: none;
}
.about_text
{
    width: 100%;
    float: left;
    margin: 0;
    padding: 0;
}
.about_text li
{
    width: 100%;
    float: left;
    font-size: 17px;
    color: #666;
    line-height: 20px;
    margin-bottom: 20px;
    list-style: none;
}
.about_text li span
{
    background: #0A467C;
    width: 20px;
    height: 20px;
    color: #FFF;
    float: left;
    margin-right: 15px;
    text-align: center;
    font-weight: 700;
}
.footer_bg
{
    width: 100%;
    float: left;
    background:#d6e6f3;
    padding: 10px 0;
}
.footer_text
{
    font-size: 12px;
    color: #fff;
}
.powered_by
{
    text-align: right;
}
.panel-default > .panel-heading {
    background-color: #0171b5;
    border:solid 1px #041c2b;
    border-bottom:none;
    color: #fff;
    width:100%; float:left;
    }
.panel-default > .panel-heading h1, h2, h3, h1, h2, h3 { margin:0px}
.panel-title{ color: #fff; font-size:14px; text-align:center; font-weight:bold;}
.panel-default > .panel-heading p{ font-size:12px; margin-top:5px;
}
.signup_texthead
{
    font-size: 12px;
    color: #333;
    font-weight: 600;
    margin-bottom: 5px;
}
input, textarea
{
    border-radius: 0 !important;
    border: 1px solid #ccc;
    width: 100%;
    background-color: #fafafa;
    font-size: 13px;
    height: 30px;
    line-height: 1.5;
    padding: 0 10px;
}
textarea
{
    height: 70px !important;
}
.textarea1
{
    height: 164px !important;
}
.btn-block
{
    float: left;
    text-align: center;
    padding: 0;
    font-weight: 700;
    font-size: 17px;
}
input[type=checkbox], input[type=radio]
{
    width: 20px;
    height: 20px;
    float: left;
}
.checkbo_text
{
    float: left;
    color: Maroon;
    margin-top: 5px;
}
select
{
    background-color: #fafafa;
    border: 1px solid #e3e3e3;
    width: 100%;
    height: 30px;
    line-height: 30px;
    color: #000;
    padding: 0 10px;
}
select option
{
    border: none;
    background-color: #fafafa;
    border-bottom: 1px solid #e3e3e3;
    width: 100%;
    color: #000;
    font-size: 14px;
    padding: 5px 0 5px 10px;
}
.capcha
{
    width: 100%;
    float: left;
    background: #FAFAFA;
    border: 1px solid #E3E3E3;
    font-size: 24px;
    color: #333;
    padding-left: 10px;
}
.registion_head
{
    /*background: #397d7d;
    /* width: 100%!important; */
    /* margin-bottom: 30px; */
   /* padding-top: 4rem;
    padding-bottom: 4rem;*/
    /*margin-bottom: 3rem;
    text-align: left;
    -moz-box-shadow: inset 0 0 5px #c7c7c7;
    -webkit-box-shadow: inset 0 0 5px#c7c7c7;
    box-shadow: inner 0 0 5px #c7c7c7;*/
    margin-bottom:15px;
    background:#fbfafa;
}

.registion_head .col-lg-12
{
    font-size: 20px;
    font-weight: 700;
        color:#be1b47;
    padding: 7px 15px;
    width: 100%;
    float: left;
  text-transform: uppercase;
}

.registion_head1
{ background: #578ebe;
     margin-bottom: 15px;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    padding: 7px 15px;
    width: 100%;
    float: left;
}

.registion_head_center
{
    background: #578ebe;
    width: 100%;
    text-align:center;  
     font-size: 15px;
    font-weight: 700;
    color: #fff;
    padding: 7px 15px;
}
.page-title
{
    background:#397d7d;
    line-height:30px;
    color:#fff;
}
.page-title span
{
    margin-left:5px;
}
.centered-form
{
    margin: 14px 0;
}
.centered-form .panel
{
    background: rgba(255,255,255,.8);
    box-shadow: rgba(0,0,0,.3) 20px 20px 20px;
}
.boder{border: 1px solid #0b5d83;
    padding:10px; margin-bottom:15px; width:100%; float:left;}
.input-group
{
    width: 100%; font-weight:bold;
}
.date_wid
{
    width: 91%;
}
.date_wid_img
{
    float: right;
}
.date_wid_img input
{
    padding: 0 !important;
    height: inherit;
}
.dashboard-box
{
    width: 100%;
    float: left;
    overflow: hidden;
    margin-bottom: 20px;
}
.hed_box
{
    width: 100%;
    float: left;
    color: #fff;
    font-size: 18px;
    height: 50px;
    margin-bottom: 20px;
    line-height: 50px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
}
.states_covered_bg
{
    background-color: #495B79;
}
.states_covered_bg1
{
    background-color: #364359;
}
.prisons_created_bg
{
    background-color: #90C657;
}
.prisons_created_bg1
{
    background-color: #5CB85C;
}
.prisons_online_bg
{
    background-color: #428BCA;
}
.prisons_online_bg1
{
    background-color: #07477E;
}
.visitors_bg
{
    background-color: #495B79;
}
.visitors_bg1
{
    background-color: #364359;
}
.departments_bg
{
    background-color: #495B79;
}
.departments_bg1
{
    background-color: #364359;
}
.officers_bg
{
    background-color: #495B79;
}
.officers_bg1
{
    background-color: #364359;
}
.hed_box_iconbg
{
    width: 50px;
    height: 50px;
    line-height: 50px;
    float: left;
    text-align: center;
    margin-right: 10px;
    -moz-border-radius: 6px 0 0 6px;
    -webkit-border-radius: 6px 0 0 6px;
    border-radius: 6px 0 0 6px;
    padding-top: 12px;
}
.hed_box_iconbg img
{
    vertical-align: top;
}
.dashboard-box .padd {
  padding: 10px 10px 0 10px;
  float: left;
  width: 100%;
}
.dashboard-box .padd1
{
    padding: 28px 0px 0px 0;
    float: left;
    width: 100%;
}
.dashboard-box .icon {
  border: 1px solid hsla(0,0%,100%,.3);
  border-radius: 100%;
  height: 50px;
  line-height: inherit;
  text-align: center;
  width: 50px;
  float: right;
  padding-top: 4px;
  position: absolute;
  right: 11px;
  }
  
.dashboard-box .headlin
{
    font-family: arial;
    font-size: 14px;
    color: #fff;
    float: left;
    width: 95%;
}
.dashboard-box h1 { text-align:center; color:#fff; font-size:22px; line-height:40px; margin:0px; border-bottom:1px solid rgba(255, 255, 255, 0.3)}
.dashboard-box p{ font-size:14px; line-height:18px; padding:15px; color:#fff; text-align:center; margin:0px;}
.icon_box{ width:120px; height:120px; padding:30px; font-size:50px; color:#fff; text-align:center; margin:15px auto;  border-radius: 100%; border:4px solid rgba(255, 255, 255, 0.3);
}
.dashboard_name {
  border-bottom: 1px solid hsla(0,0%,100%,.3);
  font-size: 14px;
  float: left;
  padding-left: 11px;
  width: 100%;
}
.dashboard_reports
{
   
    margin: 10px;
    text-align: left;
    width: 100%;
    font-size:16px;

}
        .mGrid { 
    width: 100%; 
    background-color: #fff; 
    margin: 5px 0 10px 0; 
    border: solid 1px #525252; 
    border-collapse:collapse; 
}
.mGrid td { 
    padding: 5px; 
    border: solid 1px #c1c1c1; 
    color: #717171; 
}
.mGrid th { 
    padding: 4px 2px; 
    color: #fff; 
    background: #424242 url(grd_head.png) repeat-x top; 
    border-left: solid 1px #525252; 
    font-size: 0.9em; 
}
.mGrid .alt { background: #fcfcfc url(grd_alt.png) repeat-x top; }
.mGrid .pgr { background: #424242 url(grd_pgr.png) repeat-x top; }
.mGrid .pgr table { margin: 5px 0; }
.mGrid .pgr td { 
    border-width: 0; 
    padding: 0 6px; 
    border-left: solid 1px #666; 
    font-weight: bold; 
    color: #fff; 
   
 }   
.mGrid .pgr a { color: #666; text-decoration: none; }
.mGrid .pgr a:hover { color: #000; text-decoration: none; }
.blue-madison
{
    background-color: #2ca266;
}
.blue-madison1
{
    background-color: #137945;
}
.red-intense
{
    background-color: #1072a0;
}
.red-intense1
{
    background-color: #095477;
}
.aquamarine
{
    background-color: #f1c10c;
}
.aquamarine1
{
    background-color: #cea50b;
}
.purple-plum
{
    background-color: #be1b47;
}
.purple-plum1
{
    background-color: #8a223e;
}
.medium_sea_green
{
    background-color: #90C657;
}
.medium_sea_green1
{
    background-color: #77AF3B;
}
.orange
{
    background-color: #F9A94A;
}
.orange1
{
    background-color: #F79219;
}
.dodger_blue
{
    background-color: #54B5DF;
}
.dodger_blue1
{
    background-color: #29A2D7;
}
.lightsky_blue
{
    background-color: #F97D61;
}
.lightsky_blue1
{
    background-color: #EB6A4D;
}
.more
{
    color: #fff;
    clear: both;
    display: block;
    font-size: 11px;
    font-weight: 300;
    opacity: .7;
    padding: 7px 15px;
    position: relative;
    text-transform: uppercase;
    float: left;
    width: 100%;
}
.more a
{
    color: #fff;
    width: 100%;
}
.more:hover
{
    color: #fff;
}
.more img
{
    float: right;
}

.more_img
{
    background-image: url("../images/syncfusion-icons-white.png");
    background-position: right center;
    background-repeat: no-repeat;
}
.dataGridPrisnor
{
    font-size: smaller;
    color: #333;
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #E6E2D6;
    border-top: none;
}
.dataGridPrisnor td, .dataGridPrisnor th
{
    padding: 8px 6px;
    font-size: 12px;
    text-transform: capitalize;
}
.dataGridPrisnor th
{
    background: #272F3C;
    color: #FFF;
    font-weight: 700;
    font-size: 15px;
    padding: 10px 6px;
    border-left: #4A5462 solid 1px;
}
.dataGridPrisnor tr.odd td
{
    border-left: #E6E9EC solid 1px;
}
.dataGridPrisnor tr.even td
{
    background: #FAFAFA;
    border-bottom: #E6E9EC solid 1px;
    border-top: #E6E9EC solid 1px;
    border-left: #E6E9EC solid 1px;
}
.captcha_img
{
    background-color: #fafafa;
    height: 35px;
    text-align: center;
    width: 100%;
}
.captcha_img img
{
    height: 33px;
    width: 100%;
}
.reload_refresh
{
    width: 100%;
    float: left;
}
.reload_refresh input
{
    width: auto;
}
.reload_refresh img
{
    width: 33px;
    height: 33px;
}
.carousel-caption
{
    left: 8%;
    padding-bottom: 0;
    right: 20%;
}

.btn-block + .btn-block
{
    margin-top: 0;
    margin-left: 10px;
}
.carousel-caption button
{
    background: #fa6a14;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 18px;
    padding: 6px 12px;
}
.quick_arriy
{
    width: 100%;
    float: left;
    margin-bottom: 10px;
    color: #000;
}
.quick_arriy input
{
    width: 90%;
    height: 35px;
    line-height: 35px;
    border-top-left-radius: 4px !important;
    border-bottom-left-radius: 4px !important;
}
.registration_btn
{
    background: #FA6A14;
    color: #fff;
    font-weight: 700;
    border-radius: 4px !important;
    padding: 8px 24px;
    float: right;
    font-size: 14px;
    -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color=#afafaf)";
    -moz-box-shadow: 0 1px 5px #afafaf;
    -webkit-box-shadow: 0 1px 5px #afafaf;
    box-shadow: 0 1px 5px #afafaf;
    filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color=#afafaf);
}
.registration_btn:hover
{
    background: #333;
    color: #fff;
    text-decoration: none;
    -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color=#afafaf)";
    -moz-box-shadow: 0 1px 5px #afafaf;
    -webkit-box-shadow: 0 1px 5px #afafaf;
    box-shadow: 0 1px 5px #afafaf;
    filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=180, Color=#afafaf);
}
.go_btn
{
    background: #8AB621 !important;
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    width: 35px !important;
    height: 35px;
    line-height: 35px;
    border-top-right-radius: 4px !important;
    border-bottom-right-radius: 4px !important;
    float: right;
    padding: 0;
    border: none;
}
.ss
{
    margin-top: 100px;
}
.footer_nav
{
    width: 100%;
    float: left;
    margin: 0;
    padding: 0;
}
.footer_nav li
{
    width: auto;
    float: left;
    list-style: none;
    padding: 5px 10px;
    color: #789fbf;
}
.footer_nav li a
{
    width: auto;
    float: left;
    padding: 0 10px;
    color: #fff;
}

.text-left{ text-align:left;}

footer_nav li a:hover
{
    text-decoration: none;
    color: #8ab621;
}
.red_text
{
    font-size: 11px;
    font-weight: 400;
    color:#0a467c;
}
.watermarked
{
    color: #ccc;
}
.text_align
{
    text-align: center;
}
.gray_bg
{
    background: #f6f6f6;
    padding: 15px 0;
    margin-top: 5px;
    border-bottom: 1px solid #eaeaea;
}
.gray_bg h2
{
    color: #666;
    line-height: 42px;
    margin: 0;
}
.position_absolute
{
    position: absolute;
    left: 0;
    right: 0;
}

.btn-info
{
    background-color: #0a467c;
    color: #fff;
    height: auto;
    padding:7px;
    width:100%;
    font-weight:bold;
}


.table a:not(.btn), table a:not(.btn) {

    padding: 2px 6px;
    text-decoration: none;  text-decoration:none;
}
.mGrid td span{
   border: 1px solid;
      margin: 5px 2px;
    padding: 2px 6px;
    text-decoration: none;  text-decoration:none;
}


.btn-info1
{
     padding:7px 10px;
    width:auto;
    }
    
    .btn-info2 {
  padding: 2px 12px;
  width: auto;
  border-radius: 50px !important;
}
 .btn-info3 {
   padding: 5px 15px;
  width: auto;
  border-radius: 50px !important;
  text-decoration: none;
  margin: 5px 0;
  float: left;
}
 .btn-info3 a{ text-decoration:none !important;}


/*--------------------- Footer Start ---------------------*/

.footer_bg{background:#d6e6f3; padding-top:30px; width:100%; float:left; color:#000; }
.footer_bg1{background:#d6e6f3; padding:10px 0; width:100%; float:left; color:#000; }
.social ul {float: left;list-style: outside none none;margin: 10px auto;padding: 0;}
.social ul li {display: inline-block; margin-right:10px; float:left; border-radius: 3px; padding: 0;text-align: center;width: 35px; height:35px; line-height:35px; color:#ffffff}
.social ul li a{display:block;color:#ffffff; font-size:20px;}
.social ul li:last-child{margin:0;}
.social .fb{background: #3c5b9b;}
.social .tw{background:#359bed;}
.social .googleplus {background:#e33729}
.social .rss{background:#fd9f13;}
.social .pintrest{background:#cb2027;}
.social .linkedin{background:#027ba5}
.social .youtube{background:#f03434;}
.social .youtube:hover {background: none repeat scroll 0 0 #f03434;}


.footer-middle { padding-bottom:15px; width:100%; float:left;}
.footer a:hover {text-decoration: none;}
.footer-bottom {border-top: 1px solid #4d5559;margin: auto; background: #000; overflow: hidden;padding-top:10px; width: 100%;margin-bottom:-10px;}
.coppyright {color: hsl(0, 0%, 80%);text-align: center;}
.footer-bottom a {color: #aaa;}
.footer-bottom a:hover {text-decoration: none;}


.border_right{border-right: 1px solid #4d5559;}
.footer-bottom a:hover {color: #fff;}
.footer p {color: #ccc;font-size: 12px;padding-bottom: 5px; padding-top: 5px;}
.payment-accept img {height: auto;margin: 0 10px 8px 0;width: 50px;}
.footer-middle h4 {color: #000;font-family:Arial, Helvetica, sans-serif;font-size: 14px;font-weight: bold;margin: 0;padding: 0 0 10px;text-transform: uppercase;}
.links {margin: auto;padding: 0; width:100%; float:left;}
.links li {list-style: outside none none;padding: 5px 0;}
.links li a {color: #000;transition: color 300ms ease-in-out 0s, background-color 300ms ease-in-out 0s, background-position 300ms ease-in-out 0s;}
.links li a:hover {color: #be1b47;text-decoration: none;}

.links2 {margin: auto;padding: 0; width:100%; float:left;}
.links2 li {list-style: outside none none; padding: 5px 0; float:left; width:25%}
.links2 li a {color: #000;transition: color 300ms ease-in-out 0s, background-color 300ms ease-in-out 0s, background-position 300ms ease-in-out 0s;}
.links2 li a:hover {color: #be1b47;text-decoration: none;}

.footer-logo .logo {float: none;}
.contacts-info {width:100%; float:left; width:100%; padding:0px;}
.contacts-info li{width:100%; float:left; margin:0px; padding:15px 0 0 0; list-style:none; color: #000;font-style: normal;line-height: 1.5em; }
.add_email_phone-icon{border: 2px solid #aaa;border-radius: 25px;color: #000;display: inline-block;float: left;font-style: normal;height: 35px;line-height: 35px;margin:0 2% 1% 0 ;text-align: center; width: 35px; font-size:18px; padding-top:5px;} 
.contacts-info li a{color: #ccc;font-style: normal;}

.back-to-top {background: none;margin: 0;position: fixed;bottom:1%;right:1%;width:35px;height:35px;z-index: 100;display: none;text-decoration: none;color: #ffffff;background-color: #be1b47; text-align:center; padding-top:10px;}
.back-to-top:hover{background:#2ca266; color:#fff;}

.navbar-toggle {
    background-color: #5790BD;
     border-color: #5790BD;}
     .navbar-collapse {
   
    overflow-x:hidden;
    padding:0px;
}

.valediction{ font-size:11px; color:#0093C8; font-weight:normal;}
.alert-info {
    background-color: #d9edf7;
    border-color: #bce8f1;
    color: #31708f;
}
.alert-info img{ width:100%;/*border-radius: 100%;*/ border:solid 1px #31708f;}
.alert-info p{ font-size:12px; line-height:20px; margin:0px}


.navbar-fixed{ position:fixed!important; width:100%; background-color:#0a467c; color:#fff} 
.skin-blue .main-header .logo1 {
    background-color: #367fa9;
    border-bottom: 0 solid transparent;
    color: #fff;
    font-size: 20px;
}


.height_30{ height:33px !important}

.padd-top{ padding-top:71px;}
.width80p{ width:87%; float: left;}
.width45p{ width:45%; float: left;}
.width50p{ width:50%; float: left;}
.width20p{ width:13%; float: left;}
.width20p img { width:100%;}
.login_btn{ width:15%; float:right}
.width_50auto{ width:50%; margin:0 auto;}
.width_70auto{ width:70%; margin:0 auto;}

.width33p{ width:33%; float: left;}
.width100p{ width:100%; float: left;}
.width100p input[type="checkbox"], input[type="radio"]{ margin:0 5px 0 0;}
.marg_bottom5{ margin-bottom:5px;}
.pnl_details{ width:100%; background:#f5f5f5; color:#646464; float:left; border-top:solid 1px #ccc; margin-top:15px; padding:10px;font-weight:normal !important;}
.pnl_details a{ width:100%;color:#646464;padding:0 0 10px 0; float:left; font-weight:normal !important;}
.pnl_details a span{ width:100%; color:#646464 !important;font-weight:normal !important; }

 .left_bg1{ max-height:585px; overflow:auto;}
.left_bg2{border-right:solid 1px #ccc; margin-top:-4px;}
.left_bg3{overflow:auto; border-right:solid 1px #ccc; margin-top:-4px; padding:15px;}

-webkit-.left_bg1{max-height: 1241px;}
.max_height300{ max-height:300px; overflow:auto;}
.npip_bg{ background:url("../images/npip_bg.png") no-repeat scroll center bottom #fff}

.prisoner_images{ width:100%; float:left; background:#fff; padding:8px; -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=90, Color=#333333)";/*IE 8*/
-moz-box-shadow: 0px 0px 5px #333333;/*FF 3.5+*/
-webkit-box-shadow: 0px 0px 5px #333333;/*Saf3-4, Chrome, iOS 4.0.2-4.2, Android 2.3+*/
box-shadow: 0px 0px 5px #333333;/* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=90, Color=#333333); /*IE 5.5-7*/
}
.prisoner_images img{ width:100%; } 

.form-group {
    font-size: 12px;
    margin-bottom: 15px;
    width:100%; float:left;
    
}

.logo3{ padding:7px 15px !important;}

.logo{width:200px; height:69px;}
.width20ps {
    float: left;
    width: 20%;
}
.width79ps {
    float: left;
    width: 79%;
}
.bg21{background:#f1f1f1;}
.alerts_list{ width:100%; float:left; background:#f1f1f1;}
.alerts_list li{ width:33.3%; float:left; padding:20px; list-style:none}
.alerts_list li:last-child{ float:right}
.alerts_list_img{ width:30%; float:left}
.alerts_list_text{ width:70%; float:left; font-size:13px; font-weight:700; line-height:18px;  border-bottom:solid 1px #ccc; padding-bottom:12px;}
.alerts_list_text h1{ font-size:16px; margin-bottom:5px;}
.alerts_list_text a{ color:#000; float:left; width:100%;}
.badge {
    /* float: right; */
    min-width: 54px;
    /* text-align: right; */
    /* height: 24px; */
    background-color: #00c0ef;
}

.border_right1{
    border-right: 1px solid #ccc;
    min-height:470px;
   
}

.sidebar-menu > li {
    border-bottom: 1px dashed #ccc;
    margin: 0;
    padding: 0;
    position: relative;
}

.sidebar a {
    color: #000;
    font-size: 13px;
    font-weight: bold;
}
.view_btn {
    background: #FF0000;
    border-radius: 50px;
    color: #FFFFFF;
    float: right;
    font-size: 12px; font-weight:bold; text-transform:uppercase;
    padding: 5px 10px;
}
.view_btn a{ color: #FFFFFF;}

.view_btn a:hover{ color: #FFFFFF;}

.forms_bg{ width:100%; border-bottom:solid 1px #ccc; float:left; padding:5px; background:#f4f4f4; margin-bottom:30px;}

.photo_gallery{ width:100%; padding:0px; margin:0px;}
.photo_gallery li{ float:left; list-style:none;padding:5px; border:solid 1px #ccc; margin-right:10px;}
 .photo_gallery li img{ width:100%;}       
.photo_gallery li input{padding:5px;}
.gallery_name{ padding:5px 0; font-size:12; font-weight:bold; float:left;} 
.gallery {
    background: #FF0000;
    border-radius: 10%;
    color: #FFFFFF;
    float: right;
    margin-top:5px;
    padding:0px 5;
    font-size: 12px; font-weight:bold; text-transform:uppercase;
  }
  
  .content-header{ padding:0px;}
  .content-header h1{ border-bottom:solid 1px #ccc; line-height:40px; margin-bottom:15px;}



@media screen and (max-width:1024px)
{
.links2 li {width:50%}
}
@media (min-width:768px) and (max-width:980px)
{
    
    .navbar-nav > li > a
{
    padding: 26px 12px;
}
}

@media (min-width:481px) and (max-width:640px)
{
    .logo {
    float: left;
    padding: 16px 0;
}
.navbar-nav > li > a {
    padding: 15px;
}
.footer_nav li {

    width: 100%;
}
.footer_nav li a { text-align:center;
}
    .silder
    {
        background: #588EBC;
    }
}
@media (min-width:240px) and (max-width:480px)
{
.logo {
    float: left;
    padding: 16px 0;
}
.navbar-nav > li > a {
    padding:10px 15px;
}
    .silder
    {
        background: #588EBC;
    }
    .footer_nav li {

    width: 100%;
}

.footer_nav li a { text-align:center;
    
     float: none;}
    .quick_arriy input
    {
        width: 85%;
    }
    .footer_text
    {
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }
    .footer_text img
    {
        margin-top: 10px;
    }
}
/* New complaint custome css*/
#wizHeader li .prevStep
{
    background-color: #FA6913;
}
#wizHeader li .prevStep:after
{
    border-left-color:#FA6913 !important;
}
#wizHeader li .currentStep
{
    background-color: #89B520;
}
#wizHeader li .currentStep:after
{
    border-left-color: #89B520 !important;
}
#wizHeader li .nextStep
{
    background-color:#C2C2C2;
}
#wizHeader li .nextStep:after
{
    border-left-color:#C2C2C2 !important;
}
#wizHeader
{
    list-style: none;
    overflow: hidden;
    margin-bottom:0.5px;
}
#wizHeader li
{
    float: left;
}
#wizHeader li a
{
    color: white;
    text-decoration: none;
    padding: 10px 12px 10px 50px;
    background: brown; /* fallback color */
    background: hsla(34,85%,35%,1);
    position: relative;
    display: block;
    float: left;
}
#wizHeader li a:after
{
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 50px solid transparent; /* Go big on the size, and let overflow hide */
    border-bottom: 50px solid transparent;
    border-left: 30px solid hsla(34,85%,35%,1);
    position: absolute;
    top: 50%;
    margin-top: -50px;
    left: 100%;
    z-index: 2;
}
#wizHeader li a:before
{
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 50px solid transparent;
    border-bottom: 50px solid transparent;
    border-left: 30px solid white;
    position: absolute;
    top: 50%;
    margin-top: -50px;
    margin-left: 1px;
    left: 100%;
    z-index: 1;
}
   
#wizHeader li:first-child a
{
    padding-left: 17px;
}
#wizHeader li:last-child 
{
    padding-right: 50px;
}

#wizHeader li a:hover
{
    background: #FE9400;
}
#wizHeader li a:hover:after
{
    border-left-color: #FE9400 !important;
}        
.content
{
    height:auto;           
    padding:20px;
    background-color:#F9F9F9;
    border:solid 1px #ccc;
    margin-bottom:15px;
}




	</style>

</head>
<body> 
	<section class="content">

		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">


				<!-- /.box-header -->
				<div class="box-body" >

					<fieldset>

						<div class="table-responsive">

							<span id="success_message"></span>
								<div class="col-md-12">
									<div class="col-md-6" id="divFY">
										
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="dashboard-box orange hvr-glow">
													<div class="padd">
														<div class="icon orange1 hvr-pulse">
															<img src="../images/icon5.png" title="icon">
														</div>
														<div class="headlin">
															<div class="dashboard_name">
																<h4>  Registered Cases</h4>
															</div>
															<div class="dashboard_reports">
																<span id="ContentPlaceHolder1_lblTotalRegistration" style="font-size:18px;"> 9233</span>
															</div>
														</div>
													</div>
													<div class="orange1 more">
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="dashboard-box  purple-plum hvr-glow">
													<div class="padd">
														<div class="icon purple-plum hvr-pulse">
															<i class="fa fa-trash-o	" style="color:#fff; font-size:18px;" aria-hidden="true"></i>
														</div>
														<div class="headlin">
															<div class="dashboard_name">
																<h4>  Disposed Cases</h4>
															</div>
															<div class="dashboard_reports">
																<span id="ContentPlaceHolder1_lblTotlaDistposed" style="font-size:18px;"> 5715</span>
															</div>
														</div>
														<!-- padd End-->
													</div>
													<div class="purple-plum1 more">
													</div>
													<!-- dashboard-box End-->
												</div>
											</div>
										</div>

										<div class="col-md-6" id="divFY">
										
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="dashboard-box orange hvr-glow">
													<div class="padd">
														<div class="icon orange1 hvr-pulse">
															<img src="../images/icon5.png" title="icon">
														</div>
														<div class="headlin">
															<div class="dashboard_name">
																<h4>  Registered Cases</h4>
															</div>
															<div class="dashboard_reports">
																<span id="ContentPlaceHolder1_lblTotalRegistration" style="font-size:18px;"> 9233</span>
															</div>
														</div>
													</div>
													<div class="orange1 more">
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="dashboard-box  purple-plum hvr-glow">
													<div class="padd">
														<div class="icon purple-plum hvr-pulse">
															<i class="fa fa-trash-o	" style="color:#fff; font-size:18px;" aria-hidden="true"></i>
														</div>
														<div class="headlin">
															<div class="dashboard_name">
																<h4>  Disposed Cases</h4>
															</div>
															<div class="dashboard_reports">
																<span id="ContentPlaceHolder1_lblTotlaDistposed" style="font-size:18px;"> 5715</span>
															</div>
														</div>
														<!-- padd End-->
													</div>
													<div class="purple-plum1 more">
													</div>
													<!-- dashboard-box End-->
												</div>
											</div>
										</div>
										
										</div>
										</div>

									<div class="clearfix"></div>

								</div>

							</fieldset>
						</div>
					</div>
				</div>

				<div class="col-md-2">  </div>
			</section>
		</body></html>