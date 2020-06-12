<?php
$currentpagename=getPageName();
$withdraw_req_ct = $db->numrows("select * from mlm_withdrawrequsets where req_status='0' and req_userid='$_SESSION[userid]'");
$withdraw_cancel_ct = $db->numrows("select * from mlm_withdrawrequsets where req_status='1' and req_userid='$_SESSION[userid]'");
?>

<div class="col-sm-3">

	<h4 class="navbar-inner text-center" style="color:#FFF; line-height:40px; background-color: #81b41d;">Profile menu</h4>

	<div class="service-box2">

		<ul class="proleftmenu prfl_lft_menu">
			
			<!--<li>
				<a href="index.php" class="leftmenua">
					Home
				</a>
			</li>-->
			
			<li <?php if($currentpagename=="dashboard.php") { echo 'class="current"'; } ?>>
				<a href="dashboard.php" class="leftmenua">
					Dashboard
				</a>
			</li>

			<!-- <li <?php if($currentpagename=="profile.php") { echo 'class="current"'; } ?>>
				<a href="profile.php" class="leftmenua">
					Purchased History
				</a>
			</li> -->
			<li <?php if($currentpagename=="fullprofile.php") { echo 'class="current"'; } ?>>
				<a href="fullprofile.php" class="leftmenua">
					Profile
				</a>
			</li>

			<li <?php if($currentpagename=="drlIncome.php") { echo 'class="current"'; } ?>>
				<a href="drlIncome.php" class="leftmenua">
					Your Income
				</a>
			</li>

			<!-- <li <?php if($currentpagename=="photo.php") { echo 'class="current"'; } ?>>
				<a href="photo.php" class="leftmenua">
					Upload profile Image
				</a>
			</li> -->


			<!-- <li <?php if($currentpagename=="editprofile.php") { echo 'class="current"'; } ?>>
				<a href="editprofile.php" class="leftmenua">
					Edit profile
				</a>
			</li>

			<li <?php if($currentpagename=="changepassprofile.php") { echo 'class="current"'; } ?>>
				<a href="changepassprofile.php" class="leftmenua">
					Change Password
				</a>
			</li> -->
			
			<!-- <li <?php if($currentpagename=="memberpackage.php") { echo 'class="current"'; } ?>>
				<a href="memberpackage.php" class="leftmenua">
					Upgrade Package
				</a>
			</li> -->

			<li <?php if($currentpagename=="savingUpgrade.php") { echo 'class="current"'; } ?>>
				<a href="savingUpgrade.php" class="leftmenua">
					Upgrade Your Saving
				</a>
			</li>
			
			<!-- <li <?php if($currentpagename=="payout.php") { echo 'class="current"'; } ?>>
				<a href="payout.php" class="leftmenua">
					Referral Payout
				</a>
			</li> -->
			
			<!-- <li <?php if($currentpagename=="level-payout.php") { echo 'class="current"'; } ?>>
				<a href="level-payout.php" class="leftmenua">
					Level Payout
				</a>
			</li> -->
			
			<!-- <li <?php if($currentpagename=="pair-capping-payout.php") { echo 'class="current"'; } ?>>
				<a href="pair-capping-payout.php" class="leftmenua">
					Pair capping
				</a>
			</li> -->
			
			<li <?php if($currentpagename=="binary.php") { echo 'class="current"'; } ?>>
				<a href="binary.php" class="leftmenua">
					Binary Genealogy
				</a>
			</li>
			<!-- <?php if((($withdraw_req_ct > 0) && ($wallet_withdraw_status == "disabled")) || ($wallet_withdraw_status == "enabled")) {?>
			<li <?php if($currentpagename=="send_withdraw.php") { echo 'class="current"'; } ?>>
				<a href="send_withdraw.php" class="leftmenua">
					Send Withdrawal Request
				</a>
			</li>
			<?php } ?> -->
			
            <!-- <li <?php if($currentpagename=="epin.php") { echo 'class="current"'; } ?>>
				<a href="epin.php" class="leftmenua">
					Epin
				</a>
			</li> -->
			
			<!-- <?php if((($withdraw_cancel_ct > 0) && ($wallet_withdraw_status == "disabled")) || ($wallet_withdraw_status == "enabled")) {?>
			<li <?php  if($currentpagename=="cancel_withdraw.php") { echo 'class="current"'; } ?>>
				<a href="cancel_withdraw.php" class="leftmenua">
					Cancel Withdrawal Request
				</a>
			</li>
			<?php } ?> -->
			
			<li <?php  if($currentpagename=="wallet.php") { echo 'class="current"'; } ?>>
				<a href="wallet.php" class="leftmenua">
					Wallet Statement
				</a>
			</li>

			<li <?php if($currentpagename=="mail.php") { echo 'class="current"'; } ?>>
				<a href="mail.php" class="leftmenua">
					Mailing System
				</a>
			</li>
			<!-- <li <?php if($currentpagename=="my-wishlist.php") { echo 'class="current"'; } ?>>
				<a href="my-wishlist.php" class="leftmenua">
					My Wishlist
				</a>
			</li> -->
		</ul>

	</div>

</div>