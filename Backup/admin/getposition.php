<?php
include "AMframe/config.php"; 

if(isset($_GET['q'])) {
	$q = $_GET['q'];
	$usr=addslashes($_REQUEST['ussr']);

	$fetch=$db->singlerec("select * from mlm_register where user_placementid='$usr' and user_placement='$q' and user_status='0'");
	$num=$db->numrows("select * from mlm_register where user_placementid='$usr' and user_placement='$q' and user_status='0'");
	if($num=='0')
	{
		echo "<span style='color:#006633;'>proceed !!!</span>";
	}
	else
	{
		echo "<span style='color:#FF0000;'>Already exists another person !!!</span>";
	}
}

if(isset($spnsrid)) {
	$userName=$com_obj->userName($spnsrid);
	if(!empty($userName)) {
		$com_obj->PlacementID($spnsrid);
		$plce=$com_obj->placement;
		if(!empty($plce)){
			$dnLines=$db->Extract_Single("select user_profileid from mlm_register where user_placementid='$plce'");
			$usr_cnt = count($dnLines);
			if($usr_cnt==1){
				$Get_pos=$db->Extract_Single("select user_position from mlm_register where user_profileid='$dnLines'");
				if($Get_pos == "Left"){
					$getval=1;	
				}else{
					$getval=2;		
				}
			}else if(empty($dnLines)){
				$getval=3;	
			}
		}else{
		   $getval=3;	
		}
	echo trim($getval);
	}
}
?>
