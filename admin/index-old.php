<?php include "includes/new_header2.php"; ?>
        <!-- header section end -->
        <!-- slider-section-start -->
        <div class="main-slider-one  slider-area">
			<div id="wrapper">
				<div class="slider-wrapper">
					<div id="mainSlider" class="nivoSlider">
						<?php $sliders = $db->get_all_assoc("select * from mlm_slider where slider_status='0' order by slider_id asc");
						foreach($sliders as $i=>$sl){ ?>
							<img src="uploads/slider/mid/<?=$sl['slider_image'];?>" alt="main slider" title="#htmlcaption<?=$i;?>"/>
						<?php }?>
						
					</div>
					<?php foreach($sliders as $i=>$sl){ ?>
					<div id="htmlcaption<?=$i;?>" class="nivo-html-caption slider-caption">
						<div class="container">
							<div class="slider-left">
								<div class="text-img animated bounceInLeft slidetext">
									<?=$sl['slider_title'];?>
								</div>
								<div class="animated slider-btn fadeInUpBig">
									<a class="shop-btn" href="login.php">Join now</a>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
				</div>							
			</div>
		</div>
		<!-- slider section end -->
		
		
	<!-- slider section end -->
        <!-- collection section start -->
		<section class="collection-area section-padding-top">
			<div class="container">
			<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h3>How it Works?</h3>
						</div>
					</div>
				</div>
				<div class="row">
				
				<div class="col-sm-4 text-center" align="center">
						<div class="section-blog-circle">
							<center><img src="img/register-icon.png" class="img-responsive grayscale"></center>
						</div>
						<div align="center"><img src="img/register.png" class="img-responsive"></div>
						
							<p>Register and Purchase to start your journey.Lorem ipsum dolor amet, consectetur adipisicing.</p>
						
					</div>
				
				
					
					<div class="col-sm-4 text-center" align="center">
						<div class="section-blog-circle">
							<center><img src="img/invite_friend_icon.png" class="img-responsive grayscale"></center>
						</div>
						<div align="center"><img src="img/invite_friends.png" class="img-responsive"></div>
						<p>Invite your friends to also upgrade and receive instant commissions. Together we achieve more. </p>
					</div>
					
					<div class="col-sm-4 text-center" align="center">
						<div class="section-blog-circle">
							<center><img src="img/success_trophy.png" class="img-responsive grayscale"></center>
						</div>
						<div align="center"><img src="img/success.png" class="img-responsive"></div>
						<p>You find only 2 people. Duplicate the process. And before you know it. Your success is easily achievable. </p>
					</div>
				</div>
			</div>
		</section>
		
		<section class="featured-products single-products section-padding-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h3>Recent PRODUCTS</h3>
						</div>
					</div>
				</div>
				<div class="row text-center tab-content">
					<div class="tab-pane  fade in active">
						<div  class="product-slider">
							
							<?php $products = $db->get_all_assoc("select * from mlm_products where pro_status='0' order by pro_id desc limit 8");?>
							<?php foreach($products as $p){?>
							<div class="col-xs-3">
								<div class="single-product">
									<div class="product-img">
										<a href="product-detail.php?id=<?=$p['pro_id'];?>"><img src="<?=$website_url;?>/uploads/products/logo/thumb/<?=$p['pro_logo']?>" alt="<?=$p['pro_name']?>"/></a>
									</div>
									<div class="product-dsc">
										<p><a href="product-detail.php?id=<?=$p['pro_id'];?>"><?=$p['pro_name'];?></a></p>
										<span><strike><?=$p['pro_cost'].' '.$sitecurrency.'</strike>'.' / '.$p['pro_pv'].'  '.$sitecurrency?></span>
									</div>
								</div>
							</div>
							<?php }?>
							
						</div>
					</div>
				</div>	
			</div>	
		</section>
		
		
		<section class="collection-area section-padding-top under_bg_color">
			<div class="container">
			<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h3>WE UNDERSTAND THE SECRET OF SUCCESS.</h3>
						</div>
					</div>
				</div>
				<div class="row">
				
				<div class="col-sm-3 text-center txtcol" align="center">
						<div class="">
							<center><img src="img/tree.png" class="img-responsive imageheig299"></center>
						</div>
						    <p>Learn the Multiple Income Business Model.</p>
				</div>
				
			
				<div class="col-sm-3 text-center txtcol" align="center">
						<div class="">
							<center><img src="img/build.png" class="img-responsive  imageheig299"></center>
						</div>
						
						<p>Build your own professional network. </p>
				</div>
					
				<div class="col-sm-3 text-center txtcol" align="center">
						<div class="">
							<center><img src="img/network.png" class="img-responsive imageheig299"></center>
						</div>
						
						<p>Share your wisdom and multiply the efforts </p>
				</div>
				
				<div class="col-sm-3 text-center txtcol" align="center">
						<div class="">
							<center><img src="img/downline.png" class="img-responsive imageheig299"></center>
						</div>
						    <p>Build people & people build the Business.</p>
				</div>
			</div>
		</div>
     </section>
		
		
		
		
		<!-- new-products section end -->
        <!-- testimonials section start -->
		<section class="testimonials section-padding-top">
			<div class="container">
				<!-- <div class="row">
					<div class="col-xs-6">
						<div class="section-title">
							<h3>TESTIMONIALS</h3>
						</div>
					</div>
				</div> -->
				<div class="row">
				
					<div class="col-sm-12">
						<div class="section-title">
							<h3>TESTIMONIALS</h3>
						</div>
						<div id="testimonials" class="owl-carousel product-slider owl-theme">
							<?php
							$select=$db->get_all("select * from mlm_testimonial where test_status=0");
							foreach($select as $test){?>
							<div class="single-testimonial">
								<div class="testimonial-img">
									<a href="#">
										<?php
										$user=$db->singlerec("select user_id,user_fname,user_image from mlm_register where user_id='$test[test_user]'");
										if($user['user_image']){?>
											 <img src="uploads\profile_image\thumb\<?php echo $user['user_image']; ?>"/>
										<?php } else {
										$testmonial_img = $test['testmonial_img'];
										?>
										<?php if($testmonial_img !=""){?>
											<img src="uploads/testmonial_img/<?echo $testmonial_img;?>" style="width:140px; height:150px;">
										<?php } else{ ?>
											<img src="images/empty_images.jpg" style="width:140px; height:150px;">
										<?php } }?>
									</a>
								</div>
								<div class="testimonial-dsc">
									<h4><?php echo $test['test_title']; ?></h4>
									<span><?php echo $user['user_fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $test['test_date']; ?></span>
									<p><?php $test_comment = $test['test_comment']; echo @substr($test_comment,0,200); ?></p>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					
				</div>
					
				</div>
			</div>
		</section>
		<!-- testimonials section end -->
		
		<footer class="section-padding-top">
			<!-- brand logo area start -->
			
			<div class="service section-padding  bg-color">
				<div class="container">
					<div class="row ">
							<div class="col-md-3">
							
							<div class="four columns  alpha textsend">
									<img class="pic_box_feature" src="img/4_1.png" alt="image">
									<div class="head_style">
										<span><span rel="outline: medium none; cursor: default;" class="pix_text">High Profits</span></span>
									</div>
									<div class="c_style">
										<span style="">We offer MLM Products that give you company the highest profits margins ever<span rel="outline: medium none; cursor: default;" class="pix_text">
									</span></span>
									</div>
	       			        </div>
							
							</div>
							<div class="col-md-3">
							
							<div class="four columns  alpha textsend">
									<img class="pic_box_feature" src="img/4_2.png" alt="image">
									<div class="head_style">
										<span><span rel="outline: medium none; cursor: default;" class="pix_text">Great Products</span></span>
									</div>
									<div class="c_style">
										<span style="">Our MLM Products are value for money so it also benefits your customers and associates<span rel="outline: medium none; cursor: default;" class="pix_text">
									</span></span>
									</div>
	       			        </div>
							</div>
							<div class="col-md-3">
							<div class="four columns  alpha textsend">
									<img class="pic_box_feature" src="img/4_3.png" alt="image">
									<div class="head_style">
										<span><span rel="outline: medium none; cursor: default;" class="pix_text">Best Services</span></span>
									</div>
									<div class="c_style">
										<span style="">We provide end to end service for MLM products so you can be relaxed and focus on Networking<span rel="outline: medium none; cursor: default;" class="pix_text">
									</span></span>
									</div>
	       			        </div>
							
							</div>
							<div class="col-md-3">
						<div class="four columns  alpha textsend">
									<img class="pic_box_feature" src="img/4_4.png" alt="image">
									<div class="head_style">
										<span><span rel="outline: medium none; cursor: default;" class="pix_text">Exponential Growth</span></span>
									</div>
									<div class="c_style">
										<span style="">With our products and services you will be able to grow your company at a much higher rate<span rel="outline: medium none; cursor: default;" class="pix_text">
									</span></span>
									</div>
	       			        </div>
							
							</div>
					</div>
						
					</div>
				</div>
			
		<section class="blog section-padding-top paddbot">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h3>Latest News</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div id="blog" class="owl-carousel product-slider owl-theme">
					<?php
					$news=$db->get_all("select * from mlm_news where news_status='0' order by news_id desc LIMIT 5");
					foreach($news as $res)
					{
					?>
						<div class="col-xs-12">
							<div class="single-blog">
								<div class="s-blog-img clearfix">
									<div class="blog-img">
										<a href="news-detail.php?newid=<?php echo $res['news_id']; ?>"><img src="uploads/news/mid/<?php echo $res['news_image']; ?>" alt="" /></a>
									</div>
									<div class="actions-btn">
										<a href="#"><?=date("d M",strtotime($res['news_date']));?></a>
										<a href="news-detail.php?newid=<?php echo $res['news_id']; ?>"><i class="pe-7s-info"></i></a>
									</div>
								</div>
								<div class="blog-dsc">
									<p><a href="#"><?=$res['news_title'];?></a></p>
									<?php 
										echo substr(strip_tags($res['news_desc']),0,180);
										if(strlen($res['news_desc'])>180){
											echo "...";
										}
										if(strlen($res['news_desc'])>180){ ?>
											<span style="float:right;"> <a href="news-detail.php?newid=<?php echo $res['news_id']; ?>">read more</a></span>
									   <?php } ?>
								</div>
							</div>
						</div>
						
					<?php }?>	
						
					</div>
				</div>
			</div>
		</section>
	</div>		
<?php include "includes/new_footer.php"; ?>		
		
		
