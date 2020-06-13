<?php
include "admin/AMframe/config.php";
if(isset($qty) && isset($prdcost) && isset($memamt)) {
	$qty=addslashes($_REQUEST['qty']);
	$prdcost=addslashes($_REQUEST['prdcost']);
	$memamt=addslashes($_REQUEST['memamt']);
	$dis_per=$com_obj->productDiscountper($qty);
	$prdamt=bcmul($qty,$prdcost,0);
	$disamt=$memamt-($dis_per/100)*$memamt;
	$disamt=(int)$disamt;
	$tot_amt=bcadd($prdamt,$disamt,0);
	echo json_encode(array("totamt" => $tot_amt, "discount" => "$dis_per%"));
}
if(isset($prd)) {
	$prd=addslashes($_REQUEST['prd']);
	$prdInfo=$db->singlerec("select pro_cost from mlm_products where pro_id='$prd'");
	$pro_cost=(int)$prdInfo['pro_cost'];
	echo $pro_cost;
}
?>