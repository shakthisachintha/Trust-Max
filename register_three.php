<?php 
include "includes-new/header.php";

if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
	$profileid=$_REQUEST['id'];
} else {
	echo "<script>location.href='index.php';</script>";
	header("Location:index.php");
	exit;
}
?>
<script type="text/javascript">
function checkIt(evt) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = "";
    return true
}

function othercheck(status) {
	if(status=='yes') {
	document.getElementById('otheridname').style.display='block';
	} else {
	document.getElementById('otheridname').style.display='none';
	}
}

function radio(){
	if((form1.idcardtype[0].checked==false)&&(form1.idcardtype[1].checked==false)&&(form1.idcardtype[2].checked==false)&&(form1.idcardtype[3].checked==false)&&(form1.idcardtype[4].checked==false))
   {
    alert("select Idcardtype");
    document.form1.idcardtype.focus();
    return false;
   }
   var passport=document.getElementById("idcardnum").value;
   if(passport=="")
   {
	alert("Enter ID proof Number");
	document.getElementById("idcardnum").focus();
	return false;   
   }
   if(form1.idcardtype[2].checked)
   {
	    var regsaid = /[a-zA-Z]{2}[0-9]{7}/;
	 if(regsaid.test(passport) == false)
        {
            alert("Passport is not yet valid.");
			document.getElementById("idcardnum").focus();
			return false;
        }
   }
	if(form1.idcardtype[1].checked)
   {
			var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
			if(!regpan.test(passport)){
			alert('Invalid Pancard Number');
			document.getElementById("idcardnum").focus();
			 return false;
			}
	}
	if(form1.idcardtype[3].checked)
   {
	var strFilter = /^[0-3][0-9]{7}$/;
	if (!strFilter.test(passport)) {
    alert("Please enter valid 8-digit license number\r\n(Only digits)");
	document.getElementById("idcardnum").focus();
    return false;
	}
	}
	if(form1.idcardtype[0].checked)
   {
	var letterNumber = /^[0-9a-zA-Z]+$/;
	if(!passport.match(letterNumber)) 
	{
	alert("Please enter valid Voter Id number.");
	document.getElementById("idcardnum").focus();
    return false;
	}
	
	}
	
	if(form1.idcardtype[4].checked)
   {
	var x=document.getElementById("idcardtypename").value;
	
	if(x=="") 
	{
	alert("Please enter Id Proof name.");
	document.getElementById("idcardtypename").focus();
    return false;
	}
	
	if(passport=="") 
	{
	alert("Please enter Id Proof number.");
	document.getElementById("idcardnum").focus();
    return false;
	}
	
	}
	
	
	
}
</script>
<!-- Breadcrumb -->
       
<div class="forny-container section-padding-sm">
        
    <div class="container forny-inner">
        
    <div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
        <div class="forny-form">
            <div class="forny-logo">
                <a href="#">
                   <?php if(!empty($sitelogo) && file_exists("uploads/logo/$sitelogo")){ ?>
							<img src="uploads/logo/<?=$sitelogo;?>" alt="<?=$website_title;?>" width="175" height="55"/>
						 <?}else {?>
						 <img src="uploads/no_image.jpg" alt="blog thumbnail" width="175" height="55">
						 <? } ?>
                </a>
            </div>
			
            <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                    <a class="nav-link bg-transparent active" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                        <span>Step 3 * (Nominee Information)</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
            	
       <form class="register-form" method="post" action="registerfunc.php" enctype="multipart-form/data" name="form1">
	          
 		        <div class="form-group">
				   <label for="sponsorid" ><b>Nominee Name: <span class="required">*</span></b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your full name" name="nomname" id="nomname" required="true" />
					</div>
					
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>Identity Card Type: <span class="required">*</span></b> </label>

				<div style="float:left;">
				<label for="voterid" class="checkbox" style="color: #4d8af0;font-size: 14px;">
				<input type="radio" name="idcardtype" id="voterid" class="box" id="inlineCheckbox1" value="Voters ID" required="required" onclick="othercheck('no')" style="width:18px;"/>
				&nbsp; Voters ID
				</label>

				<label for="pancard" class="checkbox" style="color: #4d8af0;font-size: 14px;">
				<input type="radio" name="idcardtype" id="pancard" class="box" id="inlineCheckbox1" value="PAN Card" onclick="othercheck('no')" style="width:18px;"/>
				&nbsp; PAN Card 
				</label>

				<label for="passport" class="checkbox" style="color: #4d8af0;font-size: 14px;">
				<input type="radio" name="idcardtype" id="passport" class="box" id="inlineCheckbox1" value="Passport" onclick="othercheck('no')" style="width:18px;" />
				&nbsp; Passport 
				</label>

				<label for="driving" class="checkbox" style="color: #4d8af0;font-size: 14px;">
				<input type="radio" name="idcardtype" id="driving" class="box" id="inlineCheckbox1" value="Driving License" onclick="othercheck('no')" style="width:18px;" />
				&nbsp; Driving License
				</label>

				<label for="others" class="checkbox" style="color: #4d8af0;font-size: 14px;">
				<input type="radio" name="idcardtype" id="others" class="box" id="inlineCheckbox1" value="others" onclick="othercheck('yes')" style="width:18px;" />
				&nbsp; Others 
				</label>
				</div>
				</div>
				<div style="display:none;" id="otheridname">
				<div class="form-group">
				   <label for="placementid" ><b>ID Card Name: <span class="required">*</span> </b></label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter Id card type here" name="idcardtypename" id="idcardtypename" />
					</div>
				</div>
				</div>
				<div class="form-group">
				   <label for="placementid" ><b>ID Card Number: <span class="required">*</span> </b></label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter Id card number" name="idcardnum" onblur="numtypeval();" id="idcardnum" required="true"  />
					</div>
				</div>
				
				
				
				<h5>Communication Address : <input type="checkbox" name="comm" id="comm"  style="opacity: 1;width:18px;" />&nbsp;&nbsp;&nbsp;<span style="font-size: 13px;color: #6b9811;">&nbsp;<b>(Communication Address same as Member’s Communication Address)&nbsp;<b></span></h5>
				<div id="memresult">
				<div class="form-group">
				   <label for="passwordagain" ><b>Address Line 1 <span class="required">*</span> </b></label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your address #1" name="nomaddress" id="nomaddress" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Address Line 2 <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your area" name="nomarea" id="nomarea" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Postal Code <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Postal Code" name="nompostal" onKeyPress="return checkIt(event);" id="nompostal" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Country <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <select name="nomcountry" id="nomcountry" class="form-control" onChange="return showstate(this.value);" style="margin-bottom:16px;" required="true">
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
				<div class="form-group">
				   <label for="password" ><b>State </b> </label>
					<div class="input-group">
					   <div id="nstatee" class="input-group">
						<select name="nomstate" id="nomstate" class="form-control" onChange="return cityshow(this.value);" style="margin-bottom:16px;">
						<option value="">--- Choose State ---</option>

						</select>
						</div>
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>City </b> </label>
					<div class="input-group">
					   <div  id="ncityy" class="input-group">
						<select name="nomcity" id="nomcity" class="form-control" style="margin-bottom:16px;">
						<option value="">--- Choose City ---</option>
						</select>
						</div>
					</div>
				</div></div>	
				<div class="form-group">
				   <label for="password" ><b>Nominee Phone: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your phone" name="nomphone" id="nomphone" onKeyPress="return checkIt(event);" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Nominee Email: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your email address" name="nomemail" onblur="mailval();" id="nomemail" required="true" />
					</div>
				</div>
				<input type="hidden" name="profileid" value="<?php echo $profileid;?>" />
				

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block" type="submit" name="registrationthree" onclick="return radio()">Next</button>
                            </div>
                        </div>

                        
                            <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		 </div>
		<div class="col-sm-3"></div>
		 </div>
    </div>
<script src="js/jquery.js"></script>
    </div>
 <script>
function mailval(str)
{
//alert("gfhfg");
var str = document.getElementById("nomemail").value;
if (str!="")
  {
  
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
	if(xmlhttp.responseText==4)
	{
	document.getElementById("err").innerHTML="<font style='color:#006633;'>Valid Email !!!</font>";
	}
	else if(xmlhttp.responseText==24)
	{
	document.getElementById("err").innerHTML="<font style='color:red;'>In Valid Email !!!</font>";
	document.getElementById("nomemail").value="";
	return false;
	}
	else if(xmlhttp.responseText==3)
	{
	document.getElementById("nomemail").value="";
	document.getElementById("err").innerHTML="<font style='color:#FF0000;'>Nominee Email Address Already exists !!!</font>";
	return false;
	}
	
    }
  }
  }
xmlhttp.open("GET","getnmail.php?q="+str,true);
xmlhttp.send();
}
</script>
   <script>
function showstate(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication country");
  document.getElementById("nomcontry").focus();
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
function cityshow(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("nomstate").focus();
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
  jQuery('#comm').click(function(){
	   if(jQuery('#comm').prop('checked') == true){
			var memberid = "memberid=" + '<?php echo $_REQUEST['id'];?>';
				jQuery.ajax({
					dataType : 'html',
					type: 'POST',
					url : 'getmemberaddr.php',
					cache: false,
					data : memberid,
					complete : function() {  },
					success: function(data) {
					jQuery('#memresult').html(data);
					}
				});
		}
		else if(jQuery('#comm').prop('checked') == false){
		jQuery('#naddr1').removeAttr("readonly");
		jQuery('#naddr1').val("");
		jQuery('#naddr2').removeAttr("readonly");
		jQuery('#naddr2').val("");
		jQuery('#ncountry').val("");
		jQuery('#ncountry').removeAttr("readonly");
		jQuery('#nstate').val("");
		jQuery('#nstate').removeAttr("readonly");
		jQuery('#ncity').val("");
		jQuery('#ndist').val("");
		jQuery('#ncity').removeAttr("readonly");
		jQuery('#ndist').removeAttr("readonly");
		jQuery('#nzipcode').val("");
		jQuery('#nzipcode').removeAttr("readonly");
		}
	});  
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var result= regex.test(email);
  if(result==false){
  alert("Invalid Email ID");
  document.getElementById('nomemail').focus();
   document.getElementById('nomemail').value="";
  return false;
  }
}
</script>
<?php include "includes-new/footer.php" ?>