<?php
include "../admin/AMframe/config.php";
//cron for pairing capping - run once per day
$cur_date = date("Y-m-d");
if($gen_binary_capping_type == 'daily') {
	$qry = "crc_dt > DATE_SUB(NOW(), INTERVAL 1 DAY)";
}
else if($gen_binary_capping_type == 'weekly') {
	$qry = "crc_dt > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
}
else {
	$qry = "crc_dt > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
}


$getDets = $db->get_all("select * from mlm_pair_capping where status='0' and $qry group by profile_id order by id asc");
if(!empty($getDets)) {
	foreach($getDets as $getDet) {
		$row_id = $getDet['id'];
		$profile_id = $getDet['profile_id'];
		$getAmt = $db->singlerec("select sum(amount) as tot from mlm_pair_capping where status='0' and profile_id='$profile_id' and $qry order by id asc");
		$packDet = $db->singlerec("select m.capping_amt,r.mem_package from mlm_membership m,mlm_register r where r.user_profileid='$profile_id' and r.mem_package=m.id");
		$mem_capping = $packDet['capping_amt'];
		
		if($getAmt['tot'] > $mem_capping) {
			$wallet_amt = $mem_capping;
		}
		else {
			$wallet_amt = $getAmt['tot'];
		}
			
		$db->insertrec("update mlm_pair_capping set status='1',update_dt='$cur_date' where profile_id='$profile_id' and status='0'");
		$date=date("Y-m-d h:i:s");
		$set="user_id='$profile_id'";
		$set.=",amount='$wallet_amt'";
		$set.=",reason='pair-capping-to-wallet'";
		$set.=",bonus_type='2'";
		$set.=",date='$date'";
		$set.=",status='1'";
		
		$db->insertrec("insert into mlm_payout set $set");
	}
}
?>