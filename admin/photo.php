<?php 
include("admin/AMframe/config.php"); 

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{

	$imag=$_FILES['pimage']['tmp_name'];
	$imag=isset($imag)?$imag:'';
	$uniq=uniqid();
	if($imag!=''){
		$upload=$com_obj->upload_image("pimage",$uniq,300,300,"uploads/profile_image/","new");
		if($upload){
			$newimage=$com_obj->img_Name;
			$qry=$db->insertrec("update mlm_register set user_image='$newimage' where user_id='$_SESSION[userid]'");
			header("location:photo.php?update");
		}
		else{
			$imgerr=$com_obj->img_Err;
		}
	}
	else{
		$imgerr="Please upload your image";
	}

}

include("includes/head.php");

?>
<script language="javascript">
function changephoto()
{
	
	if(document.getElementById('pimage').value == "") // ----- check current password not null -----
	{
		//
	}
	else
	{
		var ss=document.getElementById('pimage').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('pimage').value="";
			  document.getElementById('pimage').focus();
			  return false;
		 }
	}

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
							<ul class="nav nav-pills">
                                <li role="presentation"><a href="editprofile.php" style="font-size: 20px;">Edit profile</a></li>
                                <li role="presentation"><a href="changepassprofile.php" style="font-size: 20px;">Change Password</a></li>
                                <li role="presentation"><a href="fullprofile.php" style="font-size: 20px;">< Back to profile</a></li>
                            </ul>
                            <br>
							<div class="well" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px;  margin-bottom: 7px;">Upload photo</h4>
								<div class="col-sm-12">
								
								
						<?php if(isset($update) && empty($imgerr) ){ ?>
							<div class="alert alert-success">
						  <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span> 
						  Image uploaded successfully
						</div>
						<?php }
						$imgerr=isset($imgerr)?$imgerr:'';
						if(!empty($imgerr)){
							
							?>
							<div class="alert alert-danger">
  <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span> 
  <?php echo $imgerr ?>
</div>
							<?php
						}
					?>
							<form action="" method="post" onClick="return changephoto();" enctype="multipart/form-data">
								<div class="table-responsive">
							   <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php if(isset($_REQUEST['succ'])) { ?>
									<tr>
									<td colspan="3" align="center" style="color:#006633; font-weight:bold;">
									Photo uploaded Successfully !!!
									</td>
									
									</tr>
									<?php } ?>
									
									<?php if(isset($_REQUEST['largeimage'])) { ?>
									<tr>
									<td colspan="3" align="center" style="color:#FF0000; font-weight:bold;">
									Image size too large..min upload size 1mb only !!!
									</td>
									
									</tr>
									<?php } ?>
									<tr>
										<td width="40%" align="right">
											<strong>Current Image</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
										<img src="<?=$profileimages?>" width="100" height="100" />
										</td>
									</tr>
									
									<tr>
										<td align="right">
											<strong>Upload Profile Image </strong>
										</td>
										<td align="center">:</td>
										<td>
											<input type="file" name="pimage" id="pimage" required="true"/>
										</td>
										
									</tr>
									<tr>
										<td align="center"><strong>[Instruction: Please upload .jpg , .png , .jpeg , .gif files only and image size less than 1mb, Image must be greater than or equal to 300 x 300 pixels]</strong></td>
									</tr>
									<tr>
									<td/><td/>
									</tr>
									
									<tr>
										<td colspan="3" align="center">
											<button type="submit" name="submit" class="greenbtn">SAVE</button>
										</td>
									</tr>
								</table>
								</div>
								</form>
							</div>
                        </div>
                    </div>
                    <br />
                </div>
				<?php include "includes/login-access-ads.php";?>
            </div>
		</div>	
			<?php include("includes/footer.php"); ?>
		
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>