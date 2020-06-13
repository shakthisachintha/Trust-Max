<?php
include("AMframe/config.php"); 
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu7='class="active"';

if(isset($_REQUEST['workscms']))
{
$join_memCont=stripslashes($_REQUEST['join_memCont']);
$buy_prodCont=stripslashes($_REQUEST['buy_prodCont']);
$incomeContent=stripslashes($_REQUEST['incomeContent']);
$ref_planCont=stripslashes($_REQUEST['ref_planCont']);
$binary_matCont=stripslashes($_REQUEST['binary_matCont']);
$purchaseCont=stripslashes($_REQUEST['purchaseCont']);
$paymentCont=stripslashes($_REQUEST['paymentCont']);
$genelogyCont=stripslashes($_REQUEST['genelogyCont']);
$add_userCont=stripslashes($_REQUEST['add_userCont']);
$num=$db->numrows("select * from mlm_cms where cms_id='1'");

//echo $num; 
//Ref Plan Image
if($_FILES['ref_planImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['ref_planImg']['name'];
	$file_size =$_FILES['ref_planImg']['size'];
    $file_tmp =$_FILES['ref_planImg']['tmp_name'];
    $file_type=$_FILES['ref_planImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['ref_planImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $refPlanImg=",ref_plan_img='$file_name'";
      }
}
else
{
$refPlanImg='';
}

//Binary Match Image
if($_FILES['binary_matImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['binary_matImg']['name'];
	$file_size =$_FILES['binary_matImg']['size'];
    $file_tmp =$_FILES['binary_matImg']['tmp_name'];
    $file_type=$_FILES['binary_matImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['binary_matImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $binaryMatImg=",binary_mat_img='$file_name'";
      }
}
else
{
$binaryMatImg='';
}

//Purchase Image
if($_FILES['purchaseImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['purchaseImg']['name'];
	$file_size =$_FILES['purchaseImg']['size'];
    $file_tmp =$_FILES['purchaseImg']['tmp_name'];
    $file_type=$_FILES['purchaseImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['purchaseImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $purchaseImage=",purchase_img='$file_name'";
      }
}
else
{
$purchaseImage='';
}

//Payment Image
if($_FILES['paymentImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['paymentImg']['name'];
	$file_size =$_FILES['paymentImg']['size'];
    $file_tmp =$_FILES['paymentImg']['tmp_name'];
    $file_type=$_FILES['paymentImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['paymentImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $paymentImage=",payment_img='$file_name'";
      }
}
else
{
$paymentImage='';
}

//
//genelogy Image
if($_FILES['genelogyImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['genelogyImg']['name'];
	$file_size =$_FILES['genelogyImg']['size'];
    $file_tmp =$_FILES['genelogyImg']['tmp_name'];
    $file_type=$_FILES['genelogyImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['genelogyImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $genelogyImage=",genelogy_img='$file_name'";
      }
}
else
{
$genelogyImage='';
}

//Payment Image
if($_FILES['add_userImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['add_userImg']['name'];
	$file_size =$_FILES['add_userImg']['size'];
    $file_tmp =$_FILES['add_userImg']['tmp_name'];
    $file_type=$_FILES['add_userImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['add_userImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $add_userImage=",add_user_img='$file_name'";
      }
}
else
{
$add_userImage='';
}

//how_works Image
if($_FILES['how_worksImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['how_worksImg']['name'];
	$file_size =$_FILES['how_worksImg']['size'];
    $file_tmp =$_FILES['how_worksImg']['tmp_name'];
    $file_type=$_FILES['how_worksImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['how_worksImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $how_worksImage=",how_works_img='$file_name'";
      }
}
else
{
$how_worksImage='';
}

//Payment Image
if($_FILES['binary_levelImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['binary_levelImg']['name'];
	$file_size =$_FILES['binary_levelImg']['size'];
    $file_tmp =$_FILES['binary_levelImg']['tmp_name'];
    $file_type=$_FILES['binary_levelImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['binary_levelImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $binary_levelImage=",binary_level_img='$file_name'";
      }
}
else
{
$binary_levelImage='';
}

//Payment Image
if($_FILES['binary_planImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['binary_planImg']['name'];
	$file_size =$_FILES['binary_planImg']['size'];
    $file_tmp =$_FILES['binary_planImg']['tmp_name'];
    $file_type=$_FILES['binary_planImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['binary_planImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $binary_planImage=",binary_plan_img='$file_name'";
      }
}
else
{
$binary_planImage='';
}

if($num=='1')
{
	//echo "update mlm_cms set join_mem_cont='$join_memCont',buy_prod_cont='$buy_prodCont',income_content='$incomeContent',ref_pair_cont='$ref_planCont' $refPlanImg,binary_mat_cont='$binary_matCont' $binaryMatImg,purchase_cont='$purchaseCont' $purchaseImage ,payment_cont='$paymentCont' $paymentImage,genelogy_cont='$genelogyCont' $genelogyImage ,add_user_cont='$add_userCont' $add_userImage $how_worksImage $binary_levelImage $binary_planImage where cms_id='1'";exit;
$up=$db->insertrec("update mlm_cms set join_mem_cont='$join_memCont',buy_prod_cont='$buy_prodCont',income_content='$incomeContent',ref_pair_cont='$ref_planCont' $refPlanImg,binary_mat_cont='$binary_matCont' $binaryMatImg,purchase_cont='$purchaseCont' $purchaseImage ,payment_cont='$paymentCont' $paymentImage,genelogy_cont='$genelogyCont' $genelogyImage ,add_user_cont='$add_userCont' $add_userImage $how_worksImage $binary_levelImage $binary_planImage where cms_id='1'");
}
/* else 
{ 
$up=mysql_query("insert into mlm_cms(cms_id,cms_aboutus,cms_terms,cms_privacy,cms_welcome,cms_whatwedo,cms_greetings) values('1','$about','$terms','$privacy','$welcome','$wedo','$cms_greetings') ");

} */

if($up)
{
header("location:works-cms.php?succ");
echo "<script>window.location='works-cms.php?succ';</script>";

}



}



$fetch=$db->singlerec("select * from mlm_cms where cms_id='1'");
 ?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft|,fullscreen,image,cleanup,help,code,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<script>
function cmsvalidate()
{

tinyMCE.triggerSave();

if(document.getElementById('about').value=="")
{
alert("please enter the about us");
document.getElementById('about').focus();
return false;


}

if(document.getElementById('terms').value=="")
{
alert("please enter the terms & conditions");
document.getElementById('terms').focus();
return false;


}


if(document.getElementById('privacy').value=="")
{
alert("please enter the Privacy Policy ");
document.getElementById('privacy').focus();
return false;


}

if(document.getElementById('welcome').value=="")
{
alert("please enter the Welcome Text ");
document.getElementById('welcome').focus();
return false;
}

if(document.getElementById('wedo').value=="")
{
alert("please enter the what We Do ");
document.getElementById('wedo').focus();
return false;
}

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
							CMS Management

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">How it works CMS</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							CMS Management
							<small>
								<i class="icon-double-angle-right"></i>
								How it works CMS
							</small>
						</h1>
					</div><!--/.page-header-->
                         
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
                           
						   <?php 
						   
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
							<form class="form-horizontal" name="myform" action="" method="post" onSubmit="return cmsvalidate();"  enctype="multipart/form-data">
								<h5 style="color:#438eb9">How We Works:</h5>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Join as Member Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="join_memCont" id="join_memCont"><?php echo $fetch['join_mem_cont']; ?></textarea>
									</div>
								</div>

							    <div class="control-group">
									<label class="control-label" for="form-field-1">Buy Product Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="buy_prodCont" id="buy_prodCont"><?php echo $fetch['buy_prod_cont']; ?></textarea>
									</div>
								</div>	
								
                             	<div class="control-group">
									<label class="control-label" for="form-field-1"> Earn Multiple Income Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="incomeContent" id="incomeContent"><?php echo $fetch['income_content']; ?></textarea>
									</div>
								</div>	
								<div class="control-group">
								    <label class="control-label" for="form-field-1">How We Works Image&nbsp; : </label>
                                    <div class="controls">
									  <input type="file" name="how_worksImg" id="how_worksImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['how_works_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
								    <label class="control-label" for="form-field-1">Binary MLM Level Commission Image&nbsp; : </label>
                                    <div class="controls">
									  <input type="file" name="binary_levelImg" id="binary_levelImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['binary_level_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
								    <label class="control-label" for="form-field-1">Binary Plan Pair Capping Image&nbsp; : </label>
                                    <div class="controls">
									  <input type="file" name="binary_planImg" id="binary_planImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['binary_plan_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<h5 style="color:#438eb9">Binary MLM Process:</h5>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Referal & Pair Bonus Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="ref_planCont" id="ref_planCont"><?php echo $fetch['ref_pair_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Referal & Pair Bonus Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="ref_planImg" id="ref_planImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['ref_plan_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Binary MLM 2×2 Matrix Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="binary_matCont" id="binary_matCont"><?php echo $fetch['binary_mat_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Binary MLM 2×2 Matrix Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="binary_matImg" id="binary_matImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['binary_mat_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Purchase & Repurchase bonus Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="purchaseCont" id="purchaseCont"><?php echo $fetch['purchase_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Purchase & Repurchase bonus Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="purchaseImg" id="purchaseImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['purchase_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Payment Gateway Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="paymentCont" id="paymentCont"><?php echo $fetch['payment_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Payment Gateway Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="paymentImg" id="paymentImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['payment_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Genelogy Tree Structure<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="genelogyCont" id="genelogyCont"><?php echo $fetch['genelogy_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Genelogy Tree Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="genelogyImg" id="genelogyImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['genelogy_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Add User In Downline<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="add_userCont" id="add_userCont"><?php echo $fetch['add_user_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Add User In Downline Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="add_userImg" id="add_userImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['add_user_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								
								<div class="form-actions">
<!--									
-->								<?php if($demomode=='true'){?>
								<input type="button"  value="SUBMIT" onclick="demo()"
                                class="btn btn-info" style="font-weight:bold;" >
								<?}else{?>
                                <input type="submit" name="workscms" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
								<?}?>

									&nbsp; &nbsp; &nbsp;
									<!--<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>-->
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>

								<!--/row-->


								<!--/row-->

							
								
							</form>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

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
