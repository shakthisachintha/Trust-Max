<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu17='class="active"';

if(isset($_REQUEST['reqreply']))
{

$id=addslashes($_REQUEST['reqreply']);

$reqfet=$db->singlerec("select * from mlm_withdrawrequsets where req_id='$id'");
$userfet=$db->singlerec("select * from mlm_register where user_id='$reqfet[req_userid]'");

$email=$userfet['user_email'];
$name=$userfet['user_fname'];

$useramt=$userfet['accumulated_bv'];
$reqamt=$reqfet['req_cvamount'];

$balamt=$useramt-$reqamt;

$subject="Withdrawal request reply ".$website_name;

$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Reply from the ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Requested amount Rs.$reqamt transferred to your account, please check it.</td>
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

$to=$email;
$com_obj->commonMail($to,$subject,$msg);

$reqType = 2;
if($_REQUEST['reqType'] == a){
	$reqType = 1;
}else{
	$reqType = 2;
}
$cou=$db->insertrec("update mlm_withdrawrequsets set req_rpstatus='$reqType' where req_id='$id'");
//$user=$db->insertrec("update mlm_register set accumulated_bv='$balamt' where user_id='$reqfet[req_userid]'");
if($cou){
	header("location:withdraw_request.php?upsucc");
	echo "<script>window.location='withdraw_request.php?upsucc';</script>";
}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_withdrawrequsets where req_id='$id'");

if($det)
{

header("location:withdraw_request.php?del");

echo "<script>window.location='withdraw_request.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_withdrawrequsets where req_id='$del_id'";
$result = $db->insertrec($sql);

}

if($result){?> <script>
window.location="withdraw_request.php?del";
</script> <?php
}
 }

?>
 
 	<script>
	function muldel()
	{
	//alert("df");
	var chks = document.getElementsByName('chkval[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one.");
        return false;
    }
    return true;
	
	}
	
	</script>
 
 <style type="text/css">
		.black_overlay{
			display:none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 200%;
			background-color: black;			
			z-index:1001;
			-moz-opacity: 0.7;
			opacity:.570;
			filter: alpha(opacity=70);
		}
		.white_content {
		display:none;
			position: absolute;
			top: 20%;
			left: 25%;
			width: 50%;
			height:60%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1050;
			overflow: auto;
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
	
	function test_validate()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title').value=="")
	{
	alert("Please Enter the title");
	document.getElementById('title').focus();
	return false;
	
	}
	
		if(document.getElementById('comment').value=="")
	{
	alert("Please Enter the comment");
	document.getElementById('comment').focus();
	return false;
	
	}
	
	}
	
	
	</script>
	<style type="text/css">
 a.tooltip 
 {
 outline:none;
 opacity: 1;
  } 
 a.tooltip strong 
 {
 line-height:30px;
 } 
 a.tooltip:hover 
 {
 text-decoration:none;
 } 
 a.tooltip span 
 {
  z-index:10;display:none; 
  padding:14px 20px;
   margin-top:-30px; 
   margin-left:28px; 
   width:240px;
    line-height:16px;
	 } 
	 a.tooltip:hover span
	 { 
	 display:inline;
	  position:absolute; 
	 color:#111;
	  border:1px solid #DCA;
	   background:#fffAF0;} 
	   .callout {
	   z-index:20;
	   position:absolute;
	   top:30px;
	   border:0;
	   left:-12px;
	   } 
	   /*CSS3 extras*/
	    a.tooltip span { 
		border-radius:4px;
		 -moz-border-radius: 4px;
		  -webkit-border-radius: 4px; 
		  -moz-box-shadow: 5px 5px 8px #CCC;
		   -webkit-box-shadow: 5px 5px 8px #CCC;
		    box-shadow: 5px 5px 8px #CCC;
			 }
 </style>
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
						<li class="active">Withdraw Requests </li>
					</ul><!--.breadcrumb-->
					<!--#nav-search-->
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							   
						   <?php 
						   
						   if(isset($_REQUEST['upsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									 Amount Transferred Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['del']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
									Request Deleted Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['inactsucc']))
						   {
						  ?> 
						  
						<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Feedback Unblocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['actsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									Feedback blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                          <form action="" method="post">
						  
							<div class="row-fluid">
								
								<div class="table-header">
								Withdraw Request Management
								
								<span style="float:right; padding-right:5px;"></span>
								
								</div>

								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="24" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="37">Sl.No</th>
											
										    <th width="91">Name</th>											 
											 <th width="207" >Message</th>
											 
											 <th width="100" >Amount</th>
											 <th width="100" >TDS(%)</th>
											 
											 <th width="86" >Date</th>
											 <th width="70" >Ip</th>
											<th width="105">Status</th>
											<th width="105">Action</th>
                                         
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$req=$db->get_all("select * from mlm_withdrawrequsets where req_status=0 order by req_id desc");
									$i=1;
									$num=$db->numrows("select * from mlm_withdrawrequsets where req_status=0 order by req_id desc");
									
									foreach($req as $row_req)
									{
				 $req_user=$db->singlerec("select * from mlm_register where user_id='$row_req[req_userid]'");
									?>
									
										<tr>
									
											<td class="center">
												<label>
				<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_req['req_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $req_user['user_fname']; ?></td>
											
											<td><?php echo $row_req['req_message']; ?></td>
											
											<td><?php echo $row_req['req_cvamount']; ?></td>
											
											<td><?php echo $row_req['tds_percent']; ?></td>
											
											<td><?php echo $row_req['req_date']; ?></td>
											
											<td><?php echo $row_req['req_ip']; ?></td>					

											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
												<?php if($row_req['req_rpstatus']=='0') { ?>
													<a  href="withdraw_request.php?reqType=a&&reqreply=<?php echo $row_req['req_id']; ?>" >
														Approve
													</a>
													<a href="withdraw_request.php?reqType=r&&reqreply=<?php echo $row_req['req_id']; ?>" >
														Reject
													</a>
												<?php } elseif($row_req['req_rpstatus'] == 2) {?>
													<span class="red" >Rejected</span>
												<?php } else {?>
													<span class="green" >Transferred</span>
												<?php } ?>
													
												</div>
											</td>

											<td>
											<div class="hidden-phone visible-desktop action-buttons">
												<a class="grey" href="withdraw_request.php?delete=<?php echo $row_req['req_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
													<i class="icon-trash bigger-130" title="click to delete"></i>
												</a>
											</div>
											
							
											
										</tr>
										
		
									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								
								
								<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
							
								</div>
								</form>

							</div><!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

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

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			       { "bSortable": false },  { "bSortable": false }, { "bSortable": false },  { "bSortable": false },  { "bSortable": false }, { "bSortable": false }, { "bSortable": false },{ "bSortable": false },
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
		
 
    <div id="light1"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return test_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Reply Feedback</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Subject </td>
								<td> : </td>
								<td><input type="text" name="subject" id="subject" /></td>
								</tr>
								
									<tr>
								<td>Message </td>
								<td> : </td>
								<td><textarea name="message" id="message"></textarea></td>
								</tr>
								
								
								<input type="hidden" name="id" id="tid" />
								<input type="hidden" name="email" id="emaiii" />
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop1();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade1" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop1(val,emai)
	{
    // alert(name);
	 	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('tid').value=val;
	document.getElementById('emaiii').value=emai;

	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop1()
	{
	
	document.getElementById('light1').style.display='none';
	document.getElementById('fade1').style.display='none'; 
	}
	
	</script>
	
	</body>
</html>
