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
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $website_title; ?></title>
        <meta name="description" content="<?php //echo $website_desc; ?>" />
		<meta name="keywords" content="<?php echo $website_keywords; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		<!-- google fonts -->
		<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- pe-icon-7-stroke -->
		<link rel="stylesheet" href="css/pe-icon-7-stroke.min.css">
		<!-- pe-icon-7-stroke -->
		<link rel="stylesheet" href="css/jquery.simpleLens.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- nivo.slider css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
		<!-- modernizr js -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
		<!--google recaptcha -->
		<script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- header section start -->
		<header class="pages-header">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="left-header clearfix">
								<ul>
									<li><p><i class="pe-7s-mail"></i><?=$website_admin;?></p></li>
									<li><p><i class="pe-7s-clock"></i><?=$website_name;?></p></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="right-header">
								<ul>
									<?php if(isset($_SESSION['profileid'])){?>
									<li>
										<a href="profile.php">
											<p class="loginbut1"><i class="pe-7s-user mar10"></i>My Account</p>
										</a>
									</li>
									<li>
										<a href="logout.php">
											<p class="loginbut1"><i class="pe-7s-lock mar10"></i>Logout</p>
										</a>
									</li>
									<?php } else {?>
									<li>
										<a href="login.php">
											<p class="loginbut1"><i class="pe-7s-lock mar10"></i>Login</p>
										</a>
									</li>
									<li>
										<a href="register.php">
											<p class="loginbut1"><i class="pe-7s-unlock mar10"></i>Sign Up</p>
										</a>
									</li>
									<?php }?>
									
									<li class="hidden"></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-bottom" id="sticky-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-2 col-md-2">
							<div class="logo">
								<a href="index.php"><img src="<?php echo $logourl;?>" alt="<?=$website_title;?>" width="175" height="55"/></a>
							</div>
						</div>
						<div class="col-sm-10 col-md-10">
							<div class="mainmenu clearfix">
								<nav>
									<ul>
										<li><a href="index.php">Home</a>
											
										</li>
										<li class="active"><a href="about.php">About Us</a>
											
										</li>
										<li><a href="product.php">Product</a></li>
										<li><a href="news.php">News</a>
											
										</li>
										<li><a href="event.php">Events</a></li>
										<li><a href="faq.php">FAQ</a></li>
										
										<li class="active"><a href="contact.php">Contact</a>
											
										</li>
										
										
									</ul>
								</nav>
							</div>
							<!-- mobile menu start -->
							<div class="mobile-menu-area">
								<div class="mobile-menu">
									<nav id="dropdown">
										
									 <ul>
										<li><a href="index.php">Home</a>
											
										</li>
										<li class="active"><a href="about.php">About Us</a>
										
										</li>
										<li><a href="product.php">Product</a></li>
										<li><a href="news.php">News</a>
											
										</li>
										<li><a href="event.php">Events</a></li>
										<li><a href="faq.php">FAQ</a></li>
										
										<li><a href="contact.php">Contact</a>
											
										</li>
										
										
									 </ul>
								  </nav>
								</div>
							</div>
							<!-- mobile menu end -->
						</div>
					</div>
					</div>
				</div>
			</div>
		</header>