<?php
include("AMframe/config.php");
error_reporting(0);
$csvoutput =""; 
$cntreq='1'; 
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=Withdraw List.xls");
$cudate=date("Y-m-d");	

		$header = "Withdrawal List";
		$header .= "\n\n";
		$csvoutput .= $header;
		
		$str = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black; font-weight:bold;"><td class="blue-bgimg">S.No</td><td class="blue-bgimg">Name</td><td class="blue-bgimg">Withdraw Amount</td><td class="blue-bgimg">TDS(%)</td><td class="blue-bgimg">Commission Price</td><td class="blue-bgimg">Date</td><td class="blue-bgimg">IP</td></tr></table>';
		
		$csvoutput .= $str;
		
		if(isset($_REQUEST['search'])){
			$user_name=$_REQUEST['user'];	
			if($user_name!=""){
				$search2.="and (user_fname like '%$user_name%' or user_lname like '%$user_name%')";
			}
			if($_REQUEST['fromdate']!="" && $_REQUEST['todate']!=""){
				$fromdate=date('Y-m-d', strtotime($_REQUEST['fromdate']));
				$todate=date('Y-m-d', strtotime($_REQUEST['todate']));
				$search2.="and (req_date>='$fromdate' and req_date<='$todate')";
			}
			
		} 
		
		$search="";
		$date=$_REQUEST['tmonth'];
		$sdate=$_REQUEST['smonth'];
		$ydate=$_REQUEST['ymonth'];
		
			if($date!=""){
				$search.="and (req_date<='$cudate' and req_date>='$date')";
			}
			
			if($sdate!=""){
				$search.="and (req_date<='$cudate' and req_date>='$sdate')";
			}
			
			if($ydate!=""){
				$search.="and (req_date<='$cudate' and req_date>='$ydate')";
			}
									
		$req=$db->get_all("select * from mlm_withdrawrequsets,mlm_register where req_status=0 and req_rpstatus='1' and user_id=req_userid $search2 $search order by req_id desc");
									
		$i=1;
		$num=$db->numrows("select * from mlm_withdrawrequsets where req_status=0 order by req_id desc");
									
		foreach($req as $row_req)
		{
			$csvoutput .= "\n";
			$comm=$row_req['req_cvamount']*($row_req['tds_percent']/100);
			$date1=date("d-m-Y",strtotime($row_req['req_date']));
									
			$string = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black;"><td class="boreder-bottom">'."$i".'</td><td class="boreder-bottom">'."$row_req[user_fname]".'</td><td class="boreder-bottom" align="center">'."$row_req[req_cvamount]".'</td><td class="boreder-bottom">'."$row_req[tds_percent]".'</td><td class="boreder-bottom">'."$comm".'</td><td class="boreder-bottom">'."$date1".'</td><td class="boreder-bottom">'."$row_req[req_ip]".'</td></tr></table>';
			$csvoutput .= $string;
			$i++; }
		   
		  
		   $csvoutput .= "\n";
		$date=date("d-m-y ");
		$filename = "Withdraw Report$date.csv";
		
	
		echo($csvoutput);
		   
		   
		    ?>
		