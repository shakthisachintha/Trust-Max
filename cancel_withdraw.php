<?php
include("admin/AMframe/config.php");
include("includes/function.php");
if (!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");

	echo "<script>window.location='index.php'</script>";
}

include("includes/head.php");

if (isset($_REQUEST['delete'])) {
	$delete = addslashes($_REQUEST['delete']);

	$del = $db->insertrec("delete from mlm_withdrawrequsets where req_id='$delete'");

	if ($del) {
		header("location:wallet.php?delsucc");
		echo "<script>window.location='wallet.php?delsucc';</script>";
	}
}

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
			<?php include("includes/profilemenu.php"); ?>
			<div class="col-sm-9">
				<div class="row">

					<?php
					if (isset($_REQUEST['cansucc'])) {

					?>
						<div align="center" style="color:#006600;">Your withdrawal request has been cancelled successfully !!!</div>

					<?php } ?>

					<?php
					if (isset($_REQUEST['delsucc'])) {

					?>
						<div align="center" style="color:#FF0000;">Request deleted Successfully !!!</div>

					<?php } ?>

					<div class="col-sm-12">
						<div class="banner">
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">CANCEL WITHDRAWAL REQUEST LIST </span></h4>
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>

										<tr>
											<td width="6%">
												<strong>SNO</strong></td>
											<td width="17%" style="text-align:left;">
												<strong>SUBJECT</strong></td>
											<td width="25%">
												<strong>MESSAGE</strong></td>
											<td width="10%">
												<strong>AMOUNT</strong></td>
											<td width="13%">
												<strong>DATE</strong></td>
											<td width="14%">
												<strong>STATUS</strong></td>
											<td width="15%">
												<strong>ACTION</strong>
											</td>
										</tr>
									</thead>
									<?php
									$reqq = $db->get_all("select * from mlm_withdrawrequsets where req_status='1' and req_userid='$_SESSION[userid]'");
									$nom_rows = $db->numrows("select * from mlm_withdrawrequsets where req_status='1' and req_userid='$_SESSION[userid]'");

									?>
									<?php if ($nom_rows == 0) : ?>


										<tr>
											<td style="color:#FF0000;" colspan="7" align="center"> No Request Found</td>
										</tr>

									<?php else : ?>
										<?php $i = 1; ?>
										<?php foreach ($reqq as $rreqq) : ?>

											<tr>
												<td><?= $i; ?></td>
												<td style="text-align:left;"><?= $rreqq['req_subject']; ?></td>
												<td><?= $rreqq['req_message']; ?></td>
												<td><?= $rreqq['req_cvamount']; ?></td>
												<td><?= date("d-m-Y", strtotime($rreqq['req_date'])); ?></td>
												<td class="font-weight-bold">
													<?php if ($rreqq['req_rpstatus'] == '0'): ?>
														<span class="text-danger">Pending</span>
													<?php else: ?>
														<span class="text-success">Replied</span>
													<?php endif; ?>
												</td>
												<td>
													<span>
														<a href="cancel_withdraw.php?delete=<?=$rreqq['req_id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to cancel this record')) { return true; } else { return false; }">DELETE</a>
													</span>
												</td>
											</tr>
											<?php $i++ ?>
										<?php endforeach; ?>
									<?php endif; ?>

								</table>
							</div>

						</div>
						
					</div>
				</div>
				<br />
				<?php include "includes/login-access-ads.php"; ?>
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