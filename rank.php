<?php include('./includes/heading.php');
$profile = $_SESSION['profileid'];
$rankName = ['User', 'Executive Distrubutor', 'Distribution Manager', 'Distribution Area Manager', 'Distribution Director', 'Country Director', 'Vice Precedent', 'Presedent']
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
                    <?php $rank = $com_obj->checkRank($profile); ?>
                    <h4 class="mt-2 mb-4">Your Current Rank & Target Rank</h4>
                    <h3 style="color: rebeccapurple;">Current Rank: <?php echo $rankName[$rank]; ?></h3>
                    

                    <table class="mt-4 table table-hover">
                        <tr>
                            <td colspan="2" style="background-color: #51257d;color: white;">
                                <h4 style="color: white;">Next Rank: <?php echo $rankName[$rank + 1]; ?></h4>
                                <p style="color: yellow;">Criterias to fill for next Rank</p>
                            </td>
                        </tr>
                        <?php if ($rank == 1) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 direct sponsor</td>
                            </tr>
                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                <td style="background-color: rebeccapurple;color: white;">4 direct sponsor</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 Executive Distributor in your downline.</td>
                            </tr>


                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                <td style="background-color: rebeccapurple;color: white;">5 direct sponsor</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">4 Executive Distributor in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 Distribution Manager in your downline.</td>
                            </tr>


                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">8 Executive Distributor in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">5 Distribution Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 Distribution Area Manager in your downline.</td>
                            </tr>
                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">12 Executive Distributor in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">8 Distribution Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">5 Distribution Area Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                <td style="background-color: rebeccapurple;color: white;">3 Distribution Director in your downline.</td>
                            </tr>
                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">20 Executive Distributor in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">15 Distribution Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">12 Distribution Area Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                <td style="background-color: rebeccapurple;color: white;">8 Distribution Director in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Country Director: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 Country Director in your downline.</td>
                            </tr>
                        <?php }
                        if ($rank == 2) { ?>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                <td style="background-color: rebeccapurple;color: white;">30 Executive Distributor in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">25 Distribution Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                <td style="background-color: rebeccapurple;color: white;">20 Distribution Area Manager in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                <td style="background-color: rebeccapurple;color: white;">15 Distribution Director in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Country Director: </td>
                                <td style="background-color: rebeccapurple;color: white;">10 Country Director in your downline.</td>
                            </tr>
                            <tr>
                                <td style="background-color: #7648a5;color: white;">Vice President: </td>
                                <td style="background-color: rebeccapurple;color: white;">2 Vice President in your downline.</td>
                            </tr>
                        <?php } ?>
                    </table>
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