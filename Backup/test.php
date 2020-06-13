<?
include "admin/AMframe/config.php"; 
include "pairing-capping.php";

$profileid="INET2019087";
$mem_pack_amt="50";

//echo $com_obj->refBonus($profileid, $mem_pack_amt);exit;

//echo $com_obj->lvl_commission($profileid);exit;

echo pairing_carry($profileid);exit;

?>