<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
echo "<script>window.location='index.php';</script>";
}

$menu6='class="active"';

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);
$act=$db->insertrec("update mlm_register set user_status ='1' where user_id ='$id'");

if($act)
{

header("location:user.php?inactsucc");
echo "<script>window.location='user.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['actt'])){

$profile=addslashes($_REQUEST['profile']);

$act=$db->insertrec("update mlm_mempayments set status='Completed' where profileid='$profile'");
$upd=$db->insertrec("update mlm_register set user_paymentstaus='1' where user_profileid='$profile'");
$UserInfo=$db->singlerec("select profileid,amount from mlm_mempayments where profileid='$profile'");
//echo "update mlm_mempayments set status='Completed' where profileid='$profile'";exit;
//Referral Bonus
$ret=$com_obj->refBonus($UserInfo['profileid'], $UserInfo['amount']);

//level completion bonus
$levlbonus=$com_obj->lvl_commission($UserInfo['profileid']);

//Pair capping bonus
include "../pairing-capping.php";
pairing_carry($UserInfo['profileid']);

//rank updation
updateRank($rank_type);
if($act)
{
header("location:user.php?sus");

echo "<script>window.location='user.php?sus';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$act=$db->insertrec("update mlm_register set user_status ='0' where user_id ='$id'");

if($act)
{

header("location:user.php?actsucc");

echo "<script>window.location='user.php?actsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_register where user_id ='$id'");

if($det)
{

header("location:user.php?del");

echo "<script>window.location='user.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
$checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){
if($checkbox[$i]){
$del_id = $checkbox[$i];

$sql = "delete from mlm_register where user_id='$del_id'";
$result = $db->insertrec($sql);
}
}
if($result){?> <script>
window.location="user.php?del";
</script> <?php
}
}

if(isset($_POST['mul_active']))
{
$checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_register set user_status='0' where user_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="user.php?inactsucc";
</script> <?php
}
}


if(isset($_POST['mul_inactive']))
{
$checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_register set user_status='1' where user_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="user.php?actsucc";
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
			<li class="active">Users</li>
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
						User Added Successfully !!!
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
						Stock Added Successfully !!!
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
						User Updated Successfully !!!
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
						User Deleted Successfully !!!
					</strong>
			
				</div>
			   
			   <?php }
			   
			   ?>
			   
			      <?php 
			   
			   if(isset($_REQUEST['actsucc']))
			   {
			  ?> 
			  
			<div class="alert alert-block alert-success">
					<button type="button" class="close" data-dismiss="alert">
						<i class="icon-remove"></i>
					</button>

				 <i class="icon-ok green"></i>
					<strong class="green">
						User Unblocked Successfully !!!
					</strong>
			
				</div>
			   
			   <?php }
			   
			   ?>
			   
			      <?php 
			   
			   if(isset($_REQUEST['inactsucc']))
			   {
			  ?> 
			  
			   <div class="alert alert-block alert-error">
					<button type="button" class="close" data-dismiss="alert">
						<i class="icon-remove"></i>
					</button>

				 <i class="icon-off red"></i>
					<strong class="red">
						User blocked Successfully !!!
					</strong>
			
				</div>
			   
			   <?php }
			   
			   ?>
			   <?php 
			   
			   if(isset($_REQUEST['sus']))
			   {
			  ?> 
			  
			  	<div class="alert alert-block alert-success">
					<button type="button" class="close" data-dismiss="alert">
						<i class="icon-remove"></i>
					</button>

				 <i class="icon-ok green"></i>
					<strong class="green">
						Pay status activated successfully
					</strong>
			
				</div>
			   
			   <?php }
			   
			   ?>
			   
               <form action="" method="post">
				<div class="row-fluid">
					
					<div class="table-header">
					User Management
					
					<span style="float:right; padding-right:5px;"><a href="add_user1.php" style="color:#FFFFFF;">+ ADD Users</a></span>
					<span style="float:right; padding-right:5px;"><a href="user_export.php?dnlne=<?php echo isset($_REQUEST['dnlne'])?$_REQUEST['dnlne']:''; ?>&search=search" style="text-decoration:none; color:#fff;">Export Report</a></span>
					
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
								
								<th width="58">Image</th>
								
									<th width="111">Full Name</th>
									
								 <th width="131">Profile Id</th>
								  <th width="80">Rank</th>
								<th width="64" >Date</th>
							<th width="86" >Renewal Status</th>
							<th width="86" >Pay type</th>
							<th width="86" >Pay Slip</th>
							<th width="86" >Pay Status</th>
							<th width="60" >Tree View</th>
							
								<th width="111" class="hidden-480">Status</th>
                               
							</tr>
						</thead>

						<tbody>
						
						<?php
						$i=1;
						$que="";
						if(isset($_REQUEST['dnlne'])) {
							$que.=" and user_sponserid='$dnlne'";
						}
						$usrr=$db->get_all("select * from mlm_register where user_id!='1' $que order by user_id desc");
						foreach($usrr as $row_usrr) {
						$ismemExpired=$ext_obj->ismemExpired($row_usrr['user_profileid']);
						
		$memInfo=$db->singlerec("select * from mlm_mempayments where profileid='$row_usrr[user_profileid]'");
						?>
							<tr>
								<td class="center">
									<label>
										<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_usrr['user_id']; ?>"  />
										<span class="lbl"></span>
									</label>
								</td>
								<td><?php echo $i; ?></td>
								<?php
								if(file_exists("../uploads/profile_image/mid/".$row_usrr['user_image']) && $row_usrr['user_image']!='')
								{
									
									$profileproof_image="../uploads/profile_image/mid/".$row_usrr['user_image'];
								}
								else
								{
									
									$profileproof_image="images/nouser.png";
								}
								if(!empty($memInfo['pay_type'])) {
									$pay_type = $memInfo['pay_type'];
								}
								else {
									$pay_type = 'E-pin Purchase';
								}
								?>
								<td>
								<img src="<?php echo $profileproof_image; ?>" width="50" height="50"/>
								</td>
								<td><a href="user.php?dnlne=<?php echo $row_usrr['user_profileid']; ?>"><?php echo $row_usrr['user_fname']." ".$row_usrr['user_lname']; ?></a></td>
						        <td><?php echo $row_usrr['user_profileid']; ?></td>
								<td><?=$row_usrr['user_rank'];?></td>
								<td><?php echo date("d-m-Y",strtotime($row_usrr['user_date'])); ?></td>
								<td><?php if(!$ismemExpired) echo "<span class='label label-info arrowed-in-right arrowed'>Renewed</span>"; else echo "<span class='label label-info arrowed-in-right arrowed'>Not Renewed</span>"; ?></td>
								 <td><?php echo $pay_type; ?></td>
								 <?php if($memInfo['pay_type'] == "Offline"){ ?>
								 <td>
								 <?php 
								 $payslip = $memInfo['user_payslip'];
								 if(!empty($payslip) && file_exists("../uploads/payslip/$payslip")) {?>
								 <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?=$memInfo['id']; ?>"><img src="../uploads/payslip/<?php echo $memInfo['user_payslip']; ?>" width="50px" height="50" style="vertical-align:middle;"/></a>
								 <? } ?>
								 </td>
								 <?php } else{?>
								 <td>--</td><?php }?>
								  <td> <?php if($memInfo['status']=='Completed') { ?>
									<a class="green" >
										<i class="icon-certificate bigger-130" title="click to deactivate"></i>
									</a>
									<?php } else { ?>
										<a class="red" href="user.php?actt=<?php echo $row_usrr['user_id']; ?>&profile=<? echo $row_usrr['user_profileid']?>" onclick="if(confirm('Are you sure to approve this?')) { return true; } else { return false; }">
											<i class="icon-certificate bigger-130" title="click to activate"></i>
										</a>
									<?php } ?></td>
									
								<td> 
								<span><a href="binary.php?uid=<?php echo $row_usrr['user_profileid'] ?>"><img src="images/binary.jpg" width="30" height="30" title="Binary Tree"/></a></span>
								</td>
								<td class="td-actions" align="center">
							
									<div class="hidden-phone visible-desktop action-buttons">
									<span>	
										<a href="view_detail.php?detail=<?php echo $row_usrr['user_id'];?>" >
										<img src="images/view_icon.gif" style="vertical-align:top; margin-top:2px;"/>
										
										</a></span>
										<?php if($row_usrr['user_status']=='1') { ?>
										
										<a class="red" href="user.php?inact=<?php echo $row_usrr['user_id'];?>" onclick="if(confirm('Are you sure to change the status')) { return true; } else { return false; }">
											<i class="icon-certificate bigger-130" title="click to activate"></i>
										</a>
										
										<?php } if($row_usrr['user_status']=='0') { ?>
									
									<a class="green" href="user.php?act=<?php echo $row_usrr['user_id']; ?>&profile=<? echo $row_usrr['user_profileid']?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
											<i class="icon-certificate bigger-130" title="click to deactivate"></i>
									  </a>
									  
									  <?php } ?>
									  
                             
									<a class="blue" href="user_edit.php?edit=<?php echo $row_usrr['user_id'];?>">
											<i class="icon-pencil bigger-130" title="click to edit"></i>
									  </a>
									 <?php if($demomode=='true'){?>
									   <a class="grey" onclick="demo()">
											<i class="icon-trash bigger-130" title="click to delete"></i>
										</a>
										<?}else{?>
										<a class="grey" href="user.php?delete=<?php echo $row_usrr['user_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
											<i class="icon-trash bigger-130" title="click to delete"></i>
										</a><?}?>
									</div>
									 
									</td>
							</tr>
				<div class="modal fade" id="myModal<?=$memInfo['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Pay Slip</h4>
					  </div>
					  <div class="modal-body">
					  
						<img  src="../uploads/payslip/<?php echo $memInfo['user_payslip']; ?>" class="img-responsive">
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
					  </div>
					</div>
				  </div>
				</div>	

						<?php $i++; }?>
									
					  </tbody>
				  </table>
			  </div>
					</div>

				<div class="modal-footer">
					<?php if($demomode=='true'){?>
								<input type="button" value="Delete" onclick="demo()" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								<?}else{?>
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								<?}?>
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="click to deactivate"/>
					</form>
					
					<?php
					$dn=isset($_REQUEST['dnlne'])?$_REQUEST['dnlne']:'';
					$qu="";
					if(isset($dn) && !empty($dn)){
						$qu.=" where user_sponserid='$dn'";
					}else{
						$qu.="";
					}
					$header = array("user_fname","user_email","user_profileid","user_date");
					$ext_obj->pdfExportbtn($header, "mlm_register","$qu");
					?>
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
      null, null, null, null,null,null,null,null,null,null,
	  { "bSortable": false },{ "bSortable": false }
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
