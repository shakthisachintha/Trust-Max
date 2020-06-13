<?php include "includes-new/header.php";

$profile_id=isset($_SESSION['profileid'])?$_SESSION['profileid']:'';
$pid=isset($_REQUEST['id'])?$_REQUEST['id']:0;
$pid=replace($pid);
$pinfo=$db->singlerec("select * from mlm_products where pro_id='$pid' and pro_status='0'");	
$img="uploads/products/logo/original/".$pinfo['pro_logo'];

if(empty($pinfo)){
	echo "<script>location.href='$website_url';</script>";
	header("location:$website_url");
	exit;
}
$userdetail['user_profileid']=isset($userdetail['user_profileid'])?$userdetail['user_profileid']:'';
$userdetail['user_fname']=isset($userdetail['user_fname'])?$userdetail['user_fname']:'';
$userdetail['user_phone']=isset($userdetail['user_phone'])?$userdetail['user_phone']:'';
$userdetail['user_email']=isset($userdetail['user_email'])?$userdetail['user_email']:'';


if(isset($e_wallet) && (isset($_SESSION['userid']))) {
	$profileid = $_SESSION['profileid'];
	$userid=$_SESSION['userid'];
	$bal = $com_obj->totalBal($profileid);
	$with = $com_obj->withdrawBal($profileid);
	$avail_bal = $com_obj->availBal($bal,$with);
	
	$purchasecount=$db->Extract_single("select count(pay_id) from mlm_purchase where pay_user='$profileid' and pay_product='$pid'");	
	$stock = stock_check($pid);
	if($_REQUEST['qty'] > $stock)
	{
		echo "<script>alert('Only $stock products available');</script>";
		echo "<script>location.href='product-detail.php?id=$pid';</script>";
		header("Location: product-detail.php?id=$pid");
		exit;
	}
	if($purchasecount > 0){
		$cost=$pinfo['prod_rpv'];
		$re_purchase_sts = 1;
		$repur=",is_repurchase='1'";
	}
	else{
		$cost=$pinfo['pro_pv'];
		$re_purchase_sts = 0;
		$repur=",is_repurchase='0'";
	}
	
	$randkey=uniqid();
	$curdate=date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];
	$qty=addslashes($_REQUEST['qty']);
	
	if($cost > $avail_bal) {
		echo "<script>alert('Your Account Balance is insufficient to purchase this product');</script>";
	}
	else {
		$amt = $qty * $cost;
		
		$set="pay_user='$userdetail[user_id]'";
		$set.=",randomkey='$randkey'";
		$set.=",pay_userid='$userdetail[user_profileid]'";
		$set.=",pay_email='$userdetail[user_email]'";
		$set.=",pay_phone='$userdetail[user_phone]'";
		$set.=",pay_product='$pid'";
		$set.=",pay_amount='$amt'";
		$set.=",pay_qty='$qty'";
		$set.=",pay_payment='1'";
		$set.=",pay_type='e-wallet'";
		$set.=",pay_date='$curdate'";
		$set.=",pay_ip='$ip'";
		
		$resultid=$db->insertid("insert into mlm_purchase set $set$repur");
		
		$reducestock=$db->insertrec("update mlm_products set pro_stock= pro_stock - '$qty' where pro_id='$pid'");
		
		$set1 = "req_profileid='$profileid'";
		$set1 .= ",req_id='$userid'";
		$set1 .= ",req_cvamount='$cost'";
		$set1 .= ",reason='product-purchase'";
		$set1 .= ",req_rpstatus='1'";
		$set1 .= ",req_ip='$ip'";
		$db->insertrec("insert into mlm_withdrawrequsets set $set1");
		
		$usr = $userdetail['user_profileid'];
		productbonus($pid,$usr,$qty,$re_purchase_sts);
		
		echo "<script>location.href='profile.php?prdsucc';</script>";
		header("Location: profile.php?prdsucc");
		exit;
	}
}

include "config/instamojo.php";
//define(API_KEY, $API_KEY);
//define(AUTH_TOKEN, $AUTH_TOKEN);
$Instamojo=new Instamojo($API_KEY, $AUTH_TOKEN, $AUTH_URL);
if(isset($buyPrd) && (isset($_SESSION['userid']))) {
	$purchasecount=$db->Extract_single("select count(pay_id) from mlm_purchase where pay_user='$userdetail[user_id]' and pay_product='$pid'");	
	$stock=stock_check($pid);
	if($_REQUEST['qty'] > $stock)
	{
		echo "<script>alert('Only $stock products available');</script>";
		echo "<script>location.href='product-detail.php?id=$pid';</script>";
		header("Location: product-detail.php?id=$pid");
		exit;
	}
	if($purchasecount > 0){
		$cost=$pinfo['prod_rpv'];
		$repur=",is_repurchase='1'";
	}
	else{
		$cost=$pinfo['pro_pv'];
		$repur=",is_repurchase='0'";
	}
	
	$randkey=uniqid();
	$curdate=date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];
	$qty=addslashes($_REQUEST['qty']);
	$amt=$qty*$cost;
	
	try {
		$response=$Instamojo->paymentRequestCreate(array(
			"purpose" => "Purchase - $pinfo[pro_name]",
			"amount" => $amt,
			"send_email" => true,
			"email" => $userdetail['user_email'],
			"redirect_url" => $website_url."purchaseresp.php"
		));
		$set="pay_user='$userdetail[user_id]'";
		$set.=",randomkey='$randkey'";
		$set.=",pay_userid='$userdetail[user_profileid]'";
		$set.=",pay_email='$userdetail[user_email]'";
		$set.=",pay_phone='$userdetail[user_phone]'";
		$set.=",pay_product='$pid'";
		$set.=",pay_amount='$amt'";
		$set.=",pay_qty='$qty'";
		$set.=",pay_type='Instamojo'";
		$set.=",pay_date='$curdate'";
		$set.=",pay_ip='$ip'";
		$set.=",pay_txnid='$response[id]'";
		
		$resultid=$db->insertid("insert into mlm_purchase set $set$repur");
		echo "<script>location.href='$response[longurl]';</script>";
		header("Location: $response[longurl]");
		exit;
	}
	catch (Exception $e) {
		print('Error: ' . $e->getMessage());
	}
}


if(isset($_REQUEST['offline']) && (isset($_SESSION['userid']))) {
	$purchasecount=$db->Extract_single("select count(pay_id) from mlm_purchase where pay_user='$userdetail[user_id]' and pay_product='$pid'");	
	$stock=stock_check($pid);
	if($_REQUEST['qty'] > $stock)
	{
		echo "<script>alert('Only $stock products available');</script>";
		echo "<script>location.href='product-detail.php?id=$pid';</script>";
		header("Location: product-detail.php?id=$pid");
		exit;
	}
	if($purchasecount > 0){
		$cost=$pinfo['prod_rpv'];
		$repur=",is_repurchase='1'";
	}
	else{
		$cost=$pinfo['pro_pv'];
		$repur=",is_repurchase='0'";
	}
	
	$randkey=uniqid();
	$curdate=date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];
	$qty=addslashes($_REQUEST['qty']);
	$amt=$qty*$cost;
	
	
		$set="pay_user='$userdetail[user_id]'";
		$set.=",randomkey='$randkey'";
		$set.=",pay_userid='$userdetail[user_profileid]'";
		$set.=",pay_email='$userdetail[user_email]'";
		$set.=",pay_phone='$userdetail[user_phone]'";
		$set.=",pay_product='$pid'";
		$set.=",pay_amount='$amt'";
		$set.=",pay_qty='$qty'";
		$set.=",pay_type='offline'";
		$set.=",pay_date='$curdate'";
		$set.=",pay_ip='$ip'";
		//$set.=",pay_txnid='$response[id]'";
		//echo "insert into mlm_purchase set $set$repur";exit;
		$resultid=$db->insertid("insert into mlm_purchase set $set$repur");
		echo "<script>location.href='profile.php?sus';</script>";
		header("Location: profile.php?sus");
		exit;
	
}

$result=$db->singlerec("select id from mlm_reviews where profile_id='$userdetail[user_profileid]' and product_id='$pid' ");

//Reviews
if(isset($_REQUEST['review_submit'])){
	$re_message=addslashes($_REQUEST['re_message']);
	$star=$_REQUEST['star_value'];
	
	if($star==''){
		$star1=0;
	}else{
		$star1=$star;
	}
	//echo $star1;exit;
	$date = date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];;
	$set="profile_id='$userdetail[user_profileid]'";
	$set.=",product_id='$pid'";
	$set.=",message='$re_message'";
	$set.=",crcdt='$date'";
	$set.=",ip='$ip'";
	$set.=",status='1'";
	$set.=",stars='$star1'";
	

	if(empty($result['id'])) { 
	    $db->insertrec("insert into mlm_reviews set $set");
		echo "<script>location.href='product-detail.php?id=$pid&resus';</script>";
		header("Location: product-detail.php?id=$pid&resus");
		exit;
	}else{
		$db->insertrec("update mlm_reviews set $set where profile_id='$userdetail[user_profileid]' and product_id='$pid' ");
	    echo "<script>location.href='product-detail.php?id=$pid&reupd';</script>";
	    header("Location: product-detail.php?id=$pid&reupd");
	    exit;
	}
	
	
}

$result1=$db->singlerec("select id from mlm_wishlist where profile_id='$userdetail[user_profileid]' and product_id='$pid'");
//Wishlist Add
if(isset($_REQUEST['wishlist_add'])){
	$product_id=addslashes($_REQUEST['id']);
	//echo $star1;exit;
	$date = date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];;
	$set="profile_id='$userdetail[user_profileid]'";
	$set.=",product_id='$pid'";
	$set.=",crcdt='$date'";
	$set.=",reg_ip='$ip'";
	$set.=",status='1'";


	if(empty($result1['id'])) { 
	    $db->insertrec("insert into mlm_wishlist set $set");
		echo "<script>location.href='product-detail.php?id=$pid&resus';</script>";
		header("Location: product-detail.php?id=$pid&resus");
		exit;
	}else{
		$db->insertrec("update mlm_wishlist set $set where profile_id='$userdetail[user_profileid]' and product_id='$pid'");
	    echo "<script>location.href='product-detail.php?id=$pid&reupd';</script>";
	    header("Location: product-detail.php?id=$pid&reupd");
	    exit;
	}
		
}

//Wishlist Remove
if(isset($_REQUEST['wishlist_remove'])){
	$product_id=addslashes($_REQUEST['id']);
	//echo $star1;exit;
	$date = date("Y-m-d");
	$ip=$_SERVER['REMOTE_ADDR'];;
	$set="profile_id='$userdetail[user_profileid]'";
	$set.=",product_id='$pid'";
	$set.=",crcdt='$date'";
	$set.=",reg_ip='$ip'";
	$set.=",status='0'";
	
	

	if(empty($result1['id'])) { 
	    $db->insertrec("insert into mlm_wishlist set $set");
		echo "<script>location.href='product-detail.php?id=$pid&resus';</script>";
		header("Location: product-detail.php?id=$pid&resus");
		exit;
	}else{
		$db->insertrec("update mlm_wishlist set $set where profile_id='$userdetail[user_profileid]' and product_id='$pid'");
	    echo "<script>location.href='product-detail.php?id=$pid&reupd';</script>";
	    header("Location: product-detail.php?id=$pid&reupd");
	    exit;
	}
		
}

$reviewInfo=$db->singlerec("select * from mlm_reviews where profile_id='$profile_id' and product_id='$pid' and status='1'");

$reviewCount=$db->Extract_single("select count(id) from mlm_reviews where product_id='$pid' and status='1'");

if(isset($_REQUEST['wishlist'])){
	
	$product_id=addslashes($_REQUEST['id']);
	$status=addslashes($_REQUEST['status']);
	
	$result1=$db->Extract_Single("select id from mlm_wishlist where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
	
	if(empty($result1)) {
		
		$date = date("Y-m-d");
		$ip=$_SERVER['REMOTE_ADDR'];;
		$set="profile_id='$userdetail[user_profileid]'";
		$set.=",product_id='$product_id'";
		$set.=",crcdt='$date'";
		$set.=",reg_ip='$ip'";
		$set.=",status='1'";
		
	    $db->insertrec("insert into mlm_wishlist set $set");
		echo "<script>location.href='product-detail.php?id=$pid';</script>";
		header("Location: product-detail.php?id=$pid");
		exit;
	}else{
		if($status=='1'){
			
			$db->insertrec("update mlm_wishlist set status='0' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			//echo "product-detail.php?id=$pid";exit;
			echo "<script>location.href='product-detail.php?id=$pid';</script>";
			header("Location: product-detail.php?id=$pid");
			exit;
		}else if($status=='0'){
			//echo '2';exit;
			$db->insertrec("update mlm_wishlist set status='1' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			echo "<script>location.href='product-detail.php?id=$pid';</script>";
			header("Location: product-detail.php?id=$pid");
			exit;
		}
		
	}
		
}

?>
<style>

</style>
<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>Product Details</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Product Details</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
		
		 <div class="content-wrapper section-ptb section-padding-xs">
   <div class="container">
      <section>
         <div class="product-content-top single-product">
            <div class="row">
			
			              <div class="col-md-6">
                                <div class="product-details-large preview-pic" id="ProductPhoto">
                                    <?php if(!empty($img) && file_exists("$img")){ ?>
                                    <img id="ProductPhotoImg" class="product-zoom" data-image-id="" alt="" data-zoom-image="<?=$img;?>" src="<?=$img;?>" >
								    <?}else {?>
								    <img src="uploads/no_image.jpg" alt="blog   thumbnail" style="width:100px;height:89px;">
								    <? } ?>
          
                                </div>
                               
                            </div>
              <!--<div class="product-top-left col-sm-6">
                  <div class="product-top-left-inner">
                     <div class="preview ">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?=$img;?>" style="width: 540px;"/></div>
						  <div class="tab-pane" id="pic-2"><img src="<?=$img;?>" style="width: 540px;"/></div>
						  <div class="tab-pane" id="pic-3"><img src="<?=$img;?>" style="width: 540px;"/></div>
						  <div class="tab-pane" id="pic-4"><img src="<?=$img;?>" style="width: 540px;"/></div>
						  <div class="tab-pane" id="pic-5"><img src="<?=$img;?>" style="width: 540px;"/></div>
						</div>
						
						
					</div>
                  </div>
               </div>-->
               <div class="product-top-right col-sm-6">
                  <div class="product-top-right-inner">
                     <div class="summary entry-summary">
                        <h1 class="product_title entry-title"><?=$pinfo['pro_name']?></h1>
                        <div class="rating">
						  <? echo get_Rate2($pid); ?>
						 
						 <p class="review-link mt-2 dis-in" style="font-size:14px;">(<?=$reviewCount?> customer reviews)</p>
						
                          
                        </div>
						<p class="price"><span class="price" ><?=$sitecurrency.' '.$pinfo['pro_pv'];?></span> <span class="price-old"><?=$sitecurrency.' '.$pinfo['pro_cost'];?></span> 
						<h5>Repurchase Cost : <?=$pinfo['prod_rpv'].'  '.$sitecurrency; ?></h5>
						<? if(stock_check($pid) >0){ ?>
						<h5>Stock : <?=stock_check($pid);?></h5>
						<? } else { ?>
						<h6><font color="red">Out Of Stock</font></h6>
						<?php } ?>
						</p>
						
                        <div class="product-details__short-description">
                           <div class="pdp-about-details-txt pdp-about-details-equit"><?=$pinfo['pro_desc'];?></div>
                        </div>
						<!-- <form class="cart">
                           <div class="quantity">
                              <input type="text" class="input-text qty text" title="Qty" value="1">
                              <div class="quantity-nav"><a class="quantity-button quantity-up" href="">+</a><a class="quantity-button quantity-down" href="">-</a></div>
                           </div>
                           <a class="button single_add_to_cart_button" rel="nofollow" href="">Add to cart</a>
                           <div class="clearfix"></div>
                        </form>-->
                               <form action="" method="post" class="cart">
							   <div class="col-lg-3 dis-in">
                                        <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                          <span class="zmdi zmdi-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="qty" class="form-control input-number" value="1" min="1" max="100" style="font-size: 14px;">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <span class="zmdi zmdi-plus"></span>
                                        </button>
                                    </span>
                                </div>
                             </div>
                                
									
									<? 
									$ismemExpired=$ext_obj->ismemExpired($profile_id);
								if(stock_check($pid) >0){	?>
								<?php if (!isset($_SESSION['userid'])) { ?>
								<p style="" class="dis-in">
								<a class="btn btn-primary "  href="login.php" >Please Login to Buy Product </a> 
								</p>
								<?php }
									else if($ismemExpired) { ?>
									<p style="" class="dis-in">
									<a class="btn btn-primary " href="memberpackage.php" >upgrade membership</a> 
									</p>
									<?php }
									else { ?>
									<!--<input class="btn btn-info" type="submit" name="buyPrd" value="Buy Now" >-->
								   <a  data-toggle="collapse" href="#collapseExample"  aria-expanded="false" aria-controls="collapseExample"  class="button single_add_to_cart_button">Buy Now</a>
									<?php } }
									?>
							
							</li>
							
					</br>	</br>								
<div class="collapse" id="collapseExample" style="margin-top:10px;">
<div class="well">
<div class="row">

   <div class="col-sm-6">
	   <input onClick="return confirm('Are you sure to Proceed?');" type="submit" name="e_wallet"  class="btn btn-success greenbtn" value="E-Wallet"/>
   </div>

<div class="col-sm-6">
	<input type="submit" class="btn btn-success greenbtn" name="buyPrd" value="Online Payment"/>
</div>
<br /><br /><br /><br />
<div class="col-sm-12">
<h4 style="padding-bottom:7px;">Offline Payment</h4>
<?  $bank_detail=$db->singlerec("select * from mlm_bank where id='1' ")?>

  <div class="form-group">
	<label for="inputEmail3" class="col-sm-12 control-label">Account Name</label>
	<div class="col-sm-12">
	  <input type="text" value="<? echo $bank_detail['acc_name']?>" readonly class="form-control" placeholder="Email">
	</div>
  </div>
  <div class="form-group">
	<label for="inputEmail3" class="col-sm-12 control-label">Account Number</label>
	<div class="col-sm-12">
	  <input type="text" readonly value="<? echo $bank_detail['acc_no']?>"  class="form-control" placeholder="Email">
	</div>
  </div>
   <div class="clearfix"></div>
  <div class="form-group">
	<label for="inputEmail3" class="col-sm-12 control-label">Bank Name</label>
	<div class="col-sm-12">
	  <input  type="text" class="form-control" placeholder="Email" value="<? echo $bank_detail['bank_name']?>" readonly>
	</div>
  </div>
	<div class="clearfix"></div>
  <div class="form-group">
	<label for="inputEmail3" class="col-sm-12 control-label">IFSC Code</label>
	<div class="col-sm-12">
	  <input type="text" readonly  value="<? echo $bank_detail['ifsc_code']?>" class="form-control" placeholder="Email">
	</div>
  </div>
  <div class="clearfix"></div>
  <div class="form-group">
	<label for="inputEmail3" class="col-sm-12 control-label">Branch Name</label>
	<div class="col-sm-12">
	  <input type="text" readonly   class="form-control" value="<? echo $bank_detail['branch_name']?>"placeholder="Email">
	</div>
  </div>
	<div class="clearfix"></div>
  <div class="form-group">
	<div class="col-sm-12">
	  <input type="submit"  class="btn btn-primary" name="offline" value="Submit"/>
	</div>
  </div>

</div>

</div>
</div>
</div>
			</form>   
                       <?php
                       	
                      						
					   if(!empty($profile_id)) {
					   $wishlist = $db->singlerec("select * from mlm_wishlist where profile_id = '$profile_id' and product_id= '$pid'"); 
					   
					   if($wishlist['status']==0){?> 
                        <div class="product-summary-actions">
                           <div class="add-to-wishlist"><a href="product-detail.php?id=<?=$pid?>&wishlist_add">Add to Wishlist</a></div>
                        </div>
					   <?} else if($wishlist['status']==1){?>
						<div class="product-summary-actions">
                           <div class="add-to-wishlist"><a href="product-detail.php?id=<?=$pid?>&wishlist_remove">Added Wishlist</a></div>
                        </div>
					   <?} else { ?>
					    <div class="product-summary-actions">
                           <div class="add-to-wishlist"><a href="product-detail.php?id=<?=$pid?>&wishlist_add">Add to Wishlist</a></div>
                        </div> 
					   <?} }else {?>
					   <div class="product-summary-actions">
                           <div class="add-to-wishlist"><a onClick="checklogin()"> Add to Wishlist</a></div>
                        </div>
					   <?}?>
                        <div class="share-wrapper social-profiles">
                           <span class="share-label">Share :</span>
                           <ul class="share-links">
                              
							  <li><a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?="$website_url";?>" class="share-link facebook-share" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                              <li><a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?="$website_url";?>" class="share-link twitter-share" target="popup"><i class="zmdi zmdi-twitter"></i></a></li>
							  <li><a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?="$website_url";?>" class="share-link linkedin-share" target="popup"><i class="zmdi zmdi-linkedin"></i></a></li>
                              <li><a href="https://api.addthis.com/oexchange/0.8/forward/google/offer?url=<?="$website_url";?>" class="share-link google-share" target="popup"><i class="zmdi zmdi-google"></i></a></li>
                              <li><a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?="$website_url";?>" class="share-link pinterest-share" target="popup"><i class="zmdi zmdi-pinterest"></i></a></li>
                           </ul>
                        </div>
                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div></div>
      </section>
	  <div>

</div>
      <div class="product-content-bottom marg-btm42">
         
		 <ul class="cutmtab nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
			
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews(<?=$reviewCount;?>)</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Features</a></li>
		  </ul>

         <div class="tab-content well">
            <div role="tabpanel" class="tab-pane active" id="home">
               <div class="tab-content" >
                    <?=$pinfo['pro_longdesc'];?>
                </div>
            </div>
            <div  class="tab-pane" id="profile" role="tabpanel">
               <div class="product-reviews">
                  
                  <div class="review_address_inner">
                                        <h4>Comments</h4>
										
										<?php 
										
                                        $comments=$db->get_all("select * from mlm_reviews where status='1' and product_id='$pid' order by id");
				                        foreach($comments as $i=>$fcomments)
							            {
											
										$userName = $db->Extract_single("select user_fname from mlm_register where user_profileid='$fcomments[profile_id]'");   
										?>
                                        <!-- Single Review -->
                                        <div class="pro_review">
                                            <div class="review_thumb">
                                                <img alt="review images" src="<?=$profileimages;?>">
                                            </div>
                                            <div class="review_details">
                                                <div class="review_info">
                                                    <h5><a href="#"><?=$userName;?></a></h5>
                                                    <!--<div class="rating_send">
                                                        <a href="#"><span class="zmdi zmdi-mail-reply"></span></a>
                                                    </div>-->
                                                </div>
                                                <div class="review_date">
                                                    <span><?=date("M d, Y",strtotime($fcomments['crcdt']));?></span>
                                                </div>
                                                <p><?=$fcomments['message'];?></p>
                                            </div>
                                        </div>
                                        <?}?>
                                    </div>
									<div class="comments-area comments-reply-area">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 class="comment-reply-title mb-50">Leave a Reply</h4>
												<?php 
						   
						   if(isset($_REQUEST['resus']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Your Review Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   <?php 
						   
						   if(isset($_REQUEST['reupd']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Your Review Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
					<form action="" class="comment-form-area" method="POST">
						<div class="comment-input">
							<div class="row">
								<div class="col-lg-6">
									<p class="comment-form-author">
										<input type="text" required="required" name="re_name" placeholder="Name *" value="<?=$userdetail['user_fname'];?>" readonly >
									</p>
								</div>
								<div class="col-lg-6">
									<p class="comment-form-email">
										<input type="number" required="required" name="re_phone" placeholder="Phone *" value="<?=$userdetail['user_phone'];?>" readonly >
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<p class="comment-form-author">
										<input type="text" name="re_email" placeholder="Email *" value="<?=$userdetail['user_email'];?>" readonly>
									</p>
								</div>
								<div class="col-lg-6">
									
										<div id="stars" class="starrr dis-in" ></div>
										&nbsp;&nbsp;&nbsp;&nbsp;<? echo getStar($reviewInfo['stars']); ?>
										<input type="hidden" class="count" name="star_value" id="count" value="<?php echo $reviewInfo['stars']; ?>" >
									
								</div>
							</div>
							
							<p class="comment-form-comment">
								<textarea class="comment-notes" required="required" placeholder="Comment *" name="re_message"
								><?=$reviewInfo['message'];?></textarea>
							</p>
							
						</div>
						<?php if(!empty($profile_id)) {?>
							<button class="comment-submit" type="submit" name="review_submit" >SUBMIT</button>
						<?}else{?>
						     <button class="comment-submit" onClick="checklogin1()" >SUBMIT</button>
						<?}?>
						
					</form>
                                            </div>
                                        </div>
                                    </div>
               </div>
            </div>
            <div class="tab-pane" id="messages" role="tabpanel">
			<div class="row">
			 <div class="col-sm-12">
			    
			 <?=$pinfo['pro_features'];?>
			   </div>
			   </div>
            </div>
         </div>
        
      </div>
   </div>
</div>
          	

<div class="blogs-area in-section section-padding-xs bg-white">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="section-title text-center">
								
								<h2>Recent Products </h2>
							</div>
						</div>
					</div>
					<div class="row blog-slider-active1 in-slidearrow">
					
					<?php 
								
								$products = $db->get_all_assoc("select * from mlm_products where pro_status='0' and pro_id != '$pid' order by pro_id desc limit 4");
								$proCount =count($products);
								foreach($products as $p){
								$stars=$db->Extract_Single("select sum(stars) from mlm_reviews where product_id= '".$p['pro_id']."';");
								
									?>
					  <!-- Single Service -->
                         <div class="col-lg-<?php if($proCount==1){ echo '12'; }else { echo '6'; }?> col-md-6 col-sm-6 col-12">
						 
                            <div class="in-service-2 mt-30">
                                <div class="in-service-2-image">
								
								<?php  $wishlistChk=$db->singlerec("select * from mlm_wishlist where profile_id='$profile_id' and product_id='$p[pro_id]'");
                                
								?>
								
								<?php if(!empty($profile_id)){ ?>
                                    <a href="product-detail.php?id=<?=$p['pro_id'];?>&status=<?=$wishlistChk['status'];?>&wishlist">
                                       <?php if(!empty($p['pro_logo']) && file_exists("uploads/products/logo/thumb/$p[pro_logo]")){ ?>
                                       <img src="uploads/products/logo/thumb/<?=$p['pro_logo']?>" alt="<?=$p['pro_name']?>"/>
									   <?}else {?>
									   <img src="uploads/no_image.jpg" alt="working progress image">
									   <?} ?>
                                    
									<?php if($wishlistChk['id']!='') {
									if($wishlistChk['status']=='1') {?>
										<span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" ></i>
                                        </span>
									<?}else if($wishlistChk['status']=='0'){?>
									    <span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" style="color: white;"></i>
                                        </span>
								    <?}}else{?>
									    <span class="in-service-2-icon">
                                          <i class="zmdi zmdi-favorite" style="color: white;"></i>
                                        </span>
									<?}?>
									
									</a>
								<?}else{?>
								       <a href="" onclick="checklogin()">
                                       <?php if(!empty($p['pro_logo']) && file_exists("uploads/products/logo/thumb/$p[pro_logo]")){ ?>
                                       <img src="uploads/products/logo/thumb/<?=$p['pro_logo']?>" alt="<?=$p['pro_name']?>"/>
									   <?}else {?>
									   <img src="uploads/no_image.jpg" alt="working progress image">
									   <?} ?>
                                       <span class="in-service-2-icon">
                                        <i class="zmdi zmdi-favorite" ></i>
                                       </span></br>
									   
									   </a>
								<?}?>
                                </div>
                                <div class="in-service-2-content">
                                   <h5><a href="product-detail.php?id=<?=$p['pro_id'];?>"><?=$p['pro_name'];?></a></h5>
                                   <p class="price">
								   <span class="price-new"><?=$sitecurrency.' '.$p['pro_pv'];?></span>
								   <span class="price-old"><?=$sitecurrency.' '.$p['pro_cost'];?></span> 
								   </p>
								    <div class="rating">
										<? echo get_Rate2($p['pro_id']); ?>
									 </div>
                                     <a href="product-detail.php?id=<?=$p['pro_id'];?>" class="in-button in-button-theme in-button-xs"><i class="zmdi zmdi-shopping-cart-plus padr-10"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <!--// Single Service -->
								<?}?>
                  </div>					
                </div>
   </div>				
		</main>
		<!--// Page Conttent -->


		<!-- Footer -->


<?php include "includes-new/footer.php" ?>

<script>

$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});	

function checklogin(){
	alert("Please Login to Add Wishlist");
}

</script>
<script>

// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'i', function(e) {
                return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'i', function(e) {
                return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<i class='zmdi zmdi-star-outline'></i>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('i').eq(i).removeClass('zmdi-star-outline').addClass('zmdi-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('i').eq(i).removeClass('zmdi-star').addClass('zmdi-star-outline');
                }
            }
            if (!rating) {
                return this.$el.find('i').removeClass('zmdi-star').addClass('zmdi-star-outline');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
	  //alert(value);
    $('#count').val(value);
	
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
  });
});
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
 <style type="text/css">.product-details .countdown-timer-wrapper{display: none !important;}</style>
                                                
                <script>$(document).ready(function() {$('.fancybox').fancybox();});</script>
                <script>function productZoom(){
                        $(".product-zoom").elevateZoom({
                          gallery: 'ProductThumbs',
                          galleryActiveClass: "active",
                          zoomType: "inner",
                          cursor: "crosshair"
                        });$(".product-zoom").on("click", function(e) {
                          var ez = $('.product-zoom').data('elevateZoom');
                          $.fancybox(ez.getGalleryList());
                          return false;
                        });
                        
                        };
                      function productZoomDisable(){
                        if( $(window).width() < 767 ) {
                          $('.zoomContainer').remove();
                          $(".product-zoom").removeData('elevateZoom');
                          $(".product-zoom").removeData('zoomImage');
                        } else {
                          productZoom();
                        }
                      };

                      productZoomDisable();

                      $(window).resize(function() {
                        productZoomDisable();
                      });
                </script>