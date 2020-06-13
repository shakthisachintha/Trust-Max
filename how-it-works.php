<?php include "includes-new/header.php";
$about = $db->singlerec("select * from mlm_cms where cms_id='1'");
 ?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>How It Works</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>How It Works</li>
                            </ul>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
	
<div class="working-progress-area in-section section-padding-xs bg-shape-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                
                                <h2>How We Works</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="workprogress-image">
							<?php if(!empty($about['how_works_img']) && file_exists("uploads/cms/$about[how_works_img]")){ ?>
                                <img src="uploads/cms/<?=$about['how_works_img'];?>" alt="working progress image">
							<?}else {?>
								<img src="uploads/no_image.jpg" alt="working progress image" >
							 <? } ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="workprogress-box">
                                <div class="workprogress-block text-center">
                                    <span class="workprogress-icon">
                                        <img src="assets/images/icons/icon-3.png" alt="">
                                    </span>
                                    <h5>JOIN AS MEMBER</h5>
                                    <p><?=$about['join_mem_cont'];?></p>
                                </div>
                                <div class="workprogress-block text-center">
                                    <span class="workprogress-icon">
                                        <img src="assets/images/icons/icon-1.png" alt="">
                                    </span>
                                    <h5>BUY PRODUCT</h5>
                                    <p><?=$about['buy_prod_cont'];?></p>
                                </div>
                                <div class="workprogress-block text-center">
                                    <span class="workprogress-icon">
                                        <img src="assets/images/icons/icon-4.png" alt="">
                                    </span>
                                    <h5>EARN MULTIPLE INCOME</h5>
                                    <p><?=$about['income_content'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="bg-tabl pt-30 pb-30">
			   <div class="container">
				  <div class="row">
					 <div class="col-md-6">
						<div class="feat-img text-center"> 
						<?php if(!empty($about['binary_level_img']) && file_exists("uploads/cms/$about[binary_level_img]")){ ?>
						<img class="tree-bg" src="uploads/cms/<?=$about['binary_level_img'];?>" >
						<?}else {?>
						<img src="uploads/no_image.jpg" class="tree-bg" >
					   <? } ?>
						</div>
						
					 </div>
					 <div class="col-md-6">
						
						<div class="feat-img text-center"> 
						<?php if(!empty($about['binary_plan_img']) && file_exists("uploads/cms/$about[binary_plan_img]")){ ?>
						<img  src="uploads/cms/<?=$about['binary_plan_img'];?>" alt="" class="center-block tree-bg"></div>
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block tree-bg">
					   <? } ?>
					 </div>
				  </div>
			   </div>
			</div>
			<div class="double-bg1 pt-30 pb-30">
			   <div class="container">
				  <div class="row">
					 <div class="col-md-6">
						<div class="feat-img text-center"> 
						<?php if(!empty($about['binary_mat_img']) && file_exists("uploads/cms/$about[binary_mat_img]")){ ?>
						<img src="uploads/cms/<?=$about['binary_mat_img'];?>" alt="MLM software dashboard">
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block tree-bg">
					   <? } ?>
						</div>
						<div class="feat-con">
						   <h1 class="section-title1">Binary MLM 2×2 Matrix</h1>
						   <p class="text-size-medium"><?=strip_tags($about['binary_mat_cont']);?></p>
						</div>
					 </div>
					 <div class="col-md-6">
						<div class="feat-con white">
						   <h1 class="section-title1"> Referal & Pair Bonus</h1>
						  <p class="text-size-medium"><?=strip_tags($about['ref_pair_cont']);?></p>
						</div>
						<div class="feat-img text-center"> 
						<?php if(!empty($about['ref_plan_img']) && file_exists("uploads/cms/$about[ref_plan_img]")){ ?>
						<img src="uploads/cms/<?=$about['ref_plan_img'];?>" alt="Multiple Currencies" class="center-block">
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block">
					   <? } ?>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
			<div class="double-bg2 pt-30 pb-30">
			   <div class="container">
				  <div class="row">
					 <div class="col-md-6">
						<div class="feat-con white">
						   <h1 class="clr-wht">Purchase & Repurchase bonus</h1>
						   <p class="text-size-medium"><?=strip_tags($about['purchase_cont']);?></p>
						</div>
						<div class="feat-img text-center"> 
						<?php if(!empty($about['purchase_img']) && file_exists("uploads/cms/$about[purchase_img]")){ ?>
						<img src="uploads/cms/<?=$about['purchase_img'];?>" alt="Sponsors">
						<?}else {?>
						<img src="uploads/no_image.jpg" alt="Sponsors">
					   <? } ?>
						</div>
					 </div>
					 <div class="col-md-6">
						<div class="feat-img text-center"> 
						<?php if(!empty($about['payment_img']) && file_exists("uploads/cms/$about[payment_img]")){ ?>
						<img src="uploads/cms/<?=$about['payment_img'];?>" alt="Team Explorer" class="center-block">
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block">
					   <? } ?>
						</div>
						<div class="feat-con ">
						   <h1 class="">Payment Gateway</h1>
						   <p class="text-size-medium"><?=strip_tags($about['payment_cont']);?></p>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
            <div class="double-bg1 pt-30 pb-30">
			   <div class="container">
				  <div class="row">
					 <div class="col-md-6">
						<div class="feat-img text-center">
						<?php if(!empty($about['add_user_img']) && file_exists("uploads/cms/$about[add_user_img]")){ ?>
						<img src="uploads/cms/<?=$about['add_user_img'];?>" alt="Multiple Currencies" class="center-block">
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block">
					   <? } ?>
						</div>
						<div class="feat-con">
						   <h1 class="section-title1">Add User In Downline</h1>
						   <p class="text-size-medium"><?=strip_tags($about['add_user_cont']);?></p>
						</div>
					 </div>
					 <div class="col-md-6">
						<div class="feat-con white">
						   <h1 class="section-title1"> Genelogy Tree Structure</h1>
						  <p class="text-size-medium"><?=strip_tags($about['genelogy_cont']);?></p>
						</div>
						<div class="feat-img text-center">
                       <?php if(!empty($about['genelogy_img']) && file_exists("uploads/cms/$about[genelogy_img]")){ ?>
						<img src="uploads/cms/<?=$about['genelogy_img'];?>" alt="MLM software dashboard">
						<?}else {?>
						<img src="uploads/no_image.jpg" class="center-block">
					   <? } ?>						
						
						</div>
					 </div>
				  </div>
			   </div>
			</div>
	
	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>