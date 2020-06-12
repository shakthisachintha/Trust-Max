<?php
include("AMframe/config.php");
$country=addslashes($_REQUEST['q']);
?>
<select name="cstate" id="cstate" onchange="return showcity(this.value);">
<option value="">--- Choose State ---</option>
		<?php
		   $sele=$db->get_all("select * from mlm_state where country_id ='$country' and state_status='0'");
		   foreach($sele as $st)
		   {
		?>
		
		<option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
		<?php
			}
		?>

</select>