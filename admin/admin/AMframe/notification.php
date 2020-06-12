<?php

class notification extends database{
	
	public function notify($url,$auto_id){
	
	include "global.php";
	$message = "";
	
	$client_id = $_REQUEST['client_id'];
	$service_id = $_REQUEST['service_id'];
	$proposal_no = $_REQUEST['proposal_no'];
	$asset_taken_from = $_REQUEST['asset_taken_from'];
	$relation = $_REQUEST['relation'];
	$dt_of_possession = $_REQUEST['dt_of_possession'];
	$inv_time = $_REQUEST['inv_time'];
	$asset_model = $_REQUEST['asset_model'];
	$inv_year = $_REQUEST['inv_year'];
	$registration_no = $_REQUEST['registration_no'];
	$meter_reading = $_REQUEST['meter_reading'];
	$engine_no = $_REQUEST['engine_no'];
	$chassis_no = $_REQUEST['chassis_no'];
	$color = $_REQUEST['color'];
	$asset_running = $_REQUEST['asset_running'];
	$ast_run_cond = database::drop_down_mail($SKY_YN,$asset_running); 
	$GetClnt = database::singlerec("select name,mobile_1,email_id from gen_user_mst where user_auto_id='$client_id'");
	@extract($GetClnt);
	$GetServ = database::singlerec("select service_name from  service where service_id='$service_id'");
	@extract($GetServ);	
	$message .= "<table width='100%' style='border:solid 1px;'>
				<tr>
					<td width='25%'>Client Name</td><td width='25%'>:$name</td>
					<td>Category</td><td>:$service_name</td>
				</tr>
				<tr>
					<td>Registration Number</td><td>:$registration_no</td>
					<td>Asset Model</td><td>:$asset_model</td>
				</tr>
				<tr>
					<td>Engine Number</td><td>:$engine_no</td>
					<td>Chassis Number</td><td>:$chassis_no</td>
				</tr>
				<tr>					
					<td width='25%'>Agreement Number</td><td width='25%'>:$proposal_no</td>
					<td>Color</td><td>:$color</td>
				</tr>
				<tr>
					<td>Inward Date</td><td>:$dt_of_possession</td>
					<td>Time</td><td>:$inv_time</td>
				</tr>
				<tr>
					<td>Meter reading (km)</td><td>:$meter_reading</td>
					<td>Year</td><td>:$inv_year</td>
				</tr>
				
				<tr>
					<td>Asset Taken from</td><td>:$asset_taken_from</td>
					<td>Relation</td><td>:$relation</td>
				</tr>
				<tr>
					<td>Please specify asset is runing condition</td><td>:$asset_running</td>
					<td colspan='2'></td>
				</tr>
			</table><br/>";
	
	$rc_book = $_REQUEST['rc_book'];
	$inv_key = $_REQUEST['inv_key'];
	$insurance = $_REQUEST['insurance'];
	$tool_kit = $_REQUEST['tool_kit'];
	$front_tyre = $_REQUEST['front_tyre'];
	$back_tyre = $_REQUEST['back_tyre'];
	$stephanie = $_REQUEST['stephanie'];
	$jack = $_REQUEST['jack'];
	$battery = $_REQUEST['battery'];
//	$asset_condition = $_REQUEST['asset_condition'];
//	$seat_condition = $_REQUEST['seat_condition'];
	$mirror_left = $_REQUEST['mirror_left'];
	$mirror_right = $_REQUEST['mirror_right'];
	$musicsys = $_REQUEST['musicsys'];
	$other_specify = $_REQUEST['other_specify'];
	$rc_book_1 = $_REQUEST['rc_book_1'];
	$inv_key_1 = $_REQUEST['inv_key_1'];
	$insurance_1 = $_REQUEST['insurance_1'];
	$tool_kit_1 = $_REQUEST['tool_kit_1'];
	$front_tyre_1 = $_REQUEST['front_tyre_1'];
	$back_tyre_1 = $_REQUEST['back_tyre_1'];
	$stephanie_1 = $_REQUEST['stephanie_1'];
	$jack_1 = $_REQUEST['jack_1'];
	$battery_1 = $_REQUEST['battery_1'];
	//$condition_1 = $_REQUEST['condition_1'];
	//$seat_condition_1 = $_REQUEST['seat_condition_1'];
	$mirror_left_1 = $_REQUEST['mirror_left_1'];
	$mirror_right_1 = $_REQUEST['mirror_right_1'];
	$musicsys_1 = $_REQUEST['musicsys_1'];
	
	$rcbooklist = database::drop_down_mail($SKY_YN,$rc_book); 
	$keylist = database::drop_down_mail($SKY_YN,$inv_key); 
	$insurlist = database::drop_down_mail($SKY_YN,$insurance); 
	$toolkitlist = database::drop_down_mail($SKY_YN,$tool_kit); 
	$fronttyrelist = database::drop_down_mail($SKY_Tyre,$front_tyre); 
	$backtyrelist = database::drop_down_mail($SKY_Tyre,$back_tyre); 
	$stephabielist = database::drop_down_mail($SKY_YN,$stephanie); 
	$jacklist = database::drop_down_mail($SKY_YN,$jack);
	$batterylist = database::drop_down_mail($SKY_Battery,$battery); 
	//$conditionlist = database::drop_down_mail($SKY_Tyre,$asset_condition);
	//$seatstephabielist = database::drop_down_mail($SKY_Tyre,$seat_condition); 
	$mirrorleftlist = database::drop_down_mail($SKY_YN,$mirror_left);
	$mirrorrightlist = database::drop_down_mail($SKY_YN,$mirror_right);
	$musicsyslist = database::drop_down_mail($SKY_YN,$musicsys);
	$message .= "<table width='100%' style='border:solid 1px;'>
						<tr><td width='25%'>Key</td><td>:$keylist</td><td>$inv_key_1</td></tr>
						<tr><td width='25%'>Battery</td><td>:$batterylist</td><td>$battery_1</td></tr>
						<tr><td width='25%'>Stephanie</td><td>:$stephabielist</td><td>$stephanie_1</td></tr>
						<tr><td width='25%'>Jack</td><td>:$jacklist</td><td>$jack_1</td></tr>
						<tr><td width='25%'>Tool Kit</td><td>:$toolkitlist</td><td>$tool_kit_1</td></tr>
						<tr><td width='25%'>Mirrors(Left)</td><td>:$mirrorleftlist</td><td>$mirror_left_1</td></tr>
						<tr><td width='25%'>Mirrors(Right)</td><td>:$mirrorrightlist</td><td>$mirror_right_1</td></tr>
						<tr><td width='25%'>RC Book</td><td>:$rcbooklist</td><td>$rc_book_1</td></tr>
						<tr><td width='25%'>Insurance</td><td>:$insurlist</td><td>$insurance_1</td></tr>
						<tr><td width='25%'>Front trye</td><td>:$fronttyrelist</td><td>$front_tyre_1</td></tr>
						<tr><td width='25%'>Back tyre/s</td><td>:$backtyrelist</td><td>$back_tyre_1</td></tr>
						<tr><td width='25%'>Music System</td><td>:$musicsyslist</td><td>$musicsys_1</td></tr>
						<tr><td width='25%'>Others, specify</td><td>:$other_specify</td><td></td></tr>
					</table><br/>";	
	
	$surrender_name = $_REQUEST['surrender_name'];
	$aggency_name = $_REQUEST['aggency_name'];
	$yard_name = $_REQUEST['yard_name'];
	$godown_keeper = $_REQUEST['godown_keeper'];
	$park_date = $_REQUEST['park_date'];
	$park_time = $_REQUEST['park_time'];	
	$message .="<table width='100%' style='border:solid 1px;'>
						<tr><td>Name of the person surrendered the asset to yard</td><td>:$surrender_name</td></tr>
						<tr><td>Agency Name </td><td>:$aggency_name</td></tr>
						<tr><td>Yard Name </td><td>:$yard_name</td></tr>
						<tr><td>Godown Keeper Name </td><td>:$godown_keeper</td></tr>
						<tr><td>Date and time of parking the yard </td><td>:$park_date / $park_time</td></tr>
					</table>";
	
	$GetPhoto = database::singlerec("select photo_1,photo_2,photo_3,photo_4,photo_5,photo_6,photo_7,photo_8,photo_9,photo_10 from inventory where id='$auto_id'");
	@extract($GetPhoto);	
	$message .="<table width='100%' style='border:solid 1px;'>
						<tr>
							<td><img src='$url/vehiclephoto/$photo_1' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_2' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_3' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_4' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_5' width='120'></td>
						</tr>
						<tr><td colspan='5'><br/></td></tr>
						<tr>
							<td><img src='$url/vehiclephoto/$photo_6' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_7' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_8' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_9' width='120'></td>
							<td><img src='$url/vehiclephoto/$photo_10' width='120'></td>
						</tr>
					</table>";
		
		$to = $email_id;
		$subject = 'Welcome J.P Parking';					
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		@mail($to,$subject,$message,$headers);
	}
}	
?>