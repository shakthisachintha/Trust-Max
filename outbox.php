<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:login.php");

echo "<script>window.location='login.php'</script>";

}

if(isset($_REQUEST['maildelete']))
{
$delid=addslashes($_REQUEST['maildelete']);

$del=$db->insertrec("update mlm_outbox set outbox_fromstatus='1' where outbox_id='$delid'");

if($del)
{
header("location:outbox.php");
echo "<script>window.location='outbox.php';</script>";
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
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/mailmenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">OUTBOX</h4>
								<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td width="5%">
											<strong>SNO</strong></td>
										<td width="14%" style="text-align:left;">
											<strong>Receiver Name</strong></td>
										<td width="10%">
											<strong>Profileid</strong></td>
										<td width="20%">
											<strong>Subject</strong></td>
										<td width="13%">
											<strong>DATE</strong></td>
												<td width="12%">
											<strong>Status</strong></td>
										<td width="26%">
											<strong>ACTION</strong></td>
									</tr>
									</thead>
									<?php
		/*$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';*/
									
									$out=$db->get_all("select * from mlm_outbox where (outbox_userid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') order by outbox_id desc");
									$nom_rows=$db->numrows("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0')");
									
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="7" align="center"> No Records Found</td>
										</tr>
									
									<? }
									$i=1;
									foreach($out as $rout) 
									{
										
									if($rout['outbox_usertype']!="1")	
									{	
									$useout=$db->singlerec("select * from mlm_register where user_id='$rout[outbox_toupid]'");
									$useroutname=$useout['user_fname'];
									}
									else
									{
										$useroutname="Administrator";
									}
									
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $useroutname;?>
										</td>
										<td>
											<?php echo $rout['outbox_toprofileid'];?>
										</td>
										<td>
											<?php echo $rout['outbox_subject'];?>
										</td>
											
										<td>
											<?php echo date("d-m-Y h:i:s",strtotime($rout['outbox_date']));?>
										</td>
										
										<td>
											<?php if($rout['outbox_readstatus']=="1")
											 {
											echo "Read";
											 } else 
											 { 
											 echo "Un Read";
											 }?>
										</td>
										
										<td>
										<a href="mailview.php?msgview=<?php echo $rout['outbox_id']; ?>"><img src="images/mailview.jpg" width="32" height="32"></a><a href="forwardmail.php?fwd=<?php echo $rout['outbox_id']; ?>"><img src="images/forward.jpg" width="32" height="32"></a><a href="outbox.php?maildelete=<?php echo $rout['outbox_id']; ?>" onClick="if(confirm('Are you sure to delete this record')) { return true; } else{ return false; }"><img src="images/maildel.jpg" width="32" height="32"></a>
										</td>
									</tr>
									<?php $i++;} ?>		
										
									</table>
									</div>
								    
							</div>
							 <div>
            <?php //echo pagination($nom_rows,$limit,$page,$url); ?>
                      
                    </div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
		
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