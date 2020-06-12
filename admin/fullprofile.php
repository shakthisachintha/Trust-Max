<?php 
include("admin/AMframe/config.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

?>

<style>
.profl_all .form-group label {
    font-size: 15px;
    color: #848484;
}
</style>
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			<hr />
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<ul class="nav nav-pills">
                                <li role="presentation"><a href="editprofile.php" style="font-size: 20px;">Edit profile</a></li>
                                <li role="presentation"><a href="changepassprofile.php" style="font-size: 20px;">Change Password</a></li>
                                <li role="presentation"><a href="photo.php" style="font-size: 20px;">Upload profile Image</a></li>
                            </ul>
                            <br>
							<div class="banner" style="padding-right: 0;">
								<div class="row">
		<div class="col-sm-12">
		   <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Basic Details</h4>
		</div>
			<form class="profl_all">
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">First Name</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_fname']; ?></p>
				   </div>
			   </div>
			   
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Second Name</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_secondname']; ?></p>
				   </div>
			   </div>
			   <div class="clearfix"></div>
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Last Name</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_lname']; ?></p>
				   </div>
			   </div>
			   
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Email id</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_email']; ?></p>
				   </div>
			   </div>
			   <div class="clearfix"></div>
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Sponsor Name</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_sponsername']; ?></p>
				   </div>
			   </div>
			   
			   
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Sponsor id</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_sponserid']; ?></p>
				   </div>
			   </div>
			   <div class="clearfix"></div>
			   
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Placement Id</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_placementid']; ?></p>
				   </div>
			   </div>
			   
			   
			   <div class="col-sm-6">
				   <div class="form-group">
					   <label class="control-label col-sm-5 col-xs-6">Position</label>
					   <label class="col-sm-1 hidden-xs">:</label>
					   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_position'];?></p>
				   </div>
			   </div>
			</form>
	</div>
	<hr />
	
	<div class="row">
		<div class="col-sm-12">
		   <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Personal Details</h4>
		</div>
		<form class="profl_all">
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Pancard Number</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_pancard']; ?></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">D.O.B</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo date("d-m-Y",strtotime($userdetail['user_dob'])); ?></p>
			   </div>
		   </div>
		   <div class="clearfix"></div>
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Phone</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_phone']; ?></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Name as per Bank</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_accholdername']; ?></p>
			   </div>
		   </div>
		   <div class="clearfix"></div>
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">IFSC code</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_ifsccode']; ?></p>
			   </div>
		   </div>
		   
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Bank Account No</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo !empty($userdetail['user_accno'])?$userdetail['user_accno']:''; ?></p>
			   </div>
		   </div>
		   <div class="clearfix"></div>
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Bank Name</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_bankname']; ?></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Branch</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_branch']; ?></p>
			   </div>
		   </div>
		   <div class="clearfix"></div>
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Communication Address</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_commaddr1']; ?>,<?php echo $userdetail['user_commaddr2']; ?><br>
							<?php echo getcity($userdetail['user_city']); ?>,<?php echo getstate($userdetail['user_state']); ?><br>
							<?php echo getcountry($userdetail['user_country']); ?>,<?php echo $userdetail['user_postalcode']; ?><br></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Permanent Address</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_paddr1']; ?>,<?php echo $userdetail['user_paddr2']; ?><br>
							<?php echo getcity($userdetail['user_pcity']); ?>,<?php echo getstate($userdetail['user_pstate']); ?><br>
							<?php echo getcountry($userdetail['user_pcountry']); ?>,<?php echo $userdetail['user_ppostalcode']; ?><br></p>
			   </div>
		   </div>
		</form>
	</div>
	<hr />
	<div class="row">
		<div class="col-sm-12">
		   <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Nominee Details</h4>
		</div>
		<form class="profl_all">
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Nominee Name</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"> <?php echo $userdetail['user_nomineename']; ?></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Email id</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_nemail']; ?> </p>
			   </div>
		   </div>
		   <div class="clearfix"></div>
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Id cardtype</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_identifycardtype']; ?>  </p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Id Number</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo $userdetail['user_idnumber']; ?>  </p>
			   </div>
		   </div>
			<div class="clearfix"></div>
		  <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Address</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"> <?php echo $userdetail['user_naddr1']; ?>,<?php echo $userdetail['user_naddr2']; ?><br>
						<?php echo getcity($userdetail['user_ncity']); ?>,<?php echo getstate($userdetail['user_nstate']); ?><br>
						<?php echo getcountry($userdetail['user_ncountry']); ?>,<?php echo $userdetail['user_npostalcode']; ?><br></p>
			   </div>
		   </div>
		   
		   <div class="col-sm-6">
			   <div class="form-group">
				   <label class="control-label col-sm-5 col-xs-6">Phone Number</label>
				   <label class="col-sm-1 hidden-xs">:</label>
				   <p class="col-sm-6 col-xs-6"><?php echo !empty($userdetail['user_nphone'])?$userdetail['user_nphone']:''; ?>  </p>
			   </div>
		   </div>
		</form>
	</div>
								
								
							</div>
                        </div>
                    </div>
                    <br />
					<?php include "includes/login-access-ads.php";?>
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>