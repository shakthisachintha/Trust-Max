<?php
	$currentpagename=getPageName();
?>
<div class="col-sm-3">
	<h4 class="navbar-inner text-center" style="color:#FFF; line-height:40px; background-color: #81b41d;">Mail menu</h4>
	<div class="service-box2">
		<ul class="proleftmenu prfl_lft_menu">
			<li <?php if($currentpagename=="mail.php") { echo 'class="current"'; } ?>>
				<a href="mail.php" class="leftmenua">
					MAIL STATISTICS
				</a>
			</li>


			<li <?php if($currentpagename=="compose.php") { echo 'class="current"'; } ?>>
				<a href="compose.php" class="leftmenua">
					COMPOSE MAIL
				</a>
			</li>		
			
			<li <?php if($currentpagename=="inbox.php") { echo 'class="current"'; } ?>>
				<a href="inbox.php" class="leftmenua">
					INBOX
				</a>
			</li>
			
			<li <?php if($currentpagename=="outbox.php") { echo 'class="current"'; } ?>>
				<a href="outbox.php" class="leftmenua">
					OUTBOX
				</a>
			</li>
			<li <?php if($currentpagename=="forward.php") { echo 'class="current"'; } ?>>
				<a href="forward.php" class="leftmenua">
					FORWARD MAIL
				</a>
			</li>
			<li <?php if($currentpagename=="read.php") { echo 'class="current"'; } ?>>
				<a href="read.php" class="leftmenua">
					READ MAIL
				</a>
			</li>
			<li <?php if($currentpagename=="unread.php") { echo 'class="current"'; } ?>>
				<a href="unread.php" class="leftmenua">
					UNREAD MAIL
				</a>
			</li>

			<li <?php if($currentpagename=="profile.php") { echo 'class="current"'; } ?>>
				<a href="profile.php" class="leftmenua">
					BACK TO  PROFILE PAGE
				</a>
			</li>
	
			
		</ul>
	</div>
</div>