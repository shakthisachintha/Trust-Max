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
					<button data-toggle="collapse" data-target="#demo" class="btn btn-info">Your Downline List</button>
					<br><br>	
                    <div id="demo" class="collapse">
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
			</div>

		   <br/>
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