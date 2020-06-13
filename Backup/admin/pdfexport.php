<?php
require "AMframe/config.php";
require "fpdf/fpdf.php";
$arr=urldecode($_REQUEST['arr']);
$arr=json_decode($arr, true);
$table=addslashes($_REQUEST['table']);
$que=urldecode($_REQUEST['que']);
$ext_obj->pdfExport($arr, $table ,$que);
?>