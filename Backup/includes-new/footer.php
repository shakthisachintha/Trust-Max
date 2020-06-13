<?php $footerCMS = $db->singlerec("select * from mlm_cms where cms_id='1'");

?>
		<footer class="footer">

			<!-- Footer Contact Area -->
			<div class="footer-contact-area">
				<div class="container">
					<div class="footer-contact">
						<div class="row">
							<div class="col">
								<div class="footer-contact-block">
									<span class="footer-contact-icon">
										<i class="zmdi zmdi-phone"></i>
									</span>
									<p><a href="#"><?=$website_phone;?></a><br></p>
								</div>
							</div>
							<?php 
							$address=$db->singlerec("select * from mlm_address where addr_id='1'");
						?>
							<div class="col">
								<div class="footer-contact-block">
									<span class="footer-contact-icon">
										<i class="zmdi zmdi-home"></i>
									</span>
									<p><?php echo ucwords($address['addr_area']).", ".ucwords($address['addr_city']).", ".ucwords($address['addr_state']).", ".ucwords($address['addr_country']);?></p>
								</div>
							</div>
							<div class="col">
								<div class="footer-contact-block">
									<span class="footer-contact-icon">
										<i class="zmdi zmdi-email"></i>
									</span>
									<p><a href="#"><?=$website_admin;?></a><br></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--// Footer Contact Area -->

			<!-- Footer Inner -->
			<div class="footer-inner">

				<!-- Footer Widgets Area -->
				<div class="footer-widgets-area section-padding-xs">
					<div class="container">
						<div class="row widgets footer-widgets">

							<div class="col-lg-3 col-md-6">
								<div class="single-widget widget-info">
									<div class="logo">
										<a href="index.php">
											<?php if(!empty($siteFooterlogo) && file_exists("uploads/footerlogo/$siteFooterlogo")){ ?>
											<img src="uploads/footerlogo/<?=$siteFooterlogo;?>" alt="footer logo">
										<?}else {?>
										 <img src="uploads/no_image.jpg" alt="blog thumbnail" width="175" height="55">
										 <? } ?>
										</a>
									</div>
									<?=$footerCMS['foot_cont'];?>
									
								</div>
							</div>

							<div class="col-lg-2 col-md-6">
								<div class="single-widget widget-links">
									<h4 class="widget-title">
										<span>Quick Link</span>
									</h4>
									<ul>
										<li><a href="index.php">Home</a></li>
										<li><a href="about.php">About US</a></li>
										<li><a href="how-it-works.php">How It Works</a></li>
										<li><a href="product.php">Products</a></li>
                                        <!--<li><a href="event.php">Events</a></li>
										<li><a href="news.php">News</a></li>-->
										<li><a href="contact.php">Contact Us</a></li>
									</ul>
								</div>
							</div>

							<div class="col-lg-3 col-md-6">
								<div class="single-widget widget-latestblog">
									<h4 class="widget-title">
										<span>Latest Events</span>
									</h4>
									<ul>
									<?php
									$events=$db->get_all("select * from mlm_events where event_status='0' order by event_id desc limit 3");
							        foreach($events as $i=>$res)
									{
									?>
										<li>
											<div class="widget-latestblog-image">
												<a href="event-detail.php?eventid=<?php echo $res['event_id']; ?>">
													<?php if(!empty($res['event_image']) && file_exists("uploads/events/mid/$res[event_image]")){ ?>
                                                    <img src="uploads/events/mid/<?php echo $res['event_image']; ?>" alt="blog thumbnail">
													<? }else { ?>
													<img src="uploads/no_image.jpg" alt="blog thumbnail" >
													<? } ?>
												</a>
											</div>
											<span><?=date("jS M, Y",strtotime($res['event_date']));?></span>
											<h5><a href="event-detail.php?eventid=<?php echo $res['event_id']; ?>"><?=substr(strip_tags($res['event_title']),0,30);
									if(strlen($res['event_title'])>30){
											echo "...";
								    }
									?></a></h5>
								 		</li>
								 <?php } ?>
									</ul>
								</div>
							</div>

							<div class="col-lg-4 col-md-6">
								<div class="single-widget widget-newsletter">
									<h4 class="widget-title">
										<span>Newsletter</span>
									</h4>
									<?=$footerCMS['newsletter_cont'];?></p>
									<?php 
									if(isset($_REQUEST['news_succ'])) {
									?>
									<div align="center" style="color:white;"><b>Thank you for subscribing!!!</b></div>
									<?php } ?>
									<?php 
									if(isset($_REQUEST['news_err'])) {
									
									?>
									<div align="center" style="color:red;"><b>Already Subscribed!!!</b></div>
									
									<?php } ?>
									<form action="" method="post" class="widget-newsletter-form">
										<input type="email" placeholder="Your email..." name="newslemail" required />
										<button type="submit" name="newsletterSub"><img src="assets/images/icons/paper-plane-white.png" alt="send"></button>
									</form>
									<ul class="footer-socialicons">
										<li><a href="<?=$gen_fb;?>"><i class="zmdi zmdi-facebook"></i></a></li>
										<li><a href="<?=$gen_twitter;?>"><i class="zmdi zmdi-twitter"></i></a></li>
										<li><a href="<?=$gen_googleplus;?>"><i class="zmdi zmdi-google-plus"></i></a></li>
										<li><a href="<?=$gen_skype;?>"><i class="zmdi zmdi-linkedin"></i></a></li>
									</ul>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!--// Footer Widgets Area -->

				<!-- Footer Copyright Area -->
				<div class="footer-copyright-area">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg-7 col-12">
								<p style="display: contents;" class="copyright-text">Copyright <?=date("Y");?>  &copy; <a href="#"><?php echo $website_title;?></a>, All Right
									Reserved</p>
								<p style="float: right;padding-top: 1px;" class="copyright-text">Designed by <a href="<?=$designedUrl;?>" target='_blank'> <?=$designedBy;?></a></p>
							</div>
							<div class="col-lg-5 col-12">
								<ul class="copyright-links">
									
									<li><a href="faq.php">FAQ's</a></li>
									<li><a href="privacy.php">Privacy Policy</a></li>
									<li><a href="terms.php">Terms & Conditions </a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--// Footer Copyright Area -->

			</div>
			<!--// Footer Inner -->

		</footer>
		<!--// Footer -->

	</div>
	<!--// Wrapper -->

<!--// live chat wap
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-366acd82-1cfc-4e98-9ba2-bf9c66910f44"></div> -->
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-94c0414b-0bb1-4f38-a865-74a420923300"></div>

	<!-- Js Files -->
	<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
	<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script>
	  $(document).ready(function() {
    $('#example').DataTable();
} );
	</script>
	<script>
	  $(document).ready(function() {
    $('#example1').DataTable();
} );
	</script>
	<script>
	  $(document).ready(function() {
    $('#example2').DataTable();
} );
	</script>
	<script>
	  $(document).ready(function() {
    $('#example3').DataTable();
} );
	</script>
	
</body>

</html>