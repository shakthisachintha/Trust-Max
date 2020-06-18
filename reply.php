<?php include('./includes/heading.php') ?>

<?php

if (isset($_REQUEST['submit'])) {
    $email = addslashes($_REQUEST['email']);
    $user_type = "2";

    $user_pid = addslashes($_REQUEST['pfid']);
    $sub = addslashes($_REQUEST['subject']);
    $msgg = addslashes($_REQUEST['messaggge']);

    $repid = addslashes($_REQUEST['reppp']);
    $repid = preg_replace("/[^A-Za-z0-9]/", "", $repid);

    $toqry = $db->singlerec("select * from mlm_register where user_profileid='$user_pid'");

    $qry = $db->insertrec("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW(),outbox_rpid='$repid'");

    if ($qry) {
        header("location:mail.php?succ");
        echo "<script>window.location='mail.php?succ';</script>";
    }
}
$reps = replace($_REQUEST['rep']);
$rpval = $db->singlerec("select * from mlm_outbox where outbox_id='$reps'");
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

                    <h4 class="navbar-inner" style="color:#000; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Reply Mail</h4>
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
                                        <strong>User Profileid</strong> </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="pfid" id="pfid" value="<?php echo $rpval['outbox_profileid']; ?>" readonly />
                                    </td>


                                </tr>

                                <tr>
                                    <td>
                                        <strong>Subject</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control" name="subject" id="subject" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Message</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <textarea class="form-controll" name="messaggge" id="messaggge" style="width:400px; height:200px;"></textarea>
                                    </td>
                                </tr>

                                <input type="hidden" name="reppp" id="reppp" value="<?php echo $_REQUEST['rep']; ?>">
                                <input type="hidden" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>">
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" class="greenbtn">REPLY</button>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>