<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu6='class="active"';

if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=$db->insertrec("update mlm_staff set active_status ='0' where staff_id ='$id'");

if($act)
{

header("location:staff.php?actsucc");

echo "<script>window.location='staff.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=$db->insertrec("update mlm_staff set active_status ='1' where staff_id ='$id'");

if($act)
{

header("location:staff.php?inactsucc");

echo "<script>window.location='staff.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=$db->insertrec("delete from mlm_staff where staff_id ='$id'");

if($det)
{

header("location:staff.php?del");

echo "<script>window.location='staff.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_staff where admin_id='$del_id'";
$result = $db->insertrec($sql);

}

if($result){?> <script>
window.location="staff.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_staff set active_status='1' where staff_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="staff.php?inactsucc";
</script> <?php
}
 }
 
 

if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_staff set active_status='0' where staff_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="staff.php?actsucc";
</script> <?php
}
}

?>
  		<script>
	function muldel()
	{
	//alert("df");
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
    return true;
	
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
						<li class="active">Staff</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							<?php 
						   
						   if(isset($_REQUEST['success']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Menu Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   <?php 
						   
						   if(isset($_REQUEST['suss']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Staff Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
							
							 <?php 
						   
						   if(isset($_REQUEST['upsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Staff Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['del']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
									Staff Deleted Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						    <?php 
						   
						   if(isset($_REQUEST['errr']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Staff alredy added !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['inactsucc']))
						   {
						  ?> 
						  
						<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Staff Unblocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						   <?php 
						   
						   if(isset($_REQUEST['err']))
						   {
						  ?> 
						  
						<div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									File already exists !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['actsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Staff blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Staff Management
								
								
								<span style="float:right; padding-right:5px;"><a href="add_staff.php?page=staff&upd=1" style="color:#FFFFFF;">+ ADD Staff</a></span>
		
								
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
											<th width="48">Sl.No</th>
											
											<!--<th width="58">Menu Icon</th>-->
											
												<th width="111">Staff Name</th>
											<th width="64" >Staff Email</th>	
											 <th width="80">Status</th>
										<!--<th width="64" >Staff</th>
											<th width="50" >Indirect Refferal</th>-->
											<th width="120" class="hidden-480">Action</th>
                                           
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$usrr=$db->get_all("select * from mlm_staff order by staff_id desc");
									$i=1;
									
									foreach($usrr as $row_usrr)
									{
									$st=$row_usrr['active_status'];
									if($st==1){
										$act="Active";
									}else{
										$act="In-Active";
									}
									
									?>
						
										<tr>
									
											<td class="center">
												<label>
											<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_usrr['staff_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td class="center">
												<?php echo $i; ?>
											</td>
											
											<!--<?php
											
								if(file_exists("../uploads/profile_image/mid/".$row_usrr['menu_img']) && $row_usrr['menu_img']!='')
								{
									
									$profileproof_image="../uploads/profile_image/mid/".$row_usrr['menu_img'];
								}
								else
								{
									
									$profileproof_image="images/nouser.png";
								}
							
											
											 ?>
											
											
											<td>
											
											<img src="<?php echo $profileproof_image; ?>" style="width:50px; height:50px;"/>
											</td>-->
											
											<td><?php echo $row_usrr['staff_username']; ?></td>
											
				
											 <td class="center"><?php echo $row_usrr['staff_email']; ?></td>
											 
											 <td><?php echo $act; ?></td>
											 
										<!--<td class="center"><?php echo 0; ?></td>	-->
                                             							 
											<td class="td-actions" align="center">
										
												<div class="hidden-phone visible-desktop action-buttons">
												<span>	
													<!--<a href="view_detail.php?detail=<?php echo $row_usrr['staff_id'];?>" >
													<img src="images/view_icon.gif" title="View Profile" style="vertical-align:top; margin-top:2px;"/>-->
													
													</a></span>
                                                  <!--  <a href="sun_tree.php?ussserid=<?php echo $row_usrr['user_profileid'];  ?>"><img src="images/binary.png" style=" width:20px;"  title="Refferal View" alt="view"/></a>-->
													<?php 
											if($row_usrr['staff_id']!='0')
											{		
													if($row_usrr['active_status']=='0') { ?>
													
													<a class="red" href="staff.php?inact=<?php echo $row_usrr['staff_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_usrr['active_status']=='1') { ?>
												
												<a class="green" href="staff.php?act=<?php echo $row_usrr['staff_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                         		
												<a class="blue" href="add_staff.php?page=staff&upd=2&id=<?php echo $row_usrr['staff_id'];?>">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												 <?php if($demomode=='true'){?>
								                 <a class="grey" onclick="demo()">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
                                                <?}else{?>
														
													<a class="grey" href="staff.php?delete=<?php echo $row_usrr['staff_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a> <?}?>
												<?php } ?>		
									
                                    			
												  </div>
												 
												</td>
											
										
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>
								
								  	<div class="modal-footer">
								<?php if($demomode=='true'){?>
								<input type="button" value="Delete" onclick="demo()" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								<?}else{?>
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left" title="click to delete" />
								<?}?>
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left" title="click to deactivate"/>
								
							
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
			      null,  { "bSortable": false },null, { "bSortable": false },
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
