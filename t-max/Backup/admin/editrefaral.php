<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menumemss='class="active"';

if(isset($_REQUEST['update'])) {
	$amt=addslashes($_REQUEST['act_amt']);
	$per=addslashes($_REQUEST['refamt']);
	$tax=addslashes($_REQUEST['tax']);
	
	$update = $db->insertrec("UPDATE mlm_basic_comission SET ref_bonustype='$per',ref_bonusamt='$amt',ref_tax='$tax' WHERE id='1'");
	if($update) {
			header("Location:editrefaral.php?editsuccess");
		echo "<script>window.location='editrefaral.php?editsuccess';</script>";
		exit;
	}
}

 
?>
<style type="text/css">
#payid
{
	cursor:not-allowed;
}
</style>
<script type="text/javascript">

	var type=1;
	function view_limit(val)
	{
		type=val;
		
		if(type==1)
		{
			document.getElementById('ref_limit').style.display="block";
			
		}
		else
		{
		
			document.getElementById('ref_limit').style.display="none";
		
		}
	}
	
	function planvalidate()
	{
		var amt=document.getElementById('act_amt').value;
		if(amt=="")
		{
			alert("Please Enter Amount");
			document.getElementById('act_amt').focus();
			return false;
		}
		else if(isNaN(document.getElementById('act_amt').value))
		{
			alert("Please Enter Valid Amount");
			document.getElementById('act_amt').focus();
			return false;
		}
		
		var refamt=document.getElementById('refamt').value;
		if(refamt==""){
			alert('Please select the percentage type');
			document.getElementById('refamt').focus();
			return false;
		}else if(isNaN(document.getElementById('refamt').value)){
			alert('Please select the valid percentage type');
			document.getElementById('refamt').focus();
			return false;
		}
	
		var tax = document.getElementById('refamt').value;
		if(tax==""){
			alert('Please Enter the tax amount');
			document.getElementById('refamt').focus();
			return false;
		}else if(isNaN(document.getElementById('refamt').value)){
			alert('Please Enter the valid tax amount');
			document.getElementById('refamt').focus();
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

						<li class="active">SET Referal Bonus</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
					SET Referal Bonus
						
						</h1>
					</div><!--/.page-header-->
					<?php 
						   
						   if(isset($_REQUEST['editsuccess']))
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

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
<?php
$user=$db->singlerec("select * from mlm_basic_comission where id='1'");
?>
							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return planvalidate();" enctype="multipart/form-data" />
                                
									<div class="control-group">
										<label class="control-label" for="form-field-2">Referal Type<span style="color:#FF0000;">*</span> : </label>

										<div class="controls">
											<select name="refamt" id="refamt">
												<option value="0">Amount</option>
												<option value="1">Percentage</option>
											</select>
										</div>
									</div>

	                               <div class="control-group">
									<label class="control-label" for="form-field-2">Referal Amount<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="act_amt" id="act_amt" value="<?php echo $user['ref_bonusamt'];  ?>"/>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-2">TDS Percentage (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="tax" id="tax" value="<?php echo $user['ref_tax'];  ?>">
									</div>
								</div>

								<div class="form-actions">
								<?php if($demomode=='true'){?>
								<input type="button"  value="UPDATE" onclick="demo()"
                                class="btn btn-info" style="font-weight:bold;" >
								<?}else{?>
								<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;">
								<?}?>		
									<!--<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">-->
									
								</div>

								<div class="hr"></div>								
							</form>

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

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
