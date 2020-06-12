<?php include "includes-new/header.php";
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
		$upload=$com_obj->upload_image("pimage",$uniq,200,200,"uploads/profile_image/","");
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
		<!-- Page Conttent -->
	<main class="page-content">
	  
	  <div class="section-full bg-white section-padding-xs browse-job p-t50 p-b20">
				<div class="container">
					<div class="row">
						<?php include "includes-new/left-menu.php" ?>
						<div class="col-xl-9 col-lg-8 m-b30">
							<div class="job-bx job-profile">
								<div class="job-bx-title clearfix">
									<h5 class="font-weight-700 pull-left text-uppercase">Change Picture</h5>
									
								</div>
								<?php if(isset($_REQUEST['succ'])) { ?>
									<p><b style="color:#006633;">
									Photo uploaded Successfully !!!
									</b></p>
									<?php } ?>
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
						}?>
								<form action="" method="post" onClick="return changephoto();" enctype="multipart/form-data">
									<div class="row m-b30">
										<div class="col-lg-12 col-md-12 text-center">
											<div class="form-group">
												<a href="javascript:void(0);">
												<img class="img-circle" alt="" src="<?=$profileimages?>">
												
											</a>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 text-center">
											<div class="form-group" style="padding-left:200px;">
												<input type="file" name="pimage" id="pimage" required="true" class="form-comtrol"/>
											</div>
											
										</div>
										
									</div>
									
									 <div class="col-lg-12 col-md-12 text-center">
										<button type="submit" name="submit" class="btn btn-primary  m-b30">SAVE</button>
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