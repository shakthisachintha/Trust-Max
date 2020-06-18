<?php
include("admin/AMframe/config.php");
include("includes/function.php");
if (!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:login.php");

	echo "<script>window.location='login.php'</script>";
}

include("includes/head.php");

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container main">
		<!-- Start Header-->
		<?php include("includes/header.php"); ?>
		<!-- End Header-->
		<hr />
		<!-- Profile info -->
		<?php include("includes/profileheader.php");	?>
		<!-- Profile info end -->

		<hr />

		<div class="row">
			<?php include("includes/mailmenu.php"); ?>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						<div class="banner">
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">READ MAIL</h4>
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td width="6%">
												<strong>SNO</strong></td>
											<td width="15%" style="text-align:left;">
												<strong>Receiver Name</strong></td>
											<td width="14%">
												<strong>Profileid</strong></td>
											<td width="40%">
												<strong>Subject</strong></td>
											<td width="10%">
												<strong>DATE</strong></td>
											<td width="15%">
												<strong>ACTION</strong>
											</td>
										</tr>
									</thead>
									<?php
									$inb = $db->get_all("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1') ");
									$nom_rows = $db->numrows("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1')");
									if ($nom_rows == '0') { ?>
										<tr>
											<td style="color:#FF0000;" colspan="7" align="center"> No Records Found</td>
										</tr>

										<? }
									$i=1;
									foreach($inb as $rinb) 
									{
										
									if($rinb['outbox_usertype']!="1")	
									{	
									
									$useinb=$db->singlerec("select * from mlm_register where user_id='$rinb[outbox_toupid]'");
									$useroutname=$useinb['user_fname'];
									}
									else
									{
										$useroutname="Administrator";
									}
									?>

										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td style="text-align:left;">
												<?php echo $useroutname; ?>
											</td>
											<td>
												<?php echo $rinb['outbox_toprofileid']; ?>
											</td>
											<td>
												<?php echo $rinb['outbox_subject']; ?>
											</td>

											<td>
												<?php echo date("d-m-Y h:i:s", strtotime($rinb['outbox_date'])); ?>
											</td>
											<td>
												<a href="mailview.php?msgview=<?php echo $rinb['outbox_id']; ?>">VIEW</a>
											</td>
										</tr>
									<?php $i++;
									} ?>

								</table>
							</div>
						</div>
						<div>


						</div>
					</div>
				</div>
				<br />
			</div>

		</div>

		<?php include("includes/footer.php"); ?>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>

	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
</body>

</html>