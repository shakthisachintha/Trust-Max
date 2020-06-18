<?php

include('./includes/heading.php');
$userId = $_SESSION['profileid'];
$userdetail = $db->singlerec("select * from mlm_register where user_status='0' and user_id='$_SESSION[userid]'");
$drlRecords = $db->get_all("select * from mlm_drl where sponsor_id='$userId' and status=1");
$adminTrans = $ats = $db->get_all("select amount, drCr, message, submitted_at from mlm_transaction where user_id='$userId'");
$bal = 0;
$dr = 0;
$cr = 0;
foreach ($adminTrans as $at) {
    if ($at['drCr'] == 1) {
        $dr += $at['amount'];
    } else {
        $cr += $at['amount'];
    }
}

$balance = $dr - $cr;

?>
<?php $newTotalBal = $com_obj->newTotalBal($userdetail['user_profileid']); ?>
<?php $availBalance = $com_obj->newApprovedBal($userdetail['user_profileid']); ?>
<?php $withdrawBal = $com_obj->withdrawBal($userdetail['user_profileid']); ?>

<?php
$total = $newTotalBal['di'] + $newTotalBal['drl'] + $newTotalBal['ri'] + $newTotalBal['at'];
$available = $availBalance['di'] + $availBalance['drl'] + $availBalance['ri'] + $availBalance['at'];

$pending = $total - $withdrawBal;
?>

<?php

if (isset($_REQUEST['submit'])) {

    $userid = addslashes($_SESSION['userid']);
    $prodaf = addslashes($_SESSION['profileid']);
    $amount = addslashes($_REQUEST['amount']);
    $message = addslashes($_REQUEST['message']);
    $sub = addslashes($_REQUEST['subject']);
    $ip = ($_SERVER['REMOTE_ADDR']);
    $name = addslashes($_REQUEST['name']);
    $email = addslashes($_REQUEST['email']);
    $acc_balance = addslashes($_REQUEST['acc_bal']);


    if ($amount <= $acc_balance) {

        $subject = "Withdrawal Request Details from " . $website_name;

        $msg = "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=" . $logourl . " border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Withdrawal Request Details from " . $website_name . " </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $name, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Withdrawal Request has been sent successfully, concern person is reply you soon.</td>
						</tr>
					
				
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				" . $website_name . "<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " . date("Y") . "&nbsp;" . "<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>" . $website_name . "</a>." . "
</td>
</tr>
</table>";

        $to = $email;
        $cmail = $com_obj->commonMail($to, $subject, $msg);

        $subject1 = $sub;
        $msg1 = "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=" . $logourl . " border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Withdrawal Request Details from " . $website_name . " </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Name : $name </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email : $email</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Profileid : $prodaf</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Amount : $amount</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Message : $message</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>Click Here</a></td>
						</tr>
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				" . $website_name . "<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " . date("Y") . "&nbsp;" . "<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>" . $website_name . "</a>." . "
</td>
</tr>
</table>";

        $to1 = $website_admin;
        $mail_sts = $com_obj->commonMail($to1, $subject1, $msg1);

        $insertdfs = $db->insertrec("insert into mlm_withdrawrequsets set req_userid='$userid',req_profileid='$prodaf',req_subject='$sub',req_message='$message',req_cvamount='$amount',tds_percent='$ref_tax',req_date=NOW(),req_time=NOW(),req_ip='$ip'");

        if ($mail_sts == "scs") {
            header("location:wallet.php?succ");
            echo "<script>window.location='wallet.php?succ';</script>";
            exit;
        } else {
            header("location:wallet.php?err");
            echo "<script>window.location='wallet.php?err';</script>";
        }
    } else
        echo "<script>alert('insufficient balance!');</script>";
}

if (isset($_REQUEST['cancel'])) {
    $cancel = addslashes($_REQUEST['cancel']);

    $can = $db->insertrec("update mlm_withdrawrequsets set req_status='1' where req_id='$cancel'");

    if ($can) {
        header("location:wallet.php?cansucc");
        echo "<script>window.location='wallet.php?cansucc';</script>";
    }
}

if (isset($_REQUEST['delete'])) {
    $delete = addslashes($_REQUEST['delete']);

    $del = $db->insertrec("delete from mlm_withdrawrequsets where req_id='$delete'");

    if ($del) {
        header("location:wallet.php?delsucc");
        echo "<script>window.location='wallet.php?delsucc';</script>";
    }
}

$availBalance = $com_obj->newApprovedBal($_SESSION['profileid']);
$withdrawBal = $com_obj->withdrawBal($_SESSION['profileid']);
$available = $availBalance['di'] + $availBalance['drl'] + $availBalance['ri'] + $availBalance['at'];
$withdraw = $available - $withdrawBal;


?>


<body class="bg-light">

    <script type="text/javascript">
        function showpop111(uid, pid, cv, name, email) {

            document.getElementById('light111').style.display = 'block';
            document.getElementById('fade111').style.display = 'block';

            document.getElementById('usid').value = uid;
        }

        function phnumbersonly(myfield, e, dec) {

            var key;
            var keychar;

            if (window.event)
                key = window.event.keyCode;
            else if (e)
                key = e.which;
            else
                return true;
            keychar = String.fromCharCode(key);

            // control keys
            if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27))
                return true;

            // numbers
            else if ((("+0123456789").indexOf(keychar) > -1))
                return true;

            // decimal point jump
            else if (dec && (keychar == ".")) {
                myfield.form.elements[dec].focus();
                return false;
            } else
                return false;
        }

        function alert_box() {
            alert("Upload payslip for membership package and Kindly wait for admin approval!");
        }
    </script>
    <script>
        function with_validate() {
            if ((parseInt(document.getElementById('balamt').value) == "") || (parseInt(document.getElementById('balamt').value) == 0)) {
                alert("Your balance amount is zero, so you cannot send request");
                return false;

            } else if ((parseInt(document.getElementById('balamt').value) <= 49)) {
                alert("Insufficient balance, so you cannot send request");
                return false;
            }

        }

        function hidepop111() {

            document.getElementById('light111').style.display = 'none';
            document.getElementById('fade111').style.display = 'none';
            return false;
        }
    </script>

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
                    <h4 class="mt-2 mb-4">Withdraw Your Incomes</h4>

                    <div class="row">
                        <div class="col-sm-4">
                            <label class="cb-enable selected">
                                <span> Total Income </span>
                            </label>
                            <label class="cb-disable">
                                <span style="min-width:50px;"><?= $total . " " . $sitecurrency; ?></span>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="cb-enable selected">
                                <span>Available to Withdraw </span>
                            </label>
                            <label class="cb-disable">
                                <span style="min-width:50px;"><?= $withdraw . " " . $sitecurrency; ?></span>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="cb-enable selected">
                                <span>Total Withdrawn </span>
                            </label>
                            <label class="cb-disable"><span style="min-width:50px;"><?= $withdrawBal . " " . $sitecurrency; ?></span></label>
                        </div>
                    </div>

                    <nav class="mt-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-wr-tab" data-toggle="tab" href="#nav-wr" role="tab" aria-controls="nav-wr" aria-selected="true">Withdraw Requests</a>
                            <a class="nav-item nav-link" id="nav-cr-tab" data-toggle="tab" href="#nav-cr" role="tab" aria-controls="nav-cr" aria-selected="false">Cancelled Requests</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-wr" role="tabpanel" aria-labelledby="nav-wr-tab">
                            <div class="row mt-4">
                                <div class="col-12">
                                    <?php
                                    $user_profileid = $userdetail['user_profileid'];
                                    $user = $db->singlerec("select * from mlm_register where user_profileid='$user_profileid' and user_status='0'");
                                    $user_paymentstaus = $user['user_paymentstaus'];
                                    $bal = $com_obj->totalBal($userdetail['user_profileid']);
                                    $with = $com_obj->withdrawBal($userdetail['user_profileid']);
                                    ?>
                                    <?php if (isset($_REQUEST['succ'])) : ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Your withdrawal request has been sent successfully !!!</strong>
                                        </div>

                                        <script>
                                            $(".alert").alert();
                                        </script>

                                    <?php endif; ?>


                                    <?php if (isset($_REQUEST['delsucc'])) : ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Request deleted successfully !!!</strong>
                                        </div>

                                        <script>
                                            $(".alert").alert();
                                        </script>

                                    <?php endif; ?>
                                </div>


                                <div class="col-sm-12">
                                    <? if($wallet_withdraw_status == "enabled") { ?>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelId">
                                        Withdraw Balance
                                    </button>
                                    <? } ?>
                                    <div class="banner">
                                        <h4 class="navbar-inner" style="color:#091647; line-height:40px;">WITHDRAWAL REQUESTS

                                        </h4>
                                        <div class="table-responsive">
                                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="6%">#</th>
                                                        <th class="no-sort">MESSAGE</th>
                                                        <th>AMOUNT</th>
                                                        <th>DATE</th>
                                                        <th class="no-sort">STATUS</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $reqq = $db->get_all("select * from mlm_withdrawrequsets where req_status='0' and req_userid='$_SESSION[userid]'");
                                                $nom_rows = $db->numrows("select * from mlm_withdrawrequsets where req_status='0' and req_userid='$_SESSION[userid]'");

                                                if ($nom_rows == '0') { ?>
                                                    <tr>
                                                        <td style="color:#FF0000;" colspan="7" align="center"> No Request Found</td>
                                                    </tr>

                                                    <? }
									
                                    $i=1;?>
                                    <?php foreach ($reqq as $rreqq): ?>

                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $rreqq['req_message']?></td>
                                                        <td>USD <?= $rreqq['req_cvamount']?></td>
                                                        <td><?= date("d-m-Y", strtotime($rreqq['req_date']))?></td>
                                                        <td class="font-weight-bold">
                                                            <?php if ($rreqq['req_rpstatus'] == 0): ?>
                                                                <span class="text-info">
                                                                    Pending
                                                                </span>
                                                            <?php endif; ?>

                                                            <?php if ($rreqq['req_rpstatus'] == 2) :?>
                                                                <span class="text-danger">
                                                                    Rejected
                                                                </span>
                                                            <?php endif; ?>

                                                            <?php if ($rreqq['req_rpstatus'] == 1): ?>
                                                                <span class="green">Transferred</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <form class="p-0 m-0" action="" method="post"> 
                                                                <input type="hidden" name="delete" value="<?=$rreqq['req_id']?>">
                                                                <button type="submit" class="btn w-50 btn-sm btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                            <?php $i++?>
                                        <?php endforeach;?>

                                            </table>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade pt-3" id="nav-cr" role="tabpanel" aria-labelledby="nav-cr-tab">
                            <h4 class="mb-3 navbar-inner" style="color:#091647; line-height:40px;">CANCELLED WITHDRAWAL REQUESTS </span></h4>
                            <div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>

										<tr>
											<td width="6%">
												<strong>SNO</strong></td>
											
											<td width="25%">
												<strong>MESSAGE</strong></td>
											<td width="10%">
												<strong>AMOUNT</strong></td>
											<td width="13%">
												<strong>DATE</strong></td>
											<td width="14%">
												<strong>STATUS</strong></td>
											<td width="15%">
												<strong>ACTION</strong>
											</td>
										</tr>
									</thead>
									<?php
									$reqq = $db->get_all("select * from mlm_withdrawrequsets where req_rpstatus='2' and req_userid='$_SESSION[userid]'");
									$nom_rows = $db->numrows("select * from mlm_withdrawrequsets where req_rpstatus='2' and req_userid='$_SESSION[userid]'");

									?>
									<?php if ($nom_rows == 0) : ?>


										<tr>
											<td style="color:#FF0000;" colspan="7" align="center"> No Request Found</td>
										</tr>

									<?php else : ?>
										<?php $i = 1; ?>
										<?php foreach ($reqq as $rreqq) : ?>

											<tr>
												<td><?= $i; ?></td>
												<td><?= $rreqq['req_message']; ?></td>
												<td><?= $rreqq['req_cvamount']; ?> USD</td>
												<td><?= date("d-m-Y", strtotime($rreqq['req_date'])); ?></td>
												<td class="font-weight-bold">
													<?php if ($rreqq['req_rpstatus'] == '0'): ?>
														<span class="text-danger">Pending</span>
													<?php else: ?>
														<span class="text-danger">Rejected</span>
													<?php endif; ?>
												</td>
												<td>
													<span>
														<a href="cancel_withdraw.php?delete=<?=$rreqq['req_id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to cancel this record')) { return true; } else { return false; }">DELETE</a>
													</span>
												</td>
											</tr>
											<?php $i++ ?>
										<?php endforeach; ?>
									<?php endif; ?>

								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return with_validate();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php $profid = $_SESSION['profileid']; ?>
                        <input type="hidden" name="minwith" id="minwith" value="<?php echo $gen_minwithdraw; ?>" />
                        <input type="hidden" name="name" id="name" value="<?php echo $profilename; ?>" />
                        <input type="hidden" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>" />
                        <input type="hidden" name="balamt" id="balamt" value="<?php echo getBonusamount($profid); ?>" />
                        <input type="hidden" name="subject" id="subject" required="true" style="height:25px;" />
                        <input type="hidden" name="acc_bal" value="<?php echo $total; ?>" />
                        <h5 class="mb-4">Available Balance : <span class="text-success font-weight-bold"><?= $withdraw . " " . $sitecurrency ?></span> </h5>

                        <div class="form-group">
                            <label for="amount">Amount to withdraw <span class="text-danger">*</span> </label>
                            <input type="text" onKeyPress="return phnumbersonly(this,event);" onBlur="checkamt(this.value);" required name="amount" id="amount" class="form-control" placeholder="Enter amount" aria-describedby="amount-help">
                            <small id="amount-help" class="text-muted">Minimum withdrawal amount <?= $gen_minwithdraw . " " . $sitecurrency; ?></small>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" required id="message" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="reset" value="Cancel" class="btn btn-secondary" data-dismiss="modal">
                        <input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
                    </div>
            </form>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        function checkround(input) {
            if (input != '') {
                if (input.value < 100) {
                    document.getElementById('amount').value = "";
                    return false;
                } else {
                    return true;
                }
            }
        }

        function checkamt(str) {
            if (str != "") {
                var amt = <?php echo $withdraw; ?>;
                var minw = <?php echo $gen_minwithdraw; ?>;
                var inamt = str;
                if (inamt < minw-1) {
                    document.getElementById('amount').value = "";
                    alert("Minimum with draw amount must be " + minw + " ! Please try again .");
                } else if (inamt > amt) {
                    document.getElementById('amount').value = "";
                    alert("Your withdraw requested amount maximum reach in available balance ! Check available balance.");
                }
            }
        }
    </script>

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
            $('#example1','#example').DataTable({
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
} );

        });
    </script>
</body>

</html>

