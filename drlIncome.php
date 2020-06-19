<?php include('./includes/heading.php') ?>

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
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-di-tab" data-toggle="tab" href="#nav-di" role="tab" aria-controls="nav-di" aria-selected="true">Direct Income</a>
                            <a class="nav-item nav-link" id="nav-drli-tab" data-toggle="tab" href="#nav-drli" role="tab" aria-controls="nav-drli" aria-selected="false">DRL Income</a>
                            <a class="nav-item nav-link" id="nav-ri-tab" data-toggle="tab" href="#nav-ri" role="tab" aria-controls="nav-ri" aria-selected="false">Residual Income</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-di" role="tabpanel" aria-labelledby="nav-home-tab">
                            <h4 class="mt-4 mb-4">Direct Incomes : <?= $com_obj->newTotalBal($userdetail['user_profileid'])['di'] . " " . $sitecurrency ?></h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>From</th>
                                            <th>Earning</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cmuEarn = 0; ?>
                                        <?php foreach ($com_obj->userReferalls($userdetail['user_profileid']) as $key => $sp) : ?>
                                            <tr>
                                                <td><strong><?= $sp['user_profileid'] ?></strong></td>
                                                <td><?= $sp['user_fname'] . ' ' . $sp['user_lname'] ?></td>
                                                <td class="text-truncate" title="<?= $sp['user_city'] . ' ' . $sp['user_state'] . ' ' . $sp['user_country'] ?>"><?= $sp['user_city'] . ' ' . $sp['user_state'] . ' ' . $sp['user_country'] ?></td>
                                                <td>20 USD</td>
                                                <?php $cmuEarn += 20; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2" class="text-center lead"><strong>Total : <?php echo $cmuEarn ?> USD</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-drli" role="tabpanel" aria-labelledby="nav-drli-tab">
                            <?php
                            $userId = $_SESSION['profileid'];

                            $drlRecords = $db->get_all("select * from mlm_drl where sponsor_id='$userId' and status=1");

                            ?>

                            <h4 class="mt-4 mb-4">Incomes from DRL's</h4>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><strong>From User</strong></th>
                                            <th>Date</th>
                                            <th>Income</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cmuEarn = 0; ?>
                                        <?php foreach ($drlRecords as $key => $rec) { ?>
                                            <tr>
                                                <td><strong><?php echo $rec['user_id'] ?></strong></td>
                                                <td><strong><?php echo $rec['date'] ?></strong></td>
                                                <?php $earned = round(($rec['amount'] * 5) / 100);  ?>
                                                <td><?php echo $rec['status'] ? $earned . ' USD' : '-'; ?></td>
                                                <?php
                                                if ($rec['status']) {
                                                    $cmuEarn += $earned;
                                                }
                                                ?>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total: <?php echo $cmuEarn ?> USD</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-ri" role="tabpanel" aria-labelledby="nav-ri-tab">
                            <h4 class="mt-4 mb-4">Residual Incomes</h4>
                            <?php $pairs = $com_obj->userPairsNew($userdetail['user_profileid']); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <colgroup>
                                        <col span="1" style="width: 8%;">
                                        <col span="1" style="width: 13%;">
                                        <col span="1" style="width: 48%;">
                                        <col span="1" style="width: 13%;">
                                        <col span="1" style="width: 14%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Level Pairs</th>
                                            <th>Pairs</th>
                                            <th>Pair Earned</th>
                                            <th>Level Income</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $grdTot = 0 ?>
                                        <?php foreach ($pairs['levels'] as $key => $sp) { ?>
                                            <tr>
                                                <td style='text-align:center;vertical-align:middle'><?= $key ?></td>
                                                <?php $total = $sp['tot'] ?>
                                                <td style='text-align:center;vertical-align:middle;font-size:1rem'><span class='badge badge-success'><?= $total ?></span></td>
                                                <td>
                                                    <table class="table-condensed table-bordered">
                                                        <colgroup>
                                                            <col span="1" style="width: 70vw">
                                                            <col span="1" style="width: 30vw">

                                                        </colgroup>
                                                        <tr>
                                                            <td>User ID</td>
                                                            <td>Paired At</td>
                                                        </tr>
                                                        <?php foreach ($sp['pairs'] as $key => $p) : ?>
                                                            <?php
                                                            $paired = date("Y-m-d", $p[0]);
                                                            $lId = $p[1]['id'];
                                                            $rId = $p[2]['id'];
                                                            $lName = $p[1]['name'];
                                                            $rName = $p[2]['name'];
                                                            $lDate = $p[1]['date'];
                                                            $rDate = $p[2]['date'];
                                                            ?>
                                                            <tr>
                                                                <td><strong><?= ($lId . '-' . $rId) ?></strong></td>
                                                                <td><strong>
                                                                        <?= $paired  ?>
                                                                    </strong></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </td>
                                                <td style='text-align:center;vertical-align:middle'><strong><?php echo $sp['tot'] . ' * ' . 20  ?></strong></td>
                                                <td style='text-align:center;vertical-align:middle'><strong><?php echo $sp['tot'] * 20 ?></strong></td>

                                                <?php $grdTot += $sp['tot'] * 20; ?>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2" class="text-right lead"><strong>Total Income : <?php echo $grdTot ?> USD</strong></td>
                                        </tr>
                                    </tbody>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Optional JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


</body>

</html>