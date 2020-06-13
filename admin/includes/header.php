<?php 
if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
echo "<script>window.location='index.php';</script>";
exit; 
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $website_title; ?></title>

       <meta name="keywords" content="<?php echo $website_keywords; ?>" />
		<meta name="description" content="<?php //echo $website_desc; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/deactive.css" />
		
		<!--- link deactive -->
		<!--<link rel="stylesheet" href="assets/css/link_deactive.css" />-->

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<style>
input[type=radio] {
	opacity : inherit;
}
</style>	
	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="dashboard.php">
		<!--<img src="images/mlmlogo.png"  width="120" height="60">-->
	<img src="../uploads/logo/<?php echo $sitelogo;?>" width="120" height="60">
		
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
				

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<!--<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />-->
								<span class="user-info">
									<small>Welcome,</small>
									Administrator
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="setting.php">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="password.php">
										<i class="icon-user"></i>
										Password
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							
							
							</ul>
							
						</li>
						<li>
							
								<span class="badge badge-success">
								<a href="logout.php" style="color:#FFFFFF;">Logout</a>
								
								</span>
							
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
		<script>
			function demo(){
				alert("You can not change in Demo version");
				return false; 
			}
		</script>