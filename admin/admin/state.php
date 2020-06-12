<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu8='class="active"';

if(isset($_REQUEST['submit']))
{
$state=addslashes($_REQUEST['state']);
$conid=addslashes($_REQUEST['conid']);

$sasdad=$db->insertrec("insert into mlm_state(`country_id`,`state_name`) values('$conid','$state')");

if($sasdad)
{

header("location:state.php?conn=$conid&succ");

echo "<script>window.location='state.php?conn=$conid&succ';</script>";

}

}

if(isset($_REQUEST['update']))
{

$sid=addslashes($_REQUEST['sid']);

$state=addslashes($_REQUEST['state']);

$cons=addslashes($_REQUEST['conid']);

$cou=$db->insertrec("update mlm_state set state_name='$state' where state_id='$sid'");

if($cou)
{

header("location:state.php?conn=$cons&upsucc");

echo "<script>window.location='state.php?conn=$cons&upsucc';</script>";

}

}

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);

$conid=addslashes($_REQUEST['coo']);

$act=$db->insertrec("update mlm_state set state_status='1' where state_id='$id'");

if($act)
{

header("location:state.php?conn=$conid&actsucc");

echo "<script>window.location='state.php?conn=$conid&actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$conid=addslashes($_REQUEST['coo']);

$act=$db->insertrec("update mlm_state set state_status='0' where state_id='$id'");

if($act)
{

header("location:state.php?conn=$conid&inactsucc");

echo "<script>window.location='state.php?conn=$conid&inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_state where state_id='$id'");

$conid=addslashes($_REQUEST['coo']);

if($det)
{

header("location:state.php?conn=$conid&del");

echo "<script>window.location='state.php?conn=$conid&del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];
	$conid=addslashes($_REQUEST['conn']);

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_state where state_id='$del_id'";
$result = $db->insertrec($sql);

}

if($result){?> <script>
window.location="state.php?conn=<?php echo $conid; ?>&del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];
    $conid=addslashes($_REQUEST['conn']);
for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_state set state_status='0' where state_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="state.php?conn=<?php echo $conid; ?>&inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];
	$conid=addslashes($_REQUEST['conn']);

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_state set state_status='1' where state_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="state.php?conn=<?php echo $conid; ?>&actsucc";
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
			top: 30%;
			left: 25%;
			width: 40%;
			height:30%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	
	<script>
	
	function cou_validate()
	{
	
	if(document.getElementById('state').value=="")
	{
	alert("Please Enter the state");
	document.getElementById('state').focus();
	return false;
	
	}
	
	}
	
	
	</script>
	
		<script>
	
	function cou_validate1()
	{
	
	if(document.getElementById('statey').value=="")
	{
	alert("Please Enter the state");
	document.getElementById('statey').focus();
	return false;
	
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
						<li class="active">
						
						<a href="country.php">Country</a>
						<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						
							<li class="active">State</li>
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							  <?php
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									State Added Successfully !!!
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
									State Updated Successfully !!!
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
									State Deleted Successfully !!!
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
									State Unblocked Successfully !!!
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
									State blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>

                        <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								State Management
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop('<?php echo $_REQUEST['conn']; ?>');" style="color:#FFFFFF;">+ ADD State</a></span>
								
								</div>

								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="23" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="37">Sl.No</th>
											
												<th width="194">State Name</th>
											
										<th width="15">City </th>
											<th width="15" class="hidden-480">Status</th>
                                            <th width="15" class="sorting_disabled" style="visibility:hidden"></th>
											<th width="15" class="sorting_disabled" style="visibility:hidden"></th>
											
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$staat=$db->get_all("select * from mlm_state where country_id='$_REQUEST[conn]' order by state_name asc");
									$i=1;
									$num=$db->numrows("select * from mlm_state where country_id='$_REQUEST[conn]'");
									
									foreach($staat as $row_staat)
									{
									
									$cityy=$db->numrows("select * from mlm_city where state_id='$row_staat[state_id]'");
									
									?>
									
										<tr>
									
											<td class="center">
												<label>
				<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_staat['state_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $row_staat['state_name']; ?></td>
											
					     <td><span class="label label-info arrowed-in-right arrowed">
					<a href="city.php?conn=<?php echo $row_staat['country_id'];?>&stta=<?php echo $row_staat['state_id'];?>" style="color:#FFFFFF;" ><?php echo $cityy; ?></a>
					</span></td>
										
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_staat['state_status']=='1') { ?>
													
													<a class="red" href="state.php?inact=<?php echo $row_staat['state_id'];?>&coo=<?php echo $row_staat['country_id']; ?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_staat['state_status']=='0') { ?>
												
												<a class="green" href="state.php?act=<?php echo $row_staat['state_id'];?>&coo=<?php echo $row_staat['country_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                                </div>
										 
												<div  class="hidden-phone visible-desktop action-buttons">
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_staat['country_id']; ?>','<?php echo $row_staat['state_id']; ?>','<?php echo $row_staat['state_name']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												  </div>
												
												<div class="hidden-phone visible-desktop action-buttons">
												<?php if($demomode=='true'){?>
								                 <a class="grey" onclick="demo()">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
                                                <?}else{?>

													<a class="grey" href="state.php?delete=<?php echo $row_staat['state_id'];?>&coo=<?php echo $_REQUEST['conn']; ?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a><?}?>
												  </div>
												</td>
											
								
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>
								
								<input type="hidden" name="conn" value="<?php echo $_REQUEST['conn']; ?>" />
								<div class="modal-footer">
								<?php if($demomode=='true'){?>
								<input type="button" value="Delete" onclick="demo()" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								<?}else{?>
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								<?}?>
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="click to deactivate"/>
							
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
		

 
 
    <div id="light"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return cou_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add State</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>State Name </td>
								<td> : </td>
								<td><input type="text" name="state" id="state" /></td>
								</tr>
								<input type="hidden" name="conid" id="conid" />
								
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop(val)
	{
		document.getElementById('conid').value=val;
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'; 
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop()
	{
	
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'; 
	}
	
	</script>
	
	
	 
    <div id="light1"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return cou_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit State</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>State Name </td>
								<td> : </td>
								<td><input type="text" name="state" id="statey" /></td>
								</tr>
								<input type="hidden" name="conid" id="conidd" />
								<input type="hidden" name="sid" id="sid" />
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop1();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade1" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop1(val,stas,name)
	{
	//alert(name);
	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('conidd').value=val;
	document.getElementById('sid').value=stas;
	document.getElementById('statey').value=name;
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop1()
	{
	
	document.getElementById('light1').style.display='none';
	document.getElementById('fade1').style.display='none'; 
	}
	
	</script>
	
	</body>
</html>
