<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}
$id=stripslashes(isset($id));
$menu5='class="active"';
$ad=$db->singlerec("SELECT * FROM mlm_admin WHERE admin_status='0'");
$ad_name=$ad['admin_username'];

if(isset($_REQUEST['submit']))
{
$name=stripslashes($_REQUEST['name']);
$file=stripslashes($_REQUEST['file']);
$micon=stripslashes($_REQUEST['micon']);
$date=date("Y-m-d H:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
$page=$_REQUEST['page'];

	if($upd==1){
		$chk=$db->singlerec("select * from main_menu where active_status='1'");
		$chkfile=$chk['menu_file'];
		if($chkfile==$file){
			header("Location:$page.php?err");
			echo "<script>location.href='$page.php?err'</script>";
			exit;
		}else if(!empty($file)){
		$date=date("Y-m-d H:i:s");
		$s=$db->insertrec("insert into main_menu (menu_name,menu_file,menu_icon,active_status,usercreate,param,crcdt) values('$name','$file','$micon','1','$ad_name','0','$date')");
		$act="add";
		}else{
		$s=$db->insertrec("insert into main_menu (menu_name,menu_icon,active_status,usercreate,param,crcdt) values('$name','$micon','1','$ad_name','0','$date')");
		}
	}else if($upd==2){
		$time=time();
		
		$u=$db->insertrec("UPDATE main_menu SET menu_name='$name', menu_file='$file', userchange='$ad_name', chngdt='$time' where menu_id='$id'");
		$act="upd";
	}
	header("Location:$page.php?suss");
	echo "<script>location.href='$page.php?suss'</script>";
	exit;

}

if($upd == 1){
	$TextChange = "Add";
	
}
else if($upd == 2)
	$TextChange = "Edit";

$ed=$db->singlerec("select * from main_menu where menu_id='$id'");
$name = stripslashes($ed['menu_name']);
$icon = stripslashes($ed['menu_icon']);
$file = stripslashes($ed['menu_file']);
$param_icon = stripslashes($ed['param']);

?>


		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li class="active">Add Menu</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							ADD Menu Management 
							
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" method="post" action="" enctype="multipart/form-data" />

								<div class="control-group">
									<label class="control-label" for="form-field-1">Name<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="name" value="<?php echo $name; ?>" id="name" required />
									</div>
								</div>
								<?php if($param_icon==0){ ?>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Menu Icon<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" value="<?php echo $icon; ?>" name="micon" id="micon"  />
									</div>
								</div>
								<?php } ?>
								<?php if($file!=""){ ?>
								<div class="control-group">
									<label class="control-label" for="form-field-1">File<span style="color:#FF0000;"></span> : </label>

									<div class="controls">
										<input type="text" name="file" value="<?php echo $file; ?>" id="file" />
									</div>
								</div>
								<?php } ?>
								
								<input type="hidden" name="product" value="<?php echo isset($_REQUEST['add'])?$_REQUEST['add']:'' ?>" />
								<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:''; ?>" />
								<div class="form-actions">
								<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
								<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>
							</form>

							<div class="hr hr-18 dotted hr-double"></div>

					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

	</body>
</html>
