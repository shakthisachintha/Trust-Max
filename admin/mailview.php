<?php 
include("admin/AMframe/config.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{
$email=addslashes($_REQUEST['email']);
$user_type=addslashes($_REQUEST['type']);

$user_pid=addslashes($_REQUEST['pfid']);
$sub=addslashes($_REQUEST['subject']);
$msgg=addslashes($_REQUEST['messaggge']);

$fwdid=addslashes($_REQUEST['fwwdd']);

$toqry=$db->singlerec("select * from mlm_register where user_profileid='$user_pid'");

$qry=$db->insertrec("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW(),outbox_fwid='$fwdid',outbox_fwdstatus='1'");

if($qry)
{
header("location:forwardmail.php?succ");
echo "<script>window.location='forwardmail.php?succ';</script>";
}

}

include("includes/head.php");

$msgviews=replace($_REQUEST['msgview']);
if(isset($_REQUEST['usrviewed']))
{
$db->insertrec("update mlm_outbox set outbox_readstatus='1' where outbox_id='$msgviews'");
}
$msgview=$db->singlerec("select * from mlm_outbox where outbox_id='$msgviews'");
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

<script>
function typval(val)
{
if(val=="2")
{
document.getElementById('pval').style.display='block';
}
else
{
document.getElementById('pval').style.display='none';
}

}


</script>
<script>
function composseval()
{
if(document.getElementById('pfid').value!="")
{

if(document.getElementById('subject').value!="")
{

//alert(document.getElementById('message').value);
tinyMCE.triggerSave();
if(document.getElementById('messaggge').value=="")
{
alert("please enter the message");
document.getElementById('messaggge').focus();
return false;
}

}
}
}

</script>
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			<hr />			
			<!-- Profile info -->
			<div class="row">
                <div class="span profile-info">
					<div class="row">
						<div class="col-sm-3">
							<img src="<?=$profileimages?>" width="128" height="128" class="img-responsive" />
						</div>
						<div class="col-sm-9" >
							<blockquote style="height: 155px; margin: 0;">
								<h4 class="profle_head" style="color:#000;">
									
										<?php echo $userdetail['user_fname']; ?>
									
									<span style="float:right; display:block;">
										<?php echo $userdetail['user_date']; ?>
									</span>
								</h4>
                                <div class="table-responsive" style="margin-top:10px;">
								<table class="table table-striped new_tbl" cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="20%">
											<strong>Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_fname']; ?>
										</td>
										<td width="20%">
											<strong>Email id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_email']; ?>
										</td>
									</tr>
									<tr>
										<td width="20%">
											<strong>Profile Id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_profileid']; ?>
										</td>
										<td width="20%">
											<strong>Sponsor Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
										<?php echo $userdetail['user_sponsername']; ?>
										</td>
									</tr>
								</table>
								</div>
								<hr style="border: 1px solid #f5f5f5;" />
								<div style="text-align:center;">
									<ul style="list-style:none; margin: 0; width:100%;">
										<li style="margin:0 10px; display:block;">
											<label  class="cb-enable selected">
												<span>Total CV </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $userdetail['total_bv']; ?></span>
											</label>
										</li>
										<li>
											<span style="float:left; margin:0 10px;">&nbsp;</span>
										</li>
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Current CV </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $userdetail['accumulated_bv']; ?></span>
											</label>
										</li>
									</ul>
								</div>
                            </blockquote>
						</div>
					</div>
                </div>
            </div>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/mailmenu.php"); ?>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
							<div class="banner" style="padding-right: 0;">
                           <h4 class="navbar-inner" style="color:#000; line-height:40px; margin-top: -50px; margin-bottom: 7px;"> Mail View</h4>
									<div class="table-responsive">
									<table class="table new_tbl2">
									<tr>
										<td style="width:10%" align="right">
											<strong>Subject</strong>
										</td>
										<td align="center">:</td>
										<td>
								<?php echo $msgview['outbox_subject']; ?>
										</td>
									</tr>
									<tr>
										<td style="width:10%" align="right">
											<strong>Message</strong>
										</td>
										<td align="center">:</td>
										<td>&nbsp;
								
										</td>
									</tr>
									
                                    <tr>
                                    <td colspan="3" style="text-indent:100px;"><?php echo $msgview['outbox_message']; ?></td>
                                    
                                    </tr>
                                    
								
								</table>
								</div>
							</div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>