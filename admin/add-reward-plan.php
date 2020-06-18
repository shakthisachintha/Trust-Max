<?php


include "AMframe/config.php";
include "includes/header.php";

$name=$_POST['name'];
$points=$_POST['points'];
$color=$_POST['color'];

$s=$db->insertrec("insert into reward_plans (name,points,color) values('$name','$points','$color')");

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>
