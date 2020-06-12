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
$email=stripslashes($_REQUEST['email']);
$mn=stripslashes($_REQUEST['mn']);
$pass=stripslashes($_REQUEST['pass']);
$prod=stripslashes($_REQUEST['product']);
$date=date("Y-m-d H:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
$page=$_REQUEST['page'];
						
$checkbox = $_POST['chkval'];

$chk=implode(',',$checkbox);

	if($upd==1){
		$date=date("Y-m-d H:i:s");
		$em=$db->singlerec("select * from mlm_staff where staff_email='$email'");
			$m=$em['staff_email'];
			if($m==$email){
				header("Location:$page.php?errr");
				echo "<script>window.location='$page.php?errr';</script>";
			}else{
				$s=$db->insertrec("insert into mlm_staff (staff_username,staff_email,staff_password,staff_Mob,menu_permission,active_status,crcdt,ip) values('$name','$email','$pass','$mn','$chk','1','$date','$ip')");
				$act="add";
$to=$email; 				
$subject="Admin have added you as staff";

$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #D64B14; width:550px;'>
		<tr bgcolor='#D64B14' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login Details for ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email id : $to</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $pass</td>
						</tr>
					
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#D64B14;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$com_obj->commonMail($to,$subject,$msg);

				header("Location:$page.php?suss");
				echo "<script>location.href='$page.php?suss'</script>";
				exit;
			}
		
	}else if($upd==2){
		$time=time();
		$u=$db->insertrec("UPDATE mlm_staff SET staff_username='$name', staff_email='$email', staff_password='$pass', staff_password='$pass', staff_Mob='$mn', menu_permission='$chk'  where staff_id='$id'");
		$act="upd";
		header("Location:$page.php?suss");
		echo "<script>location.href='$page.php?suss'</script>";
		exit;
	}
	

}

if($upd == 1){
	$TextChange = "Add";
$name = '';
$email = '';
$mob = '';
$hasPermission=array();
}
else if($upd == 2){
	$TextChange = "Edit";
$ed=$db->singlerec("select * from mlm_staff where staff_id='$id'");
$name = stripslashes($ed['staff_username']);
$email = stripslashes($ed['staff_email']);
$mob = stripslashes($ed['staff_Mob']);
$menu=$ed['menu_permission'];
$hasPermission = explode(",",$menu);
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

						<li class="active">Add Staff</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							ADD Staff
							
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
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Email<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="email" value="<?php echo $email;?>" name="email" id="email"  />
									</div>
								</div>
								<?php if($upd==1){ ?>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Password<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="password" name="pass" id="pass"  />
									</div>
								</div>
								<?php } ?>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Mobile No<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="mn" value="<?php echo$mob; ?>" id="mn" />
									</div>
								</div>
								
								<?php if((isset($_REQUEST['page'])) && ($_REQUEST['page']=='staff')) { ?>
							
							<div class="control-group">
							<label class="control-label" for="form-field-1">Menus<span style="color:#FF0000;">*</span> : </label><div class="controls">
							
							<?php 
							$menus=$db->get_all("select * from main_menu where active_status='1' and param='0'");
							foreach($menus as $menuInfo){
							$menuid=$menuInfo['menu_id'];
							?>
							<td class="center">
								<label>
								
								<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $menuid; ?>" <?php if(in_array($menuid,$hasPermission)) {?> checked <?php } ?> >
									<span class="lbl"><?php echo $menuInfo['menu_name'];?></span>
							
								</label>
							</td>

								<?php } ?>
					
							</div>
						</div>
							<?php }	?>
							<p style="color:red;"><b>NOTE : Here Main menus only listed. If you are selected the main menu, under main menu all list are shown. <b></p>
							
								<input type="hidden" name="product" value="<?php echo isset($_REQUEST['add'])?$_REQUEST['add']:'' ?>" />
								<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:'' ?>" />
								<div class="form-actions">
<!--									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>
-->								<input type="submit" onclick="check()" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									

									&nbsp; &nbsp; &nbsp;
									<!--<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>-->
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>

								<!--/row-->


								<!--/row-->

							
								
							</form>

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

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

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, 
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
<script>

$('input[name="chkval"]:checked').each(function() {	
		$.ajax({
			 url: "staff_ajax.php?val="+val, 
			success: function(result){
			$("#staff_details").html(result);
		}
		});
	
});

function get_staff(val){
	
		$.ajax({
			 url: "staff_ajax.php?val="+val, 
			success: function(result){
			$("#staff_details").html(result);
		}
		});
	}

</script>	

	
	</body>
</html>
