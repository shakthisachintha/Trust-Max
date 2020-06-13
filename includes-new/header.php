<?php 
include "admin/AMframe/config.php"; 

if(isset($_SESSION['profileid']) && isset($_SESSION['userid']))
{
	$userdetail=$db->singlerec("select * from mlm_register where user_status='0' and user_id='$_SESSION[userid]'");
	$profilename=$userdetail['user_fname'];
	if(file_exists("uploads/profile_image/thumb/".$userdetail['user_image']) && $userdetail['user_image']!='')
	{
		$profileimages="uploads/profile_image/thumb/".$userdetail['user_image'];
	}
	else
	{
		$profileimages="images/user_coat_red_01.png";
	}
} else {
	$profilename="Profile name";
	$profileimages="images/user_coat_red_01.png";
}

$filename = $_SERVER['SCRIPT_FILENAME'];

$pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.')));
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $website_title; ?></title>
	<meta name="description" content="">
	<meta name="keywords" content="<?php echo $website_keywords; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon -->
	<link rel="shortcut icon" href="uploads/favicon/<?php echo $siteFavicon; ?>" type="image/x-icon">
	<link rel="apple-touch-icon" href="assets/images/icon.png">

	<!-- Google font (font-family: 'Montserrat', sans-serif;) -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
	<!-- Google font (font-family: 'Open Sans', sans-serif;) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,700" rel="stylesheet">

	<!-- Plugins -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/plugins.css">

	<!-- Style Css -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" href="assets/css/custom.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

	<!-- Add your site or application content here -->

	<!-- Wrapper -->
	<div id="wrapper" class="wrapper">

		<!-- Header -->
		<header class="header">

			<!-- Header Top Area -->
			<div class="header-toparea">
				<div class="container">
					<div class="row justify-content-betwween">
						<div class="col-lg-6">
							<ul class="header-topcontact">
								<li><i class="zmdi zmdi-phone"></i> <a href="#"><?=$website_phone;?></a></li>
								<li><i class="zmdi zmdi-email"></i>  <a href="#"><?=$website_admin;?></a></li>
							</ul>
						</div>
						<div class="col-lg-6">
							<ul class="header-toplinks">
							<?php if(isset($_SESSION['profileid'])){?>
								<li><a href="dashboard.php" class=" btn btn1 btn-light"><i class="zmdi zmdi-account" ></i>My Account</a></li>
								<li><a href="logout.php" class="btn btn1 btn-primary"><i class="zmdi zmdi-lock" ></i>Logout</a></li>
							<?php } else {?>
							    <li><a href="login.php" class=" btn btn1 btn-light"><i class="zmdi zmdi-account" ></i>Sign In</a></li>
								<li><a href="register.php" class="btn btn1 btn-primary"><i class="zmdi zmdi-lock" ></i>Sign Up</a></li>
							<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--// Header Top Area -->

			<!-- Header Bottom Area -->
			<div class="header-bottomarea " >
				<div class="container">
					<div class="header-bottom">

						<!-- Header Logo -->
						<a href="index.php" class="header-logo">
							<?php if(!empty($sitelogo) && file_exists("uploads/logo/$sitelogo")){ ?>
							<img src="uploads/logo/<?=$sitelogo;?>" alt="<?=$website_title;?>" width="175" height="88"/>
						 <?}else {?>
						 <img src="uploads/no_image.jpg" alt="blog thumbnail" width="175" height="88">
						 <? } ?>
						</a>
						<!--// Header Logo -->

						<!-- Main Navigation -->
						<nav class="in-navigation">
							<ul>
								<li class=""><a <?php if($pg=='index'){ echo 'class="active"';}else{ echo '' ;}?> href="index.php">HOME</a></li>
								<li class=""><a <?php if($pg=='about'){ echo 'class="active"';}else{ echo '' ;}?> href="about.php">ABOUT</a></li>
								<li class=""><a <?php if($pg=='product'){ echo 'class="active"';}else{ echo '' ;}?> href="product.php">Products</a></li>
								<li class=""><a <?php if($pg=='how-it-works'){ echo 'class="active"';}else{ echo '' ;}?> href="how-it-works.php">How It Works</a></li>
                                <!--<li class=""><a <?php if($pg=='news'){ echo 'class="active"';}else{ echo '' ;}?> href="news.php">News</a></li>
								<li class=""><a <?php if($pg=='event'){ echo 'class="active"';}else{ echo '' ;}?> href="event.php">Events</a></li>-->
								<li class=""><a <?php if($pg=='faq'){ echo 'class="active"';}else{ echo '' ;}?> href="faq.php">FAQ</a></li>
								<li class=""><a <?php if($pg=='contact'){ echo 'class="active"';}else{ echo '' ;}?> href="contact.php">Contact Us</a></li>
							</ul>
						</nav>
						<!--// Main Navigation -->
                        <!--<div class="header-right-wrap">
                            <div class="header-search">
                                <button class="header-searchtrigger"><i class="zmdi zmdi-shopping-cart-plus"></i></button>
                                <form class="header-searchbox" action="#">
                                    <h6><i class="zmdi zmdi-shopping-cart-plus"></i>Your cart is currently empty.</h6>
                                </form>
                            </div>
                        </div>-->
						

					</div>
				</div>
			</div>
			<!--// Header Bottom Area -->

			<!-- Mobile Menu -->
			<div class="mobile-menu-wrapper clearfix">
				<div class="container">
					<div class="mobile-menu"></div>
				</div>
			</div>
			<!--// Mobile Menu -->

		</header>
		<style>
		.required{
			color:red;
		}
		</style>
		<!--// Header -->