<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu9='class="active"';

if(isset($_REQUEST['update']))
{
$id=addslashes($_REQUEST['id']);

$title=addslashes($_REQUEST['title']);
$comment=addslashes($_REQUEST['comment']);
$tstimg=addslashes($_REQUEST['tstimg']);
$username=addslashes($_REQUEST['username']);

$cou=$db->insertrec("update mlm_testimonial set test_title='$title',test_comment='$comment', test_user='$username' where test_id='$id'");
/* image function start*/
if($_FILES['testmonial_img']['tmp_name'] != "" && $_FILES['testmonial_img']['tmp_name'] != "null") {
	$fpath = $_FILES['testmonial_img']['tmp_name'] ;
	$fname = $_FILES['testmonial_img']['name'] ;
	$getext = substr(strrchr($fname, '.'), 1);
	$ext = strtolower($getext);
	if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png"){
		if($tstimg !=""){
			$cou=$db->insertrec("update mlm_testimonial set testmonial_img='$tstimg' where test_id='$id'");
			$RemoveImage = "../uploads/testmonial_img/$tstimg";
			@unlink($RemoveImage);
		}
		$imageInformation = getimagesize($fpath);
		$imageWidth = $imageInformation[0]; 
		$imageHeight = $imageInformation[1];
		if($imageWidth <= 500 && $imageHeight <= 500){
			$NgImg = "tst".date("dmY")."-".rand("100","999").".".$ext;
			$des = "../uploads/testmonial_img/$NgImg";
			move_uploaded_file($fpath,$des) ;
			chmod($des,0777);
			$db->insertrec("update mlm_testimonial set testmonial_img='$NgImg' where test_id='$id'");
		}
		else
		{
		echo "<script>alert('image size should be 204*204');</script>";
		header("location:testimonial.php?inactimg");
        echo "<script>window.location='testimonial.php?inactimg';</script>";
        exit;
		}
	}
}
/* image function end*/

if($cou)
{

header("location:testimonial.php?upsucc");

echo "<script>window.location='testimonial.php?upsucc';</script>";

}

}
if(isset($_REQUEST['add']))
{

$title=addslashes($_REQUEST['title1']);
$comment=addslashes($_REQUEST['comment1']);
$username1=addslashes($_REQUEST['username1']);

$ip=$_SERVER['REMOTE_ADDR'];
$cou=$db->insertid("insert into mlm_testimonial set test_title='$title',test_comment='$comment', test_user='$username1',test_date=NOW(),test_ip='$ip' ");
/* image function start*/
if($_FILES['testmonial_img']['tmp_name'] != "" && $_FILES['testmonial_img']['tmp_name'] != "null") {
	$fpath = $_FILES['testmonial_img']['tmp_name'] ;
	$fname = $_FILES['testmonial_img']['name'] ;
	$getext = substr(strrchr($fname, '.'), 1);
	$ext = strtolower($getext);
	if($ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "png"){
		$imageInformation = getimagesize($fpath);
		$imageWidth = $imageInformation[0]; 
		$imageHeight = $imageInformation[1];
		if($imageWidth < 504 && $imageHeight < 504){
			$NgImg = "tst".date("dmY")."-".rand("100","999").".".$ext;
			$des = "../uploads/testmonial_img/$NgImg";
			move_uploaded_file($fpath,$des) ;
			chmod($des,0777);
			$db->insertrec("update mlm_testimonial set testmonial_img='$NgImg' where test_id='$cou'");
		}
		else
		{
		echo "<script>alert('image size should be 204*204');</script>";
		header("location:testimonial.php?inactimg");
        echo "<script>window.location='testimonial.php?inactimg';</script>";
		exit;
		}
	}
}
/* image function end*/

if($cou)
{

header("location:testimonial.php?succ");

echo "<script>window.location='testimonial.php?succ';</script>";

}

}

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);

$act=$db->insertrec("update mlm_testimonial set test_status='1' where test_id='$id'");

if($act)
{

header("location:testimonial.php?actsucc");

echo "<script>window.location='testimonial.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$act=$db->insertrec("update mlm_testimonial set test_status='0' where test_id='$id'");

if($act)
{

header("location:testimonial.php?inactsucc");

echo "<script>window.location='testimonial.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_testimonial where test_id='$id'");

if($det)
{

header("location:testimonial.php?del");

echo "<script>window.location='testimonial.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_testimonial where test_id='$del_id'";
$result = $db->insertrec($sql);

}

if($result){?> <script>
window.location="testimonial.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_testimonial set test_status='0' where test_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="testimonial.php?inactsucc";
</script> <?php
}
 }

if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_testimonial set test_status='1' where test_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="testimonial.php?actsucc";
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
			z-index:1002;
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
	<script>
	function test_validate1()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title1').value=="")
	{
	alert("Please Enter the title");
	document.getElementById('title1').focus();
	return false;
	
	}
	
		if(document.getElementById('comment1').value=="")
	{
	alert("Please Enter the comment");
	document.getElementById('comment1').focus();
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
						<li class="active">Testimonials </li>
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
									Testimonial Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						     <?php 
						   
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Testimonial Added Successfully !!!
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
									Testimonial Deleted Successfully !!!
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
									Testimonial Unblocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						    <?php 
						   
						   if(isset($_REQUEST['inactimg']))
						   {
						  ?> 
						  <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-remove red"></i>
								<strong class="red">
									Image Size exceeded!..
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
									Testimonial blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                          <form action="" method="post">
						  
							<div class="row-fluid">
								
								<div class="table-header">
								Testimonial Management
								
								<span style="float:right; padding-right:5px;"> <a href="#" onclick="showpop();" style="color:#FFFFFF;">+ Add </a></span>
								
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
											
												<th width="76">User Name</th>
											
										 <th width="90" >Title</th>
											 <th width="221" >Comments</th>
											 <th width="95" >Date</th>
											 <th width="80" >Ip</th>
											<th width="72" class="hidden-480">Status</th>
                                         
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$test=$db->get_all("select * from mlm_testimonial order by test_id desc");
									$i=1;
									$num=$db->numrows("select * from mlm_testimonial");
									
									foreach($test as $row_test)
									{
									$username=$row_test['test_user'];
									
								   
									
									?>
									
										<tr>
									
											<td class="center">
												<label>
				                   <input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_test['test_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php if($username!=""){ echo $username; } else { echo "Admin"; } ?></td>
										
                                            <td><?php echo $row_test['test_title']; ?></td>
											
											<td><?php echo $row_test['test_comment']; ?></td>
											
											<td><?php echo $row_test['test_date']; ?></td>
											
											<td><?php echo $row_test['test_ip']; ?></td>
											
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_test['test_status']=='1') { ?>
													
													<a class="red" href="testimonial.php?inact=<?php echo $row_test['test_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_test['test_status']=='0') { ?>
												
												<a class="green" href="testimonial.php?act=<?php echo $row_test['test_id'];?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                              
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_test['test_id']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												<?php if($demomode=='true'){?>
												   <a class="grey" onclick="demo()">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
													<?}else{?>
													<a class="grey" href="testimonial.php?delete=<?php echo $row_test['test_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a><?}?>
												  </div>
												</td>
											
							
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>
								
								<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left btn-info" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left btn-info" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left btn-info" title="click to deactivate"/>
							
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
			      null, null,null, null, null,null,
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
		
     <div id="light"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return test_validate1();" enctype="multipart/form-data" >
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">ADD Testimonial</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>User Name </td>
								<td> : </td>
								<td><input type="text" name="username1" id="username1"  /></td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Title </td>
								<td> : </td>
								<td><input type="text" name="title1" id="title1" /></td>
								</tr>
								
									<tr>
								<td>Comments </td>
								<td> : </td>
								<td><textarea name="comment1" id="comment1"></textarea></td>
								</tr>
								<tr>
									<td>Image </td>
									<td> : </td>
									<td><input type="file" name="testmonial_img" /></td>
									
								</tr>
								<tr><td></td>
									<td></td>
									<td><p style="font-size:14px;"> **Only jpg, jpeg, png file with dimension above 204X204 & maximum size of 1 MB is allowed. </p></td>
								</tr>
								
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="add" value="Submit" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop()
	{
    // alert(name);
	 	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'; 
	
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop()
	{
	
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'; 
	}
	
	</script>
	
    <div id="light1"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return test_validate();" enctype="multipart/form-data">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Testimonial</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Username </td>
								<td> : </td>
								<td><input type="text" name="username" id="username" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Title </td>
								<td> : </td>
								<td><input type="text" name="title" id="title" /></td>
								</tr>

									<tr>
								<td>Comments </td>
								<td> : </td>
								<td><textarea name="comment" id="comment"></textarea></td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Current Image </td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<img id="vimgg" />
								</td>
								</tr>
								<tr>
									<td>Image </td>
									<td> : </td>
									<td><span id="img_vals"></span><input type="hidden" name="tstimg" id="tstimg" /><br/><input type="file" name="testmonial_img" id="testmonial_img"  /></td>
									
								</tr>
								<tr><td></td>
									<td></td>
									<td><p style="font-size:14px;"> **Only jpg, jpeg, png file with dimension above 204X204 & maximum size of 1 MB is allowed. </p></td>
								</tr>
								<input type="hidden" name="id" id="tid" />
								
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
	function showpop1(idv) {
	if(idv != "") {
		$.ajax({
		type: "POST",
		dataType: "json",
		url: "ajax.php",
		data:{testimon_id:idv},
		success: function(result) {
			document.getElementById('light1').style.display='block';
			document.getElementById('fade1').style.display='block'; 
			document.getElementById('tid').value=idv;
			document.getElementById('title').value=result.title;
			document.getElementById('tstimg').value=result.img;
			document.getElementById('username').value=result.user;
			document.getElementById('vimgg').src="../uploads/testmonial_img/"+result.img;
			document.getElementById('comment1').value=tinyMCE.activeEditor.setContent(result.comment);
		}
		});
	}
}	
	</script>
	<script>
	function checkPrfId() {

var x = document.getElementById("profileId").value;
//alert("aadfg");
  $.ajax({url: "checkprfid.php",
        type: 'POST',
        data: {reg_id:x} ,
		success: function(result){
		 if(result==1)
		{
			alert("Invalid ProfileId!..");
			document.getElementById("profileId").value="";
			document.getElementById("profileId").focus();
			return false;
		} if(result==0){
			return true;
		} 		
    }}); 
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
