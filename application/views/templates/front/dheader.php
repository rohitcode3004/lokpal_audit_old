<!-- ================= Header for Chairperson ================= -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Complaint Management System Lokpal of India</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="<?php echo base_url();?>assets/admin_material/dashboard/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/admin_material/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
      <!-- Animation Css -->
  <link href="<?php echo base_url();?>assets/admin_material/plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/admin_material/dashboard/css/mystyle.css" rel="stylesheet">


  <script src="<?php echo base_url();?>assets/admin_material/dashboard/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin_material/dashboard/js/bootstrap.min.js"></script>





  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<script type="text/javascript">
  	var baseURL= "<?php echo base_url();?>";
</script>

</head>
<body class="app sidebar-mini">
    <div class="page-main">
        <div class="main-wrapper">
        	<nav class="navbar">
			  <div class="container-fluid">
			    <div class="nav-header">
			      <ul>
			      	<li class="logo-left"><a href="#">
			      		<img src="<?php echo base_url();?>assets/admin_material/dashboard/images/lokpal_logo.png" alt="logo"></a>
			      	</li>
			      	<li>
			      		<a href="#" class="toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
			      	</li>
			      	<li class="logo-right">
			      		<a href="#"><img src="<?php echo base_url();?>assets/admin_material/dashboard/images/logo_lokpal.png" alt="logo"></a>
			      	</li>
			      </ul>
			    </div>
			  </div>
			</nav>

			<aside class="app-sidebar">
                <div class="app-sidebar_user">
                	<div class="user-box">
                		<div class="user-img"><img src="<?php echo base_url();?>assets/admin_material/dashboard/images/avatar.jpg" alt="logo"></div>
                		<h5><?php echo  $user['username']; ?></h5>
                		<p>Chairperson, Lokpal of India</p>
                		<a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                	</div>

                	<div class="side-menu">
                		<ul class="sidebar-menu">
                			<li>
                				<a href="<?php echo base_url('bench/dashboard_main'); ?>">
                					<i class="fa fa-dashboard side-menu_icon"></i> 
                					<span>Dashboard</span>
                				</a>
                			</li>
                			<li>
                				<a href="#">
                					<i class="fa fa-sitemap side-menu_icon" aria-hidden="true"></i>
                					<span>Complaints for Allocation to Benches</span> 
                					<i class="fa fa-angle-left icon-right"></i>
                				
                				</a>
                				<ul class="sidebar-submenu">
                					<li><a href="<?php echo base_url('bench/get_complaints/F'); ?>"><i class="fa fa-circle-o"></i> New complaints</a></li>
                					<li><a href="<?php echo base_url('bench/get_complaints/I'); ?>"><i class="fa fa-circle-o"></i> Complaints for which Preliminary-Inquiry  Report has been Accepted</a></li>
                					<li><a href="<?php echo base_url('bench/get_complaints/V'); ?>"><i class="fa fa-circle-o"></i> Complaints for which investigation Report has been Accepted</a></li>
                				</ul>
                			</li>
                			<li>
                				<a href="<?php echo base_url('bench/benchcomposition_separate'); ?>">
                					<i class="fa fa-pencil-square-o side-menu_icon" aria-hidden="true"></i> 
                					<span>Creation of new Bench</span> 
                				</a>
                			</li>
                			<li>
                				<a href="<?php echo base_url('bench/benches_all'); ?>">
                					<i class="fa fa-cubes side-menu_icon" aria-hidden="true"></i> 
                					<span>List of Existing Benches</span> 
                				</a>
                			</li>
                			<li>
                				<a href="#">
                					<i class="fa fa-file-text-o side-menu_icon" aria-hidden="true"></i> 
                					<span>MIS Report</span> 
                					<i class="fa fa-angle-left icon-right"></i>
                				</a>
                				<ul class="sidebar-submenu">
                					<li><a href="<?php echo base_url('report/status_of_complaints'); ?>"><i class="fa fa-circle-o"></i> Status of all Complaints</a></li>
                					<li><a href="<?php echo base_url('report/status_of_complaints_under_loi'); ?>"><i class="fa fa-circle-o"></i> Status of Complaints under consideration with Lokpal of India</a></li>
                					<li><a href="<?php echo base_url('report/category_of_complaints'); ?>"><i class="fa fa-circle-o"></i> Status of Complaints Category Wise</a></li>
                				</ul>
                			</li>
                			<li>
                				<a href="<?php echo base_url('bench/search_case'); ?>">
                					<i class="fa fa-search side-menu_icon" aria-hidden="true"></i>
                					<span>Search Status of Complaints</span> 
                				</a>
                			</li>

                            <li>
                                <a href="<?php echo base_url('order_report/list_of_case'); ?>">
                                    <i class="fa fa-search side-menu_icon" aria-hidden="true"></i>
                                    <span>View Order/Report</span> 
                                </a>
                            </li>
                            
                			<li>
                				<a href="#">
                					<i class="fa fa-user-o side-menu_icon" aria-hidden="true"></i> 
                					<span>User Account Management</span> 
                					<i class="fa fa-angle-left icon-right"></i>
                				</a>
                				<ul class="sidebar-submenu">
                					<li><a href="#"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                					<li><a href="<?php echo base_url('user/update_user_pass'); ?>"><i class="fa fa-circle-o"></i> Update Password</a></li>
                				</ul>
                			</li>
                		</ul>
                	</div>
                </div>
            </aside>
