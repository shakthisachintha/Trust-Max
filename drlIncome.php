<?php 
include "admin/AMframe/config.php"; 
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}
$userId = $_SESSION['profileid'];

$drlRecords = $db->get_all("select * from mlm_drl where sponsor_id='$userId' and status=1");


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
                            <ul class="nav nav-pills">
                                <li role="presentation"><a href="directIncome.php" style="font-size: 20px;">Direct Income</a></li>
                                <li role="presentation"><a href="drlIncome.php" style="font-size: 20px;">DRL Income</a></li>
                                <li role="presentation"><a href="rIncome.php" style="font-size: 20px;">Residual Income</a></li>
                            </ul>
                            <br><br>

                            <div class="panel panel-default">
                                <div class="panel-heading"><h2>Incomes from DRL's</h2></div>
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