<?php 
include("admin/AMframe/config.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{

$new_pass=addslashes($_REQUEST['new_pass']);


$qry=$db->insertrec("update mlm_register set user_password='$new_pass' where user_id='$_SESSION[userid]'");

if($qry)
{
header("location:changepassprofile.php?succ");
echo "<script>window.location='changepassprofile.php?succ';</script>";
}

}

include("includes/head.php");

?>
<script language="javascript">
function changepass()
{
	// cur_pass current_pass new_pass con_new_pass //
   
	var cur_pass = document.getElementById('cur_pass').value;
	var current_pass = document.getElementById('current_pass').value;
	var new_pass = document.getElementById('new_pass').value;
	var con_new_pass = document.getElementById('con_new_pass').value;
	
	
	if(current_pass == "") // ----- check current password not null -----
	{
		alert("Enter your current password.");
		document.getElementById('current_pass').focus();
		return false;
	}
	
	
	if(current_pass != cur_pass) // ----- check current password correct or not -----
	{
		alert("Enter your correct current password.");
		document.getElementById('current_pass').value = "";
		document.getElementById('current_pass').focus();
		return false;
	}
	
	if(new_pass == "") // ----- check New password not null -----
	{
		alert("Enter your new password to change.");
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(con_new_pass == "") // ----- check confirm password not null -----
	{
		alert("Enter your new password again for verification.");
		document.getElementById('con_new_pass').focus();
		return false;
	}
	
	
	if(new_pass == cur_pass) // ----- check current password and new password are same -----
	{
		alert("Your New pasword and Old password are same,\nChange your new password.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(new_pass.length < 6) // ----- check new password length -----
	{
		alert("Your new password is too short,\nEnter above 6 letters.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(con_new_pass != new_pass) // ----- check new password length -----
	{
		alert("Your new password and confirm password are not same,\nPlease try again.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	var tmp = new_pass.search(" ");
	//	alert(tmp);
	if(tmp >= 0) // ----- check new password not have empty space -----
	{
		alert("Space not allowed in password.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	
	//alert(cur_pass+", "+current_pass+", "+new_pass+", "+con_new_pass);
	//return false;
}
</script>
<link href="css/deactive.css" rel="stylesheet" type="text/css" />
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
		
			<hr />
			
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="well" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Change Password</h4>
							<form action="" method="post" onClick="return changepass();">
                                <div class="table-responsive">
								<table class="table new_tbl2 new_tbl" cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php if(isset($_REQUEST['succ'])) { ?>
									<tr>
									<td colspan="3" align="center" style="color:#006633; font-weight:bold;">
									Password has been Changed Successfully !!!
									</td>
									
									</tr>
									<?php } ?>
									<tr>
										<td width="40%" align="right">
											<strong>Current password</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
											<input type="password" name="current_pass" id="current_pass" required="true"/>
											<input type="hidden" name="cur_pass" id="cur_pass" value="<?php echo  $userdetail['user_password']; ?>" />
										</td>
									</tr>
									<tr>
										<td align="right">
											<strong>New password</strong>
										</td>
										<td align="center">:</td>
										<td>
											<input type="password" name="new_pass" id="new_pass" required="true"/>
										</td>
									</tr>
									<tr>
										<td align="right">
											<strong>New password Again</strong>
										</td>
										<td align="center">:</td>
										<td>
											<input type="password" name="con_new_pass" id="con_new_pass" required="true"/>
										</td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<input type="submit" name="submit" class="greenbtn" value="Save"/>
										</td>
									</tr>
								</table>
								</div>
								</form>
							</div>
                        </div>
                    </div>
                    <br />
					<?php include "includes/login-access-ads.php";?>
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>