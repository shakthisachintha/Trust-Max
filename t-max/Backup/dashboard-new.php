<?php include "includes-new/header.php";
include("includes-new/function.php"); 

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


//header
$user_profileid = $userdetail['user_profileid'];

$user=$db->singlerec("select * from mlm_register where user_profileid='$user_profileid' and user_status='0'");
$ufname=ucfirst($user['user_fname']);
$ulname=$user['user_lname'];
$email=$user['user_email'];

 if($user_profileid=="")
{
	@session_destroy();
	header("location:login.php");
	echo "<script>location.href='login.php';</script>";
	exit;
} 
$bal = $com_obj->totalBal($userdetail['user_profileid']);
$with = $com_obj->withdrawBal($userdetail['user_profileid']);

$reward=$com_obj->completedPair($_SESSION['profileid']);
$reimg=$db->singlerec("select * from mlm_reward where pair_complete like '$reward' and status='1'");
$re_img=$reimg['reward_img'];
$paircount=$reimg['pair_complete'];
if($reward==$paircount){
$subject="Reward Complete Details from ".$website_name;

	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Reward Complete Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $ufname, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>congratulation,You have successfully completed $reward pair's.</td>
						</tr>
					
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";
$to=$email;
$cmail=$com_obj->commonMail($to,$subject,$msg);
}

$sponid=$userdetail['user_sponserid'];
$detail=$db->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'");

if(isset($_REQUEST['uploadpay']))
{
	$imag=$_FILES['payslip']['tmp_name'];
	$imag=isset($imag)?$imag:'';
	$name2=rand(11111,99999).uniqid();
	$img_upl=$com_obj->upload_image("payslip",$name2,300,300,"uploads/payslip/","new");
	if($img_upl) 
		{
			$main_img=$com_obj->img_Name;					
			$res=$db->insertrec("update mlm_mempayments set user_payslip='$main_img' where profileid='$user_profileid' ");
			header("location:dashboard.php?up");
	        echo "<script>location.href='dashboard.php?up';</script>";
		}else{
			echo $imgerr=$com_obj->img_Err;
		}
}

?>

		<!-- Page Conttent -->
	<main class="page-content">
	  
<div class="section-full bg-white section-padding-xs browse-job p-t50 p-b20">
	<div class="container">
		<div class="row">
			<?php include "includes-new/left-menu.php" ?>
			<div class="col-xl-9 col-lg-8 m-b30">
				<div class="job-bx job-profile">
					<div class="job-bx-title clearfix">
						<h5 class="font-weight-700 pull-left text-uppercase">Dashboard</h5>
						
					</div>
					
					<div class="row">
					    <div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-8">
											<h4 class="text-c-darkblue"><?php echo $userdetail['user_rank']; ?></h4>
											
										</div>
										<div class="col-4 text-right">
											<i class="zmdi zmdi-balance-wallet f-ft5"></i>
										</div>
									</div>
								</div>
								<div class="card-footer bg-c-darkblue">
									<div class="row align-items-center">
										<div class="col-9">
											<p class="text-white m-b-0">Rank</p>
										</div>
										<div class="col-3 text-right">
											<i class="feather icon-trending-down text-white f-16"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-8">
											<h4 class="text-c-green"><?php echo $com_obj->totalBal($userdetail['user_profileid'])." ".$sitecurrency; ?></h4>
											
										</div>
										<div class="col-4 text-right">
											<i class="zmdi zmdi-comment-list f-ft2"></i>
										</div>
									</div>
								</div>
								<div class="card-footer bg-c-green">
									<div class="row align-items-center">
										<div class="col-9">
											<p class="text-white m-b-0">Total Balance</p>
										</div>
										<div class="col-3 text-right">
											<i class="feather icon-trending-up text-white f-16"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-8">
											<h4 class="text-c-red"><?php  echo $com_obj->withdrawBal($userdetail['user_profileid'])." ".$sitecurrency ; ?></h4>
										   
										</div>
										<div class="col-4 text-right">
											<i class="zmdi zmdi-money f-ft3"></i>
										</div>
									</div>
								</div>
								<div class="card-footer bg-c-red">
									<div class="row align-items-center">
										<div class="col-9">
											<p class="text-white m-b-0">Withdraw Amount </p>
										</div>
										<div class="col-3 text-right">
											<i class="feather icon-trending-down text-white f-16"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-8">
											<h4 class="text-c-blue"><?php  echo $com_obj->availBal($bal,$with)." ".$sitecurrency; ?></h4>
										   
										</div>
										<div class="col-4 text-right">
											<i class="zmdi zmdi-money f-ft4"></i>
										</div>
									</div>
								</div>
								<div class="card-footer bg-c-blue">
									<div class="row align-items-center">
										<div class="col-9">
											<p class="text-white m-b-0">Available Balance</p>
										</div>
										<div class="col-3 text-right">
											<i class="feather icon-trending-down text-white f-16"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-sm-12 mt20i">
						<h4 class="pdb10i ">Overall Payout</h4>
						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
								    <tr>
										<td><strong>S.No</strong></td>
										<td><strong>Description</strong></td>
										<td></td>
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
						</div>
						
					</div>
					
					</br>
                    <div class="col-sm-12 mt20i">
						<h4 class="pdb10i ">Overall Purchase Details</h4>
						<div class="table-responsive">
						  <table class="table table-bordered table-striped ">
								    <tr>
										<td><strong>S.No</strong></td>
										<td><strong>Description</strong></td>
										<td><strong>Count</strong></td>
										<td><strong>Cost</strong></td>
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
						</div>
						
					</div></br>					
					<div class="col-sm-12 mt20i">
					<h4 class="pdb10i ">Downline List</h4>
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-striped ">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Join Date</th>
								</tr>
							</thead>
							<tbody>
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
							 </tbody>
						</table>
					</div>
					
				</div>
				</br>
					<div class="col-sm-12 mt20i">
						<h4 class="pdb10i ">Renewal Downline List</h4>
						<div class="table-responsive">
						  <table id="example1" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
									</tr>
								</thead>
								<tbody>
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
					<?php } }} else { echo "<td colspan='4' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found<td>";}?>				
								 </tbody>
							</table>
						</div>
						
					</div>
					</br>
					<div class="col-sm-12 mt20i">
						<h4 class="pdb10i ">NonRenewal Downline List</h4>
						<div class="table-responsive">
						  <table id="example2" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
									</tr>
								</thead>
								<tbody>
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
					<?php } }} else { echo "<td colspan='4' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found<td>";}?>				
								 </tbody>
							</table>
						</div>
						
					</div>
					</br>
					<div class="col-sm-12 mt20i">
						<h4 class="pdb10i ">Blank Space</h4>
						<div class="table-responsive">
						  <table id="example3" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th>S.No</th>
										<th>User Name</th>
										<th>Profileid</th>
										<th>Blank Space</th>
										<th>User Level</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
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
				<tr><?php echo isset($Message) ? $Message:'';?>
					<td><?php echo $i;?></td>
					<td><?php echo $bspc['user_fname']." ".$bspc['user_lname']; ?></td>
					<td><?php echo $bspc['user_profileid']; ?></td>
					<td><?php echo $placement; ?></td>
					<td><?php echo $usrLvl;?></td>
					<td><a href="register.php?sid=<?php echo $bspc['user_profileid']; ?>">Click to add user</a></td>
					
				</tr>
					<?php $i++; } ?>			
								 </tbody>
							</table>
						</div>
						
					</div>
				</div>    
			</div>
		</div>
	</div>
</div>

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>

<script>

$(document).ready(function(){
    function checkTreeCollaps() {
    $(".tree-container li.tree-li").removeClass("is-child")
        $(".tree-container li.tree-li").each(function () {
            if ($(this).find("ul.tree-ul li").length > 0) {
                $(this).addClass("is-child")
            }
        });

    $(".tree-container li.tree-li span.text").unbind("click");
        $(".tree-container li.tree-li.is-child span.text").click(function () {
            $(this).parent(".tree-li").toggleClass("diactive");
            $(this).parent(".tree-li").find(".tree-ul:first").toggleClass("diactive");
        });
}

checkTreeCollaps()

});</script>