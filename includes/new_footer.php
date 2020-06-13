			<!-- footer-top area start -->
			<div class="footer-top section-padding-top">
				<div class="footer-dsc">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="single-text">
									<div class="footer-title">
										<h4>Contact us</h4>
										<hr class="dubble-border"/>
									</div>
									<div class="footer-text">
										<ul>
											<li>
												<i class="pe-7s-map-marker"></i>
												<p><?php echo $website_addr; ?></p>
												
											</li>
											<li>
												<i class="pe-7s-call"></i>
												<p><?php echo  $website_phone;?></p>
											</li>
											<li>
												<i class="pe-7s-mail-open"></i>
												<p><?=$website_admin;?></p>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<div class="single-text">
									<div class="footer-title">
										<h4>my account</h4>
										<hr class="dubble-border"/>
									</div>
									<div class="footer-menu">
										<ul>
											<li><a href="index.php">Home</a></li>
											<li><a href="about.php">About Us</a></li>
											<li><a href="news.php">News</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 margin-top">
								<div class="single-text">
									<div class="footer-title">
										<h4>Quick Links</h4>
										<hr class="dubble-border"/>
									</div>
									<div class="footer-menu">
										<ul>
											<li><a href="contact.php">Contact Us</a></li>
											<li><a href="faq.php">FAQ's</a></li>
											<li><a href="product.php">Product</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 margin-top">
								<div class="single-text">
									<div class="footer-title">
										<h4>About Us</h4>
										<hr class="dubble-border"/>
									</div>
									<div class="footer-text">
								<?php
									$about = $db->singlerec("select cms_aboutus from mlm_cms");
									echo checkLength($about[0],250);
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr class="dubble-border"/>
				</div>
			</div>
			<!-- footer-top area end -->
			<!-- footer-bottom area start -->
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-left marbottom">
							<p>&copy; <?=date('Y');?> <?=$website_title;?>. All Rights Reserved. </p>
						</div>
						<div class="col-xs-12 text-right">
							<div class="social-icon">
									<ul class="floatright">
										<li><a href="<?=$gen_fb;?>"><i class="fa fa-facebook"></i></a></li>
										<li><a href="<?=$gen_twitter;?>"><i class="fa fa-twitter"></i></a></li>
										<li><a href="<?=$gen_googleplus;?>"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="<?=$gen_skype;?>"><i class="fa fa-skype"></i></a></li>										
									</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer-bottom area end -->
		</footer>
        <!-- footer section end -->
        
		<!-- all js here -->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- countdown JS -->
        <script src="js/countdown.js"></script>
		<!-- nivo.slider JS -->
        <script src="js/jquery.nivo.slider.pack.js"></script>
		<!-- simpleLens JS -->
        <script src="js/jquery.simpleLens.min.js"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- sticky js -->
        <script src="js/sticky.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
