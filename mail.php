<?php include('./includes/heading.php') ?>

<?php
if (!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
    header("location:index.php");

    echo "<script>window.location='index.php'</script>";
}

if (isset($_REQUEST['submit'])) {
    $email = addslashes($_REQUEST['email']);
    $user_type = addslashes($_REQUEST['type']);

    $user_pid = addslashes($_REQUEST['pfid']);
    $sub = addslashes($_REQUEST['subject']);
    $msgg = addslashes($_REQUEST['messaggge']);

    $toqry = $db->singlerec("select * from mlm_register where user_profileid='$user_pid'");
    if ($user_pid == "") {
        $user_pid = "Admin";
    }
    $qry = $db->insertrec("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW()");

    if ($qry) {
        header("location:mail.php?succ");
        echo "<script>window.location='mail.php?succ';</script>";
    }
}

if (isset($_REQUEST['maildelete'])) {
    $delid = addslashes($_REQUEST['maildelete']);

    $del = $db->insertrec("update mlm_outbox set outbox_tostatus='1' where outbox_id='$delid'");

    if ($del) {
        header("location:mail.php");
        echo "<script>window.location='mail.php';</script>";
    }
}

if (isset($_REQUEST['readsts'])) {
    $readsts = addslashes($_REQUEST['readsts']);

    $rsts = $db->insertrec("update mlm_outbox set outbox_readstatus='1' where outbox_id='$readsts'");
}
?>

<body class="bg-light">

    <!-- Navbar section -->
    <?php include("includes/navbar.php") ?>
    <!-- End Navbar section -->


    <!-- Main Content -->
    <div class="container p-0">
        <div class="row mt-4 mb-4">

            <div class="col-lg-4">
                <?php include("includes/profile-card.php") ?>
            </div>
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-8">
                <div class="bg-white shadow-sm p-4">
                    <h4 class="mt-2 mb-4">Mail Messages</h4>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-stats-tab" data-toggle="tab" href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="true">Stats</a>
                            <a class="nav-item nav-link" id="nav-stats-compose" data-toggle="tab" href="#nav-compose" role="tab" aria-controls="nav-compose" aria-selected="false">Compose</a>
                            <a class="nav-item nav-link" id="nav-inbox-tab" data-toggle="tab" href="#nav-inbox" role="tab" aria-controls="nav-inbox" aria-selected="false">Inbox</a>
                            <a class="nav-item nav-link" id="nav-readm-tab" data-toggle="tab" href="#nav-readm" role="tab" aria-controls="nav-readm" aria-selected="false">Read Mails</a>
                            <a class="nav-item nav-link" id="nav-unreadm-tab" data-toggle="tab" href="#nav-unreadm" role="tab" aria-controls="nav-unreadm" aria-selected="false">Unread Mails</a>
                            <a class="nav-item nav-link" id="nav-forwardm-tab" data-toggle="tab" href="#nav-forwardm" role="tab" aria-controls="nav-forwardm" aria-selected="false">Forwarded Mails</a>
                        </div>
                    </nav>
                    <div class="tab-content pt-4" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-stats" role="tabpanel" aria-labelledby="nav-stats-tab">
                            <div class="table-responsive">
                                <table class="table" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="24%" height="22">
                                            <strong>RECEIVED MAILS</strong></td>
                                        <td width="17%">:</td>
                                        <td width="59%" style="text-align:left;">
                                            <?php
                                            $revmail = $db->numrows("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype='2' and outbox_tostatus='0') ");
                                            ?>
                                            <a href="inbox.php"><?php echo $revmail; ?></a> </td>
                                    </tr>
                                    <tr>
                                        <td width="24%">
                                            <strong>SENT MAILS</strong> </td>
                                        <td>:</td>
                                        <td style="text-align:left;">
                                            <?php
                                            $sentmail = $db->numrows("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0')");
                                            ?>
                                            <a href="outbox.php"><?php echo $sentmail; ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="24%">
                                            <strong>FORWARD MAILS</strong> </td>
                                        <td>:</td>
                                        <td style="text-align:left;">
                                            <?php
                                            $fwddmail = $db->numrows("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_fwdstatus='1'"); ?>
                                            <a href="forward.php"><?php echo $fwddmail; ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="24%">
                                            <strong>READ MAILS</strong> </td>
                                        <td>:</td>
                                        <td style="text-align:left;"><?php
                                                                        $fwddmail = $db->numrows("select * from mlm_outbox where (outbox_toupid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_readstatus='1'"); ?>

                                            <a href="read.php"><?php echo $fwddmail; ?></a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="24%">
                                            <strong>UNREAD MAILS</strong></td>
                                        <td>:</td>
                                        <td style="text-align:left;">
                                            <?php
                                            $fwddmail = $db->numrows("select * from mlm_outbox where (outbox_toupid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_readstatus='0'"); ?>

                                            <a href="unread.php"><?php echo $fwddmail;
                                                                    ?></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-compose" role="tabpanel" aria-labelledby="nav-compose-tab">
                            <h4 class="navbar-inner" style="color:#000; line-height:40px;">Compose Mail</h4>
                            <form action="" method="post" onClick="return composseval();">
                                <?php if (isset($_REQUEST['succ'])) : ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>Message Sent Successfully !!!</strong>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="">User Type</label><br>
                                    <div class="form-check d-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="2" onClick="typval('2');" required name="type" id="type2" checked>
                                            User
                                        </label>
                                    </div>
                                    <div class="ml-5 form-check d-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="1" onClick="typval('1');" required name="type" id="type1">
                                            Admin
                                        </label>
                                    </div>
                                </div>
                                <div id="upid" class="form-group">
                                    <label for="pfid">User Profile ID</label>
                                    <input type="text" name="pfid" class="form-control" placeholder="Enter user profile id" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required placeholder="Enter subject">
                                </div>
                                <div class="form-group">
                                    <label for="messaggge">Message</label>
                                    <textarea class="form-control" name="messaggge" id="messaggge" rows="5"></textarea>
                                </div>
                                <input type="hidden" name="email" id="email" value="<?= $userdetail['user_email']; ?>">
                                <button type="submit" name="submit" class="greenbtn">SEND</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-inbox" role="tabpanel" aria-labelledby="nav-inbox-tab">
                            <h4 class="navbar-inner" style="color:#000; line-height:40px;">Inbox</h4>
                            <div class="table-responsive">
                                <table id="paging" class="table table-bordered table-hover" cellspacing="0" width="100%">

                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th width="23%">Receiver</th>
                                            <th width="34%">Subject</th>
                                            <th width="21%">DATE</th>
                                            <th width="35%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        $inb = $db->get_all("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype='2' and outbox_tostatus='0') order by outbox_id desc ");
                                        $nom_rows = $db->numrows("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype='2' and outbox_tostatus='0')");

                                        if ($nom_rows == '0') { ?>
                                            <tr>
                                                <td style="color:#FF0000;" colspan="7" align="center"> No Records Found</td>
                                            </tr>

                                            <? }
									$i=1;
									foreach($inb as $rinb) 
									{
									if($rinb['outbox_userid'] != 'admin')	
									{	
									$useinb=$db->singlerec("select * from mlm_register where user_id='$rinb[outbox_userid]'");
									$usrname=$useinb['user_fname'];
									}
									else
									{
										$usrname="Administrator";
									}
									?>
                                            <tr <?php if ($rinb['outbox_readstatus'] == "0") { ?> style="font-weight:bold;" <?php } else { ?> style="font-weight:normal;" <?php } ?>>

                                                <td><?php if ($rinb['outbox_readstatus'] == "0") { ?> <img src="images/unreadmsg.jpeg" style="width:24px; height:24px;"> <?php } else { ?> <img src="images/readmsgg.jpeg" style="width:20px; height:20px;"> <?php } ?>
                                                </td>

                                                <td style="text-align:left;">
                                                    <?= $usrname ?> (<?= $rinb['outbox_profileid'] ?>)
                                                </td>

                                                <td>
                                                    <?php echo $rinb['outbox_subject']; ?>
                                                </td>

                                                <td>
                                                    <?php echo date("d-m-Y h:i:s", strtotime($rinb['outbox_date'])); ?>
                                                </td>
                                                <td>
                                                    <a href="mailview.php?msgview=<?= $rinb['outbox_id']; ?>&usrviewed"><img src="images/mailview.jpg" width="32" height="32"></a>
                                                    <a href="reply.php?rep=<?php echo $rinb['outbox_id']; ?>"><img src="images/reply.jpg" width="32" height="32"></a>
                                                    <a href="forwardmail.php?fwd=<?php echo $rinb['outbox_id']; ?>"><img src="images/forward.jpg" width="32" height="32"></a>
                                                    <a href="mail.php?maildelete=<?php echo $rinb['outbox_id']; ?>" onClick="if(confirm('Are you sure to delete this record')) { return true; } else{ return false; }"><img src="images/maildel.jpg" width="32" height="32"></a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-readm" role="tabpanel" aria-labelledby="nav-readm-tab">
                            <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">READ MAIL</h4>
                            <div class="table-responsive">
                                <table id="example" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>

                                            <th width="23%">Receiver</th>
                                            <th width="40%">Subject</th>
                                            <th width="20%">DATE</th>
                                            <th width="10%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $inb = $db->get_all("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1') ");
                                    $nom_rows = $db->numrows("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1')");
                                    if ($nom_rows == '0') { ?>
                                        <tr>
                                            <td style="color:#FF0000;" colspan="7" align="center"> No Records Found</td>
                                        </tr>

                                        <? }
									$i=1;
									foreach($inb as $rinb) 
									{
										
									if($rinb['outbox_usertype']!="1")	
									{	
									
									$useinb=$db->singlerec("select * from mlm_register where user_id='$rinb[outbox_toupid]'");
									$useroutname=$useinb['user_fname'];
									}
									else
									{
										$useroutname="Administrator";
									}
									?>

                                        <tr>

                                            <td style="text-align:left;">
                                                <?= $useroutname; ?> (<?= $rinb['outbox_toprofileid']; ?>)
                                            </td>
                                            <td>
                                                <?php echo $rinb['outbox_subject']; ?>
                                            </td>

                                            <td>
                                                <?php echo date("d-m-Y h:i:s", strtotime($rinb['outbox_date'])); ?>
                                            </td>
                                            <td>
                                                <a href="mailview.php?msgview=<?php echo $rinb['outbox_id']; ?>">VIEW</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-unreadm" role="tabpanel" aria-labelledby="nav-unreadm-tab">
                            <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">UNREAD MAIL</h4>
                            <div class="table-responsive">
                                <table id="example" class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="23%">Receiver</th>
                                            <th width="40%">Subject</th>
                                            <th width="20%">DATE</th>
                                            <th width="10%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $inb = $db->get_all("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='0')");
                                    $nom_rows = $db->numrows("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='0')");

                                    if ($nom_rows == '0') { ?>
                                        <tr>
                                            <td style="color:#FF0000;" colspan="6" align="center"> No Records Found</td>
                                        </tr>

                                        <? }
									$i=1;
									foreach($inb as $rinb) 
									{
									if($rinb['outbox_usertype']!="1")	
									{	
									
									$useinb=$db->singlerec("select * from mlm_register where user_id='$rinb[outbox_toupid]'");
									$useroutname=$useinb['user_fname'];
									}
									else
									{
										$useroutname="Administrator";
									}
									
									?>

                                        <tr>

                                            <td style="text-align:left;">
                                                <?= $useroutname; ?> (<?= $rinb['outbox_toprofileid']; ?>)
                                            </td>

                                            <td>
                                                <?php echo $rinb['outbox_subject']; ?>
                                            </td>

                                            <td>
                                                <?php echo date("d-m-Y h:i:s", strtotime($rinb['outbox_date'])); ?>
                                            </td>
                                            <td>
                                                <a href="mailview.php?msgview=<?php echo $rinb['outbox_id']; ?>&usrviewed">VIEW</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-forwardm" role="tabpanel" aria-labelledby="nav-forwardm-tab">
                            <h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">FORWARD MAIL</h4>
                            <div class="table-responsive">
                                <table class="table" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <th width="23%">Receiver</th>
                                        <th width="40%">Subject</th>
                                        <th width="20%">DATE</th>
                                        <th width="10%">ACTION</th>
                                    </tr>

                                    <?php
                                    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                    $limit = 10;
                                    $startpoint = ($page * $limit) - $limit;
                                    $url = '?';
                                    $out = $db->get_all("select * from mlm_outbox where (outbox_userid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fwdstatus='1') order by outbox_id desc LIMIT {$startpoint} , {$limit}");
                                    $nom_rows = $db->numrows("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fwdstatus='1')");

                                    if ($nom_rows == '0') { ?>
                                        <tr>
                                            <td style="color:#FF0000;" colspan="6" align="center"> No Records Found</td>
                                        </tr>

                                        <? }
									$i=1;
									foreach($out as $rout) 
									{
									if($rout['outbox_usertype']==1)	
									{	
									    $useroutname="Administrator";
									}
									else
									{
										$useout=$db->singlerec("select * from mlm_register where user_profileid='$rout[outbox_profileid]'");
									   $useroutname=!empty($useout['user_fname'])?$useout['user_fname']:"Not mentioned";
									}
									?>

                                        <tr>

                                            <td style="text-align:left;">
                                                <?php echo $useroutname; ?>
                                            </td>

                                            <td>
                                                <?php echo $rout['outbox_subject']; ?>
                                            </td>

                                            <td>
                                                <?php echo date("d-m-Y h:i:s", strtotime($rout['outbox_date'])); ?>
                                            </td>
                                            <td>
                                                <a href="mailview.php?msgview=<?php echo $rout['outbox_id']; ?>">VIEW</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                    <tr>
                                        <td colspan="5" align="center">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Main Content -->


    <!-- Footer Section -->
    <div class="container">
        <div class="row mt-3 mb-3">
            <?php include "includes/login-access-ads.php"; ?>
        </div>
    </div>


    <?php include("./includes/footer.php") ?>

    <!-- End Footer -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();

        });
    </script>
    <script>
        function typval(val) {
            if (val == "2") {
                $("#upid").fadeIn();
            } else {
                $("#upid").fadeOut();
            }
        }
    </script>
    <script>
        function composseval() {
            if (document.getElementById('subject').value != "") {
                tinyMCE.triggerSave();
                if (document.getElementById('messaggge').value == "") {
                    alert("please enter the message");
                    document.getElementById('messaggge').focus();
                    return false;
                }
            }
        }
    </script>
</body>

</html>