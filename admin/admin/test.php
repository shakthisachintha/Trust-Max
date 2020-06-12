<pre>
<?php 
include "AMframe/config.php"; 
include_once('AMframe\common.php');

echo '$a';

$common = new Common;

$common->checkRank('INET2020059');





die();
// $pass = 'noReplyDev';
// include "AMframe/PHPMailer/PHPMailerAutoload.php"; 

// $mail = new PHPMailer;	
// $mail->SMTPDebug = 4;
// $mail->IsSMTP();    
// $mail->Host = 'sg2plcpnl0246.prod.sin2.secureserver.net';  
// $mail->SMTPAuth = true; 
// $mail->Username = 'no-reply@trust-max.com';         
// $mail->Password = $pass;      
// $mail->SMTPSecure = "tls";     
// $mail->Port = 587;
// $mail->setFrom('info@trust-max.com', 'Trust Max');
// $mail->addAddress('dev.nasir.khan@gmail.com', 'User');   
// $mail->IsHTML(true);   

// $mail->Subject = 'Testing PHP | Mailer';
// $mail->Body    = 'Now ican send maail through Trust Max';

// if(!$mail->send()) {
// 	$ret = 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
// 	$ret = "scs";
// }
// echo $ret;

?>
</pre>