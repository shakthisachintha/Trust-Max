<?php 
include("admin/AMframe/config.php");
include("includes/head.php");
include "config/instamojo.php";

$Instamojo=new Instamojo($API_KEY, $AUTH_TOKEN, $AUTH_URL);
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) 
{
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}

if(isset($_REQUEST['online'])) 
{
	$profileid=$_SESSION['profileid'];
	$pack=$_REQUEST['package'];
	$mempackDet = $db->singlerec("select act_amount,days from mlm_membership where id='$pack'");
	$amount = $mempackDet['act_amount'];
	$dayys = $mempackDet['days'];
	$exdate=date('Y-m-d', strtotime(date('Y-m-d')." + ". $dayys." days")); 
	$epin=$db->singlerec("select count(*) as ct from mlm_epin where member_pack='$pack' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null)");
	if(empty($epin['ct']))
	{
	  echo "<script>location.href='epin_purchase.php?insuff';</script>";
	  header("Location:epin_purchase.php?insuff");
	  exit;	
	}
	$epin = $db->singlerec("select * from mlm_epin where member_pack='$pack' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null) order by id asc limit 1");
	$epin=$epin['epin'];
	$epin_id=$epin['id']; 
	$date=date("Y-m-d h:i:s");
	$sponsor_email = $_REQUEST['sponsor_email'];
	try {
		$response=$Instamojo->paymentRequestCreate(array(
			"purpose" => "Epin Purchase",
			"amount" => $amount,
			"send_email" => true,
			"email" => $sponsor_email,
			"redirect_url" => "$website_url/epin_purchase.php"
		));
		$ip=$_SERVER['REMOTE_ADDR'];
		$set="profileid='$profileid'";
		$set.=",payment_id='$response[id]'";
		$set.=",pack='$pack'";
		$set.=",amount='$amount'";
		$set.=",qty='$qty'";
		$set.=",discount='$discount'";
		$set.=",paidamt='$paidamt'";
		$set.=",status='$response[status]'";
		$set.=",longurl='$response[longurl]'";
		$set.=",ip_address='$ip'";
		$set.=",created_at='$response[created_at]'";
		$set.=",modified_at='$response[modified_at]'";
		$set.=",ex_date='$exdate'";
		$db->insertrec("insert into mlm_mempayments set $set");
		$db->insertrec("update mlm_register set mem_package='$memid' where user_profileid='$profileid'");
		
		$db->insertrec("update mlm_epin set purchased_user='$profileid' where id='$epin_id'");
		$set="user_id='$profileid'";
		$set.=",pay_type='Instamojo'";
		$set.=",status='1'";
		$set.=",epin='$epin'";
		$set.=",memberpack='$pack'";
		$set.=",purchase_date='$date'";
		$set.=",user_add_status='0'";
		$db->insertrec("insert into mlm_userpin set $set");
		
		echo "<script>location.href='$response[longurl]';</script>";
		header("Location: $response[longurl]");
		exit;
	}
	catch (Exception $e) 
	{
		print('Error: ' . $e->getMessage());
	}
}

if(isset($payment_id) && isset($payment_request_id)) {
	try {
		$response=$Instamojo->paymentRequestStatus($payment_request_id);
		$set="status='$response[status]'";
		$set.=",modified_at='$response[modified_at]'";
		$set.=",pay_type='Instamojo'";
		$db->insertrec("update mlm_mempayments set $set where payment_id='$payment_request_id'");
		if($response['status']=="Completed") {
			echo "<script>location.href='epin.php?suc';</script>";
			header("Location: epin.php?suc");
			exit;		
	}
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}

if(isset($_REQUEST['off'])) 
{
    $profileid=$_SESSION['profileid'];
	$pack=$_REQUEST['package'];
	$epin=$db->singlerec("select * from mlm_epin where member_pack='$pack' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null) ");
	if(empty($epin))
	{
	  echo "<script>location.href='epin_purchase.php?insuff';</script>";
	  header("Location:epin_purchase.php?insuff");
	  exit;	
	}
	$epin_type=$epin['epin'];
	$epin_id=$epin['id']; 
	$date=date("Y-m-d h:i:s");
	$name1="image";
	$name2=rand(11111,99999).uniqid();
	$path="uploads/epinslip/";	
		
	    $img_upl=$com_obj->upload_image($name1,$name2,'','',$path,'');
		$main_img=$com_obj->img_Name;
		$set="user_id='$profileid'";
		$set.=",pay_type='offline'";
		$set.=",status='0'";
		$set.=",epin='$epin_type'";
		$set.=",memberpack='$pack'";
		$set.=",purchase_date='$date'";
		$set.=",user_add_status='0'";
		$set.=",payslip_image='$main_img'";
		$purchase=$db->insertrec("insert into mlm_userpin set $set");
		$update=$db->insertrec("update mlm_epin set purchased_user='$profileid' where id='$epin_id'");
		echo "<script>location.href='epin_purchase.php?succ';</script>";
		header("Location:epin_purchase.php?succ");
		exit;
	
	}

if(isset($_REQUEST['e_wallet'])) 
{
    $profileid=$_SESSION['profileid'];
	$userid=$_SESSION['userid'];
	$pack=$_REQUEST['package'];
	
	$epin=$db->singlerec("select * from mlm_epin where member_pack='$pack' and profile_id=' ' and purchased_user=' ' ");
	if(empty($epin))
	{
	  echo "<script>location.href='epin_purchase.php?insuff';</script>";
	  header("Location:epin_purchase.php?insuff");
	  exit;	
	}
	
	$epin_type=$epin['epin'];
	$epin_id=$epin['id'];
	
	$bal = $com_obj->totalBal($profileid);
	$with = $com_obj->withdrawBal($profileid);
	$avail_bal = $com_obj->availBal($bal,$with);
	
	$pack_amt = $db->singlerec("select act_amount from mlm_membership where id='$pack'");
	if($avail_bal < $pack_amt['act_amount']) {
		echo "<script>location.href='epin_purchase.php?insuffamt';</script>";
		header("Location:epin_purchase.php?insuffamt");
		exit;
	}
	
	$date=date("Y-m-d h:i:s");
	$set="user_id='$profileid'";
	$set.=",pay_type='e-wallet'";
	$set.=",status='1'";
	$set.=",epin='$epin_type'";
	$set.=",memberpack='$pack'";
	$set.=",purchase_date='$date'";
	$set.=",user_add_status='0'";
	$purchase=$db->insertrec("insert into mlm_userpin set $set");
	$update=$db->insertrec("update mlm_epin set purchased_user='$profileid' where id='$epin_id'");
	
	$remain_bal = $pack_amt['act_amount'];
	
	$set1 = "req_profileid='$profileid'";
	$set1 .= ",req_id='$userid'";
	$set1 .= ",req_cvamount='$remain_bal'";
	$set1 .= ",reason='e-pin-purchase'";
	$set1 .= ",req_rpstatus='1'";
	$db->insertrec("insert into mlm_withdrawrequsets set $set1");
	
	echo "<script>location.href='epin.php?pur_succ';</script>";
	header("Location:epin.php?pur_succ");
	exit;
}
?>
<script>
function detajax(str) {
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("resp").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","epinajax.php?q="+str,true);
	xmlhttp.send();
}

function prd_cost(prd) {
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("prdcost").innerHTML=xmlhttp.responseText;
		document.getElementById("prcost").value=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","prd_discount.php?prd="+prd,true);
	xmlhttp.send();
}

function perupd(qty) {
	var prdcost=document.getElementById("prcost").value;
	var memamt=document.getElementById("memamt").value;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var result=JSON.parse(xmlhttp.responseText);
		document.getElementById("discount").innerHTML=result.discount;
		document.getElementById("totamt").innerHTML=result.totamt;
		document.getElementById("tot_amt").value=result.totamt;
		}
	  }
	xmlhttp.open("GET","prd_discount.php?memamt="+memamt+"&prdcost="+prdcost+"&qty="+qty,true);
	xmlhttp.send();
}
</script>
</head>
    <body>
		<div class="container main">
			<?php include("includes/header.php"); ?>
			<hr />
			<?php include("includes/profileheader.php");	?>
			<hr />
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="well" style="padding-right: 0;">
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">E-PIN Purchase</h4>
							
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="sponsor_email" value="<?=$userdetail['user_email'];?>" />
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php
									if(isset($_REQUEST['insuffamt'])) { ?>
									<tr><td colspan="3" align="center" style="color:red; font-weight:bold;">Insufficiant Wallet Amount!</td></tr>
									<?php } 
									if(isset($_REQUEST['insuff'])) { ?>
									<tr><td colspan="3" align="center" style="color:red; font-weight:bold;">Epin is not available for this membership!</td></tr>
									<?php }
									?>
									<?php
									if(isset($_REQUEST['succ'])) { ?>
									<tr><td colspan="3" align="center" style="color:green; font-weight:bold; ">Your Epin details will show after approval from admin</td></tr>
									<?php } 
									?>
									<tr>
										<td width="36%" align="right"><strong>Choose Membership</strong></td>
										<td width="3%" align="center">:</td>
										<td width="76%">
										<?php $sql=$db->get_all("select * from mlm_membership order by id ASC"); ?>
										<select style="width: 65%;" class="form-control" id="pack" name="package" onchange="return detajax(this.value);" required>
										<option value="">select</option>
										<?php foreach($sql as $rowfetch) { ?>
										<option value="<?php echo $rowfetch['id']; ?>"><?php echo $rowfetch['membership_name']; ?></option>
										<?php } ?>
										</select>
										
										</td>
									</tr>
									<tr>
									<td colspan="4">
									<div id="resp"></div>
									</td>
									</tr>
									
									<tr>
									<td width="36%" align="right"><strong>Payment Method</strong></td>
										<td width="3%" align="center">:</td>
										<td colspan="3" align="center">
											<input type="submit" name="online"  class="btn btn-success greenbtn" value="Online Payment"/>
											<input type="submit" name="e_wallet"  class="btn btn-success greenbtn" value="E-Wallet"/>
											<a  data-toggle="collapse" href="#collapseExample"  aria-expanded="false" aria-controls="collapseExample" class="btn btn-danger" >Offline Payment</a>
										</td>
										<table cellpadding="7" cellspacing="0" border="0" width="80%">
										<div class="collapse" id="collapseExample">
										  <div class="well">
										   <div class="row">
											<?  $bank_detail=$db->singlerec("select * from mlm_bank where id='1' ") ?>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Account Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" value="<? echo $bank_detail['acc_name']?>" readonly class="form-control" placeholder="Email">
												</div>
											  </div>
											  <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Account Number</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly value="<? echo $bank_detail['acc_no']?>"  class="form-control" placeholder="Email">
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input  type="text" class="form-control" placeholder="Email" value="<? echo $bank_detail['bank_name']?>" readonly>
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">IFSC</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly  value="<? echo $bank_detail['ifsc_code']?>" class="form-control" placeholder="Email">
												</div>
											  </div>
											   <div class="clearfix"></div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Branch Name</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="text" readonly   class="form-control" value="<? echo $bank_detail['branch_name']?>"placeholder="Email">
												</div>
											  </div>
											  <div class="form-group">
												<label for="inputEmail3" class="col-sm-3 control-label">Upload Payslip Image</label>
												<label for="inputEmail3" class="col-sm-1 control-label">:</label>
												<div class="col-sm-8">
												  <input type="file" name="image" class="form-control" value=""placeholder="payslip">
												</div>
											  </div>
											  <div class="clearfix"></div>
											   <div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
												  <input type="submit"  class="btn btn-primary" name="off" value="Submit"/>
												</div>
											  </div>
											</div>
										  </div>
										</div>
									</table>
								  </tr>
								</table>
								</form>
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
	</body>
</html>