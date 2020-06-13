<?php
include "admin/AMframe/config.php";
include "config/instamojo.php";
//define(API_KEY, $API_KEY);
//define(AUTH_TOKEN, $AUTH_TOKEN);
$Instamojo=new Instamojo($API_KEY, $AUTH_TOKEN, $AUTH_URL);
if(isset($payment_id) && isset($payment_request_id)) {
	try {
		$response=$Instamojo->paymentRequestStatus($payment_request_id);
		if($response['status']=="Completed") {
			$set="pay_payment='1'";
			$com_obj->insertrec("update mlm_purchase set $set where pay_txnid='$payment_request_id'");
			$trans=$com_obj->singlerec("select * from mlm_purchase where pay_txnid='$payment_request_id'");
			$pid=$trans['pay_product'];
			$qty=$trans['pay_qty'];
			$usr=$trans['pay_userid'];
			$repur=$trans['is_repurchase'];
			$reducestock=$db->insertrec("update mlm_products set pro_stock= pro_stock - '$qty' where pro_id='$pid'");
			productbonus($pid,$usr,$qty,$repur);
			echo "<script>location.href='profile.php?prdsucc';</script>";
			header("Location: profile.php?prdsucc");
			exit;
		}
		else {
			echo "<script>location.href='profile.php?prdfail';</script>";
			header("Location: profile.php?prdfail");
			exit;
		}
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}
?>