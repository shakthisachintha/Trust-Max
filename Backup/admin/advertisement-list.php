<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
	header("location:index.php");
}
$menumemsss='class="active"';

if(isset($_REQUEST['delete'])) {
	$id = addslashes($_REQUEST['delete']);
	$getimg = $db->singlerec("select ad_img from mlm_advertise where id='$id'");
	$img = $getimg['ad_img'];
	if(!empty($img) && file_exists("../uploads/advertisement/$img")) {
		unlink("../uploads/advertisement/$img");
	}
	$db->insertrec("delete from mlm_advertise where id='$id'");

	header("location:advertisement-list.php?del");
	echo "<script>window.location='advertisement-list.php?del';</script>";
	exit;
}

if(isset($_REQUEST['act']))
{
    $idv = addslashes($_REQUEST['act']);

	$db->insertrec("update mlm_advertise set ad_status='1' where id='$idv'");
	header("location:advertisement-list.php?act_suc");
	echo "<script>window.location='advertisement-list.php?act_suc';</script>";
	exit;
}
if(isset($_REQUEST['inact']))
{
    $idv = addslashes($_REQUEST['inact']);

	$db->insertrec("update mlm_advertise set ad_status='0' where id='$idv'");
	header("location:advertisement-list.php?dact_suc");
	echo "<script>window.location='advertisement-list.php?dact_suc';</script>";
	exit;
}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

	for($i=0;$i<count($checkbox);$i++){
		$del_id = $checkbox[$i];
		$getimg = $db->singlerec("select ad_img from mlm_advertise where id='$del_id'");
		$img = $getimg['ad_img'];
		if(!empty($img) && file_exists("../uploads/advertisement/$img")) {
			unlink("../uploads/advertisement/$img");
		}
		$db->insertrec("delete from mlm_advertise where id='$del_id'");
	}

	header("location:advertisement-list.php?del");
	echo "<script>window.location='advertisement-list.php?del';</script>";
	exit;
}

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

	for($i=0;$i<count($checkbox);$i++){
		$act_id = $checkbox[$i];
		$db->insertrec("update mlm_advertise set ad_status='1' where id='$act_id'");
	}
	header("location:advertisement-list.php?act_suc");
	echo "<script>window.location='advertisement-list.php?act_suc';</script>";
	exit;
}


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];
	for($i=0;$i<count($checkbox);$i++){
		$dact_id = $checkbox[$i];
		$db->insertrec("update mlm_advertise set ad_status='0' where id='$dact_id'");
	}
	header("location:advertisement-list.php?dact_suc");
	echo "<script>window.location='advertisement-list.php?dact_suc';</script>";
	exit;
}
?>
 <style type="text/css">
		.black_overlay{
			display:none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 200%;
			background-color: black;			
			z-index:1001;
			-moz-opacity: 0.7;
			opacity:.570;
			filter: alpha(opacity=70);
		}
		.white_content {
		display:none;
			position: absolute;
			top: 15%;
			left: 25%;
			width: 50%;
			height:75%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>


<script>
function mulchk()
{
	var chks = document.getElementsByName('chkval[]');
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++) {
		if (chks[i].checked) {
			hasChecked = true;
			break;
		}
	}
	if (hasChecked == false) {
		alert("Please select at least one.");
		return false;
	}
	else {
		return confirm("Are you sure to proceed?");
	}
}
</script>
	
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
						<li class="active">Advertisement Management </li>
					</ul><!--.breadcrumb-->

					<!--#nav-search-->
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
                           <?php  if(isset($_REQUEST['suc'])) { ?>
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Successfully Added!!!
								</strong>
							</div>
						   <?php }  if(isset($_REQUEST['updsuc'])) { ?>
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Successfully Updated!!!
								</strong>
							</div>
						   <?php } if(isset($_REQUEST['act_suc'])) { ?>
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Successfully Activated!!!
								</strong>
							</div>
							<?php } if(isset($_REQUEST['dact_suc'])) { ?>
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Successfully Dectivated!!!
								</strong>
							</div>
						    <?php } if(isset($_REQUEST['del'])) { ?>
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-trash red"></i>
								<strong class="red">
									Deleted Successfully !!!
								</strong>
							</div>
						   <?php } ?>
						       
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Advertisement Management
								<span style="float:right; padding-right:5px;"><a href="advertisement-add.php" style="color:#FFFFFF;">+ ADD Advertisement</a></span>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="24" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
											</th>
											<th width="20">Sl.No</th>
											<th width="40">Image</th>
                                            <th width="80">Location</th>
											<th width="20">Dimension</th>
											<th width="80">Link</th>
											<th width="20">Views</th>
											<th width="20" class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									
									<?php
									$getdets = $db->get_all("select * from mlm_advertise order by id desc");
									$i=1;
									foreach($getdets as $getdet) {
										$img = $getdet['ad_img'];
										if(!empty($img) && file_exists("../uploads/advertisement/$img")) {
											$img_src = "../uploads/advertisement/$img";
										}
										else {
											$img_src = "../uploads/no_image.png";
										}
									?>
										<tr>
											<td class="center">
												<label>
													<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $getdet['id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>
											<td><?php echo $i; ?></td>
											<td><img src="<?php echo $img_src; ?>" /></td>
                                            <td><?php echo $getdet['ad_location']; ?></td>
											<td><?php echo $getdet['ad_dimension']; ?></td>
											<td><?php echo $getdet['ad_link']; ?></td>
											<td><?php echo $getdet['ad_view_count']; ?></td>
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
												<?php if($getdet['ad_status'] == 0) {?>	
													<a class="red" href="advertisement-list.php?act=<?php echo $getdet['id'];?>" onclick="return confirm('Are you sure to Activate?')">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
												<?php } else {?>		
													<a class="green" href="advertisement-list.php?inact=<?php echo $getdet['id']; ?>" onclick="return confirm('Are you sure to Deactivate?')">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
													</a>
												<?php } ?>
													<a class="blue" href="advertisement-upd.php?edit=<?php echo $getdet['id'];?>">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
													</a>
													<?php if($demomode=='true'){?>
												   <a class="grey" onclick="demo()">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
													<?}else{?>
													<a class="grey" href="advertisement-list.php?delete=<?php echo $getdet['id'];?>" onclick="if(confirm('Are you sure to delete')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a><?}?>
												  </div>
												</td>
										     </tr>
									<?php $i++; } ?>
												
								  </tbody>
							  </table>
						  </div>
								</div>

								<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return mulchk();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return mulchk();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return mulchk();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="click to deactivate"/>
							
								</div>
								</form>
							</div><!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-class="default" value="#438EB9" />#438EB9
									<option data-class="skin-1" value="#222A2D" />#222A2D
									<option data-class="skin-2" value="#C6487E" />#C6487E
									<option data-class="skin-3" value="#D0D0D0" />#D0D0D0
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

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

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,null, null,null,null,null,{ "bSortable": false }
				  
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
			
	function view_limit(val)
	{	
		if(val==1)
		{
			document.getElementById('ref_limit').style.display="block";
		}
		else
		{		
			document.getElementById('ref_limit').style.display="none";
		}
	}
	</script>
    <!--<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>-->
   
	</body>
</html>
