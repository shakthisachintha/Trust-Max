<?php
include("AMframe/config.php");
$profileId=addslashes($_REQUEST['reg_id']);


if(isset($profileId)) {
		
		$reg_emailct=$db->check1column('mlm_register','user_profileid',$profileId);
		if($reg_emailct==0)
			echo "1";
		else
			echo "0";
	}
?>