<?php
include "admin/AMframe/config.php";
$id=addslashes($_REQUEST['q']);
$st=$db->singlerec("select * from mlm_membership where id ='$id' and status='1'");
$productDiscount=$com_obj->productDiscountper(1);
?>

<table cellpadding="7" cellspacing="0" border="0" width="80%">
	<tr>
		<td align="right">
			<strong>Membership Amount</strong>
		</td>
		<td align="center">:</td>
		<td>
			<span id="amount"><?php echo $st['act_amount']." ".$sitecurrency; ?></span>
			<input type="hidden" name="amount" id="memamt" value="<?php echo $st['act_amount']; ?>">
		</td>
	</tr>
	<tr>
		<td align="right">
			<strong>Validity</strong>
		</td>
		<td align="center">:</td>
		<td>
			<span id="totamt"><?php echo $st['days'];?></span> Days
			<input type="hidden" name="totamt" id="tot_amt" value="<?php echo $st['days']; ?>">
		</td>
	</tr>
	
</table>