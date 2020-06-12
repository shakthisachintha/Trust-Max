<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");


?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- style pie chart-->
<style>
#flotcontainer1 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer2 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer3 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
</style>
<!-- end-->
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			<hr />			
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			
			<!-- Profile info end -->
			
		<!--	<hr />-->
			
			<div class="row" >
			
				<!-- left div here -->
				<div style="margin-top:30px;">
                <?php include("includes/profilemenu.php"); ?>
				</div>
                
				<div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner">								
<!-- cc  -->		
							
							
					</div>
				   
					<div>
						<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Wallet Statement</h4>
						<div class="table-responsive">
						<h5 style="color:black; line-height:40px;">Referral Bonus</h5>
						 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<td width="8%"><strong>S.No</strong></td>
							<td width="18%"><strong>User Name</strong></td>
							<td width="15%"><strong>Profileid</strong></td>
							<td width="15%"><strong>Commission Amount</strong></td>
							<td width="15%"><strong>Reason</strong></td>
							<td width="15%"><strong>Status</strong></td>
							<td width="15%"><strong>Date</strong></td>
						</tr>
						</thead>
						<?php
						$i=1;
						$blankspc=$db->get_all("select * from mlm_payout where user_id='$_SESSION[profileid]' and bonus_type='0' order by user_id asc");
                        if(count($blankspc)!='0'){ 						
						foreach($blankspc as $bspc) {
						$placement=$db->singlerec("select user_fname,user_lname from mlm_register where user_profileid='$bspc[from_id]'");	
						if(!empty($placement)) $name=$placement['user_fname']." ".$placement['user_lname'];
						else $name="<b>...</b>";
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo !empty($bspc['from_id'])?$bspc['from_id']:'<b>...</b>'; ?></td>
							<td><?php echo $bspc['amount']; ?></td>
							<td><?php echo $bspc['reason']; ?></td>
							<td><?php
                                 if($bspc['status']==0){
                                 echo "Pending";
                                 }
                                 else{
                                 echo "Approved";
                                 }
                                 ?></td>
							<td><?php echo $bspc['date']; ?></td>
						</tr>
						<?php $i++; } } else { echo "<tr><td colspan='7'><p style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</p></td></tr>"; }?>
						</table>
						
						<h5  style="color:black; line-height:40px; ">Product purchase bonus</h5>
						 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<td width="8%"><strong>S.No</strong></td>
							<td width="18%"><strong>User Name</strong></td>
							<td width="15%"><strong>Profileid</strong></td>
							<td width="15%"><strong>Commission Amount</strong></td>
							<td width="15%"><strong>Reason</strong></td>
							<td width="15%"><strong>Status</strong></td>
							<td width="15%"><strong>Date</strong></td>
						</tr>
						</thead>
						<?php
						$i=1;
						$blankspc=$db->get_all("select * from mlm_payoutcalc where pay_user='$_SESSION[profileid]' order by pay_user asc");
                        if(count($blankspc)!='0'){ 						
						foreach($blankspc as $bspc) {
						$placement=$db->singlerec("select user_fname,user_lname from mlm_register where user_profileid='$bspc[pay_user]'");	
						if(!empty($placement)) $name=$placement['user_fname']." ".$placement['user_lname'];
						else $name="<b>...</b>";
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo !empty($bspc['pay_user'])?$bspc['pay_user']:'<b>...</b>'; ?></td>
							<td><?php echo $bspc['pay_amount']; ?></td>
							<td><?php echo $bspc['pay_reason']; ?></td>
							<td><?php
                                 if($bspc['pay_calc_status']==0){
                                 echo "Pending";
                                 }
                                 else{
                                 echo "Approved";
                                 }
                                 ?></td>
							<td><?php echo date("d-m-Y",strtotime($bspc['pay_date'])); ?></td>
						</tr>
						<?php $i++; } }
						else { echo "<tr><td colspan='7'><p style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</p></td></tr>"; }?>
						</table>
						</div>
					</div>
					<br>
				</div>	
</div>	
<?php include "includes/login-access-ads.php";?>			
</div>				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>

		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		
		
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

</script>

<!-- end -->
		
		
	</body>
</html>