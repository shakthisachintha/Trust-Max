<?
$ufname=isset($ufname)?$ufname:'';
$email=isset($email)?$email:'';
?>
<footer class="bg-white p-5">

	<div class="row">

		<div class="col-sm-3">
			<h4>&COPY; <?= date("Y") . " " . $website_title; ?> </h4><br />
			All rights are reserved.<br />
			<a href="terms.php">Terms of Service</a> | <a href="privacy.php">Privacy Policy</a>
		</div>

		<div class="col-sm-3">
			<h4>Contact Info</h4>
			<br />
			<?php
			$address = $db->singlerec("select * from mlm_address where addr_id='1'");
			?>
			<p><?php echo ucwords($address['addr_area']) . ", " . ucwords($address['addr_city']) . ", " . ucwords($address['addr_state']) . ", " . ucwords($address['addr_country']); ?> <br />
				<!--<?php echo $website_addr; ?> <br />-->
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
			<div class="col-sm-6 col-xs-6">
				<img width="16" height="16" alt="facebook" src="img/facebook.png" />&nbsp;<a href="<?= $gen_fb; ?>">Facebook</a>
			</div>
			<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
				<img width="16" height="16" alt="facebook" src="img/twitter.png" />&nbsp;<a href="<?= $gen_twitter; ?>">Twitter</a>
			</div>
			<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
				<img width="20" height="20" alt="facebook" src="img/skype.png" />&nbsp;<a href="<?= $gen_skype; ?>">Skype</a>
			</div>
			<div class="col-sm-6 col-xs-6" style="margin-top:15px;">
				<img width="16" height="16" alt="facebook" src="img/google-plus-icon.png" />&nbsp;<a href="<?= $gen_googleplus; ?>">Googleplus</a>
			</div>
		</div>
	</div>

</footer>


<!-- <div id="light" style="display:none;
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
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
	<tr>
	<td colspan="3">
</td>
</tr>
	<tr><td colspan="3">&nbsp;</td></tr>
</table>
	</form>				
</div> -->
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

filter: alpha(opacity=70);">&nbsp;</div>


<script type="text/javascript">
	function showpop()

	{



		document.getElementById('light').style.display = 'block';

		document.getElementById('fade').style.display = 'block';



	}
</script>



<script type="text/javascript">
	function hidepop()

	{



		document.getElementById('light').style.display = 'none';

		document.getElementById('fade').style.display = 'none';

	}
</script>


<?php

$nowip = $_SERVER['REMOTE_ADDR'];

if (!isset($_SESSION[$nowip])) {

	$_SESSION[$nowip] = "yes";

?>

	<script language="javascript">
		showpop();
	</script>

<?php } ?>