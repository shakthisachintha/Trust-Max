<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']=="")) {
	header("location:index.php");
	echo "<script>window.location='index.php';</script>";
}

$menu7='class="active"';

if(isset($ad_frmsubmit)) {
	$cur_date = date("Y-m-d");
	$location = addslashes($location);
	$dimension = addslashes($dimension);
	$link = addslashes($link);
	
	$set = "ad_location='$location'";
	$set .= ",ad_dimension='$dimension'";
	$set .= ",ad_link='$link'";
	$set .= ",ad_crcdt='$cur_date'";
	
	if(isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
		$adv_image = $_FILES['image']['name'];
		$img_size = filesize($_FILES['image']['tmp_name']);		
		if($img_size > 1048576) 
		{
			echo "<script>location.href='advertisement-add.php?largeimage'</script>";
			header("Location:advertisement-add.php?largeimage");
			exit;
		}
		else
		{
			$split_name = end(explode(".",$adv_image));
			if(($split_name== 'jpg') || ($split_name == 'jpeg') || ($split_name == 'gif') || ($split_name == 'png') ||($split_name == 'JPG') || ($split_name == 'JPEG') || ($split_name == 'GIF') || ($split_name == 'PNG'))
			{		
				$img_name = rand(1111,9999).'.'.$split_name;
				$image_path = "../uploads/advertisement/$img_name";
				move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
				$set .= ",ad_img='$img_name'";
		    }
			else
			{
				echo "<script>location.href='advertisement-add.php?not-a-image'</script>";
				header("Location:advertisement-add.php?not-a-image");
				exit;
			}
		}
	}
	
	$db->insertrec("insert into mlm_advertise set $set");
	
	header("location:advertisement-list.php?suc");
	echo "<script>window.location='advertisement-list.php?suc';</script>";
	exit;
}
?>

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
							<a href="advance-settings.php">Advance Settings </a>
						</li>
					</ul><!--.breadcrumb-->
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>Advance Settings </h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<div class="span12">
						
						 <?php if(isset($_REQUEST['largeimage'])) { ?> 					  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok red"></i>
								<strong class="red">
									image size exceeded !!!
								</strong>
							</div>
						   <?php } if(isset($_REQUEST['not-a-image'])) { ?> 					  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok red"></i>
								<strong class="red">
									Invalid file format !!!
								</strong>
							</div>
						   <?php } ?>
							<!--PAGE CONTENT BEGINS-->
							<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
								<div class="control-group">
									<label class="control-label" for="form-field-1">Location<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<select name="location" id="locId" class="form-control" onChange="getDim(this.value)">
										<?php foreach($GT_ad_pg as $ad_pg) {?>
											<option value="<?=$ad_pg;?>"><?=$ad_pg;?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Image Dimension <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="dimension" id="dimId" readonly />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Link <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="link" id="linkId" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Image <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="file" name="image" id="imageId" />
									</div>
								</div>
								<p><b>NOTE : Accepted file format png, jpg, jpeg, gif with maximum size of 1 MB. </b></p>
								<div class="form-actions">
									<input type="submit" name="ad_frmsubmit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;" />&nbsp; &nbsp; &nbsp;
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
								</div>
								<div class="hr"></div>
							</form>

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
		
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
<script>
function getDim(idv) {
	$.ajax({url: "ajax.php",
		type: 'POST',
		data: {ad_id:idv} ,
		success: function(result){
			$('#dimId').val(result);
    }});
}
</script>
	</body>
</html>