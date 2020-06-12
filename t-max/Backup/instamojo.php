<?php
include "admin/AMframe/config.php";
include "config/instamojo.php";
include "pairing-capping.php";

//define(API_KEY, $API_KEY);
//define(AUTH_TOKEN, $AUTH_TOKEN);
$Instamojo=new Instamojo($API_KEY, $AUTH_TOKEN, $AUTH_URL);
$sid=isset($_SESSION['sid'])?$_SESSION['sid']:'';
if(isset($payMem)) {
	$memid=base64_decode($mem);
	$profileid=addslashes($profileid);
	$uInfo=$db->singlerec("select user_email,user_id,user_phone from mlm_register where user_profileid='$profileid'");
	$user_id=$uInfo['user_id'];
	$user_email=$uInfo['user_email'];
	$user_phone=$uInfo['user_phone'];
	$memInfo=$db->singlerec("select * from mlm_membership where id='$memid'");
	try {
		$response=$Instamojo->paymentRequestCreate(array(
			"purpose" => $memInfo['membership_name'],
			"amount" => $memInfo['act_amount'],
			"send_email" => true,
			"email" => $uInfo['user_email'],
			"redirect_url" => $website_url."/instamojo.php"
		));
		$dayys=$memInfo['days'];
		$exdate=date('Y-m-d', strtotime(date('Y-m-d')." + ". $dayys." days")); 
		$created_at=date('Y-m-d h:i:s', strtotime($response['created_at']));
		$modified_at=date('Y-m-d h:i:s', strtotime($response['modified_at']));
		$ip=$_SERVER['REMOTE_ADDR'];
		$set="profileid='$profileid'";
		$set.=",payment_id='$response[id]'";
		$set.=",pack='$memid'";
		$set.=",amount='$memInfo[act_amount]'";
		$set.=",paidamt='$memInfo[act_amount]'";
		$set.=",status='$response[status]'";
		$set.=",longurl='$response[longurl]'";
		$set.=",ip_address='$ip'";
		$set.=",pay_type='Instamojo'";
		$set.=",created_at='$created_at'";
		$set.=",modified_at='$modified_at'";
		$set.=",ex_date='$exdate'";
		$db->insertrec("insert into mlm_mempayments set $set");
		$rankey=rand(0,99999); 
		$dat=date("Y-m-d");
		$sett="pay_userid='$profileid'";
		$sett.=",pay_user='$user_id'";
		$sett.=",pay_email='$user_email'";
		$sett.=",randomkey	='$rankey'";
		$sett.=",pay_phone='$user_phone'";
		$sett.=",pay_amount='$memInfo[act_amount]'";
		$sett.=",pay_type='Instamojo'";
		$sett.=",pay_txnid='$response[id]'";
		$sett.=",pay_date='$dat'";
		$sett.=",pay_ip='$ip'";
		$db->insertrec("insert into mlm_purchase set $sett");
		$db->insertrec("UPDATE mlm_register set mem_package='$memid' where user_profileid='$profileid'");
			echo "<script>location.href='$response[longurl]';</script>";
			header("Location: $response[longurl]");
			exit;
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

else if(isset($payment_id) && isset($payment_request_id)) {
	try {
		$response=$Instamojo->paymentRequestStatus($payment_request_id);
		$modified_at=date('Y-m-d h:i:s', strtotime($response['modified_at']));
		$set="status='$response[status]'";
		$set.=",modified_at='$modified_at'";
		$db->insertrec("update mlm_mempayments set $set where payment_id='$payment_request_id'");
		if($response['status']=="Completed") {
			$db->insertrec("update mlm_purchase set pay_payment='1' where pay_txnid='$response[id]'");
			$UserInfo=$db->singlerec("select profileid,amount from mlm_mempayments where payment_id='$payment_request_id'");
			$ret=$com_obj->refBonus($UserInfo['profileid'], $UserInfo['amount']);
			
			//Pair capping bonus
			//pairing_carry($UserInfo['profileid']);
			
			$spid=$ret;
			$sel=$db->singlerec("select * from mlm_payout where id='$spid'");
			$spind=$sel['user_id'];
			$usid=$sel['from_id'];
			$amount=$sel['amount'];
			$status=$sel['status'];
			if($status==0){
				$alert="Admin hold on ur approval";
			}else{
				$alert="Approved";
			}
			$sur=$db->singlerec("select * from mlm_register where user_profileid='$usid'");
			$db->insertrec("UPDATE mlm_register set user_status='0',user_paymentstaus='1' where user_profileid='$usid'");
									
			//level bonus
			$com_obj->lvl_commission($UserInfo['profileid']);
			
			//rank updation
			updateRank($rank_type);
			
			$p_email=$sur['user_email'];
			$subject="Referral Bonus details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Referral Bonus details from ".$website_name." </b></td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $usid (or) $p_email </td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Amount : $amount </td>
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
	$to=$spind;
	//$cmail=$com_obj->commonMail($to,$subject,$msg);
			if(!empty($_SESSION['sid'])){
				unset($_SESSION['sid']);
				echo "<script>location.href='dashboard.php?succ';</script>";
				header("Location: dashboard.php?succ");
				exit;
			}else{
				echo "<script>location.href='login.php?succ';</script>";
				header("Location: login.php?succ");
				exit;
			}
		}
		else {
			echo "<script>location.href='login.php?pyerr';</script>";
			header("Location: login.php?pyerr");
			exit;
		}
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

else {
	echo "<script>location.href='index.php';</script>";
	header("Location: index.php");
	exit;
}
?>