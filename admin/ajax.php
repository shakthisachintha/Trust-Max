<?php
include("AMframe/config.php");

//Ajax for Ad
if(isset($_REQUEST['ad_id']) && !empty($_REQUEST['ad_id'])) {
	$ad_id = $_REQUEST['ad_id'];
	$key = array_search($ad_id,$GT_ad_pg);
	echo $GT_ad_dim[$key];
}

if(isset($_REQUEST['news_id']) && !empty($_REQUEST['news_id'])) {
	$idval = $_REQUEST['news_id'];
	
	$getdet = $db->singlerec("select news_title,news_desc,news_image from mlm_news where news_id='$idval'");
	$arr = array('title' => $getdet['news_title'], 'descript' => stripslashes($getdet['news_desc']), 'img' => $getdet['news_image']);
	echo json_encode($arr);
}

if(isset($_REQUEST['event_id']) && !empty($_REQUEST['event_id'])) {
	$idval = $_REQUEST['event_id'];
	
	$getdet = $db->singlerec("select event_title,event_desc,event_image,event_date from mlm_events where event_id='$idval'");
	$arr = array('title' => $getdet['event_title'], 'descript' => stripslashes($getdet['event_desc']), 'img' => $getdet['event_image'],'dat' => $getdet['event_date']);
	echo json_encode($arr);
}

if(isset($_REQUEST['testimon_id']) && !empty($_REQUEST['testimon_id'])) {
	$idval = $_REQUEST['testimon_id'];
	
	$getdet = $db->singlerec("select test_title,test_comment,testmonial_img,test_user from mlm_testimonial where test_id='$idval'");
	$arr = array('title' => $getdet['test_title'], 'comment' => stripslashes($getdet['test_comment']), 'img' => $getdet['testmonial_img'], 'user' => $getdet['test_user']);
	echo json_encode($arr);
}

if(isset($_REQUEST['faq_id']) && !empty($_REQUEST['faq_id'])) {
	$idval = $_REQUEST['faq_id'];
	
	$getdet = $db->singlerec("select faq_qtn,faq_ans from mlm_faq where faq_id='$idval'");
	$arr = array('quesn' => $getdet['faq_qtn'], 'answer' => stripslashes($getdet['faq_ans']));
	echo json_encode($arr);
}
?>