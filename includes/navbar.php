<?php
if (isset($_SESSION['userid'])) {
    $userdetail = $db->singlerec("select * from mlm_register where user_status='0' and user_id='$_SESSION[userid]'");
    $_SESSION['profileid'] = $userdetail['user_profileid'];
    $profilename = $userdetail['user_fname'];
    if (file_exists("uploads/profile_image/" . $userdetail['user_image']) && $userdetail['user_image'] != '') {
        $profileimages = "uploads/profile_image/" . $userdetail['user_image'];
    } else {
        $profileimages = "images/user_coat_red_01.png";
    }
} else {
    $profilename = "Profile name";
    $profileimages = "images/user_coat_red_01.png";
}
?>
<nav class="navbar p-3 navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand ml-0 pl-0 ml-md-5 pl-md-5 font-weight-bold" href="#">
        <h3 class="p-0 m-0">Trust-Max</h3>
    </a>
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto align-items-center  mr-5 pr-5">
            <a class="nav-item nav-link <?php if ($currentpagename == "dashboard.php") : ?>active font-weight-bold <?php endif; ?>" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link <?php if ($currentpagename == "drlIncome.php") : ?>active <?php endif; ?>" href="drlIncome.php">Income</a>
            <a class="nav-item nav-link <?php if ($currentpagename == "savingUpgrade.php") : ?>active <?php endif; ?>" href="savingUpgrade.php">Savings</a>
            <a class="nav-item nav-link <?php if ($currentpagename == "rank.php") : ?>active <?php endif; ?>" href="rank.php">Ranks</a>
            <a class="nav-item nav-link <?php if ($currentpagename == "binary.php") : ?>active <?php endif; ?>" href="binary.php">Binary Genealogy</a>
            <a class="nav-item nav-link <?php if ($currentpagename == "wallet.php") : ?>active <?php endif; ?>" href="wallet.php">Wallet Statement</a>
            <a class="nav-item nav-link <?php if ($currentpagename == "mail.php") : ?>active <?php endif; ?>" href="mail.php">Mails</a>
            <li class="nav-item dropdown ml-0 ml-md-5">
                <a class="nav-link align-items-center" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="shadow-sm p-1" src="<?= $profileimages ?>" style="width:35px;height:35px;border-radius:100%" alt="">
                </a>
                <div class="mt-2 dropdown-menu dropdown-menu-right dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="profile.php">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> &nbsp;
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fa fa-sign-out"></i>&nbsp;
                        Logout</a>
                </div>
            </li>
        </div>
    </div>
</nav>