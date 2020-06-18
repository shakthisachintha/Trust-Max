<?php
include "PHPMailer/PHPMailerAutoload.php";

class common extends database {
	
	public $img_Name;
	public $finalLeftArr = [];
	public $finalRightArr = [];
	
	function drop_down($array,$getval,$getname){
		$list = "";
		for($astrn=1; $astrn<count($array); $astrn++){
			if($astrn == $getval)
				$list .= "<input type='radio' id='$getname' name='$getname' value='$astrn' checked>$array[$astrn] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			else	
				$list .= " <input type='radio' id='$getname' name='$getname' value='$astrn'>$array[$astrn]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		return $list;
	}
	//========================================================================	
	function dropdown($array,$getval,$getname){
		$list = "<option name='' value='0'>--select--</option>";
		for($astrn=1; $astrn<count($array); $astrn++){
			if($astrn == $getval)
				$list .= "<option value='$astrn' selected>$array[$astrn]</option>";
			else	
				$list .= "<option value='$astrn'>$array[$astrn]</option>";
		}
		return $list;
	}
	function dropdown_array_view($array,$getval){
		$ret = $array[$getval];
		return $ret;
	}
	//========================================================================	
	function drop_down_view($array,$getval){
		$list = "";
		for($astrn=1; $astrn<count($array); $astrn++){
			if($astrn == $getval)
				$list .= $array[$astrn];
		}
		return $list;
	}
	function counting_days(){
		$start = '2015-01-01';
		$end = date("Y/m/d");
		$diff = (strtotime($end)- strtotime($start))/24/3600; 
		
		return $diff;
	}
	//========================================================================	
	function drop_down_mail($array,$getval){
		$list = $array[$getval];
		return $list;
	}
	//========================================================================	
	function first_letter($string){
		$expr = '/(?<=\s|^)[a-z]/i';
		preg_match_all($expr, $string, $matches);
		$result = implode('', $matches[0]);
		$result = strtoupper($result);
		return $result;
	}
	//========================================================================	
	function int_val($string){
		$ret = preg_replace("/[^0-9]/","",$string);
		return $ret;
	}
	//=======================================================================
	function character($string){
		$ret = preg_replace('/[^A-Za-z]/', '', $string);
		return $ret;
	}
	//=======================================================================
	function user_profile_id($getid){
		$array = array("","00000","0000","000","00","0");
		$charval = preg_replace('/[^A-Za-z]/', '', $getid);
		$getrec = database::singlerec("select user_profileid from register where user_profileid like '%$charval%' order by user_profileid desc");
		$userprofileid = $getrec['user_profileid'];
		if($userprofileid=="")
			$userprofileid=$getid;

		$intval = preg_replace("/[^0-9]/","",$userprofileid);
		$incval = bcadd($intval,1,0);
		$stlen = strlen($incval);
		$zero = $array[$stlen];
		$ret = $charval.$zero.$incval;
		return $ret;
	}
	//========================================================================	
function hidecontrols($string){
	if($string == "Admin")
		$ret = "";
	else
		$ret = "<style>.btn-default{display:none;} .cntrhid{display:none;}</style>";
	
	return $ret;
}
function datetimestamp($getdate){
	$DateArr = @split("/",$getdate);
	@list($bkDate,$bkMonth,$bkYear) = $DateArr;
	$ret = @mktime(0,0,0,$bkMonth,$bkDate,$bkYear);
	return $ret;
}
function expired_dt($call_dt,$tot_month){
	if($call_dt !=""){
		$DateArr = @split("/",$call_dt);
		@list($bkDate,$bkMonth,$bkYear) = $DateArr;
		$ret = @mktime(0,0,0,$bkMonth+$tot_month,$bkDate,$bkYear);
		$ret = date("d/m/Y",$ret);
	}
	else{
		$ret = "";
	}
	return $ret;
}
function opt_num(){
	$ret = mt_rand(100000, 999999);
	return $ret;
}
	
function email($to,$subject,$msg){
	GLOBAL $smtp_host;
	GLOBAL $smtp_port;
	GLOBAL $smtp_user;
	GLOBAL $smtp_pass;
	GLOBAL $sitetitle;
	$from = $smtp_user;
	$mail = new PHPMailer;	
	$mail->IsSMTP();                           
	$mail->SMTPDebug = false;
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "ssl";
	$mail->Host = $smtp_host;  
	$mail->Port = $smtp_port;
	$mail->IsHTML(true);     
	$mail->Username = $from;         
	$mail->Password = $smtp_pass;      
	$mail->setFrom($from, $sitetitle);
	$mail->Subject = $subject;
	$mail->Body    = $msg;
	$mail->addAddress($to, 'User');   
	
	if(!$mail->send()) {
		$ret = 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$ret = "scs";
	}
	return $ret;
}
	
function email_multiple($from,$users,$subject,$msg){
	foreach($users as $user){
		$mail = new PHPMailer;	
		$mail->IsSMTP();                           
		$mail->SMTPDebug = false;
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "trailblazer.websitewelcome.com";  
		$mail->Port = 465;  
		$mail->IsHTML(true);     
		$mail->Username = "no-reply@smsemailmarketing.in";         
		$mail->Password = "dD}O-RnM#7]K";                         
		$mail->setFrom($from, 'E_Commerce MLM');      
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail->addAddress($user, 'User');
		if(!$mail->send()) {
			$ret = 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$ret = "scs";
		}
	}
	return $ret;
}

public function userName($profileid) {
	global $db;
	$userInfo=$db->singlerec("select user_fname,user_lname from mlm_register where user_profileid='$profileid' and user_status='0'");
	if(!empty($userInfo['user_fname'])) 
		return $userInfo['user_fname']." ".$userInfo['user_lname'];
	else return "";
}
	
public function firstUsr() {
	global $db;
	$uInfo=$db->singlerec("select user_profileid from mlm_register order by user_id asc");
	return $uInfo['user_profileid'];
}


function upload_image($name1,$name2,$width,$height,$path,$acn){
		$acn = isset($acn)?$acn:'new';
		$fpath = $_FILES[$name1]['tmp_name'];
		if(!empty($fpath)){
			$fpath = $_FILES[$name1]['tmp_name'] ;
			$fname = $_FILES[$name1]['name'];
			$image_info = getimagesize($_FILES[$name1]["tmp_name"]);
			$image_width = $image_info[0];
			$image_height = $image_info[1];
			
			$size=filesize($_FILES[$name1]['tmp_name']);
			$getext = substr(strrchr($fname, '.'), 1);
			$ext = strtolower($getext);
			
			if($size>1048576) { //1048576 Bytes =  MB
				$this->img_Err="File size exceeded";
				return false;
			}
			if($image_width<$width || $image_height<$height){ 
				$this->img_Err="Image size Too small";
				return false;
			}
			/* if(($image_width*$r2)!=($image_height*$r1)){ 
				$this->img_Err="Miss match aspect ratio";
				return false;
			} */
			
			if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif')
			{
				$NgImg = "$name2.$ext";
				$img_size = "$path/$NgImg";
				move_uploaded_file($fpath,$img_size);
								
				/*if (preg_match('/jpg|jpeg/i',$ext))
				$imageTmp=imagecreatefromjpeg($img_size);
				else if (preg_match('/png/i',$ext))
					$imageTmp=imagecreatefrompng($img_size);
				else if (preg_match('/gif/i',$ext))
					$imageTmp=imagecreatefromgif($img_size);
				else if (preg_match('/bmp/i',$ext))
					$imageTmp=imagecreatefrombmp($img_size);
				
				imagejpeg($imageTmp,$img_size,72);
				imagedestroy($imageTmp);*/
				if($ext != 'png'){
					if($image_width!=$width && $image_height!=$height){
						$resizeObj = new resize($img_size);
						$resizeObj -> resizeImage($width, $height, 'exact');
						$resizeObj -> saveImage($img_size, 72);
					}
				}
				
				$this->img_Name="$NgImg";
				$this->img_Err="ok";
				
				return true;
			}
			else{
				$this->img_Err="Missmatch file format";
				return false;
			}
		}else{
				$this->img_Err="Image missing";
				return false;
		}
}
	
// public function PlacementID($spnsrs) {
// 	global $db;
// 	$spnsrid=explode(",",$spnsrs);
// 	for($i=0;$i<count($spnsrid);$i++) {
// 		$sid=$spnsrid[$i];
// 		$spsrcnt=$db->singlerec("select count(*) as tot from mlm_register where user_placementid='$sid'");
// 		$spsrcnt=$spsrcnt['tot'];
// 		if($spsrcnt<2) { $this->placement=$sid; break; }
// 		if(($i+1)==count($spnsrid)) {
// 			$spnsr=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_sponserid, '$spnsrs') and user_status='0' order by user_id asc");
// 			if(!empty($spnsr)) self::PlacementID($spnsr);
// 		}
// 	}
// }
public function PlacementIDNew($spnsr) {
	global $db;

	$spsrcnt = $db->singlerec("select count(*) as tot from mlm_register where user_placementid='$spnsr'");
	$spsrcnt = $spsrcnt['tot'];

	if($spsrcnt < 2) {
		$leftId = $db->singlerec("select user_profileid from mlm_register where user_placementid='$spnsr' and user_position='Left'");
		if($leftId == false){
			$val = ['id'=> $spnsr, 'pos' => 'Left'];
			$this->placement = $val;
			return;
		}
		$rightId = $db->singlerec("select user_profileid from mlm_register where user_placementid='$spnsr' and user_position='Right'");
		if($rightId == false){
			$val = ['id'=> $spnsr, 'pos' => 'Right'];
			$this->placement = $val;
			return;
		}
	}

	if($spsrcnt == 2){
		$left = $db->singlerec("select user_profileid from mlm_register where user_placementid='$spnsr' and user_position='Left'");
		$left = $left['user_profileid'];
		$right = $db->singlerec("select user_profileid from mlm_register where user_placementid='$spnsr' and user_position='Right'");
		$right = $right['user_profileid'];
		$placement = $this->getSponsorPlacement($left, $right);
		$this->placement = $placement;
	}
}

public function getSponsorPlacement($left, $right){
	global $db;
	$val = null; 
	while (true){
		$leftId = $db->singlerec("select user_profileid from mlm_register where user_placementid='$left' and user_position='Left'");
		if($leftId == false){
			$val = ['id'=> $left, 'pos' => 'Left'];
			break;
		}
		$rightId = $db->singlerec("select user_profileid from mlm_register where user_placementid='$right' and user_position='Right'");
		if($rightId == false){
			$val = ['id'=> $right, 'pos' => 'Right'];
			break;
		}
		$left = $leftId['user_profileid'];
		$right = $rightId['user_profileid'];
	}
	return $val;
}


public function usrMemAmt($profileid) {
	global $db;
	$uInfo=$db->singlerec("select mem_package from mlm_register where user_profileid='$profileid'");
	$memInfo=$db->singlerec("select act_amount from mlm_membership where id='$uInfo[mem_package]'");
	return $memInfo['act_amount'];
}

public function refBonus($profileid, $paidAmt) {
	GLOBAL $db;
	GLOBAL $referral_payout_status;
	if($referral_payout_status == "enabled") {
		$uInfo=$db->singlerec("select user_sponserid,mem_package from mlm_register where user_profileid='$profileid'");
		$sponserid=$uInfo['user_sponserid'];
		$chkref=$db->singlerec("select id from mlm_payout where user_id='$sponserid' and from_id='$profileid' and bonus_type='0'");
		if($chkref['id']=="") {
			$cmInfo=$db->singlerec("select * from mlm_basic_comission");
			$cmType=$cmInfo['ref_bonustype'];
			$cmAmt=$cmInfo['ref_bonusamt'];
			if($cmType==0) $amt=$cmAmt;
			else $amt=($cmAmt/100)*$paidAmt; $amt=floor($amt);
			$date = date("Y-m-d h:i:s");
			$set="user_id='$sponserid'";
			$set.=",from_id='$profileid'";
			$set.=",amount='$amt'";
			$set.=",reason='Referal Bonus'";
			$set.=",bonus_type='0'";
			$set.=",date='$date'";
			$i=$db->insertid("insert into mlm_payout set $set");
			return $i;
		}
	}
}

public function completedPair($pid) {
	GLOBAL $db;
	$paircount=isset($paircount)?$paircount:'0';
	$pids=explode(",", $pid);
	foreach($pids as $profileid) {
		$spnsrcnt=$db->singlerec("select count(*) as tot from mlm_register where user_placementid='$profileid'");
		if($spnsrcnt['tot']>=2) $paircount++;
	}
	$spnsrs=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_placementid,'$pid')");
	if(!empty($spnsrs)) self::completedPair($spnsrs);
	return $paircount;
}
	
public function pairCommission($profileid) {
	GLOBAL $db;
	$paircount=self::completedPair($profileid);
	$pairAmt=$db->singlerec("select * from mlm_pair_comission where pair_from <='$paircount' and pair_to >='$paircount'");
	if(!empty($pairAmt)) {
		$percentage=$pairAmt['pair_amt'];
		$usrMemAmt=self::usrMemAmt($profileid);
		$comAmt=($percentage/100)*$usrMemAmt;
		$comAmt=floor($comAmt);
		if(!empty($comAmt)) {
			$time=time();
			$set="user_id='$profileid'";
			$set.=",amount='$comAmt'";
			$set.=",reason='Pair Bonus #$paircount'";
			$set.=",bonus_type='1'";
			$set.=",date='$time'";
			$db->insertrec("insert into mlm_payout set $set");
		}
	}
}

public function productDiscountper($purchaseCount) {
	GLOBAL $db;
	$disPer=$db->singlerec("select dis_amt from mlm_discount_plan where $purchaseCount between dis_from and dis_to");
	return (int)$disPer['dis_amt'];
}

public function productDiscount($profileid, $purchaseCount) {
	GLOBAL $db;
	$disPer=$db->singlerec("select dis_amt from mlm_discount_plan where $purchaseCount between dis_from and dis_to");
	if(!empty($disPer)) {
		$usrMemAmt=self::usrMemAmt($profileid);
		$disAmt=($disPer['dis_amt']/100)*$usrMemAmt;
	}
	else $disAmt=0;
	return floor($disAmt);
}

public function totalBal($profileid){
	GLOBAL $db;
	$getBal=$db->singlerec("select sum(amount) AS total from mlm_payout where user_id='$profileid' and status='1'");
	$getBal1=$db->singlerec("select sum(pay_amount) AS total from mlm_payoutcalc where pay_user='$profileid' and pay_calc_status='1'");
	$result=$getBal['total']+$getBal1['total'];		
	return floor($result);
}
public function newApprovedBal($profileid){
	GLOBAL $db;

	$dis = $db->get_all("select user_date from mlm_register where user_sponserid='$profileid'");
	$diTot = 0;
	foreach($dis as $di){
		$day = date('Y-m-d',strtotime("-1 days"));
		$dayDB = date('Y-m-d', strtotime($di['user_date']));
		if($dayDB <= $day){
			$diTot += 20;
		}
	}

	$drli = $db->get_all("select * from mlm_drl where sponsor_id='$profileid' and status=1");
	$drlTot = 0;
	foreach($drli as $drl){
		$day = date('Y-m-d',strtotime("-1 days"));
		$dayDB = date('Y-m-d', strtotime($drl['submitted_at']));
		if($dayDB <= $day){
			$drlTot = $drlTot + (($drl['amount'] * 5) / 100);
		}
	}

	$ri = $this->userPairsNew($profileid);
	$riTot = 0;
	foreach($ri['levels'] as $level){
		foreach($level['pairs'] as $pair){
			$day = date('Y-m-d',strtotime("-1 days"));
			$dayDB = date('Y-m-d', $pair[0]);
			if($dayDB <= $day){
				$riTot = $riTot + 20;
			}
		}

	}

	$ats = $db->get_all("select amount, drCr from mlm_transaction where user_id='$profileid'");
	$bal = 0;
	$dr = 0;
	$cr = 0;
	foreach($ats as $at){
		if($at['drCr'] == 1){
			$dr += $at['amount'];
		}else{
			$cr += $at['amount'];
		}
	}
	$bal = $dr - $cr;

	$total = ['di' => $diTot, 'drl' => floor($drlTot), 'ri' => floor($riTot), 'at' => floor($bal)];
	return $total;
}
public function newTotalBal($profileid){
	GLOBAL $db;

	$di = $db->singlerec("select count(*) AS total from mlm_register where user_sponserid='$profileid'");
	$di = $di['total'];
	$di = floor($di * 20);

	$drli = $db->get_all("select * from mlm_drl where sponsor_id='$profileid' and status=1");
	$drlTot = 0;
	foreach($drli as $drl){
		$drlTot += ($drl['amount'] * 5) / 100;
	}

	$ri = $this->userPairsNew($profileid);
	$ri = $ri['totalPairs'] * 20;

	$ats = $db->get_all("select amount, drCr from mlm_transaction where user_id='$profileid'");
	$bal = 0;
	$dr = 0;
	$cr = 0;
	foreach($ats as $at){
		if($at['drCr'] == 1){
			$dr += $at['amount'];
		}else{
			$cr += $at['amount'];
		}
	}
	$bal = $dr - $cr;


	$total = ['di' => $di, 'drl' => floor($drlTot), 'ri' => floor($ri), 'at' => $bal];
	return $total;
}
public function userReferalls($profileid){
	GLOBAL $db;
	$sponsors = $db->get_all("select user_profileid, user_fname, user_lname, user_country, user_state,user_city, user_position from mlm_register where user_sponserid='$profileid'");
	return $sponsors;
}

public function userPairsNew($profileid){
	GLOBAL $db;

	$spsrcnt = $db->singlerec("select count(*) as tot from mlm_register where user_placementid='$profileid'");
	$spsrcnt = $spsrcnt['tot'];
	if($spsrcnt > 1) {
		$leftId = $db->singlerec("select user_profileid as id, user_date as date, CONCAT(user_fname,' ',user_lname) as name from mlm_register where user_placementid='$profileid' and user_position='Left'");
		$rightId = $db->singlerec("select user_profileid as id, user_date as date, CONCAT(user_fname,' ',user_lname) as name from mlm_register where user_placementid='$profileid' and user_position='Right'");

		$this->rec($leftId['id'], 2);
		$this->finalLeftArr[] = ['level' => 1, 'count' => 1, 'id1' => $leftId];
		$left = $this->finalLeftArr;
		$this->finalLeftArr = [];
		
		$this->rec($rightId['id'], 2);
		$this->finalLeftArr[] = ['level' => 1, 'count' => 1, 'id1' => $rightId];
		$right = $this->finalLeftArr;
		$this->finalLeftArr = [];
		// print_r($right);
		
		$level = 1;
		$arrPair = [];
		$maxLevel = 1;
		$pairs = 0;
		$actPairs = 0;
		while($level <= $maxLevel){
			$counter = 0;
			$arLft = [];
			$arRit = [];
			for($i=0; $i < count($left); $i++){
				if($left[$i]['level'] > $maxLevel){
					$maxLevel = $left[$i]['level'];
				}
				if($left[$i]['level'] == $level){
					if($left[$i]['count'] > 1){
						array_push($arLft, $left[$i]['id1'],$left[$i]['id2']);
					}else{
						array_push($arLft, $left[$i]['id1']);
					}
				}
			}
			for($i=0; $i < count($right); $i++){
				if($right[$i]['level'] > $maxLevel){
					$maxLevel = $right[$i]['level'];
				}
				if($right[$i]['level'] == $level){
					if($right[$i]['count'] > 1){
						array_push($arRit, $right[$i]['id1'],$right[$i]['id2']);
					}else{
						array_push($arRit, $right[$i]['id1']);
					}
				}
			}
			$countTot = 0;
			if(count($arLft) < count($arRit)){
				$countTot = count($arLft);
			}else{
				$countTot = count($arRit);
			}

			usort($arLft, function($a, $b) {
				$t1 = strtotime($a['date']);
    			$t2 = strtotime($b['date']);
				return $t1 - $t2;
			});
			usort($arRit, function($a, $b) {
				$t1 = strtotime($a['date']);
    			$t2 = strtotime($b['date']);
				return $t1 - $t2;
			});
			

			$arrMrg = [];
			
			for($i=0; $i < $countTot; $i++){
				$t1 = strtotime($arLft[$i]['date']);
				$t2 = strtotime($arRit[$i]['date']);
				
				$gratter = $t1;
				if($t1 >= $t2){
					$gratter = $t1;
				}else{
					$gratter = $t2;
				}

				$finalArr = [$gratter, $arLft[$i], $arRit[$i]];
				array_push($arrMrg, $finalArr);
				
				
			}
			$pairs += $countTot;
			$arrPair['totalPairs'] = $pairs;
			$arrPair['levels'][$level] = ['tot' => $countTot, 'pairs' => $arrMrg];

			$level++;
			// if($level > $maxLevel){
			// 	break;
			// }
		}
		return $arrPair;
	}else{
		echo 'No Child found';
	}
}

public function rec($id, $level){
	GLOBAL $db;
	$leftA = '';
	$rightB = '';
	$count = 0;
	
	$getIds = $db->get_all("select user_profileid as id, user_date as date, CONCAT(user_fname,' ',user_lname) as name from mlm_register where user_placementid='$id'");
	if($getIds != false){
		$count = count($getIds);
		if($count > 1){
			$leftA = $getIds[0]['id'];
			$rightB = $getIds[1]['id'];


			// $arr[$level] = $count;
			$arr[] = ['level' => $level, 'count' => $count, 'id1' => $getIds[0], 'id2' => $getIds[1]];

			$this->finalLeftArr = array_merge($this->finalLeftArr, $arr);
			// print_r($this->finalLeftArr);
			// echo '<br>';
			$level++;
			$this->rec($leftA, $level);
			$this->rec($rightB, $level);
		}elseif($count == 1){

			// $arr[$level] = $count;
			$leftA = $getIds[0]['id'];
			
			$arr[] = ['level' => $level, 'count' => $count, 'id1' => $getIds[0]];
			$this->finalLeftArr = array_merge($this->finalLeftArr, $arr);
			// print_r($this->finalLeftArr);
			// echo '<br>';
			$level++;
			$this->rec($leftA, $level);
		}
	}
}

public function withdrawBal($profileid){
	GLOBAL $db;
	$getBal=$db->singlerec("select sum(req_cvamount) AS total from mlm_withdrawrequsets where req_profileid='$profileid' and req_rpstatus='1'");
	$result=$getBal['total'];
	return floor($result);
}

public function availBal($tot,$with){
	$sum=$tot-$with;
	return floor($sum);
}

public function blankSpace($usrprofileid){
	GLOBAL $db;
	$pid=explode(",",$usrprofileid);
	foreach($pid as $profileid) {
		$placement=$db->singlerec("select count(*) as tot from mlm_register where user_placementid='$profileid'");
		$placement=(int)$placement['tot'];
		if($placement<2) $_SESSION['blankspc'][]=$profileid;
	}
	$nxtusers=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_placementid, '$usrprofileid')");
	if(!empty($nxtusers)) self::blankSpace($nxtusers);
}

public function checkRank($profileid){
	GLOBAL $db;

	$spsrcnt = $db->singlerec("select count(*) as tot from mlm_register where user_placementid='$profileid'");

	$user = $db->singlerec("select user_rank from mlm_register where user_profileid='$profileid'");
	$sponsors = $db->singlerec("select count(*) as tot from mlm_register where user_sponserid='$profileid'");
	if($user['user_rank'] == 1 || $user['user_rank'] == null){
		if($this->rankEd($sponsors)){
			$this->updateRank($profileid, 2);
			return 2;
		}
		return 1;
	}
	$spsrcnt = $spsrcnt['tot'];
	if($spsrcnt > 1) {
		$leftId = $db->singlerec("select user_profileid as id, user_date as date, CONCAT(user_fname,' ',user_lname) as name from mlm_register where user_placementid='$profileid' and user_position='Left'");
		$rightId = $db->singlerec("select user_profileid as id, user_date as date, CONCAT(user_fname,' ',user_lname) as name from mlm_register where user_placementid='$profileid' and user_position='Right'");

		$this->rec($leftId['id'], 2);
		$this->finalLeftArr[] = ['level' => 1, 'count' => 1, 'id1' => $leftId];
		
		$left = $this->finalLeftArr;
		$leftIds = '';
		foreach($left as $lf){
			$leftIds .= $lf['id1']['id'].',';
			if(isset($lf['id2'])){
				$leftIds .= $lf['id2']['id'].',';
			}
		}

		$this->finalLeftArr = [];
		
		$this->rec($rightId['id'], 2);
		$this->finalLeftArr[] = ['level' => 1, 'count' => 1, 'id1' => $rightId];
		$right = $this->finalLeftArr;
		$rightIds = '';
		foreach($right as $rt){
			$rightIds .= $rt['id1']['id'].',';
			if(isset($rt['id2'])){
				$rightIds .= $rt['id2']['id'].',';
			}
		}

		if($user['user_rank'] == 2){
		if($this->rankDm($sponsors)){
			// $this->updateRank($profileid, 2);
			return 3;
		}
		return 2;
	}
	}
}
public function rankEd($sponsors){
	if($sponsors > 1){
		return true;
	}
	return false;
}
public function rankDm($sponsors){
	return false;
	if($sponsors > 1){
		return true;
	}
}
public function updateRank($id, $r){
	GLOBAL $db;
	$insert = $db->insertrec("UPDATE mlm_register set user_rank = '$r' WHERE user_profileid = '$id'");
	return true; 
}

public function commonMail($to,$subject,$msg){
	$pass = 'noReplyDev';

    $mail = new PHPMailer;	
    $mail->SMTPDebug = 4;
    $mail->IsSMTP();    
	$mail->Host = 'sg2plcpnl0246.prod.sin2.secureserver.net';  
	$mail->SMTPAuth = true; 
	$mail->Username = 'no-reply@trust-max.com';         
	$mail->Password = $pass;      
	$mail->SMTPSecure = "tls";     
    $mail->Port = 587;
	$mail->setFrom('info@trust-max.com', 'Trust-Max');
	$mail->addAddress($to, 'User');   
    $mail->IsHTML(true);   

	$mail->Subject = $subject;
	$mail->Body    = $msg;
	
	if(!$mail->send()) {
		$ret = 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$ret = "scs";
	}
	return $ret;
}
public function commonMaildl($to,$subject,$msg){
	$pass = 'noReplyDev';

    $mail = new PHPMailer;	
    $mail->SMTPDebug = 4;
    $mail->IsSMTP();    
	$mail->Host = 'sg2plcpnl0246.prod.sin2.secureserver.net';  
	$mail->SMTPAuth = true; 
	$mail->Username = 'no-reply@trust-max.com';         
	$mail->Password = $pass;      
	$mail->SMTPSecure = "tls";     
    $mail->Port = 587;
	$mail->setFrom('info@trust-max.com', 'Trust-Max');
	$mail->addAddress($to, 'User');   
    $mail->IsHTML(true);   

	$mail->Subject = $subject;
	$mail->Body    = $msg;
	
	if(!$mail->send()) {
		$ret = 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		$ret = "scs";
	}
}

public function getplcemnt($profileid,$level){
	GLOBAL $db;
	GLOBAL $plcemnt;  
	if(empty($plcemnt)){
		$plcemnt=array();
	}	
	
	$getplce=$db->Extract_Single("select user_placementid from mlm_register where FIND_IN_SET(user_profileid,'$profileid')");
	$plc=$db->Extract_Single("select count(user_placementid) as ct from mlm_register where FIND_IN_SET(user_profileid,'$profileid')");
	if(!empty($getplce)){ 
		 if($plc <= $level-1){
			 //$plcemnt[]=$getplce;
			 Array_push($plcemnt,$getplce);
			 self::getplcemnt($getplce,$level);
		 }	 
	}
	return $plcemnt;
}
public function getplcemnt1($profileid,$level){
	GLOBAL $db;
	GLOBAL $plcemnt;
	$getplce=$db->Extract_Single("select user_placementid from mlm_register where FIND_IN_SET(user_profileid,'$profileid')");
	if(!empty($getplce)){
		 $plcemnt[]=$getplce;
	}
	if(!empty($getplce)){
		self::getplcemnt1($getplce);
	}
	return $plcemnt;
}

static $tot=array();
public function Usr_Downline($profileid){
	GLOBAL $db;
	GLOBAL $tot;
	$getusr=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_placementid,'$profileid') and user_status='0' and mem_package <> '0'");
	if(!empty($getusr)) {
		$tot[]=$getusr;
	}
	if(!empty($getusr)) {
		self::Usr_Downline($getusr);
	}
	return $tot;
} 

static $lvl=1;
public function userLevel($lvusr, $currusr, $recur=0) {
	GLOBAL $db;
	GLOBAL $lvl;
	if(!$recur) $lvl=1;
	$plcmnt = $db->singlerec("select user_placementid from mlm_register where user_profileid='$lvusr'");
	$plcmnt = $plcmnt['user_placementid'];
	if(!empty($plcmnt) && $currusr!=$plcmnt) { $lvl++; self::userLevel($plcmnt,$currusr, 1); }
	return $lvl;
}
	
public function paymentcalc($arr_id){
	GLOBAL $db;
	$amount="";
	foreach($arr_id as $pid){
		$puid=$db->extract_single("Select mem_package from mlm_register where user_profileid='$pid'");
		$getamount=$db->extract_single("Select act_amount from mlm_membership where id='$puid'");
		$amount += $getamount;
	}
	return $amount;
}

public function lvl_commission($profileid)
{ 
	GLOBAL $db;
	GLOBAL $tot;
	GLOBAL $level_payout_status;
	
	if($level_payout_status =='enabled')
	{
		$date=date('Y-m-d H:i:s');
		$commlvl=$db->Extract_Single("select level from mlm_level_commission where status='1' order by level desc limit 1");
		$plcid=self::getplcemnt($profileid,$commlvl);
		foreach($plcid as $key=>$plcmnt){
			$u_lvl1=self::Usr_Downline($plcmnt);
			if(!empty($u_lvl1)){
			   $tot=array();
			}
			 $level=0;
			foreach($u_lvl1 as $u_lvl){			
				$level++;
				$levell1="level".$level;
				$levelbonus_check = $db->Extract_Single("select count(id) from mlm_payout where user_id='$plcmnt' and bonus_type='2' and reason='$levell1'");
				if($level<=$commlvl && $levelbonus_check == 0){			 
					$power_count=pow(2,$level);
					$spnid=$u_lvl;
					$arr_id=explode(",",$spnid);
					$ustcnt=count($arr_id);
					if($power_count==$ustcnt){
						$total_amount=self::paymentcalc($arr_id);
						$getcommissionpercentage=$db->extract_single("select percentage from mlm_level_commission where level='$level'");
						if(!empty($getcommissionpercentage)){
							$comm_amount=$total_amount*($getcommissionpercentage/100);
							$date = date("Y-m-d h:i:s");
							$set = "user_id = '$plcmnt'";
							$set .= ", amount= '$comm_amount'";
							$set .= ", reason= '$levell1'";
							$set .= ", bonus_type= '2'";
							$set .= ", status= '0'";
							$set .= ", date='$date'";
							$insertrec=$db->insertrec("insert into mlm_payout set $set");
						}
					} 
				}
			} 
		}
	}
}

}
$GT_vadmin=1;
while(list($key,$value)=@each($_POST)) {
	$$key=$value;
}
while(list($key,$value)=@each($_GET)) {
    $$key=$value;
}
