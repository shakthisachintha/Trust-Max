<?php 
include "admin/AMframe/config.php"; 
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
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
			<?php include("includes/profileheader.php"); ?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Purchase list</h4>
								<?php
									if(isset($prdsucc)) {
										echo "<h4 style='color:green;font-weight:bold;'>You purchase has been completed successfully!</h4>";
									}
									else if(isset($prdfail)) {
										echo "<h4 style='color:red;font-weight:bold;'>You purchase has been failed. Please try again!</h4>";
									}
									else if(isset($sus)) {
										echo "<center><h5 style='color:green;font-weight:bold; '>Product purchased successfully. Your paid status will br active after approval from admin</h5></center>";
									}
									?>
								<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									
									<thead>
									<tr>
										<td width="10%">
											<strong>S.No</strong>
										</td>
										<td width="20%" style="text-align:left;">
											<strong>Product Name</strong>
										</td>
										<td width="20%">
											<strong>Product Cost</strong>
										</td>
										<td width="10%">
											<strong>Quantity</strong>
										</td>
										<td width="10%">
											<strong>Pay Type</strong>
										</td>
										<td width="10%">
											<strong>Repurchase</strong>
										</td>
										<td width="20%">
											<strong>Date</strong>
										</td>
										<td width="20%">
											<strong>Action</strong>
										</td>
										
									</tr>
									</thead>
									<?php
									$pur=$db->get_all("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_product!='0' order by pay_id desc ");
									
									$nom_rows=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_product!='0'");
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="7" align="center"> No Records Found</td>
										</tr>
									
									<?php }
									$i=1;
								
								foreach($pur as $rpur) 
									{
									if($rpur['pay_payment']==0) $status="Processing";
									else if($rpur['pay_payment']==1) $status="Paid";
									else $status="Failed";
									$proname=$db->singlerec("select * from mlm_products where pro_id='$rpur[pay_product]'");
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $proname['pro_name'];?>
										</td>
										<td>
											<?php echo $rpur['pay_amount']." ".$sitecurrency;?>
										</td>
										<td>
											<?php echo $rpur['pay_qty']; ?>
										</td>
										<td>
											<?php echo $rpur['pay_type']; ?>
										</td>
										<td>
											<?php echo ($rpur['is_repurchase'])?"Yes":"No"; ?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rpur['pay_date']));?>
										</td>
										<td>
											<?php echo $status; ?>
										</td>
										
									</tr>
									<?php $i++; } ?>		
										
									
									</table>
								    </div>
							</div>
							 <div>
						
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
		
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		
		
		<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

</script>
	</body>
</html>