<?php 
include("admin/AMframe/config.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['update1']))
{
	$uid=$_SESSION['userid'];
	$pancard=replace($_REQUEST['user_pancard']);
	
	
	$insert=$db->insertrec("update mlm_register set user_pancard='$pancard' where user_id='$uid'");

	if($insert)
	 { 
	 header("Location:editprofile.php?upsucc"); 
	 ?>
	<script>
	window.location="editprofile.php?upsucc";
	</script>	
	<?php
	
	}
}

if(isset($_REQUEST['update2']))
{

	$uid=$_SESSION['userid'];
	
	$dobdate=addslashes($_REQUEST['dobdate']);
	$dobmonth=addslashes($_REQUEST['dobmonth']);
	$dobyear=addslashes($_REQUEST['dobyear']);
	
	$date=$dobyear."-".$dobmonth."-".$dobdate;
	$phone=addslashes($_REQUEST['phone']);
	$email=addslashes($_REQUEST['email']);
	$holder=addslashes($_REQUEST['holder_name']);
	$accno=addslashes($_REQUEST['accno']);
	$bank_name=addslashes($_REQUEST['bank_name']);
	$branch=addslashes($_REQUEST['branch']);
	$ifsccode=addslashes($_REQUEST["ifsc_code"]);
	
	$caddr1=addslashes($_REQUEST['caddr1']);
	$cddr2=addslashes($_REQUEST['caddr2']);
	$ccountry=addslashes($_REQUEST['ccountry']);
	$cstate=addslashes($_REQUEST['addressstate']);
	$ccity= addslashes($_REQUEST['addresscity']);
	$czipcode=addslashes($_REQUEST['czipcode']);
	$cpaddr1=addslashes($_REQUEST['cpaddr1']);
	$cpddr2=addslashes($_REQUEST['cpaddr2']);
	$cpcountry=addslashes($_REQUEST['cpcountry']);
	$cpstate=addslashes($_REQUEST['cpstate']);
	$cppcity=addslashes($_REQUEST['cppcity']);
	$cpzipcode=addslashes($_REQUEST['cpzipcode']);
	
 $insert = $db->insertrec("update mlm_register set user_dob='$date',user_phone='$phone',user_email='$email',user_accholdername='$holder',user_branch='$branch',user_ifsccode='$ifsccode',user_accno='$accno',user_bankname='$bank_name',user_commaddr1='$caddr1',user_commaddr2='$cddr2',user_city='$ccity',user_state='$cstate',user_country='$ccountry',user_postalcode='$czipcode' ,user_paddr1='$cpaddr1',user_paddr2='$cpddr2',user_pcity='$cppcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$cpzipcode' where user_id='$uid'");
	

	if($insert)
	 { 
	 header("Location:editprofile.php?upsucc1"); 
	 ?>
	<script>
	window.location="editprofile.php?upsucc1";
	</script>	
	<?php
	
	}
}

if(isset($_REQUEST['update3']))
{
	$uid=$_SESSION['userid'];
	$nname = addslashes($_REQUEST['nname']);
	$ncountry = addslashes($_REQUEST['ncountry']); 
	$nstate=addslashes($_REQUEST['nstate']);
	$ncity=addslashes($_REQUEST['ncity']);
	$nzipcode=addslashes($_REQUEST['nzipcode']);
    $nphone=addslashes($_REQUEST['nphone']);
	$nemail=addslashes($_REQUEST['nemail']);
	$naddr1=addslashes($_REQUEST['naddr1']);
	$naddr2=addslashes($_REQUEST['naddr2']);
		
	$ncnumber=addslashes($_REQUEST['ncnumber']);
	if($_REQUEST['icid']=="others")
	{
	$nct=addslashes($_REQUEST['nctype']);
	}
	else
	{
	$nct=addslashes($_REQUEST['icid']);
	}
	
	$insert=$db->insertrec("update mlm_register set user_nomineename='$nname',user_identifycardtype='$nct',user_idnumber='$ncnumber',user_naddr1='$naddr1',user_naddr2='$naddr2',user_ncity='$ncity',user_nstate='$nstate',user_ncountry='$ncountry',user_npostalcode='$nzipcode',user_nphone='$nphone',user_nemail='$nemail' where user_id='$uid'");
	
	
	if($insert)
	 { 
	 header("Location:editprofile.php?upsucc2"); 
	 ?>
	<script>
	window.location="editprofile.php?upsucc2";
	</script>	
	<?php
	
	}
}

include("includes/head.php");

?>
<script>

function card(val)
{
if(val=='others')
{
document.getElementById('carrrrdtype').style.display="block";

}
else
{

document.getElementById('carrrrdtype').style.display="none";
}


}

</script>
<script>
function showstate(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication country");
  document.getElementById("addresscountry").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("astate").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","stateajax.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function discity(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("addressstate").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("acity").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cityajax.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function stateview(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the permanent country");
  document.getElementById("cpcontry").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("cpstatee").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","stateajax2.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function cityview(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the Permanent State");
  document.getElementById("cpstate").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("cpcityy").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cityajax2.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function showstate1(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication country");
  document.getElementById("ncontry").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("nstatee").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","stateajax3.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function cityshow1(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("nstate").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("ncityy").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cityajax3.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function mailval(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please enter the email");
  document.getElementById("emailaddress").focus();
  return false;
  }
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
	//alert(xmlhttp.responseText);
    document.getElementById("err").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getmail.php?q="+str,true);
xmlhttp.send();
}
</script>

<link href="css/deactive.css" rel="stylesheet" type="text/css" />
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
<?php
$sponid=$userdetail['user_sponserid'];
$detail=$com_obj->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'");
?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Basic Details</h4>
                                <table class="table new_tbl2" cellpadding="7" cellspacing="0" border="0" width="100%">
								
								<?php if(isset($_REQUEST['upsucc'])) {  ?>
								<tr>
								<td>&nbsp;</td>
								<td colspan="2" align="left">
								<strong style="color:#006633;">Updated Successfully !!!</strong>
								</td>
								
								</tr>
								<?php } ?>
								
									<form name="form1" action="" method="post">
									<tr>
										<td>
											<strong>Sponsor Name</strong>
										</td>
										<td align="center">:</td>
										<td>
				 <?php if($userdetail['user_sponsername']!="0") { echo $detail['user_fname'].' '.$detail['user_lname']; } else { echo "Owner"; } ?>
										</td>
										</tr>
										<tr>
										<td>
											<strong>Sponsor id</strong>
										</td>
										<td align="center">:</td>
										<td>
		<?php if($userdetail['user_sponserid']!="0") { echo $userdetail['user_sponserid']; }  else { echo "Owner"; }?>
										</td>
									</tr>
									
									
									
									
									<tr>
										<td>
											<strong>Placement Id</strong>
										</td>
										<td align="center">:</td>
										<td>
					<?php if($userdetail['user_placementid']!="") {  echo $userdetail['user_placementid']; } else { echo "Owner"; } ?>
										</td>
										</tr>
										<tr>
										<td>
											<strong>Position</strong>
										</td>
										<td align="center">:</td>
										<td>
				     <?php echo $userdetail['user_position'];?>
	
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>Pancard Number</strong>
										</td>
										<td align="center">:</td>
										<td>
								<input class="form-control" type="text" name="user_pancard" id="user_pancard" value="<?php echo $userdetail['user_pancard']; ?>" required="true">
										</td>
										</tr>
									
									<tr>
										<td>&nbsp;</td>
										<td align="center" >
										<button type="submit" name="update1" class="greenbtn">UPDATE</button>
										</td>
									<td>&nbsp;</td>
										</tr>
									
									</form>
									
									
									<tr>
								<td colspan="6">	<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: 20px; margin-bottom: 7px;">Personal Details</h4></td></tr>
									<?php if(isset($_REQUEST['upsucc1'])) {  ?>
								<tr>
								<td>&nbsp;</td>
								<td colspan="2" align="left">
								<strong style="color:#006633;">Updated Successfully !!!</strong>
								</td>
								
								</tr>
								<?php } ?>
								<form name="form2" action="editprofile.php" method="post">
									<tr>
										<td width="177">
											<strong>First Name</strong>	</td>
										<td width="39" align="center">:</td>
										<td width="700">
								<?php echo $userdetail['user_fname']; ?>
									  </td>
								  </tr>	
								  <!--<tr>
										<td>
											<strong>Second Name</strong>
										</td>
										<td align="center">:</td>
										<td>
						<?php echo $userdetail['user_secondname']; ?>
										</td>
										</tr> -->
										
										<tr>
										<td width="177">
											<strong>Last Name</strong></td>
										<td width="39" align="center">:</td>
										<td width="700">
								<?php echo $userdetail['user_lname']; ?>
										</td>
									</tr>
								
										
										<tr>
										<td>
											<strong>Email id</strong>
										</td>
										<td align="center">:</td>
										<td>
						<input class="form-control" type="text" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>" required="true">
										</td>
									</tr>
									<tr>
										<td>
											<strong>D.O.B</strong>
										</td>
										<td align="center">:</td>
										<td>
										
										
							<?php 
							$exp=explode("-",$userdetail['user_dob']); 
							$yr=$exp[0];
							$mt=$exp[1];
							$dt=$exp[2];
							?>
							
							<div class="row">
										    <div class="col-sm-4">
											 <select class="form-control" id="d" class="styledselect-day" name="dobdate" required="true">
<option value="">date</option>
<option value="01" <?php if($dt=="01") { echo "selected='selected'"; }?>>1</option>
<option value="02" <?php if($dt=="02") { echo "selected='selected'"; }?>>2</option>
<option value="03" <?php if($dt=="03") { echo "selected='selected'"; }?>>3</option>
<option value="04" <?php if($dt=="04") { echo "selected='selected'"; }?>>4</option>
<option value="05" <?php if($dt=="05") { echo "selected='selected'"; }?>>5</option>
<option value="06" <?php if($dt=="06") { echo "selected='selected'"; }?>>6</option>
<option value="07" <?php if($dt=="07") { echo "selected='selected'"; }?>>7</option>
<option value="08" <?php if($dt=="08") { echo "selected='selected'"; }?>>8</option>
<option value="09" <?php if($dt=="09") { echo "selected='selected'"; }?>>9</option>
<option value="10" <?php if($dt=="10") { echo "selected='selected'"; }?>>10</option>
<option value="11" <?php if($dt=="11") { echo "selected='selected'"; }?>>11</option>
<option value="12" <?php if($dt=="12") { echo "selected='selected'"; }?>>12</option>
<option value="13" <?php if($dt=="13") { echo "selected='selected'"; }?>>13</option>
<option value="14" <?php if($dt=="14") { echo "selected='selected'"; }?>>14</option>
<option value="15" <?php if($dt=="15") { echo "selected='selected'"; }?>>15</option>
<option value="16" <?php if($dt=="16") { echo "selected='selected'"; }?>>16</option>
<option value="17" <?php if($dt=="17") { echo "selected='selected'"; }?>>17</option>
<option value="18" <?php if($dt=="18") { echo "selected='selected'"; }?>>18</option>
<option value="19" <?php if($dt=="19") { echo "selected='selected'"; }?>>19</option>
<option value="20" <?php if($dt=="20") { echo "selected='selected'"; }?>>20</option>
<option value="21" <?php if($dt=="21") { echo "selected='selected'"; }?>>21</option>
<option value="22" <?php if($dt=="22") { echo "selected='selected'"; }?>>22</option>
<option value="23" <?php if($dt=="23") { echo "selected='selected'"; }?>>23</option>
<option value="24" <?php if($dt=="24") { echo "selected='selected'"; }?>>24</option>
<option value="25" <?php if($dt=="25") { echo "selected='selected'"; }?>>25</option>
<option value="26" <?php if($dt=="26") { echo "selected='selected'"; }?>>26</option>
<option value="27" <?php if($dt=="27") { echo "selected='selected'"; }?>>27</option>
<option value="28" <?php if($dt=="28") { echo "selected='selected'"; }?>>28</option>
<option value="29" <?php if($dt=="29") { echo "selected='selected'"; }?>>29</option>
<option value="30" <?php if($dt=="30") { echo "selected='selected'"; }?>>30</option>
<option value="31" <?php if($dt=="31") { echo "selected='selected'"; }?>>31</option>
</select>
											</div>
											<div class="col-sm-4">
											
<select class="form-control" id="m" name="dobmonth" class="styledselect-month" required="true">
<option value="">month</option>
<option value="01" <?php if($mt=="01") { echo "selected='selected'"; }?>>Jan</option>
<option value="02" <?php if($mt=="02") { echo "selected='selected'"; }?>>Feb</option>
<option value="03" <?php if($mt=="03") { echo "selected='selected'"; }?>>Mar</option>
<option value="04" <?php if($mt=="04") { echo "selected='selected'"; }?>>Apr</option>
<option value="05" <?php if($mt=="05") { echo "selected='selected'"; }?>>May</option>
<option value="06" <?php if($mt=="06") { echo "selected='selected'"; }?>>Jun</option>
<option value="07" <?php if($mt=="07") { echo "selected='selected'"; }?>>Jul</option>
<option value="08" <?php if($mt=="08") { echo "selected='selected'"; }?>>Aug</option>
<option value="09" <?php if($mt=="09") { echo "selected='selected'"; }?>>Sep</option>
<option value="10" <?php if($mt=="10") { echo "selected='selected'"; }?>>Oct</option>
<option value="11" <?php if($mt=="11") { echo "selected='selected'"; }?>>Nov</option>
<option value="12" <?php if($mt=="12") { echo "selected='selected'"; }?>>Dec</option>
</select>
											</div>
											<div class="col-sm-4">
											 
<input class="form-control" class="input-block-level"  type="text" placeholder="YYYY" name="dobyear" id="dobyear" value="<?php echo $yr; ?>" required="true" />

											</div>
										</div>


											
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>Phone</strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="phone" id="phone" value="<?php echo $userdetail['user_phone']; ?>" required="true">
										</td>
										</tr>
										<tr>
										<td>
											<strong>Name as per Bank </strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="holder_name" id="holder_name" value="<?php echo $userdetail['user_accholdername']; ?>" required="true">
										</td>
									</tr>
									
									
										<tr>
										<td>
											<strong>Bank Account No </strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="accno" id="accno" value="<?php echo !empty($userdetail['user_accno'])?$userdetail['user_accno']:''; ?>" required="true">
										</td>
									</tr>
									
									<tr>
										<td>
									<strong>Bank Name</strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $userdetail['user_bankname']; ?>" required="true">
										</td>
										</tr>
										<tr>
										<td>
											<strong>Branch </strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="branch" id="branch" value="<?php echo $userdetail['user_branch']; ?>" required="true">
										</td>
									</tr>
									<tr>
										<td>
											<strong>IFSC </strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $userdetail['user_ifsccode']; ?>" required="true">
										</td>
										</tr>
									<tr>
										<td colspan="3" style="border-bottom:1px #CCCCCC solid;">
											<strong>Communication Address</strong>
										</td>
										</tr>
										
										<tr>
										<td><strong>Address1 </strong></td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="caddr1" id="caddr1" value="<?php echo $userdetail['user_commaddr1']; ?>" required="true">
							</td>
							</tr>
							
							<tr>
							<td><strong>Address2 </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control"  type="text" name="caddr2" id="caddr2" value="<?php echo $userdetail['user_commaddr2']; ?>" required="true">
							</td>
							</tr>
							
						     <tr>
							<td><strong>Country </strong></td>
							<td align="center">:</td>
							<td>
							<select class="form-control"  name="ccountry" id="ccountry" onchange="return showstate(this.value);">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($sqlcon as $rowcountry)
									{
									?>
									<option value="<?php echo $rowcountry['country_id']; ?>" <?php if($rowcountry['country_id']==$userdetail['user_country']) {  ?> selected="selected" <?php } ?>><?php echo $rowcountry['country_name']; ?></option>
									
									<?php } ?>
										
										</select>
							</td>
							</tr>
							
							 <tr>
							<td><strong>State </strong></td>
							<td align="center">:</td>
							<td>
						    <div class="controls" id="astate">
										<select class="form-control"  name="addressstate" id="addressstate" onchange="return discity(this.value);">
                             <option value="">--- Choose State ---</option>
							 	<?php 
									
									$sqls=$db->get_all("select * from mlm_state where state_status='0' and country_id='$userdetail[user_country]' order by state_name asc");
									foreach($sqls as $rows)
									{
									?>
									<option value="<?php echo $rows['state_id']; ?>" <?php if($rows['state_id']==$userdetail['user_state']) {  ?> selected="selected" <?php } ?>><?php echo $rows['state_name']; ?></option>
									
									<?php } ?>
							 </select>
							</div>
							</td>
							</tr>
							
							 <tr>
							<td><strong>City </strong></td>
							<td align="center">:</td>
							<td>
							<div class="controls" id="acity">

							<select class="form-control"  name="addresscity" id="addresscity">
                             <option value="">--- Choose City ---</option>
							  <?php 
							  
									$sqlc=$db->get_all("select * from mlm_city where city_status='0' and state_id='$userdetail[user_state]' order by city_name asc");
									
									foreach($sqlc as $rowc)
									{
								
									?>
									<option value="<?php echo $rowc['city_id']; ?>" <?php if($rowc['city_id']==$userdetail['user_city']) {  ?> selected="selected" <?php } ?>><?php echo $rowc['city_name']; ?></option>
									
									<?php } ?>
									
									
							 
							 </select>
							 </div>
							</td>
							</tr>
							
								 <tr>
							<td><strong>Zipcode </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control" type="text" name="czipcode" id="czipcode" value="<?php echo $userdetail['user_postalcode']; ?>" required="true">
							</td>
							</tr>
							
											<tr>
										<td colspan="3" style="border-bottom:1px #CCCCCC solid;">
											<strong>Permanent Address</strong>
										</td>
										</tr>
										
										<tr>
										<td><strong>Address1 </strong></td>
										<td align="center">:</td>
										<td>
							<input class="form-control"  type="text" name="cpaddr1" id="cpaddr1" value="<?php echo $userdetail['user_paddr1']; ?>" required="true">
							</td>
							</tr>
							
							<tr>
							<td><strong>Address2 </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control" type="text" name="cpaddr2"  id="cpaddr2" value="<?php echo $userdetail['user_paddr2']; ?>" required="true">
							</td>
							</tr>
							
						     <tr>
							<td><strong>Country </strong></td>
							<td align="center">:</td>
							<td>
							<select class="form-control"  name="cpcountry" id="cpcountry" onchange="return stateview(this.value);" required="true">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$sqlconn=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($sqlconn as $rowcounntry)
									{
									?>
									<option value="<?php echo $rowcounntry['country_id']; ?>" <?php if($rowcounntry['country_id']==$userdetail['user_pcountry']) {  ?> selected="selected" <?php } ?>><?php echo $rowcounntry['country_name']; ?></option>
									
									<?php } ?>
										
							</select>
							</td>
							</tr>
							
							 <tr>
							<td><strong>State </strong></td>
							<td align="center">:</td>
							<td>
				            <div class="controls" id="cpstatee">
							<select class="form-control"  name="cpstate" id="cpstate" onchange="return cityview(this.value);">
                             <option value="">--- Choose State ---</option>
							 <?php
								$sele=$db->get_all("select * from mlm_state where state_status='0' and country_id='$userdetail[user_pcountry]' order by state_name asc");
								foreach($sele as $st)
								{
								?>

								<option value="<?php echo $st['state_id']; ?>" <?php if($st['state_id']==$userdetail['user_pstate']) {  ?> selected="selected" <?php } ?>><?php echo $st['state_name']; ?></option>
								<?php
								}
								?>
							 </select>
							</div>
							</td>
							</tr>
							
							 <tr>
							<td><strong>City </strong></td>
							<td align="center">:</td>
							<td>
							<div class="controls" id="cpcityy">
						    <select class="form-control"  name="cppcity" id="cppcity">
                             <option value="">--- Choose City ---</option>
								<?php
								$selc=$db->get_all("select * from mlm_city where city_status='0' and state_id='$userdetail[user_pstate]' order by city_name asc");

								foreach($selc as $stc)
								{

								?>

								<option value="<?php echo $stc['city_id']; ?>" 
								<?php if($stc['city_id']==$userdetail['user_pcity']) 
								{  
								?>
								selected="selected" 
								<?php } ?>
								>
								<?php echo $stc['city_name']; ?>
								</option>
								<?php
								}
								?>
							 </select>
									</div>
							</td>
							</tr>
							
								 <tr>
							<td><strong>Zipcode </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control" type="text" name="cpzipcode" id="cpzipcode" value="<?php echo $userdetail['user_ppostalcode']; ?>" required="true">
							</td>
							</tr>
							
							<tr>
										<td>&nbsp;</td>
										<td align="center" >
										<button type="submit" name="update2" class="greenbtn">UPDATE</button>
										</td>
									<td>&nbsp;</td>
										</tr>
							
			</form>
									
									<tr>
								<td colspan="6">	<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: 20px; margin-bottom: 7px;">Nominee Details</h4></td></tr>
									<?php if(isset($_REQUEST['upsucc2'])) {  ?>
								<tr>
								<td>&nbsp;</td>
								<td colspan="2" align="left">
								<strong style="color:#006633;">Updated Successfully !!!</strong>
								</td>
								
								</tr>
								<?php } ?>
								<form name="form3" action="" method="post">
								
									<tr>
										<td>
											<strong>Nominee Name</strong>
										</td>
										<td align="center">:</td>
										<td>
				<input class="form-control"  type="text" name="nname" id="nname" value="<?php echo $userdetail['user_nomineename']; ?>" required="true">
										</td>
										</tr>
										<tr>
										<td>
											<strong>Email id</strong>
										</td>
										<td align="center">:</td>
										<td>
						<input class="form-control" type="text" name="nemail" id="nemail" value="<?php echo $userdetail['user_nemail']; ?>" required="true">
										</td>
									</tr>
									<tr>
										<td>
											<strong>Id cardtype</strong>
										</td>
										<td align="center">:</td>
										<td>
										<?php //echo $userdetail['user_identifycardtype']; ?> 
					<input  type="radio" name="icid" id="vcid" style="opacity:1;" value="Voters ID" <?php if($userdetail['user_identifycardtype']=='Voters ID') {?> checked="checked" <?php } ?> onclick="return card(this.value);" />&nbsp;&nbsp;Voters ID&nbsp; <input type="radio" name="icid" id="pcid" style="opacity:1;" value="PAN Card" onclick="return card(this.value);" <?php if($userdetail['user_identifycardtype']=='PAN Card') {?> checked="checked" <?php } ?> />&nbsp;&nbsp;PAN Card &nbsp; <input type="radio" name="icid" id="psid" style="opacity:1;" value="Passport" onclick="return card(this.value);"  <?php if($userdetail['user_identifycardtype']=='Passport') {?> checked="checked" <?php } ?>/>&nbsp;&nbsp;Passport &nbsp; <input  type="radio" name="icid" id="dlid" style="opacity:1;" value="Driving License" onclick="return card(this.value);" <?php if($userdetail['user_identifycardtype']=='Driving License') {?> checked="checked" <?php } ?>/>&nbsp;&nbsp;Driving License  &nbsp;
					<input type="radio" name="icid" id="otid" style="opacity:1;" value="others" <?php if(($userdetail['user_identifycardtype']!='Driving License') && ($userdetail['user_identifycardtype']!='Passport') && ($userdetail['user_identifycardtype']!='PAN Card') && ($userdetail['user_identifycardtype']!='Voters ID')) {?>  checked="checked" <?php } ?> onclick="return card(this.value);"/>
					&nbsp;&nbsp; Others	&nbsp;
										</td>
										</tr>
										
											
										
										<tr>
										<td>
											<strong>Id Number</strong>
										</td>
										<td align="center">:</td>
										<td>
					<input class="form-control" type="text" name="ncnumber" id="ncnumber" value="<?php echo $userdetail['user_idnumber']; ?>" required="true"> 	
										</td>
									</tr>
										<tr>
										<td colspan="3" style="border-bottom:1px #CCCCCC solid;">
											<strong>Communication Address</strong>
										</td>
										</tr>
										
										<tr>
										<td><strong>Address1 </strong></td>
										<td align="center">:</td>
										<td>
							<input class="form-control"  type="text" name="naddr1" id="naddr1" value="<?php echo $userdetail['user_naddr1']; ?>" required="true">
							</td>
							</tr>
							
							<tr>
							<td><strong>Address2 </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control"  type="text" name="naddr2" id="naddr2" value="<?php echo $userdetail['user_naddr2']; ?>" required="true">
							</td>
							</tr>
							
						     <tr>
							<td><strong>Country </strong></td>
							<td align="center">:</td>
							<td>
								<select class="form-control"  name="ncountry" id="ncountry" onchange="return showstate1(this.value);" required="true">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$nsqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($nsqlcon as $nrowcountry)
									{
									?>
									<option value="<?php echo $nrowcountry['country_id']; ?>" <?php if($nrowcountry['country_id']==$userdetail['user_ncountry']) {  ?> selected="selected" <?php } ?>><?php echo $nrowcountry['country_name']; ?></option>
									
									<?php } ?>
										
								</select>
							</td>
							</tr>
							
							 <tr>
							<td><strong>State </strong></td>
							<td align="center">:</td>
							<td>
						<div class="controls" id="nstatee">
						<select class="form-control"  name="nstate" id="nstate" onchange="return cityshow1(this.value);">
                             <option value="">--- Choose State ---</option>
								<?php
								$nsele=$db->get_all("select * from mlm_state where state_status='0' and country_id='$userdetail[user_ncountry]' order by state_name asc");
								foreach($nsele as $nst)
								{
								?>

								<option value="<?php echo $nst['state_id']; ?>" <?php if($nst['state_id']==$userdetail['user_nstate']) {  ?> selected="selected" <?php } ?>><?php echo $nst['state_name']; ?></option>
								<?php
								}
								?>
							 </select>
						</div>
							</td>
							</tr>
							
							 <tr>
							<td><strong>City </strong></td>
							<td align="center">:</td>
							<td>
							<div class="controls" id="ncityy">
							<select class="form-control"  name="ncity" id="ncity">
                             <option value="">--- Choose City ---</option>
								<?php
								$nselc=$db->get_all("select * from mlm_city where city_status='0' and state_id='$userdetail[user_nstate]' order by city_name asc");
								foreach($nselc as $nstc)
								{
								?>
								<option value="<?php echo $nstc['city_id']; ?>" <?php if($nstc['city_id']==$userdetail['user_ncity']) {  ?> selected="selected" <?php } ?>><?php echo $nstc['city_name']; ?></option>
								<?php
								}
								?>
							 </select>
									</div>
							</td>
							</tr>
							
								 <tr>
							<td><strong>Zipcode </strong></td>
							<td align="center">:</td>
							<td>
							<input class="form-control"  type="text" name="nzipcode" id="nzipcode" value="<?php echo $userdetail['user_npostalcode']; ?>" required="true">
							</td>
							</tr>
									
									<tr>
									
										<td>
											<strong>Phone Number</strong>
										</td>
										<td align="center">:</td>
										<td>
							<input class="form-control" type="text" name="nphone" id="nphone" value="<?php echo !empty($userdetail['user_nphone'])?$userdetail['user_nphone']:''; ?>" required="true">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" >
										<button type="submit"  name="update3" class="greenbtn">UPDATE</button>
										</td>
									<td>&nbsp;</td>
										</tr>
										</form>
									
								</table>
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
	</body>
</html>