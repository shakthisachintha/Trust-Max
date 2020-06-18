<?php include('./includes/heading.php') ?>
<style>
	p {
		color: #a0a0a0;
		font-family: monospace;
		font-size: x-large;
	}
</style>

<body class="bg-light">

	<!-- Navbar section -->
	<?php include("includes/navbar.php") ?>
	<!-- End Navbar section -->


	<!-- Main Content -->
	<div class="container p-0">
		<div class="row mt-4 mb-4">

			<div class="col-lg-4">
				<?php include("includes/profile-card.php") ?>
			</div>
			<!-- <div class="col-lg-1"></div> -->
			<div class="col-lg-8">
				<div class="bg-white shadow-sm p-4">
					<h4 class="mt-2 text-info mb-4">Profile</h4>
					<div class="row m-b30">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">First Name:</h6>
								<p type="text"><?php echo $userdetail['user_fname']; ?></p>
							</div>
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Last Name:</h6>
								<p type="text" class=""><?php echo $userdetail['user_lname']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Email id:</h6>
								<p type="text" class=""><?php echo $userdetail['user_email']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Sponsor Name:</h6>
								<p type="text" class=""><?php echo $userdetail['user_sponsername']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Sponsor id:</h6>
								<p type="text" class=""><?php echo $userdetail['user_sponserid']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Placement Id:</h6>
								<p type="text" class=""><?php echo $userdetail['user_placementid']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Position:</h6>
								<p type="text" class=""><?php echo $userdetail['user_position']; ?></p>
							</div>
						</div>

					</div>

					<div class="job-bx-title clearfix">
						<h4 class="font-weight-700 mt-3 mb-3 text-info pull-left text-uppercase">Personal Details</h4>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Pancard Number:</h6>
								<p type="text" class=""><?php echo $userdetail['user_pancard']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">D.O.B:</h6>
								<p type="text" class=""><?php echo date("d-m-Y", strtotime($userdetail['user_dob'])); ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Phone:</h6>
								<p type="text" class=""><?php echo $userdetail['user_phone']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Name as per Bank:</h6>
								<p type="text" class=""><?php echo $userdetail['user_accholdername']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">IFSC Code:</h6>
								<p type="text" class=""><?php echo $userdetail['user_ifsccode']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Bank Account No:</h6>
								<p type="text" class=""><?php echo !empty($userdetail['user_accno']) ? $userdetail['user_accno'] : ''; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Bank Name:</h6>
								<p type="text" class=""><?php echo $userdetail['user_bankname']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Branch:</h6>
								<p type="text" class=""><?php echo $userdetail['user_branch']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Communication Address:</h6>
								<p type="text" class=""><?php echo $userdetail['user_commaddr1']; ?>,<?php echo $userdetail['user_commaddr2']; ?><br>
									<?php echo getcity($userdetail['user_city']); ?>,<?php echo getstate($userdetail['user_state']); ?><br>
									<?php echo getcountry($userdetail['user_country']); ?>,<?php echo $userdetail['user_postalcode']; ?><br></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Permanent Address:</h6>
								<p type="text" class=""><?php echo $userdetail['user_paddr1']; ?>,<?php echo $userdetail['user_paddr2']; ?><br>
									<?php echo getcity($userdetail['user_pcity']); ?>,<?php echo getstate($userdetail['user_pstate']); ?><br>
									<?php echo getcountry($userdetail['user_pcountry']); ?>,<?php echo $userdetail['user_ppostalcode']; ?><br></p>
							</div>
						</div>
					</div>
					<div class="job-bx-title clearfix">
						<h4 class="font-weight-700 mt-3 mb-3 text-info pull-left text-uppercase">Nominee Details</h4>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Nominee Name:</h6>
								<p type="text" class=""><?php echo $userdetail['user_nomineename']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Email id:</h6>
								<p type="text" class=""><?php echo $userdetail['user_nemail']; ?> </p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Id cardtype:</h6>
								<p type="text" class=""><?php echo $userdetail['user_identifycardtype']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Id Number:</h6>
								<p type="text" class=""><?php echo $userdetail['user_idnumber']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Address:</h6>
								<p type="text" class=""><?php echo $userdetail['user_naddr1']; ?>,<?php echo $userdetail['user_naddr2']; ?><br>
									<?php echo getcity($userdetail['user_ncity']); ?>,<?php echo getstate($userdetail['user_nstate']); ?><br>
									<?php echo getcountry($userdetail['user_ncountry']); ?>,<?php echo $userdetail['user_npostalcode']; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<h6 class="font-weight-bolder">Phone Number:</h6>
								<p type="text" class=""><?php echo !empty($userdetail['user_nphone']) ? $userdetail['user_nphone'] : ''; ?></p>
							</div>
						</div>


						<div class="col-lg-12 col-md-12 text-center">
							<a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- End Main Content -->


	<!-- Footer Section -->
	<div class="container">
		<div class="row mt-3 mb-3">
			<?php include "includes/login-access-ads.php"; ?>
		</div>
	</div>


	<?php include("./includes/footer.php") ?>

	<!-- End Footer -->


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- Optional JavaScript -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#example1').DataTable();

		});
	</script>
</body>

</html>