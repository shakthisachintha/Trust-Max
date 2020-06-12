<?php
include("AMframe/config.php");
error_reporting(0);
$csvoutput =""; 
$cntreq='1'; 
$i=1;
$curdate=date("d-m-Y");
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=Payout List.xls");
		
		$header = "Payout List";
		$header .= "\n\n";
		$csvoutput .= $header;
		
		$str = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black; font-weight:bold;"><td class="blue-bgimg">S.No</td><td class="blue-bgimg">User Id</td><td class="blue-bgimg">Commission Amount</td><td class="blue-bgimg">Reason</td><td class="blue-bgimg">Date</td><td class="blue-bgimg">Status</td></tr></table>';
		
		$csvoutput .= $str;
		
		$search="";
		
		if(isset($_REQUEST['search'])){
			$email=$_REQUEST['user'];	
			$date=$_REQUEST['tmonth'];
			$sdate=$_REQUEST['smonth'];
			$ydate=$_REQUEST['ymonth'];
			$reason=$_REQUEST['reason'];
			if($email!=""){
				$em=stripslashes($_REQUEST['user']);
				$search.="and user_id like '%$em%'";
			}
			
			if($_REQUEST['fromdate']!="" && $_REQUEST['todate']!=""){
				$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
				$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
				$search.=" and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate')";
			}
			
			if($_REQUEST['sindate']!=""){
				$Sindate= date("d-m-Y", strtotime($_REQUEST["sindate"]));
				$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$Sindate')";
			}
			
			if($_REQUEST['stodate']!=""){
				$Stodate= date("d-m-Y", strtotime($_REQUEST["stodate"]));
				$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$Stodate')";
			}
			
			if($_REQUEST['tmonth']!=""){
				$tdate= date("d-m-Y", strtotime($_REQUEST["tmonth"]));
				$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$tdate')";
			}
			
			if($_REQUEST['smonth']!=""){
				$sdate= date("d-m-Y", strtotime($_REQUEST["smonth"]));
				$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$sdate')";
			}
			
			if($_REQUEST['ymonth']!=""){
				$ydate= date("d-m-Y", strtotime($_REQUEST["ymonth"]));
				$search.="and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') like '$ydate')";
			}
			
			if(!empty($reason)) {
				if($reason == "level") {
					$search .= "and reason like 'level%'";
				}
				else if($reason == "referral") {
					$search .= "and reason='Referal Bonus'";
				}
			}
			
			$search.=" order by id desc";
		} 
		
		$que="select * from mlm_payout where amount!='' $search";
							$pout=$db->get_all($que);
							foreach($pout as $poutInfo) {
								$csvoutput .= "\n";
								$date1=date("d-m-Y", $poutInfo['date']);
								$string = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black;"><td class="boreder-bottom">'."$i".'</td><td class="boreder-bottom">'."$poutInfo[user_id]".'</td><td class="boreder-bottom" align="center">'."$poutInfo[amount]".'</td><td class="boreder-bottom">'."$poutInfo[reason]".'</td><td class="boreder-bottom">'."$date1".'</td><td class="boreder-bottom">'; if($poutInfo['status']==0){
                                 $string.= "Pending";
                                 }
                                 else{
                                 $string.= "Approved";
                                 }
								 $string.='</td></tr></table>';
										
							$csvoutput .= $string;
							$i++; }
		   
		  
		   $csvoutput .= "\n";
		$date=date("d-m-y ");
		$filename = "Payout Report$date.csv";
		
	
		echo($csvoutput);
		   
		   
		    ?>
		