<?php
require 'phpmailer/PHPMailerAutoload.php';

class common extends database {
	
	public $img_Name;
	
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
	
public function PlacementID($spnsrs) {
	global $db;
	$spnsrid=explode(",",$spnsrs);
	for($i=0;$i<count($spnsrid);$i++) {
		$sid=$spnsrid[$i];
		$spsrcnt=$db->singlerec("select count(*) as tot from mlm_register where user_placementid='$sid'");
		$spsrcnt=$spsrcnt['tot'];
		if($spsrcnt<2) { $this->placement=$sid; break; }
		if(($i+1)==count($spnsrid)) {
			$spnsr=$db->Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_sponserid, '$spnsrs') and user_status='0' order by user_id asc");
			if(!empty($spnsr)) self::PlacementID($spnsr);
		}
	}
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

public function commonMail($to,$subject,$msg){
	GLOBAL $smtp_host;
	GLOBAL $smtp_port;
	GLOBAL $smtp_user;
	GLOBAL $smtp_pass;
	GLOBAL $website_name;
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
	$mail->setFrom($from, $website_name);
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
?>