<?php

include("AMframe/config.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu22='class="active"';

if(isset($_REQUEST['maildelete']))
{
$delid=addslashes($_REQUEST['maildelete']);

$del=$db->insertrec("update mlm_outbox set outbox_fromstatus='1' where outbox_id='$delid'");

if($del)
{
header("location:forward.php?del");
echo "<script>window.location='forward.php?del';</script>";
}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

$result=$db->insertrec("update mlm_outbox set outbox_fromstatus='1' where outbox_id='$del_id'");

}

if($result){?> <script>

window.location="forward.php?del";

</script> <?php

}

}

?>


 	<script>

	function muldel()

	{
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
						<li class="active">FORWARD MAILS </li>
					</ul><!--.breadcrumb-->

				</div>
				<div class="page-content">
					<div class="row-fluid">

						<div class="span12">

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
									Forward Mails Updated Successfully !!!
								</strong>
				
							</div>
						   

						   <?php }
						   if(isset($_REQUEST['del']))
						   {
						  ?> 

						   <div class="alert alert-block alert-error">

								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>

								<strong class="red">
									Forward Mails Deleted Successfully !!!
								</strong>
				
							</div>
					   

						   <?php }
						   if(isset($_REQUEST['inactsucc']))
						   {
						  ?> 

							<div class="alert alert-block alert-success">

								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Forward Mails Unblocked Successfully !!!
								</strong>
				
							</div>

						   <?php }
						   if(isset($_REQUEST['actsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">

								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>

								<strong class="red">
									Forward Mails blocked Successfully !!!
								</strong>

							</div>
						   

						   <?php }
						   ?>

                          <form action="" method="post">
							<div class="row-fluid">
						
								<div class="table-header">
								FORWARD MAILS 
							
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
								
										    <th width="121">Sender Name</th>
										
										     <th width="152" >Profile Id</th>
											 
											 <th width="197" >Subject</th>
											 
											 <th width="126" >Date</th>
											 
											<th width="105">Action</th>

										</tr>

									</thead>

									<tbody>


								<?php 
									$inbdb=$db->get_all("select * from mlm_outbox where (outbox_userid='admin' and outbox_fromstatus='0') and outbox_fwdstatus='1' order by outbox_id desc");

									$i=1;

									$num=$db->numrows("select * from mlm_outbox where (outbox_userid='admin' and outbox_fromstatus='0') and outbox_fwdstatus='1' order by outbox_id desc");

									foreach($inbdb as $row_inbdb)
									{
                                      if($row_inbdb['outbox_toprofileid'] != 'Admin')	
									{
									$useinb=$db->singlerec("select * from mlm_register where user_profileid='$row_inbdb[outbox_toprofileid]'");
									$usrname=$useinb['user_fname'];
									}
									else
									{
									$usrname="Administrator";
									}
									?>
										<tr>

											<td class="center">

												<label>
											<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_inbdb['outbox_id']; ?>"  />
													<span class="lbl"></span>
												</label>

											</td>

											<td>
												<?php echo $i; ?>
											</td>

											<td> <?php echo $usrname; ?></td>

                                            <td><?php echo $row_inbdb['outbox_toprofileid']; ?></td>
										
											<td><?php echo $row_inbdb['outbox_subject']; ?></td>

											<td><?php echo date("d-m-Y h:i:s",strtotime($row_inbdb['outbox_date'])); ?></td>

												<td>

												<div class="hidden-phone visible-desktop action-buttons">

											<a href="view_mail.php?detail=<?php echo $row_inbdb['outbox_id'];?>" >

													<img src="images/view_icon.gif" alt="view" title="click to view" style="vertical-align:top; margin-top:2px;"/>

													</a>

													<a class="grey" href="inbox.php?maildelete=<?php echo  $row_inbdb['outbox_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
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

			</div><!--/.main-content-->

		</div><!--/.main-container-->


		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>


		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>


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

			       { "bSortable": false },  { "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false },{ "bSortable": false }

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

