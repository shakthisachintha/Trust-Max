<?php 
include "admin/AMframe/config.php";
include "includes/head.php";
$uid=isset($_GET['uid'])?$_GET['uid']:'';
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
	exit;
}
?>
</head>
    <body>
		<div class="container main">
			<?php include "includes/header.php"; ?>
			<hr/>
			<?php include "includes/profileheader.php";	?>
			<hr/>
			<div class="row">
                <?php include "includes/profilemenu.php";?>
                <div class="col-sm-9">
                   <div class="" style="">
						<div class="clearfix"></div>
						<div class="col-sm-12 " >
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">BINARY  STRUCTURE</h4>
							<div class="table-responsive">
							    <div class="tree" style="min-width:600px;">
							<?php
							$uid=replace($uid);
							$uid=!empty($uid)?$uid:$_SESSION['profileid'];
							echo $uid;
							$ext_obj->usertree($uid,0,0);
							?>
						  </div>
						  </div>
					   </div>
					<div class="clearfix"></div>
				    <br/>
					</div>
					<?php include "includes/login-access-ads.php";?>
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	.numwraper img {
		width: 100%;
		height: 100%;
	}
	
	.numwraper span {
		position: absolute;
		right: 34%;
		top: 31%;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-weight:bold;
		font-size: 12px;
		background-color: #FFF;
		padding: 0px 2px 0px 2px;
		display: block;
	}
</style>
<style type="text/css">
	a.tooltipp 
	{
	outline:none;
	opacity: 1;
	} 
	a.tooltipp strong 
	{
	line-height:30px;
	} 
	a.tooltipp:hover 
	{
	text-decoration:none;
	} 
	a.tooltipp span 
	{
	z-index:10;display:none; 
	padding:14px 20px;
	margin-top:-30px; 
	margin-left:10px; 
	width:300px;
	line-height:16px;
	} 
	a.tooltipp:hover span
	{ 
	display:inline;
	position:absolute; 
	color:#111;
	border:1px solid #DCA;
	background:#fffAF0;} 
	.callout {
	z-index:20;
	position:absolute;
	top:30px;
	border:0;
	left:-12px;
	} 
	a.tooltipp span { 
	border-radius:4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px; 
	-moz-box-shadow: 5px 5px 8px #CCC;
	-webkit-box-shadow: 5px 5px 8px #CCC;
	box-shadow: 5px 5px 8px #CCC;
	}
 </style>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		<script>
		 $(function () {
  $('[data-toggle="popover"]').popover()
})
		</script>
	</body>
</html>