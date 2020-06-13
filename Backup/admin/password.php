<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu7='class="active"';
$sel_login=$db->singlerec("SELECT * FROM mlm_admin WHERE admin_id='1'");
 
if(isset($_REQUEST['submit']))
{
	$admin_id=$_SESSION['admin_id'];
 
    $username=addslashes($_REQUEST['username']);
	$cur_pass =addslashes($_REQUEST['cur_pass']);
	$current_pass =addslashes($_REQUEST['current_pass']);
	$new_pass = addslashes($_REQUEST['new_pass']); 
	$con_new_pass =addslashes($_REQUEST['con_new_pass']);
	
	if(($current_pass == "") || ($new_pass == "") || ($con_new_pass == ""))
	{
		header("Location:password.php?error");
	}
	elseif($new_pass != $con_new_pass)
	{
		header("Location:password.php?error");
	}
	elseif(strlen($new_pass) < 6)
	{
		header("Location:password.php?error");
	}
	else
	{
		$check = $db->numrows("SELECT * FROM mlm_admin WHERE admin_id='1' AND admin_password='$current_pass'");

		if($check == 1)
		{
			$update = $db->insertrec("UPDATE mlm_admin SET admin_username='$username',admin_password='$new_pass' WHERE admin_id='1'");
			if($update)
			{
				header("Location:password.php?success");
				echo "<script>window.location='password.php?success';</script>";
				exit;
			}
		}
	}
}
 ?>

<script language="javascript">
function passvalidate()
{
	// cur_pass current_pass new_pass con_new_pass //
    var username=document.getElementById('username').value;
	var cur_pass = document.getElementById('cur_pass').value;
	var current_pass = document.getElementById('current_pass').value;
	var new_pass = document.getElementById('new_pass').value;
	var con_new_pass = document.getElementById('con_new_pass').value;
	
	if(username=="")
	{
	
	alert("Please Enter the Admin Username");
	document.getElementById('username').focus();
	return false;
	
	}
	
	
	if(current_pass == "") // ----- check current password not null -----
	{
		alert("Enter your current password.");
		document.getElementById('current_pass').focus();
		return false;
	}
	
	
	if(current_pass != cur_pass) // ----- check current password correct or not -----
	{
		alert("Enter your correct current password.");
		document.getElementById('current_pass').value = "";
		document.getElementById('current_pass').focus();
		return false;
	}
	
	if(new_pass == "") // ----- check New password not null -----
	{
		alert("Enter your new password to change.");
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(con_new_pass == "") // ----- check confirm password not null -----
	{
		alert("Enter your new password again for verification.");
		document.getElementById('con_new_pass').focus();
		return false;
	}
	
	
	if(new_pass == cur_pass) // ----- check current password and new password are same -----
	{
		alert("Your New pasword and Old password are same,\nChange your new password.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(new_pass.length < 6) // ----- check new password length -----
	{
		alert("Your new password is too short,\nEnter above 6 letters.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	if(con_new_pass != new_pass) // ----- check new password length -----
	{
		alert("Your new password and confirm password are not same,\nPlease try again.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	var tmp = new_pass.search(" ");
	//	alert(tmp);
	if(tmp >= 0) // ----- check new password not have empty space -----
	{
		alert("Space not allowed in password.");
		document.getElementById('new_pass').value = "";
		document.getElementById('con_new_pass').value = "";
		document.getElementById('new_pass').focus();
		return false;
	}
	
	
	//alert(cur_pass+", "+current_pass+", "+new_pass+", "+con_new_pass);
	//return false;
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
							Site Settings

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Change Password</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Site Settings
							<small>
								<i class="icon-double-angle-right"></i>
								Change Password
							</small>
						</h1>
					</div><!--/.page-header-->
                         
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
                           
						  <?php 
						   
						   if(isset($_REQUEST['success']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Password Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
							<form class="form-horizontal" name="pass" action="" method="post" onSubmit="return passvalidate();">
								<div class="control-group">
									<label class="control-label" for="form-field-1">Admin Username <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="username" id="username" value="<?php echo $sel_login['admin_username']; ?>"/>
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Current Password <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="password" name="current_pass" id="current_pass" />
										<input type="hidden" name="cur_pass" id="cur_pass" value="<?php echo  $sel_login['admin_password']; ?>" />
									</div>
								</div>	
								
                             	<div class="control-group">
									<label class="control-label" for="form-field-1">New Password <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="password" name="new_pass" id="new_pass" />
									</div>
								</div>	
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Confirm Password <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="password" name="con_new_pass" id="con_new_pass" />
									</div>
								</div>	
														
								
								<div class="form-actions">
							
							<input type="submit" <?php if ($demomode=='true') {?>  name="" onclick="return demo()" <? } else { ?> name="submit" <? } ?> value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
								
									&nbsp; &nbsp; &nbsp;
									
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									</div>

								<div class="hr"> </div>

								<!--/row-->


								<!--/row-->

							
								
							</form>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>


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
