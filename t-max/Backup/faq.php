<?php include "includes-new/header.php";
$faqs = $db->get_all_assoc("select * from mlm_faq where faq_status=0");
 ?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>FAQ</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>FAQ</li>
                            </ul>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">

		   <!-- Frequently Ask Question Area -->
			<div class="frequently-ask-question-area in-section section-padding-xs bg-white">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="section-title text-center">
								
								<h2>Frequently Ask Question</h2>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12">
                            <div class="faequently-accordion">
                                <!--panel body start-->
                                <?php foreach($faqs as $i=>$fq){?>
                                <h4 <?php if($i==0){ ?>class="open"<?}?>> <?=$i+1;?>. <?=$fq['faq_qtn'];?></h4>
                                <div class="faequently-description">
                                   <p> <?=$fq['faq_ans'];?></p>
                                </div>
                                <?php } ?>
                                <!--panel body end-->
                                
                                <!--panel body end-->
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<!--// Frequently Ask Question Area -->		

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>