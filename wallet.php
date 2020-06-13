<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}
$userId = $_SESSION['profileid'];
$drlRecords = $db->get_all("select * from mlm_drl where sponsor_id='$userId' and status=1");
$adminTrans = $ats = $db->get_all("select amount, drCr, message, submitted_at from mlm_transaction where user_id='$userId'");
$bal = 0;
$dr = 0;
$cr = 0;
foreach($adminTrans as $at){
    if($at['drCr'] == 1){
        $dr += $at['amount'];
    }else{
        $cr += $at['amount'];
    }
}
echo $dr.' <br>';
echo $cr.' <br>';
echo ($dr - $cr).' <br>';
$balance = $dr - $cr;

include("includes/head.php");


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
							<ul class="nav nav-pills">
                                <li role="presentation"><a href="send_withdraw.php" style="font-size: 20px;">Withdraw Request</a></li>
                                <li role="presentation"><a href="cancel_withdraw.php" style="font-size: 20px;">Cancelled Request</a></li>
                            </ul>
                            <br><br>		 
								<hr style="border: 1px solid #f5f5f5;" />
								<div class="clearfix"></div>
								<div class="row" style="text-align:center;">
									<?php $newTotalBal = $com_obj->newTotalBal($userdetail['user_profileid']); ?>
									<?php $availBalance = $com_obj->newApprovedBal($userdetail['user_profileid']); ?>
									<?php $withdrawBal = $com_obj->withdrawBal($userdetail['user_profileid']); ?>

                                    <?php 
                                        $total = $newTotalBal['di'] + $newTotalBal['drl'] + $newTotalBal['ri'] + $newTotalBal['at'];
                                        $available = $availBalance['di'] + $availBalance['drl'] + $availBalance['ri'] + $availBalance['at'];

                                        $withdraw = $available - $withdrawBal;
                                        $pending = $total - $withdrawBal;
                                    ?>

									<div style="padding:0; margin: 0; width:100%;">
										<!-- <div style="" class="col-sm-3 col-xs-12">
											<label class="cb-enable selected">
												<span> Rank </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $userdetail['user_rank']; ?></span>
											</label>
										</div> -->
										<div style="" class="col-sm-4 col-xs-12">
											<label class="cb-enable selected">
												<span> Total Balance </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $total." ".$sitecurrency; ?></span>
											</label>
										</div>
										<div style="" class="col-sm-4 col-xs-12">
											<label class="cb-enable selected">
											<span>Available Amount </span>
											</label>
											<label class="cb-disable">
											<span style="min-width:50px;"><?php  echo $withdraw." ".$sitecurrency ; ?></span>
											</label>
										</div>
										<div style="" class="col-sm-4 col-xs-12">
											<label class="cb-enable selected">
											<span>Pending Balance </span>
											</label>
											<label class="cb-disable"><span style="min-width:50px;"><?php  echo $pending." ".$sitecurrency; ?></span></label>
										</div>
									</div>
							</div>
							<br><br>
							<div class="panel panel-default">
                                <div class="panel-heading"><h2>Direct Income</h2></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th><strong>#ID</strong></th> 
                                                            <th>Name</th>
                                                            <th>From</th>
                                                            <th>Earning</th>
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <?php $cmuEarn = 0; ?>
                                                        <?php foreach ($com_obj->userReferalls($userdetail['user_profileid']) as $key => $sp) { ?>
                                                        <tr> 
                                                            <td><strong><?php echo $sp['user_profileid']?></strong></td>
                                                            <td><?php echo $sp['user_fname'].' '.$sp['user_lname']?></td>
                                                            <td><?php echo $sp['user_city'].' '.$sp['user_state'].' '.$sp['user_country']?></td>
                                                            <td>20 USD</td>
                                                            <?php $cmuEarn += 20; ?>
                                                        </tr> 
                                                        <?php } ?>
                                                        <tr> 
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><strong>Total: <?php echo $cmuEarn ?> USD</strong></td>
                                                        </tr> 
                                                    </tbody> 
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><div class="panel panel-default">
                                <div class="panel-heading"><h2>Admin Transactioon</h2></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover"> 
                                            <thead> 
                                                <tr> 
                                                    <th><strong>DR or CR</strong></th>
                                                    <th>Amount</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                </tr> 
                                            </thead> 
                                            <tbody> 
                                                <?php foreach ($adminTrans as $key => $rec) { ?>
                                                <tr> 
                                                    <td><strong><?php echo $rec['drCr'] ? 'Dr' : 'Cr' ?></strong></td>
                                                    <td><strong><?php echo $rec['amount']?></strong></td>
                                                    <td><strong><?php echo $rec['message']?></strong></td>
                                                    <td><strong><?php echo $rec['submitted_at']?></strong></td>
                                                </tr>
                                                <?php } ?>
                                                <tr> 
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total: <?php echo $balance ?> USD</td>
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>
                            </div>
							<br><br>
							<br><br><div class="panel panel-default">
                                <div class="panel-heading"><h2>Income from DRL's</h2></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover"> 
                                            <thead> 
                                                <tr> 
                                                    <th><strong>From User</strong></th>
                                                    <th>Date</th>
                                                    <th>Income</th>
                                                </tr> 
                                            </thead> 
                                            <tbody> 
                                                <?php $cmuEarn = 0; ?>
                                                <?php foreach ($drlRecords as $key => $rec) { ?>
                                                <tr> 
                                                    <td><strong><?php echo $rec['user_id']?></strong></td>
                                                    <td><strong><?php echo $rec['date']?></strong></td>
                                                    <?php $earned = round(($rec['amount'] * 5) / 100);  ?>
                                                    <td><?php echo $rec['status'] ? $earned.' USD' : '-'; ?></td>
                                                    <?php 
                                                        if($rec['status']){
                                                            $cmuEarn += $earned;
                                                        }                                                    
                                                    ?>
                                                </tr>
                                                <?php } ?>
                                                <tr> 
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total: <?php echo $cmuEarn ?> USD</td>
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </div>
                                </div>
                            </div>
							<br><br>
							<div class="panel panel-default">
                                    <?php $pairs = $com_obj->userPairsNew($userdetail['user_profileid']); ?>
                                    <!-- <pre>
                                        <?php 
                                            print_r($pairs);
                                            // die();
                                        ?>
                                    </pre> -->
                                    <br>
                                <div class="panel-heading"><h2>Residual Income: </h2></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th><strong>Level</strong></th> 
                                                            <th><strong>Level Pairs</strong></th> 
                                                            <th>Pairs</th>
                                                            <th>Pair Earned</th>
                                                            <th>Level Income</th>
                                                        </tr> 
                                                    </thead> 
                                                    <tbody> 
                                                        <?php $grdTot = 0 ?>
                                                        <?php foreach ($pairs['levels'] as $key =>$sp) { ?>
                                                        <tr> 
                                                            <td style='text-align:center;vertical-align:middle'><strong><?php echo $key ?></strong></td>
                                                            <?php $total = $sp['tot'] ?>
                                                            <td style='text-align:center;vertical-align:middle'><strong><?php echo "<span class='badge'>$total</span>" ?></strong></td>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td><strong>Sponsors</strong></td>
                                                                        <td><strong>Paired At</strong></td>
                                                                    </tr>
                                                                    <?php foreach ($sp['pairs'] as $key =>$p) { ?>
                                                                        <?php 
                                                                            $paired = date("Y-m-d", $p[0]);
                                                                            $lId = $p[1]['id'];
                                                                            $rId = $p[2]['id'];
                                                                            $lName = $p[1]['name'];
                                                                            $rName = $p[2]['name'];
                                                                            $lDate = $p[1]['date'];
                                                                            $rDate = $p[2]['date'];
                                                                        ?>
                                                                        <tr>
                                                                            <td><strong><?php echo "<span class='label label-primary'>$lId - $rId</span>" ?></strong></td>
                                                                            <td><strong>
                                                                                <span class='label label-primary'><?php echo $paired  ?></span>
                                                                            </strong></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            </td>
                                                            <td style='text-align:center;vertical-align:middle'><strong><?php echo $sp['tot'].' * '. 20  ?></strong></td>
                                                            <td style='text-align:center;vertical-align:middle'><strong><?php echo $sp['tot'] * 20 ?></strong></td>

                                                            <?php $grdTot += $sp['tot'] * 20; ?>
                                                        </tr> 
                                                        <?php } ?>
                                                        <tr> 
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><strong>Total Income: <?php echo $grdTot ?> USD</strong></td>
                                                        </tr> 
                                                    </tbody> 
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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