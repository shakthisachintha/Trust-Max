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
			
			<div class="row" style="margin-top:30px;">
			
				<!-- left div here -->
				
                <?php include("includes/profilemenu.php"); ?>
                
				<div class="col-sm-9">
                    <div class="row">
                    
						<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Pair capping</h4>
						<div class="table-responsive">
						<table class="table table-striped new_tbl" cellpadding="7" cellspacing="5" border="0" width="100%">
						<tr>
							<td width="10%"><strong>S.No</strong></td>
							<td width="25%"><strong>Amount</strong></td>
							<!--<td width="25%"><strong>Bonus Type</strong></td>-->
							<td width="25%"><strong>Date</strong></td>
							<td width="25%"><strong>Status</strong></td>
						</tr>
						<?php
						
						$qry1=$db->get_all("select * from mlm_payout where user_id='$_SESSION[profileid]' and reason='pair-capping-to-wallet' order by id desc");	
						$count = $db->numrows("select * from mlm_payout where user_id='$_SESSION[profileid]' and reason='pair-capping-to-wallet'");
						$i=1;
						foreach($qry1 as $qry){
						$bt=$qry['bonus_type'];
						if($bt==0){
							$msg="Referal Bonus";
						}else if($bt==1){
							$msg="Pair Bonus";
						}
						else if($bt==2){
							$msg="Pair capping payout";
						}
						$date=$qry['date'];
						$d=date("Y-m-d",strtotime($date));
						$status=(int)$qry['status'];
						if($status==1){
							$alert="Approved";
						}else if($status==0){
							$alert="Un-Approved";
						}
						$fromid=$qry['from_id'];
						if(!empty($fromid)) $fpid=$fromid;
						else if(empty($fromid)) $fpid="Admin";
						
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $qry['amount']; ?></td>
							<!--<td><?php echo $msg; ?></td>-->
							<td><?php echo $d; ?></td>
							<td><?php echo $alert; ?></td>
						</tr>
						<?php $i++; } if($count==0){ echo "<td colspan='6' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</td>"; } ?>
						</table>
						</div>
					</div>
				</div>	
</div>	
			
</div>				
            </div>
			<div class="clearfix"></div>
			<div class="container">
			<?php include "includes/login-access-ads.php";?>
			<?php include("includes/footer.php"); ?>
			</div>
		</div>

		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>
		
	</body>
</html>