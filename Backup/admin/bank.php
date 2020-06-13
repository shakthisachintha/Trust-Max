<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}
if(isset($_REQUEST['suss']))
{
	echo "<script>alert('Bank details Updated Successfully');</script>";
}

if(isset($_REQUEST['submit']))
{
$aname=stripslashes($_REQUEST['aname']);
$anumber=stripslashes($_REQUEST['anumber']);
$bname=stripslashes($_REQUEST['bname']);
$ifsc=stripslashes($_REQUEST['ifsc']);
$brname=stripslashes($_REQUEST['brname']);
$s=$db->insertrec("update mlm_bank set acc_name='$aname',acc_no='$anumber',bank_name='$bname',ifsc_code='$ifsc',branch_name='$brname' where id='1' ");
if($s)
{
header("Location:bank.php?suss");
echo "<script>location.href='bank.php?suss'</script>";
exit;
}
}
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

						<!--<li class="active">Add Menu</li>-->
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Admin Bank Details 
							
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
<?  $bank_detail=$db->singlerec("select * from mlm_bank where id='1' ") ?>
							<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

								<div class="control-group">
									<label class="control-label" for="form-field-1">Account Name<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="aname" value="<?php echo $bank_detail['acc_name']; ?>" id="name" required />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Account Number<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" value="<?php echo $bank_detail['acc_no']; ?>" name="anumber" id="micon"  />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Bank Name<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" value="<?php echo $bank_detail['bank_name']; ?>" name="bname" id="micon"  />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">IFSC Code<span style="color:#FF0000;"></span> : </label>

									<div class="controls">
										<input type="text" name="ifsc" value="<?php echo $bank_detail['ifsc_code']; ?>" id="file" />
									</div>
								</div>
								
								<div class="control-group">
								<label class="control-label" for="form-field-1">Branch Name<span style="color:#FF0000;"></span> : </label>

									<div class="controls">
										<input type="text" name="brname" value="<?php echo $bank_detail['branch_name']; ?>" id="file" />
									</div>
								</div>
								
								<input type="hidden" name="product" value="<?php echo isset($_REQUEST['add'])?$_REQUEST['add']:'' ?>" />
								<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:'' ?>" />
								<div class="form-actions">
								
								<?php if($demomode=='true'){?>
								<input type="button"  value="SUBMIT" onclick="demo()"
                                class="btn btn-info" style="font-weight:bold;" >
								<?}else{?>
                                 <input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
								<?}?>
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>
								
							</form>

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>	
		
		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
	</body>
</html>
