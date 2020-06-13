<?php
include("AMframe/config.php");
error_reporting(0);
$csvoutput =""; 
$cntreq='1'; 
$i=1;
$curdate=date("d-m-Y");	
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=Pair Commission List.xls");
		
		$header = "Pair Commission List";
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
			if($email!=""){
				$em=stripslashes($_REQUEST['user']);
				$search.="and user_id like '%$em%'";
										
			}
			
			if($_REQUEST['fromdate']!="" && $_REQUEST['todate']!=""){
				$FromDate= date("d-m-Y", strtotime($_REQUEST["fromdate"]));
				$ToDate= date("d-m-Y", strtotime($_REQUEST["todate"]));
				$search.=" and (DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') BETWEEN '$FromDate' AND '$ToDate')";
			}
			
			
			$search.=" order by id desc";
		} 
		
		$que="select * from mlm_payout where amount!='' and bonus_type='1' $search";
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
		$filename = "Pair Commission Report$date.csv";
		
	
		echo($csvoutput);
		   
		   
		    ?>
		