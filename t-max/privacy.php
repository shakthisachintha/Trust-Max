<?php include "includes-new/header.php";

?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>Privacy Policy</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Privacy Policy</li>
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
								
								<h2>Privacy Policy</h2>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12">
                          <?php
							$privacy = $db->extract_single("select cms_privacy from mlm_cms where cms_id='1'");
							echo stripslashes($privacy);
							?>
                        </div>
					</div>
				</div>
			</div>
			<!--// Frequently Ask Question Area -->		

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>