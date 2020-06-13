<?php include "includes-new/header.php";
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
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
					<h5 class="font-weight-700 pull-left text-uppercase">Purchase list</h5>
					
				</div>
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
				<div class="col-sm-12 mt20i">
					
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-striped ">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Product Name</th>
									<th>Product Cost</th>
									<th>Quantity</th>
									<th>Pay Type</th>
									<th>Repurchase</th>
									<th>Date</th>
									<th>Action</th>
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
					
					</div>
					
				
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