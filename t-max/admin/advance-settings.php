<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']=="")) {
	header("location:index.php");
	echo "<script>window.location='index.php';</script>";
}

$menu7='class="active"';

if(isset($adv_frmsubmit)) {
	$idprefix = addslashes($idprefix);
	$epin_sts = addslashes($epin_sts);
	$leg_select = addslashes($leg_select);
	$rank = addslashes($rank);
	$referral_payout_sts = addslashes($referral_payout_sts);
	$level_payout_sts = addslashes($level_payout_sts);
	$capping_payout_sts = addslashes($capping_payout_sts);
	$wallet_withdraw_sts = addslashes($wallet_withdraw_sts);
	$email_content = addslashes($email_content);
	
	$set = "id_prefix='$idprefix'";
	$set .= ",epin_status='$epin_sts'";
	$set .= ",leg_selection='$leg_select'";
	$set .= ",rank_type='$rank'";
	$set .= ",referral_payout_status='$referral_payout_sts'";
	$set .= ",level_payout_status='$level_payout_sts'";
	$set .= ",capping_payout_status='$capping_payout_sts'";
	$set .= ",welcome_mail_content='$email_content'";
	
	$row_ct = $db->numrows("select * from mlm_business_settings");
	if($row_ct == 0) {
		$db->insertrec("insert into mlm_business_settings set $set");
	}
	else {
		$db->insertrec("update mlm_business_settings set $set where id='1'");
	}
	header("location:advance-settings.php?suc");
	echo "<script>window.location='advance-settings.php?suc';</script>";
	exit;
}
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
						
						 <?php if(isset($_REQUEST['suc'])) { ?> 					  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok green"></i>
								<strong class="green">
									Settings Updated Successfully !!!
								</strong>
							</div>
						   <?php } if(isset($_REQUEST['req'])) { ?> 					  
						   <div class="alert alert-block alert-info">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>
							 <i class="icon-ok blue"></i>
								<strong class="blue">
									Kindly enable the E-pin !!!
								</strong>
							</div>
						   <?php } ?>
							<!--PAGE CONTENT BEGINS-->
							<form class="form-horizontal" method="post" action="">
								<div class="control-group">
									<label class="control-label" for="form-field-1">Profile Id Prefix<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="idprefix" id="idprefixId" value="<?php echo $id_prefix; ?>" required />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Epin <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="epin_sts" value="enabled" <?php if($epin_status == "enabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Enable</span>
										<input type="radio" style="opacity:inherit;" class="stylecls" name="epin_sts" value="disabled" <?php if($epin_status == "disabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Disable</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Leg Selection <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="leg_select" value="default" <?php if($leg_selection == "default") echo "checked";?> /><span style="margin-left: 28px;margin-right: 10px;">Default</span>
										<input type="radio" style="opacity:inherit;" name="leg_select" value="manual" <?php if($leg_selection == "manual") echo "checked";?> /><span style="margin-left: 28px;margin-right: 10px;">Manual</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Rank (Based On) <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="rank" value="referral_ct" <?php if($rank_type == "referral_ct") echo "checked";?> /><span style="margin-left: 28px;margin-right: 10px;">Referral Count</span>
										&nbsp;<input type="radio" style="opacity:inherit;" name="rank" value="referral_pack_sum" <?php if($rank_type == "referral_pack_sum") echo "checked";?> /><span style="margin-left: 28px;margin-right: 10px;">Pack Purchased by Referral User</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Referral Payout <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="referral_payout_sts" value="enabled" <?php if($referral_payout_status == "enabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Enable</span>
										<input type="radio" style="opacity:inherit;" class="stylecls" name="referral_payout_sts" value="disabled" <?php if($referral_payout_status == "disabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Disable</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">level Payout <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="level_payout_sts" value="enabled" <?php if($level_payout_status == "enabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Enable</span>
										<input type="radio" style="opacity:inherit;" class="stylecls" name="level_payout_sts" value="disabled" <?php if($level_payout_status == "disabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Disable</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Pair Capping Payout <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="capping_payout_sts" value="enabled" <?php if($capping_payout_status == "enabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Enable</span>
										<input type="radio" style="opacity:inherit;" class="stylecls" name="capping_payout_sts" value="disabled" <?php if($capping_payout_status == "disabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Disable</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Wallet Withdraw <span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="radio" name="wallet_withdraw_sts" value="enabled" <?php if($wallet_withdraw_status == "enabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Enable</span>
										<input type="radio" style="opacity:inherit;" class="stylecls" name="wallet_withdraw_sts" value="disabled" <?php if($wallet_withdraw_status == "disabled") echo "checked";?> ><span style="margin-left: 28px;margin-right: 10px;">Disable</span>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="form-field-1">Welcome Email Content<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<textarea name="email_content" id="email_contentid" class="tiny"><?php echo stripslashes($welcome_mail_content); ?></textarea>
									</div>
								</div>
								
								<div class="form-actions">
									<input type="submit" <?php if ($demomode=='true') {?>  name="" onclick="return demo()" <? } else { ?> name="adv_frmsubmit" <?php } ?> value="SUBMIT" class="btn btn-info" style="font-weight:bold;" onClick="return advsettingValid();" />&nbsp; &nbsp; &nbsp;
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
function advsettingValid() {
	var idprefixId = document.getElementById("idprefixId").value;
	var email_content = document.getElementById("email_content").value;
	
	if(idprefixId == "") {
		alert("Enter the Profile Id Prefix");
		document.getElementById("idprefixId").focus();
		return false;
	}
	if(document.getElementByName("epin_sts").checked == false) {
		alert("Choose Epin status");
		return false;
	}
	if(document.getElementByName("leg_selection").checked == false) {
		alert("Choose Leg Selection");
		return false;
	}
	if(document.getElementByName("rank_type").checked == false) {
		alert("Choose the Rank Type");
		return false;
	}
	if(document.getElementByName("referral_payout_sts").checked == false) {
		alert("Choose the Referral Payout Status");
		return false;
	}
	if(document.getElementByName("level_payout_sts").checked == false) {
		alert("Choose the Level Payout Status");
		return false;
	}
	if(document.getElementByName("capping_payout_sts").checked == false) {
		alert("Choose the Pair Capping Payout Status");
		return false;
	}
	if(document.getElementByName("wallet_withdraw_sts").checked == false) {
		alert("Choose the Wallet Withdraw Status");
		return false;
	}
	if(email_content == "") {
		alert("Enter the Welcome Email Content");
		document.getElementById("email_content").focus();
		return false;
	}
}
</script>
	</body>
</html>