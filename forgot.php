<?php include "includes-new/header.php"; 
if((isset($_SESSION['profileid'])) && (isset($_SESSION['userid'])))
{
header("location:profile.php");
echo "<script>window.location='profile.php'</script>";
}
if(isset($_REQUEST['forgot']))
{
$profileid=addslashes($_REQUEST['profilemail']);
$lsql="select * from mlm_register where user_email='$profileid'";
$lcount=$db->numrows($lsql);

if($lcount>=1){
$lfetch=$db->singlerec($lsql);
$password=$lfetch['user_password'];
$prof_id=$lfetch['user_profileid'];
$prof_email = $lfetch['user_email'];

$subject="Login Details | Trust-max";
$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #D64B14; width:550px;'>
		<tr bgcolor='#D64B14' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login Details for ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Profile ID : $prof_id</td>
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
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#D64B14;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>"; 

$to=$prof_email;
$res = $com_obj->commonMaildl($to,$subject,$msg);
echo $to .' <br><br><br>';
echo $subject .' <br><br><br><br>';
echo $msg .' <br>';
die();
 
	echo "<script>location.href='forgot.php?succ'</script>";
	}
	else
	{
		echo "<script>location.href='forgot.php?err'</script>";
	}
}
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
			<?php if(isset($_REQUEST['err'])){ ?>
			<span style="color:#FF0000;"><b>Account Doesn't Exists, Please enter valid E-mail / Profile id.</b></span><br>
			<?php }else if(isset($_REQUEST['succ'])){ ?>
			<span style="color:#00CC00;"><b>Password sent to your E-mail, Please check it.</b></span><br>
			<?php }else{?>
			<p><b>If you need any help please contact us via <a href="contact.php" style="color:#007bff;">ticket system</a> in your dashboard.</b></p>
			<?php }?>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link bg-transparent active" href="#forgot" data-toggle="tab" role="tab" aria-selected="true">
                        <span>Forgot Password</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" role="tabpanel" id="forgot">
                  <form action="#" method="post" >
                        
    <div class="form-group">
        
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16">
    <g transform="translate(0)">
        <path d="M23.983,101.792a1.3,1.3,0,0,0-1.229-1.347h0l-21.525.032a1.169,1.169,0,0,0-.869.4,1.41,1.41,0,0,0-.359.954L.017,115.1a1.408,1.408,0,0,0,.361.953,1.169,1.169,0,0,0,.868.394h0l21.525-.032A1.3,1.3,0,0,0,24,115.062Zm-2.58,0L12,108.967,2.58,101.824Zm-5.427,8.525,5.577,4.745-19.124.029,5.611-4.774a.719.719,0,0,0,.109-.946.579.579,0,0,0-.862-.12L1.245,114.4,1.23,102.44l10.422,7.9a.57.57,0,0,0,.7,0l10.4-7.934.016,11.986-6.04-5.139a.579.579,0,0,0-.862.12A.719.719,0,0,0,15.977,110.321Z" transform="translate(0 -100.445)"></path>
    </g>
</svg>
                </span>
            </div>
            
    <input class="form-control" placeholder="Enter your E-mail" name="profilemail" id="inputEmail" required >

        </div>
    </div>

                        
    

                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" name="forgot" id="forgot">Submit</button>
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <a href="login.php">Sign in your account?</a>
                            </div>
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


<?php include "includes-new/footer.php" ?>