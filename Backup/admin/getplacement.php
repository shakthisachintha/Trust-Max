<?php
include "AMframe/config.php";

if(isset($spnsrid)) {
	$userName=$com_obj->userName($spnsrid);
	if(!empty($userName)) {
		$com_obj->PlacementID($spnsrid);
		echo json_encode(array("placement"=>$com_obj->placement,"name"=>$userName));
	}
	else echo 0;
}
?>
