<?php include "includes-new/header.php";
include("includes-new/function.php");  ?>
<style>
ul.pagination {
margin-bottom: 0;}
.pagination > .active > a {
z-index: 3;
color: #fff;
cursor: default;
background-color: #337ab7;
border-color: #337ab7; }
.pagination>li {
display: inline;
}
.pagination>li>a, .pagination>li>span {
position: relative;
float: left;
padding: 6px 12px;
margin-left: -1px;
line-height: 1.42857143;
color: #337ab7;
text-decoration: none;
background-color: #fff;
border: 1px solid #ddd;
}
</style>
<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>News</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>News</li>
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
					 <div class="row text-center">
						<div class="col-lg-12">
							<div class="section-title text-center">
								
								<h2>Our News </h2>
							</div>
						</div>
					</div>
                      <div class="row">
                       <?php
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = 6;
				$startpoint = ($page * $limit) - $limit;
				$url='?';
				
				$news=$db->get_all("select * from mlm_news where news_status='0' order by news_id desc LIMIT {$startpoint} , {$limit}");
				$nom_rows=$db->numrows("select * from mlm_news where news_status='0'");
				foreach($news as $res)
				{
				?>
						<!-- Single Blog -->
						<div class="col-lg-4" style="margin-bottom: 30px;">
							<div class="in-blog ">
								<div class="in-blog-image">
									<a href="news-detail.php?newid=<?php echo $res['news_id']; ?>">
										<?php if(!empty($res['news_image']) && file_exists("uploads/news/large/$res[news_image]")){ ?>
										<img src="uploads/news/large/<?php echo $res['news_image']; ?>" alt="blog image" width="370px;" height="252px;">
										<? }else { ?>
										<img src="uploads/no_image.jpg" alt="blog image" width="370px;" height="252px;" >
										<? } ?>
									</a>
								</div>
								<div class="in-blog-content">
									<div class="in-blog-metatop">
										<span><?=date("d M, Y",strtotime($res['news_date']));?></span>
										<!--<span><a href="event-detail.php?eventid=<?php echo $res['event_id']; ?>"><?=$res['event_title'];?></a></span>-->
									</div>
									<h4 class="in-blog-title" style="height:50px;"><a href="news-detail.php?newid=<?php echo $res['news_id']; ?>"><?=substr(strip_tags($res['news_title']),0,30);
									if(strlen($res['news_title'])>30){
											echo "...";
								    }
									?></a></h4>
									<p><?php echo substr(strip_tags($res['news_desc']),0,70);
									if(strlen($res['news_desc'])>70){
											echo "...";
								    }
									?> 
									</p>
									<hr style="border:0.3px solid #44ce6f">
									<?php if(strlen($res['news_desc'])>180){?>
									<p class="in-blog-title"><a style="padding-left:200px;" href="news-detail.php?newid=<?php echo $res['news_id']; ?>"><b>Read More </b><i class="zmdi zmdi-more"></i></a></p>
									<?php } ?>
									<!--
									<div class="in-blog-authorimage">
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
										<?php if(strlen($res['news_desc'])>180){?>
										<span align="right"><a class="" href="news-detail.php?newid=<?php echo $res['news_id']; ?>">Read More <i class="zmdi zmdi-more"></i></a> </span>
										<?php } ?>
									</div>-->
								</div>
							</div>
						</div>
						<!--// Single Blog -->
					<?php } ?>	
						<div class="col-lg-12">
						<nav aria-label="Page navigation navigation-lg">
                            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                        </nav>
					    </div>
				      </div>
				</div>
          </div>				

		</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>