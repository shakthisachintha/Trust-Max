<?php
include "admin/AMframe/config.php"; 
$q = $_GET['q'];

if (filter_var($q, FILTER_SANITIZE_NUMBER_INT)) {
    echo "0";
}
else{
echo "2";
}

$fetch=$db->singlerec("select * from mlm_register where user_phone='$q' and user_status='0'");

$num=$db->numrows("select * from mlm_register where user_phone='$q' and user_status='0'");

if($num=='0')
{	
echo "4";
}
else if($num>='1')
{
echo "3";
}


?>
