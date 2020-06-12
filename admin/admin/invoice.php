<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu6='class="active"';

$query=$db->singlerec("select * from mlm_purchase where randomkey='$_REQUEST[detail]'");
$userid=$query['pay_userid'];
$email=$query['pay_email'];
$phone=$query['pay_phone'];
$amount=$query['pay_amount'];
$pay_date=$query['pay_date'];
$cou=$query['dispatch_status'];
//$co_no=$query['courier_no'];
$pro=$query['pay_product'];


$detail=$db->singlerec("select * from mlm_register where user_profileid='$userid'");

$un=ucfirst($detail['user_fname']);
$ln=ucfirst($detail['user_lname']);
$add=$detail['user_commaddr1'];
$addr=$detail['user_commaddr2'];
$city=$detail['user_city'];
$state=$detail['user_state'];
$country=$detail['user_country'];
$pc=$detail['user_postalcode'];


$con=$db->singlerec("select * from mlm_city where city_id='$city'");
$co_nm=$con['city_name'];

$st=$db->singlerec("select * from mlm_state where state_id='$state'");
$st_nm=$st['state_name'];

$ci=$db->singlerec("select * from mlm_country where country_id='$country'");
$ci_nm=$ci['country_name'];

$p=$db->singlerec("select * from mlm_products where pro_id='$pro'");
$p_n=$p['pro_name'];

if($cou==0){
	$msg="<span style='color:green'>Dispatched</span>";
}else{
	$msg="<span style='color:red'>Pending</span>";
}
?>
<style>
.label.arrowed-in:before
{

padding:10px;
}
.label.arrowed-in-right:after
{
padding:10px;
}

</style>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>


			<div class="">

				<div class="page-content">
					
<div class="span1">
&nbsp;
</div>
	<div class="span10">				
					<div class="page-header position-relative">
						<h1>
						INVOICE DETAIL
						
						</h1>
					</div><!--/.page-header-->

					
<div class="row-fluid">
					
					     <div class="control-group">
						
							<!--<label class="span6" style="padding:8px; font-size:14px;">INVOICE</label>-->
							<div class="span12" style="padding:8px; font-size:14px;text-align: right;">
							  
							  <button class="btn btn-success" id="pri" value="<?php echo $_REQUEST['detail']; ?>" onclick="prin()"><i class="icon-print bigger-130" title="click to edit"></i> Print</button>
							</div>

						  </div>
<script>
window.onload=function prin(){
	var print = document.getElementById("pri").value;
	window.print("#pri");
}
</script>				

						 <div class="control-group">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
						
						<div class="span6" style="text-align:left">
						   <h4><b>Shipped To:</b></h4>
						   <p><?php echo $un;?> <?php echo $ln;?></p>
						   <p><?php echo $phone;?></p>
						   <p><?php echo $email; ?></p>
						   <p><?php $pay_date; ?></p>
						   <p><?php $add; ?> <?php echo $ci_nm; ?></p>
						   <p><?php $st_nm; ?> <?php echo $co_nm; ?></p>
						</div>
						
						<div class="span6" style="text-align:right">
						<h4><b>Product Details:</b></h4>
						   <p>Product Name: <b><?php echo $p_n; ?></b></p>
						   <p>Ordered Date: <b><?php echo date("d-m-Y",strtotime($pay_date)); ?></b></p>
						   <p>Courier Status : <b><?php echo $msg; ?></b></p>
						    <!--<p>Courier No : <?php if($cou==0){
							   echo $co_no;
						   }else{
							   echo "<span style='color:red'>----</span>";
						   } ?>-->
						   
						</div>
						
						</div>	
						</div>
						
						
						
						<div class="control-group">
							<div class="span12">
								<!--PAGE CONTENT BEGINS-->
							 
						
							<label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">Order summary</label>

						  <table class="table table-striped">
						     <thead>
							    <tr>
								  <th>Item</th>
								  <th>Price</th>
								  <th>Quantity</th>
								  <th>Totals</th>
								</tr>
							 </thead>
							 <tbody>
							    <tr>
								  <td>1</td>   
								  <td><?php echo $amount; ?></td>   
								  <td>1</td>   
								  <td><?php echo $amount; ?></td>   
								</tr>
								
								<tr>
								  <td style="text-align:right;" colspan="3"><b>Grant Total</b></td>    
								  <td><?php echo $amount; ?></td>   
								</tr>
				
							 </tbody>
						  </table>
							
							</div>	
						</div>
</div>						  
					</div>

						
		</div>
					<div class="hr hr-18 dotted hr-double"></div>

					<div class="span1">
&nbsp;
</div>
					</div>


							
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
