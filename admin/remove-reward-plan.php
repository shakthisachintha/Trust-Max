<?php


include "AMframe/config.php";
include "includes/header.php";

$id=$_POST['id'];


$s=$db->insertrec("delete from reward_plans where id='$id'");

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
