<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']=="")) {
	header("location:index.php");
	echo "<script>window.location='index.php';</script>";
}

$menu7='class="active"';

function remove_files($files) {
	foreach($files as $file){
		if(is_file($file) && (basename($file) != "no_image.png")) {
			unlink($file);
		}
	}
}

if(isset($frmsubmit) && !empty($admin_pass) && !empty($agree)) {
	$admin_pass = addslashes($admin_pass);
	
	$getDet = $db->singlerec("select admin_password from mlm_admin where admin_id='1'");
	if($getDet['admin_password'] == $admin_pass) {
		//Remove document files
		$doc_files = glob("../uploads/document/*");
		remove_files($doc_files);
		
		//Remove E-pin purchased payslip files
		$epayslip_files = glob("../uploads/epinslip/*");
		remove_files($epayslip_files);
		
		//Remove payslip files
		$payslip_files = glob("../uploads/payslip/*");
		remove_files($payslip_files);
		
		//Remove profile image files
		$profile_img_files = glob("../uploads/profile_image/*");
		remove_files($profile_img_files);
		$profile_mid_files = glob("../uploads/profile_image/mid/*");
		remove_files($profile_mid_files);
		$profile_org_files = glob("../uploads/profile_image/original/*");
		remove_files($profile_org_files);
		$profile_thumb_files = glob("../uploads/profile_image/thumb/*");
		remove_files($profile_thumb_files);
		
		//Remove product image files
		$prodct_files = glob("../uploads/products/*");
		remove_files($prodct_files);
		$prodct_mid_files = glob("../uploads/products/content_logo/mid/*");
		remove_files($prodct_mid_files);
		$prodct_org_files = glob("../uploads/products/content_logo/original/*");
		remove_files($prodct_org_files);
		$prodct_thumb_files = glob("../uploads/products/content_logo/thumb/*");
		remove_files($prodct_thumb_files);
		
		$mid_files = glob("../uploads/products/logo/mid/*");
		remove_files($mid_files);
		$org_files = glob("../uploads/products/logo/original/*");
		remove_files($org_files);
		$thumb_files = glob("../uploads/products/logo/thumb/*");
		remove_files($thumb_files);
		
		$db->insertrec("truncate table mlm_discount_plan");
		$db->insertrec("truncate table mlm_document");
		$db->insertrec("truncate table mlm_epin");
		$db->insertrec("truncate table mlm_mempayments");
		$db->insertrec("truncate table mlm_outbox");
		$db->insertrec("truncate table mlm_pairing_carry");
		$db->insertrec("truncate table mlm_pair_capping");
		$db->insertrec("truncate table mlm_payout");
		$db->insertrec("truncate table mlm_payoutcalc");
		$db->insertrec("truncate table mlm_products");
		$db->insertrec("truncate table mlm_purchase");
		$db->insertrec("truncate table mlm_rank");
		$db->insertrec("truncate table mlm_register");
		$db->insertrec("truncate table mlm_reward");
		$db->insertrec("truncate table mlm_stocks");
		$db->insertrec("truncate table mlm_userpin");
		$db->insertrec("truncate table mlm_wastage");
		$db->insertrec("truncate table mlm_withdrawrequsets");
		
		header("location:clear-database.php?suc");
		echo "<script>window.location='clear-database.php?suc';</script>";
		exit;
	}
	else {
		header("location:clear-database.php?err");
		echo "<script>window.location='clear-database.php?err';</script>";
		exit;
	}
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
							<a href="advance-settings.php">Clear/Reset Database </a>
						</li>
					</ul><!--.breadcrumb-->
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>Clear/Reset Database </h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<div class="span12">
						
						 <?php if(isset($_REQUEST['err'])) { ?> 					  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok red"></i>
								<strong class="red">
									Password Incorrect !!!
								</strong>
							</div>
						   <?php } if(isset($_REQUEST['suc'])) { ?> 					  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Database cleared Successfully !!!
								</strong>
							</div>
						   <?php } ?> 					  
						  
							<!--PAGE CONTENT BEGINS-->
							<form class="form-horizontal" method="post" action="" onSubmit="return confirm('Are you sure to proceed?')">
								<div class="control-group">
									<label class="control-label" for="form-field-1">Admin Password<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="admin_pass" required />
									</div>
								</div>
								<div class="control-group">
									<input type="checkbox" name="agree" style="opacity:inherit;" required /> <span style="margin-left: 28px;margin-right: 10px;"> I know that If I click the below button, All the entries from my database will get deleted which is not reversible.</span>
								</div>
								<div class="form-actions">
									<input type="submit" <?php if ($demomode=='true') {?>  name="" onclick="return demo()" <? } else { ?> name="frmsubmit" <?php } ?> value="Reset My Database" class="btn btn-info" style="font-weight:bold;" />
								</div>
								<div class="hr"></div>
								<p><b>Notice: Before you click on "Reset My Database", Please keep a backup of your existing database which will ensure further safety if anything goes wrong. <a <?php if ($demomode=='true') {?>  href="#" onclick="return demo()" <? } else { ?> href="backup.php" <?php } ?>>Click Here for Backup.</a></b></p>
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
	</body>
</html>