<?php include('./includes/heading.php') ?>

<body class="bg-light">
    <!-- Navbar section -->
    <?php include("includes/navbar.php") ?>
    <!-- End Navbar section -->


    <div class="container p-0">

        <div class="row mt-4 mb-4">
            <div class="col-lg-4">
                <?php include("includes/profile-card.php") ?>
            </div>

            <div class="col-lg-8">
                <div class="bg-white shadow-sm p-4">
                    <h4>BINARY STRUCTURE</h4>
                    <div style="overflow-y: scroll;" class="table-responsive">
                        <div class="tree" style="min-width:600px;">
                            <?php
                            $uid = replace($uid);
                            $uid = !empty($uid) ? $uid : $_SESSION['profileid'];
                            ?>
                            <?= $uid; ?>

                            <?php

                            function traverse($id, $db)
                            {
                                if ($id == null) {
                                    return;
                                } else {
                                    $left_uid = $db->singlerec("Select * from mlm_register where user_placementid='$id' and points_collected='0' and user_position='Left'");
                                    traverse($left_uid['user_profileid'], $db);

                                    echo "<br> here " . $id . "<br>";

                                    $right_uid = $db->singlerec("Select * from mlm_register where user_placementid='$id' and points_collected='0' and user_position='Right'");
                                    traverse($right_uid['user_profileid'], $db);
                                }
                            }

                            traverse($uid, $db);

                            $left_user_count = $db->numrows("Select * from mlm_register where user_placementid='$uid' and points_collected='0' and user_position='Left'");
                            if ($left_user_count > 0) {
                            }
                            $left_branch = $db->singlerec("Select * from mlm_register where user_placementid='$uid' and points_collected='0' and user_position='Left'");
                            // while()
                            $right_branch = $db->singlerec("Select * from mlm_register where user_placementid='$uid' and points_collected='0' and user_position='Left'");
                            ?>
                            <div class="row">
                                <div class="col">
                                    <h6>Left Branch Points : 20</h6>
                                </div>
                                <div class="col">
                                    <h6>Right Branch Points: 10</h6>
                                </div>
                            </div>
                            <?php $ext_obj->usertree($uid, 0, 0); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        })
    </script>
</body>

</html>