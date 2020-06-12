<?php include "includes-new/header.php";
$profile_id=isset($_SESSION['profileid'])?$_SESSION['profileid']:'';
if(isset($_REQUEST['newsletterSub'])){
	$date=date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];
	$newslemail=addslashes($_REQUEST['newslemail']);
	$num=$db->numrows("select * from mlm_subscriber where email='$newslemail'");
	if(empty($num)){
		$insert=$db->insertrec("INSERT INTO mlm_subscriber (email, crcdt, ip) VALUES ('$newslemail', '$date', '$ip')");
		
		
	$subject="Thank You For Subscribing ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Thank You For Subscribing ".$website_name." </b></td>
						</tr>
						
						
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>We will contact you shortly via Email</td>
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
	
	$to=$newslemail;
	$cmail=$com_obj->commonMail($to,$subject,$msg);
		
		
		
		echo "<script>location.href='index.php?news_succ';</script>";
	    header("Location: index.php?news_succ");
	    exit;
	}else{
	    echo "<script>location.href='index.php?news_err';</script>";
	    header("Location: index.php?news_err");
	    exit;
	}
}


if(isset($_REQUEST['wishlist'])){
	
	$product_id=addslashes($_REQUEST['id']);
	$status=addslashes($_REQUEST['status']);
	
	$result1=$db->Extract_Single("select id from mlm_wishlist where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
	
	if(empty($result1)) {
		
		$date = date("Y-m-d");
		$ip=$_SERVER['REMOTE_ADDR'];;
		$set="profile_id='$userdetail[user_profileid]'";
		$set.=",product_id='$product_id'";
		$set.=",crcdt='$date'";
		$set.=",reg_ip='$ip'";
		$set.=",status='1'";
		
	    $db->insertrec("insert into mlm_wishlist set $set");
		echo "<script>location.href='index.php';</script>";
		header("Location: index.php");
		exit;
	}else{
		if($status=='1'){
			//echo '1';exit;
			$db->insertrec("update mlm_wishlist set status='0' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			echo "<script>location.href='index.php';</script>";
			header("Location: index.php");
			exit;
		}else if($status=='0'){
			//echo '2';exit;
			$db->insertrec("update mlm_wishlist set status='1' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			echo "<script>location.href='index.php';</script>";
			header("Location: index.php");
			exit;
		}
		
	}
		
}
 ?>

		<!-- Hero Slider Area -->
		<div class="heroslider-area in-sliderarrow">
             <?php $sliders = $db->get_all_assoc("select * from mlm_slider where slider_status='0' order by slider_id asc");
						foreach($sliders as $i=>$sl){ ?>
			<!-- Hero Slider Single -->
			<div class="heroslider animated-heroslider d-flex align-items-center" style="background-image: url(uploads/slider/mid/<?=$sl['slider_image'];?>);background-position: center;background-size: cover;"
			 data-secondary-overlay="8">
				<div class="container">
					<div <?php if($i==0){?> class="row align-items-center" <?} else {?> class="row justify-content-center" <?}?>>
						<div <?php if($i==0){?> class="col-xl-9 col-lg-8" <?} else {?>
						class="col-lg-10" <?}?>>
							<div class="heroslider-content <?php if($i==0){ echo ''; }else{ echo 'text-center';} ?>" >
								<h1><span><?=$sl['slider_title'];?> </span><?=$sl['sub_title'];?></h1>
								<p><?=$sl['slider_desc'];?></p>
								<div class="heroslider-buttonholder">
									<a href="about.php" class="in-button in-button-theme">About Us</a>
									<a href="contact.php" class="in-button in-button-colorwhite">Contact Us</a>
								</div>
							</div>
						</div>
						<?php if($i==0){?>
						<div class="col-lg-3">
							<div class="heroslider-roundbox roundbox">
								<div class="roundbox-block">
									<span class="roundbox-icon">
										<i class="flaticon-mind"></i>
									</span>
									<h5>Multiple Income</h5>
								</div>
								<div class="roundbox-block">
									<span class="roundbox-icon">
										<i class="flaticon-life-insurence"></i>
									</span>
									<h5>More Secure</h5>
								</div>
								<div class="roundbox-block">
									<span class="roundbox-icon">
										<i class="flaticon-planning"></i>
									</span>
									<h5>Earn More</h5>
								</div>
								<div class="roundbox-block">
									<span class="roundbox-icon">
										<i class="flaticon-businessman"></i>
									</span>
									<h5>Binary Plan</h5>
								</div>
							</div>
						</div>
					    <?}?>
					</div>
				</div>
			</div>
			<!--// Hero Slider Single -->
    <?php }?>
		</div>
		<!--// Hero Slider Area -->

		<!-- Page Conttent -->
	<main class="page-content">
      <div class="statics section-padding-xs">
            <div class="container">
                <div class="row text-center">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="section-title">
                            <h2>Our Features</h2>
                            
                        </div>
                    </div>
                </div>
				<?php $indexCms = $db->singlerec("select * from mlm_cms where cms_id='1'");?>
                <div class="row justify-content-xl-start justify-content-lg-start justify-content-sm-center">
				    <div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/commission.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Pair Commission</h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['comm_content']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                   <!-- <div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/shopping-cart.png" alt="">
                                </div>
                                <div class="part-text">
                                    <h4 class="number">Ecommerce</h4>
                                    <p class="title"><?=strip_tags($indexCms['ecom_cont']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/wallet.png" alt="">
                                </div>
                                <div class="part-text">
                                    <h4 class="number">E-Wallet</h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['wallet_cont']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/protect.png" alt="">
                                </div>
                                <div class="part-text">
                                  <h4 class="number">E-Pin System</h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['epin_cont']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/secure-payment.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Payment Gateway</h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['paymt_cont']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--<div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/medal.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Reward Management</h4>
                                    <p class="title"><?=strip_tags($indexCms['reward_cont']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>-->
					<div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                   <img src="assets/images/icons/family-tree.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Genealogy Structure </h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['gene_content']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/email.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Mail System</h4>
                                    <p class="title" style="height: 142px;"><?=strip_tags($indexCms['sys_content']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<!--<div class="col-xl-4 col-lg-4 col-sm-8 col-md-6">
                        <div class="single-statics">
                            <div class="after-before">
                                <div class="part-img">
                                    <img src="assets/images/icons/translation.png" alt="">
                                </div>
                                <div class="part-text">
                                   <h4 class="number">Multilanguage Supportable</h4>
                                    <p class="title"><?=strip_tags($indexCms['multilang_content']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
		
		
		<section class="our_company_area pad_top">
        	<div class="container">
        		<div class="row our_company_inner">
        			<div class="col-lg-4">
        				<div class="company_sub_title">
        					<h5>About Us</h5>
        					<h4><?=strip_tags($indexCms['inabout_title']);?></h4>
        				</div>
        			</div>
        			<div class="col-lg-7 offset-lg-1">
        				<div class="company_desc">
        					<p><?=strip_tags($indexCms['inabout_content']);?></p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-sm-6">
        				<div class="company_item">
        					<div class="company_img">
        						<?php if(!empty($indexCms['high_prof_img']) && file_exists("uploads/cms/$indexCms[high_prof_img]")){ ?>
        						<img class="img-fluid" src="uploads/cms/<?=$indexCms['high_prof_img'];?>" alt="">
							<?}else {?>
							 <img src="uploads/no_image.jpg" alt="" width="188px">
							 <? } ?>
        					</div>
        					<div class="company_text">
        						<a href="#"><h4>High Profits</h4></a>
        						<p><?=strip_tags($indexCms['prof_content']);?></p>
        						
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-3 col-sm-6">
        				<div class="company_item">
        					<div class="company_img">
        						<?php if(!empty($indexCms['leg_plan_img']) && file_exists("uploads/cms/$indexCms[leg_plan_img]")){ ?>
        						<img class="img-fluid" src="uploads/cms/<?=$indexCms['leg_plan_img'];?>" alt="">
							<?}else {?>
							 <img src="uploads/no_image.jpg" alt="" width="188px">
							 <? } ?>
        					</div>
        					<div class="company_text">
        						<a href="#"><h4>Great Products</h4></a>
        						<p><?=strip_tags($indexCms['leg_content']);?></p>
        						
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-3 col-sm-6">
        				<div class="company_item">
        					<div class="company_img">
        						<?php if(!empty($indexCms['serv_image']) && file_exists("uploads/cms/$indexCms[serv_image]")){ ?>
        						<img class="img-fluid" src="uploads/cms/<?=$indexCms['serv_image'];?>" alt="">
							<?}else {?>
							 <img src="uploads/no_image.jpg" alt="" width="188px">
							 <? } ?>
        					</div>
        					<div class="company_text">
        						<a href="#"><h4>Best Services</h4></a>
        						<p><?=strip_tags($indexCms['serv_content']);?></p>
        						
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-3 col-sm-6">
        				<div class="company_item">
        					<div class="company_img">
        						<?php if(!empty($indexCms['expo_image']) && file_exists("uploads/cms/$indexCms[expo_image]")){ ?>
        						<img class="img-fluid" src="uploads/cms/<?=$indexCms['expo_image'];?>" alt="">
							<?}else {?>
							 <img src="uploads/no_image.jpg" alt="" width="188px">
							 <? } ?>
        					</div>
        					<div class="company_text">
        						<a href="#"><h4>Exponential Growth</h4></a>
        						<p><?=strip_tags($indexCms['expo_content']);?></p>
        						
        					</div>
        				</div>
        			</div>
        		</div>
        		
        	</div>
        </section>


<div class="services-area in-section section-padding-xs bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                
                                <h2>What We Provide</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
					<?php 
								
								$products = $db->get_all_assoc("select * from mlm_products where pro_status='0' order by pro_id desc limit 8");
								
								foreach($products as $p){
								$stars=$db->Extract_Single("select sum(stars) from mlm_reviews where product_id= '".$p['pro_id']."';");
								
									?>
                        <!-- Single Service -->
                       <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="in-service-2 mt-30">
                                <div class="in-service-2-image">
								
								<?php  $wishlistChk=$db->singlerec("select * from mlm_wishlist where profile_id='$profile_id' and product_id='$p[pro_id]'");
                                
								?>
								
								<?php if(!empty($profile_id)){ ?>
                                    <a href="index.php?id=<?=$p['pro_id'];?>&status=<?=$wishlistChk['status'];?>&wishlist">
                                       <?php if(!empty($p['pro_logo']) && file_exists("uploads/products/logo/thumb/$p[pro_logo]")){ ?>
                                       <img src="uploads/products/logo/thumb/<?=$p['pro_logo']?>" alt="<?=$p['pro_name']?>"/>
									   <?}else {?>
									   <img src="uploads/no_image.jpg" alt="working progress image">
									   <?} ?>
                                    
									<?php if($wishlistChk['id']!='') {
									if($wishlistChk['status']=='1') {?>
										<span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" ></i>
                                        </span>
									<?}else if($wishlistChk['status']=='0'){?>
									    <span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" style="color: white;"></i>
                                        </span>
								    <?}}else{?>
									    <span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" style="color: white;"></i>
                                        </span>
									<?}?>
									
									</a>
								<?}else{?>
								       <a href="" onclick="checklogin()">
                                       <?php if(!empty($p['pro_logo']) && file_exists("uploads/products/logo/thumb/$p[pro_logo]")){ ?>
                                       <img src="uploads/products/logo/thumb/<?=$p['pro_logo']?>" alt="<?=$p['pro_name']?>"/>
									   <?}else {?>
									   <img src="uploads/no_image.jpg" alt="working progress image">
									   <?} ?>
                                       <span class="in-service-2-icon">
                                        <i class="zmdi zmdi-favorite" ></i>
                                       </span></br>
									   
									   </a>
								<?}?>
                                </div>
                                <div class="in-service-2-content">
                                   <h5><a href="product-detail.php?id=<?=$p['pro_id'];?>"><?=$p['pro_name'];?></a></h5>
                                   <p class="price"><span class="price-new"><?=$sitecurrency.' '.$p['pro_pv'];?></span><span class="price-old"><?=$sitecurrency.' '.$p['pro_cost'];?></span> </p>
								    <div class="rating">
										<? echo get_Rate2($p['pro_id']); ?>
									 </div>
                                     <a href="product-detail.php?id=<?=$p['pro_id'];?>" class="in-button in-button-theme in-button-xs"><i class="zmdi zmdi-shopping-cart-plus padr-10"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <!--// Single Service -->
								<?}?>
						<div class="col-sm-12 text-center">
                          <a href="product.php" class="btn blog_load_more"><i class="zmdi zmdi-spinner"></i>View All Products</a>
						 </div>
                    </div>
                </div>
            </div>


			<!-- Testimonial Area -->
			<div class="testimonial-area in-section section-padding-xs bg-white">
                  <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                
                                <h2>Client Testimonial</h2>
                            </div>
                        </div>
                    </div>
				<div class="testimonial-slider in-slidearrow-2">
				
				<?php
							$select=$db->get_all("select * from mlm_testimonial where test_status=0");
							foreach($select as $i=>$test)
							{
								$user=$db->singlerec("select user_id,user_fname,user_image from mlm_register where user_id='$test[test_user]'");
								
								?>
					<div class="slider-item">
						<!-- Single Testimonial -->
						<div class="testimonial">
							<div class="testimonial-header">
								<div class="testimonial-image">
									<?php
										if($user['user_image']){?>
											 <img src="uploads\profile_image\thumb\<?php echo $user['user_image']; ?>" alt="testimonial author" class="img-circle"/>
										<?php } else {
										$testmonial_img = $test['testmonial_img'];
										?>
										<?php if($testmonial_img !=""){?>
											<img src="uploads/testmonial_img/<?echo $testmonial_img;?>" style="width:140px; height:150px;" alt="testimonial author" class="img-circle">
										<?php } else{ ?>
											<img src="images/empty_images.jpg" style="width:140px; height:150px;" alt="testimonial author" class="img-circle">
										<?php } }?>
								</div>
								<span><img src="assets/images/icons/title-bottom-shape.png" alt="shape"></span>
							</div>
							<div class="testimonial-content">
								<p><?php $test_comment = $test['test_comment'];
                                echo substr($test_comment,0,170);
								if(strlen($test_comment)>170)
								{
									echo "...";
								} 
								?> </p>
								<h5><?php echo $test['test_title']; ?></h5>
								<h6><?php if($test['test_user']!=""){ echo $test['test_user']; } else { echo "Admin"; } ?></h6>
							</div>
							
						</div>
						<!--// Single Testimonial -->
					</div>

					<?php }?>

				</div>
			</div>
			<!--// Testimonial Area -->

			<!-- Call To Action Area -->
			<div class="section-full no-col-gap bg-repeat">
                <div class="container-fluid">
                        
                        <div class="row">
                        	<div class="col-md-6 col-sm-6 bg-secondry">
                            	<div class="section-content p-tb60 p-r30 clearfix">
                                	<div class="wt-left-part any-query text-center">
                                    	<img src="assets/images/icons/any-reg.png" alt="">
                                    	<div class="text-center">
                                        	<h3 class="text-uppercase font-weight-500 text-white padt15">Register</h3>
                                             <p class="text-white"><?=strip_tags($indexCms['reg_content']);?></p>
                                            <a style="margin-left: 15px;" href="register.php" class="site-button text-uppercase m-r15">Join Now</a>
                                        </div>    
                                    </div>
                                </div>                               
                            </div>
                            <div class="col-md-6 col-sm-6 bg-primary1">
                            	<div class="section-content p-tb60 p-r30 clearfix">
                                    <div class="wt-right-part any-query-contact text-center">
                                    	<img src="assets/images/icons/any-query-contact.png" alt="">
                                    	<div class="text-center">
                                        	<h3 class="text-uppercase font-weight-500 text-white padt15">Contact Us</h3>
                                           <p class="text-white"><?=strip_tags($indexCms['contact_cont']);?></p>
                                            <h4 class="text-secondry"><?=$website_admin;?></h4>
                                        </div>                               
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
			<!--// Call To Action Area -->

			<!-- Blog Area -->
			<div class="blogs-area in-section section-padding-xs bg-white">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="section-title text-center">
								
								<h2>Our Events </h2>
							</div>
						</div>
					</div>
					<div class="row blog-slider-active in-slidearrow">
                      <?php
			                $event=$db->get_all("select * from mlm_events where event_status='0' order by event_id desc");
				            foreach($event as $i=>$res)
							{
							?>

						<!-- Single Blog -->
						<div class="col-lg-4">
							<div class="in-blog mt-30">
								<div class="in-blog-image">
									<a href="event-detail.php?eventid=<?php echo $res['event_id']; ?>">
										<?php if(!empty($res['event_image']) && file_exists("uploads/events/large/$res[event_image]")){ ?>
										<img src="uploads/events/large/<?php echo $res['event_image']; ?>" alt="blog image" width="370px;" height="252px;">
										<? }else { ?>
										<img src="uploads/no_image.jpg" alt="blog image" >
										<? } ?>
									</a>
								</div>
								<div class="in-blog-content">
									<div class="in-blog-metatop">
										<span><?=date("jS M, Y",strtotime($res['event_date']));?></span>
									</div>
									<h4 class="in-blog-title" style="height:50px;"><a href="event-detail.php?eventid=<?php echo $res['event_id']; ?>"><?=substr(strip_tags($res['event_title']),0,30);
									if(strlen($res['event_title'])>30){
											echo "...";
								    }
									?></a></h4>
									<p><?php echo substr(strip_tags($res['event_desc']),0,150);
									if(strlen($res['event_desc'])>150){
											echo "...";
								    }
									?> </p>
									<hr style="border:0.3px solid #44ce6f">
									<?php if(strlen($res['event_desc'])>180){?>
									<p class="in-blog-title"><a style="padding-left:200px;" href="event-detail.php?eventid=<?php echo $res['event_id']; ?>"><b>Read More </b><i class="zmdi zmdi-more"></i></a></p>
									<?php } ?>
									<!--<div class="in-blog-authorimage">
										<span>
											<?php if(!empty($siteAdminProfile) && file_exists("uploads/adminProfile/$siteAdminProfile")){ ?>
											<img src="uploads/adminProfile/<?=$siteAdminProfile;?>" alt="author image">
											<? }else { ?>
											<img src="uploads/profile.jpg" alt="blog image" width="370px;" height="252px;">
											<? } ?>
										</span>
									</div>
									<div class="in-blog-metabottom">
										<span>By <a href="#">Admin</a></span>
										<?php if(strlen($res['event_desc'])>180){?>
										<span><a class="" href="event-detail.php?eventid=<?php echo $res['event_id']; ?>">Read More <i class="zmdi zmdi-more"></i></a> </span>
										<?php } ?>
									</div>-->
								</div>
							</div>
						</div>
						<!--// Single Blog -->
							<? }?>
						
					</div>
				</div>
			</div>
			<!--// Blog Area -->

		</main>
		<!--// Page Conttent -->

		<!-- Footer -->
<script>
function checklogin(){
	alert("Please Login to Add Wishlist");
}
</script>

<?php include "includes-new/footer.php" ?>