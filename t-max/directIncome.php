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
                            <ul class="nav nav-pills">
                                <li role="presentation"><a href="directIncome.php" style="font-size: 20px;">Direct Income</a></li>
                                <li role="presentation"><a href="drlIncome.php" style="font-size: 20px;">DRL Income</a></li>
                                <li role="presentation"><a href="rIncome.php" style="font-size: 20px;">Residual Income</a></li>
                            </ul>
                            <br><br>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading"><h2>Direct Incomes: <?php echo $com_obj->newTotalBal($userdetail['user_profileid'])['di']." ".$sitecurrency;; ?></h2></div>
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