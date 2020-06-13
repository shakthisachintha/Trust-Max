<?php
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');

session_start();
ob_start();
include "framedb.php";
include "global.php";
include "routing.php";
include "dropdownelement.php";
include "images.php";
include "common.php"; 
include "devices.php";
include "numtostr.php"; 
include "notification.php";
include "resize-class.php";
include "paypal.php";
include "emailtemplate.php"; 
include "functions.php";
include "pagination.php";
include "extra.php";

$db=new database();
$com_obj=new common();
$ext_obj = new extra();
$drop = new dropdown;
$imgobj = new images;
$notifyobj = new notification;
$paypal = new paypal;
$email_temp = new emailtemplate();

$ip_addr = $_SERVER['REMOTE_ADDR'];
$cur_date = date("Y-m-d h:i:s");
$live_page = $_SERVER['REQUEST_URI'];
$cur_url = basename($live_page);

function stripslashes_deep($value) {
    $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
    return $value;
}

/* Global values */
//Array For Advertisement
$GT_ad_pg = array("Select","Product","Product Detail","Login User Access","Product Sidebar 1", "Product Sidebar 2");
$GT_ad_dim = array("","728X90","728X90","728X90","300X250", "295X382");

$generalfetch = $db->singlerec("select * from mlm_generalsetting where gen_id='1'");
$generalfetch = stripslashes_deep($generalfetch);
$website_title =$generalfetch['gen_title'];
$website_name = $generalfetch['gen_sitename'];
$website_keywords =$generalfetch['gen_keywords'];
$website_desc=$generalfetch['gen_desc'];
$website_team=$generalfetch['gen_team'];
$website_admin =$generalfetch['gen_mail'];
$website_url =$generalfetch['gen_url'];
$paypal_id=$generalfetch['gen_paypal'];
$sitelogo=$generalfetch['gen_logo'];
$website_phone=$generalfetch['gen_phno'];
$website_addr=$generalfetch['gen_addr'];
$logourl = $website_url."/uploads/logo/".$sitelogo;
$sitecurrency = $generalfetch['gen_currency'];
$siteFavicon=$generalfetch['gen_favicon'];
$website_phone =$generalfetch['gen_phno'];
$website_skype = $generalfetch['admin_skype'];
$website_url =$generalfetch['gen_url'];
$designedBy=$generalfetch['design_name'];
$designedUrl=$generalfetch['design_url'];
$siteFooterlogo=$generalfetch['gen_footlogo'];
$gen_cvvalue=$generalfetch['gen_cvvalue'];
$gen_minwithdraw=$generalfetch['gen_minwithdraw'];
$gen_fundtransfer=$generalfetch['gen_fundtransfer'];
$gen_tax=$generalfetch['gen_tax'];
$gen_ceilcount=$generalfetch['gen_ceilcount'];
$siteAdminProfile=$generalfetch['admin_profile'];

$gen_startvalue=$generalfetch['gen_startvalue'];
$gen_need_reach=$generalfetch['gen_need_reach'];
$gen_maintain=$generalfetch['gen_maintain'];
$gen_binary_capping_type=$generalfetch['binary_capping_type'];
//$gen_binary_capping_amt=$generalfetch['binary_capping_amt'];
$gen_fb=$generalfetch['gen_fb'];
$gen_twitter=$generalfetch['gen_twitter'];
$gen_googleplus=$generalfetch['gen_googleplus'];
$gen_skype=$generalfetch['gen_skype'];

$API_KEY=$generalfetch['api_key'];
$AUTH_TOKEN=$generalfetch['auth_token'];

$AUTH_URL = 'https://test.instamojo.com/api/1.1/';

$gcommfetch = $db->singlerec("select * from mlm_basic_comission");
$gcommfetch = stripslashes_deep($gcommfetch);
$ref_tax=$gcommfetch['ref_tax'];

//Business settings details	
$businessDet = $db->singlerec("select * from mlm_business_settings where id='1'");
$businessDet = stripslashes_deep($businessDet);
$smtp_host = $businessDet['smtp_host'];
$smtp_port = $businessDet['smtp_port'];
$smtp_user = $businessDet['smtp_user'];
$smtp_pass = $businessDet['smtp_pass'];
$id_prefix = $businessDet['id_prefix'];
$epin_status = $businessDet['epin_status'];
$leg_selection = $businessDet['leg_selection'];
$rank_type = $businessDet['rank_type'];
$referral_payout_status = $businessDet['referral_payout_status'];
$level_payout_status = $businessDet['level_payout_status'];
$capping_payout_status = $businessDet['capping_payout_status'];
$wallet_withdraw_status = $businessDet['wallet_withdraw_status'];
$welcome_mail_content = $businessDet['welcome_mail_content'];

function getPageName()
{
	return basename($_SERVER['PHP_SELF']);
}

function generateid() 
{
	GLOBAL $db;
	GLOBAL $id_prefix;
	$selectregcount = $db->singlerec("SELECT * FROM mlm_reg_count WHERE reg_id=1");
	$renewdate=explode("-",$selectregcount['reg_date']);
	$currmonth=date("m");
	$currentyear=date("Y");
	if(($renewdate[0]<$currentyear) || ($renewdate[1]<$currmonth)) {
		$updateregcount=$db->insertrec("UPDATE mlm_reg_count SET reg_count=1, reg_date=NOW() WHERE reg_id=1");
		return $currentyear.$currmonth."1";
	} else {
		$currentcount=$selectregcount['reg_count']+1;
		$updateregcount=$db->insertrec("UPDATE mlm_reg_count SET reg_count=$currentcount WHERE reg_id=1");
		if(!empty($id_prefix)) {
			$prefix = $id_prefix;
		}
		else {
			$prefix = 'SBI';
		}
		return $prefix.$renewdate[0].$renewdate[1].$selectregcount['reg_count'];
	}
}
function getcity($id){
	GLOBAL $db;
	$city = $db->singlerec("SELECT * FROM `mlm_city` WHERE `city_id`='$id'");
	return $city[0];
}
function getstate($id){
	GLOBAL $db;
	$state = $db->singlerec("SELECT * FROM `mlm_state` WHERE `state_id`='$id'");
	return $state[0];
}

function get_Rate2($id){
 GLOBAL $db;
  $ratesum = $db->Extract_Single("select sum(stars) from mlm_reviews where product_id='$id' and status='1'");  
 $ratecount = $db->Extract_Single("select count(stars) from mlm_reviews where product_id='$id' and status='1'");  
  
 if($ratecount!=0){
  $actual_rate = ($ratesum/$ratecount); 
 }else{
  $actual_rate = 0;
 } 
 $actual_rate = number_format($actual_rate, 1, '.', '');
 
 $str="";
 $n=(int)$actual_rate;
 if($n!==0){
  for($i=1;$i<=5;$i++){
   if($i<=$n)
    $str.= "<span><i class='zmdi zmdi-star fa-stack-2x'></i></span>&nbsp;"; 
   else
    $str.= "<span><i class='zmdi zmdi-star'></i></span>&nbsp;";
  } 
  $str.=" &nbsp;<b>($actual_rate)</b>";
 }
 else{
  /* $str = "<i class='icon-star'></i>
  <i class='icon-star'></i>
  <i class='icon-star'></i>
  <i class='icon-star'></i>
  <i class='icon-star'></i>";  */
  $str = "<span style='color:#4285f4';>Not Rated Yet</span>"; 
 }
 
 return $str;
}

function getStar($n){
 $str="";
 if($n!==0){
  for($i=1;$i<=5;$i++){
   if($i <= $n)
   {
    $str.= "<i class='zmdi zmdi-star'></i>"; 
   }
   else
   {
   $str.= "<i class='zmdi zmdi-star-outline'></i>";}
  }
  $str.=" &nbsp;<b>($n.0)</b>";
 }else{
  $str = "Not rated yet"; 
 }
 return $str;
}

function getcountry($id){
	GLOBAL $db;
	$country = $db->singlerec("SELECT * FROM `mlm_country` WHERE `country_id`='$id'");
	return $country[0];
}
function getsubcategorydetailbyId($catid){
	GLOBAL $db;
	$subcat=$db->singlerec("select * from mlm_product_subcategory where subcategory_id='$catid'");
	return $subcat;
}
function getcategorydetailbyId($catid){
	GLOBAL $db;
	$cat=$db->singlerec("select * from mlm_product_category where category_id='$catid'");
	return $cat;
}
function getproductdetailbyId($productid){
	GLOBAL $db;
	$prods=$db->singlerec("select * from mlm_products where pro_id='$productid'");
	return $prods;
}
function gettotalamtbyepin($eepinn){
	GLOBAL $db;
	$epindet=$db->singlerec("select * from mlm_epin where epin='$eepinn'");
	$subcatdet = getsubcategorydetailbyId($epindet['prodsubcategory']);
	$productid = $subcatdet['product_id'];
	$minunit = $subcatdet['minunit'];
	$proddet = getproductdetailbyId($productid);
	$prodcost = $proddet['pro_cost'];
	$totalcost = ($prodcost*$minunit);
	return $totalcost;
}	
function gettotalearnings($user_profileid){
	GLOBAL $db;
	$row=$db->singlerec("select commearned from  mlm_pairmatch where profileid='$user_profileid'");
	$sum=0;
	while($row){
	$sum = $sum + $row['commearned'];
	}
	return $sum;
}
function gettotaldue($user_profileid){
	GLOBAL $db;
	$row=$db->singlerec("select commearned from mlm_pairmatch where is_payed='0' AND profileid='$user_profileid'");
	$upsum=0;
	while($row){
	$upsum = $upsum + $row['commearned'];
	}
	return $upsum;
}
function getBonusamount($profileid){
	GLOBAL $db;
	$result=$db->singlerec("select sum(amount) as total from mlm_payout where user_id='$profileid'");
	$totalamount=$result['total'];
	return $totalamount;
}
function getWithdrawalamount($profileid){
	GLOBAL $db;
	$result=$db->singlerec("select sum(req_cvamount) as total from mlm_withdrawrequsets where from_id='$req_profileid'");
	$totalamount=$result['total'];
	return $totalamount;
}
function getBalanceamount($profileid){
	GLOBAL $db;
	$result=$db->singlerec("select sum(req_cvamount) as total from mlm_withdrawrequsets where from_id='$req_profileid'");
	$totalamount=$result['total'];
	return $totalamount;
}	

 // Check Placement Below a Member
function profileidtoplacement($placementid,$sponsorid){
GLOBAL $db;
$fetch_placementid = $db->singlerec("SELECT user_placementid FROM `mlm_register` WHERE `user_profileid`='$placementid'");
$upid = $fetch_placementid['user_placementid'];
	if($upid!=''){
	$flag = 0;
	if($placementid == $sponsorid){
	$flag=1;
	}
	else if($sponsorid == $upid){
	$flag=1;
	}
	else{
	$flag=0;
	return profileidtoplacement($fetch_placementid['user_placementid'],$sponsorid);
	}
	return $flag;
	}
}
$total_count1=0;
function DownlineCountbin($prflid,$i){
	GLOBAL $db;
	if($i==L)
	{
		 $sql="SELECT * FROM mlm_register where user_sponserid='$prflid' and user_placement='L'";
	}
	else if($i==R)
	{
		 $sql="SELECT * FROM mlm_register where user_sponserid='$prflid' and user_placement='R'";
	}
	else
	{
		 $sql="SELECT * FROM mlm_register where user_sponserid='$prflid'";
	}
	$row=$db->singlerec($sql);
	global $total_count1;
	while($row)
		{
		  if($row['user_profileid']!=''){
			$total_count1=$total_count1+1;
			DownlineCountbin($row['user_profileid'],2);
		  }
		}
	return $total_count1;
}

function calculatepv($prflid,$i){
	 GLOBAL $db;
	 $sql="SELECT * FROM mlm_register where user_status='0' and user_sponserid='$prflid'";
	 $row=$db->singlerec($sql);
	 global $pvvtot;
	 $pp1=$db->singlerec("select * from mlm_purchase where pay_userid='$row[user_profileid]' and pay_payment=1"); 
	 while($pp1)
		 {
		 $chk=$db->singlerec("select * from mlm_target");
		 if($chk['target_id']==1)
			 {
				 $pvvtot=$pvvtot+$pp1['pay_amount'];
			 }
			 else if($chk['target_id']==3)
			 {
				 $pvvtot=$pvvtot+$pp1['pay_pv'];
			 }			
		 }
		if($row['user_profileid']!=''){
		calculatepv($row['user_profileid'],2);  
		} 
	return $pvvtot;
}
function user_referralbonus($user){
	GLOBAL $db;
	$amount=$db->singlerec("select sum(amount) as payout from mlm_payout where user_id='$user' and status='1' and bonus_type='0'");
	$referral_amount=$amount['payout'];
	return $referral_amount;
}
function productbonus($pid,$profileid,$qty,$repur)
{
	GLOBAL $db;
	$selusr=$db->singlerec("select * from mlm_register where user_profileid='$profileid'");
	$selpro=$db->singlerec("select * from mlm_products where pro_id='$pid'");
	$selusrs=$db->singlerec("select * from mlm_register where user_profileid='$selusr[user_sponserid]'");

	$dfhds=$selusrs['totalindirect_purbonus'];
	$dfhds1=$selusrs['totalindirect_repurbonus'];
	$pamt1=$selusr['totalpurchase_bonus'];
	$pamt11=$selusr['totalrepurchase_bonus'];
	$pamt2=$selpro['pro_cost'];
    
	$ppamt=$selpro['pro_bonus'];
	$ppamt1=$selpro['pro_repur_bonus'];
	$ippamt=$selpro['pro_indirect_bonus'];
	$ippamt1=$selpro['pro_repur_indirect_bonus'];
    
	if($repur == '0')
	{			
	$intotamt=$dfhds+($qty*$ippamt);
	$totamt=$pamt1+($qty*$ppamt);
	}
	elseif($repur == '1')
	{		
	$intotamt=$dfhds1+($qty*$ippamt1);
	$totamt=$pamt11+($qty*$ppamt1);
	}	
    if($repur == '0')
	{
	$uppper=$db->insertrec("update mlm_register set totalpurchase_bonus='$totamt' where user_profileid='$profileid'");	
	$purbonnns=$db->insertrec("insert into mlm_payoutcalc set pay_user='$profileid', 	pay_purchaseid='$pid',pay_amount='$ppamt',pay_reason='Purchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='0'");
	}
	elseif($repur == '1')
	{
		$uppper=$db->insertrec("update mlm_register set totalrepurchase_bonus='$totamt' where user_profileid='$profileid'");
		$purbonnns=$db->insertrec("insert into mlm_payoutcalc set pay_user='$profileid', 	pay_purchaseid='$pid',pay_amount='$ppamt1',pay_reason='Repurchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='1'");
	}
	$spon_id=$selusr['user_sponserid'];
	
	if(empty($spon_id)){
		return false;
	}	
	if($repur == '0')
	{
		$ssuppper=$db->insertrec("update mlm_register set totalindirect_purbonus='$intotamt' where user_profileid='$spon_id'");
		$inpurbonnns=$db->insertrec("insert into mlm_payoutcalc set pay_user='$spon_id',pay_purchaseid='$pid',pay_amount='$ippamt',pay_reason='Indirect Purchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='2'");
	}
	elseif($repur == '1'){
		$ssuppper=$db->insertrec("update mlm_register set totalindirect_repurbonus='$intotamt' where user_profileid='$spon_id'");
		$inpurbonnns=$db->insertrec("insert into mlm_payoutcalc set pay_user='$spon_id',pay_purchaseid='$pid',pay_amount='$ippamt1',pay_reason='Indirect Repurchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='3'");
	}
}
//sql injection prevention
function replace($val){
   $preg=preg_replace("/[^A-Za-z0-9]/","","$val"); 
   return $preg;
   }
//demo mode 
$demomode='false';

function checkLength($str,$len){
	$strs = (strlen($str)>$len)?substr($str,0,$len).'...':$str;
	return $strs;
}
// user rank calculate function by kowsalya
function updateRank($rank_type) {
	GLOBAL $db;
	$sponsor_ids = $db->Extract_Single("select r.user_sponserid from mlm_register r inner join mlm_mempayments m on r.user_profileid=m.profileid where r.user_status='0' and m.status='Completed' order by r.user_sponserid desc");
	$sponsor_ids = trim($sponsor_ids,",");
	$sponsor_arr = explode(",",$sponsor_ids);
	if($rank_type == "referral_ct") {
		$arr_val_count = array_count_values($sponsor_arr);
		arsort($arr_val_count);
		$rank = 0;
		$val = 0;
		foreach($arr_val_count as $key=>$value) {
			$userDet = $db->singlerec("select r.user_status,m.status from mlm_register r inner join mlm_mempayments m on r.user_profileid=m.profileid where r.user_profileid='$key'");
			$user_sts = $userDet['user_status'];
			$member_sts = $userDet['status'];
			if(($user_sts == 0) && ($member_sts == "Completed")){
				if($val != $value) {
					$rank++;
					$val = $value;
				}
				$db->insertrec("update mlm_register set user_rank='$rank' where user_profileid='$key'");
			}
		}
	}
	else {
		$arr_duplicate_rmv = array_unique($sponsor_arr);
		$string = '';
		foreach($arr_duplicate_rmv as $get_sponsor) {
			$userDet = $db->singlerec("select r.user_status,m.status from mlm_register r inner join mlm_mempayments m on r.user_profileid=m.profileid where r.user_profileid='$get_sponsor'");
			$user_sts = $userDet['user_status'];
			$member_sts = $userDet['status'];
			
			if(($user_sts == 0) && ($member_sts == "Completed")) {
				$pack = $db->singlerec("select sum(m.act_amount) as tot from mlm_membership m inner join mlm_register r on r.mem_package=m.id where r.user_sponserid='$get_sponsor'");
				$string .= $get_sponsor.','.$pack['tot'].'|';
			}
		}
		$string = trim($string,'|');
		$one=explode("|",$string);
		$array = array();
		foreach ($one as $item) {
			$array[] = explode(",",$item);
		}	
		class getData {  
			var $sponsor, $amount; 		  
			// Constructor for class initialization 
			public function getData($data) { 
				$this->sponsor = $data[0]; 
				$this->amount = $data[1];
			} 
		}		  
		// Function to convert array data to class object 
		function data2Object($data) { 
			$class_object = new getData($data); 
			return $class_object; 
		} 	  
		// Comparator function used for comparator
		function comparator($object1, $object2) {
			return $object1->amount < $object2->amount; 
		}
		$data = array_map('data2Object', $array);
		usort($data, 'comparator');		
		$rank = 0;
		$val = 0;
		foreach($data as $key=>$obj) {
			if($val != $obj->amount) {
				$rank++;
				$val = $obj->amount;
			}
			$db->insertrec("update mlm_register set user_rank='$rank' where user_profileid='$obj->sponsor'");
		}
	}
}
function product_purchase($proid,$user,$eepinn,$ptvalue) {
	GLOBAL $db;
	$product=$proid;
	$profileid=$user;
	$user_profileid=$profileid;
	$currip=$_SERVER['REMOTE_ADDR'];
	$amount=gettotalamtbyepin($eepinn);
	
	$usertable=$db->singlerec("SELECT * FROM mlm_register WHERE user_profileid='$profileid'");
	$productdata=$db->singlerec("SELECT * FROM mlm_products WHERE pro_id='$product'");
	$catid=$_SESSION['cateid'];
	$insert=$db->insertrec("INSERT INTO mlm_purchase (pay_user, pay_userid, randomkey, pay_category, pay_email, pay_phone, pay_product, pay_amount, pay_pv, pay_type, pay_date, pay_ip, pay_payment) VALUES ('$usertable[user_id]', '$profileid', '$eepinn','$catid', '$usertable[user_email]', '$usertable[user_phone]', '$productdata[pro_id]', '$productdata[pro_cost]', '$productdata[pro_pv]', 'Paypal', NOW(), '$currip', '1')");
	$stockupdate=$db->insertrec("UPDATE mlm_products SET pro_stock=pro_stock-1 WHERE pro_id='$productdata[pro_id]'");
	
	if($insert){
	return 1;
	}
	else{
	return 0;
	}
}
function stock_reduce($purchase_id,$prod_id,$qty)
{
	GLOBAL $db;
	$pay_stat=$db->singlerec("select pay_payment from mlm_purchase where pay_id='$purchase_id' and pay_product='$prod_id'");
	$paystat=$pay_stat[0];
	if($paystat == '1')
	{
		$reducestock=$db->insertrec("update mlm_products set pro_stock= pro_stock - '$qty' where pro_id='$prod_id'");
	}	
}
function stock_check($prod_id)
{
	GLOBAL $db;
	$prod_id=addslashes($prod_id);
	$pay_stat=$db->singlerec("select pro_stock from mlm_products where pro_id='$prod_id'");
	return $pay_stat['pro_stock'];
}
?>