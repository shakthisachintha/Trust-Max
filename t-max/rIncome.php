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
                            <pre>
                                    <?php $pairs = $com_obj->userPairsNew($userdetail['user_profileid']); ?>
                                    </pre>
                                    <br>
                                <div class="panel-heading"><h2>Residual Incomes: </h2></div>
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