<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu6='class="active"';

if(isset($_REQUEST['submit'])) {
	$name = addslashes($_REQUEST['sname']);
	$sponserid = addslashes($_REQUEST['sid']); 
    $password=addslashes($_REQUEST['pass1']);
	$pid=addslashes($_REQUEST['placeid']);
	$pancard=addslashes($_REQUEST['pancard']);
	$user_position = isset($_REQUEST['position']) ? addslashes($_REQUEST['position']) : '';
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$epin = isset($_REQUEST['epin']) ? addslashes($_REQUEST['epin']) : '';
	$mpack = isset($_REQUEST['mpack']) ? addslashes($_REQUEST['mpack']) : '';
	
	$profileid=generateid();
	
	if(empty($user_position)) {
		$placeid_count = $db->singlerec("select count(*) as ct from mlm_register where user_placementid='$pid'");
		if($placeid_count['ct'] == 0) {
			$user_position = 'Left';
		}
		else {
			$user_position = 'Right';
		}
	}
	
	if(!empty($epin)) {
		$epin_check=$db->singlerec("select count(*) as ct from mlm_epin where epin='$epin' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null)");
		if($epin_check['ct'] > 0) {
			$epinavail = $db->singlerec("select * from mlm_epin where epin='$epin' and (profile_id='' or profile_id is null) and (purchased_user='' or purchased_user is null)");
			$mem_pack = $epinavail['member_pack'];
			
			$db->insertrec("update mlm_epin set profile_id='$profileid',purchased_user='$sponserid' where id='$epinavail[id]'");
		}
		else {
			echo "<script>location.href='add_user1.php?invalid';</script>";
			header("location:add_user1.php?invalid");
			exit;	
		}
	}
	else {
		$mem_pack = $mpack;
	}
	
	$insert=$db->insertid("insert into mlm_register(user_sponsername,user_sponserid,user_profileid,epin,user_password,user_placementid,user_position,user_pancard,user_poster,user_date,user_ip,user_status,mem_package,user_paymentstaus) values ('$name','$sponserid','$profileid','$epin','$password','$pid','$user_position','$pancard','admin',NOW(),'$ip','0','$mem_pack','1')");
	
	$payment_id = rand(00000,99999);
	$memInfo = $db->singlerec("select act_amount,days from mlm_membership where id='$mem_pack'");
	$mem_pack_amt = $memInfo['act_amount'];
	$dayys = $memInfo['days'];
	$exdate = date('Y-m-d', strtotime(date('Y-m-d')." + ". $dayys." days")); 
	$date_time = date("Y-m-d h:i:s");
	$set="profileid='$profileid'";
	$set.=",payment_id='$payment_id'";
	$set.=",pack='$mem_pack'";
	$set.=",amount='$mem_pack_amt'";
	$set.=",paidamt='$mem_pack_amt'";
	$set.=",status='Completed'";
	$set.=",ip_address='$ip'";
	$set.=",pay_type='manual'";
	$set.=",created_at='$date_time'";
	$set.=",modified_at='$date_time'";
	$set.=",ex_date='$exdate'";
	$db->insertrec("insert into mlm_mempayments set $set");
	
	echo "<script>location.href='add_user2.php?uid=$insert&step1';</script>";
	header("location:add_user2.php?uid=$insert&step1");
	exit;
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

<script>
function uservalidate1()
{

if(document.getElementById('sid').value=="")
{
alert("please enter the sponser id");
document.getElementById('sid').focus();
return false;

}

if(document.getElementById('pass1').value=="")
{
alert("please enter the Password");
document.getElementById('pass1').focus();
return false;

}

if(document.getElementById('pass2').value=="")
{
alert("please enter the Confirm-Password");
document.getElementById('pass2').focus();
return false;

}


if(document.getElementById('pass1').value!=document.getElementById('pass2').value)
{
alert("Password not Match !!!");
document.getElementById('pass2').value='';
document.getElementById('pass2').focus();
return false;
}


}

</script>

<script>
function getuser(str)
{
//alert("gfhfg");
if (str=="")
  {
  alert("Please enter the sponser name");
  document.getElementById("sname").focus();
  return false;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
    document.getElementById("spid").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getsid.php?q="+str,true);
xmlhttp.send();
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
							<a href="user.php">Users</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Add Users</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						ADD USERS
						
						</h1>
					</div><!--/.page-header-->
<?php 
						   
						   if(isset($_REQUEST['invalid']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
									Invalid Epin...!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   <?php 
						   
						   if(isset($_REQUEST['empty']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
								Invalid Epin....!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
					<div class="row-fluid">
					
					<div style="padding-left:20px;">
					<div style="float:left;">
					<span class="label label-info label-large arrowed-in-right" style="padding:14px; width:200px; font-size:16px;">1.Basic Details</span>
					</div>
					
					<div style="float:left;">
					<span class="label label-large label-light arrowed-in-right arrowed-in" style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;2. Personal Details</span>
					</div>
					
					<div style="float:left;">
					<span class="label label-large label-light arrowed-in" style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;3.Nominee Details</span>
					</div>
					
					<div style="clear:both;">&nbsp;</div>
					</div>
					
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return uservalidate1();">
						<?php if($epin_status == "enabled") {?>
                            <div class="control-group">
								<label class="control-label" for="form-field-2">Epin &nbsp;<span style="color:#FF0000;">*</span> : </label>
								<div class="controls">
									<span id="spid"><input type="text" name="epin" id="epin"/></span>
								</div>
							</div>
						<?php } else {?>
							<div class="control-group">
								<label class="control-label" for="form-field-2">Member Pack &nbsp;<span style="color:#FF0000;">*</span> : </label>
								<div class="controls">
									<span id="spid">
										<select name="mpack" required>
											<option value="">Choose Member Pack </option>
											<?php
											$packDets = $db->get_all("select * from mlm_membership where status='1' order by act_amount asc");
											foreach($packDets as $packDet) {
											?>
											<option value="<?php echo $packDet['id'];?>">
												<?php echo ucfirst($packDet['membership_name']);?>
											</option>
											<?php } ?>
										</select>
									</span>
								</div>
							</div>
						<?php } ?>
							
								<? $getDet = $db->singlerec("select * from mlm_register where user_id='1'"); ?>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Sponser id &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<span id="spid"><input type="text" name="sid" id="sid" onBlur="usrplacement(this.value);"/></span>
										<span style="color:#999999"> Ex : <? echo $getDet['user_profileid'];?></span>
									</div>
									
									<span id="err" style="margin-bottom:16px; color: red; padding: 0 5px;"></span>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Sponser Name &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="sname" id="sname" readonly />
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Placement Id &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<span>
										<input type="text" name="placeid" id="placeid" readonly/>
										</span>
									</div>
								</div>
								<?php if($leg_selection == "manual") {?>
								<div class="control-group">
									<label class="control-label" for="form-field-1">User Position : </label>
									<div class="controls">
										<span id="lrid"><!--both -->
											<input type="radio" name="position" value='Left'> 
												<span style="margin-left: 28px;margin-right: 10px;">Left&nbsp;&nbsp;&nbsp;</span>
											<input type="radio" name="position" value='Right'> 
												<span style="margin-left: 28px;margin-right: 10px;">Right</span>
										</span>
										<span class="hidden" id="lid" style="margin-top: 16px;">
											<input type="radio" name="position" value='Left'> 
												<span style="margin-left: 28px;margin-right: 10px;">Left</span>
										</span>
										<span class="hidden" id="rid" style="margin-top: 16px;">
											<input type="radio" name="position" value='Right'> 
												<span style="margin-left: 28px;margin-right: 10px;">Right</span>
										</span>
									</div>
								</div>
                                <?php } ?>
								<div class="control-group">
									<label class="control-label" for="form-field-2">Password &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="password" name="pass1" id="pass1" />
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="form-field-2">Confirm Password &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<input type="password" name="pass2" id="pass2" />
									
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-2">PAN Card Number &nbsp; : </label>

									<div class="controls">
									<input type="text" name="pancard" id="pancard" />
									
									</div>
								</div>
			

								<div class="form-actions">
								<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									&nbsp; &nbsp; &nbsp;
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>
	
							</form>
							</div>
						

							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->
		
		<script>
		function usrplacement(spnsrid) {
			if(spnsrid!="") {
				document.getElementById("err").innerHTML='<img src="../images/ajax_loading.gif"/>';
				$.ajax({
					type: 'POST',
					url: "getplacement.php",
					data: {spnsrid:spnsrid},
					dataType: "text",
					success: function(result) {
						var result=JSON.parse(result);
						if(result=="0") {
							document.getElementById("err").innerHTML='Invalid Sponsor ID';
							document.getElementById("sid").value='';
						}
						else {
							document.getElementById("err").innerHTML='';
							document.getElementById("sname").value=result.name;
							document.getElementById("placeid").value=result.placement;
						}
					}
				});
				<?php if($leg_selection == "manual") {?>
				$.ajax({
					type: 'POST',
					url: "getposition.php",
					data: {spnsrid:spnsrid},
					dataType: "text",
					success: function(result) {
					 var trimmedResponse = $.trim(result)
						if(trimmedResponse=="1") {
							//show right
							$('#lrid').addClass('hidden');
							$('#lrid').addClass('hidden');
							$('#rid').removeClass('hidden');
							
						}
						else if(trimmedResponse=="2") {
							//show left
							$('#lid').removeClass('hidden');
							$('#lrid').addClass('hidden');
							document.getElementById("lid").style.display='block';
							document.getElementById("rid").style.display='none';
							document.getElementById("lrid").style.display='none';
						}
						else if(trimmedResponse=="3") {
							//show both left & right
							$('#lid').addClass('hidden');
							$('#rid').addClass('hidden');
							$('#lrid').removeClass('hidden');
							document.getElementById("lid").style.display='none';
							document.getElementById("rid").style.display='none';
							document.getElementById("lrid").style.display='block';
							$('#lrid').css('margin-top','17px');
						}
					}
				});
				<?php } ?>
			}
		}
		</script>

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
