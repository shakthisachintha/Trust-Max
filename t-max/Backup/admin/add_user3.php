<?php
include("AMframe/config.php");
include("includes/header.php");
include("../pairing-capping.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

if(!isset($_REQUEST['step2']))
{
header("location:add_user2.php?uid='$_REQUEST[uid]'");
}

$menu6='class="active"';

if(isset($_REQUEST['submit']))
{
	$uid=addslashes($_REQUEST['uid']);
	$nname=addslashes($_REQUEST['nname']);
	$ncountry=addslashes($_REQUEST['ncountry']); 
	$nstate=addslashes($_REQUEST['nstate']);
	$ncity=addslashes($_REQUEST['ncity']);
	$nzipcode=addslashes($_REQUEST['nzipcode']);
    $nphone=addslashes($_REQUEST['nphone']);
	$nemail=addslashes($_REQUEST['nemail']);
	$naddr1=addslashes($_REQUEST['naddr1']);
	$naddr2=addslashes($_REQUEST['naddr2']);
		
	$ncnumber=addslashes($_REQUEST['ncnumber']);
	if($_REQUEST['icid']=="others")
	{
	$nct=addslashes($_REQUEST['nctype']);
	}
	else
	{
	$nct=addslashes($_REQUEST['icid']);
	}
	
	$insert=$db->insertrec("update mlm_register set user_nomineename='$nname',user_identifycardtype='$nct',user_idnumber='$ncnumber',user_naddr1='$naddr1',user_naddr2='$naddr2',user_ncountry='$ncountry',user_nstate='$nstate',user_ncity='$ncity',user_npostalcode='$nzipcode',user_nphone='$nphone',user_nemail='$nemail' where user_id='$uid'");
	
	//rank updation
	updateRank($rank_type);
	
	$sel=$db->singlerec("select * from mlm_register where user_id='$uid'");
	$prooofid=$sel['user_profileid'];
	$userremail=$sel['user_email'];
	$pasdsdf=$sel['user_password'];
	
	//Referral Bonus
	$com_obj->refBonus($prooofid, $mem_pack_amt);
	
	//level bonus
	$com_obj->lvl_commission($prooofid);
	
	//Pair capping bonus
	pairing_carry($prooofid);
	
	
	$subject="Login details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid (or) $userremail </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $pasdsdf</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$website_url/login.php?activate=".$prooofid."' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>Click Here</a></td>
						</tr>
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$to=$userremail;
$com_obj->commonMail($to,$subject,$msg);
	
	if($insert)
	 {
	 header("Location:user.php?success"); 
	 ?>
	<script>
	window.location="user.php?success";
	</script>	
	<?php
	
	}
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
<script>
function showstate1(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication country");
  document.getElementById("ncontry").focus();
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
    document.getElementById("nstatee").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","state_ajax3.php?q="+str,true);
xmlhttp.send();
}
</script>

<script>
function cityshow1(str)
{
//alert("gfhfg");

if (str=="")
  {
  alert("Please choose the communication State");
  document.getElementById("nstate").focus();
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
    document.getElementById("ncityy").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","city_ajax3.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>

function card(val)
{
if(val=='others')
{
document.getElementById('carrrrdtype').style.display="block";

}
else
{

document.getElementById('carrrrdtype').style.display="none";
}


}

</script>

<script>
function nvalidate()
{
 if(document.getElementById('nname').value=="")
 {
 alert("Please Enter Nominee Name");
 document.getElementById('nname').focus();
 return false;
 
 }

 if(document.getElementById('ncnumber').value=="")
 {
 alert("Please Enter identity card Number");
 document.getElementById('ncnumber').focus();
 return false;
 
 }

 if(document.getElementById('nphone').value=="")
 {
 alert("Please Enter Phone Number");
 document.getElementById('nphone').focus();
 return false;
 
 }

 if(document.getElementById('nemail').value=="")
 {
 alert("Please Enter the email address");
 document.getElementById('nemail').focus();
 return false;
 
 }
 else
	{
	var re=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	if(re.test(document.getElementById('nemail').value)==false)
	{
	alert("Enter the Valid Email Address");
	document.getElementById('nemail').focus();
	document.getElementById('nemail').value = "";
	return false;
	}
	
	}
	
	
 if(document.getElementById('naddr1').value=="")
 {
 alert("Please Enter the address");
 document.getElementById('naddr1').focus();
 return false;
 
 }	
 
  if(document.getElementById('ncountry').value=="")
 {
 alert("Please Enter the country");
 document.getElementById('ncountry').focus();
 return false;
 
 }	
 
  /*  if(document.getElementById('nstate').value=="")
 {
 alert("Please Enter the state");
 document.getElementById('nstate').focus();
 return false;
 
 }	
 
    if(document.getElementById('ncity').value=="")
 {
 alert("Please Enter the city");
 document.getElementById('ncity').focus();
 return false;
 
 } */
 
   if(document.getElementById('nzipcode').value=="")
 {
 alert("Please Enter the zipcode");
 document.getElementById('nzipcode').focus();
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
							<a href="user.php">Users</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Add User</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						ADD USERS
						
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
					
					<div>
					<div style="float:left;">
					<span class="label label-info label-large arrowed-in-right" style="padding:14px; width:200px; font-size:16px;">1.Basic Details</span>
					</div>
					
					<div style="float:left;">
					<span class="label label-info label-large arrowed-in-right arrowed-in"  style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;2. Personal Details</span>
					</div>
					
					<div style="float:left;">
					<span class="label label-info label-large arrowed-in"  style="padding:14px; width:200px; font-size:16px;">&nbsp;&nbsp;&nbsp;3.Nominee Details</span>
					</div>
					
					<div style="clear:both;">&nbsp;</div>
					</div>
			
						
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return nvalidate();" enctype="multipart/form-data" />
								<div class="control-group">
									<label class="control-label" for="form-field-1"> Nominee Name &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="nname" id="nname" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="form-field-2">Identity Card Type &nbsp;<span style="color:#FF0000;">*</span> : </label>

								  <div class="controls">
					<input type="radio" name="icid" id="vcid" style="opacity:1;" value="Voters ID" onclick="return card(this.value);" checked="checked"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voters ID <input type="radio" name="icid" id="pcid" style="opacity:1;" value="PAN Card" onclick="return card(this.value);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAN Card  <input type="radio" name="icid" id="psid" style="opacity:1;" value="Passport" onclick="return card(this.value);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passport  <input type="radio" name="icid" id="dlid" style="opacity:1;" value="Driving License" onclick="return card(this.value);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Driving License  
					<input type="radio" name="icid" id="otid" style="opacity:1;" value="others" onclick="return card(this.value);"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Others	</div>
								</div>
								
								<div class="control-group" id="carrrrdtype" style="display:none;">
									<label class="control-label" for="form-field-2">Enter Card type &nbsp;<span style="color:#FF0000;">*</span> : </label>

								  <div class="controls">
				<input type="text" name="nctype" id="nctype" />
					</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-2">Identity Card Number &nbsp;<span style="color:#FF0000;">*</span> : </label>

								  <div class="controls">
				<input type="text" name="ncnumber" id="ncnumber" />
					</div>
								</div>
									
								<div class="control-group">
									<label class="control-label" for="form-field-1">Phone &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="nphone" id="nphone" />
									</div>
								</div>	
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Email &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="nemail" id="nemail" />
									</div>
								</div>		
								
								
								
                                   <div class="control-group">
						
							<label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Communication Address </label>

						  </div>


								<div class="control-group">
									<label class="control-label" for="form-field-1">Address 1 &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="naddr1" id="naddr1" />
									</div>
								</div>

							<div class="control-group">
									<label class="control-label" for="form-field-1">Address 2 &nbsp;&nbsp;: </label>

									<div class="controls">
										<input type="text" name="naddr2" id="naddr2" />
									</div>
						  </div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Country &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<select name="ncountry" id="ncountry" onchange="return showstate1(this.value);">
									<option value="">--- Choose Country ---</option>
									<?php 
									
									$sqlcon=$db->get_all("select * from mlm_country where country_status='1' order by country_name asc");
									foreach($sqlcon as $rowcountry)
									{
									?>
									<option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>
									
									<?php } ?>
										
										</select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">State : </label>

									<div class="controls" id="nstatee">
										<select name="nstate" id="nstate" onchange="return cityshow1(this.value);">
                             <option value="">--- Choose State ---</option>
							 	
							 </select>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">City : </label>

									<div class="controls" id="ncityy">
										<select name="ncity" id="ncity" >
                             <option value="">--- Choose City ---</option>
							 </select>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Postal Code &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="nzipcode" id="nzipcode" />
									</div>
								</div>	
							
							<input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['uid']; ?>" />

								<div class="form-actions">
							<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									
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
