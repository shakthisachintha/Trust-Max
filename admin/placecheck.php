<?php
include("admin/AMframe/config.php"); 

$placeid = $_REQUEST['placeid'];
$sponsorid = $_REQUEST['sponsorid'];
if($placeid != $sponsorid){
$ressult = profileidtoplacement($placeid,$sponsorid);
}
else{
$ressult=1;
}
if($ressult==1)
echo "1";
else
echo "2";
?>