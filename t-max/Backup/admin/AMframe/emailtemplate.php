<?php
class emailtemplate {
	
	function standered($siteinfo,$text){
		$sitetitle = $siteinfo['sitetitle'];
		$siteurl = $siteinfo['siteurl'];
		$sitelogo = $siteurl."/admin/uploads/general-setting/".$siteinfo['sitelogo'];
		$siteemail = $siteinfo['siteemail'];
		$_fb = $siteinfo['fburl'];
		$_tw = $siteinfo['twurl'];
		$_gp = $siteinfo['gpurl'];
		$_ln = $siteinfo['lnurl'];
				
		$msg = "<body bgcolor='#E1E1E1' leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
		<center style='background-color:#f1f1f1;'>
		   <table bgcolor='#FFFFFF'  border='0' cellpadding='0' cellspacing='0' width='620' style='color:#FFFFFF; background:#1976D2;'>
			   <tr >
				  <td align='center' valign='top' class='textContent' style='font-size:12px; font-family: Helvetica,Arial,sans-serif; padding:10px; color:white;font-weight:bold'>
				   Support Email : $siteemail
				  </td>
			  </tr>
			</table>

			<table bgcolor='#FFFFFF'  border='0' cellpadding='0' cellspacing='0' width='620' id='emailBody'>
				<tr>
					<td align='center' valign='top'>
						<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF;' bgcolor='#ffffff'>
							<tr>
								<td align='center' valign='top'>
									<table border='0' cellpadding='0' cellspacing='0' width='500' class='flexibleContainer'>
										<tr>
											<td align='center' valign='top' width='600' class='flexibleContainerCell'>
												<!-- // CONTENT TABLE -->
												<table border='0' cellpadding='15' cellspacing='0' width='100%'>
													<tr>
														<td align='center' valign='top' class='textContent'>
														  <a href='$siteurl' target='_blank'>
															<img src='$sitelogo' class='img-responsive'></a>
														</td>
													</tr>
												</table>
												<!-- // CONTENT TABLE -->
											</td>
										</tr>
									</table>
									<!-- // FLEXIBLE CONTAINER -->
								</td>
							</tr>
						</table>
						<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding: 40px;     background:#D3E6F9;' bgcolor='#ffffff'>
							<tr>
								<td align='center' valign='top'>
									<table border='0' cellpadding='0' cellspacing='0' width='500' class='flexibleContainer'>
										<tr>
											<td align='center' valign='top' width='600' class='flexibleContainerCell'>
												<table border='0' cellpadding='0' cellspacing='0' width='100%' style='font-size:16px;'>
													<tr>
														<td align='center' valign='top' class='textContent' style='font-size: 16px; font-family: Helvetica,Arial,sans-serif; color:#4C4C4C; font-weight: 600;'>
															$text
														</td>
													</tr>
												</table>
												<!-- // CONTENT TABLE -->
											</td>
										</tr>
									</table>
									<!-- // FLEXIBLE CONTAINER -->
								</td>
							</tr>
						</table>
						<!-- // CENTERING TABLE -->
					 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding: 10px; background:#1976D2;'>
						<tr>
						   <td></td>
						</tr>
					 </table>   
					  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding:26px; background:#d8dde4;'>
						<!--<tr>
						   <td align='center' style='color:#999;'>
							<table width='200' border='0' cellspacing='2' cellpadding='0'>
							  <tr>
								<td><a href='$_fb' target='_blank'><img src='http://www.exclusivescript.com/images/social/facebook.png' width='32'></a></td>
								<td><a href='$_tw' target='_blank'><img src='http://www.exclusivescript.com/images/social/twitter.png' width='32'></a></td>
								<td><a href='$_gp' target='_blank'><img src='http://www.exclusivescript.com/images/social/google-plus.png' width='32'></a></td>
								<td><a href='$_ln' target='_blank'><img src='http://www.exclusivescript.com/images/social/linkedin.png' width='32'></a></td>
							  </tr>
							</table>
						   </td>
						</tr>-->
						<tr>
						   <td align='center' style='color:#999; font-family: Helvetica,Arial,sans-serif; font-size: 12px;'>
							  Copyright &copy; ".date("Y")." $sitetitle. All rights reserved.
						   </td>
						</tr>
					 </table>
				</td>
			</tr>
			</table>
		</center>
		</body>";
		
		return $msg;
	}

	function notice_mail($siteinfo,$contact,$message){		
		$sitetitle = $siteinfo['sitetitle'];
		$siteteam = $siteinfo['siteteam'];
		$siteurl = $siteinfo['siteurl'];
		$sitelogo = $siteurl."/admin/uploads/general-setting/".$siteinfo['sitelogo'];		
		$siteemail = $siteinfo['siteemail'];
		$_fb = $siteinfo['fburl'];
		$_tw = $siteinfo['twurl'];
		$_gp = $siteinfo['gpurl'];
		$_ln = $siteinfo['lnurl'];		
				
		$msg = "<body bgcolor='#E1E1E1' leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
		<div style='background:#f5f5f5;margin:0 auto'>
   <table cellspacing='0' cellpadding='0' border='0' bgcolor='' width='600' style='margin:0 auto; 100%'>
      <tbody>
         <tr>
            <td valign='top' style='padding-left:0px'></td>
         </tr>
         <tr>
            <td>
               <table width='600' style='background:#ffffff;border:1px solid #e2e2e2'>
                  <tbody>
                     <tr>
                        <td>
                           <table style='width:100%'>
                              <tbody>
                                 <tr>
                                    <td valign='top' style='padding:2px 6px;border:0px'>
                                       <table cellspacing='0' cellpadding='0' border='0' bgcolor='#ffffff' width='100%'>
                                          <tbody>
                                             <tr>
                                                <td valign='top' style='padding:0px'> <a href='#' target='_blank' data-saferedirecturl='#'> <img border='0' src='assets/img/logo.png' alt='' style='display:block' class='CToWUd'> </a> </td>
                                                <td align='right' valign='top' style='padding:0px;padding:12px 10px 5px 5px'>
                                                   <table cellspacing='0' cellpadding='0' border='0'>
                                                      <tbody>
                                                         <tr>
                                                            <td align='right' valign='middle' style='vertical-align:middle;padding-left:0px;font:bold 11px arial; color:#a2a2a2;'> Call Us </td>
                                                            <td align='right' valign='middle' style='vertical-align:middle;padding-left:5px;font:normal 11px arial;color:#a2a2a2;line-height:20px'>$contact</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td valign='top' style='padding:0px;border:0px'>
                                       <table cellspacing='0' cellpadding='0' border='0' bgcolor='#a2a2a2' width='100%' height='1'>
                                          <tbody>
                                             <tr></tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <tr> </tr>
                     <tr style=''>
                        <td align='center' >
                           <div style='font:bold 20px arial;padding:10px 5px 15px;color:#a2a2a2; '>
                              Welcome to&nbsp; $sitetitle <!-- <span style='color:#D61C23'>B</span><span style='color:#4E68A1;'>2</span><span style='color:#D61C23'>B</span> --> 
                           </div>
                        </td>
                     </tr>
					 <tr>
					<td align='center' valign='top'>
						<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF;' bgcolor='#ffffff'>
							<tr>
								<td align='center' valign='top'>
									<table border='0' cellpadding='0' cellspacing='0' width='500' class='flexibleContainer'>
										<tr>
											<td align='center' valign='top' width='600' class='flexibleContainerCell'>
												<!-- // CONTENT TABLE -->
												<table border='0' cellpadding='15' cellspacing='0' width='100%'>
													<tr>
														<td align='center' valign='top' class='textContent'>
														  <a href='$siteurl' target='_blank'>
															<img src='$sitelogo'></a>
														</td>
													</tr>
												</table>
												<!-- // CONTENT TABLE -->
											</td>
										</tr>
									</table>
									<!-- // FLEXIBLE CONTAINER -->
								</td>
							</tr>
                     <tr>
                        <td valign='top' style='padding:15px 1px 15px 18px;font:normal 12px arial;color:#000;'>
                           $message 
                        </td>
                     </tr>
					 <tr>
                        <td valign='top' style='padding:15px 1px 15px 18px;font:normal 12px arial;color:#000;'
                           We also offer 24/7 Customer Service so you can contact us anytime you need help
                           $contact
                        </td>
                     </tr>
                     <tr>
                        <td valign='top' style='padding:15px 1px 15px 18px;font:bold 12px arial;color:#000;'>Warm Regards,<br> <span style='color:#D61C23'><b>Team $siteteam</b></span> </td>
                     </tr>
                  </tbody>
                  <tbody>
                     <tr>
                        <td>
                           <table>
                              <tbody>
                                 <tr>
                                    <td style='border-top:1px solid #cccccc;border-bottom:none;border-right:none;border-left:none'> </td>
                                 </tr>
                                 <tr>
                                    <td style='border-top:1px dashed #cccccc;border-bottom:none;border-right:none;border-left:none'> </td>
                                 </tr>
                                 <tr>
                                    <td valign='top' style='padding:0px 6px 1px;border:0px'> </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         <!--<tr>
            <td>
               <table>
                  <tbody>
                     <tr>
                        <td>
                           <table width='600'>
                              <tbody>
                                 <tr>
                                    <td align='center' valign='top' style='padding:10px 23px 20px;font:normal 10px arial;color:#8e8e8e'> Want to Unsubscribe? We are sorry to see you go, but happy to make it easy on you.<a href='#' target='_blank'>Unsubscribe</a> </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>-->
      </tbody>
   </table>
   <div class='yj6qo'></div>
   <div class='adL'></div>
</div>
		</body>";
		
		return $msg;
	}
	
	function standered123($siteinfo,$text,$tempkey){
		$sitetitle = $siteinfo['website_title'];
		$siteurl = $siteinfo['website_url'];
		$sitelogo = $siteurl.'/admin/uploads/general-setting/'.$siteinfo['img'];
		$siteemail = $siteinfo['admin_email'];
		$_fb = $siteinfo['fburl'];
		$_tw = $siteinfo['twurl'];
		$_gp = $siteinfo['gplusurl'];
		$_ln = $siteinfo['linkedinurl'];
		
		if($tempkey!='') {
			$siteurl_tkey = $siteurl.'?temp='.$tempkey;
		}
		else {
			$siteurl_tkey = $siteurl;
		}		
				
		$msg = "<body bgcolor='#E1E1E1' leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
		<center style='background-color:#f1f1f1;'>
		   <table bgcolor='#FFFFFF'  border='0' cellpadding='0' cellspacing='0' width='620' style='color:#FFFFFF; background:#1976D2;'>
			   <tr >
				  <td align='center' valign='top' class='textContent' style='font-size:12px; font-family: Helvetica,Arial,sans-serif; padding:10px; color:white;font-weight:bold'>
				   Support Email : $siteemail
				  </td>
			  </tr>
			</table>

			<table bgcolor='#FFFFFF'  border='0' cellpadding='0' cellspacing='0' width='620' id='emailBody'>
				<tr>
					<td align='center' valign='top'>
						<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF;' bgcolor='#ffffff'>
							<tr>
								<td align='center' valign='top'>
									<table border='0' cellpadding='0' cellspacing='0' width='500' class='flexibleContainer'>
										<tr>
											<td align='center' valign='top' width='600' class='flexibleContainerCell'>
												<!-- // CONTENT TABLE -->
												<table border='0' cellpadding='15' cellspacing='0' width='100%' height='100px'>
													<tr>
														<td align='center' valign='top' class='textContent'>
														  <a href='$siteurl' target='_blank'>
															<img src=$sitelogo></a>
														</td>
													</tr>
													<tr>
															<td align='center' valign='top' class='textContent' style='color:#000;'>
																
														</td>
														
													</tr>
												</table>
												<!-- // CONTENT TABLE -->
											</td>
										</tr>
									</table>
									<!-- // FLEXIBLE CONTAINER -->
								</td>
							</tr>
						</table>
						<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding: 40px;     background:#D3E6F9;' bgcolor='#ffffff'>
							<tr>
								<td align='center' valign='top'>
									<table border='0' cellpadding='0' cellspacing='0' width='500' class='flexibleContainer'>
										<tr>
											<td align='center' valign='top' width='600' class='flexibleContainerCell'>
												<table border='0' cellpadding='0' cellspacing='0' width='100%' style='font-size:16px;'>
													<tr>
														<td align='center' valign='top' class='textContent' style='font-size: 16px; font-family: Helvetica,Arial,sans-serif; color:#4C4C4C; font-weight: 600;'>
															$text
														</td>
													</tr>
													<tr>
														<td align='center' valign='top' class='textContent' style='padding-top: 30px;' >
															<a style='color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%; padding: 10px 20px;background: #F79118; border-radius: 30px;' href='$siteurl_tkey' target='_blank'>Click Here</a><br /><br />
														</td>
													</tr>
												</table>
												<!-- // CONTENT TABLE -->
											</td>
										</tr>
									</table>
									<!-- // FLEXIBLE CONTAINER -->
								</td>
							</tr>
						</table>
						<!-- // CENTERING TABLE -->
					 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding: 10px; background:#1976D2;'>
						<tr>
						   <td align='center'>If you believe this is an error, ignore this message and we'll never bother you again. </td>
						</tr>
					 </table>   
					  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF; border:0px solid #000; padding:26px; background:#d8dde4;'>
						<!--<tr>
						   <td align='center' style='color:#999;'>
							<table width='200' border='0' cellspacing='2' cellpadding='0'>
							  <tr>
								<td><a href='$_fb' target='_blank'><i class='icon-facebook'></i></a></td>
								<td><a href='$_tw' target='_blank'><i class='icon-twitter'></i></a></td>
								<td><a href='$_gp' target='_blank'><i class='icon-google'></i></a></td>
								<td><a href='$_ln' target='_blank'><i class='icon-instagram'></i></a></td>
							  </tr>
							</table>
						   </td>
						</tr>-->
						<tr>
						   <td align='center' style='color:#999; font-family: Helvetica,Arial,sans-serif; font-size: 12px;'>
							  Copyright &copy; ".date("Y")." $sitetitle. All rights reserved.
						   </td>
						</tr>
					 </table>
				</td>
			</tr>
			</table>
		</center>
		</body>";
		
		return $msg;
	}
}
?>


 