<?php include('./includes/heading.php') ?>

<?php

if (isset($_REQUEST['submit'])) {
    $email = addslashes($_REQUEST['email']);
    $user_type = addslashes($_REQUEST['type']);

    $user_pid = addslashes($_REQUEST['pfid']);
    $sub = addslashes($_REQUEST['subject']);
    $msgg = addslashes($_REQUEST['messaggge']);

    $fwdid = addslashes($_REQUEST['fwwdd']);

    $toqry = $db->singlerec("select * from mlm_register where user_profileid='$user_pid'");

    $qry = $db->insertrec("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW(),outbox_fwid='$fwdid',outbox_fwdstatus='1'");

    if ($qry) {
        header("location:forwardmail.php?succ");
        echo "<script>window.location='forwardmail.php?succ';</script>";
    }
}

$msgviews = replace($_REQUEST['msgview']);
if (isset($_REQUEST['usrviewed'])) {
    $db->insertrec("update mlm_outbox set outbox_readstatus='1' where outbox_id='$msgviews'");
}
$msgview = $db->singlerec("select * from mlm_outbox where outbox_id='$msgviews'");
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


                    <h4 class="navbar-inner" style="color:#000; line-height:40px; margin-top: -50px; margin-bottom: 7px;"> Mail View</h4>
                    <div class="table-responsive">
                        <table class="table new_tbl2">
                            <tr>
                                <td style="width:10%" align="right">
                                    <strong>From</strong>
                                </td>
                                <td align="center">:</td>
                                <td>
                                    <?php echo $msgview['outbox_profileid']; ?>
                                </td>
                            </tr>
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
                                <td style="width:10%">
                                    <strong>Message</strong>
                                </td>
                                <td align="center">:</td>


                                <td><?php echo $msgview['outbox_message']; ?></td>
                                </td>
                            </tr>




                        </table>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable();

        });
    </script>
</body>

</html>