<?php
class paypal extends database {

function check_txnid($tnxid){
	global $link;
	return true;
	$valid_txnid = true;
	//get result set
	$singlerec = $this->singlerec("SELECT * FROM `payments` WHERE txnid = '$tnxid'", $link);
	if ($row = $singlerec) {
		$valid_txnid = false;
	}
	return $valid_txnid;
}

function check_price($price, $id){
	$valid_price = false;
	
	$singlerec = $this->singlerec("SELECT price FROM `membership` WHERE id = '$id'");
	$colstatus=$this->check1column("membership","price",$price);
	if ($colstatus != 0) {
		
			$num = (float)$singlerec['price'];
			if($num == $price){
				$valid_price = true;
			}
	
	}
	return $valid_price;
}

function updatePayments($data,$userid){
	global $link;
	
	if (is_array($data)) {
		$idval = $this->insertid("INSERT INTO `payments` (userid,txnid, payment_amount, payment_status, itemid, createdtime) VALUES (
				'".$userid."' ,
				'".$data['txn_id']."' ,
				'".$data['payment_amount']."' ,
				'".$data['payment_status']."' ,
				'".$data['item_number']."' ,
				'".date("Y-m-d H:i:s")."'
				)", $link);
		return $idval;
	}
}


}
?>