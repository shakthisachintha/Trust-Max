<?php
$user_profileid = $userdetail['user_profileid'];

$user=$db->singlerec("select * from mlm_register where user_profileid='$user_profileid' and user_status='0'");
$ufname=ucfirst($user['user_fname']);
$ulname=$user['user_lname'];
$email=$user['user_email'];

if($user_profileid=="")
{
	@session_destroy();
	header("location:login.php");
	echo "<script>location.href='login.php';</script>";
	exit;
}
$bal = $com_obj->totalBal($userdetail['user_profileid']);
$with = $com_obj->withdrawBal($userdetail['user_profileid']);

$reward=$com_obj->completedPair($_SESSION['profileid']);
$reimg=$db->singlerec("select * from mlm_reward where pair_complete like '$reward' and status='1'");
$re_img=$reimg['reward_img'];
$paircount=$reimg['pair_complete'];
if($reward==$paircount){
$subject="Reward Complete Details from ".$website_name;

	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Reward Complete Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $ufname, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>congratulation,You have successfully completed $reward pair's.</td>
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
$cmail=$com_obj->commonMail($to,$subject,$msg);
}

$sponid=$userdetail['user_sponserid'];
$detail=$db->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'");
if(isset($_REQUEST['uploadpay']))
{
	$imag=$_FILES['payslip']['tmp_name'];
	$imag=isset($imag)?$imag:'';
	$name2=rand(11111,99999).uniqid();
	$img_upl=$com_obj->upload_image("payslip",$name2,300,300,"uploads/payslip/","new");
	if($img_upl) 
		{
			$main_img=$com_obj->img_Name;					
			$res=$db->insertrec("update mlm_mempayments set user_payslip='$main_img' where profileid='$user_profileid' ");
			header("location:dashboard.php?up");
	        echo "<script>location.href='dashboard.php?up';</script>";
		}else{
			echo $imgerr=$com_obj->img_Err;
		}
}
?>
<div class="row">
   <div class="col-sm-12 profile-info">
      <div class="row">
         <div class="col-sm-3 text-center">
            <img src="<?php echo $profileimages;?>" class="img-responsive" width="128" height="128" />
			<?php if(!empty($re_img)){ ?>
				<img src="./uploads/products/logo/mid/<?php echo $re_img; ?>" width="45" class="tt" />
		<?php	}else{
				
			}
			?>
			<div style="margin-bottom:10px;margin-top:15px;">
			<? if($user['user_paymentstaus']==0) {  ?>
			 PAYMENT STATUS:<? echo "PENDING"; ?>
			 <form action="dashboard.php" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
			 <div class="row">
			  <div class="col-sm-8">
				  <input class="form-control" type="file" name="payslip" id="payslip">
				</div>  
				<div class="col-sm-4">
				   <button style="padding: 6px 13px;" type="submit" name="uploadpay" class="greenbtn">SUBMIT</button>
				</div>
				</div>
			</form>
			<? } else { ?>
			PAYMENT STATUS : <span style="color:green;"><? echo "SUCCESS"; ?></span>
			<? } ?>
			</div>
			
         </div>
         <div class="col-sm-9">
            <blockquote style="height: 155px; margin: 0;">
               <div class="row">
			   <div class="col-sm-12">
			   <h4 class="profle_head">
                 
                  <?php echo ucfirst($userdetail['user_fname']); ?>
                 
                  <span style="float:right; display:block;">
                  <?php echo $userdetail['user_date']; ?>
                  </span>
               </h4>
			   </div>
			   
			   <!--<div class="col-xs-3">
					<a href="register.php?sid=<?php echo $userdetail['user_profileid']; ?>" class="btn btn-block" id="gradient" style="color:#FFF;font-size:16px;font-weight:bold;margin-top:12px;">Add New User</a>
			   </div>-->
			   </div>
			   <div class="row"></div>
			   <div class="table-responsive" style="margin-top:30px;">
               <table class="table" cellpadding="7" cellspacing="0" border="0" width="100%">
                  <tr>
                     <td width="20%">
                        <strong>Name</strong>
                     </td>
                     <td width="7" align="center">:</td>
                     <td width="28%">
                        <?php echo ucfirst($userdetail['user_fname']); ?>
                     </td>
                     <td width="20%">
                        <strong>Email id</strong>
                     </td>
                     <td width="7" align="center">:</td>
                     <td width="28%">
                        <?php echo $userdetail['user_email']; ?>
                     </td>
                  </tr>
                  <tr>
                     <td width="20%">
                        <strong>Profile Id</strong>
                     </td>
                     <td width="7" align="center">:</td>
                     <td width="28%">
                        <?php echo $userdetail['user_profileid']; ?>
                     </td>
                     <td width="20%">
                        <strong>Sponsor Name</strong>
                     </td>
                     <td width="7" align="center">:</td>
                     <td width="28%">
                        <?php echo $detail['user_fname'].' '.$detail['user_lname']; ?>
                     </td>
                  </tr>
               </table>
			   </div>
<div class="clearfix"></div>              
			 
            </blockquote>
         </div>
		 
		 <div class="col-sm-12">
		 
		       <hr style="border: 1px solid #f5f5f5;" />
               <div class="clearfix"></div>
			   <div class="row" style="text-align:center;">
                  <div style="padding:0; margin: 0; width:100%;">
				  <div style="" class="col-sm-3 col-xs-12">
                        <label class="cb-enable selected">
							<span> Rank </span>
                        </label>
                        <label class="cb-disable">
							<span style="min-width:50px;"><?php echo $userdetail['user_rank']; ?></span>
                        </label>
                     </div>
                     <div style="" class="col-sm-3 col-xs-12">
                        <label class="cb-enable selected">
							<span> Total Balance </span>
                        </label>
                        <label class="cb-disable">
							<span style="min-width:50px;"><?php echo $com_obj->totalBal($userdetail['user_profileid'])." ".$sitecurrency; ?></span>
                        </label>
                     </div>
                     <!--<li><span style="float:left; margin:0 10px;" >&nbsp;</span></li>-->
                      <div style="" class="col-sm-3 col-xs-12">
                        <label class="cb-enable selected">
                        <span>Withdraw Amount </span>
                        </label>
                        <label class="cb-disable">
                        <span style="min-width:50px;"><?php  echo $com_obj->withdrawBal($userdetail['user_profileid'])." ".$sitecurrency ; ?></span>
                        </label>
                     </div>
					 <!--<li><span style="float:left; margin:0 10px;">&nbsp;</span></li>-->
						 <div style="" class="col-sm-3 col-xs-12">
                        <label class="cb-enable selected">
                        <span>Available Balance </span>
                        </label>
                        <label class="cb-disable">
                        <span style="min-width:50px;">
						<?php  echo $com_obj->availBal($bal,$with)." ".$sitecurrency; ?></span>
                        </label>
						</div>
                  </div>
               </div>
		 
		 </div>
		 
		 
      </div>
   </div>
	<?php
	$ismemExpired=$ext_obj->ismemExpired($_SESSION['profileid']);
	$renewIn=$ext_obj->renewIn();
	if($renewIn<=10) {
	?>
   <div class="col-sm-12">
	<div class="row">
	<div  class="well" style="background:#FFF; margin-top:15px;">
		<div class="row">
			<marquee class="awesome">You need to repurchase package within <?php echo $renewIn." days"; ?> to continue using our service.</marquee>
		</div>
	</div>
	</div>
   </div>
   <?php } ?>
   
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<style>

.awesome {
      
        
      width:100%;
      
      margin: 0 auto;
      text-align: center;
      
      color:#313131;
      font-size:20px;
      font-weight: bold;
      position: relative;
      -webkit-animation:colorchange 2s infinite alternate;
      
      
    }

    @-webkit-keyframes colorchange {
      0% {
        
        color: blue;
      }
      
      10% {
        
        color: #8e44ad;
      }
      
      20% {
        
        color: #1abc9c;
      }
      
      30% {
        
        color: #d35400;
      }
      
      40% {
        
        color: blue;
      }
      
      50% {
        
        color: #34495e;
      }
      
      60% {
        
        color: blue;
      }
      
      70% {
        
        color: #2980b9;
      }
      80% {
     
        color: #f1c40f;
      }
      
      90% {
     
        color: #2980b9;
      }
      
      100% {
        
        color: pink;
      }
    }
</style>


<script>

var colors = new Array(
  [62,35,255],
  [60,255,60],
  [255,35,98],
  [45,175,230],
  [255,0,255],
  [255,128,0]);

var step = 0;
//color table indices for: 
// current color left
// next color left
// current color right
// next color right
var colorIndices = [0,1,2,3];

//transition speed
var gradientSpeed = 0.5;

function updateGradient()
{
  
  if ( $===undefined ) return;
  
var c0_0 = colors[colorIndices[0]];
var c0_1 = colors[colorIndices[1]];
var c1_0 = colors[colorIndices[2]];
var c1_1 = colors[colorIndices[3]];

var istep = 1 - step;
var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
var color1 = "rgb("+r1+","+g1+","+b1+")";

var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
var color2 = "rgb("+r2+","+g2+","+b2+")";

 $('#gradient').css({
   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
  
  step += gradientSpeed;
  if ( step >= 1 )
  {
    step %= 1;
    colorIndices[0] = colorIndices[1];
    colorIndices[2] = colorIndices[3];
    
    //pick two new target color indices
    //do not pick the same as the current one
    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    
  }
}

setInterval(updateGradient,10);
</script>