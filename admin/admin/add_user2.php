<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

if(!isset($_REQUEST['step1']))
{
header("location:add_user1.php");
}

$menu6='class="active"';

if(isset($_REQUEST['submit']))
{
	$uid=addslashes($_REQUEST['uid']);
	$fname = addslashes($_REQUEST['fname']);
	$secname = addslashes($_REQUEST['secname']);
	$lname = addslashes($_REQUEST['lname']);
	$date=date("Y-m-d",strtotime($_REQUEST['date']));
	
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
	$cstate=addslashes($_REQUEST['cstate']);
	$ccity=addslashes($_REQUEST['ccity']);
	$czipcode=addslashes($_REQUEST['czipcode']);
	
	$cpaddr1=addslashes($_REQUEST['cpaddr1']);
	$cpddr2=addslashes($_REQUEST['cpaddr2']);
	$cpcountry=addslashes($_REQUEST['cpcountry']);
	$cpstate=addslashes($_REQUEST['cpstate']);
	$cpcity=addslashes($_REQUEST['cpcity']);
	$cpzipcode=addslashes($_REQUEST['cpzipcode']);
	

 $insert = $db->insertrec("update mlm_register set user_fname='$fname',user_secondname='$secname',user_lname='$lname',user_dob='$date',user_phone='$phone',user_email='$email',user_accholdername='$holder',user_branch='$branch',user_ifsccode='$ifsccode',user_accno='$accno',user_bankname='$bank_name',user_commaddr1='$caddr1',user_commaddr2='$cddr2',user_city='$ccity',user_state='$cstate',user_country='$ccountry',user_postalcode='$czipcode' ,user_paddr1='$cpaddr1',user_paddr2='$cpddr2',user_pcity='$cpcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$cpzipcode' where user_id='$uid'");
	

	if($insert)
	 { 
	 header("Location:add_user3.php?uid=$uid&step2"); 
	 ?>
	<script>
	window.location="add_user3.php?uid=<?php echo $uid; ?>&step2";
	</script>	
	<?php
	
	}
}

?>
<style>
.label.arrowed-in:before
{

padding:10px;
}
.label.arrowed-in-right:after
{
padding:10px;
}

</style>

	<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 
 <script>
 
 function uservalidate2()
 {


 if(document.getElementById('fname').value == "")
	{
		alert("Enter the first Name");
		document.getElementById('fname').focus();
		return false;
	}
 
 if(document.getElementById('datee').value == "")
	{
		alert("Please Choose date of birth");
		document.getElementById('datee').focus();
		return false;
	}
	
	 if(document.getElementById('phone').value == "")
	{
		alert("Enter the phone number");
		document.getElementById('phone').focus();
		return false;
	}
	
if(document.getElementById('email').value=="")
 {
 alert("Please Enter the email address");
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
	
	
	if(document.getElementById('caddr1').value == "")
	{
		alert("Enter the communication Address");
		document.getElementById('caddr1').focus();
		return false;
	}
	
	if(document.getElementById('ccountry').value == "")
	{
		alert("Enter the communication country");
		document.getElementById('ccountry').focus();
		return false;
	}
	
		/* if(document.getElementById('cstate').value == "")
	{
		alert("Enter the communication state");
		document.getElementById('cstate').focus();
		return false;
	}
	
 		if(document.getElementById('ccity').value == "")
	{
		alert("Enter the communication city");
		document.getElementById('ccity').focus();
		return false;
	} */
	
			if(document.getElementById('czipcode').value == "")
	{
		alert("Enter the communication postalcode");
		document.getElementById('czipcode').focus();
		return false;
	}
	
 	if(document.getElementById('cpaddr1').value == "")
	{
		alert("Enter the permanent Address");
		document.getElementById('cpaddr1').focus();
		return false;
	}
	
	if(document.getElementById('cpcountry').value == "")
	{
		alert("Enter the permanent country");
		document.getElementById('cpcountry').focus();
		return false;
	}
	
		/* if(document.getElementById('cpstate').value == "")
	{
		alert("Enter the permanent state");
		document.getElementById('cstate').focus();
		return false;
	}
	
 		if(document.getElementById('cpcity').value == "")
	{
		alert("Enter the permanent city");
		document.getElementById('cpcity').focus();
		return false;
	} */
	
			if(document.getElementById('cpzipcode').value == "")
	{
		alert("Enter the permanent postalcode");
		document.getElementById('cpzipcode').focus();
		return false;
	}
	
 }
 
 
 </script>
 
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">

	tinyMCE.init({

		// General options

		mode : "textareas",

		theme : "simple",

		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options

		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,",


		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : false,



		// Example content CSS (should be your site CSS)

		content_css : "css/content.css",



		// Drop lists for link/image/media/template dialogs

		template_external_list_url : "lists/template_list.js",

		external_link_list_url : "lists/link_list.js",

		external_image_list_url : "lists/image_list.js",

		media_external_list_url : "lists/media_list.js",



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>


<script>
function showstate(str)
{

if (str=="")
  {
  alert("Please choose the communication country");
  document.getElementById("ccontry").focus();
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
    document.getElementById("cstatee").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","state_ajax.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function showcity(str)
{


if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("cstate").focus();
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
    document.getElementById("ccityy").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","city_ajax.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function stateshow(str)
{

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
xmlhttp.open("GET","state_ajax2.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function cityshow(str)
{
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
xmlhttp.open("GET","city_ajax2.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>

function commadrs()
{
var add1=document.getElementById('caddr1').value;
var add2=document.getElementById('caddr2').value;
var pc=document.getElementById('czipcode').value;
var coon=document.getElementById('ccountry').value;
var sttt=document.getElementById('cstate').value;
var cttt=document.getElementById('ccity').value;



if(document.getElementById('comm').checked==true)
{
document.getElementById('cpaddr1').value=add1;
document.getElementById('cpaddr2').value=add2;
document.getElementById('cpzipcode').value=pc;
document.getElementById('cpcountry').value=coon;
document.getElementById('cpstate').value=sttt;

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
xmlhttp.open("GET","cityval.php?q="+cttt+"&st="+sttt,true);
xmlhttp.send();


}

if(document.getElementById('comm').checked==false)
{
document.getElementById('cpaddr1').value="";
document.getElementById('cpaddr2').value="";
document.getElementById('cpzipcode').value="";
document.getElementById('cpcountry').value="";
document.getElementById('cpstate').value="";
document.getElementById('cpcity').value="";
}


}

</script>
<script>
function emailval(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please enter the email");
  document.getElementById("email").focus();
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
xmlhttp.open("GET","getemail.php?q="+str,true);
xmlhttp.send();
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
							<a href="user.php">Users</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Add User</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						ADD USERS
						
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
					
					<div>
					<div style="float:left;">
					<span class="label label-info label-large arrowed-in-right" style="padding:14px; width:200px; font-size:16px;">1.Basic Details</span>
					</div>
					
					<div style="float:left;">
					<span class="label label-info label-large  arrowed-in-right arrowed-in" style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;2. Personal Details</span>
					</div>
					
					<div style="float:left;" >
					<span class="label label-large label-light arrowed-in" style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;3.Nominee Details</span>
					</div>
					
					<!--<div style="float:left;">
					<a href="javascript:void(0);" onclick="step('4');"><span class="label label-large label-grey arrowed-in" id="classval4" style="padding:14px; width:145px; font-size:15px;">&nbsp;&nbsp;&nbsp;4. Delivery Details</span></a>
					</div>-->
					
					<div style="clear:both;">&nbsp;</div>
					</div>
					
					
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return uservalidate2();" enctype="multipart/form-data" />
								<div class="control-group">
									<label class="control-label" for="form-field-1">First Name &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="fname" id="fname" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Second Name &nbsp;&nbsp;: </label>

									<div class="controls">
										<input type="text" name="secname" id="secname" />
									</div>
								</div>
                                
								<div class="control-group">
									<label class="control-label" for="form-field-2">Last Name &nbsp;&nbsp;: </label>

									<div class="controls">
										<input type="text" name="lname" id="lname" />
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="form-field-2">D.O.B &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<input type="text" name="date" class="tcal" id="datee"/>
									
									</div>
								</div>
								
							<div class="control-group">
									<label class="control-label" for="form-field-1">Phone &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="phone" id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
						  </div>	
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Email &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="email" id="email" onChange="emailval(this.value)" />&nbsp;&nbsp; <span id="err">&nbsp;</span>
									</div>
								</div>	
								
										<div class="control-group">
									<label class="control-label" for="form-field-1"> Name as per Bank &nbsp; : </label>

									<div class="controls">
										<input type="text" name="holder_name" id="holder_name" />
									</div>
								</div>	

											<div class="control-group">
									<label class="control-label" for="form-field-1"> Bank Account No &nbsp; : </label>

									<div class="controls">
										<input type="text" name="accno" id="accno" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
								</div>	
								
	                              <div class="control-group">
									<label class="control-label" for="form-field-1"> Bank Name &nbsp; : </label>

									<div class="controls">
										<input type="text" name="bank_name" id="bank_name" />
									</div>
								</div>	
								
								 <div class="control-group">
									<label class="control-label" for="form-field-1"> Branch &nbsp; : </label>

									<div class="controls">
										<input type="text" name="branch" id="branch" />
									</div>
								</div>	
								
								 <div class="control-group">
									<label class="control-label" for="form-field-1">  IFSC &nbsp; : </label>

									<div class="controls">
										<input type="text" name="ifsc_code" id="ifsc_code" />
									</div>
								</div>	

                        <div class="control-group">
						
							<label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Communication Address </label>

						  </div>


								<div class="control-group">
									<label class="control-label" for="form-field-1">Address 1 &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="caddr1" id="caddr1" />
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Address 2 &nbsp;  : </label>

									<div class="controls">
										<input type="text" name="caddr2" id="caddr2" />
									</div>
						  </div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Country &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<select name="ccountry" id="ccountry" onchange="return showstate(this.value);">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($sqlcon as $rowcountry)
									{
									?>
									<option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>
									
									<?php } ?>
										
										</select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">State : </label>

									<div class="controls" id="cstatee">
										<select name="cstate" id="cstate" onchange="return showcity(this.value);">
                             <option value="">--- Choose State ---</option>
							 	
							 </select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">City : </label>

									<div class="controls" id="ccityy">
										<select name="ccity" id="ccity" >
                             <option value="">--- Choose City ---</option>
							 </select>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Postal Code &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="czipcode" id="czipcode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
								</div>	
								
								      <div class="control-group">
		<label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Permanent Address &nbsp;<input type="checkbox" name="comm" id="comm" onclick="return commadrs();" style="opacity: 1;" /> &nbsp;&nbsp;&nbsp;<span style="color:#999999; font-weight:normal;">&nbsp;(Communication Address same as Permanent Address)&nbsp;</span>
		
		</label>
								</div>

          
								<div class="control-group">
									<label class="control-label" for="form-field-1">Address 1 &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="cpaddr1" id="cpaddr1" />
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Address 2 &nbsp;  : </label>

									<div class="controls">
										<input type="text" name="cpaddr2" id="cpaddr2" />
									</div>
						  </div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Country &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<select name="cpcountry" id="cpcountry" onchange="return stateshow(this.value);">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($sqlcon as $rowcountry)
									{
									?>
									<option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>
									
									<?php } ?>
										
										</select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">State : </label>

									<div class="controls" id="cpstatee">
											<select name="cpstate" id="cpstate" onchange="return cityshow(this.value);" readonly>
                             <option value="">--- Choose State ---</option>
							 <?php
							   $sele=$db->get_all("select * from mlm_state where state_status='0' order by state_name asc");
							   foreach($sele as $st)
							   {
							?>
							
							<option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
							<?php
								}
							?>
							 </select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">City : </label>

									<div class="controls" id="cpcityy">
											<select name="cpcity" id="cpcity" readonly>
                             <option value="">--- Choose City ---</option>
						
							 </select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Postal Code &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="cpzipcode" id="cpzipcode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
									</div>
								</div>	

								   <div class="control-group">
		<label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">&nbsp;</label>

								</div>
								
								<input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['uid']; ?>" />
								
								
								<div class="form-actions">
								<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>
								
							</form>
</div>
							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

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
