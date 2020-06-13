<?php include "includes-new/header.php";
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

 ?>

		<!-- Page Conttent -->
	<main class="page-content">
	  
<div class="section-full bg-white section-padding-xs browse-job p-t50 p-b20">
	<div class="container">
		<div class="row">
			<?php include "includes-new/left-menu.php" ?>
			<div class="col-xl-9 col-lg-8 m-b30">
				<div class="job-bx job-profile">
					<div class="job-bx-title clearfix">
						<h5 class="font-weight-700 pull-left text-uppercase">User Profile</h5>
						
					</div>
					<form>
						<div class="row m-b30">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>First Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_fname']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Second Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_secondname']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Last Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_lname']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Email id:</label>
									<p type="text" class="" ><?php echo $userdetail['user_email']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Sponsor Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_sponsername']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Sponsor id:</label>
									<p type="text" class="" ><?php echo $userdetail['user_sponserid']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Placement Id:</label>
									<p type="text" class="" ><?php echo $userdetail['user_placementid']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Position:</label>
									<p type="text" class="" ><?php echo $userdetail['user_position'];?></p>
								</div>
							</div>
						
						</div>
						
						<div class="job-bx-title clearfix">
							<h5 class="font-weight-700 pull-left text-uppercase">Personal Details</h5>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Pancard Number:</label>
									<p type="text" class="" ><?php echo $userdetail['user_pancard']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>D.O.B:</label>
									<p type="text" class="" ><?php echo date("d-m-Y",strtotime($userdetail['user_dob'])); ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Phone:</label>
									<p type="text" class="" ><?php echo $userdetail['user_phone']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Name as per Bank:</label>
									<p type="text" class="" ><?php echo $userdetail['user_accholdername']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>IFSC Code:</label>
									<p type="text" class="" ><?php echo $userdetail['user_ifsccode']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Bank Account No:</label>
									<p type="text" class="" ><?php echo !empty($userdetail['user_accno'])?$userdetail['user_accno']:''; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Bank Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_bankname']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Branch:</label>
									<p type="text" class="" ><?php echo $userdetail['user_branch']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Communication Address:</label>
									<p type="text" class="" ><?php echo $userdetail['user_commaddr1']; ?>,<?php echo $userdetail['user_commaddr2']; ?><br>
									<?php echo getcity($userdetail['user_city']); ?>,<?php echo getstate($userdetail['user_state']); ?><br>
									<?php echo getcountry($userdetail['user_country']); ?>,<?php echo $userdetail['user_postalcode']; ?><br></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Permanent Address:</label>
									<p type="text" class="" ><?php echo $userdetail['user_paddr1']; ?>,<?php echo $userdetail['user_paddr2']; ?><br>
									<?php echo getcity($userdetail['user_pcity']); ?>,<?php echo getstate($userdetail['user_pstate']); ?><br>
									<?php echo getcountry($userdetail['user_pcountry']); ?>,<?php echo $userdetail['user_ppostalcode']; ?><br></p>
								</div>
							</div>
						</div>
						<div class="job-bx-title clearfix">
							<h5 class="font-weight-700 pull-left text-uppercase">Nominee Details</h5>
						</div>
						<div class="row">
						    <div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Nominee Name:</label>
									<p type="text" class="" ><?php echo $userdetail['user_nomineename']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Email id:</label>
									<p type="text" class="" ><?php echo $userdetail['user_nemail']; ?> </p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Id cardtype:</label>
									<p type="text" class="" ><?php echo $userdetail['user_identifycardtype']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Id Number:</label>
									<p type="text" class="" ><?php echo $userdetail['user_idnumber']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Address:</label>
									<p type="text" class="" ><?php echo $userdetail['user_naddr1']; ?>,<?php echo $userdetail['user_naddr2']; ?><br>
						<?php echo getcity($userdetail['user_ncity']); ?>,<?php echo getstate($userdetail['user_nstate']); ?><br>
						<?php echo getcountry($userdetail['user_ncountry']); ?>,<?php echo $userdetail['user_npostalcode']; ?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>Phone Number:</label>
									<p type="text" class="" ><?php echo !empty($userdetail['user_nphone'])?$userdetail['user_nphone']:''; ?></p>
								</div>
							</div>
							
							
							<div class="col-lg-12 col-md-12 text-center">
							  <a href="editprofile.php" class="site-button m-b30">Edit Profile</a>
							</div>
						</div>
						
					</form>
				</div>    
			</div>
		</div>
	</div>
</div>

	</main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>
<script>

$(document).ready(function(){
    function checkTreeCollaps() {
    $(".tree-container li.tree-li").removeClass("is-child")
        $(".tree-container li.tree-li").each(function () {
            if ($(this).find("ul.tree-ul li").length > 0) {
                $(this).addClass("is-child")
            }
        });

    $(".tree-container li.tree-li span.text").unbind("click");
        $(".tree-container li.tree-li.is-child span.text").click(function () {
            $(this).parent(".tree-li").toggleClass("diactive");
            $(this).parent(".tree-li").find(".tree-ul:first").toggleClass("diactive");
        });
}

checkTreeCollaps()

});</script>