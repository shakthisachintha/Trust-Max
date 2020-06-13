<?php include "includes-new/header.php";

$err = isset($_REQUEST['err'])?$_REQUEST['err']:'';
$contact_content = $db->extract_single("select contact_content from mlm_cms where cms_id='1'");
	
if(isset($_REQUEST['contact']))
{
$name=addslashes($_REQUEST['name']);
$email=addslashes($_REQUEST['email']);
$mobile=addslashes($_REQUEST['mobile']);
$message=addslashes($_REQUEST['message']);
$sub=addslashes($_REQUEST['subject']);
$ip=$_SERVER['REMOTE_ADDR'];

if( ($_SESSION['c1']+$_SESSION['c2']) == $_POST['captcha'] ) {
$inse=$db->insertrec("insert into mlm_feedback set fb_fromemail='$email',fb_toemail='$website_admin',fb_subject='$sub',fb_message='$message',fb_date=NOW(),fb_name='$name',fb_mobile='$mobile',fb_ip='$ip' ");


$subject="Enquiry Details from ".$website_name;

	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Enquiry Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $name, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your enquiry has been sent successfully, concern person is contact you soon.</td>
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
$com_obj->commonMail($to,$subject,$msg);

$subject1=$sub;
$msg1="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Enquiry Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Name : $name </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email : $email</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Subject : $sub</td>
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

if($mail_sts == "scs")
{
echo "<script>alert('Sent successfully!');</script>";
}
else
{
echo "<script>alert('Opps! Mail server not wroking! Try again sometime later!');</script>";
}
unset($_SESSION['security_code']);
unset($_SESSION['capname']);
unset($_SESSION['capemail']);
unset($_SESSION['capmobile']);
unset($_SESSION['capmessage']);
unset($_SESSION['capsubject']);
}
else
{
$_SESSION['capname']=$_REQUEST['name'];
$_SESSION['capemail']=$_REQUEST['email'];
$_SESSION['capmobile']=$_REQUEST['mobile'];
$_SESSION['capmessage']=$_REQUEST['message'];
$_SESSION['capsubject']=$_REQUEST['subject'];
header("location:contact.php?err=captcha");
echo "<script>window.location='contact.php?captcha';</script>";

}

}

 ?>

<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>Contact Us</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
		
<div id="main-content" class="site-main clearfix">
<div id="content-wrap">
	<div id="site-content" class="site-content clearfix">
		<div id="inner-content" class="inner-content-wrap">
			<div class="page-content">
				<div class="row-contact padbt-35">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								

								<div class="cbr-headings text-center">
								   <h2 class="heading">CONTACT INFORMATION</h2>
								</div><!-- .cbr-headings -->

								
							</div><!-- .col-md-12 -->

							<div class="col-md-4">
								<div class="cbr-quick-contact style-1">
									<div class="quick-contact-heading">
										<span class="icon icon-md-mail-unread"></span><h2 class="heading">Email us</h2>
									</div>

									<ul class="contact-info">
										<li>
											<div class="text-wrap">
												<h3 class="heading"><i class="zmdi zmdi-email"></i>Company:</h3>
												<p class="desc"><?=$website_admin;?></p>
											</div>
										</li>
									   
									</ul>
								</div><!-- .cbr-quick-contact -->
							</div><!-- .col-md-4 -->

							<div class="col-md-4">
								<div class="cbr-quick-contact style-1">
									<div class="quick-contact-heading">
										<span class="icon icon-md-call"></span><h2 class="heading">Phone number</h2>
									</div>

									<ul class="contact-info">
										<li>
											<div class="text-wrap">
												<h3 class="heading"><i class="zmdi zmdi-phone"></i>Company:</h3>
												<p class="desc"><?=$website_phone;?></p>
											</div>
										</li>
										
									</ul>
								</div><!-- .cbr-quick-contact -->
							</div><!-- .col-md-4 -->

							<div class="col-md-4">
								<div class="cbr-quick-contact style-1">
									<div class="quick-contact-heading">
										<span class="icon icon-md-chatboxes"></span><h2 class="heading">Chat with us</h2>
									</div>

									<ul class="contact-info">
										<li>
											<div class="text-wrap">
												<h3 class="heading"><i class="zmdi zmdi-skype"></i>Skype :</h3>
												<p class="desc"><?=$website_skype;?></p>
											</div>
										</li>
										
									</ul>
								</div><!-- .cbr-quick-contact -->
							</div><!-- .col-md-4 -->

						   
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .row-contact -->

				<div class="row-get-in-touch">
					<div class="container">
						<div class="row">
							<div class="col-md-6 padding-right-0">
								<div class="cbr-content-box bg-light clearfix"  >
									<div class="inner" style="padding: 42px 50px 40px;">
										<div class="cbr-headings">
											<h3 class="heading">GET IN TOUCH</h3>
										</div><!-- .cbr-headings -->

										<div class="cbr-contact-form">
			  <form action="contact.php" method="post" class="contact-form wpcf7-form" >
												
											   <div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="input-box">
								<input type="text" name="name" placeholder="Enter Your Name" value="<?php if(isset($_SESSION['capname'])) { echo $_SESSION['capname']; } ?>" required />
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="input-box">
								<input type="text" name="mobile" placeholder="Enter Your Contact Number" value="<?php if(isset($_SESSION['capmobile'])) { echo $_SESSION['capmobile']; } ?>" required />
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="input-box">
								<input type="text" name="email" placeholder="Enter Your E-Mail Address" value="<?php if(isset($_SESSION['capemail'])) { echo $_SESSION['capemail']; } ?>" required />
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="input-box">
								<input type="text" name="subject" placeholder="Enter Subject" value="<?php if(isset($_SESSION['capsubject'])) { echo $_SESSION['capsubject']; } ?>" required />
							</div>
						</div>
						<div class="col-lg-12">
							<div class="input-box">
								<textarea rows="4" placeholder="Message" name="message" required><?php if(isset($_SESSION['capmessage'])) { echo $_SESSION['capmessage']; } ?></textarea>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="input-box">
								<input type="text" name="captcha" style="width:50%;" placeholder="<?php echo $_SESSION['c1']=rand(1,20); echo " + "; echo $_SESSION['c2']=rand(1,20);?> = ?" required/><span style="color:red;float:right;padding-top:10px;display:<?=($err=="captcha")?"bloack":"none";?>">Invalid captch! Try agin!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<br>
							</div>
						</div>
					</div>
								  <div class="contact-submit-btn text-center">
						<button type="submit" name="contact" class="submit-btn default-btn">SUBMIT NOW</button>
						<p class="form-messege"></p>
					</div>             
												
											   
											   
											</form>
										</div><!-- .cbr-contact-form -->
									</div><!-- .inner -->
								</div><!-- .cbr-content-box -->

							   
							</div><!-- .col-md-6 -->

							<div class="col-md-6 padding-left-0">
								<div class="find-us">
									<div class="thumb">
										<div class="half-img">
										   <img src="assets/images/other/contact-img.jpg" alt="Image">
										</div>
										<?php 
							$address=$db->singlerec("select * from mlm_address where addr_id='1'");
						?>
										<div class="text-wrap">
											<div class="address">
												<h3 class="heading">Address:</h3>
												<p class="desc"><?php echo ucwords($address['addr_area']).", ".ucwords($address['addr_city']).", ".ucwords($address['addr_state']).", ".ucwords($address['addr_country']);?></p>
											</div>
										   
										</div>
									</div><!-- .thumb -->
								</div><!-- .find-us -->
							</div><!-- .col-md-6 -->

						   
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .row-get-in-touch -->
			</div><!-- .page-content -->
		</div><!-- "#inner-content" -->
	</div><!-- #site-content -->
</div><!-- #content-wrap -->
</div>			

	 </main>
		<!--// Page Conttent -->

		<!-- Footer -->


<?php include "includes-new/footer.php" ?>