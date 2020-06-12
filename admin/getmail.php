<?php
include "admin/AMframe/config.php"; 
$q = $_GET['q'];

if (filter_var($q, FILTER_VALIDATE_EMAIL)) {
    echo "0";
}
else{
echo "2";
}

$fetch=mysql_query("select * from mlm_register where user_email='$q' and user_status='0'");

$num=mysql_query("select * from mlm_register where user_email='$q' and user_status='0'");

if($num=='0')
{	
echo "4";
}
else if($num>='1')
{
echo "3";
}


?>
