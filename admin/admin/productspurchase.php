<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu4='class="active"';

if(isset($_REQUEST['actt'])){
	$id=addslashes($_REQUEST['actt']);
	$pro_id=addslashes($_REQUEST['pro_id']);
	
	$actt=$db->insertrec("update mlm_purchase set pay_payment='1' where pay_id='$id'");
	$actt=$db->insertrec("update mlm_mempayments set status='Completed' where profileid='$pro_id'");
	$trans=$db->singlerec("select * from mlm_purchase where pay_id='$id'");
			$pid=$trans['pay_product'];
			$qty=$trans['pay_qty'];
			$usr=$trans['pay_userid'];
			$repur=$trans['is_repurchase'];
			$reducestock=$db->insertrec("update mlm_products set pro_stock= pro_stock - '$qty' where pro_id='$pid'");
			productbonus($pid,$usr,$qty,$repur);
	if($actt){
		header("Location:productspurchase.php?actsuccc");
		echo "<script>location.href='productspurchase.php?actsuccc';</script>";
		exit;
	}
}

if(isset($_REQUEST['inactt'])){
	$id = addslashes($_REQUEST['inactt']);
	
	$inactt=$db->insertrec("update mlm_purchase set pay_payment='0' where pay_id='$id'");
	$actt=$db->insertrec("update mlm_mempayments set status='Pending' where profileid='$pro_id'");
	$trans=$db->singlerec("select * from mlm_purchase where pay_id='$id'");
			$pid=$trans['pay_product'];
			$qty=$trans['pay_qty'];
			$usr=$trans['pay_userid'];
			$repur=$trans['is_repurchase'];
			$reducestock=$db->insertrec("update mlm_products set pro_stock= pro_stock - '$qty' where pro_id='$pid'");
	if($inactt){
		header("Location:productspurchase.php?inactsuccc");
		echo "<script>location.href='productspurchase.php?inactsuccc';</script>";
		exit;
	}
}

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);

$act=$db->insertrec("update mlm_products set pro_status ='1' where pro_id ='$id'");

if($act)
{

header("location:products.php?actsucc");

echo "<script>window.location='products.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$act=$db->insertrec("update mlm_products set pro_status ='0' where pro_id ='$id'");

if($act)
{

header("location:products.php?inactsucc");

echo "<script>window.location='products.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_purchase where pay_id ='$id'");

if($det)
{

header("location:productspurchase.php?del");

echo "<script>window.location='productspurchase.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_purchase where pay_id='$del_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="productspurchase.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_products set pro_status='0' where pro_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="products.php?inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_products set pro_status='1' where pro_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="products.php?actsucc";
</script> <?php
}
 }

$date = date('Y-m-d',time()-(90*86400)); // 3 months ago
$sdate = date('Y-m-d',time()-(180*86400)); // 6 months ago
$ydate = date('Y-m-d',time()-(365*86400)); // 1 year ago

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
						<li class="active">Purchase</li>
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
									Purchase Added Successfully !!!
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
									Purchase Updated Successfully !!!
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
									Purchase Deleted Successfully !!!
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
									Purchase Unblocked Successfully !!!
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
									Purchase blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						    <?php 
						   
						   if(isset($_REQUEST['actsuccc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Product pay status activated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						    <?php 
						   
						   if(isset($_REQUEST['inactsuccc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Dispatch Cancelled Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
							<div class="row-fluid">
								
								<div class="table-header">
								Purchase Management
								
								<span style="float:right; padding-right:5px;"><a href="xlsexport.php?user=<?php echo isset($_REQUEST['user'])?$_REQUEST['user']:''; ?>&fromdate=<?php echo isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:''; ?>&todate=<?php echo isset($_REQUEST['todate'])?$_REQUEST['todate']:''; ?>&search=search" style="text-decoration:none; color:#fff;">Export Report</a></span>
								
								<!--<span style="float:right; padding-right:5px;"><a href="add_products.php" style="color:#FFFFFF;">+ ADD Products</a></span>-->
								
								</div>
								
	<?php
			$search="";
			$temp="";
	if(isset($_REQUEST["submit"]))
	{
		if(isset($_REQUEST["fromdate"]) && !empty($_REQUEST["fromdate"]) && isset($_REQUEST["todate"]) && !empty($_REQUEST["todate"]))
		{
			$FromDate= date("Y-m-d", strtotime($_REQUEST["fromdate"]));
			$ToDate= date("Y-m-d", strtotime($_REQUEST["todate"]));
			$search.=" mlm_purchase.pay_date BETWEEN '$FromDate' AND '$ToDate' and ";
			
		}else if($_REQUEST['user'] && !empty($_REQUEST['user'])){
			$em=stripslashes($_REQUEST['user']);
			$search.="mlm_purchase.pay_email like '%$em%' and";
		}
		else{
			$FromDate="";
			$ToDate="";
			$em="";
		}
		
	}
	else{
		$FromDate="";
		$ToDate="";
		$em="";
	}
	
	?>						
		<div class="date">					
			<form name="frmSearch" action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
				<input type="text" name="user" id="email" value="<?php echo isset($_REQUEST['user'])?$_REQUEST['user']:'';?>" autocomplete="off" placeholder="Email" />
				<input type="text" name="fromdate" value="<?php echo isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:''; ?>" id="datepicker_from"  autocomplete="off" placeholder="From date" />
				<input type="text" name="todate" id="datepicker_to" value="<?php echo isset($_REQUEST['todate'])?$_REQUEST['todate']:''; ?>" autocomplete="off" placeholder="To date" />	
				<input type="submit" class="button" name="submit" value="Search">
			
			</form>
		</div>
                        <form action="" method="post">
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="24" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="50">Sl.No</th>
											
											<th width="51">Transaction ID</th>
											
												<th width="126">Name</th>
											 <th width="80">Pay Email</th>
											
											<th width="64" >Pay Date</th>
											<th width="64" >Pay Type</th>
										<th width="80" >Pay Status</th>
											<th width="140" class="hidden-480">Status</th>
                                           
											
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$pro=$db->get_all("select * from mlm_purchase left join mlm_products on mlm_purchase.pay_product=mlm_products.pro_id inner join mlm_register on mlm_register.user_profileid=mlm_purchase.pay_userid where $search  mlm_purchase.pay_product=mlm_products.pro_id order by pay_id desc");
									$i=1;
									$num=$db->numrows("select * from mlm_purchase");
									
									foreach($pro as $row_pro)
									{
																	
									if($row_pro['pay_payment']==0){
										$msg="Pending";
									}else if($row_pro['pay_payment']==1){
										$msg="Success";
									}
									?>
									
										<tr>
									
											<td class="center">
												<label>
						<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_pro['pay_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $row_pro['randomkey']; ?></td>
											
											<td><?php echo $row_pro['user_fname']." ".$row_pro['user_lname'] ?></td>
											
									         <td><?php echo $row_pro['pay_email']; ?></td>
											 
											 <td><?php echo date("d-m-Y",strtotime($row_pro['pay_date'])); ?></td>
											 <td><?php echo $row_pro['pay_type'];?></td>
                                             
											 <td style="text-align:center;">
											 <?php if($row_pro['pay_payment']=='1') { ?>
													
													<a class="green"  >
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
													</a>
													
													<?php } if($row_pro['pay_payment']=='0') { ?>
												
												<a class="red" href="productspurchase.php?actt=<?php echo $row_pro['pay_id']; ?>&pro_id=<? echo $row_pro['pay_userid']?>" onclick="if(confirm('Are you sure to activate this?')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
												  </a>
												
												  
												  <?php } ?>
											 </td>
											 
											<td class="td-actions" align="center">
											 
											   
											
												<div class="hidden-phone visible-desktop action-buttons">
												
												<span>	
													<a href="view_prodetail.php?detail=<?php echo $row_pro['randomkey'];?>" >
													<img src="images/view_icon.gif" style="vertical-align:top; margin-top:2px;"/>
													
													</a></span>
													
													<?php if($row_pro['pro_status']=='1') { ?>
													
													<a class="red" href="productspurchase.php?inact=<?php echo $row_pro['pro_id'];?>" onclick="if(confirm('Are you sure to activate this product')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_pro['pro_status']=='0') { ?>
												
												<a class="green" href="productspurchase.php?act=<?php echo $row_pro['pay_id']; ?>" onclick="if(confirm('Are you sure to deactivate this product')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                         
												<!--<a class="blue" href="edit_products.php?edit=<?php echo $row_pro['pay_id'];?>" onclick="if(confirm('Are you sure to edit this product')) { return true; } else { return false; }">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>-->
												 <?php if($demomode=='true'){?>
												   <a class="grey" onclick="demo()">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
													<?}else{?>

													<a class="grey" href="productspurchase.php?delete=<?php echo $row_pro['pay_id'];?>" onclick="if(confirm('Are you sure to delete this?')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
													<?}?>
												  </div>
												 
												</td>
											
										
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
							
								
								  	<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="click to deactivate"/>
								
								<a href="xlsexport.php?today=<?php echo date("Y-m-d");?>"><input type="submit" name="submit" id="today" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="Today Report" value="Today"></a>
								
								<a href="xlsexport.php?tmonth=<?php echo $date;?>"><input type="submit" name="submit" id="tmonth" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="Last Three month Report" value="3 Month"></a>
								
								<a href="xlsexport.php?smonth=<?php echo $sdate;?>"><input type="submit" name="submit" id="smonth" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="Last Three month Report" value="6 Month"></a>
								
								<a href="xlsexport.php?ymonth=<?php echo $ydate;?>"><input type="submit" name="submit" id="ydate" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="1 Year Report" value="1 Year"></a>
							
								</div>
								</form>
								
							<?php
							$email=isset($_REQUEST['user'])?$_REQUEST['user']:'';	
							$search2="";
							
							if($email!=""){
								$search2.="where pay_email like '%$email%' and pay_payment='1' ";
														
							}
							if(isset($_REQUEST['fromdate']) && isset($_REQUEST['todate']) && $_REQUEST['fromdate']!="" && $_REQUEST['todate']!=""){
								$fromdate=date('Y-m-d', strtotime($_REQUEST['fromdate']));
								$todate=date('Y-m-d', strtotime($_REQUEST['todate']));
								$search2.="where (pay_date>='$fromdate' and pay_date<='$todate') and pay_payment='1'";
							}
							
							if(empty($email) && empty($_REQUEST['fromdate']) && empty($_REQUEST['todate'])){
								$search2.="where pay_payment='1'";
							}
							
							$header = array("pay_userid","pay_email","pay_amount","pay_date");
							$ext_obj->pdfExportbtn($header, "mlm_purchase","$search2");
							?>

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
			      null, null,null, null, null,null,{ "bSortable": false }
				  
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
		
<script>function errorm(){
 alert('Payment status not completed');
}</script>  		

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $( function() {
    $( "#datepicker_from" ).datepicker();
  } );
  $( function() {
    $( "#datepicker_to" ).datepicker();
  } );
  </script>

<script>
function valid() {
	var fromDate = document.getElementById("datepicker_from").value;
	var toDate = document.getElementById("datepicker_to").value;
	if(toDate<fromDate) {
		alert('Please select the valid date');
		document.getElementById("datepicker_to").value="";
		document.getElementById("datepicker_to").focus();
		return false;
	}
}
</script>
 
	</body>
</html>
