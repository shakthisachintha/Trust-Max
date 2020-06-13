<?php
include("AMframe/config.php");

 $state=addslashes($_REQUEST['q']);
?>
<select name="ccity" id="ccity" >
<option value="">--- Choose City ---</option>
<?php
		   $cities=$db->get_all("select * from mlm_city where state_id='$state' and city_status='0'");
		   foreach($cities as $ct)
		   {
		?>
		
		<option value="<?php echo $ct['city_id']; ?>"><?php echo $ct['city_name']; ?></option>
		<?php
			}
		?>
		</select>