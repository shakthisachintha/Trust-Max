<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu5='class="active"';
$ad=$db->singlerec("SELECT * FROM mlm_admin WHERE admin_status='0'");
$ad_name=$ad['admin_username'];

if(isset($_REQUEST['submit']))
{
$name=stripslashes($_REQUEST['name']);
$m=stripslashes($_REQUEST['menu']);
$file=stripslashes($_REQUEST['file']);
$date=date("Y-m-d H:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
$page=$_REQUEST['page'];

	if($upd==1){
		$date=date("Y-m-d H:i:s");
		$s=$db->insertrec("insert into main_menu (menu_name,menu_file,active_status,usercreate,param,m_param,crcdt) values('$name','$file','1','$ad_name','1','$m','$date')");
		$up=$db->insertrec("UPDATE main_menu SET sub_status='1' where menu_id='$m'");
		$act="add";
	}else if($upd==2){
		$time=time();
		$u=$db->insertrec("UPDATE main_menu SET menu_name='$name', userchange='$ad_name', chngdt='$time' where menu_id='$id'");
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

$name = isset($_REQUEST['name'])?stripslashes($_REQUEST['name']):'';
$sid=$_REQUEST['sid'];
$ed=$db->singlerec("select * from main_menu where menu_id='$sid'");
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

						<li class="active">Add Sub Menu</li>
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
							
							<?php if((isset($_REQUEST['page'])) && ($_REQUEST['page']=='menu')) { ?>
							
							<div class="control-group">
							<label class="control-label" for="form-field-1">Main Menu<span style="color:#FF0000;">*</span> : </label><div class="controls">
							<select name="menu" id="menu" onchange="document.getElementById('menu').value=this.options[this.options.selectedIndex].value;">
							
							<?php 
							if(!empty($sid)) {
								$concat_qry = "and menu_id='$sid'";
							}
							else {
								$concat_qry = '';
							}
							$ppp=$db->get_all("select * from main_menu where active_status='1' and param='0' $concat_qry");
							foreach($ppp as $rp)
							{ ?>
						
							<option name="menu" value="<?php echo $rp['menu_id']; ?>"><?php echo $rp['menu_name']; ?></option>
							
							<?php } ?>
							
							</select>
								
							</div>
						</div>
							<?php }
							
							
							?>

								<div class="control-group">
									<label class="control-label" for="form-field-1">Name<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="name" value="<?php echo$name; ?>" id="name" required />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">File<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="file" value="<?php echo $file; ?>" id="file" />
									</div>
								</div>
								
								<input type="hidden" name="product" value="<?php echo isset($_REQUEST['add'])?$_REQUEST['add']:'' ?>" />
								<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:'' ?>" />
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
