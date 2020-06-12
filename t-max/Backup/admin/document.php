<?php
include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu7='class="active"';

if(isset($_REQUEST['submit']))
{
   
	$title = addslashes($_REQUEST['title']);
	
	$docfile=addslashes($_FILES['docfile']['name']);
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
		if($title == "")
	{
		header("Location:document.php?error");
		exit;
	}
	
	if($docfile == "")
	{
		header("Location:document.php?error");
		exit;
	} 
	else 
	{
			$split_name = explode(".",strtolower($docfile));
		
			if(($split_name[1] == 'doc') || ($split_name[1] == 'docx') || ($split_name[1] == 'ppt') || ($split_name[1] == 'pptx') ||($split_name[1] == 'xls') || ($split_name[1] == 'xlsx') || ($split_name[1] == 'pdf'))
			{
			
			$cate_img_small = "doc".date("dmY")."-".rand("100","999").".".$split_name[1];
			//$image_path = "../uploads/document/";
	
	       	move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/document/".$cate_img_small);
			
		}
		else
		{
			header("Location:document.php?not-a-image");
			exit;
		}

 $insert = $db->insertrec("INSERT INTO mlm_document(doc_heading,doc_name,doc_date,doc_ip) VALUES ('$title','$cate_img_small',NOW(),'$ip')");
	
	if($insert)
	 { 
	 header("Location:document.php?succ"); 
	 ?>
	<script>
	window.location="document.php?succ";
	</script>	
	<?php
	
	}
}
}

if(isset($_REQUEST['update']))
{

	$doc_id = addslashes($_REQUEST['docid']);
	$title = addslashes($_REQUEST['title']);
	$docfile=addslashes($_FILES['docfile']['name']);
	$ip=$_SERVER['REMOTE_ADDR'];
	
if($title == "")
	{
		header("Location:document.php?error");
		exit;
	}
		
	if($docfile != "") 
	{
	
	$split_name = explode(".",strtolower($docfile));
		
	 if(($split_name[1] == 'doc') || ($split_name[1] == 'docx') || ($split_name[1] == 'ppt') || ($split_name[1] == 'pptx') ||($split_name[1] == 'xls') || ($split_name[1] == 'xlsx') || ($split_name[1] == 'pdf'))
			{

			$cate_img_small = "doc".date("dmY")."-".rand("100","999").".".$split_name[1];
					
			move_uploaded_file($_FILES['docfile']['tmp_name'],"../uploads/document/".$cate_img_small);
			
			$docimg=",doc_name='$cate_img_small'";

		}
			else
			{
				header("Location:document.php?not-a-image");
				exit;
			}
	
	}

	$update = $db->insertrec("UPDATE mlm_document SET doc_heading='$title',doc_ip='$ip'$docimg WHERE doc_id=$doc_id");
	if($update) {	
	
		header("Location:document.php?editsuccess");
		
		?>
	<script>
	window.location="document.php?editsuccess";
	</script>	
	<?php
	}
}

if(isset($_REQUEST['act']))
{

$id=addslashes($_REQUEST['act']);

$act=$db->insertrec("update mlm_document set doc_status='1' where doc_id='$id'");

if($act)
{

header("location:document.php?actsucc");

echo "<script>window.location='document.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=addslashes($_REQUEST['inact']);

$act=$db->insertrec("update mlm_document set doc_status='0' where doc_id='$id'");

if($act)
{

header("location:document.php?inactsucc");

echo "<script>window.location='document.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=addslashes($_REQUEST['delete']);

$det=$db->insertrec("delete from mlm_document where doc_id='$id'");

if($det)
{

header("location:document.php?del");

echo "<script>window.location='document.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$sql = "delete from mlm_document where doc_id='$del_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="document.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

$sql = "update mlm_document set doc_status='0' where doc_id='$act_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="document.php?inactsucc";
</script> <?php
}
 }

if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

$sql = "update mlm_document set doc_status='1' where doc_id='$inact_id'";
$result = $db->insertrec($sql);
}

if($result){?> <script>
window.location="document.php?actsucc";
</script> <?php
}
 }

?>
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
			top: 15%;
			left: 22%;
			width: 55%;
			height:55%;
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
	
	function doc_validate()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title').value=="")
	{
	alert("Please Enter the Documents Title");
	document.getElementById('title').focus();
	return false;
	
	}
	
	
	if(document.getElementById('docfile').value=="")
	{
		alert("Please upload the the Documents ");
		document.getElementById('docfile').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('docfile').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="doc" && ssivanew!="docx" && ssivanew!="ppt" && ssivanew!="pptx" && ssivanew!="xls" && ssivanew!="xlsx" && ssivanew!="pdf")
		{
			  alert("Please upload .doc , .docx , .ppt , .pptx, .xls, .xlsx, .pdf files only");
			  document.getElementById('docfile').value="";
			  document.getElementById('docfile').focus();
			  return false;
		 }
	}
	
	
	}
	
	
	</script>
	
		<script>
	
	function news_validate1()
	{
	if(document.getElementById('titlee').value=="")
	{
	alert("Please Enter the Documents Title");
	document.getElementById('titlee').focus();
	return false;
	
	}
	
	
	if(document.getElementById('docfilee').value=="")
	{
		alert("Please upload the the Documents ");
		document.getElementById('docfilee').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('docfilee').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="doc" && ssivanew!="docx" && ssivanew!="ppt" && ssivanew!="pptx" && ssivanew!="xls" && ssivanew!="xlsx" && ssivanew!="pdf")
		{
			  alert("Please upload .doc , .docx , .ppt , .pptx, .xls, .xlsx, .pdf files only");
			  document.getElementById('docfilee').value="";
			  document.getElementById('docfilee').focus();
			  return false;
		 }
	}
	}
	
	
	</script>
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
						<li class="active">Upload Documents </li>
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
						   
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Documents Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
							
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
									Documents Updated Successfully !!!
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
									Documents Deleted Successfully !!!
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
									Documents Unblocked Successfully !!!
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
									Documents blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Upload Documents
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop();" style="color:#FFFFFF;">+ ADD Documents</a></span>
								
								</div>

								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="22" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="37">Sl.No</th>
											
											<th width="284">Document Name</th>
											
												<th width="122">Date</th>
											<th width="128">Ip</th>
											<th width="117">Download</th>
										
											<th width="93" class="hidden-480">Status</th>
                                            
											
									
										</tr>
									</thead>
									<tbody>
									
									<?php 
									
									$docs=$db->get_all("select * from mlm_document order by doc_id desc");
									$i=1;
									$num=$db->numrows("select * from mlm_document");
									
									foreach($docs as $row_docs)
									{
									?>
									
										<tr>
									
											<td class="center">
												<label>
													<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_docs['doc_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $row_docs['doc_heading']; ?></td>
											
											<td>
											<?php echo date("d-m-Y",strtotime($row_docs['doc_date'])); ?>
											</td>
										<td>
											<?php echo $row_docs['doc_ip']; ?>
											</td>

                                            	<td align="center">
										<a href="../uploads/document/<?php echo $row_docs['doc_name']; ?>"><img src="images/download.jpeg" style="width:80px; height:30px;" /></a>
											</td>

											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_docs['doc_status']=='1') { ?>
													
													<a class="red" href="document.php?inact=<?php echo $row_docs['news_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_docs['doc_status']=='0') { ?>
												
												<a class="green" href="document.php?act=<?php echo $row_docs['doc_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                             
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_docs['doc_id']; ?>','<?php echo $row_docs['doc_heading']; ?>','<?php echo $row_docs['doc_name']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
										
													<a class="grey" href="document.php?delete=<?php echo $row_docs['doc_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
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

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-class="default" value="#438EB9" />#438EB9
									<option data-class="skin-1" value="#222A2D" />#222A2D
									<option data-class="skin-2" value="#C6487E" />#C6487E
									<option data-class="skin-3" value="#D0D0D0" />#D0D0D0
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
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
			      null, null,null, null,{ "bSortable": false },
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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return doc_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add Documents</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Documents  Title <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="title" id="title" /></td>
								</tr>
						
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Upload Document <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="docfile" id="docfile" /><br />
								<span>Upload doc,docx,ppt,pptx,xls,xlsx,pdf files only</span>
								</td>
								</tr>
								
								
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop();">
									
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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return doc_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Documents</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								
								<tr>
								<td>Documents  Title <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="title" id="titlee" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Current Document <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
							<div id="docuname">&nbsp;</div>
								</td>
								</tr>
	
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Upload Document <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="docfile" id="docfilee" /><br />
								<span>Upload doc,docx,ppt,pptx,xls,xlsx,pdf files only</span>
								</td>
								</tr>
								
								<input type="hidden" name="docid" id="docid" />
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td colspan="3">
								<div class="form-actions" style="margin:0px;">
				<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop1();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade1" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop1(val,tit,docc)
	{
	//alert(name);
	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('docid').value=val;
	document.getElementById('titlee').value=tit;
	document.getElementById('docuname').innerHTML=docc;
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
