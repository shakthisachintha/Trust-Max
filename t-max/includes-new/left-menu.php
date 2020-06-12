<?php $currentpagename=getPageName();

$sponid=$userdetail['user_sponsername'];
$detail=$com_obj->singlerec("select * from mlm_register where user_profileid='$sponid' and user_status='0'"); ?>
<div class="col-xl-3 col-lg-4 m-b30">
							<div class="sticky-top">
								<div class="candidate-info">
									<div class="candidate-detail text-center">
										<div class="canditate-des">
											<a href="javascript:void(0);">
												<img alt="" src="<?=$profileimages?>">
											</a>
											
										</div>
										<div class="candidate-title">
											<div class="">
											    <? //if($user['user_paymentstaus']==0) {  ?>
											 <!--<h6 class="m-b5">
											 <b style="color:red">PAYMENT STATUS : <? echo "PENDING"; ?></b>
											 </h6>
											 <form action="dashboard.php" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
											 <div class="row">
											  <div class="col-sm-8">
												  <input class="form-control" type="file" name="payslip" id="payslip">
												</div>  
												<div class="col-sm-4">
												   <button style="padding: 12px 8px;" type="submit" name="uploadpay" class="btn btn-primary  m-b30">SUBMIT</button>
												</div>
												</div>
											</form>
											<? //} else { ?>
											<? //} ?> 
											-->

											    <h6 class="m-b5">
												<b style="color:green">PAYMENT STATUS : SUCCESS</b>
												</h6>
												<h4 class="m-b5"><?php echo ucwords($userdetail['user_fname'].' '.$userdetail['user_lname']); ?></h4>
												<p class="m-b0"><?php echo $userdetail['user_email']; ?></p>
											</div>
											<ul class="proid">
												<li class=""><b>Profile ID :</b><span class="pull-right"><?php echo $userdetail['user_profileid']; ?></span></li>
												<li class=""><b>Sponsor Name :</b><span class="pull-right"><?php echo $sponid; ?></span></li>
											</ul>
										</div>
									</div>
									
									<ul class="tree-container">
									    <li <?php if($currentpagename=="dashboard.php") { echo 'class="active"'; } ?>><a href="dashboard.php">
											<i class="zmdi zmdi-view-dashboard" aria-hidden="true"></i> 
											<span>Dashboard</span></a></li>
										<li class="tree-li diactive sati-tree-conta">
										<i class="zmdi zmdi-account-box-o" aria-hidden="true"></i><span class="text">Profile</span>
											<ul class="tree-ul diactive">
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="fullprofile.php"> User Profile</a></span>
												 </li>
												 
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="editprofile.php"> Edit Profile</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="photo.php"> Change Picture</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="changepassprofile.php"> Change Password</a></span>
												 </li>
											  </ul>
										</li>
										<li <?php if($currentpagename=="profile.php") { echo 'class="active"'; } ?>><a href="profile.php">
											<i class="zmdi zmdi-balance-wallet" aria-hidden="true"></i> 
											<span>Purchased History</span></a></li>
										<li <?php if($currentpagename=="memberpackage.php") { echo 'class="active"'; } ?>><a href="memberpackage.php">
											<i class="zmdi zmdi-trending-up" aria-hidden="true"></i> 
											<span>Upgrade Package</span></a></li>
										<li <?php if($currentpagename=="payout.php") { echo 'class="active"'; } ?>><a href="payout.php">
											<i class="zmdi zmdi-shopping-cart" aria-hidden="true"></i> 
											<span>Referral Payout</span></a></li>
										<li <?php if($currentpagename=="level-payout.php") { echo 'class="active"'; } ?>><a href="level-payout.php">
											<i class="zmdi zmdi-shopping-cart-plus" aria-hidden="true"></i> 
											<span>Level Payout</span></a></li>
										
										<li <?php if($currentpagename=="pair-capping-payout.php") { echo 'class="active"'; } ?> ><a href="pair-capping-payout.php">
											<i class="zmdi zmdi-favorite" aria-hidden="true"></i> 
											<span>Pair capping</span></a></li>
										<li <?php if($currentpagename=="binary.php") { echo 'class="active"'; } ?>><a href="binary.php">
											<i class="zmdi zmdi-comment-list" aria-hidden="true"></i> 
											<span>Binary Genealogy</span></a></li>
										<li <?php if($currentpagename=="send_withdraw.php") { echo 'class="active"'; } ?>><a href="send_withdraw.php">
											<i class="zmdi zmdi-balance-wallet" aria-hidden="true"></i> 
											<span>Send Withdrawal Request</span></a></li>
										<li <?php if($currentpagename=="epin.php") { echo 'class="active"'; } ?>><a href="epin.php">
											<i class="zmdi zmdi-trending-up" aria-hidden="true"></i> 
											<span>Epin</span></a></li>
										<li <?php if($currentpagename=="cancel_withdraw.php") { echo 'class="active"'; } ?>><a href="cancel_withdraw.php">
											<i class="zmdi zmdi-favorite" aria-hidden="true"></i> 
											<span>Cancel Withdrawal Request</span></a></li>	
										
										<li <?php if($currentpagename=="wallet.php") { echo 'class="active"'; } ?>><a href="wallet.php">
											<i class="zmdi zmdi-shopping-cart" aria-hidden="true"></i> 
											<span>Wallet Statement</span></a></li>
									
										<li class="tree-li diactive sati-tree-conta">
										<i class="zmdi zmdi-email" aria-hidden="true"></i><span class="text">Mail System</span>
											<ul class="tree-ul diactive">
											     <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="mail.php"> Mail Statistics </a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="mail-compose.php"> Compose Mail</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="inbox.php"> Inbox</a></span>
												 </li>
												 
												 
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="mail-sent.php"> Sent Mail</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="outbox.php"> Outbox</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="forward.php"> Forward Mail</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="read.php"> Read Mail</a></span>
												 </li>
												 <li class="tree-li">
													<i class="zmdi zmdi-arrow-right arrw-clre" aria-hidden="true"></i><span class="text"><a href="unread.php"> Unread Mail</a></span>
												 </li>
												 
											  </ul>
										</li>
										<li><a href="index.php">
											<i class="zmdi zmdi-sign-out" aria-hidden="true"></i> 
											<span>Log Out</span></a></li>
									</ul>
								</div>
							</div>
						</div>