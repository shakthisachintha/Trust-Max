<?php include "includes-new/header.php";
$nid=replace($_REQUEST['eventid']);
$news_detail=$db->singlerec("select * from mlm_events where event_id='$nid'");
?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>Event Details</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Event Details</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
		<div class="blog-details-area section-padding-xs bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="blog-details-wrap">
                                <div class="blog-content">
                                    <div class="in-blog-metatop">
                                        <span><?=date("jS M, Y",strtotime($news_detail['event_date']));?></span>
                                       <!-- <span><a href="#">Life Insurance</a></span>-->
                                    </div>
                                    
                                    <h4 class="in-blog-title"><a href="#"><?php echo $news_detail['event_title']; ?></a></h4>
                                    
                                    <div class="blog-details-image mt-30 mb-30">
                                        <?php if(!empty($news_detail['event_image']) && file_exists("uploads/events/large/$news_detail[event_image]")){ ?>
                                        <img src="uploads/events/large/<?php echo $news_detail['event_image']; ?>" alt="">
										<? }else { ?>
										<img src="uploads/no_image.jpg" alt="blog image" >
										<? } ?>
                                    </div>
                                    <?php echo $news_detail['event_desc']; ?>
                                        
                                   
                                    <!--// blog-details-wrapper -->               
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row widgets right-sidebar">

                               
                                <!--<div class="col-lg-12">
                                    <div class="single-widget widget-categories">
                                        <h4 class="widget-title">
                                            <span>Categories</span>
                                        </h4>
                                        <ul>
                                            <li><a href="#"><span>Life Insurence</span></a></li>
                                            <li><a href="#"><span>Business Insurence</span></a></li>
                                            <li><a href="#"><span>Car Insurence</span></a></li>
                                            <li><a href="#"><span>Home Insurence</span></a></li>
                                            <li><a href="#"><span>Travel Insurence</span></a></li>
                                            <li><a href="#"><span>Agricultural Insurence</span></a></li>
                                        </ul>
                                    </div>
                                </div>-->

                                <div class="col-lg-12">
                                    <div class="single-widget widget-latestblog">
                                        <h4 class="widget-title">
                                            <span>Latest Blog</span>
                                        </h4>
                                        <ul>
                              <?php
			                $event=$db->get_all("select * from mlm_events where event_status='0' and event_id!='$nid' order by event_id desc limit 3");
				            foreach($event as $i=>$res)
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

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
					

	</main>
	<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>