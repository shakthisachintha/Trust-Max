<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
include("includes/head.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}

$pay_sum_s = $db->extract_single("SELECT SUM(pay_amount) as stot from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 1");
if($pay_sum_s == NULL || $pay_sum_s == ''){$pay_sum_s = 0;}

$pay_sum_f = $db->extract_single("SELECT SUM(pay_amount) as tot from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 0");
if($pay_sum_f == NULL || $pay_sum_f == ''){$pay_sum_f = 0;}

$pur_num_s=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1");
				
$puram_sum_s=$db->extract_single("select sum(pay_amount) as tot from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1");

$pur_num_p=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0");
				
$puram_sum_p=$db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0");

$pur_num_f=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2");
				
$puram_sum_f=$db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2");

if($pur_num_s == NULL || $pur_num_s == ''){$pur_num_s=0;}
if($pur_num_p == NULL || $pur_num_p == ''){$pur_num_p=0;}
if($pur_num_f == NULL || $pur_num_f == ''){$pur_num_f=0;}

if($puram_sum_s == NULL || $puram_sum_s == ''){$puram_sum_s=0;}
if($puram_sum_p == NULL || $puram_sum_p == ''){$puram_sum_p=0;}
if($puram_sum_f == NULL || $puram_sum_f == ''){$puram_sum_f=0;}

$d4 = date('Y-m-d', strtotime(date('Y-m-d')." -4 week")); 
$d3 = date('Y-m-d', strtotime(date('Y-m-d')." -3 week")); 
$d2 = date('Y-m-d', strtotime(date('Y-m-d')." -2 week")); 
$d1 = date('Y-m-d', strtotime(date('Y-m-d')." -1 week")); 
$d0 = date('Y-m-d', strtotime(date('Y-m-d')));

$psum_d4 = array();
$psum_d3 = array();
$psum_d2 = array();
$psum_d1 = array();

for($i=0;$i<3;$i++)
{
$row1 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d4' and '$d3') AND pay_payment=$i");
$psum_d4[$i] = $row1;
if($psum_d4[$i] == NULL || $psum_d4[$i] == ""){$psum_d4[$i] = 0;}	


$row2 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d3' and '$d2') AND pay_payment=$i");
$psum_d3[$i] = $row2;
if($psum_d3[$i] == NULL || $psum_d3[$i] == ""){$psum_d3[$i] = 0;}

$row3 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d2' and '$d1') AND pay_payment=$i");
$psum_d2[$i] = $row3;
if($psum_d2[$i] == NULL || $psum_d2[$i] == ""){$psum_d2[$i] = 0;}

$row4 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d1' and '$d0') AND pay_payment=$i");
$psum_d1[$i] = $row4;
if($psum_d1[$i] == NULL || $psum_d1[$i] == ""){$psum_d1[$i] = 0;}

}

$psum_d4[3] = $psum_d4[2] + $psum_d4[1] + $psum_d4[0];
$psum_d3[3] = $psum_d3[2] + $psum_d3[1] + $psum_d3[0];
$psum_d2[3] = $psum_d2[2] + $psum_d2[1] + $psum_d2[0];
$psum_d1[3] = $psum_d1[2] + $psum_d1[1] + $psum_d1[0];

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
    <body>
	<div class="container main">
		<!-- Start Header-->
		<?php include("includes/header.php");?>
		<!-- End Header-->
		<hr />
		
		<!-- Profile info -->
		<?php include("includes/profileheader.php");?>
		
		<div class="row" style="margin-top:30px;">
		
		<!-- left div here -->
			
		<?php include("includes/profilemenu.php");?>
			
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-12">
					<div class="banner">
						<div>
						<div class="table-responsive"> 
						<table class="table new_tbl"	width="100%">
						<tr>
						<td class="col-sm-6">
						<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Payout</h4>
							<table class="table table-striped new_tbl" cellpadding="7" cellspacing="5" border="0" width="100%">
							<tr>
								<td width="15%">
									<strong>S.No</strong>
								</td>
								
								<td width="65%"> 
									<strong>Description</strong>
								</td>
								
								<td width="20%">
									
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Earning Amount</td>
								<td><?php echo $com_obj->totalBal($userdetail['user_profileid'])." ".$sitecurrency;?></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Requested Amount</td>
								<td><?php echo $com_obj->withdrawBal($userdetail['user_profileid'])." ".$sitecurrency; ?></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Geneology</td>
								<td><a href="binary.php">click</a></td>
							</tr>
						
							</table>
						</td>
						
						<td class="col-sm-6">
							<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Purchase Details</h4>
							<table class="table table-striped new_tbl" cellpadding="7" cellspacing="5" border="0" width="100%">
							<tr>
								<td width="10%">
									<strong>S.No</strong>
								</td>
								
								<td width="50%"> 
									<strong>Description</strong>
								</td>
								
								<td width="20%">
									<strong>Count</strong>
								</td>
								<td width="20%">
									<strong>Cost</strong>
								</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Purchased - success</td>
								<td><?php echo $pur_num_s; ?></td>
								<td><?php echo $puram_sum_s; ?></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Purchased - on process</td>
								<td><?php echo $pur_num_p; ?></td>
								<td><?php echo $puram_sum_p; ?></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Purchased - failed</td>
								<td><?php echo $pur_num_f; ?></td>
								<td><?php echo $puram_sum_f; ?></td>
							</tr>
						
							</table>
						
						</td>
						</tr>
						</table>
						</div>
						
						</div>
					
					<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Downline List</h4>
							<div class="table-responsive">
							<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
							<tr>
								<td width="10%">
									<strong>S.No</strong>
								</td>
								
								<td width="25%"> 
									<strong>Name</strong>
								</td>
								
								<td width="25%">
									<strong>Email</strong>
								</td>
								
								<td width="25%">
									<strong>Phone</strong>
								</td>
								
								<td width="35%">
									<strong>Join Date</strong>
								</td>
								
							</tr>
							</thead>
							
							
							<?php
							$sql="SELECT * from mlm_register where user_sponserid='$_SESSION[profileid]' and user_status='0'";
							$result = $db->get_all_assoc($sql);
							$count=$db->numrows($sql);
							if($count!=0){
							$i=0;
							
							foreach($result as $row){
							$name = $row['user_fname'];
							$email = $row['user_email'];
							$phone = $row['user_phone'];
							$date = $row['user_date'];
							$i++;
															
									?>
							<tr><?php echo isset($Message) ? $Message:'';?>
								<td>
									<?php echo $i;?>
								</td>
								
								<td> 
									<?php echo $name;?>
								</td>
								
								<td>
									<?php echo $email;?>
								</td>
								
								<td>
									<?php echo $phone;?>
								</td>
								
								<td>
									<?php echo $date;?>
								</td>
								
							</tr>	
								
						<?php } } else { echo "<td colspan='4' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</td>"; } ?>

							</table>
							</div>
			</div>

		   <br/>
		   <div>
		   <br />
		   
		   
					<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Renewal Downline List</h4>
							<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
								<tr>
									<td width="10%">
									<strong>S.No</strong>
								</td>
								
								<td width="25%"> 
									<strong>Name</strong>
								</td>
								
								<td width="25%">
									<strong>Email</strong>
								</td>
								
								<td width="25%">
									<strong>Phone</strong>
								</td>
								
								<td width="25%">
									<strong>Join date</strong>
								</td>
									</tr>
								</thead>
							
							<?php 
							$date=date('Y-m-d'); 
							$sql="SELECT a.user_profileid,a.user_fname,a.user_email,a.user_phone ,a.user_date,b.status from mlm_register as a inner join mlm_mempayments as b ON a.user_profileid=b.profileid where a.user_sponserid='$_SESSION[profileid]' and a.user_status='0' and b.status='Completed'";
							
							$result = $db->get_all_assoc($sql);
							$count=$db->numrows($sql);
							if($count!=0){
							$i=0;
							
							foreach($result as $row){
							$name = $row['user_fname'];
							$email = $row['user_email'];
							$phone = $row['user_phone'];
							$date = $row['user_date'];
							$status = $row['status'];
							$upid=$row['user_profileid'];
						
							$ismemExpired=$ext_obj->ismemExpired($upid);
							if(!$ismemExpired){	
									$i++;
									?>
						
							<tr><?php echo isset($Message) ? $Message:'';?>
								<td>
									<?php echo $i;?>
								</td>
								
								<td> 
									<?php echo $name;?>
								</td>
								
								<td>
									<?php echo $email;?>
								</td>
								
								<td>
									<?php echo $phone;?>
								</td>
								
								<td>
									<?php echo $date;?>
								</td>
								
							</tr>	
								
							<?php } }} else { echo "<td colspan='4' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found<td>";}?></tr>										

							</table>
							</div>
			</div>
			<br/>
			
			 <div>
		   <br />
		   
					<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">NonRenewal Downline List</h4>
							<div class="table-responsive">
							<table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
							<tr>
								<td width="10%">
									<strong>S.No</strong>
								</td>
								
								<td width="25%"> 
									<strong>Name</strong>
								</td>
								
								<td width="25%">
									<strong>Email</strong>
								</td>
								
								<td width="25%">
									<strong>Phone</strong>
								</td>
								
								<td width="25%">
									<strong>Join date</strong>
								</td>
								
							</tr>
							
							</thead>
							<?php
							$date=date('Y-m-d'); 
							$sql="SELECT a.user_profileid,a.user_fname,a.user_email,a.user_phone,a.user_date ,b.* from mlm_register as a inner join mlm_mempayments as b ON a.user_profileid=b.profileid where a.user_sponserid='$_SESSION[profileid]' and a.user_status='0'";
							
							$result = $db->get_all_assoc($sql);
							$count=$db->numrows($sql);
							if($count!=0){

							$i=0;
							
							foreach($result as $row){
							$name = $row['user_fname'];
							$email = $row['user_email'];
							$phone = $row['user_phone'];
							$date = $row['user_date'];
							$status = $row['status'];
						
							$upid=$row['user_profileid'];						
							$ismemExpired=$ext_obj->ismemExpired($upid);
							if($ismemExpired){
									$i++;
									?>
							<tr><?php echo isset($Message) ? $Message:'';?>
								<td>
									<?php echo $i;?>
								</td>
								
								<td> 
									<?php echo $name;?>
								</td>
								
								<td>
									<?php echo $email;?>
								</td>
								
								<td>
									<?php echo $phone;?>
								</td>
								
								<td>
									<?php echo $date;?>
								</td>
								
							</tr>	
								
							<tr><?php } }}else{ echo "<td colspan='5' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</td>";} ?>		</tr>

							</table>
							</div>
			</div>
			
			<div>
		   <br/>
				<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Blank Space</h4>
				<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<td width="10%"><strong>S.No</strong></td>
					<td width="25%"><strong>User Name</strong></td>
					<td width="20%"><strong>Profileid</strong></td>
					<td width="10%"><strong>Blank Space</strong></td>
					<td width="10%"><strong>User Level</strong></td>
					<td width="25%"><strong>Action</strong></td>
				</tr>
				</thead>
				<?php
				$i=1;
				$com_obj->blankSpace($_SESSION['profileid']);
				$blankspc=array_unique($_SESSION['blankspc']);
				$blankspc=implode(",", $blankspc);
				$blankspc=$db->get_all("select user_profileid,user_fname,user_lname from mlm_register where FIND_IN_SET(user_profileid, '$blankspc') order by user_id asc");
				if(count($blankspc)==0) echo "<tr><td colspan='5'><p style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No blankspace available!</p></td></tr>";
				foreach($blankspc as $bspc) {
				$placement=$db->singlerec("select count(*) as tot from mlm_register where user_placementid='$bspc[user_profileid]'");
				$placement=bcsub(2,$placement['tot'],0);
				// level
				if($bspc['user_profileid']!=$_SESSION['profileid']) {
					$usrLvl="Level ".$com_obj->userLevel($bspc['user_profileid'],$_SESSION['profileid']);
				}
				else
					$usrLvl="<small><i>You</i></small>";						
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $bspc['user_fname']." ".$bspc['user_lname']; ?></td>
					<td><?php echo $bspc['user_profileid']; ?></td>
					<td><?php echo $placement; ?></td>
					<td><?php echo $usrLvl;?></td>
					<td><a href="register.php?sid=<?php echo $bspc['user_profileid']; ?>">Click to add user</a></td>
				</tr>
				<?php $i++; } ?>
				</table>
				</div>
			</div>
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
});

$(document).ready(function() {
    $('#example1').DataTable();
});

</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example2').DataTable();
});


$(document).ready(function() {
    $('#example3').DataTable();
});
</script>
	</body>
</html>