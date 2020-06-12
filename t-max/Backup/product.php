<?php include "includes-new/header.php";
include("includes-new/function.php"); 
$profile_id=isset($_SESSION['profileid'])?$_SESSION['profileid']:'';
$con = "";
if(isset($_REQUEST['s'])){
	$s = addslashes($_REQUEST['s']);
	$con = " AND pro_name like '%$s%'";
}
if(isset($_REQUEST['search'])){
	$productName = addslashes($_REQUEST['searchProd']);
	$con = " AND pro_name like '%$productName%'";
}
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 9;
$startpoint = ($page * $limit) - $limit;
$url='?';
$sql = "select * from mlm_products where pro_status='0' $con order by pro_id desc LIMIT {$startpoint} , {$limit}";

$nom_rows=$db->numrows("select * from mlm_products where pro_status='0' $con order by pro_id");


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
		echo "<script>location.href='product.php';</script>";
		header("Location: product.php");
		exit;
	}else{
		if($status=='1'){
			//echo '1';exit;
			$db->insertrec("update mlm_wishlist set status='0' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			echo "<script>location.href='product.php';</script>";
			header("Location: product.php");
			exit;
		}else if($status=='0'){
			//echo '2';exit;
			$db->insertrec("update mlm_wishlist set status='1' where profile_id='$userdetail[user_profileid]' and product_id='$product_id'");
			echo "<script>location.href='product.php';</script>";
			header("Location: product.php");
			exit;
		}
		
	}
		
}



?>
<style>
ul.pagination {
margin-bottom: 0;}
.pagination > .active > a {
z-index: 3;
color: #fff;
cursor: default;
background-color: #337ab7;
border-color: #337ab7; }
.pagination>li {
display: inline;
}
.pagination>li>a, .pagination>li>span {
position: relative;
float: left;
padding: 6px 12px;
margin-left: -1px;
line-height: 1.42857143;
color: #337ab7;
text-decoration: none;
background-color: #fff;
border: 1px solid #ddd;
}
</style>
<!-- Breadcrumb -->
        <div class="breadcrumb-area" data-bgimage="assets/images/bg/page-bg.jpg" data-black-overlay="4">
            <div class="container">
                <div class="in-breadcrumb">
                    <div class="row ">
					<div class="col-sm-6 text-left">
                            <h6>Product List</h6>
                        </div>
                        <div class="col-sm-6 tect-right">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Product List</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb -->


		<!-- Page Conttent -->
	<main class="page-content">
		
		 <div class="blog-details-area section-padding-xs bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-1 order-lg-2">
						
						<div class="services-area in-section bg-white">
                     <div class="container">
                      <div class="row">
					  <?php $products = $db->get_all_assoc($sql);
					  
					  
					  ?>
								<?php 
								if(!empty($products)){
								foreach($products as $p){
								$stars=$db->Extract_Single("select sum(stars) from mlm_reviews where product_id= '".$p['pro_id']."';");
								
									?>
                        <!-- Single Service -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" style="margin-top:30px;">
                            <div class="in-service-2 ">
                                <div class="in-service-2-image">
								
								<?php  $wishlistChk=$db->singlerec("select * from mlm_wishlist where profile_id='$profile_id' and product_id='$p[pro_id]'");
                                
								?>
								
								<?php if(!empty($profile_id)){ ?>
                                    <a href="product.php?id=<?=$p['pro_id'];?>&status=<?=$wishlistChk['status'];?>&wishlist">
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
                                   <p class="price"><span class="price-new"><?=$sitecurrency.' '.$p['pro_pv'];?></span><span class="price-old"><?=$sitecurrency.' '.$p['pro_cost'];?></span> </p>
								   
								    <div class="rating">
									    <? echo get_Rate2($p['pro_id']); ?>
										
										<!--<span><i class="zmdi zmdi-star fa-stack-2x"></i></span>
										<span><i class="zmdi zmdi-star fa-stack-2x"></i></span>
										<span><i class="zmdi zmdi-star fa-stack-2x"></i></span>
										<span><i class="zmdi zmdi-star"></i></span>-->
									 </div>
                                     <a href="product-detail.php?id=<?=$p['pro_id'];?>" class="in-button in-button-theme in-button-xs"><i class="zmdi zmdi-shopping-cart-plus padr-10"></i>Buy Now</a>
									 <!--<a href="product-details.php" class="cart-button"><i class="zmdi zmdi-shopping-cart"></i></a>-->
                                </div>
                            </div>
                        </div>
                        <!--// Single Service -->
                        <?php }}else{?>
								<hr/>
								<center><h3 style='color:red'>No products found!</h3></center>
								<hr/>
								<?php }?>
								</br></br></br>
						<div class="col-lg-12" style="padding-top: 30px;">
						<nav aria-label="Page navigation navigation-lg">
                            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                        </nav>
					    </div>
                        <!--// Single Service -->
						
  <?php 
	$ad_ct = $db->numrows("select * from mlm_advertise where ad_location='Product' and ad_dimension='728X90' and ad_status='1'");
	if($ad_ct > 0) {
		$adDets = $db->singlerec("select * from mlm_advertise where ad_location='Product' and ad_dimension='728X90' and ad_status='1' order by rand()");
		$img = $adDets['ad_img'];
		if(!empty($img) && file_exists("uploads/advertisement/$img")) {
			$link = $adDets['ad_link'];
		?>
		<div class="col-sm-12 text-center mt-40">
			<a href="<?php echo $link;?>"><img src="uploads/advertisement/<?php echo $img;?>" /> </a>
		</div>
	<?php } } ?>
                    </div>
                 </div>
            </div>
						
					</div>
						
						<div class="col-lg-3 order-1 order-lg-1">
                            <div class="row widgets widgets1">

                                <div class="col-lg-12">
                                    <div class="single-widget widget-search">
                                        <form action="#" class="widget-search-form" method="POST">
                                            <input type="text" placeholder="Search product..." name="searchProd">
                                            <button type="submit" name="search"><i class="zmdi zmdi-search"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <!--<div class="col-lg-12">
                                    <div class="single-widget widget-categories">
                                        <h4 class="widget-title">
                                            <span>Categories</span>
                                        </h4>
                                        <ul>
                                            <li><a href="#"><span>Life Insurence</span></a></li>
                                            <li><a href="#"><span>Business Insurence</span></a></li>
                                            <li><a href="#"><span>Car Insurence</span></a></li>
                                            <li><a href="#"><span>Home Insurence</span></a></li>
                                            <li><a href="#"><span>Travel Insurence</span></a></li>
                                            <li><a href="#"><span>Agricultural Insurence</span></a></li>
                                        </ul>
                                    </div>
                                </div>-->

                                <div class="col-lg-12">
                                    <div class="single-widget widget-latestblog">
                                        <h4 class="widget-title">
                                            <span>Latest Products</span>
                                        </h4>
                                        <ul>
										 <?php
			                $products=$db->get_all("select * from mlm_products where pro_status='0' order by pro_id desc limit 3");
				            foreach($products as $i=>$prod)
							{
							?>
                                            <li>
                                                <div class="widget-latestblog-image">
                                                    <a href="#">
                                                        <?php if(!empty($prod['pro_logo']) && file_exists("uploads/products/logo/thumb/$prod[pro_logo]")){ ?>
                                                        <img class="img-responsive" src="uploads/products/logo/thumb/<?=$prod['pro_logo']?>"
                                                            alt="blog thumbnail" style="width:100px;height:89px;">
													<?}else {?>
													 <img src="uploads/no_image.jpg" alt="blog thumbnail" style="width:100px;height:89px;">
													 <? } ?>
                                                    </a>
                                                </div>
                                                <span><?=date("jS M, Y",strtotime($prod['pro_date']));?></span>
                                                <h5><a href="#"><?=$prod['pro_name']?></a></h5>
                                            </li>
                                      <?php } ?>	      
                                        </ul>
                                    </div>
                                </div>
								<?php 
	$ad_ct = $db->numrows("select * from mlm_advertise where ad_location='Product Sidebar 1' and ad_dimension='300X250' and ad_status='1'");
	if($ad_ct > 0) {
		$adDets = $db->singlerec("select * from mlm_advertise where ad_location='Product Sidebar 1' and ad_dimension='300X250' and ad_status='1' order by rand()");
		$img = $adDets['ad_img'];
		if(!empty($img) && file_exists("uploads/advertisement/$img")) {
			$link = $adDets['ad_link'];
		?>
		<div class="col-sm-12 text-center">
			<div class="single-widget widget-latestblog">
			<a href="<?php echo $link;?>"><img src="uploads/advertisement/<?php echo $img;?>" /> </a>
		    </div>
		</div>
	<?php } } ?>
    <?php 
	$ad_ct = $db->numrows("select * from mlm_advertise where ad_location='Product Sidebar 2' and ad_dimension='295X382' and ad_status='1'");
	if($ad_ct > 0) {
		$adDets = $db->singlerec("select * from mlm_advertise where ad_location='Product Sidebar 2' and ad_dimension='295X382' and ad_status='1' order by rand()");
		$img = $adDets['ad_img'];
		if(!empty($img) && file_exists("uploads/advertisement/$img")) {
			$link = $adDets['ad_link'];
		?>
		<div class="col-lg-12 mt30">
            <div class="single-widget widget-latestblog">
			<a href="<?php echo $link;?>"><img src="uploads/advertisement/<?php echo $img;?>" /> </a>
		    </div>
		</div>
	<?php } } ?>  
								 
                                
                            </div>
                        </div>
						
					</div>
				</div>
          </div>				

		</main>
		<!--// Page Conttent -->
<script>
function checklogin(){
	alert("Please Login to Add Wishlist");
}
</script>
		<!-- Footer -->


<?php include "includes-new/footer.php"; ?>