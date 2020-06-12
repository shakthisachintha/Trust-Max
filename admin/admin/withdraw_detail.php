<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu6='class="active"';

$detail=$db->singlerec("select * from mlm_withdrawrequsets,mlm_register where req_userid='$_REQUEST[user]' and user_id=req_userid $search2 order by req_id desc");

?>
<style>
.label.arrowed-in:before
{

padding:10px;
}
.label.arrowed-in-right:after
{
padding:10px;
}

</style>

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

						<li>
							<a href="user.php">Users</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">View User Details</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						WITHDRAW DETAIL
						
						</h1>
					</div><!--/.page-header-->

					
<div class="row-fluid">
									

						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							
								<div class="control-group">
								
								<div style="float:left; font-weight:bold; width:150px;" align="right" >First Name</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_fname']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
									
								</div>

								<div class="control-group">
								<div style="float:left; font-weight:bold; width:150px;" align="right" >Second Name</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_secondname']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>
                                
								<div class="control-group">
								<div style="float:left; font-weight:bold; width:150px;" align="right" >Last Name</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_lname']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>

								
									<div class="control-group">
									
									<div style="float:left; font-weight:bold; width:150px;" align="right" >Email</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_email']; ?></div>
									<div style="clear:both;">&nbsp;</div>								
									
								</div>	
							
</div>	
</div>
<div class="row-fluid">
					
					<div class="span12">
							<!--PAGE CONTENT BEGINS-->

								<div class="control-group">
									<div style="float:left; font-weight:bold; width:150px;" align="right" >Sponser Name</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_sponsername']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>

								<div class="control-group">
								<div style="float:left; font-weight:bold; width:150px;" align="right">Sponser id</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_sponserid']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								
								</div>

							<div class="control-group">
							<div style="float:left; font-weight:bold; width:150px;" align="right">Placement Id</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['user_placementid']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>
								
							<div class="control-group">
							<div style="float:left; font-weight:bold; width:150px;" align="right">Withdraw Balance</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php  echo $com_obj->withdrawBal($detail['user_profileid'])." ".$sitecurrency ; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>			
				
</div>
</div>

<div class="row-fluid">
											  
							
								<div class="form-actions">
				
										<a href="withdraw_report.php?" class="btn" style="font-weight:bold;">BACK</a>
									
								</div>

					
</div>
						  
					</div>

						
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

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/flot/jquery.flot.min.js"></script>
		<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
	
	</body>
</html>
