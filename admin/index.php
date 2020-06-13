<?php 
include("AMframe/config.php");

if((isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']!=""))
{
header("location:dashboard.php");
}

$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'';

if(isset($_REQUEST['submit']) || isset($_REQUEST['dlogin'])){
    if(isset($_REQUEST['dlogin'])){
        $username=base64_decode($_REQUEST['username']);
        $password=base64_decode($_REQUEST['password']);
} else {
	$username=stripslashes($_REQUEST['username']);
	$password=stripslashes($_REQUEST['password']);
}	
	if($username=="" || $password==""){
		$_SESSION["errorType"]="danger";
		$_SESSION["errorMsg"]="Enter Fields";
	}else{
		$sql="select * from mlm_admin where admin_username='$username' and admin_password='$password'";
		$count=$db->numrows($sql);
		
		$fetv=$db->singlerec($sql);
		if($count>0){ 
			$_SESSION["errorType"] = "success";
            $_SESSION["errorMsg"] = "You have successfully logged in.";
			$_SESSION["admin_id"] = 0;
            $_SESSION["admin_username"] = $fetv["admin_username"];
			header("Location:dashboard.php");
			exit;
		}else{
	    $username=stripslashes($_REQUEST['username']);
		$password=stripslashes($_REQUEST['password']);
		
		$s="select * from mlm_staff where staff_email='$username' and staff_password='$password' and active_status='1'";
		$c=$db->numrows($s);
		$f=$db->singlerec($s);
			if($c>0){				
				$_SESSION["errorType"] = "success";
				$_SESSION["errorMsg"] = "You have successfully logged in.";
				$_SESSION["admin_id"] = 1;
				$_SESSION["staff_username"] = $f["staff_username"];
			   $_SESSION["staff_email"] = $f["staff_email"];
			}else{
				$_SESSION["errorType"] = "info";
				$_SESSION["errorMsg"] = "username or password does not exist.";
			}
		}
	}
	
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login Page - Ace Admin</title>

<meta name="description" content="User login page" />
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

<!--[if lte IE 8]>
<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
<![endif]-->

<!--inline styles related to this page-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>

function loginvalidate()
{

if(document.getElementById('username').value=="")
{
alert("Enter the Username");
document.getElementById('username').focus();
return false;

}

if(document.getElementById('password').value=="")
{
alert("Enter the Password");
document.getElementById('password').focus();
return false;

}


}



</script>

</head>

<body class="login-layout">
<div class="main-container container-fluid">
<div class="main-content">
<div class="row-fluid">
<div class="span12">
<div class="login-container">
<div class="row-fluid">
<div class="center">
	<h2 class="blue">
		<img src="<?php echo $logourl;  ?>"  width="120" height="80"> &nbsp;&nbsp;ADMIN PANEL	</h2>
	
</div>
</div>

<div class="space-6"></div>

<div class="row-fluid">
<div class="position-relative">
	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header blue lighter bigger">
					<i class="icon-coffee green"></i>
					Please Enter Admin Information
				</h4>

				<div class="space-6"></div>

                 <?php 
				 if(isset($_SESSION["errorMsg"])) {
				 ?>
             
			 <div align="center" style="color:#FF0000; margin-bottom:10px;">Account Doesn't Exists !!! </div>
			 <?php } ?>

				<form action="" method="post"  onSubmit="return loginvalidate();">
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<input type="text" name="username" id="username" class="span12" placeholder="Username" required />
								<i class="icon-user"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="password" name="password" id="password" class="span12" placeholder="Password" required/>
								<i class="icon-lock"></i>
							</span>
						</label>

						<div class="space"></div>

						<div class="clearfix">
					
				
						</div>

						<div class="space-4"></div>

						<div class="clearfix">
					
			
						</div>

						<div class="clearfix">
							<input type="submit" name="submit" value="LOGIN" class="btn btn-primary">
						</div></br>
                         <!--<div align="center"><a href=""onClick="window.open('http://2daybiz.com/products/2daybizusers/add.php?pro=advance-binary-mlm-admin', 'windowname1', 'scrollbars,resizable,width=480, height=250'); return false;"><span style="color:black;" >Click Here For Admin Demo Link </a> </span></div></br>-->
		
					</fieldset>
				</form>

				<div class="social-or-login center">
					<span class="bigger-110">&nbsp;</span>
				</div>

			</div><!--/widget-main-->

			<div class="toolbar clearfix" style="height:30px;">
				<div>
					<!--<a href="#" onClick="show_box('forgot-box'); return false;" class="forgot-password-link">
						<i class="icon-arrow-left"></i>
						I forgot my password
					</a>-->
				</div>

				<div>
					<!--<a href="#" onClick="show_box('signup-box'); return false;" class="user-signup-link">
						I want to register
						<i class="icon-arrow-right"></i>
					</a>-->
				</div>
			</div>
		</div><!--/widget-body-->
	</div><!--/login-box-->

	<div id="forgot-box" class="forgot-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header red lighter bigger">
					<i class="icon-key"></i>
					Retrieve Password
				</h4>

				<div class="space-6"></div>
				<p>
					Enter your email and to receive instructions
				</p>

				<form />
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="span12" placeholder="Email" />
								<i class="icon-envelope"></i>
							</span>
						</label>

						<div class="clearfix">
							<button onClick="return false;" class="width-35 pull-right btn btn-small btn-danger">
								<i class="icon-lightbulb"></i>
								Send Me!
							</button>
						</div>
					</fieldset>
				</form>
			</div><!--/widget-main-->

			<div class="toolbar center">
				<a href="#" onClick="show_box('login-box'); return false;" class="back-to-login-link">
					Back to login
					<i class="icon-arrow-right"></i>
				</a>
			</div>
		</div><!--/widget-body-->
	</div><!--/forgot-box-->

	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header green lighter bigger">
					<i class="icon-group blue"></i>
					New User Registration
				</h4>

				<div class="space-6"></div>
				<p> Enter your details to begin: </p>

				<form />
					<fieldset>
						<label>
							<span class="block input-icon input-icon-right">
								<input type="email" class="span12" placeholder="Email" />
								<i class="icon-envelope"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="text" class="span12" placeholder="Username" />
								<i class="icon-user"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="span12" placeholder="Password" />
								<i class="icon-lock"></i>
							</span>
						</label>

						<label>
							<span class="block input-icon input-icon-right">
								<input type="password" class="span12" placeholder="Repeat password" />
								<i class="icon-retweet"></i>
							</span>
						</label>

						<label>
							<input type="checkbox" />
							<span class="lbl">
								I accept the
								<a href="#">User Agreement</a>
							</span>
						</label>

						<div class="space-24"></div>

						<div class="clearfix">
							<button type="reset" class="width-30 pull-left btn btn-small">
								<i class="icon-refresh"></i>
								Reset
							</button>

							<button onClick="return false;" class="width-65 pull-right btn btn-small btn-success">
								Register
								<i class="icon-arrow-right icon-on-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="toolbar center">
				<a href="#" onClick="show_box('login-box'); return false;" class="back-to-login-link">
					<i class="icon-arrow-left"></i>
					Back to login
				</a>
			</div>
		</div><!--/widget-body-->
	</div><!--/signup-box-->
</div><!--/position-relative-->
</div>
</div>
</div><!--/.span-->
</div><!--/.row-fluid-->
</div>
</div><!--/.main-container-->

<!--basic scripts-->

<!--[if !IE]>-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<![endif]-->

<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]>-->

<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<!--<![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!--page specific plugin scripts-->

<!--ace scripts-->

<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
function show_box(id) {
$('.widget-box.visible').removeClass('visible');
$('#'+id).addClass('visible');
}
</script>
</body>
</html>
