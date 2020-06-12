<?php 
include("admin/AMframe/config.php");
include("includes/head.php");
include "config/instamojo.php"; 
include "pairing-capping.php";
$profileid=$_SESSION['profileid'];
//define(API_KEY, $API_KEY);
//define(AUTH_TOKEN, $AUTH_TOKEN);
$Instamojo=new Instamojo($API_KEY, $AUTH_TOKEN, $AUTH_URL);
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}

if(isset($_REQUEST['__upd'])) {
	$profileid=$_SESSION['profileid'];
	$pack=$_REQUEST['package'];
	$amount=$_REQUEST['totamt'];
	$product=$_REQUEST['pro'];
	$qty=$_REQUEST['qty'];
	$uInfo=$db->singlerec("select user_email from mlm_register where user_profileid='$profileid'");
	$ui=$db->singlerec("select * from mlm_register where user_profileid='$profileid'");
	$user_id=$ui['user_id'];
	$user_email=$ui['user_email'];
	$user_phone=$ui['user_phone'];
	$rankey=rand(0,99999); 
	$dat=date("Y-m-d");
	try {
		$response=$Instamojo->paymentRequestCreate(array(
			"purpose" => "Upgrading Membership",
			"amount" => $amount,
			"send_email" => true,
			"email" => $uInfo['user_email'],
			"redirect_url" => $website_url."memberpackage.php"
		));
		$ip=$_SERVER['REMOTE_ADDR'];
		$set="profileid='$profileid'";
		$set.=",payment_id='$response[id]'";
		$set.=",pack='$pack'";
		$set.=",amount='$amount'";
		$set.=",qty='$qty'";
		$set.=",discount='$discount'";
		$set.=",paidamt='$paidamt'";
		$set.=",status='$response[status]'";
		$set.=",longurl='$response[longurl]'";
		$set.=",ip_address='$ip'";
		$set.=",created_at='$response[created_at]'";
		$set.=",modified_at='$response[modified_at]'";
		$sett="pay_userid='$profileid'";
		$sett.=",pay_user='$user_id'";
		$sett.=",pay_email='$user_email'";
		$sett.=",randomkey	='$rankey'";
		$sett.=",pay_phone='$user_phone'";
		$sett.=",pay_product='$product'";
		$sett.=",pay_amount='$amount'";
		$sett.=",pay_qty='$qty'";
		$sett.=",pay_type='Instamojo'";
		$sett.=",pay_txnid='$response[id]'";
		$sett.=",pay_date='$dat'";
		$sett.=",pay_ip='$ip'";
		
		$db->insertrec("insert into mlm_mempayments set $set");
		
		$db->insertrec("insert into mlm_purchase set $sett");
		echo "<script>location.href='$response[longurl]';</script>";
		header("Location: $response[longurl]");
		exit;
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

if(isset($payment_id) && isset($payment_request_id)) {
	try {
		$txt=$db->extract_single("select pay_txnid from mlm_purchase where pay_userid='$profileid'");
		$response=$Instamojo->paymentRequestStatus($payment_request_id);
		$set="status='$response[status]'";
		$set.=",modified_at='$response[modified_at]'";
		$db->insertrec("update mlm_mempayments set $set where payment_id='$payment_request_id'");
		if($response['status']=="Completed") {
			if($txt==$payment_request_id){
			$redet=$db->singlerec("select * from mlm_purchase where pay_txnid='$payment_request_id'");
			$p_email=$redet['pay_email'];
			$p_userid=$redet['pay_userid'];
			$p_phone=$redet['pay_phone'];
			$p_product=$redet['pay_product'];
			$p_amount=$redet['pay_amount'];
			$p_qty=$redet['pay_qty'];
			$p_type=$redet['pay_type'];
			$p_date=$redet['pay_date'];
			$pro=$db->singlerec("select pro_name from mlm_products where pro_id='$p_product'");
			$p_name=$pro['pro_name'];
			
			//Pair capping boonus
			pairing_carry($p_userid);
			
			$subject="Re-newal details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Re-newal details from ".$website_name." </b></td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $p_userid (or) $p_email </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Phone : $p_phone </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Product : $p_name </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Qty : $p_qty </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Amount : $p_amount </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Pay Type : $p_type </td>
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
	$to=$p_email;
	$cmail=$com_obj->commonMail($to,$subject,$msg);
	
	$spn=$db->singlerec("select * from mlm_register where user_sponserid='$p_userid'");
	$r_email=$spn['user_email'];
	$r_userid=$spn['user_profileid'];
	$r_phone=$spn['user_phone'];
	$r_name=ucfirst($spn['user_fname']);
	
	$subjectt="Re-newal details from ".$website_name;
	$msgg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Re-newal details from ".$website_name." </b></td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $r_userid (or) $r_email </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Phone : $r_phone </td>
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
	$too=$r_email;
	$cmail=$com_obj->commonMail($too,$subjectt,$msgg);

			$db->insertrec("update mlm_purchase set pay_payment='1' where pay_txnid='$response[id]'");
			echo "<script>location.href='memberpackage.php?upd';</script>";
			header("Location: memberpackage.php?upd");
			exit;
			}
		}
		else {
			echo "<script>location.href='memberpackage.php?pyerr';</script>";
			header("Location: memberpackage.php?pyerr");
			exit;
		}
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

if(isset($_REQUEST['off'])) {
  
    $profileid=$_SESSION['profileid'];
	$pack=$_REQUEST['package'];
	$amount=$_REQUEST['totamt'];
	$product=$_REQUEST['pro'];
	$qty=$_REQUEST['qty'];
	$uInfo=$db->singlerec("select user_email from mlm_register where user_profileid='$profileid'");
	$ui=$db->singlerec("select * from mlm_register where user_profileid='$profileid'");
	$user_id=$ui['user_id'];
	$user_email=$ui['user_email'];
	$user_phone=$ui['user_phone'];
	$rankey=rand(0,99999); 
	$dat=date("Y-m-d");
	$time=date("Y-m-d h:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$set="profileid='$profileid'";
		$set.=",payment_id='$response[id]'";
		$set.=",pack='$pack'";
		$set.=",amount='$amount'";
		$set.=",qty='$qty'";
		$set.=",discount='$discount'";
		$set.=",paidamt='$paidamt'";
		$set.=",pay_type='offline'";
		$set.=",status='Pending'";
		//$set.=",longurl='$response[longurl]'";
		$set.=",ip_address='$ip'";
		$set.=",created_at='$time'";
		//$set.=",created_at='$response[created_at]'";
		//$set.=",modified_at='$response[modified_at]'";
		$set.=",modified_at='$time'";
		$sett="pay_userid='$profileid'";
		$sett.=",pay_user='$user_id'";
		$sett.=",pay_email='$user_email'";
		$sett.=",randomkey	='$rankey'";
		$sett.=",pay_phone='$user_phone'";
		$sett.=",pay_product='$product'";
		$sett.=",pay_amount='$amount'";
		$sett.=",pay_qty='$qty'";
		$sett.=",pay_type='offline'";
		//$sett.=",pay_txnid='$response[id]'";
		$sett.=",pay_date='$dat'";
		$sett.=",pay_ip='$ip'";
		$sett.=",pay_payment='0'";
		$sett.=",is_repurchase='0'";
		$db->insertrec("insert into mlm_mempayments set $set");
		$db->insertrec("insert into mlm_purchase set $sett");
		 echo "<script>location.href='memberpackage.php?sus';</script>";
		header("Location: memberpackage.php?sus");
		exit;
	
	}
	
?>
<script>
function detajax(str) {
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("resp").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","packajax.php?q="+str,true);
	xmlhttp.send();
}

function prd_cost(prd) {
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("prdcost").innerHTML=xmlhttp.responseText;
		document.getElementById("prcost").value=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","prd_discount.php?prd="+prd,true);
	xmlhttp.send();
}

function perupd(qty) {
	var prdcost=document.getElementById("prcost").value;
	var memamt=document.getElementById("memamt").value;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var result=JSON.parse(xmlhttp.responseText);
		document.getElementById("discount").innerHTML=result.discount;
		document.getElementById("totamt").innerHTML=result.totamt;
		document.getElementById("tot_amt").value=result.totamt;
		}
	  }
	xmlhttp.open("GET","prd_discount.php?memamt="+memamt+"&prdcost="+prdcost+"&qty="+qty,true);
	xmlhttp.send();
}
</script>
</head>
    <body>
		<div class="container main">
			<?php include("includes/header.php"); ?>
			<hr />
			<?php include("includes/profileheader.php");	?>
			<hr />
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="well" style="padding-right: 0;">
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Member Package</h4>
							<?php
							$ismemExpired=$ext_obj->ismemExpired($_SESSION['profileid']);
							if($ismemExpired) {
							$renewIn=$ext_obj->renewIn();
							
							
							?>
							
							<form action="" method="post" >
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php
									if($renewIn<=10) { ?>
									<tr><td colspan="3" align="center" style="color:red; font-weight:bold;">Your plan has been expired. You need to upgrade your plan within <?php echo $renewIn." days"; ?> to continue using our service.</td></tr>
									<?php } ?>
									<?php
									if(isset($_REQUEST['pyerr'])) { ?>
									<tr><td colspan="3" align="center" style="color:red; font-weight:bold;">Upgrade failed. Please try again!</td></tr>
									<?php } 
									?>
									<?php
									if(isset($_REQUEST['sus'])) { ?>
									<tr><td colspan="3" align="center" style="color:green; font-weight:bold; ">Your membership details will show after approval from admin</td></tr>
									<?php } 
									?>
									<tr>
										<td width="36%" align="right"><strong>Choose package</strong></td>
										<td width="3%" align="center">:</td>
										<td width="76%">
										<?php $sql=$db->get_all("select * from mlm_membership order by id ASC"); ?>
										<select style="width: 65%;" class="form-control" id="pack" name="package" onchange="return detajax(this.value);" required>
										<option value="">select</option>
										<?php foreach($sql as $rowfetch) { ?>
										<option value="<?php echo $rowfetch['id']; ?>"><?php echo $rowfetch['membership_name']; ?></option>
										<?php } ?>
										</select>
										
										</td>
									</tr>
									<tr>
									<td colspan="4">
									<div id="resp"></div>
									</td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<input type="submit" name="__upd"  class="btn btn-success greenbtn" value="Online Payment"/>
											<a  data-toggle="collapse" href="#collapseExample"  aria-expanded="false" aria-controls="collapseExample" class="btn btn-danger" >Offline Payment</a>
											
										</td>
										<table cellpadding="7" cellspacing="0" border="0" width="80%">
										<div class="collapse" id="collapseExample">
										  <div class="well">
										   <div class="row">
											<?  $bank_detail=$db->singlerec("select * from mlm_bank where id='1' ") ?>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Account Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" value="<? echo $bank_detail['acc_name']?>" readonly class="form-control" placeholder="Email">
												</div>
											  </div>
											  <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Account Number</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly value="<? echo $bank_detail['acc_no']?>"  class="form-control" placeholder="Email">
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input  type="text" class="form-control" placeholder="Email" value="<? echo $bank_detail['bank_name']?>" readonly>
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">IFSC Code</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly  value="<? echo $bank_detail['ifsc_code']?>" class="form-control" placeholder="Email">
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Branch Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly   class="form-control" value="<? echo $bank_detail['branch_name']?>"placeholder="Email">
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
												  <input type="submit"  class="btn btn-primary" name="off" value="Submit"/>
												</div>
											  </div>
											
											</div>
										  </div>
										</div>
										</table>
									</tr>
									
								</table>
								</form>
								<?php
								} else {
								$updInfo=$com_obj->singlerec("select * from mlm_mempayments where profileid='$userdetail[user_profileid]' order by id desc");
								$memInfo=$com_obj->singlerec("select * from mlm_membership where id='$updInfo[pack]'");
								?>
									<table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php
									if($updInfo['status']=='Completed') { ?>
									<tr><td colspan="3" align="center" style="color:#006633; font-weight:bold;">Package upgraded successfully !</td></tr>
									<?php } ?>
									<tr>
									<td colspan="3" align="center" style="font-weight:bold;">
									<h3>Your subscribed Package : <?php echo $memInfo['membership_name']; ?></h3>
									<br><span>Validity : <?php echo $memInfo['days']." days"; ?></span>
									<br><span>Last Upgraded : <?php echo !empty($updInfo['created_at'])?date("d-m-Y H:i:s", strtotime($updInfo['created_at'])):"---"; ?></span>
									<br><span>Expires in : <?php echo $ext_obj->expiresIn($updInfo['created_at'],$memInfo['days'])." days"; ?></span>
									</td>
									</tr>
									</table>
								<?php } ?>
							</div>
                        </div>
                    </div>
                    <br />
					<?php include "includes/login-access-ads.php";?>
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
			
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>