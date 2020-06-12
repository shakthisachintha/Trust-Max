<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}

include("includes/head.php");
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
					if(isset($_REQUEST['success'])) {
					
					?>
					<div align="center" style="color:#006600;">User Has Been Added successfully !!!</div>
					
					<?php } ?>
					<?php 
					if(isset($_REQUEST['suc'])) {
					
					?>
					<div align="center" style="color:#006600;">You have successfully purchased the Epin !</div>
					
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
					
					<?php }  
					if(isset($_REQUEST['pur_succ'])) {
					
					?>
					<div align="center" style="color:green;">Epin Purchased successfully !!!</div>
					
					<?php } ?>
					
                        <div class="col-sm-12">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">E-PIN List
								<?php if($epin_status == "enabled") {?>
									<span style="float:right;"><a href="epin_purchase.php" style="color:#000;">E-PIN Purchase</a></span>
								<?php } ?>
								</h4>
								<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td width="6%">
											<strong>SNO</strong>										</td>
										<td width="17%" style="text-align:left;">
											<strong>Epin</strong>										</td>
										<td width="25%">
											<strong>Membership</strong>										</td>
										<!--<td width="10%">
											<strong>Profile Id</strong>										</td>-->
										<td width="10%">
											<strong>Pay Type</strong>									
										</td>
                                        <td width="10%">
											<strong>Purchased Date</strong>									
										</td>
										<td width="10%">
											<strong>Pay Status</strong>									
										</td>
										<td width="13%">
											<strong>Add User</strong>										
										</td>
									</tr>
									</thead>
									<?php
										/*$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';*/
									
									$reqq=$db->get_all("select * from mlm_userpin where status='1' and user_id='$_SESSION[profileid]'");
									$nom_rows=$db->numrows("select * from mlm_userpin where status='1' and user_id='$_SESSION[profileid]'");
									
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="7" align="center"> Nothing Found</td>
										</tr>
									
									<? }
									
									$i=1;
									foreach($reqq as $rreqq) 
									{
									$memname=$db->extract_single("select membership_name from mlm_membership where id='$rreqq[memberpack]'");
									$epinname=$db->singlerec("select * from mlm_epin where epin='$rreqq[epin]'");
									$epin_id=base64_encode($epinname['id']);
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $rreqq['epin'];?>
										</td>
										<td>
											<?php echo $memname;?>
										</td>
										<td>
											<?php echo $rreqq['pay_type'];?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rreqq['purchase_date']));?>
										</td>
										<td>
													<?php if($rreqq['status']=='0') { ?>
											 <span class="red" >
											 Pending
											 </span>
												
												  <?php } else {?>
											 <span class="green" >
											 Success
											 </span>
												  
												  <?php } ?>
										</td>
										<?php if($rreqq['user_add_status']==0) { ?>
										<td>
										<a href="register.php?sid=<?php echo $userdetail['user_profileid']; ?>&epinid=<? echo $epin_id ?>" class="btn btn-primary">ADD USER </a></td>
										<? } else { ?>
										<td>
										<a href="" class="btn btn-primary">USER ADDED </a></td>
										<? } ?>
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
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="amount" id="amount" required="true" onKeyPress="return phnumbersonly(this, event)" onBlur="checkamt(this.value);" style="height:25px;"/> <br><span style="color:#999999;">Minimum withdrawal amount <?php echo $gen_minwithdraw." ".$sitecurrency; ?></span>
							
								</td>
								</tr>
								
						<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Subject <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="subject" id="subject" required="true" style="height:25px;"/>
								</td>
								</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Message <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
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
