<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu7='class="active"';

if(isset($_REQUEST['submit']))
{
$wtitle=addslashes($_REQUEST['title']);
$wname=addslashes($_REQUEST['name']);
$wkey=addslashes($_REQUEST['keywords']);
$wdes=addslashes($_REQUEST['desc']);
$wteam=addslashes($_REQUEST['team']);
$wadmin=addslashes($_REQUEST['email']);
$wurl=addslashes($_REQUEST['url']);
$fb=addslashes($_REQUEST['fb']);
$tw=addslashes($_REQUEST['tw']);
$gp=addslashes($_REQUEST['gp']);
$skype=addslashes($_REQUEST['skype']);
$currency=addslashes($_REQUEST['curr']);

	
$apikey=addslashes($_REQUEST['apikey']);
$authtoken=addslashes($_REQUEST['authtoken']);
//$wpayid=addslashes($_REQUEST['paypal']);
$capping_type=addslashes($_REQUEST['capping_type']);
//$capping_amt = addslashes($_REQUEST['capping_amt']);
$adminPno=addslashes($_REQUEST['adminPno']);
$adminSkype=addslashes($_REQUEST['adminSkype']);
$designed_by=addslashes($_REQUEST['designed_by']);
$designed_url=addslashes($_REQUEST['designed_url']);

if($_FILES['logo']['name']!=''){
	$errors= "";
	$file_name=$_FILES['logo']['name'];
	$file_size =$_FILES['logo']['size'];
    $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['logo']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/logo/".$file_name);
         $logoqry=",gen_logo='$file_name'";
      }
}
else
{
$logoqry='';
}


if($_FILES['adminProfile']['name']!=''){
	$errors= "";
	$file_name=$_FILES['adminProfile']['name'];
	$file_size =$_FILES['adminProfile']['size'];
    $file_tmp =$_FILES['adminProfile']['tmp_name'];
    $file_type=$_FILES['adminProfile']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['adminProfile']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/adminProfile/".$file_name);
         $adminImg=",admin_profile='$file_name'";
      }
}
else
{
$adminImg='';
}

if($_FILES['footerlogo']['name']!=''){
	$errors= "";
	$file_name=$_FILES['footerlogo']['name'];
	$file_size =$_FILES['footerlogo']['size'];
    $file_tmp =$_FILES['footerlogo']['tmp_name'];
    $file_type=$_FILES['footerlogo']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['footerlogo']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/footerlogo/".$file_name);
         $footlogoqry=",gen_footlogo='$file_name'";
      }
}
else
{
$footlogoqry='';
}


if($_FILES['favIcon']['name']!=''){
	$errors= "";
	$file_name=$_FILES['favIcon']['name'];
	$file_size =$_FILES['favIcon']['size'];
    $file_tmp =$_FILES['favIcon']['tmp_name'];
    $file_type=$_FILES['favIcon']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['favIcon']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/favicon/".$file_name);
         $favicon=",gen_favicon='$file_name'";
      }
}
else
{
$favicon='';
}


$qry=$db->insertrec("update mlm_generalsetting set gen_title='$wtitle',gen_keywords='$wkey',gen_desc='$wdes',gen_sitename='$wname', gen_team='$wteam',gen_mail='$wadmin',gen_url='$wurl',gen_fb='$fb', gen_twitter='$tw', gen_skype='$skype', gen_currency='$currency', gen_googleplus='$gp' $logoqry, api_key='$apikey' $footlogoqry, auth_token='$authtoken' $favicon, binary_capping_type='$capping_type',gen_phno='$adminPno',admin_skype='$adminSkype', design_name='$designed_by',design_url='$designed_url' $adminImg  where gen_id ='1'");

if(($qry) && (empty($errors)))
{
header("Location:setting.php?suss");

echo "<script>window.location='setting.php?suss';</script>";

}

}


$sel_addr=$db->singlerec("SELECT * FROM mlm_address WHERE addr_id='1'");
 
if(isset($_REQUEST['addrsubmit']))
{
    $username=addslashes($_REQUEST['username']);
	$company_name =addslashes($_REQUEST['company_name']);
	$mobile =addslashes($_REQUEST['mobile']);
	$country = addslashes($_REQUEST['country']); 
	$state =addslashes($_REQUEST['state']);
	$city =addslashes($_REQUEST['city']);
	$area =addslashes($_REQUEST['area']);
	$zipcode =addslashes($_REQUEST['zipcode']);
	
	$update = $db->insertrec("UPDATE mlm_address SET addr_name='$username',addr_companyname='$company_name',addr_mobile='$mobile',addr_country='$country',addr_state='$state',addr_city='$city',addr_area='$area',addr_zipcode='$zipcode' WHERE addr_id='1'");
	if($update)
	{
		header("Location:setting.php?suss");
		echo "<script>window.setting='address.php?suss';</script>";
		exit;
	}
	
}
 ?>
 <script>
 
 function genvalidate()
 {
 var title = document.getElementById('title').value;
  var name = document.getElementById('name').value;
   var key = document.getElementById('keywords').value;
    var des = document.getElementById('desc').value;
	 var team = document.getElementById('team').value;
	  var email = document.getElementById('email').value;
	   var url = document.getElementById('url').value;
		 var apikey = document.getElementById('apikey').value;
		 var authtoken = document.getElementById('authtoken').value;
		 var fb = document.getElementById('fb').value;
		 var tw = document.getElementById('tw').value;
		 var gp = document.getElementById('gp').value;
		 var skype = document.getElementById('skypeId').value;
		  var curr = document.getElementById('currId').value;
		  var image = document.getElementById('logo').value;
		  var cappingtypeId = document.getElementById('cappingtypeId').value;
		  //var cappingamtId = document.getElementById('cappingamtId').value;
		  
 if(title == "")
	{
		alert("Enter the Website title");
		document.getElementById('title').focus();
		return false;
	}
 
  if(key == "")
	{
		alert("Enterthe Website Keywords");
		document.getElementById('keywords').focus();
		return false;
	}
 
  if(des == "")
	{
		alert("Enter the Website description");
		document.getElementById('desc').focus();
		return false;
	}
 
  if(team == "")
	{
		alert("Enter the Website Team");
		document.getElementById('team').focus();
		return false;
	}
 
  if(name == "")
	{
		alert("Enter the Website name");
		document.getElementById('name').focus();
		return false;
	}
 
  if(email == "")
	{
		alert("Enter the Email address");
		document.getElementById('email').focus();
		return false;
	}
	else
	{
	var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.getElementById('email').value)==false)
	{
	alert("Enter the Valid Email Address");
	document.getElementById('email').focus();
	document.getElementById('email').value = "";
	return false;
	}
	
	}
	
	
	
 
  if(url == "")
	{
		alert("Enter the Website URL");
		document.getElementById('url').focus();
		return false;
	}
 
 
  if(apikey == "")
	{
		alert("Enter the Website API KEY");
		document.getElementById('apikey').focus();
		return false;
	}
	 if(authtoken == "")
	{
		alert("Enter the Website Auth Token");
		document.getElementById('authtoken').focus();
		return false;
	}
	if(fb == "")
	{
		alert("Enter the Facebook Link");
		document.getElementById('fb').focus();
		return false;
	}
	if(tw == "")
	{
		alert("Enter the Twitter Link");
		document.getElementById('tw').focus();
		return false;
	}
	if(gp == "")
	{
		alert("Enter the Google Plus Link");
		document.getElementById('gp').focus();
		return false;
	}
	if(skype == "")
	{
		alert("Enter the Google Plus Link");
		document.getElementById('skypeId').focus();
		return false;
	}
	if(curr == "")
	{
		alert("Enter the currency value");
		document.getElementById('currId').focus();
		return false;
	}
	if(cappingtypeId == "")
	{
		alert("Select Binary Capping Type");
		document.getElementById('cappingtypeId').focus();
		return false;
	}
	/* if(cappingamtId == "")
	{
		alert("Enter Binary Capping Amount");
		document.getElementById('cappingamtId').focus();
		return false;
	} */

     if(document.getElementById('hide').value == "")
	 {
 	if(image == "")
	{
		alert("Please enter the the Website Logo");
		document.getElementById('logo').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('logo').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('logo').value="";
			  document.getElementById('logo').focus();
			  return false;
		 }
	}
	}
 
 
 }
 
 
 </script>
 

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li>
							<a href="setting.php">General Website Settings </a>

							<!--<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>-->
						</li>
						
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							General Settings
							
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
						
						 <?php 
						  echo  $errors=isset($errors)?$errors:'';
						  ?> 
						
						 <?php 
						   
						   if(isset($_REQUEST['suss']) && (empty($errors)))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									 Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
							<!--PAGE CONTENT BEGINS-->
                       <div class="row-fluid">
					
					     <div class="control-group">
						
							<label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">General Settings</label>

						  </div>
					
					<div class="span12">
							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return genvalidate();" enctype="multipart/form-data" >
								<div class="control-group">
									<label class="control-label" for="form-field-1">Website Title <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="title" id="title" value="<?php echo $website_title; ?>"/>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Website Keywords<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="keywords" id="keywords" style="width:300px; height:100px;"><?php echo $website_keywords; ?></textarea>
									
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Website Description <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<textarea name="desc" id="desc" style="width:300px; height:100px;"><?php echo $website_desc; ?></textarea>
									
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="form-field-1">Website Team <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="team" id="team" value="<?php echo $website_team; ?>" />
									</div>
								</div>

							   <div class="control-group">
									<label class="control-label" for="form-field-1">Website Name <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="name" id="name" value="<?php echo $website_name; ?>"/>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Website URL <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="url" id="url" value="<?php echo $website_url; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: http://www.domain.com</span>
									</div>
								</div>
								
                               <div class="control-group">
									<label class="control-label" for="form-field-1">Binary Capping Type <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
                                     <select id="cappingtypeId" class="form-control" name="capping_type" required="true">
                                     <option value="">SELECT</option>
                                     <option value="daily" <? if($gen_binary_capping_type == 'daily') {echo 'selected';}?>>Daily</option>
									 <option value="weekly" <? if($gen_binary_capping_type == 'weekly') {echo 'selected';}?>>Weekly</option>
                                     <option value="monthly" <? if($gen_binary_capping_type == 'monthly') {echo 'selected';}?>>Monthly</option>
									</select>
									</div>
								</div>
								<!--<div class="control-group">
									<label class="control-label" for="form-field-1">Binary Capping Amount <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="capping_amt" id="cappingamtId" value="<?php echo $gen_binary_capping_amt; ?>"/>&nbsp;<span style="color:#CCCCCC"><?=$sitecurrency;?> </span>
									</div>
								</div>-->
							   <div class="control-group">
									<label class="control-label" for="form-field-1">Admin Email <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="email" id="email" value="<?php echo $website_admin; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: example@domain.com</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Admin Phone <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="adminPno" id="adminPno" value="<?php echo $website_phone; ?>"/>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-2">Admin Skype/Whatsapp<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									    <input type="text" name="adminSkype" id="adminSkype" value="<?php echo $website_skype; ?>"/>
										
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Designed By<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									    <input type="text" name="designed_by" id="designed_by" value="<?php echo $designedBy; ?>"/>
										
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Designed URL<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									    <input type="text" name="designed_url" id="designed_url" value="<?php echo $designedUrl; ?>"/>
										
									</div>
								</div>
								
								<!--<div class="control-group">
									<label class="control-label" for="form-field-1">Paypal Email <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="paypal" id="paypal" value="<?php echo $paypal_id; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: example@domain.com</span>
									</div>
								</div>-->
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">API KEY <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="apikey" id="apikey" value="<?php echo $API_KEY; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: xhg678b4bd9kd8</span>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Auth Token <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="authtoken" id="authtoken" value="<?php echo $AUTH_TOKEN; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: 1652248fdsf5xhg67</span>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Facebook <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="fb" id="fb" value="<?php echo $gen_fb; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: facebook.com/xyz</span>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Twitter <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="tw" id="tw" value="<?php echo $gen_twitter; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: twitter.com/xyz</span>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Google Plus <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="gp" id="gp" value="<?php echo $gen_googleplus; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: plus.google.com/xyz</span>
									</div>
								</div>
							
							<div class="control-group">
									<label class="control-label" for="form-field-1">LinkedIN <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="skype" id="skypeId" value="<?php echo $gen_skype; ?>"/>&nbsp;<span style="color:#CCCCCC">Ex: rubysymal</span>
									</div>
								</div>
									<div class="control-group">
									<label class="control-label" for="form-field-1">SiteCurrency <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="curr" id="currId" value="<?php echo $sitecurrency ?>"/>&nbsp;<span style="color:#CCCCCC">Ex:USD</span>
									</div>
								</div>
									<div class="control-group">
									<label class="control-label" for="form-field-1">Current Logo&nbsp; : </label>

									<div class="controls">
										<img src="../uploads/logo/<?php echo $sitelogo;  ?>" width="180" height="60" />
									</div>
								</div>
								
								<input type="hidden" name="hide" id="hide" value="<?php echo $sitelogo;  ?>" />
								
							    <div class="control-group">
									<label class="control-label" for="form-field-1">Website Logo <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									  <input type="file" name="logo" id="logo" accept="image/*" />
									</div>
								</div>                         
								<div class="control-group">
									<label class="control-label" for="form-field-1">Current Footer Logo&nbsp; : </label>

									<div class="controls" style="background-color:black;width:200px">
										<img src="../uploads/footerlogo/<?php echo $siteFooterlogo;  ?>" width="180" height="60" />
									</div>
								</div>
								
								<input type="hidden" name="foothide" id="foothide" value="<?php echo $siteFooterlogo;  ?>" />
								
							   <div class="control-group">
									<label class="control-label" for="form-field-1">Website Footer Logo <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									  <input type="file" name="footerlogo" id="footerlogo" accept="image/*" />
									</div>
                                 </div>
								
                                <div class="control-group">
									<label class="control-label" for="form-field-1">Admin Profile&nbsp; : </label>

									<div class="controls" >
									<?php if(!empty($siteAdminProfile) || file_exists("../uploads/adminProfile/$siteAdminProfile")) {?>
									   <img src="../uploads/adminProfile/<?php echo $siteAdminProfile;  ?>" width="60" height="60" />
									<?}else{ ?>
									   <img src="../uploads/adminProfile/profile.jpg" width="180" height="60" />
									<?}?>
									</div>
								</div>
								
								<input type="hidden" name="adminprohide" id="adminprohide" value="<?php echo $siteAdminProfile;  ?>" />
								
							   <div class="control-group">
									<label class="control-label" for="form-field-1">Admin Profile <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									  <input type="file" name="adminProfile" id="adminProfile" accept="image/*" />
									</div>
                                 </div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Current Favicon&nbsp; : </label>

									<div class="controls" style="width:50px">
										<img src="../uploads/favicon/<?php echo $siteFavicon;  ?>" width="180" height="60" />
									</div>
								</div>
								
								<input type="hidden" name="footicon" id="footicon" value="<?php echo $siteFavicon;  ?>" />
								
							   <div class="control-group">
									<label class="control-label" for="form-field-1">Website Favicon <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									  <input type="file" name="favIcon" id="favIcon" accept="image/*" />
									</div>
                                </div>   
								   
								   
								   
								<div class="form-actions">
									<!--<button class="btn btn-info" name="submit" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button> -->
								<input type="submit" <?php if ($demomode=='true') {?>  name="" onclick="return demo()" <? } else { ?> name="submit" <?php } ?> value="SUBMIT" class="btn btn-info" style="font-weight:bold;" >
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>

								<!--/row-->


								<!--/row-->

							
								
							</form>
							</div>
							</div>
							<div class="row-fluid">
					
					     <div class="control-group">
						
							<label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">Change Address </label>

						  </div>
					

						<div class="span12">
                            <form class="form-horizontal" name="pass" action="" method="post" >
								<div class="control-group">
									<label class="control-label" for="form-field-1">Contact Name <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="username" id="username" value="<?php echo $sel_addr['addr_name']; ?>" required />
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Company Name <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="company_name" id="company_name" value="<?php echo $sel_addr['addr_companyname']; ?>" required/>
										
									</div>
								</div>	
								
                             	<div class="control-group">
									<label class="control-label" for="form-field-1">Contact Number <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="mobile" id="mobile" value="<?php echo $sel_addr['addr_mobile']; ?>" required/>
									</div>
								</div>	
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Country <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="country" id="country" value="<?php echo $sel_addr['addr_country']; ?>" required/>
									</div>
								</div>	
											
											
											<div class="control-group">
									<label class="control-label" for="form-field-1">State <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="state" id="state" value="<?php echo $sel_addr['addr_state']; ?>" required/>
									</div>
								</div>	
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">City <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="city" id="city" value="<?php echo $sel_addr['addr_city']; ?>" required/>
									</div>
								</div>	
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Area <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="area" id="area" value="<?php echo $sel_addr['addr_area']; ?>" required/>
									</div>
								</div>				
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Postal Code <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
							<input type="text" name="zipcode" id="zipcode" value="<?php echo $sel_addr['addr_zipcode']; ?>" required/>
									</div>
								</div>	
								
								<div class="form-actions">
							<input type="submit" name="addrsubmit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>

								<!--/row-->


								<!--/row-->

							
								
							</form></div></div>
							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/flot/jquery.flot.min.js"></script>
		<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>

	
	</body>
</html>