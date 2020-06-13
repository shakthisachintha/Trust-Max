<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

if(isset($_REQUEST['submit']))
{

$userid=addslashes($_SESSION['userid']);
$prodaf=addslashes($_SESSION['profileid']);
$amount=addslashes($_REQUEST['amount']);
$message=addslashes($_REQUEST['message']);
$sub=addslashes($_REQUEST['subject']);
$ip=($_SERVER['REMOTE_ADDR']);
$name=addslashes($_REQUEST['name']);
$email=addslashes($_REQUEST['email']);
$acc_balance=addslashes($_REQUEST['acc_bal']);


 if($amount<=$acc_balance){

$subject="Withdrawal Request Details from ".$website_name;

	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Withdrawal Request Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $name, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Withdrawal Request has been sent successfully, concern person is reply you soon.</td>
						</tr>
					
				
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$to=$email;
$cmail=$com_obj->commonMail($to,$subject,$msg);

$subject1=$sub;
$msg1="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Withdrawal Request Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Name : $name </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email : $email</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Profileid : $prodaf</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Amount : $amount</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Message : $message</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>Click Here</a></td>
						</tr>
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$to1=$website_admin;
$mail_sts = $com_obj->commonMail($to1,$subject1,$msg1);

$insertdfs=$db->insertrec("insert into mlm_withdrawrequsets set req_userid='$userid',req_profileid='$prodaf',req_subject='$sub',req_message='$message',req_cvamount='$amount',tds_percent='$ref_tax',req_date=NOW(),req_time=NOW(),req_ip='$ip'");

if($mail_sts == "scs")
{
	header("location:send_withdraw.php?succ");
	echo "<script>window.location='send_withdraw.php?succ';</script>";exit;
}
else
{
header("location:send_withdraw.php?err");
echo "<script>window.location='send_withdraw.php?err';</script>";
}
 }
 else
	 echo "<script>alert('insufficient balance!');</script>";
}

if(isset($_REQUEST['cancel']))
{
$cancel=addslashes($_REQUEST['cancel']);

$can=$db->insertrec("update mlm_withdrawrequsets set req_status='1' where req_id='$cancel'");

if($can)
{
header("location:send_withdraw.php?cansucc");
echo "<script>window.location='send_withdraw.php?cansucc';</script>";
}

}

if(isset($_REQUEST['delete']))
{
$delete=addslashes($_REQUEST['delete']);

$del=$db->insertrec("delete from mlm_withdrawrequsets where req_id='$delete'");

if($del)
{
header("location:send_withdraw.php?delsucc");
echo "<script>window.location='send_withdraw.php?delsucc';</script>";
}

}

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
 <style type="text/css">
		.black_overlay111{
			display:none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 200%;
			background-color: black;			
			z-index:1001;
			-moz-opacity: 0.7;
			opacity:.570;
			filter: alpha(opacity=70);
		}
		.white_content111 {
		display:none;
			position: fixed;
			top: 15%;
			left: 22%;
			width: 55%;
			height:65%;
			padding: 16px;
			border: 10px solid #DB4E11;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	<script type="text/javascript">
	function showpop111(uid,pid,cv,name,email)
	{
	
	document.getElementById('light111').style.display='block';
	document.getElementById('fade111').style.display='block'; 
	
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	
	
	}
	
function phnumbersonly(myfield, e, dec)
{

var key;
var keychar;

	if (window.event)
	key = window.event.keyCode;
	else if (e)
	key = e.which;
	else
	return true;
keychar = String.fromCharCode(key);

// control keys
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
	return true;

// numbers
	else if ((("+0123456789").indexOf(keychar) > -1))
	return true;

// decimal point jump
	else if (dec && (keychar == ".")) {
	myfield.form.elements[dec].focus();
	return false;
	} 
else
return false;
}
function alert_box() {
  alert("Upload payslip for membership package and Kindly wait for admin approval!");
}
</script>
<script>
function with_validate()
{
if((parseInt(document.getElementById('balamt').value)=="") || (parseInt(document.getElementById('balamt').value)==0))
{
alert("Your balance amount is zero, so you cannot send request");
return false;

}
else if((parseInt(document.getElementById('balamt').value)<=49)){
	alert("Insufficient balance, so you cannot send request");
	return false;
}

}

function hidepop111()
	{
	
	document.getElementById('light111').style.display='none';
	document.getElementById('fade111').style.display='none';
return false;	
	}
</script>

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
                <?php include("includes/profilemenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
					<?php 
					$user_profileid = $userdetail['user_profileid'];
					$user=$db->singlerec("select * from mlm_register where user_profileid='$user_profileid' and user_status='0'");
					$user_paymentstaus=$user['user_paymentstaus']; 
					$bal = $com_obj->totalBal($userdetail['user_profileid']);
					$with = $com_obj->withdrawBal($userdetail['user_profileid']);
					?>					
					<?php 
					if(isset($_REQUEST['succ'])) {
					
					?>
					<div align="center" style="color:#006600;">Your withdrawal request has been sent successfully !!!</div>
					
					<?php } ?>
					
						<?php 
					if(isset($_REQUEST['err'])) {
					
					?>
					<div align="center" style="color:#FF0000;">Your withdrawal request not Sent, try again !!!</div>
					
					<?php } ?>
					
					
						<?php 
					if(isset($_REQUEST['delsucc'])) {
					
					?>
					<div align="center" style="color:#FF0000;">Request deleted successfully !!!</div>
					
					<?php } ?>
					
                        <div class="col-sm-12">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">SEND WITHDRAWAL REQUEST 
							<? if($wallet_withdraw_status == "enabled") {
								if($user_paymentstaus == 0) { ?>
								<span style="float:right;"><a href="javascript:void(0);" onClick="alert_box();" style="color:#000;">+ SEND</a></span>
							<? }else{?>
								<span style="float:right;"><a href="javascript:void(0);" onClick="showpop111();" style="color:#000;">+ SEND</a></span>
							<? } } ?>
								</h4>
								<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td width="6%">
											<strong>SNO</strong>										</td>
										<td width="17%" style="text-align:left;">
											<strong>SUBJECT</strong>										</td>
										<td width="25%">
											<strong>MESSAGE</strong>										</td>
										<td width="10%">
											<strong>AMOUNT</strong>										</td>
										<td width="13%">
											<strong>DATE</strong>										</td>
										<td width="14%">
											<strong>STATUS</strong>										</td>
										<td width="15%">
											<strong>ACTION</strong>
										</td>
									</tr>
									</thead>
									<?php
										/*$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';*/
									
									$reqq=$db->get_all("select * from mlm_withdrawrequsets where req_status='0' and req_userid='$_SESSION[userid]'");
									$nom_rows=$db->numrows("select * from mlm_withdrawrequsets where req_status='0' and req_userid='$_SESSION[userid]'");
									
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="7" align="center"> No Request Found</td>
										</tr>
									
									<? }
									
									$i=1;
									foreach($reqq as $rreqq) 
									{
									
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $rreqq['req_subject'];?>
										</td>
										<td>
											<?php echo $rreqq['req_message'];?>
										</td>
										<td>
											<?php echo $rreqq['req_cvamount'];?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rreqq['req_date']));?>
										</td>
										<td>
													<?php if($rreqq['req_rpstatus']=='0') { ?>
											 <span class="red" >
											 Pending
											 </span>
												
												  <?php } else {?>
											 <span class="green" >
											 Transferred
											 </span>
												  
												  <?php } ?>
										</td>
										<td>
										<span><?php if($rreqq['req_rpstatus']=='0') { ?><a href="send_withdraw.php?cancel=<?php echo $rreqq['req_id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to cancel this record')) { return true; } else { return false; }">CANCEL</a><?php } else { ?>
										
							<a href="send_withdraw.php?delete=<?php echo $rreqq['req_id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to cancel this record')) { return true; } else { return false; }">DELETE</a>
										<?php  } ?></span></td>
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
					<?php include "includes/login-access-ads.php";?>
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
			
			    <div id="light111"  class="white_content111">
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return with_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">SEND REQUEST RESPONSE</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Your Available Balance <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td>
								<?php 
								$profid = $_SESSION['profileid'];
								
								//echo gettotaldue($profid); 
								echo $com_obj->availBal($bal,$with)." ".$sitecurrency;
								$total = $com_obj->availBal($bal,$with);
								?>
								 </td>
								<input type="hidden" name="balamt" id="balamt" value="<?php echo getBonusamount($profid); ?>"/>
								</tr>
								<input type="hidden" name="minwith" id="minwith" value="<?php echo $gen_minwithdraw; ?>"/>
								<input type="hidden" name="name" id="name" value="<?php echo $profilename; ?>"/>
								<input type="hidden" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>"/>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Amount <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td>
								<input type="text" name="amount" id="amount" required="true" onKeyPress="return phnumbersonly(this, event)" onBlur="checkamt(this.value);" style="height:25px;"/> <br><span style="color:#999999;">Minimum withdrawal amount <?php echo $gen_minwithdraw." ".$sitecurrency; ?></span>
							
								</td>
								</tr>
								
						<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Subject <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td>
								<input type="text" name="subject" id="subject" required="true" style="height:25px;"/>
								</td>
								</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Message <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td>
								<textarea name="message" id="message" required="true"></textarea>
								</td>
								</tr>
								<tr>
								<input type="hidden" name="acc_bal" value="<?php echo $total; ?>"
								<td colspan="3">
								<div class="form-actions">
				<input type="submit"  name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onClick ="hidepop111();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>
<script type="text/javascript">
	function checkround(input)
	{
		if(input!=''){
	if (input.value < 100)
	{
	 document.getElementById('amount').value="";
	 return false;
	}
	else
	{
	 return true;
	}
	}
	}
	
	function checkamt(str){
		if(str!=""){
			var amt =<?php echo $total; ?>;
			var minw =<?php echo $gen_minwithdraw; ?>;
		    var inamt =str;
			if(inamt < minw){
			   document.getElementById('amount').value="";
				alert("Minimum with draw amount must be "+minw+" ! Please try again .");	
			}
			else if(inamt > amt){
				document.getElementById('amount').value="";
				alert("Your withdraw requested amount maximum reach in available balance ! Check available balance.");
			}
			
		}
	}
	
	</script>									
									</div>
									<div id="fade111" class="black_overlay111" >&nbsp;</div>
			
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
