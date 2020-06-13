<?php include "includes-new/header.php"; 
$about = $db->singlerec("select * from mlm_cms where cms_id='1'");

?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>About Us</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>About Us</li>
                            </ul>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
	
	<div class="features-area in-section section-padding-sm bg-clr">
				<div class="container">
					<div class="row features-wrapper">
						<div class="col-lg-4 col-md-6 col-12">
							<div class="in-feature">
								<span class="in-feature-icon">
									<i class="flaticon-lock"></i>
								</span>
								<h4>Secure and Safe</h4>
								<?=$about['secure_safe'];?>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="in-feature">
								<span class="in-feature-icon">
									<i class="flaticon-lab"></i>
								</span>
								<h4>Advance Features</h4>
								<?=$about['adv_features'];?>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="in-feature">
								<span class="in-feature-icon">
									<i class="flaticon-partner"></i>
								</span>
								<h4>Referral Earnings</h4>
								<?=$about['ref_earning'];?>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<div class="about-area in-section section-padding-bottom-sm bg-white">
				<div class="container custom-container">
					<div class="row no-gutters">
						<div class="col-xl-6 col-lg-12">
							<div class="about-content heightmatch" >
								
								<h2>Something About Us</h2>
								<h4><?=$about['about_title'];?></h4>
								<ul class="ul-style-1">
									<?=$about['about_content'];?>
								</ul>
								
							</div>
						</div>
						<div class="col-xl-6 col-lg-6">
							<div class="heightmatch" >
								<div class="in-videobox">
									<img src="uploads/cms/<?=$about['video_img'];?>" alt="man with umbrella">
									<a href="<?=$about['youtube_link'];?>" data-video-id="136709781" data-channel="vimeo" class="in-videobutton in-videobox-button"><i class="zmdi zmdi-play"></i></a>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6">
							<div class="counterbox heightmatch" data-bgimage="uploads/cms/<?=$about['business_proimg'];?>" data-secondary-overlay="9" style="height: 669px; background-image: url(&quot;uploads/cms/<?=$about['business_proimg'];?>&quot;);">
								<div class="counterbox-inner">
									<div class="counterbox-block">
										<div class="counterbox-blockinner">
											<h2><span class="counter"><?=$about['business_ans1'];?></span></h2>
											<h6><?=$about['business_title1'];?></h6>
										</div>
									</div>
									<div class="counterbox-block">
										<div class="counterbox-blockinner">
											<h2><span class="counter"><?=$about['business_ans2'];?></span></h2>
											<h6><?=$about['business_title2'];?></h6>
										</div>
									</div>
									<div class="counterbox-block">
										<div class="counterbox-blockinner">
											<h2><span class="counter"><?=$about['business_ans3'];?></span></h2>
											<h6><?=$about['business_title3'];?></h6>
										</div>
									</div>
									<div class="counterbox-block">
										<div class="counterbox-blockinner">
											<h2><span class="counter"><?=$about['business_ans4'];?></span></h2>
											<h6><?=$about['business_title4'];?></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-12">
							<div class="insurencebox heightmatch" style="height: 669px;">
								
								<h2>Have a business to protect?</h2>
								<?=$about['protect_cont'];?>
								
							</div>
						</div>
					</div>
				</div>
			</div>				

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>