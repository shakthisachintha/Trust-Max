<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");



if(isset($_REQUEST['cancel'])){
	
	$wishlistID=addslashes($_REQUEST['cancel']);
	
	$db->insertrec("update mlm_wishlist set status='0' where profile_id='$_SESSION[profileid]' and id='$wishlistID'");
	echo "<script>location.href='my-wishlist.php';</script>";
	header("Location: my-wishlist.php");
	exit;
		
}

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- style pie chart-->
<style>
#flotcontainer1 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer2 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer3 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
</style>
<!-- end-->
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
			
		<!--	<hr />-->
			
			<div class="row" >
			
				<!-- left div here -->
				<div style="margin-top:30px;">
                <?php include("includes/profilemenu.php"); ?>
				</div>
                
				<div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner">								
<!-- cc  -->		
							
							
					</div>
				   
					<div>
						<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">My Wishlist</h4>
						<div class="table-responsive">
						
						 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<td width="8%"><strong>S.No</strong></td>
							<td width="18%"><strong>Product Name</strong></td>
							<td width="15%"><strong>Amount</strong></td>
							<td width="15%"><strong>Rating</strong></td>
							<td width="15%"><strong>Remove</strong></td>
							
						</tr>
						</thead>
						<?php
						$i=1;
						$blankspc=$db->get_all("select * from mlm_wishlist where profile_id='$_SESSION[profileid]' and status='1'");
                        if(count($blankspc)!='0'){ 						
						foreach($blankspc as $bspc) {
							 $prodId = $bspc['product_id'];
						$prod_details=$db->singlerec("select * from mlm_products where pro_id='$prodId'");	
						
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?=$prod_details['pro_name']?></td>
							<td><span><strike><?=$prod_details['pro_cost'].' '.$sitecurrency.'</strike>'.' / '.$prod_details['pro_pv'].'  '.$sitecurrency?></span></td>
							<td><div class="rating"><? echo get_Rate2($prod_details['pro_id']); ?></div></td>
							<td><a href="my-wishlist.php?cancel=<?php echo $bspc['id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to remove the product')) { return true; } else { return false; }">Remove</a></td>
							
						</tr>
						<?php $i++; } } else { echo "<tr><td colspan='7'><p style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</p></td></tr>"; }?>
						</table>
						
						
						</div>
					</div>
					<br>
				</div>	
</div>	
<?php include "includes/login-access-ads.php";?>			
</div>				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>

		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		
		
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

</script>

<!-- end -->
		
		
	</body>
</html>