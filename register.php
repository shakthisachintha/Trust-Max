<?php include "includes-new/header.php"; 
$sessionid=isset($_SESSION['profileid'])?$_SESSION['profileid']:'';
$sid=isset($_REQUEST['sid'])?$_REQUEST['sid']:'';
$epinid=isset($_REQUEST['epinid'])?$_REQUEST['epinid']:'';
if(!empty($sessionid) && empty($sid) && empty($eid))
{
echo "<script>location.href='dashboard.php';</script>";
header("Location:dashboard.php");
exit;
}

$epin_decode=base64_decode($epinid);
$_SESSION['sid']=$sid;
$_SESSION['epid']=$epin_decode;
?>

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
			<h4 class="text-center" style="color: #44ce6f;">Register</h4>
            <!--<ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                    <a class="nav-link bg-transparent active" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                        <span>Step 1 * (Basic Information)</span>
                    </a>
                </li>
            </ul>-->
            <div class="tab-content">
               
                <div class="tab-pane fade active show" role="tabpanel" id="register">
			<?php
				$Random=$db->singlerec("select user_profileid from mlm_register where user_status='0' order by rand()");
				?>	
				
       <form class="register-form" method="post" onSubmit="return formvalidation();" action="registerfunc.php">
	           <?php if(!empty($sid)) { ?><div class="hidden"> <?php } ?>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label><b>First Name: <span class="required">*</span></b> </label>
							<div class="input-group">
								<input class="form-control" type="text" name="fname" required="true" />
							</div>
						</div>
						</div>
						<div class="col-sm-6">
						<div class="form-group">
							<label><b> Last Name: <span class="required">*</span></b></label>
							<div class="input-group">
								<input type="text" class="form-control" name="lname" required="true" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label><b>Email Address: <span class="required">*</span></b> </label>
							<div class="input-group">
								<input class="form-control" type="email" name="email" required="true" />
							</div>
						</div>
					</div>
				</div>
				<?php if(!empty($sid)) { ?></div><?php } ?>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="password" ><b>Password: <span class="required">*</span></b> </label>
							<div class="input-group">
								<input class="form-control" placeholder="Enter your password" type="password" name="password" id="password" required="true" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="passwordagain" ><b>Confirm Password: <span class="required">*</span> </b></label>
							<div class="input-group">
								<input class="form-control" placeholder="Enter your password again" type="password" name="passwordagain" id="passwordagain" required="true" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sponsorid" ><b>Sponsor Id: <span class="required">*</span></b> </label>
							<div class="input-group">
								<input class="form-control" type="text" name="sponsorid" id="sponsorid" required="true" onBlur="usrplacement(this.value);" value="<?php echo $sid; ?>" />
							</div>
							<span style="color:#999999"><b> Ex : <?echo $Random['user_profileid'];?> </b></span><br>
							<strong id="sponsorNamePlace" style="color: #cc0326"></strong>
							<div id="err" style="margin-bottom:16px; color: red; padding: 0 5px;"></div>
						</div>
					</div>
					<input type="hidden" class="form-control" name="sponsorname" id="sponsorname" required="true" readonly="true" />
				</div>
				<input type="hidden" class="form-control" name="placementid" required="true"/>
				<input type="hidden" class="form-control" name="pancardnum" required="true"/>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Policy Number: <span class="required">*</span></b> </label>
							<div class="input-group">
								<input class="form-control" type="text" name="policy" required="true" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label> <b>Amount:</b> <span class="required">*</span></b> </label><br />
							<div class="input-group">
								<input class="form-control" type="number" name="ammount" required="true" />
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="form-group">
				   <label for="password" ><b>Security Code: <span class="required">*</span> </b></label>
					<div class="input-group">
					   <div class="g-recaptcha" data-sitekey="<?php echo $captchasitekey;?>"></div>
					</div>
				</div>
				<div class="form-group">
				<input type="checkbox" value="option1" required="required" style="width:18px;"><a href="privacy.php" target="_blank">I read and agree Privacy Policy</a>
				</div>
                  

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block" type="submit" name="registerone">Register</button>
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
<?php if(!empty($sid)) { ?>
   <script>
   $(document).ready(function() {
		var sid="<?php echo $sid; ?>";
		usrplacement(sid);
   });
   </script>
   <?php } ?>
<script>
<?php if(!empty($sid) && ($leg_selection == "manual")) {?>
$(document).ready(function() {
	$.ajax({
		type: 'POST',
		url: "admin/getposition.php",
		data: {spnsrid:<?php echo $sid;?>},
		dataType: "text",
		success: function(result) {
		 var trimmedResponse = $.trim(result)
			if(trimmedResponse=="1") {
				//show right
				$('#lrid').addClass('hidden');
				$('#lrid').addClass('hidden');
				$('#rid').removeClass('hidden');
				
			}
			else if(trimmedResponse=="2") {
				//show left
				$('#lid').removeClass('hidden');
				$('#lrid').addClass('hidden');
				document.getElementById("lid").style.display='block';
				document.getElementById("rid").style.display='none';
				document.getElementById("lrid").style.display='none';
			}
			else if(trimmedResponse=="3") {
				//show both left & right
				$('#lid').addClass('hidden');
				$('#rid').addClass('hidden');
				$('#lrid').removeClass('hidden');
				document.getElementById("lid").style.display='none';
				document.getElementById("rid").style.display='none';
				document.getElementById("lrid").style.display='block';
				$('#lrid').css('margin-top','17px');
			}
		}
	});
});
<?php } ?>

	function usrplacement(spnsrid) {
		if(spnsrid!="") {
			document.getElementById("err").innerHTML='<img src="images/ajax_loading.gif"/>';
			$.ajax({
				type: 'POST',
				url: "getplacement.php",
				data: {spnsrid:spnsrid},
				dataType: "text",
				success: function(result) {
					var result=JSON.parse(result);
					if(result=="") {
						document.getElementById("err").innerHTML='Invalid Sponsor ID';
						document.getElementById("sponsorid").value='';
					}
					else {
						document.getElementById("err").innerHTML='';
						document.getElementById("sponsorname").value=result.name;
						document.getElementById("sponsorNamePlace").innerHTML= 'Name: '+result.name;
						document.getElementById("placementid").value=result.placement;
					}
				}
			});
			
			<?php if($leg_selection == "manual") {?>
			$.ajax({
				type: 'POST',
				url: "admin/getposition.php",
				data: {spnsrid:spnsrid},
				dataType: "text",
				success: function(result) {
				 var trimmedResponse = $.trim(result)
					if(trimmedResponse=="1") {
						//show right
						$('#lrid').addClass('hidden');
						$('#lrid').addClass('hidden');
						$('#rid').removeClass('hidden');
						
					}
					else if(trimmedResponse=="2") {
						//show left
						$('#lid').removeClass('hidden');
						$('#lrid').addClass('hidden');
						document.getElementById("lid").style.display='block';
						document.getElementById("rid").style.display='none';
						document.getElementById("lrid").style.display='none';
					}
					else if(trimmedResponse=="3") {
						//show both left & right
						$('#lid').addClass('hidden');
						$('#rid').addClass('hidden');
						$('#lrid').removeClass('hidden');
						document.getElementById("lid").style.display='none';
						document.getElementById("rid").style.display='none';
						document.getElementById("lrid").style.display='block';
						$('#lrid').css('margin-top','17px');
					}
				}
			});
			<?php } ?>
		}
	}
      
	function formvalidation() {
		var pass = document.getElementById("password").value;
		var pass1 = document.getElementById("passwordagain").value;
		if(pass!='') {
			if(pass.length<6) {
				alert("Pleace enter password above 6 letters");
				document.getElementById("password").focus();
				return false;
			}
		}

		if(pass1!='') {
			if(pass!=pass1) {
				alert("Password and confirm password Must be same");
				//document.getElementById("password").value='';
				//document.getElementById("passwordagain").value='';
				document.getElementById("password").focus();
				return false;
			}
		}
	}
	
   </script>
   <script>
   function pancheck(){
		var panval = $('#pancardnum').val();
		if(panval!=""){
			var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
			if(regpan.test(panval)){
			}else{
				alert('Invalid Pancard Number');
			}
		}
	}
   </script>

<?php include "includes-new/footer.php" ?>