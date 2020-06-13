<?
$ufname=isset($ufname)?$ufname:'';
$email=isset($email)?$email:'';
?>
<footer>

<hr />

<div class="row">

	<div class="col-sm-3">
		<h4>&COPY; <?=date("Y")." ".$website_title;?> </h4><br/>
		All rights are reserved.<br />
		<a href="terms.php">Terms of Service</a> | <a href="privacy.php">Privacy Policy</a>
	</div>

	<div class="col-sm-3">
		<h4>Contact Info</h4>
		<br />
		<p>
			<?php echo $website_addr; ?> <br />
			Tell : <?php echo $website_phone; ?>
		</p>
	</div>

	<div class="col-sm-3">
		<h4>Quick Navigation</h4>
		<br />
		<ul>
			<li><a href="about.php">About us</a></li>

			<li><a href="testimonials.php">Testimonials</a></li>

			<li><a href="faq.php">FAQ</a></li>

			<li><a href="contact.php">Contact us</a></li>

			<li><a href="docdownload.php">Download Document</a></li>
		</ul>
	</div>

	<div class="col-sm-3">
		<h4>Connect with us</h4>
		<br />
		<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
			<img width="16" height="16" alt="facebook" src="img/facebook.png" />&nbsp;<a href="<?=$gen_fb;?>">Facebook</a>
		</div>
		<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
			<img width="16" height="16" alt="facebook" src="img/twitter.png" />&nbsp;<a href="<?=$gen_twitter;?>">Twitter</a>
		</div>
		<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
			<img width="20" height="20" alt="facebook" src="img/skype.png" />&nbsp;<a href="<?=$gen_skype;?>">Skype</a>
		</div>
		<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
			<img width="16" height="16" alt="facebook" src="img/google-plus-icon.png" />&nbsp;<a href="<?=$gen_googleplus;?>">Googleplus</a>
		</div>
	</div>
</div>

</footer>
	

<div id="light" style="display:none;

position: fixed;

top: 15%;

left: 40%;

width: auto;



height:auto;

padding: 16px;

border: 10px solid #DB4E11;

border-radius:10px;

background-color: white;

z-index:1002;">

		<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" >

	<table>

	<tr>

	<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Daily Greetings<span style="float:right;">

		<img src="images/no.png" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';" style=" position: absolute;

margin: -31px 0px 0px 15px;

width: 18px;

z-index: 1003;" />


</span></td>

</tr>

<tr><td colspan="3">&nbsp;</td></tr>

	<tr>

	<td colspan="3">

<?php 					
/* echo $daily=$db->extract_single("select cms_greetings from mlm_cms where cms_id='1'"); 
					
$subject="Daily Greatings from ".$website_name;

$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
<tr bgcolor='#006699' height='25'>
<td><img src=".$logourl." border='0' width='200' height='60' /></td>
</tr>
			<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
			<tr bgcolor='#FFFFFF' height='30'>
			<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Reward Complete Details from ".$website_name." </b></td>
			</tr>

				
				<tr bgcolor='#FFFFFF' height='35'>
			<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $ufname, </td>
			</tr>
		
		<tr bgcolor='#FFFFFF' height='35'>
			<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>$welcome_mail_content</td>
			</tr>
		
				<tr bgcolor='#FFFFFF'>
<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
	".$website_name."<br>
</td>

</tr>
			<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
			<tr height='40'>

<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";
$to=$email;
$cmail=$com_obj->commonMail($to,$subject,$msg); */
?>


</td>

</tr>

	<tr><td colspan="3">&nbsp;</td></tr>
</table>
	</form>				
</div>

<div id="fade" style="display:none;

position: fixed;

top: 0%;

left: 0%;

width: 100%;

height: 200%;

background-color: black;			

z-index:1001;

-moz-opacity: 0.7;

opacity:.570;

filter: alpha(opacity=70);" >&nbsp;</div>


<script type="text/javascript">

function showpop()

{



document.getElementById('light').style.display='block';

document.getElementById('fade').style.display='block'; 



}

</script>



<script type="text/javascript">

function hidepop()

{



document.getElementById('light').style.display='none';

document.getElementById('fade').style.display='none'; 

}



</script>

<script type="text/javascript">

		head.js('http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js','js/scripts.js','js/mobile.js');

	</script>

<?php

$nowip=$_SERVER['REMOTE_ADDR'];

if(!isset($_SESSION[$nowip])) {

$_SESSION[$nowip]="yes";

?>

<script language="javascript">

showpop();

</script>

<?php } ?>