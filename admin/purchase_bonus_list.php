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

$act=$db->insertrec("update mlm_payoutcalc set pay_calc_status='1' where pay_id='$id'");

if($act)
{
?>
<script>
window.location="purchase_bonus_list.php?paysucc";
</script>
<?php
}

}

if(isset($_REQUEST['unsetpay']))
{

$id=addslashes($_REQUEST['unsetpay']);

$act=$db->insertrec("update mlm_payoutcalc set pay_calc_status='0' where pay_id='$id'");

if($act)
{
?>
<script>
window.location="purchase_bonus_list.php?payrev";
</script>
<?php
}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_payoutcalc where pay_id='$id'");

if($det)
{
?>
<script>
window.location="purchase_bonus_list.php?del";
</script>

<?php
}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_payoutcalc where pay_id='$del_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="purchase_bonus_list.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_payoutcalc set pay_calc_status='1' where pay_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="purchase_bonus_list.php?paysucc";
</script> <?php
}
 }

if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];


$sql = "update mlm_payoutcalc set pay_calc_status='0' where id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="purchase_bonus_list.php?payrev";
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
            <li class="active">Purchase Bonus</li>
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
               <form action="" method="post">
                  <div class="row-fluid">
                     <div class="table-header">
                        Purchase Bonus Management
						<span style="float:right; padding-right:10px;"><a href="export_pair.php?user=<?php echo $user; ?>&fromdate=<?php echo $from_date; ?>&todate=<?php echo $to_date; ?>&today=<?php echo $today; ?>&lastten=<?php echo $lastten; ?>&monthly=<?php echo $monthly; ?>&search=search" style="text-decoration:none; color:#fff;">Export Report</a></span>
                     </div>
		<?php
			$search="";
			$temp="";
	if(isset($_REQUEST["submit"]))
	{
		if(isset($_REQUEST["fromdate"]) && !empty($_REQUEST["fromdate"]) && isset($_REQUEST["todate"]) && !empty($_REQUEST["todate"]))
		{
			$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
			$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
			$search.=" and (DATE_FORMAT(FROM_UNIXTIME(pay_date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate')";
			
		}else if($_REQUEST['user'] && !empty($_REQUEST['user'])){
			$em=stripslashes($_REQUEST['user']);
			$search.="and user_id like '%$em%'";
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
                              <th width="10">S.No</th>
							  <th width="15">User ID</th>
                              <th width="15">Commission Amount</th>
                              <th width="15">Reason</th>
							  <th width="10">Date</th>
                              <th width="15">Status</th>
                              <th width="15">Action</th>
                           </tr>
                        </thead>
                        <tbody>
							<?php
							$i=1;
							$curdate=date("d-m-Y");
							$que="select * from mlm_payoutcalc where pay_amount!='' $search";
							if(isset($_REQUEST['today'])) {
								$que.=" and DATE_FORMAT(FROM_UNIXTIME(pay_date), '%d-%m-%Y')='$curdate'";
							}
							else if(isset($_REQUEST['lastten'])) {
								$start=date('d-m-Y', strtotime('-10 day'));
								$end=date('d-m-Y', strtotime('-1 day'));
								$que.=" and (DATE_FORMAT(FROM_UNIXTIME(pay_date), '%d-%m-%Y') between '$start' and '$end')";
							}
							else if(isset($_REQUEST['monthly'])) {
								$start=date('d-m-Y', strtotime('first day of this month'));
								$end=date('d-m-Y', strtotime('last day of this month'));
								$que.=" and (DATE_FORMAT(FROM_UNIXTIME(pay_date), '%d-%m-%Y') between '$start' and '$end')";
							}
							$que.=" order by pay_id desc";
							$pout=$db->get_all($que);
							foreach($pout as $poutInfo) {
							?>
                            <tr>
						   	<td class="center">
								<label>
									<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $poutInfo['pay_id']; ?>"  />
									<span class="lbl"></span>
								</label>
							 </td>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $poutInfo['pay_user']; ?></td>
                              <td><?php echo $poutInfo['pay_amount']; ?></td>
                              <td><?php echo $poutInfo['pay_reason']; ?></td>
                              <td><?php echo date("d-m-Y", strtotime($poutInfo['pay_date'])); ?></td>
                              <td><?php
                                 if($poutInfo['pay_calc_status']==0){
                                 echo "Pending";
                                 }
                                 else{
                                 echo "Approved";
                                 }
                                 ?></td>
                              <td>
							    <?php if($poutInfo['pay_calc_status']=='0') { ?>
								<a class="red" href="purchase_bonus_list.php?setpay=<?php echo $poutInfo['pay_id'];?>" onclick="if(confirm('Are you sure want to Set Payment status to payed')) { return true; } else { return false; }">
								<i class="icon-certificate bigger-130" title="click to activate"></i>
								</a>
								<?php } if($poutInfo['pay_calc_status']=='1') { ?>
								<a class="green" href="purchase_bonus_list.php?unsetpay=<?php echo $poutInfo['pay_id']; ?>" onclick="if(confirm('Are you sure to Revert Payment Status')) { return true; } else { return false; }">
								<i class="icon-certificate bigger-130" title="click to deactivate"></i>
								</a>
                                <?php } ?>
                              </td>
                           </tr>
                           <?php $i++; }?>
                        </tbody>
                     </table>
                  </div>                
               </form>
              <?php
				$uid=$user;
				$search="";
				if($uid!=""){
					$em=stripslashes($_REQUEST['user']);
					$search.="where pay_user like '%$em%' and  pay_amount!='' and bonus_type='1'";
				}
			
				if($from_date!="" && $to_date!=""){
					$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
					$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
					$search.=" where (DATE_FORMAT(FROM_UNIXTIME(pay_date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate') and pay_amount!='' and bonus_type='1'";
				}
				
				if(empty($uid) && empty($_REQUEST['fromdate']) && empty($_REQUEST['todate']) ){
					$search.="where pay_amount!='' and bonus_type='1'";
				}
				
				$header = array("pay_user","pay_purchaseid","pay_amount","pay_reason");
				//extra::pdfExportbtn($header, "mlm_payoutcalc","$search");
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
			     { "bSortable": true }, { "bSortable": true }, { "bSortable": true },{ "bSortable": true }, { "bSortable": true }, { "bSortable": true },{ "bSortable": false }
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