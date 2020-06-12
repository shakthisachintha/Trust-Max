<?php
include("AMframe/config.php");
error_reporting(0);
$csvoutput =""; 
$cntreq='1'; 
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=User List.xls");
$cudate=date("Y-m-d");	

		$header = "User List";
		$header .= "\n\n";
		$csvoutput .= $header;
		
		$str = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black; font-weight:bold;"><td class="blue-bgimg">S.No</td><td class="blue-bgimg">ProfileID</td><td class="blue-bgimg">Name</td><td class="blue-bgimg">Date</td><td class="blue-bgimg">Renewal Status</td></tr></table>';
		
		$csvoutput .= $str;
		
		if(isset($_REQUEST['search'])){
			$user_name=$_REQUEST['user'];	
			if($user_name!=""){
				$search2.="and profileid like '%$user_name%'";
										
			}
			if($_REQUEST['fromdate']!="" && $_REQUEST['todate']!=""){
				$fromdate=date('Y-m-d', strtotime($_REQUEST['fromdate']));
				$todate=date('Y-m-d', strtotime($_REQUEST['todate']));
				$search2.="and (created_at>='$fromdate' and created_at<='$todate')";
			}
			
		} 
		
		$search="";
		$dwn=$_REQUEST['dnlne'];
		$sdate=$_REQUEST['smonth'];
		$ydate=$_REQUEST['ymonth'];
		
			if($dwn!=""){
				$search.=" where user_sponserid='$dnlne'";
			}
			
		$req=$db->get_all("select * from mlm_register $search order by user_id desc");
									
		$i=1;
		$num=$db->numrows("select * from mlm_register $search order by user_id desc");
									
		foreach($req as $row_req)
		{
			$csvoutput .= "\n";
			$comm=$row_req['req_cvamount']*($row_req['tds_percent']/100);
			$date1=date("d-m-Y",strtotime($row_req['user_date']));
			$ismemExpired=$ext_obj->ismemExpired($row_req['user_profileid']);
			if(!$ismemExpired){
				$msg="Renewed";
			}else{
				$msg="Non-Renewed";
			}
			$string = '<table border="0" cellpadding="0" cellspacing="0" id="ctbl"><tr style="border: 1px solid black;"><td class="boreder-bottom">'."$i".'</td><td class="boreder-bottom">'."$row_req[user_profileid]".'</td><td class="boreder-bottom" align="center">'."$row_req[user_fname]"."$row_req[user_lname]".'</td><td class="boreder-bottom">'."$date1".'</td><td class="boreder-bottom">'."$msg".'</td></tr></table>';
			$csvoutput .= $string;
			$i++; }
		   
		  
		   $csvoutput .= "\n";
		$date=date("d-m-y ");
		$filename = "User Report$date.csv";
		
	
		echo($csvoutput);
		   
		   
		    ?>
		