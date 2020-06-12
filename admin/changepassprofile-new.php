<?php include "includes-new/header.php";


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
		<!-- Page Conttent -->
	<main class="page-content">
	  
	  <div class="section-full bg-white section-padding-xs browse-job p-t50 p-b20">
				<div class="container">
					<div class="row">
						<?php include "includes-new/left-menu.php" ?>
						<div class="col-xl-9 col-lg-8 m-b30">
							<div class="job-bx job-profile">
								<div class="job-bx-title clearfix">
									<h5 class="font-weight-700 pull-left text-uppercase">Change Password</h5>
									
								</div>
								<?php if(isset($_REQUEST['succ'])) { ?>
									<p align="center" ><b style="color:#006633;">
									Password has been Changed Successfully !!!
									</b></p>
									<?php } ?>
								<form action="" method="post" onClick="return changepass();">
									<div class="row m-b30">
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Current Password:</label>
												<input type="password" name="current_pass" id="current_pass" required="true" class="form-control"/>
												<input type="hidden" name="cur_pass" id="cur_pass" value="<?php echo  $userdetail['user_password']; ?>" />
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>New Password:</label>
												<input type="password" name="new_pass" id="new_pass" required="true" class="form-control"/>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Confirm Password:</label>
												<input type="password" name="con_new_pass" id="con_new_pass" required="true" class="form-control"/>
											</div>
										</div>
										
									</div>
									
									 <div class="col-lg-12 col-md-12 text-center">
										<button type="submit" name="submit" class="site-button m-b30">Change Password</button>
									 </div>
									</div>
									
								</form>
							</div>    
						</div>
					</div>
				</div>
			</div>

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>
<script>

$(document).ready(function(){
    function checkTreeCollaps() {
    $(".tree-container li.tree-li").removeClass("is-child")
        $(".tree-container li.tree-li").each(function () {
            if ($(this).find("ul.tree-ul li").length > 0) {
                $(this).addClass("is-child")
            }
        });

    $(".tree-container li.tree-li span.text").unbind("click");
        $(".tree-container li.tree-li.is-child span.text").click(function () {
            $(this).parent(".tree-li").toggleClass("diactive");
            $(this).parent(".tree-li").find(".tree-ul:first").toggleClass("diactive");
        });
}

checkTreeCollaps()

});</script>