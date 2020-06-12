<?php 
include "admin/AMframe/config.php"; 
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}
$userId = $_SESSION['profileid'];

$drlRecords = $db->get_all("select * from mlm_drl where user_id='$userId'");


if(isset($_REQUEST['submitDrl']))
{    
    if(isset($_REQUEST['ammount']) && !empty($_REQUEST['ammount']) && isset($_REQUEST['month']) && !empty($_REQUEST['month'])){
        $amount = $_REQUEST['ammount'];
        $month = $_REQUEST['month'];

        $date = date("Y-m-d");
        

        $set = "user_id = '$userId'";
        $set .= ", amount= '$amount'";
        $set .= ", date= '$month'";
        $set .= ", submitted_at= '$date'";
        $insertrec=$db->insertrec("insert into mlm_drl set $set");
		header("location:drlIncome.php?update");
    }
	
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
                            <form action="" method="POST">
                            <?php if(isset($update) && empty($imgerr) ){ ?>
                                <div class="alert alert-success">
                                    <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span> 
                                    Request send to admin panel for approval Successfully!!. 
                                </div>
                            <?php } ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><h2>Direct Renewal loyalty Income (DRL)</h2></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><b>Ammount: <span class="required">*</span></b> </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="number" name="ammount" required="true"  value="2020-05" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><b>For Month: <span class="required">*</span></b> </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="month" name="month" required="true" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="text-align:right">
                                    <input class="btn btn-success" type="submit" name="submitDrl" value="Submit" />
                                </div>
                            </div>
                            </form>

                            <div class="panel panel-default">
                                <div class="panel-heading"><h2>Incomes from DRL's</h2></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover"> 
                                            <thead> 
                                                <tr> 
                                                    <th><strong>Month</strong></th> 
                                                    <th>Amount</th>
                                                    <th>Submitted At</th>
                                                    <th>Status</th>
                                                    <th>Income</th>
                                                </tr> 
                                            </thead> 
                                            <tbody> 
                                                <?php $cmuEarn = 0; ?>
                                                <?php foreach ($drlRecords as $key => $rec) { ?>
                                                <tr> 
                                                    <td><strong><?php echo $rec['date']?></strong></td>
                                                    <td><?php echo $rec['amount']?></td>
                                                    <td><?php echo $rec['submitted_at']?></td>
                                                    <td><?php echo $rec['status'] ? '<span class="label label-success">Approved</span>' : '<span class="label label-warning">Pending</span>' ?></td>
                                                    <?php $earned = round(($rec['amount'] * 5) / 100);  ?>
                                                    <td><?php echo $rec['status'] ? $earned : '-'; ?> USD</td>
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