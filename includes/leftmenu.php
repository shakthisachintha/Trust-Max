<div class="col-sm-3">
	<?php if(!isset($_SESSION['profileid'])) { ?>
	
	
	<h4 class="navbar-inner" style="color:#091647; line-height:40px;">Members Login</h4>
	<div class="service-box2">
		<div class="login">
		<form name="frontlogin" action="login.php" method="post">
			<input type="text" placeholder="Enter your E-mail / Profile id" id="username" name="profileid" required> 
			<input type="password" placeholder="Password" id="password" name="password" required>
			<a href="forgot.php" class="forgot">forgot password?</a>
			<input type="submit" class="btn btn-primary" name="login" id="login" value="Sign in">
		</form>
		</div>
	</div>
	<br class="clear" />
	<?php } ?>
	
	<h4 class="navbar-inner text-center" style="color:#FFF; line-height:40px; background-color: #81b41d;">Testimonials</h4>
	
	<div class="service-box2">
		<marquee onMouseOver="this.scrollAmount=0" onMouseOut="this.scrollAmount=2" scrollamount="2" direction="up" loop="true" width="100%" style="text-align:justify;">
				<p><?php
$select=$db->get_all("select * from mlm_testimonial  where test_status=0");
foreach($select as $test)
{
?>

<?php echo $test['test_comment']; ?>
</p>
<hr />
<?php } ?>
		</marquee>
	</div>
</div>