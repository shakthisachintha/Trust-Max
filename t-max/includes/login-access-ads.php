<?php 
$ad_ct = $db->numrows("select * from mlm_advertise where ad_location='Login User Access' and ad_dimension='728X90' and ad_status='1'");
if($ad_ct > 0) {
	$adDets = $db->singlerec("select * from mlm_advertise where ad_location='Login User Access' and ad_dimension='728X90' and ad_status='1' order by rand()");
	$img = $adDets['ad_img'];
	if(!empty($img) && file_exists("uploads/advertisement/$img")) {
		$link = $adDets['ad_link'];
	?>
	<div class="col-sm-12 text-center" style="padding-top:26px;">
		<a href="<?php echo $link;?>"><img class="img-responsive" src="uploads/advertisement/<?php echo $img;?>" /> </a>
	</div>
<?php } } ?>