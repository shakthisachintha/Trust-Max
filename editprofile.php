<?php include('./includes/heading.php') ?>
<?php
if (isset($_REQUEST['update1'])) {
    $uid = $_SESSION['userid'];
    $pancard = replace($_REQUEST['user_pancard']);


    $insert = $db->insertrec("update mlm_register set user_pancard='$pancard' where user_id='$uid'");

    if ($insert) {
        header("Location:editprofile.php?upsucc");
?>
        <script>
            window.location = "editprofile.php?upsucc";
        </script>
    <?php

    }
}

if (isset($_REQUEST['update2'])) {

    $uid = $_SESSION['userid'];

    $dobdate = addslashes($_REQUEST['dobdate']);
    $dobmonth = addslashes($_REQUEST['dobmonth']);
    $dobyear = addslashes($_REQUEST['dobyear']);

    $date = $dobyear . "-" . $dobmonth . "-" . $dobdate;
    $phone = addslashes($_REQUEST['phone']);
    $email = addslashes($_REQUEST['email']);
    $holder = addslashes($_REQUEST['holder_name']);
    $accno = addslashes($_REQUEST['accno']);
    $bank_name = addslashes($_REQUEST['bank_name']);
    $branch = addslashes($_REQUEST['branch']);
    $ifsccode = addslashes($_REQUEST["ifsc_code"]);

    $caddr1 = isset($_REQUEST['caddr1']) ? addslashes($_REQUEST['caddr1']) : ' ';
    $caddr2 = isset($_REQUEST['caddr2']) ? addslashes($_REQUEST['caddr2']) : ' ';
    $ccountry = isset($_REQUEST['ccountry']) ? addslashes($_REQUEST['ccountry']) : ' ';
    $cstate = isset($_REQUEST['addressstate']) ? addslashes($_REQUEST['addressstate']) : ' ';
    $ccity = isset($_REQUEST['addresscity']) ? addslashes($_REQUEST['addresscity']) : ' ';
    $czipcode = isset($_REQUEST['czipcode']) ? addslashes($_REQUEST['czipcode']) : ' ';
    $cpaddr1 = isset($_REQUEST['cpaddr1']) ? addslashes($_REQUEST['cpaddr1']) : ' ';
    $cpaddr2 = isset($_REQUEST['cpaddr2']) ? addslashes($_REQUEST['cpaddr2']) : ' ';
    $cpcountry = isset($_REQUEST['cpcountry']) ? addslashes($_REQUEST['cpcountry']) : null;
    $cpstate = isset($_REQUEST['cpstate']) ? addslashes($_REQUEST['cpstate']) : null;
    $cppcity = isset($_REQUEST['cppcity']) ? addslashes($_REQUEST['cppcity']) : null;
    $cpzipcode = isset($_REQUEST['czipcode']) ? addslashes($_REQUEST['czipcode']) : null;

    echo $cpzipcode;

    $insert = $db->insertrec("update mlm_register set user_dob='$date',user_phone='$phone',
	user_email='$email',
	user_accholdername='$holder',
	user_branch='$branch',
	user_ifsccode='$ifsccode',
	user_accno='$accno',
	user_bankname='$bank_name',
	user_commaddr1='$caddr1',
	user_commaddr2='$caddr2',
	user_city='$ccity',
	user_state='$cstate',
	user_country='$ccountry',
	user_postalcode='$czipcode', 
	user_paddr1='$cpaddr1',
	user_paddr2='$cpaddr2',
	user_pcity='$cppcity',
	user_pstate='$cpstate',
	user_pcountry='$cpcountry',
	user_ppostalcode='$cpzipcode' where user_id='$uid'");


    if ($insert) {
        header("Location:editprofile.php?upsucc1");
    ?>
        <script>
            window.location = "editprofile.php?upsucc1";
        </script>
    <?php

    }
}

if (isset($_REQUEST['update3'])) {
    $uid = $_SESSION['userid'];
    $nname = addslashes($_REQUEST['nname']);
    $ncountry = addslashes($_REQUEST['ncountry']);
    $nstate = isset($_REQUEST['nstate']) ? addslashes($_REQUEST['nstate']) : null;
    $ncity = isset($_REQUEST['ncity']) ? addslashes($_REQUEST['ncity']) : null;
    $nzipcode = isset($_REQUEST['nzipcode']) ? addslashes($_REQUEST['nzipcode']) : null;
    $nphone = isset($_REQUEST['nphone']) ? addslashes($_REQUEST['nphone']) : null;
    $nemail = isset($_REQUEST['nemail']) ? addslashes($_REQUEST['nemail']) : null;
    $naddr1 = isset($_REQUEST['naddr1']) ? addslashes($_REQUEST['naddr1']) : null;
    $naddr2 = isset($_REQUEST['naddr2']) ? addslashes($_REQUEST['naddr2']) : null;
    $ncnumber = isset($_REQUEST['ncnumber']) ? addslashes($_REQUEST['ncnumber']) : null;

    if ($_REQUEST['icid'] == "others") {
        $nct = addslashes($_REQUEST['nctype']);
    } else {
        $nct = addslashes($_REQUEST['icid']);
    }

    $insert = $db->insertrec("update mlm_register set user_nomineename='$nname',
    user_identifycardtype='$nct',
    user_idnumber='$ncnumber',
    user_naddr1='$naddr1',
    user_naddr2='$naddr2',
    user_ncountry='$ncountry',
    user_ncity='$ncity',
    user_nstate='$nstate',
    user_npostalcode='$nzipcode',
    user_nphone='$nphone',
    user_nemail='$nemail' where user_id='$uid'");


    if ($insert) {
        header("Location:editprofile.php?upsucc2");
    ?>
        <script>
            window.location = "editprofile.php?upsucc2";
        </script>
<?php

    }
}

if (isset($_REQUEST['submit'])) {

    $imag = $_FILES['pimage']['tmp_name'];
    $imag = isset($imag) ? $imag : '';
    $uniq = uniqid();
    if ($imag != '') {
        $upload = $com_obj->upload_image("pimage", $uniq, 300, 300, "uploads/profile_image/", "new");
        if ($upload) {
            $newimage = $com_obj->img_Name;
            $qry = $db->insertrec("update mlm_register set user_image='$newimage' where user_id='$_SESSION[userid]'");
            header("location:editprofile.php?update");
        } else {
            $imgerr = $com_obj->img_Err;
        }
    } else {
        $imgerr = "Please upload your image";
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
                    <?php
                    $sponid = $userdetail['user_sponserid'];
                    $detail = $com_obj->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'");
                    ?>
                    <h4 class="mt-2 mb-4">Edit Profile</h4>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="mt-3 panel panel-default">
                            <div class="card-header" role="tab" id="headingfour">
                                <h4 class="panel-title">
                                    <a class="text-decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                        Change Profile Picture
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsefour" class="panel-collapse p-3 collapse in" role="tabpanel" aria-labelledby="headingfour">
                                <div class="panel-body">
                                    <h4 class="navbar-inner" style="color:#091647; line-height:40px;  margin-bottom: 7px;">Upload photo</h4>
                                    <div class="col-sm-12">


                                        <?php if (isset($update) && empty($imgerr)) { ?>
                                            <div class="alert alert-success">
                                                <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span>
                                                Image uploaded successfully
                                            </div>
                                        <?php }
                                        $imgerr = isset($imgerr) ? $imgerr : '';
                                        if (!empty($imgerr)) {

                                        ?>
                                            <div class="alert alert-danger">
                                                <span class="closebtn pull-right" onclick="this.parentElement.style.display='none';">&times;</span>
                                                <?php echo $imgerr ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <form action="" method="post" onClick="return changephoto();" enctype="multipart/form-data">
                                            <div class="table-responsive">
                                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
                                                    <?php if (isset($_REQUEST['succ'])) { ?>
                                                        <tr>
                                                            <td colspan="3" align="center" style="color:#006633; font-weight:bold;">
                                                                Photo uploaded Successfully !!!
                                                            </td>

                                                        </tr>
                                                    <?php } ?>

                                                    <?php if (isset($_REQUEST['largeimage'])) { ?>
                                                        <tr>
                                                            <td colspan="3" align="center" style="color:#FF0000; font-weight:bold;">
                                                                Image size too large..min upload size 1mb only !!!
                                                            </td>

                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td width="40%" align="right">
                                                            <strong>Current Image</strong>
                                                        </td>
                                                        <td width="7" align="center">:</td>
                                                        <td width="50%">
                                                            <img src="<?= $profileimages ?>" width="100" height="100" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right">
                                                            <strong>Upload Profile Image </strong>
                                                        </td>
                                                        <td align="center">:</td>
                                                        <td>
                                                            <input type="file" name="pimage" id="pimage" required="true" />
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td align="center"><strong>[Instruction: Please upload .jpg , .png , .jpeg , .gif files only and image size less than 1mb, Image must be greater than or equal to 300 x 300 pixels]</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td />
                                                        <td />
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3" align="center">
                                                            <button type="submit" name="submit" class="greenbtn">SAVE</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-3 panel panel-default">
                            <div class="card-header" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a class="text-decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Basic Details
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse p-3 collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table>
                                        <?php if (isset($_REQUEST['upsucc'])) {  ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="2" align="left">
                                                    <strong style="color:#006633;">Updated Successfully !!!</strong>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <form name="form1" action="" method="post">
                                            <tr>
                                                <td>
                                                    <strong>Sponsor Name</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <?php if ($userdetail['user_sponsername'] != "0") {
                                                        echo $detail['user_fname'] . ' ' . $detail['user_lname'];
                                                    } else {
                                                        echo "Owner";
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Sponsor id</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <?php if ($userdetail['user_sponserid'] != "0") {
                                                        echo $userdetail['user_sponserid'];
                                                    } else {
                                                        echo "Owner";
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Placement Id</strong></td>
                                                <td align="center">:</td>
                                                <td><?php if ($userdetail['user_placementid'] != "") {
                                                        echo $userdetail['user_placementid'];
                                                    } else {
                                                        echo "Owner";
                                                    } ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Position</strong></td>
                                                <td align="center">:</td>
                                                <td><?php echo $userdetail['user_position']; ?></td>
                                            </tr>
                                        </form>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="mt-3 panel panel-default">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed text-decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Personal Details
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse p-3 collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <table cellpadding="7" cellspacing="0" border="0">
                                        <?php if (isset($_REQUEST['upsucc1'])) {  ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="2" align="left">
                                                    <strong style="color:#006633;">Updated Successfully !!!</strong>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <form name="form2" action="editprofile.php" method="post">
                                            <tr>
                                                <td width="177">
                                                    <strong>First Name</strong> </td>
                                                <td width="39" align="center">:</td>
                                                <td width="700">
                                                    <?php echo $userdetail['user_fname']; ?>
                                                </td>
                                            </tr>

                                            <?php echo $userdetail['user_secondname']; ?>


                                            <tr>
                                                <td width="177">
                                                    <strong>Last Name</strong></td>
                                                <td width="39" align="center">:</td>
                                                <td width="700">
                                                    <?php echo $userdetail['user_lname']; ?>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <strong>Email id</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" readonly type="text" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>" required="true">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>D.O.B</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>


                                                    <?php
                                                    $exp = explode("-", $userdetail['user_dob']);
                                                    $dt = 0;
                                                    $mt = 0;
                                                    $yr = 00;
                                                    if (count($exp) > 1) {
                                                        $yr = $exp[0];
                                                        $mt = $exp[1];
                                                        $dt = $exp[2];
                                                    }
                                                    ?>

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="d" class="styledselect-day" name="dobdate">
                                                                <option value="00">date</option>
                                                                <option value="01" <?php if ($dt == "01") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>1</option>
                                                                <option value="02" <?php if ($dt == "02") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>2</option>
                                                                <option value="03" <?php if ($dt == "03") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>3</option>
                                                                <option value="04" <?php if ($dt == "04") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>4</option>
                                                                <option value="05" <?php if ($dt == "05") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>5</option>
                                                                <option value="06" <?php if ($dt == "06") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>6</option>
                                                                <option value="07" <?php if ($dt == "07") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>7</option>
                                                                <option value="08" <?php if ($dt == "08") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>8</option>
                                                                <option value="09" <?php if ($dt == "09") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>9</option>
                                                                <option value="10" <?php if ($dt == "10") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>10</option>
                                                                <option value="11" <?php if ($dt == "11") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>11</option>
                                                                <option value="12" <?php if ($dt == "12") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>12</option>
                                                                <option value="13" <?php if ($dt == "13") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>13</option>
                                                                <option value="14" <?php if ($dt == "14") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>14</option>
                                                                <option value="15" <?php if ($dt == "15") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>15</option>
                                                                <option value="16" <?php if ($dt == "16") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>16</option>
                                                                <option value="17" <?php if ($dt == "17") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>17</option>
                                                                <option value="18" <?php if ($dt == "18") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>18</option>
                                                                <option value="19" <?php if ($dt == "19") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>19</option>
                                                                <option value="20" <?php if ($dt == "20") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>20</option>
                                                                <option value="21" <?php if ($dt == "21") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>21</option>
                                                                <option value="22" <?php if ($dt == "22") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>22</option>
                                                                <option value="23" <?php if ($dt == "23") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>23</option>
                                                                <option value="24" <?php if ($dt == "24") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>24</option>
                                                                <option value="25" <?php if ($dt == "25") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>25</option>
                                                                <option value="26" <?php if ($dt == "26") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>26</option>
                                                                <option value="27" <?php if ($dt == "27") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>27</option>
                                                                <option value="28" <?php if ($dt == "28") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>28</option>
                                                                <option value="29" <?php if ($dt == "29") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>29</option>
                                                                <option value="30" <?php if ($dt == "30") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>30</option>
                                                                <option value="31" <?php if ($dt == "31") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>31</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control" id="m" name="dobmonth" class="styledselect-month">
                                                                <option value="00">month</option>
                                                                <option value="01" <?php if ($mt == "01") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Jan</option>
                                                                <option value="02" <?php if ($mt == "02") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Feb</option>
                                                                <option value="03" <?php if ($mt == "03") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Mar</option>
                                                                <option value="04" <?php if ($mt == "04") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Apr</option>
                                                                <option value="05" <?php if ($mt == "05") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>May</option>
                                                                <option value="06" <?php if ($mt == "06") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Jun</option>
                                                                <option value="07" <?php if ($mt == "07") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Jul</option>
                                                                <option value="08" <?php if ($mt == "08") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Aug</option>
                                                                <option value="09" <?php if ($mt == "09") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Sep</option>
                                                                <option value="10" <?php if ($mt == "10") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Oct</option>
                                                                <option value="11" <?php if ($mt == "11") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Nov</option>
                                                                <option value="12" <?php if ($mt == "12") {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Dec</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input class="form-control" class="input-block-level" type="text" placeholder="YYYY" name="dobyear" id="dobyear" value="<?php echo $yr; ?>" />
                                                        </div>
                                                    </div>



                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Phone</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $userdetail['user_phone']; ?>" required="true">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Name as per Bank </strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="holder_name" id="holder_name" value="<?php echo $userdetail['user_accholdername']; ?>">
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <strong>Bank Account No </strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="accno" id="accno" value="<?php echo !empty($userdetail['user_accno']) ? $userdetail['user_accno'] : null; ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Bank Name</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="bank_name" id="bank_name" value="<?php echo $userdetail['user_bankname']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Branch </strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="branch" id="branch" value="<?php echo $userdetail['user_branch']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>IBAN</strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="<?php echo $userdetail['user_ifsccode']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-bottom:1px #CCCCCC solid;">
                                                    <br><br>
                                                    <strong>
                                                        <h4>Communication Address</h4>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address1 </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="caddr1" id="caddr1" value="<?php echo $userdetail['user_commaddr1']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address2 </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="caddr2" id="caddr2" value="<?php echo $userdetail['user_commaddr2']; ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Country </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input type="text" class="form-control" name="ccountry" id="ccountry" value="<?= $userdetail['user_country'] ?>">

                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>State </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <div class="controls" id="astate">
                                                        <input type="text" name="addressstate" class="form-control" value="<?php echo $userdetail['user_state']; ?>">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>City </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <div class="controls" id="acity">
                                                        <input type="text" name="addresscity" class="form-control" value="<?php echo $userdetail['user_city']; ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Zipcode</strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="czipcode" id="czipcode" value="<?php echo $userdetail['user_postalcode']; ?>">
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <button type="submit" name="update2" class="greenbtn">UPDATE</button>
                                                </td>

                                            </tr>

                                        </form>

                                        <tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 panel panel-default">
                            <div class="card-header" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed text-decoration-none" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Nominee Details
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse p-3 collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <table cellpadding="7" cellspacing="0" border="0" width="100%">
                                        <?php if (isset($_REQUEST['upsucc2'])) {  ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="2" align="left">
                                                    <strong style="color:#006633;">Updated Successfully !!!</strong>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <form name="form3" action="" method="post">

                                            <tr>
                                                <td>
                                                    <strong>Nominee Name</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="nname" id="nname" required="true" value="<?php echo $userdetail['user_nomineename']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Email id</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="nemail" required="true" id="nemail" value="<?php echo $userdetail['user_nemail']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Id cardtype</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <?php //echo $userdetail['user_identifycardtype']; 
                                                    ?>
                                                    <input type="radio" name="icid" id="psid" style="opacity:1;" value="Passport" onclick="return card(this.value);" <?php if ($userdetail['user_identifycardtype'] == 'Passport') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;Passport &nbsp; <input type="radio" name="icid" id="dlid" style="opacity:1;" value="Driving License" onclick="return card(this.value);" <?php if ($userdetail['user_identifycardtype'] == 'Driving License') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;Driving License &nbsp;
                                                    <input type="radio" name="icid" id="otid" style="opacity:1;" value="others" <?php if (($userdetail['user_identifycardtype'] != 'Driving License') && ($userdetail['user_identifycardtype'] != 'Passport') && ($userdetail['user_identifycardtype'] != 'PAN Card') && ($userdetail['user_identifycardtype'] != 'Voters ID')) { ?> checked="checked" <?php } ?> onclick="return card(this.value);" />
                                                    &nbsp;&nbsp; Others &nbsp;
                                                </td>
                                            </tr>



                                            <tr>
                                                <td>
                                                    <strong>Id Number</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="ncnumber" id="ncnumber" value="<?php echo $userdetail['user_idnumber']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-bottom:1px #CCCCCC solid;">
                                                    <br><br>
                                                    <strong>
                                                        <h4>Communication Address</h4>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Address1 </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="naddr1" id="naddr1" value="<?php echo $userdetail['user_naddr1']; ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Address2 </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="naddr2" id="naddr2" value="<?php echo $userdetail['user_naddr2']; ?>">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Country </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input type="text" class="form-control" value="<?= $userdetail['user_ncountry'] ?>" name="ncountry" id="ncountry">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>State </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <div class="controls" id="nstatee">
                                                        <div class="controls" id="acity">
                                                            <input type="text" name="nstate" class="form-control" value="<?php echo $userdetail['user_nstate']; ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>City </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <div class="controls" id="ncityy">
                                                        <div class="controls" id="acity">
                                                            <input type="text" name="ncity" class="form-control" value="<?php echo $userdetail['user_ncity']; ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Zipcode </strong></td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="nzipcode" id="nzipcode" value="<?php echo $userdetail['user_npostalcode']; ?>">
                                                </td>
                                            </tr>

                                            <tr>

                                                <td>
                                                    <strong>Phone Number</strong>
                                                </td>
                                                <td align="center">:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="nphone" id="nphone" value="<?php echo !empty($userdetail['user_nphone']) ? $userdetail['user_nphone'] : ''; ?>">
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <button type="submit" name="update3" class="greenbtn">UPDATE</button>
                                                </td>

                                            </tr>
                                        </form>
                                    </table>
                                </div>
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
        function card(val) {
            if (val == 'others') {
                document.getElementById('carrrrdtype').style.display = "block";

            } else {

                document.getElementById('carrrrdtype').style.display = "none";
            }


        }
    </script>
    <script>
        function showstate(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication country");
                document.getElementById("addresscountry").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("astate").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function discity(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication State");
                document.getElementById("addressstate").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("acity").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "cityajax.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function stateview(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the permanent country");
                document.getElementById("cpcontry").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("cpstatee").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax2.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function cityview(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the Permanent State");
                document.getElementById("cpstate").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("cpcityy").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "cityajax2.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function showstate1(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication country");
                document.getElementById("ncontry").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("nstatee").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax3.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function cityshow1(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication State");
                document.getElementById("nstate").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("ncityy").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "cityajax3.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function mailval(str) {
            //alert("gfhfg");

            if (str == "") {
                alert("Please enter the email");
                document.getElementById("emailaddress").focus();
                return false;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("err").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "getmail.php?q=" + str, true);
            xmlhttp.send();
        }

        function changephoto() {

            if (document.getElementById('pimage').value == "") // ----- check current password not null -----
            {
                //
            } else {
                var ss = document.getElementById('pimage').value;
                var index = ss.lastIndexOf(".");
                var sstring = ss.substring(index + 1);
                var ssivanew = sstring.toLowerCase();
                if (ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF") {
                    alert("Please upload .jpg , .png , .jpeg , .gif files only");
                    document.getElementById('pimage').value = "";
                    document.getElementById('pimage').focus();
                    return false;
                }
            }

        }
    </script>
</body>

</html>