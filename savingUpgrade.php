<?php
include('./includes/heading.php');
$userId = $_SESSION['profileid'];
$drlRecords = $db->get_all("select * from mlm_drl where user_id='$userId'");
$profile = $db->singlerec("select user_sponserid from mlm_register where user_profileid='$userId'");


if (isset($_REQUEST['submitDrl'])) {
    if (isset($_REQUEST['ammount']) && !empty($_REQUEST['ammount']) && isset($_REQUEST['month']) && !empty($_REQUEST['month'])) {
        $amount = $_REQUEST['ammount'];
        $month = $_REQUEST['month'];

        $date = date("Y-m-d");
        $sponsor = $profile['user_sponserid'];

        $set = "sponsor_id = '$sponsor'";
        $set .= ", user_id= '$userId'";
        $set .= ", amount= '$amount'";
        $set .= ", date= '$month'";
        $set .= ", submitted_at= '$date'";
        $insertrec = $db->insertrec("insert into mlm_drl set $set");
        header("location:savingUpgrade.php?update");
    }
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
                    <h4 class="mt-2 mb-4">First Year Renewal Installment Update</h4>
                    <form action="" method="POST">
                        <?php if (isset($update) && empty($imgerr)) { ?>
                            <div class="alert alert-success">
                                <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span>
                                Request send to admin panel for approval Successfully!!.
                            </div>
                        <?php } ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>Amount: <span class="required">*</span></b> </label>
                                            <div class="input-group">
                                                <input class="form-control" type="number" name="ammount" required="true" value="2020-05" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>For Month: <span class="required">*</span></b> </label>
                                            <div class="input-group">
                                                <input class="form-control" type="month" name="month" required="true" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" style="text-align:right">
                                <input class="btn btn-success" type="submit" name="submitDrl" value="Submit" />
                            </div>
                        </div>
                    </form>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Your Saving System</h2>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><strong>Month</strong></th>
                                            <th>Amount</th>
                                            <th>Submitted At</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cmuEarn = 0; ?>
                                        <?php foreach ($drlRecords as $key => $rec) { ?>
                                            <tr>
                                                <td><strong><?php echo $rec['date'] ?></strong></td>
                                                <td><?php echo $rec['amount'] ?></td>
                                                <td><?php echo $rec['submitted_at'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($rec['status'] == 0) {
                                                        echo "<span class='badge badge-warning'>Pending</span>";
                                                    }
                                                    if ($rec['status'] == 1) {
                                                        echo "<span class='badge badge-success'>Approved</span>";
                                                    }
                                                    if ($rec['status'] == 2) {
                                                        echo "<span class='badge badge-danger'>Rejected</span>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <strong>
                        <p>Note: It is compulsory to upgrade yoour saving instllmeent details up to 1st year completion. Once you deposit your policy premium for the plan you own through us plese update the details here.</p>
                    </strong>

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