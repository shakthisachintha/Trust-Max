<?php
$from=isset($_REQUEST['from'])?$_REQUEST['from']:'';

$frm=++$from;
for($i=$frm;$i<=1000;$i++){
	echo "<option value='$i'>$i</option>";
}
?>
