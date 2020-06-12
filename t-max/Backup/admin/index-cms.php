<?php
include("AMframe/config.php"); 
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu7='class="active"';

if(isset($_REQUEST['indexcms']))
{
//$ecomContent=stripslashes($_REQUEST['ecomContent']);
$walletContent=stripslashes($_REQUEST['walletContent']);
$epinContent=stripslashes($_REQUEST['epinContent']);
$paymentCont=stripslashes($_REQUEST['paymentCont']);
//$rewardCont=stripslashes($_REQUEST['rewardCont']);
$geneContent=stripslashes($_REQUEST['geneContent']);
$sysContent=stripslashes($_REQUEST['sysContent']);
$commContent=stripslashes($_REQUEST['commContent']);

$aboutTitle=stripslashes($_REQUEST['aboutTitle']);
$aboutCont=stripslashes($_REQUEST['aboutCont']);
$profContent=stripslashes($_REQUEST['profContent']);
$legContent=stripslashes($_REQUEST['legContent']);
$servContent=stripslashes($_REQUEST['servContent']);
$expoContent=stripslashes($_REQUEST['expoContent']);

$regCont=stripslashes($_REQUEST['regCont']);
$contactCont=stripslashes($_REQUEST['contactCont']);
//$multilangContent=stripslashes($_REQUEST['multilangContent']);

$num=$db->numrows("select * from mlm_cms where cms_id='1'");

//echo $num;
//highProfit Image

if($_FILES['highProImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['highProImg']['name'];
	$file_size =$_FILES['highProImg']['size'];
    $file_tmp =$_FILES['highProImg']['tmp_name'];
    $file_type=$_FILES['highProImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['highProImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $highProfit=",high_prof_img='$file_name'";
      }
}
else
{
$highProfit='';
}

//legPlanImg Image

if($_FILES['legPlanImg']['name']!=''){
	$errors= "";
	$file_name=$_FILES['legPlanImg']['name'];
	$file_size =$_FILES['legPlanImg']['size'];
    $file_tmp =$_FILES['legPlanImg']['tmp_name'];
    $file_type=$_FILES['legPlanImg']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['legPlanImg']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $legPlan=",leg_plan_img='$file_name'";
      }
}
else
{
$legPlan='';
}

//servImage

if($_FILES['servImage']['name']!=''){
	$errors= "";
	$file_name=$_FILES['servImage']['name'];
	$file_size =$_FILES['servImage']['size'];
    $file_tmp =$_FILES['servImage']['tmp_name'];
    $file_type=$_FILES['servImage']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['servImage']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $serviceImage=",serv_image='$file_name'";
      }
}
else
{
$serviceImage='';
}

//expoImage

if($_FILES['expoImage']['name']!=''){
	$errors= "";
	$file_name=$_FILES['expoImage']['name'];
	$file_size =$_FILES['expoImage']['size'];
    $file_tmp =$_FILES['expoImage']['tmp_name'];
    $file_type=$_FILES['expoImage']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['expoImage']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../uploads/cms/".$file_name);
         $expogImage=",expo_image='$file_name'";
      }
}
else
{
$expogImage='';
}

if($num=='1')
{
//$up=$db->insertrec("update mlm_cms set ecom_cont='$ecomContent',wallet_cont='$walletContent',epin_cont='$epinContent',paymt_cont='$paymentCont',reward_cont='$rewardCont',gene_content='$geneContent' ,sys_content='$sysContent',comm_content='$commContent' ,inabout_title='$aboutTitle' ,inabout_content='$aboutCont' ,prof_content='$profContent' $highProfit ,leg_content='$legContent' $legPlan,serv_content='$servContent' $serviceImage ,expo_content='$expoContent' $expogImage,reg_content='$regCont' ,contact_cont='$contactCont',multilang_content='$multilangContent' where cms_id='1'");
$up=$db->insertrec("update mlm_cms set ecom_cont='$ecomContent',wallet_cont='$walletContent',epin_cont='$epinContent',paymt_cont='$paymentCont',reward_cont='$rewardCont',gene_content='$geneContent' ,sys_content='$sysContent',comm_content='$commContent' ,inabout_title='$aboutTitle' ,inabout_content='$aboutCont' ,prof_content='$profContent' $highProfit ,leg_content='$legContent' $legPlan,serv_content='$servContent' $serviceImage ,expo_content='$expoContent' $expogImage,reg_content='$regCont' ,contact_cont='$contactCont',multilang_content='$multilangContent' where cms_id='1'");
}


if($up)
{
header("location:index-cms.php?succ");
echo "<script>window.location='index-cms.php?succ';</script>";

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
						<li class="active">Index CMS</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							CMS Management
							<small>
								<i class="icon-double-angle-right"></i>
								Index CMS
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
						   
							<form class="form-horizontal" name="myform" action="" method="post" onSubmit="return cmsvalidate();"
							enctype="multipart/form-data">
								<h5 style="color:#438eb9">Our Features:</h5>
								<!--<div class="control-group">
									<label class="control-label" for="form-field-1"> Ecommerce Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="ecomContent" id="ecomContent"><?php echo $fetch['ecom_cont']; ?></textarea>
									</div>
								</div>-->
                                <div class="control-group">
									<label class="control-label" for="form-field-1">Pair Commission Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="commContent" id="commContent"><?php echo $fetch['comm_content']; ?></textarea>
									</div>
								</div>
							    <div class="control-group">
									<label class="control-label" for="form-field-1">E-Wallet Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="walletContent" id="walletContent"><?php echo $fetch['wallet_cont']; ?></textarea>
									</div>
								</div>	
															
								<div class="control-group">
									<label class="control-label" for="form-field-1">E-Pin System Content<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="epinContent" id="epinContent"><?php echo $fetch['epin_cont']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Payment Gateway Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="paymentCont" id="paymentCont"><?php echo $fetch['paymt_cont']; ?></textarea>
									</div>
								</div>
								<!--<div class="control-group">
									<label class="control-label" for="form-field-1">Reward Management Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="rewardCont" id="rewardCont"><?php echo $fetch['reward_cont']; ?></textarea>
									</div>
								</div>-->
								<div class="control-group">
									<label class="control-label" for="form-field-1">Genealogy Structure Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="geneContent" id="geneContent"><?php echo $fetch['gene_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Mail System Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="sysContent" id="sysContent"><?php echo $fetch['sys_content']; ?></textarea>
									</div>
								</div>
								
								<!--<div class="control-group">
									<label class="control-label" for="form-field-1">Multilanguage Supportable Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="multilangContent" id="multilangContent"><?php echo $fetch['multilang_content']; ?></textarea>
									</div>
								</div>-->
								<h5 style="color:#438eb9">About Us:</h5>
								<div class="control-group">
									<label class="control-label" for="form-field-1">About Title <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="aboutTitle" id="aboutTitle"><?php echo $fetch['inabout_title']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1"> About Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="aboutCont" id="aboutCont"><?php echo $fetch['inabout_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">High Profits Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="profContent" id="profContent"><?php echo $fetch['prof_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">High Profits Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="highProImg" id="highProImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['high_prof_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Single Leg Plan Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="legContent" id="legContent"><?php echo $fetch['leg_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Single Leg Plan Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="legPlanImg" id="legPlanImg" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['leg_plan_img'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Best Services Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="servContent" id="servContent"><?php echo $fetch['serv_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Best Services Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="servImage" id="servImage" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['serv_image'];  ?>" width="180" height="60" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Exponential Growth Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="expoContent" id="expoContent"><?php echo $fetch['expo_content']; ?></textarea>
									</div>
								</div>
								<div class="control-group">
								  
									<label class="control-label" for="form-field-1">Exponential Growth Image&nbsp; : </label>

									<div class="controls">
									  <input type="file" name="expoImage" id="expoImage" accept="image/*" />
									</div>
									<div class="controls">
										<img src="../uploads/cms/<?php echo $fetch['expo_image'];  ?>" width="180" height="60" />
									</div>
								</div>
								<h5 style="color:#438eb9">Register:</h5>
								<div class="control-group">
									<label class="control-label" for="form-field-1"> Register Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="regCont" id="regCont"><?php echo $fetch['reg_content']; ?></textarea>
									</div>
								</div>
								<h5 style="color:#438eb9">Contact Us:</h5>
								<div class="control-group">
									<label class="control-label" for="form-field-1"> Contact Us Content <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="contactCont" id="contactCont"><?php echo $fetch['contact_cont']; ?></textarea>
									</div>
								</div>
								
								
								<div class="form-actions">
								
								<?php if($demomode=='true'){?>
								<input type="button"  value="SUBMIT" onclick="demo()"
                                class="btn btn-info" style="font-weight:bold;" >
								<?}else{?>
								<input type="submit" name="indexcms" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
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
