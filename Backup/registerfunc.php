<?php
include "admin/AMframe/config.php"; 
include "pairing-capping.php";

if(isset($_REQUEST['register-new'])) 
{ 		
	$sid=isset($_SESSION['sid'])?$_SESSION['sid']:'';
	$epid=isset($_SESSION['epid'])?$_SESSION['epid']:'';
	$user_position = isset($_REQUEST['position']) ? addslashes($_REQUEST['position']) : '';
	
	if(!empty($sid)) 
	{
		$sponsorid=$_SESSION['profileid'];
		$sponsorname=$com_obj->userName($_SESSION['profileid']);
	}
	else 
	{
		$sponsorid=addslashes($_REQUEST['sponsorid']);
		$sponsorname=addslashes($_REQUEST['sponsorname']);
	}
	
	$password=addslashes($_REQUEST['password']);
	$passwordagain=addslashes($_REQUEST['passwordagain']);
	$placementid=addslashes($_REQUEST['placementid']);
	$pancardnum=addslashes($_REQUEST['pancardnum']);
	$profileid=generateid();

	$firstname=addslashes($_REQUEST['firstname']);
	$phonenum=addslashes($_REQUEST['phonenum']);
	$emailaddress=addslashes($_REQUEST['emailaddress']);
	
	$user_ct = $db->numrows("select * from mlm_register where user_profileid='$profileid'");
	if($user_ct > 0) {
		echo "<script>alert('Something went wrong. Please try again.');</script>";
		echo "<script>location.href='register-new.php';</script>";
		header("Location:register-new.php");
		exit;
	}
	
	if(empty($placementid)) {
		$com_obj->PlacementID($sponsorid);
		$placementid = $com_obj->placement;
	}
	
	if(empty($user_position)) {
		$placeid_count = $db->singlerec("select count(*) as ct from mlm_register where user_placementid='$placementid'");
		if($placeid_count['ct'] == 0) {
			$user_position = 'Left';
		}
		else {
			$user_position = 'Right';
		}
	}
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$insert=$db->insertrec("INSERT INTO mlm_register (user_profileid,user_password, user_sponsername,user_sponserid, user_placementid, user_position, user_pancard, user_date, user_ip, user_status, user_fname, user_phone, user_email) VALUES ('$profileid','$password', '$sponsorname', '$sponsorid', '$placementid', '$user_position', '$pancardnum', '$cur_date', '$ip_addr', '1', '$firstname', '$phonenum', '$emailaddress')");
		
	if(!empty($_SESSION['epid'])) {
		$epid = $_SESSION['epid'];
		$epinname=$db->singlerec("select * from mlm_epin where id='$epid'");
		$epin_name=$epinname['epin'];
		$epin_mem=$epinname['member_pack'];
		
		$db->insertrec("update mlm_register set epin='$epin_name',mem_package='$epin_mem',user_paymentstaus='1',user_status='0' where user_profileid='$profileid'");
		$db->insertrec("update mlm_epin set profile_id='$profileid' where id='$epid'");
		$db->insertrec("update mlm_userpin set user_add_status='1' where epin='$epin_name'");
	}

	$ui=$db->singlerec("select * from mlm_register where user_profileid='$sponsorid'");
	$prooofid=$ui['user_profileid'];
	$sponcid=$ui['user_sponserid'];
	$spocmail=$ui['user_email'];
	$sponcname=$ui['user_sponsername'];
	$subject="Downline details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Downline details from ".$website_name." </b></td>
						</tr>
						
						<th bgcolor='#FFFFFF' height='35' font-family:Arial; ><h4>Downline User Detail</h4></th>
							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid </td>
						</tr>
						
						<th bgcolor='#FFFFFF' height='35' font-family:Arial; ><h4>Downline User Sponcer Detail</h4></th>
							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $sponcid (or) $sponcname</td>
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
	
	$to=$spocmail;
	$cmail=$com_obj->commonMail($to,$subject,$msg);

	$subject="Login details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid (or) $userremail </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $password</td>
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
	
	$to=$userremail;
	$mail_sts = $com_obj->commonMail($to,$subject,$msg);
	
		if($insert) {
		//$com_obj->pairCommission($placementid);
		echo "<script>location.href='login.php?succ';</script>";
			header("location:login.php?succ");

		//header("Location:register_two.php?id=$profileid");
		//echo '<script language="javascript"> window.location="register_two.php?id='.$profileid.'"; </script>';exit;
		} else {
			die("Registration error please contact admin : <br>".mysql_error());exit;
		}
	/* }
   } */
} 
if(isset($_REQUEST['registerone'])) 
{ 
/* $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
	if($captcha) {
		echo "<script>location.href='register.php?err';</script>";
		header("location:register.php?err");
		exit;
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
		$privatekey = $captchasecretkey;
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
		  'secret' => $privatekey,
		  'response' => $captcha,
		  'remoteip' => $_SERVER['REMOTE_ADDR']
		);

		$curlConfig = array(
		  CURLOPT_URL => $url,
		  CURLOPT_POST => true,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_POSTFIELDS => $data
		);

		$ch = curl_init();
		curl_setopt_array($ch, $curlConfig);
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response);
		
		if($result->success) {
			echo "<script>location.href='register.php?catcherr';</script>";
			header("location:register.php?catcherr");
			exit;
		}
		else {  */
	$sid=isset($_SESSION['sid'])?$_SESSION['sid']:'';
	$epid=isset($_SESSION['epid'])?$_SESSION['epid']:'';
	$user_position = isset($_REQUEST['position']) ? addslashes($_REQUEST['position']) : '';
	
	if(!empty($sid)) 
	{
		$sponsorid=$_SESSION['profileid'];
		$sponsorname=$com_obj->userName($_SESSION['profileid']);
	}
	else 
	{
		$sponsorid=addslashes($_REQUEST['sponsorid']);
		$sponsorname=addslashes($_REQUEST['sponsorname']);
	}
	
	$password=addslashes($_REQUEST['password']);
	$passwordagain=addslashes($_REQUEST['passwordagain']);
	$placementid=addslashes($_REQUEST['placementid']);
	$pancardnum=addslashes($_REQUEST['pancardnum']);
	$profileid=generateid();
	
	$user_ct = $db->numrows("select * from mlm_register where user_profileid='$profileid'");
	if($user_ct > 0) {
		echo "<script>alert('Something went wrong. Please try again.');</script>";
		echo "<script>location.href='register.php';</script>";
		header("Location:register.php");
		exit;
	}
	
	if(empty($placementid)) {
		$com_obj->PlacementID($sponsorid);
		$placementid = $com_obj->placement;
	}
	
	if(empty($user_position)) {
		$placeid_count = $db->singlerec("select count(*) as ct from mlm_register where user_placementid='$placementid'");
		if($placeid_count['ct'] == 0) {
			$user_position = 'Left';
		}
		else {
			$user_position = 'Right';
		}
	}
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$insert=$db->insertrec("INSERT INTO mlm_register (user_profileid,user_password, user_sponsername,user_sponserid, user_placementid, user_position, user_pancard, user_date, user_ip, user_status) VALUES ('$profileid','$password', '$sponsorname', '$sponsorid', '$placementid', '$user_position', '$pancardnum', '$cur_date', '$ip_addr', '1')");
		
	if(!empty($_SESSION['epid'])) {
		$epid = $_SESSION['epid'];
		$epinname=$db->singlerec("select * from mlm_epin where id='$epid'");
		$epin_name=$epinname['epin'];
		$epin_mem=$epinname['member_pack'];
		
		$db->insertrec("update mlm_register set epin='$epin_name',mem_package='$epin_mem',user_paymentstaus='1',user_status='0' where user_profileid='$profileid'");
		$db->insertrec("update mlm_epin set profile_id='$profileid' where id='$epid'");
		$db->insertrec("update mlm_userpin set user_add_status='1' where epin='$epin_name'");
	}

	$ui=$db->singlerec("select * from mlm_register where user_profileid='$sponsorid'");
	$prooofid=$ui['user_profileid'];
	$sponcid=$ui['user_sponserid'];
	$spocmail=$ui['user_email'];
	$sponcname=$ui['user_sponsername'];
	$subject="Downline details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Downline details from ".$website_name." </b></td>
						</tr>
						
						<th bgcolor='#FFFFFF' height='35' font-family:Arial; ><h4>Downline User Detail</h4></th>
							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid </td>
						</tr>
						
						<th bgcolor='#FFFFFF' height='35' font-family:Arial; ><h4>Downline User Sponcer Detail</h4></th>
							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $sponcid (or) $sponcname</td>
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
	
	$to=$spocmail;
	$cmail=$com_obj->commonMail($to,$subject,$msg);
	
		if($insert) {
		//$com_obj->pairCommission($placementid);
		header("Location:register_two.php?id=$profileid");
		echo '<script language="javascript"> window.location="register_two.php?id='.$profileid.'"; </script>';exit;
		} else {
			die("Registration error please contact admin : <br>".mysql_error());exit;
		}
	/* }
   } */
} 
if(isset($_REQUEST['registertwo'])) {
	$firstname=addslashes($_REQUEST['firstname']);
	$secondname=addslashes($_REQUEST['secondname']);
	$lastname=addslashes($_REQUEST['lastname']);
	$dobdate=addslashes($_REQUEST['dobdate']);
	$dobmonth=addslashes($_REQUEST['dobmonth']);
	$dobyear=addslashes($_REQUEST['dobyear']);
	
	$addressline1=addslashes($_REQUEST['addressline1']);
	$addressline2=addslashes($_REQUEST['addressarea']);
	$addresscity=addslashes($_REQUEST['addresscity']);
	$addressstate=addslashes($_REQUEST['addressstate']);
	$addresspostal=addslashes($_REQUEST['addresspostal']);
	$addresscountry=addslashes($_REQUEST['addresscountry']);
		
	$padddress1=addslashes($_REQUEST['paddress1']);
	$padddress2=addslashes($_REQUEST['paddress2']);
	$cpcity=addslashes($_REQUEST['cpcity']);
	$cpstate=addslashes($_REQUEST['cpstate']);
	$pzipcode=addslashes($_REQUEST['pzipcode']);
	$cpcountry=addslashes($_REQUEST['cpcountry']);
		
	$phonenum=addslashes($_REQUEST['phonenum']);
	$emailaddress=addslashes($_REQUEST['emailaddress']);
		
	$bankaccname=addslashes($_REQUEST['bankaccname']);
	$dob=$dobyear."-".$dobmonth."-".$dobdate;
	$profileid=addslashes($_REQUEST['profileid']);
	
	$userid_num=$db->numrows("SELECT * FROM `mlm_register` WHERE `user_profileid`='$profileid' AND user_email='$emailaddress'");
	if($userid_num>0) {
		echo '<script language="javascript"> window.location="register_two.php?id='.$profileid.'&exists"; </script>';exit;
	}			
	
	$update=$db->insertrec("UPDATE mlm_register SET user_fname='$firstname', user_lname='$lastname', user_secondname='$secondname', user_dob='$dob', user_commaddr1='$addressline1', user_commaddr2='$addressline2', user_city='$addresscity', user_state='$addressstate', user_country='$addresscountry', user_postalcode='$addresspostal', user_phone='$phonenum', user_email='$emailaddress', user_accholdername='$bankaccname', user_accno='$accnum', user_bankname='$bankname', user_branch='$branchname', user_ifsccode='$ifsc',user_paddr1='$padddress1',user_paddr2='$padddress2',user_pcity='$cpcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$pzipcode' WHERE user_profileid='$profileid'");	
	
	if($update) 
	{
	header("Location:register_three.php?id=$profileid");
	echo '<script language="javascript"> window.location="register_three.php?id='.$profileid.'"; </script>';exit;
	}
	else 
	{
	die("Registration error your id is $profileid tell administrator about this : <br>");
	}		
}

if(isset($_REQUEST['registrationthree'])) {
	$nomname=addslashes($_REQUEST['nomname']);
	$idcardtype=addslashes($_REQUEST['idcardtype']);
	$idcardtypename=(isset($_REQUEST['idcardtypename']))? $_REQUEST['idcardtypename'] : '';
	$idcardnum=addslashes($_REQUEST['idcardnum']);
	$nomaddress=addslashes($_REQUEST['nomaddress']);
	$nomarea=addslashes($_REQUEST['nomarea']);
	$nomcity=addslashes($_REQUEST['nomcity']);
	$nomstate=addslashes($_REQUEST['nomstate']);
	$nompostal=addslashes($_REQUEST['nompostal']);
	$nomcountry=addslashes($_REQUEST['nomcountry']);
	$nomphone=addslashes($_REQUEST['nomphone']);
	$nomemail=addslashes($_REQUEST['nomemail']);
	$profileid=addslashes($_REQUEST['profileid']);
	if($idcardtype!='others') {
		$idcardtypename=$idcardtype;
	}
	
	$update=$db->insertrec("UPDATE mlm_register SET user_nomineename='$nomname', user_identifycardtype='$idcardtypename', user_idnumber='$idcardnum', user_naddr1='$nomaddress', user_naddr2='$nomarea', user_ncity='$nomcity', user_nstate='$nomstate', user_ncountry='$nomcountry', user_npostalcode='$nompostal', user_nphone='$nomphone', user_nemail='$nomemail',user_status='1', user_registered='1'  WHERE user_profileid='$profileid'");

	$sel=$db->singlerec("select * from mlm_register where user_profileid='$profileid'");
	$prooofid=$sel['user_profileid'];
	$userremail=$sel['user_email'];
	$pasdsdf=$sel['user_password'];
	$subject="Login details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid (or) $userremail </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $pasdsdf</td>
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
	
	$to=$userremail;
	$mail_sts = $com_obj->commonMail($to,$subject,$msg);
	if($_SESSION['epid'])
	{
	  	$db->insertrec("update mlm_register set user_status='0' where user_profileid='$profileid'");
		$payment_id = rand(00000,99999);
		$ip = $_SERVER['REMOTE_ADDR'];
		$epinavail = $db->singlerec("select * from mlm_epin where id='".$_SESSION['epid']."'");
		$mem_pack = $epinavail['member_pack'];
		$memInfo = $db->singlerec("select act_amount,days from mlm_membership where id='$mem_pack'");
		$mem_pack_amt = $memInfo['act_amount'];
		$dayys = $memInfo['days'];
		$exdate = date('Y-m-d', strtotime(date('Y-m-d')." + ". $dayys." days")); 
		$date_time = date("Y-m-d h:i:s");
		$set="profileid='$profileid'";
		$set.=",payment_id='$payment_id'";
		$set.=",pack='$mem_pack'";
		$set.=",amount='$mem_pack_amt'";
		$set.=",paidamt='$mem_pack_amt'";
		$set.=",status='Completed'";
		$set.=",ip_address='$ip'";
		$set.=",pay_type='manual'";
		$set.=",created_at='$date_time'";
		$set.=",modified_at='$date_time'";
		$set.=",ex_date='$exdate'";
		$db->insertrec("insert into mlm_mempayments set $set");
		
		//Referral Bonus
		$com_obj->refBonus($profileid, $mem_pack_amt);
		
		//level bonus
		$com_obj->lvl_commission($profileid);
		
		//Pair capping boonus
		pairing_carry($profileid);
		
		//rank updation
		updateRank($rank_type);
		
		unset($_SESSION['epid']);
		echo "<script>location.href='epin.php?success';</script>";
        header("Location:epin.php?success");
        exit;
	}
	if($mail_sts == "scs")
	{
	header("Location:register_four.php?id=$prooofid");
	echo '<script language="javascript"> window.location="register_four.php?id=$prooofid"; </script>';exit;
	}
	else
	{
	die("Registration error your id is $profileid tell administrator about this : <br>".mysql_error());
	}	
}

if(isset($_REQUEST['registrationfour']))
{
	$register_type = addslashes($_REQUEST['reg_type']);
	$profileid = addslashes($_REQUEST['profileid']);
	
	if($register_type == "epin_type") {
		$epin = $_REQUEST['epin'];
		
		$epin_sts = $db->singlerec("select count(*) as ct from mlm_epin where epin='$epin' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null)");
		if($epin_sts['ct'] == 1) {
			$db->insertrec("update mlm_epin set purchased_user='$profileid',profile_id='$profileid' where epin='$epin'");
			
			$payment_id = rand(00000,99999);
			$ip = $_SERVER['REMOTE_ADDR'];
			$epinavail = $db->singlerec("select * from mlm_epin where epin='$epin' and profile_id='$profileid'");
			$mem_pack = $epinavail['member_pack'];
			$memInfo = $db->singlerec("select act_amount,days from mlm_membership where id='$mem_pack'");
			$mem_pack_amt = $memInfo['act_amount'];
			$dayys = $memInfo['days'];
			$exdate = date('Y-m-d', strtotime(date('Y-m-d')." + ". $dayys." days")); 
			$date_time = date("Y-m-d h:i:s");
			$set="profileid='$profileid'";
			$set.=",payment_id='$payment_id'";
			$set.=",pack='$mem_pack'";
			$set.=",amount='$mem_pack_amt'";
			$set.=",paidamt='$mem_pack_amt'";
			$set.=",status='Completed'";
			$set.=",ip_address='$ip'";
			$set.=",pay_type='manual'";
			$set.=",created_at='$date_time'";
			$set.=",modified_at='$date_time'";
			$set.=",ex_date='$exdate'";
			$db->insertrec("insert into mlm_mempayments set $set");
			
			$db->insertrec("update mlm_register set mem_package='$mem_pack',user_status='0',user_paymentstaus='1' where user_profileid='$profileid'");
			
			//Referral Bonus
			$com_obj->refBonus($profileid, $mem_pack_amt);
			
			//level bonus
			$com_obj->lvl_commission($profileid);
			
			//Pair capping bonus
			pairing_carry($profileid);
			
			//rank updation
			updateRank($rank_type);
			
			echo "<script>location.href='login.php?succ';</script>";
			header("location:login.php?succ");
			exit;
		}
		else {
			echo "<script>location.href='register_four.php?id=$profileid&inval';</script>";
			header("location:register_four.php?id=$profileid&inval");
			exit;
		}
	}
	else {
		$memid_enc = addslashes($_REQUEST['mem']);
		$mem_id = base64_decode($memid_enc);
		if($_REQUEST['registrationfour'] == "ONLINE") {
			header("Location:instamojo.php?payMem&mem=$memid_enc&profileid=$profileid");
			echo '<script language="javascript"> window.location="register_five.php?id=$profileid&mem_id=$mem_id"; </script>';
			exit;
		}
		else {
			$db->insertrec("update mlm_register set mem_package='$mem_id' where user_profileid='$profileid'");
			
			header("Location:register_five.php?id=$profileid&mem_id=$mem_id");
			echo '<script language="javascript"> window.location="register_five.php?id=$profileid&mem_id=$mem_id"; </script>';
			exit;
		}
	}
}
?>