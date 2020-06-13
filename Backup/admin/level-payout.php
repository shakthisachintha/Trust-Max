<?php
include("AMframe/config.php");
include("includes/header.php");
   
if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}
$menu14='class="active"';

if(isset($_REQUEST['setpay']))
{

$id=addslashes($_REQUEST['setpay']);

$act=$db->insertrec("update mlm_payout set status='1' where id='$id'");

if($act)
{
?>
<script>
window.location="level-payout.php?paysucc";
</script>
<?php
}

}

if(isset($_REQUEST['unsetpay']))
{

$id=addslashes($_REQUEST['unsetpay']);

$act=$db->insertrec("update mlm_payout set status='0' where id='$id'");

if($act)
{
?>
<script>
window.location="level-payout.php?payrev";
</script>
<?php
}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_payout where id='$id'");

if($det)
{
?>
<script>
window.location="level-payout.php?del";
</script>

<?php
}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_payout where id='$del_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="level-payout.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
$checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_payout set status='1' where id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="level-payout.php?paysucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];


$sql = "update mlm_payout set status='0' where id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="payout.php?payrev";
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
            <li class="active">Level Payout</li>
         </ul>
         <!--.breadcrumb-->
      </div>
      <div class="page-content">
         <!--/.page-header-->
         <div class="row-fluid">
            <div class="span12">
               <!--PAGE CONTENT BEGINS-->
               <!--/row-->
			       <?php 
						   
						   if(isset($_REQUEST['paysucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Payment Status Set to Paid Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   <?php 
						   
						   if(isset($_REQUEST['payrev']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Payment Status Reverted to Unpaid Successfully !!!
								</strong>
								
							</div>
						   
						   <?php 
						   }
						   $user=isset($_REQUEST['user'])?$_REQUEST['user']:'';
						   $from_date=isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:'';
						   $to_date=isset($_REQUEST['todate'])?$_REQUEST['todate']:'';
						   $today=isset($_REQUEST['today'])?$_REQUEST['today']:'';
						   $lastten=isset($_REQUEST['lastten'])?$_REQUEST['lastten']:'';
						   $monthly=isset($_REQUEST['monthly'])?$_REQUEST['monthly']:'';
						   ?>
               
                  <div class="row-fluid">
                     <div class="table-header">
                        Level Payout Management
						<span style="float:right; padding-right:10px;"><a href="export_payout.php?user=<?php echo $user; ?>&fromdate=<?php echo $from_date; ?>&todate=<?php echo $to_date; ?>&sindate=<?php echo $from_date; ?>&stodate=<?php echo $to_date; ?>&today=<?php echo $today; ?>&lastten=<?php echo $lastten; ?>&monthly=<?php echo $monthly; ?>&reason=level&search=search" style="text-decoration:none; color:#fff;">Export Report</a></span>
                     </div><br/>
					 
					 <?php
			$search="";
			$temp="";
	if(isset($_REQUEST["submit"]))
	{
		if(isset($_REQUEST["fromdate"]) && !empty($_REQUEST["fromdate"]) && isset($_REQUEST["todate"]) && !empty($_REQUEST["todate"]))
		{
			$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
			$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
			$search.=" and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate')";
			
		}else if($_REQUEST['user'] && !empty($_REQUEST['user'])){
			$em=stripslashes($_REQUEST['user']);
			$search.="and user_id like '%$em%'";
		}else if($_REQUEST['fromdate']!=""){
			$Sindate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
			$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$Sindate')";
		}else if($_REQUEST['todate']!=""){
			$Todate= date("d-m-Y", strtotime($_REQUEST["todate"]));
			$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$Todate')";
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
				<input type="text" name="user" id="email" value="<?php echo $user;?>" autocomplete="off" placeholder="User ID" />
				<input type="text" name="fromdate" value="<?php echo $from_date; ?>" id="datepicker_from"  autocomplete="off" placeholder="From date" />
				<input type="text" name="todate" id="datepicker_to" value="<?php echo $to_date; ?>" autocomplete="off" placeholder="To date" />	
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
                              <th width="10">S.No</th>
							   <th width="15">User ID</th>
                              <th width="15">Commission Amount</th>
                              <th width="15">Reason</th>
                              <th width="15">Status</th>
                              <th width="15">Action</th>
                           </tr>
                        </thead>
                        <tbody>
							<?php
							$i=1;
							$curdate=date("d-m-Y");
							
							$que="select * from mlm_payout where amount!='' and reason like 'level%' $search";
							if(isset($_REQUEST['today'])) {
								$que.=" and DATE_FORMAT(FROM_UNIXTIME(date), '%d-%m-%Y')='$curdate'";
							}
							else if(isset($_REQUEST['lastten'])) {
								$start=date('d-m-Y', strtotime('-10 day'));
								$end=date('d-m-Y', strtotime('-1 day'));
								$que.=" and (DATE_FORMAT(FROM_UNIXTIME(date), '%d-%m-%Y') between '$start' and '$end')";
							}
							else if(isset($_REQUEST['monthly'])) {
								$start=date('d-m-Y', strtotime('first day of this month'));
								$end=date('d-m-Y', strtotime('last day of this month'));
								$que.=" and (DATE_FORMAT(FROM_UNIXTIME(date), '%d-%m-%Y') between '$start' and '$end')";
							}
							$que.=" order by id desc";
							$pout=$db->get_all($que);
							foreach($pout as $poutInfo) {
							?>
                            <tr>
						   	<td class="center">
								<label>
									<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $poutInfo['id']; ?>"  />
									<span class="lbl"></span>
								</label>
							 </td>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $poutInfo['user_id']; ?></td>
                              <td><?php echo $poutInfo['amount']; ?></td>
                              <td><?php echo $poutInfo['reason']; ?></td>
                              <td><?php
                                 if($poutInfo['status']==0){
                                 echo "Pending";
                                 }
                                 else{
                                 echo "Approved";
                                 }
                                 ?></td>
                              <td>
							    <?php if($poutInfo['status']=='0') { ?>
								<a class="red" href="payout.php?setpay=<?php echo $poutInfo['id'];?>" onclick="if(confirm('Are you sure want to Set Payment status to payed')) { return true; } else { return false; }">
								<i class="icon-certificate bigger-130" title="click to activate"></i>
								</a>
								<?php } if($poutInfo['status']=='1') { ?>
								<a class="green" href="payout.php?unsetpay=<?php echo $poutInfo['id']; ?>" onclick="if(confirm('Are you sure to Revert Payment Status')) { return true; } else { return false; }">
								<i class="icon-certificate bigger-130" title="click to deactivate"></i>
								</a>
                                <?php } ?>
                              </td>
                           </tr>
                           <?php $i++; }?>
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
					 <a href="export_payout.php?tmonth=<?php echo $date;?>"><input type="button" name="tmonth" id="tmonth" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="Last Three month Report" value="Last 3 Month"></a>
								
					<a href="export_payout.php?smonth=<?php echo $sdate;?>"><input type="button" name="smonth" id="smonth" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="Last Three month Report" value="Last 6 Month"></a>
								
					<a href="export_payout.php?ymonth=<?php echo $ydate;?>"><input type="button" name="ymonth" id="ydate" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info"  title="1 Year Report" value="Last 1 Year"></a>
					
					 <input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								
					<input type="submit" name="mul_active" id="mul_active" value="Set Paid" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="Set Paid"/>
					
					<input type="submit" name="mul_inactive" id="mul_inactive" value="Set Un-paid" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="Set Un-Paid"/>
                   
                  </div>
                  <div class="modal-footer1">
					 <a class="green">
					 <i title="Set Status to Paid" class="icon-certificate bigger-130"></i>
					 </a> = Approved
					 </span>
                     <span>
					 <a class="red">
                     <i title="Set Status to Un-Paid" class="icon-certificate bigger-130"></i>
                     </a> = Disapproved
					 </span>
                  </div>
               </form>
			   
               <?php
				$uid=$user;
				$search="where reason like 'level%'";
				if($uid!=""){
					$em=stripslashes($_REQUEST['user']);
					$search.="and user_id like '%$em%' and  amount!=''";
										
				}
			
				if($from_date!="" && $to_date!=""){
					$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
					$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
					$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate') and amount!=''";
				}
				
				
				$header = array("user_id","amount","reason");
				$ext_obj->pdfExportbtn($header, "mlm_payout","$search");
				?>
            </div>
            <!--PAGE CONTENT ENDS-->
         </div>
         <!--/.span-->
      </div>
      <!--/.row-fluid-->
   </div>
   <!--/.page-content-->
   <div class="ace-settings-container" id="ace-settings-container">
     <!-- <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
         <i class="icon-cog bigger-150"></i>
      </div>-->
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
   </div>
   <!--/#ace-settings-container-->
</div>
<!--/.main-content-->
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
			     null,null,null,null,null,{ "bSortable": false }
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