<?php
include_once "config/error.php";

$q=$_REQUEST['q'];
//echo $q; exit;
if($_SESSION['security_code'] ==$_REQUEST['q'] && !empty($_SESSION['security_code'] ) ) {
	// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
	echo '<font style="color:#006633;">Valid Captcha !!!</font>';
	//unset($_SESSION['security_code']);
} else {
	// Insert your code for showing an error message here
	echo '<font style="color:#FF0000;">Invalid Captcha, Please try again !!!</font>';
}

?>