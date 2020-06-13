<?php
include "admin/Amframe/config.php";
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
			<strong>Product</strong>
		</td>
		<td align="center">:</td>
		<td>
			<select class="form-control" name="pro" onchange="return prd_cost(this.value)" required>
				<option value="">Choose product</option>
				<?php
				$pron=$db->get_all("select * from mlm_products where pro_status='0'");
				$count=$db->numrows("select * from mlm_products where pro_status='0'");
				foreach($pron as $pro){
					$pro_n=$pro['pro_name'];
					$pro_id=$pro['pro_id'];
					echo "<option value='$pro_id'>$pro_n</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">
			<strong>Qty</strong>
		</td>
		<td align="center">:</td>
		<td>
		   <input class="form-control" type="number" id="qty" name="qty" min="1" value="1" onchange="return perupd(this.value);"/>
		</td>
	</tr>
	<tr>
		<td align="right">
			<strong>Product Cost</strong>
		</td>
		<td align="center">:</td>
		<td>
			<span id="prdcost"><?php echo "0"; ?></span> <?php echo $sitecurrency; ?>
			<input type="hidden" name="prdcost" id="prcost">
		</td>
	</tr>
	<tr>
		<td align="right">
			<strong>Discount In Membership</strong>
		</td>
		<td align="center">:</td>
		<td>
			<span id="discount"><?php echo $productDiscount; ?>%</span>
		</td>
	</tr>
	<tr>
		<td align="right">
			<strong>Total Amount (to be paid)</strong>
		</td>
		<td align="center">:</td>
		<td>
			<span id="totamt"><?php echo $st['act_amount']; ?></span> <?php echo $sitecurrency; ?>
			<input type="hidden" name="totamt" id="tot_amt" value="<?php echo $st['act_amount']; ?>">
		</td>
	</tr>
	
</table>