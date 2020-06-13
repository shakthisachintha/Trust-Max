<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

$pay_sum_s = $db->extract_single("SELECT SUM(pay_amount) as sum from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 1");

if($pay_sum_s == NULL || $pay_sum_s == ''){$pay_sum_s = 0;}

$pay_sum_f = $db->extract_single("SELECT SUM(pay_amount) as sum from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 0");

if($pay_sum_f == NULL || $pay_sum_f == ''){$pay_sum_f = 0;}

$pur_num_s=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1");
				
$puram_sum_s=$db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1");

$pur_num_p=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0");
				
$puram_sum_p=$db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0");

$pur_num_f=$db->numrows("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2");
				
$puram_sum_f=$db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2");

if($pur_num_s == NULL || $pur_num_s == ''){$pur_num_s=0;}
if($pur_num_p == NULL || $pur_num_p == ''){$pur_num_p=0;}
if($pur_num_f == NULL || $pur_num_f == ''){$pur_num_f=0;}

if($puram_sum_s == NULL || $puram_sum_s == ''){$puram_sum_s=0;}
if($puram_sum_p == NULL || $puram_sum_p == ''){$puram_sum_p=0;}
if($puram_sum_f == NULL || $puram_sum_f == ''){$puram_sum_f=0;}


	$d4 = date('Y-m-d', strtotime(date('Y-m-d')." -4 week")); 
	$d3 = date('Y-m-d', strtotime(date('Y-m-d')." -3 week")); 
	$d2 = date('Y-m-d', strtotime(date('Y-m-d')." -2 week")); 
	$d1 = date('Y-m-d', strtotime(date('Y-m-d')." -1 week")); 
	$d0 = date('Y-m-d', strtotime(date('Y-m-d')));
	
	$psum_d4 = array();
	$psum_d3 = array();
	$psum_d2 = array();
	$psum_d1 = array();
	
	for($i=0;$i<3;$i++)
	{
	$row1 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d4' and '$d3') AND pay_payment=$i");
	$psum_d4[$i] = $row1;
	if($psum_d4[$i] == NULL || $psum_d4[$i] == ""){$psum_d4[$i] = 0;}	
	
	$row2 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d3' and '$d2') AND pay_payment=$i");
	$psum_d3[$i] = $row2;
	if($psum_d3[$i] == NULL || $psum_d3[$i] == ""){$psum_d3[$i] = 0;}

	$row3 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d2' and '$d1') AND pay_payment=$i");
	$psum_d2[$i] = $row3;
	if($psum_d2[$i] == NULL || $psum_d2[$i] == ""){$psum_d2[$i] = 0;}
	
	$row4 = $db->extract_single("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d1' and '$d0') AND pay_payment=$i");
	$psum_d1[$i] = $row4;
	if($psum_d1[$i] == NULL || $psum_d1[$i] == ""){$psum_d1[$i] = 0;}
	
	}
	
$psum_d4[3] = $psum_d4[2] + $psum_d4[1] + $psum_d4[0];
$psum_d3[3] = $psum_d3[2] + $psum_d3[1] + $psum_d3[0];
$psum_d2[3] = $psum_d2[2] + $psum_d2[1] + $psum_d2[0];
$psum_d1[3] = $psum_d1[2] + $psum_d1[1] + $psum_d1[0];


$user_active_num = $db->numrows("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 0");
$user_inactive_num = $db->numrows("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 1");
$user_temp_num = $db->numrows("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 5");

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

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
			
			<div class="row" style="margin-top:30px;">
			
				<!-- left div here -->
				
                <?php include("includes/profilemenu.php"); ?>
                
				<div class="col-sm-9">
                    <div class="row">
                    
						<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -20px; margin-bottom: 7px;">Level Payout</h4>
						<div class="table-responsive">
						<table class="table table-striped new_tbl" cellpadding="7" cellspacing="5" border="0" width="100%">
						<tr>
							<td width="10%"><strong>S.No</strong></td>
							<td width="25%"><strong>Amount</strong></td>
							<td width="25%"><strong>Bonus Type</strong></td>
							<!--<td width="25%"><strong>Date</strong></td>-->
							<td width="25%"><strong>Status</strong></td>
						</tr>
						<?php
						
						$qry1=$db->get_all("select * from mlm_payout where user_id='$_SESSION[profileid]' and reason like 'level%' order by id desc");	
						$count = $db->numrows("select * from mlm_payout where user_id='$_SESSION[profileid]' and reason like 'level%'");
						$i=1;
						foreach($qry1 as $qry){
						$bt=$qry['bonus_type'];
						if($bt==0){
							$msg="Referal Bonus";
						}else if($bt==1){
							$msg="Pair Bonus";
						}
						else if($bt==2){
							$msg="Pair capping payout";
						}
						$d=$qry['date'];
						$status=(int)$qry['status'];
						if($status==1){
							$alert="Approved";
						}else if($status==0){
							$alert="Un-Approved";
						}
						$fromid=$qry['from_id'];
						if(!empty($fromid)) $fpid=$fromid;
						else if(empty($fromid)) $fpid="Admin";
						
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $qry['amount']; ?></td>
							<td><?php echo $qry['reason']; ?></td>
							<!--<td><?php echo $d; ?></td>-->
							<td><?php echo $alert; ?></td>
						</tr>
						<?php $i++; } if($count==0){ echo "<td colspan='6' style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;'>No Records Found</td>"; } ?>
						</table>
						</div>
					</div>
				</div>	
</div>	
			
</div>				
            </div>
			<div class="clearfix"></div>
			<div class="container">
			<?php include "includes/login-access-ads.php";?>
			<?php include("includes/footer.php"); ?>
			</div>
		</div>

		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>

<script type="text/javascript">

var pie1 = c3.generate({
    bindto: '#flotcontainer1',
    data: {
      columns: [
        ['Success',<?php echo $pay_sum_s;?>],
		['Pending',<?php echo $pay_sum_f;?>]
        
      ],
	  type:'pie',
	  colors: {
            Success: '#73e600',
            Pending: '#ffcc00'
        }
    }
});

var pie2 = c3.generate({
    bindto: '#flotcontainer2',
    data: {
      columns: [
        ['Active', <?php echo $user_active_num; ?>],
		['Temp', <?php echo $user_temp_num; ?>],
		['Requested', <?php echo $user_inactive_num; ?>]
        
      ],
	  type:'pie',
	  colors: {
            Active: '#73e600',
			Temp: '#ffcc00',
            Requested: '#ff471a'
        }
    }
});

var pie3 = c3.generate({
    bindto: '#flotcontainer3',
    data: {
      columns: [
        ['Success', <?php echo $puram_sum_s; ?>],
		['Pending', <?php echo $puram_sum_p; ?>],
		['Failed', <?php echo $puram_sum_f; ?>]
        
      ],
	  type:'pie',
	  colors: {
            Success: '#73e600',
            Pending: '#ffcc00',
			Failed: '#ff471a'
        }
    }
});

var line1 = c3.generate({
    bindto: '#linechart',
    data: {
      columns: [
        ['Overall purchase value',<?php echo $psum_d4[3];?>,<?php echo $psum_d3[3];?>,<?php echo $psum_d2[3];?>,<?php echo $psum_d1[3];?>]
      ],
	  colors: {
            
        }
    },
	axis: {
        x: {
            type: 'category',
            categories: ['end of 4th week','end of 3rd week','end of 2nd week','end of last week']
        }
    }
});

setTimeout(function () {
    line1.load({
        columns: [
            ['process purchase value',<?php echo $psum_d4[0];?>,<?php echo $psum_d3[0];?>,<?php echo $psum_d2[0];?>,<?php echo $psum_d1[0];?>]
        ]
    });
}, 2000);

setTimeout(function () {
    line1.load({
        columns: [
            ['process purchase value',<?php echo $psum_d4[0];?>,<?php echo $psum_d3[0];?>,<?php echo $psum_d2[0];?>,<?php echo $psum_d1[0];?>]
        ]
    });
}, 2000);

setTimeout(function () {
    line1.load({
        columns: [
			['Success purchase value',<?php echo $psum_d4[1];?>,<?php echo $psum_d3[1];?>,<?php echo $psum_d2[1];?>,<?php echo $psum_d1[1];?>]
        ]
    });
}, 4000);

setTimeout(function () {
    line1.load({
        columns: [
			['Failed purchase value',<?php echo $psum_d4[2];?>,<?php echo $psum_d3[2];?>,<?php echo $psum_d2[2];?>,<?php echo $psum_d1[2];?>]
        ]
    });
}, 6000);



</script>
<!-- end -->
		
		
	</body>
</html>