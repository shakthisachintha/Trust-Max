<?php include('./includes/heading.php') ?>

<?php

if (isset($_REQUEST['submit'])) {
    $email = addslashes($_REQUEST['email']);
    $user_type = addslashes($_REQUEST['type']);

    $user_pid = addslashes($_REQUEST['pfid']);
    $sub = addslashes($_REQUEST['subject']);
    $msgg = addslashes($_REQUEST['messaggge']);

    $fwdid = addslashes($_REQUEST['fwwdd']);

    if ($user_pid == "") {
        $user_pid = "Admin";
    }

    $toqry = $db->singlerec("select * from mlm_register where user_profileid='$user_pid'");

    $qry = $db->insertrec("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW(),outbox_fwid='$fwdid',outbox_fwdstatus='1'");

    if ($qry) {
        header("location:mail.php?succ");
        echo "<script>window.location='mail.php?succ';</script>";
    }
}

$fwd = replace($_REQUEST['fwd']);
$fwdval = $db->singlerec("select * from mlm_outbox where outbox_id='$fwd'");
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

                    <h4 class="navbar-inner" style="color:#000; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Forward Mail</h4>
                    <form action="" method="post" onClick="return composseval();">
                        <div class="table-responsive">
                            <table class="table new_tbl2" cellpadding="7" cellspacing="0" border="0" width="100%">
                                <?php if (isset($_REQUEST['succ'])) { ?>
                                    <tr>
                                        <td colspan="3" align="center" style="color:#006633; font-weight:bold;">
                                            Message Sent Successfully !!!
                                        </td>

                                    </tr>
                                <?php } ?>
                                <tr>

                                    <td>
                                        <strong>User Type</strong></td>
                                    <td>:</td>
                                    <td>
                                        <input type="radio" name="type" id="type1" value="1" onClick="typval('1');" checked required="true" ;> Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="type" id="type2" value="2" onClick="typval('2');" required="true" ;> User &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <strong>User Profileid</strong> </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="pfid" id="pfid" onblur="return validation();" />
                                        <div id="mailerr"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>Subject</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $fwdval['outbox_subject']; ?>" required ; />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Message</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <textarea name="messaggge" class="form-control" id="messaggge"><?php echo $fwdval['outbox_message']; ?></textarea>
                                    </td>
                                </tr>
                                <input type="hidden" name="fwwdd" id="fwwdd" value="<?php echo $_REQUEST['fwd']; ?>">
                                <input type="hidden" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>">
                                <tr>
                                    <td colspan="3" align="center">
                                        <button type="submit" name="submit" id="valemail" class="greenbtn">FORWARD</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>


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

    <script>
        function typval(val) {
            if (val == "2") {
                document.getElementById('pval').style.display = 'block';
                $('#pfid').attr('required', 'required');
            } else {
                document.getElementById('pval').style.display = 'none';
                $('#pfid').attr('required', 'required');
            }

        }

        function composseval() {
            if (document.getElementById('pfid').value != "") {

                if (document.getElementById('subject').value != "") {

                    //alert(document.getElementById('message').value);
                    tinyMCE.triggerSave();
                    if (document.getElementById('messaggge').value == "") {
                        alert("please enter the message");
                        document.getElementById('messaggge').focus();
                        return false;
                    }

                }
            }
        }

        function validation() {
            var profileid = $("#pfid").val();
            $.ajax({
                type: 'post',
                url: 'getprofileid.php',
                dataType: 'json',
                data: {
                    "profileid": profileid,
                },
                success: function(data) {
                    if (data['status'] == 'succ') {
                        $("#valemail").prop("disabled", false);
                        $("#mailerr").html("<span style='color:#006633;'>Valid profileid !!!</span>")
                    } else if (data['status'] == 'fail') {
                        $("#valemail").prop("disabled", true);
                        $("#mailerr").html("<span style='color:#FF0000;'>Invalid profileid,Please enter valid profileid!!!</span>")
                    }

                }
            });
        }
    </script>
</body>

</html>