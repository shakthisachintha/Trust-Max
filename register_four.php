<?php 
include "includes-new/header.php";


if(isset($_REQUEST['id']) && $_REQUEST['id']!='') 
{
	$profileid=$_REQUEST['id'];
} 
else 
{
	echo "<script>location.href='index.php';</script>";
	header("Location:index.php");
	exit;
}

?>
<!-- Breadcrumb -->
       
<div class="forny-container section-padding-sm">
        
    <div class="container forny-inner">
        
    <div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
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
                        <span>Step 4</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
			
			<h4>Choose Your Registration Type:</h4>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if($epin_status == "enabled") {?>
				<input type="radio" name="register_type" id="tokenSys" value="epin_type" style="width:18px;"/><b>Epin</b>
				&nbsp;&nbsp;
				<?php } ?>
				<input type="radio" name="register_type" id="memPack" value="mpack_type" style="width:18px;"/><b> Member Pack</b>
			
			<span id="mempackId" style="display:none;">
			<div class="log-title">
			</br>
				<h5><strong>Membership Plan: </strong></h5>
				<hr/>In the online Payment, You will be redirected to instamojo payment gateway.<br><br>
			</div>
			<?php
			$memshp=$db->get_all("select * from mlm_membership where status='1'");
			foreach($memshp as $memInfo):
			?>
			<form action="registerfunc.php" method="post">
			<div class="col-sm-4">
				<div class="login-text new-customer">
					<div class="regpage">
					<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<div class="mamber" style="color:#6b9811;"><b><?php echo $memInfo['membership_name']; ?></b></div>
					<div class="custom-input">
						<ul class="planmem">
						    <li><span style="font-size:16px;">Amount :<b><span class="texcol" > <?php echo $memInfo['act_amount']." ".$sitecurrency; ?></b></span></span></li>
							<li><span style="font-size:16px;">Referal Limit :<span class="texcol" style="font-size:16px;">  <b>Unlimited</b></span></span></li>
							
							<li><span style="font-size:16px;">Valid For :<span class="texcol" style="font-size:16px;"><b> <?php echo $memInfo['days']." days"; ?></b></span></span></li>
						</ul>
						<div class="submit-text coupon" style="text-align: center;margin-top: 20px;">
							
							<input type="hidden" name="mem" value="<?php echo base64_encode($memInfo['id']); ?>">
							<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
							<div class="row">
							
							   <div class="col-sm-6">
								<input class="btn btn-primary" type="submit" name="registrationfour" value="ONLINE">
							   </div>
							   <div class="col-sm-6">
								  <input class="btn btn-primary" type="submit" name="registrationfour" value="OFFLINE">
							   </div>
							</div>			
							
						</div>
					</div>
					</div>
				  </div>
				</div>
				</div>
			</div>
			</form>
			
			
			<?php endforeach; ?>
			</span>
			
			<span id="tokensysId" style="display:none;">
			<br/>
			<form action="registerfunc.php" method="post">
			<input type="hidden" name="reg_type" id="epintypeId" />
			<input type="hidden" name="profileid" value="<?php echo $profileid; ?>">
			<div class="log-title">
				<h5><strong>Token System: </strong></h5><hr/> 
			</div>
			<div class="col-sm-4">
				<input id="epinId" class="form-control"  style=" margin-bottom:16px;" type="text" placeholder="Enter your Purchased Epin" name="epin" />
				<span id="errId" style="color:red;"></span>
				<br />
				<input type="submit" name="registrationfour" class="btn btn-primary" />
			</div>
			</form>
			</span>
            
                </div>
            </div>
        </div>
		 </div>
		<div class="col-sm-3"></div>
		 </div>
    </div>

    </div>

<?php include "includes-new/footer.php"; if(isset($_REQUEST['inval'])) {?>
	<script>
	$("#mempackId").css('display', 'none');
	$("#tokensysId").css('display', 'block');
	$("#errId").html('Invalid Epin');
	$("#tokenSys").prop("checked",true);
	$("#epinId").prop("required",true);
	</script>
<?}
?>
<script>
$("#memPack").click(function(){
	$("#tokensysId").css('display', 'none');
	$("#mempackId").css('display', 'block');
	$("#epinId").prop("required",false);
	$("#epintypeId").val("");
});
$("#tokenSys").click(function(){
	$("#mempackId").css('display', 'none');
	$("#tokensysId").css('display', 'block');
	$("#epinId").prop("required",true);
	$("#epintypeId").val("epin_type");
});
</script>