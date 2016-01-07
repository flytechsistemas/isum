<?php
session_start();
include 'validar_session.php';
include 'includes/db.php';
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8"/>
<title>.: ISUM :.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_conquer.css"/>
<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-multi-select/css/multi-select.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-toastr/toastr.css"/>

<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.html"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="home.php?s=dashboard">
		<img src="assets/img/LogoISUM45_175.png" width="91" alt="logo" class="img-responsive"/>
		</a>

		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			
			<li class="dropdown" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="fa fa-envelope"></i>
				
				<span class="badge badge-success">
					 2
				</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 Usted tiene 2 requerimientos
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							
							<li>
								<a href="home.php?s=createdetallerequerimiento&id=1">
								 Nuevo Requerimiento.
								<span class="time">
									 2015-09-01
								</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li class="external">
						<a href="#">Ver todas las notificaciones <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			
			<!-- END NOTIFICATION DROPDOWN -->
			
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="username">
					 <?=$_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellido"];?>
				</span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
				<li>
					<a href="home.php?s=perfil&a=editar&id=<?=$_SESSION["usuario"]["id"]?>"><i class="fa fa-key"></i>Mi Perfil</a>
				</li>
				<li>
					<a href="index.php"><i class="fa fa-key"></i>Log Out</a>
				</li>
			</ul>
		</li>
		<!-- END USER LOGIN DROPDOWN -->
	</ul>
	<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<?php
generaMenu();
include 'contenido.php';
include 'footer.php';
?>