<?php

static $plcemnt='';
function getplcemnt($profileid){
    GLOBAL $db; 
    GLOBAL $plcemnt;
	if(empty($plcemnt)){
		$plcemnt=array();
	}
	$getplce=$db->Extract_Single("select user_placementid from mlm_register where FIND_IN_SET(user_profileid,'$profileid') and user_status='0'");
	if(!empty($getplce)){
		 //$plcemnt[]=$getplce;
		 Array_push($plcemnt,$getplce);
	}
	if(!empty($getplce)){
		getplcemnt($getplce);
	}
	return $plcemnt;
}

Static $retval='';
function find_wing_pos($getuser,$userid){
	GLOBAL $db;
	GLOBAL $retval;
	$getuser=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_placementid,'$getuser')");
	if(!empty($getuser)){
		$usrs=explode(',',$getuser);
		if(in_array($userid,$usrs)){
		   $retval='1';
		}
		else{
			find_wing_pos($getuser,$userid);
		}
	}
	 return $retval;
}

function find_leg($sponsorid,$userid){
     GLOBAL $db;
	 GLOBAL $getuser;
	 GLOBAL $retval;
	 $getleft=$db->Extract_Single("select user_profileid from mlm_register where user_placementid='$sponsorid' and user_position='Left'");
	 if($getleft == $userid){
		 $position='Left';
	 }
	 else{
		$getposleft=find_wing_pos($getleft,$userid);
		if($getposleft == '1'){
		$position='Left';}
	 }
	 if(!empty($getuser)){
		$getuser=array();
	 }
	 $retval="0";
	  $getright=$db->Extract_Single("select user_profileid from mlm_register where user_placementid='$sponsorid' and user_position='Right'");
	 if($getright == $userid){
		 $position='Right';
	 }
	 else{
		$getposright=find_wing_pos($getright,$userid);
		if($getposright == '1'){
		$position='Right';}
	 } 
	 if(!empty($getuser)){
		$getuser=array();
	 }
	 $retval="0";
	 return $position;
}

function pairing_carry($profileid) {
	GLOBAL $db;
	GLOBAL $capping_payout_status;
	if($capping_payout_status == "enabled") {
		$plcids = getplcemnt($profileid);
		foreach($plcids as $plc) {
			$findleg = find_leg($plc,$profileid);
			if(!empty($findleg)) {
				$pack_id = $db->Extract_Single("select mem_package from mlm_register where user_profileid='$profileid'");
				$get_amt = $db->Extract_Single("select act_amount from mlm_membership where id='$pack_id'");
				$getCt = $db->singlerec("select count(*) as ct from mlm_pairing_carry where profile_id='$plc'");
				if($findleg == 'Left') {
					if($getCt['ct'] == 0) {
						$db->insertrec("insert into mlm_pairing_carry set profile_id='$plc',left_carry=left_carry+'$get_amt',pair_status='0',left_count=left_count+1");
					}
					else {
						$db->insertrec("update mlm_pairing_carry set left_carry=left_carry+'$get_amt',pair_status='1' where profile_id='$plc'");
					}
				}
				else {
					$db->insertrec("update mlm_pairing_carry set right_carry=right_carry+'$get_amt',pair_status='1',right_count=right_count+1 where profile_id='$plc'");
				}
				$carryDet = $db->singlerec("select left_carry,right_carry from mlm_pairing_carry where profile_id='$plc' and pair_status='1' and left_count!='0' and right_count!='0'");
				if(!empty($carryDet)) {
					$left_carry = $carryDet['left_carry'];
					$right_carry = $carryDet['right_carry'];
					if($left_carry > $right_carry) {
						$pair_capping = $right_carry;
						$lamount = $left_carry - $right_carry;
						$db->insertrec("update mlm_pairing_carry set left_carry='$lamount',right_carry='0' where profile_id='$plc'");
						pair_capping($plc,$pair_capping);
					}
					if($left_carry < $right_carry) {
						$pair_capping = $left_carry;
						$ramount = $right_carry - $left_carry;
						$db->insertrec("update mlm_pairing_carry set right_carry='$ramount',left_carry='0',pair_status='0' where profile_id='$plc'");
						pair_capping($plc,$pair_capping);
					}
					if($left_carry == $right_carry) {
						$db->insertrec("update mlm_pairing_carry set right_carry='0',left_carry='0' where profile_id='$plc'");
						pair_capping($plc,$left_carry);
					}
				}
			}
		}
	}
}

function pair_capping($profileId,$amt) {
	GLOBAL $db;
	$cur_date = date("Y-m-d");
	$db->insertrec("insert into mlm_pair_capping set profile_id='$profileId',amount='$amt',crc_dt='$cur_date'");
	$carryDet = $db->singlerec("select left_count,right_count from mlm_pairing_carry where profile_id='$profileId'");
	$left_count = $carryDet['left_count'];
	$right_count = $carryDet['right_count'];
	if($left_count > $right_count) {
		$left_update = $left_count - $right_count;
		$db->insertrec("update mlm_pairing_carry set left_count='$left_update',right_count='0' where profile_id='$profileId'");
	}
	if($left_count < $right_count) {
		$right_update = $right_count - $left_count;
		$db->insertrec("update mlm_pairing_carry set left_count='0',right_count='$right_update' where profile_id='$profileId'");
	}
	if($left_count == $right_count) {
		$db->insertrec("update mlm_pairing_carry set left_count='0',right_count='0' where profile_id='$profileId'");
	}
}
?>