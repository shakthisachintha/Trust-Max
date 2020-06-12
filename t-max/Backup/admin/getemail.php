<?php
include("AMframe/config.php"); 
$q = $_GET['q'];

$sql="select * from mlm_register where user_email='$q' and user_status='0'";

$num=$db->numrows($sql);

if($num=='0')
{
echo "<span style='color:#006633;'>Valid Email !!!</span>";
}
else
{
echo "<span style='color:#FF0000;'>Already exists !!!</span>";
}


?>
