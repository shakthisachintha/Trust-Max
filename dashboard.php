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
                    <h4 class="mt-2 mb-4">Downline List</h4>
                    <button onclick="return $('#downpay').toggle();" class="btn mb-3 btn-primary">Downline List</button>
                    <div style="display: none;" id="downpay" class="table-responsive">
                        <table id="example1" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Join Date</th>
                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * from mlm_register where user_sponserid='$_SESSION[profileid]' and user_status='0'";
                            $result = $db->get_all_assoc($sql);
                            $count = $db->numrows($sql);
                            $i = 0;
                            ?>
                            <tbody>
                                <?php if ($count != 0) : ?>
                                    <?php foreach ($result as $rec) : ?>
                                        <?php $i++ ?>
                                        <tr><?= isset($Message) ? $Message : "" ?>
                                            <td><?= $i ?></td>
                                            <td><?= $rec['user_fname'] ?></td>
                                            <td><?= $rec['user_email'] ?></td>
                                            <td><?= $rec['user_phone'] ?></td>
                                            <td><?= $rec['user_date'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td style='text-align:center;color: #f00;font-size: 14px;padding-top: 20px;' colspan="4">
                                            No Records Found
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
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