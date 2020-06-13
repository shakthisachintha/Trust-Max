<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu4='class="active"';

if(isset($_REQUEST['submit']))
{
	$name = addslashes($_REQUEST['name']);
	$cost = addslashes($_REQUEST['cost']); 
	$pvvalue=addslashes($_REQUEST['pvvalue']);
	$desc=addslashes($_REQUEST['desc']);
	$ldesc=addslashes($_REQUEST['ldesc']);
    $feature=addslashes($_REQUEST['feature']);
	$qty=addslashes($_REQUEST['qty']);
	$qty_type=addslashes($_REQUEST['qty_type']);
	$prod_rpv=addslashes($_REQUEST['product_rpv']);
	$bonus=addslashes($_REQUEST['bonus']);
	$indirect_bonus=addslashes($_REQUEST['indir_bonus']);
	$rebonus=addslashes($_REQUEST['rebonus']);
	$reindirect_bonus=addslashes($_REQUEST['reindir_bonus']);
	$logo=addslashes($_FILES['logo']['name']);

	// include("includes/resize-class.php");
	  	
	if($name == "")
	{
		echo "<script>window.location='add_products.php?error';</script>";	
		header("Location:add_products.php?error");
		exit;
	}
	
	 
	if($logo == "")
	{
		echo "<script>window.location='add_products.php?error';</script>";
		header("Location:add_products.php?error");
		exit;
	} 
	else 
	{
	$img_size = filesize($_FILES['logo']['tmp_name']);
	
			if($img_size > 1048576) //1048576 = 1MB
			{	
				echo "<script>window.location='add_products.php?largeimage';</script>"; 
				header("Location:add_products.php?largeimage");
				exit;
			}
			else
			{
				$split_name = explode(".",$logo);
		
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			
			$cate_img_small = "prol".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/products/logo/thumb/";
			$image_path_thumb = "../uploads/products/logo/mid/";
			
			move_uploaded_file($_FILES['logo']['tmp_name'],"../uploads/products/logo/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("../uploads/products/logo/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150, 150, 'exact');

			$resizeObj -> saveImage($image_path.$cate_img_small, 100);
			
			//very small image
			//$resizeObj = new resize($_FILES['cate_image']['tmp_name']);
			
			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(60, 60, 'exact');

			$resizeObj -> saveImage($image_path_thumb.$cate_img_small, 100);
			
			//unlink("../uploads/".$feature_image);
			
			//echo $cate_img_very_small.", ".$cate_img_small; exit;
		}
		else
		{	echo "<script>window.location='add_products.php?not-a-image';</script>";
			header("Location:add_products.php?not-a-image");
			exit;
		}
	}
}
//echo "INSERT INTO mlm_products (pro_name,pro_cost,pro_pv,pro_logo,pro_contentimg,pro_desc,pro_longdesc,pro_features,pro_date,pro_qnty,pro_qnty_type,prod_rpv,pro_stock,pro_bonus,pro_indirect_bonus,pro_repur_bonus,pro_repur_indirect_bonus) VALUES ('$name','$cost','$pvvalue','$cate_img_small','$cate_img','$desc','$ldesc','$feature',NOW(),'$qty','$qty_type','$prod_rpv','$qty','$bonus','$indirect_bonus','$rebonus','$reindirect_bonus')";exit;
 $insert = $db->insertrec("INSERT INTO mlm_products (pro_name,pro_cost,pro_pv,pro_logo,pro_contentimg,pro_desc,pro_longdesc,pro_features,pro_date,pro_qnty,pro_qnty_type,prod_rpv,pro_stock,pro_bonus,pro_indirect_bonus,pro_repur_bonus,pro_repur_indirect_bonus) VALUES ('$name','$cost','$pvvalue','$cate_img_small','$cate_img','$desc','$ldesc','$feature',NOW(),'$qty','$qty_type','$prod_rpv','$qty','$bonus','$indirect_bonus','$rebonus','$reindirect_bonus')");
	
	if($insert)
	 { 
	
	 header("Location:products.php?success"); 
	 ?>
	<script>
	window.location="products.php?success";
	</script>	
	<?php
	
	}
}

?>
 <script>
 
 function provalidate()
 {
 
tinyMCE.triggerSave();

 if(document.getElementById('name').value == "")
	{
		alert("Enter the Product Name");
		document.getElementById('name').focus();
		return false;
	}
 
 if(document.getElementById('cost').value == "")
	{
		alert("Enter the Product Cost");
		document.getElementById('cost').focus();
		return false;
	}
	 if(document.getElementById('pvvalue').value == "")
	{
		alert("Enter the Product PV value");
		document.getElementById('pvvalue').focus();
		return false;
	}
	
	if(document.getElementById('product_rpv').value==""){
		alert("Enter the Product RPV value");
		document.getElementById('product_rpv').focus();
		return false;	
	} 
	 if(document.getElementById('bonus').value == "")
	{
		alert("Enter the Product purchase bonus");
		document.getElementById('bonus').focus();
		return false;
	}
	 if(document.getElementById('rebonus').value == "")
	{
		alert("Enter the Product Repurchase bonus");
		document.getElementById('rebonus').focus();
		return false;
	}
		 if(document.getElementById('qty').value == "")
	{
		alert("Enter the Product Quantity ");
		document.getElementById('qty').focus();
		return false;
	}
	
		 if(document.getElementById('qty_type').value == "")
	{
		alert("Enter the Product Quantity Type");
		document.getElementById('qty_type').focus();
		return false;
	}
	
	
 if(document.getElementById('desc').value == "")
	{
		alert("Enter the Product Description");
		document.getElementById('desc').focus();
		return false;
	}
	
	
	 if(document.getElementById('feature').value == "")
	{
		alert("Enter the Product Features");
		document.getElementById('feature').focus();
		return false;
	}
	
 
 	if(document.getElementById('logo').value == "")
	{
		alert("Please enter the the Product Logo");
		document.getElementById('logo').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('logo').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('logo').value="";
			  document.getElementById('logo').focus();
			  return false;
		 }
	}

 }
 
 
 </script>
 
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">

	tinyMCE.init({

		// General options

		mode : "textareas",

		theme : "simple",

		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options

		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,",


		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : false,



		// Example content CSS (should be your site CSS)

		content_css : "css/content.css",



		// Drop lists for link/image/media/template dialogs

		template_external_list_url : "lists/template_list.js",

		external_link_list_url : "lists/link_list.js",

		external_image_list_url : "lists/image_list.js",

		media_external_list_url : "lists/media_list.js",



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

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
							<a href="products.php">Products</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Add Products</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						ADD PRODUCTS
						
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return provalidate();" enctype="multipart/form-data" />
								<div class="control-group">
									<label class="control-label" for="form-field-1">Product Name <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="name" id="name" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Product Cost<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="cost" id="cost" />
									</div>
								</div>
                                
								<div class="control-group">
									<label class="control-label" for="form-field-2">Product PV<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="pvvalue" id="pvvalue" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Product RPV<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="product_rpv" id="product_rpv" />
									</div>
								</div>
								
                                <div class="control-group">
									<label class="control-label" for="form-field-2">Purchase Bonus<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="number" name="bonus" id="bonus" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Indirect purchase Bonus<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="number" name="indir_bonus" id="indir_bonus" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Repurchase Bonus<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="number" name="rebonus" id="rebonus"/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Indirect Repurchase Bonus<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="number" name="reindir_bonus" id="reindir_bonus" />
									</div>
								</div>
								<? 
								$prod_qty = array("","Bag/Bags","Barrel/Barrels","Cubic Meter","Dozen","Gallon","Gram","Kilogram","Kilometer","Long Ton","Meter","Metric Ton","Ounce","Pair","Pack/Packs","Piece/Pieces","Pound","Set/Sets","Short Ton"); 
								$disp = "<option value=''>Select Unit Type</option>";
								for($qty=1;$qty<count($prod_qty);$qty++){
								 $disp .= "<option value='$qty'>$prod_qty[$qty]</option>";
								}
								?>
	                               <div class="control-group">
									<label class="control-label" for="form-field-2">Product Quantity<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="qty" id="qty" style="width:100px;"/>
										<select name="qty_type" id="qty_type" style="width:105px;">
										<?echo $disp; ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Product description <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<textarea name="desc" id="desc" style="width:300px; height:100px;"></textarea>
									
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="form-field-1">Long Description  : </label>

									<div class="controls">
										<textarea name="ldesc" id="ldesc" style="width:300px; height:100px;"></textarea>
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Features <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<textarea name="feature" id="feature" style="width:300px; height:100px;"></textarea>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Product Logo<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<input type="file" name="logo" id="logo" onchange="img_validate1('logo',800,600)"/>
									</div>
								</div>
								

								
							<!-- <div class="control-group">
									<label class="control-label" for="form-field-1">Content Image <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									  <input type="file" name="clogo" id="clogo" />
									</div>
 </div> -->
								
								
								

								<div class="form-actions">
<!--									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>
-->								<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									

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

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->
<script>
function img_validate(id,width,height){
	//alert('dgfdf');
	var fuData = document.getElementById(id);
	var FileUploadPath = fuData.value;
	var action = 'update';
	if(window.FileReader) {   
		if (FileUploadPath != '') {				
			var size = fuData.files[0].size;
			if (size > 1048576) {				
				//swal('File size exceeded!!', 'Maximum allowed size is 1 MB', 'error');
				alert('Maximum allowed size is 1 MB');
				fuData.value="";
				fuData.focus();
				return false;
			} else {			
				var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
				
				if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
					if (fuData.files && fuData.files[0]) {
						var reader = new FileReader();
						
						reader.onload = function(e) {
							var w, h;
							
							var image = new Image();
							image.src = e.target.result;
							image.onload = function() {
								w = this.width;
								h = this.height;
								localStorage.setItem("width", w);
								localStorage.setItem("height", h);
								if (w < width || h < height) {
									alert("Your image size (" + w + 'x' + h + "). size should grater than ("+width+"x"+height+").");
									//swal("Too short!","Your image size (" + w + 'x' + h + "). size should grater than ("+width+"x"+height+").","error");
									fuData.value="";
									fuData.focus();
									return false;
									
								} else {
								
									$image.attr("src", e.target.result).show();
								}
							}
						}
						reader.readAsDataURL(fuData.files[0]);
					}
				} else {
					alert("Profile picture only allows file types of GIF, PNG, JPG and JPEG. ");
					//swal("Invalid file format!","Profile picture only allows file types of GIF, PNG, JPG and JPEG. ","error");
					fuData.value="";
					fuData.focus();
					return false;
				}
			}
		}
	} else {
	
	swal("Incompatible browser","Your browser does not support Advance javascript functions so kindly update your browser to latest version..","warning");
	return true;
	}
}
</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

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
