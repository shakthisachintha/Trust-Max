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
</script>
<script>
function checkit(evt){

	var keyCode = (evt.which) ? evt.which : evt.keyCode
	if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32){
		status = "This field accepts character only."
		return false;
	}
	status = "";
	return true;
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
                        <span>Step 2 * (Personal Information)</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
               
                <div class="tab-pane fade active show" role="tabpanel" id="register">
			<?php
				$Random=$db->singlerec("select user_profileid from mlm_register where user_status='0' order by rand()");
				?>	
				
       <form class="register-form" method="post" action="registerfunc.php" name="regtwo" id="regtwo" enctype="multipart-form/data">
	          
 		        <div class="form-group">
				   <label for="sponsorid" ><b>First Name: <span class="required">*</span></b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your first name" name="firstname" id="firstname" required="true" />
					</div>
					
				</div>
				<div class="form-group">
				   <label for="sponsorname"><b> Second Name: </b></label>
					<div class="input-group">
					   <input class="form-control" placeholder="Enter your second name" type="text" name="secondname" id="secondname" />
					</div>
				</div>
				<div class="form-group">
				   <label for="placementid" ><b>Last Name: <span class="required">*</span> </b></label>
					<div class="input-group">
					   <input class="form-control" placeholder="Enter your last name" type="text" name="lastname" id="lastname"  />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Date of Birth: <span class="required">*</span></b> </label>
					<div class="input-group">
					   <select  class="form-control" style="width:50px;" name="dobdate" required="true">
						<option value="">Date</option>
						<option value="01">1</option>
						<option value="02">2</option>
						<option value="03">3</option>
						<option value="04">4</option>
						<option value="05">5</option>
						<option value="06">6</option>
						<option value="07">7</option>
						<option value="08">8</option>
						<option value="09">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						</select>
						<select id="m" name="dobmonth" class="form-control" style="width:70px;" required="true">
						<option value="">month</option>
						<option value="01">Jan</option>
						<option value="02">Feb</option>
						<option value="03">Mar</option>
						<option value="04">Apr</option>
						<option value="05">May</option>
						<option value="06">Jun</option>
						<option value="07">Jul</option>
						<option value="08">Aug</option>
						<option value="09">Sep</option>
						<option value="10">Oct</option>
						<option value="11">Nov</option>
						<option value="12">Dec</option>
						</select>
						
						<input class="form-control"  style="width:70px;" type="text" placeholder="YYYY" name="dobyear" id="dobyear" onBlur="calage();"  onKeyPress="return checkIt(event);" required="true" />
						
					</div>
				</div>
				<h5>Communication Address:</h5>
				<div class="form-group">
				   <label for="passwordagain" ><b>Address Line 1 <span class="required">*</span> </b></label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your address #1" name="addressline1" id="addressline1" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Area <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Area" name="addressarea" id="addressarea" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Country <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <select name="addresscountry" id="addresscountry" onChange="return disstate(this.value);"  class="form-control"  required="true">
					   <option value="">--- Choose Country ---</option>
						<?php 

						$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
						foreach($sqlcon as $rowcountry)
						{
						?>
						<option value="<?php echo $rowcountry['country_id']; ?>" <?php if($rowcountry['country_id']=='94') { ?> selected="selected" <?php } ?>><?php echo $rowcountry['country_name']; ?></option>

						<?php } ?>

						</select>
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>State  </b> </label>
					<div class="input-group">
					   <div id="astate" class="input-group">
						<select name="addressstate" id="addressstate" onChange="return discity(this.value);" class="form-control"  >
						<option value="">--- Choose State ---</option>													
						<?php
						   $sele=$db->get_all("select * from mlm_state where country_id ='94' and state_status='0'");
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
				</div>
				<div class="form-group">
				   <label for="password" ><b>City  </b> </label>
					<div class="input-group">
					   <div id="acity" class="input-group">  
						<select name="addresscity" id="addresscity" class="form-control" >
						<option value="">--- Choose City ---</option>
						</select><img src="images/ajax_loading.gif" id="loading" style="display: none;" />
						</div>
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Postal Code <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" onKeyPress="return checkIt(event);" type="text" placeholder="Enter your Postal code" name="addresspostal" id="addresspostal" required="true" />
					</div>
				</div>
				<h5>Permanent Address:<input type="checkbox" name="comm" id="comm" onClick="return commadrs();" style="opacity: 1;width:23px;" /> <span style="font-size: 13px;color: #6b9811;">&nbsp;<b>(Communication Address same as Permanent Address)&nbsp;</b></span></h5>
                <div class="form-group">
				   <label for="password" ><b>Address Line 1 <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="* Enter your address #1" name="paddress1" id="paddress1" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Area <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="* Enter your address #2" name="paddress2" id="paddress2" required="true" />
					</div>
				</div>
				
				<div class="form-group">
				   <label for="password" ><b>Country <span class="required">*</span> </b> </label>
					<div class="input-group">
					  <select name="cpcountry" id="cpcountry" onChange="return stateview(this.value);" style=" margin-bottom:16px;" class="form-control" required="true">
						<option value="">--- Choose Country ---</option>
						<?php 

						$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
						foreach($sqlcon as $rowcountry)
						{
						?>
						<option value="<?php echo $rowcountry['country_id']; ?>" <?php if($rowcountry['country_id']=='94') { ?> selected="selected" <?php } ?>><?php echo $rowcountry['country_name']; ?></option>

						<?php } ?>

						</select>
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>State </b> </label>
					<div class="input-group">
					  <div id="pstate" class="input-group">
						<select name="cpstate" id="cpstate" onChange="return cityview(this.value);" style=" margin-bottom:16px;" class="form-control">
						<option value="">--- Choose State ---</option>
						<?php
						   $sele=$db->get_all("select * from mlm_state where country_id ='94' and state_status='0'");
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
				</div>
				<div class="form-group">
				   <label for="password" ><b>City  </b> </label>
					<div class="input-group">
					   <div id="pcity" class="input-group">
						<select name="cpcity" id="cpcity" style="margin-bottom:16px;" class="form-control">
						<option value="">--- Choose City ---</option>

						</select>
						</div>
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Postal Code <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="* Enter your address #1" name="pzipcode" onKeyPress="return checkIt(event);" id="pzipcode"  required="true" />
					</div>
				</div>
				<h5>Contact Details: </h5>
				<div class="form-group">
				   <label for="password" ><b>Phone (or) Mobile: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Phone number" name="phonenum" id="phonenum" onKeyPress="return checkIt(event);" required="true" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Email: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Email address" onblur="mailval();" name="emailaddress" id="emailaddress" required="true" />
					</div>
				</div>
				<h5>Bank Details: </h5>
				<div class="form-group">
				   <label for="password" ><b>Bank Account Name: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your bank account name" name="bankaccname" onKeyPress="return checkit(event);" id="bankaccname"  />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Bank Account No: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" onKeyPress="return checkIt(event);"  style="margin-bottom:16px;" type="text" placeholder="Enter your account number" name="accnum" id="accnum" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Bank Name: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your bank name" onKeyPress="return checkit(event);" name="bankname" id="bankname"  />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>Branch: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Branch name" onKeyPress="return checkit(event);" name="branchname" id="branchname" />
					</div>
				</div>
				<div class="form-group">
				   <label for="password" ><b>IFSC: <span class="required">*</span> </b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Bank IFSC code" name="ifsc" id="ifsc"  />
					   <input type="hidden" name="profileid" value="<?php echo $profileid;?>"/>
					</div>
				</div>
				

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block" type="submit" name="registertwo">Next</button>
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

    </div>
 <script>
function disstate(str)
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
//alert(str);

document.getElementById('loading').style.display='block';

if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("addressstate").focus();
  return false;
  }
 // alert("gfhfg");
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
    document.getElementById("addresscity").innerHTML=xmlhttp.responseText;
	document.getElementById('loading').style.display='none';
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
    document.getElementById("pstate").innerHTML=xmlhttp.responseText;
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
    document.getElementById("pcity").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cityajax2.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>

function commadrs()
{
var add1=document.getElementById('addressline1').value;
var add2=document.getElementById('addressarea').value;
var pc=document.getElementById('addresspostal').value;
var coon=document.getElementById('addresscountry').value;
var sttt=document.getElementById('addressstate').value;
var cttt=document.getElementById('addresscity').value;


if(document.getElementById('comm').checked==true)
{
document.getElementById('paddress1').value=add1;
document.getElementById('paddress2').value=add2;
document.getElementById('pzipcode').value=pc;
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
    document.getElementById("pcity").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cityvalue.php?q="+cttt+"&st="+sttt,true);
xmlhttp.send();


}

if(document.getElementById('comm').checked==false)
{
document.getElementById('paddress1').value="";
document.getElementById('paddress2').value="";
document.getElementById('pzipcode').value="";
document.getElementById('cpcountry').value="";
document.getElementById('cpstate').value="";
document.getElementById('cpcity').value="";
}


}

</script>
<script>
function numval(str){
	var str = document.getElementById("phonenum").value;
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
	document.getElementById("err").innerHTML="<font style='color:#006633;'>Valid Phone (or) Mobile !!!</font>";
	}
	else if(xmlhttp.responseText==24)
	{
	document.getElementById("err").innerHTML="<font style='color:red;'>In Valid Phone (or) Mobile !!!</font>";
	document.getElementById("phonenum").value="";
	return false;
	}
	else if(xmlhttp.responseText==3)
	{
	document.getElementById("phonenum").value="";
	document.getElementById("err").innerHTML="<font style='color:#FF0000;'>Phone (or) Mobile number exists !!!</font>";
	return false;
	}
	
    }
  }
  }
xmlhttp.open("GET","getmob.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function mailval(str)
{
//alert("gfhfg");
var str = document.getElementById("emailaddress").value;
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
	document.getElementById("emailaddress").value="";
	return false;
	}
	else if(xmlhttp.responseText==3)
	{
	document.getElementById("emailaddress").value="";
	document.getElementById("err").innerHTML="<font style='color:#FF0000;'>Email Address Already exists, Click Here to <span><a href='forgot.php' style='font-weight:bold; color:#000000; text-decoration:underline;'>  Forgot Password  !!!</a></span></font>";
	return false;
	}
	
    }
  }
  }
xmlhttp.open("GET","getmail.php?q="+str,true);
xmlhttp.send();
}
function calage(){
	var birth_month = document.getElementById("m").value;
	var birth_day = document.getElementById("d").value;
	var birth_year = document.getElementById("dobyear").value;
	if(birth_year!="") {
		var age=parseInt(calculate_age(birth_month,birth_day,birth_year));
		if((age<=17) || (age>=110)){
			alert("Age should be greater than or equal to 18");
			document.getElementById("dobyear").value="";
			document.getElementById("dobyear").focus();
			return false;
		}
	}
}
function calculate_age(birth_month,birth_day,birth_year)
{
    today_date = new Date();
    today_year = today_date.getFullYear();
    today_month = today_date.getMonth();
    today_day = today_date.getDate();
    age = today_year - birth_year;

    if ( today_month < (birth_month - 1))
    {
        age--;
    }
    if (((birth_month - 1) == today_month) && (today_day < birth_day))
    {
        age--;
    }
    return age;
}
</script>

<?php include "includes-new/footer.php" ?>