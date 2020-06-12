<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu5='class="active"';

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);

$act=$db->insertrec("update mlm_wastage set waste_status='1' where waste_id ='$id'");

if($act)
{

header("location:wastage.php?actsucc");

echo "<script>window.location='wastage.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$act=$db->insertrec("update mlm_wastage set waste_status='0' where waste_id ='$id'");

if($act)
{

header("location:wastage.php?inactsucc");

echo "<script>window.location='wastage.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_wastage where waste_id ='$id'");

if($det)
{

header("location:wastage.php?del");

echo "<script>window.location='wastage.php?del';</script>";

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
						<li class="active">Wastage List</li>
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->

							<div class="row-fluid">
								
								<div class="table-header">
								Wastage Management
								
								<span style="float:right; padding-right:5px;"><a href="add_wastage.php?" style="color:#FFFFFF;">+ ADD Wastage</a></span>
								
								</div>
 
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
									
											<th width="54">Sl.No</th>
									
									<th width="114">Product Name</th>
												
												<th width="131">Wastage Count</th>
												<th width="126">Reason</th>
										<th width="131">Poster</th>
											<th width="59" >Date</th>
										<th width="97" >IP</th>
											<!--<th width="103" class="hidden-480">Status</th>-->
                                           
											
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
								
									$was=$db->get_all("select * from mlm_wastage order by waste_id desc");
									
									$i=1;
									$num=$db->numrows("select * from mlm_wastage");
									
									foreach($was as $row_was)
									{
										$pro=$db->singlerec("select * from mlm_products where pro_id='$row_was[waste_proid]'");
									?>
									
										<tr>
								
											<td>
												<?php echo $i; ?>
											</td>
											<td>
											
											<?php echo $pro['pro_name']; ?>
											</td>
											<td><span class="label label-info arrowed-in-right arrowed"><?php echo $row_was['waste_count']; ?></span></td>
											<td><?php echo $row_was['waste_reason']; ?></td>
											<td><?php echo $row_was['waste_poster']; ?></td>
									        
											 <td><?php echo date("d-m-Y",strtotime($row_was['waste_date'])); ?></td>
                                             
											  <td><?php echo $row_was['waste_ip']; ?></td>
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>

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
			      null, null,null, null, null,
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

	</body>
</html>
