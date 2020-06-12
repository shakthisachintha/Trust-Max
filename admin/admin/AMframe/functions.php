<?
function Cnvrt_Crncy($conamt, $from_Currency, $to_Currency) {
 $format=$from_Currency."_".$to_Currency;
 // check for cached data
 $cdata=file_get_contents(__DIR__ . '/cache/result_'.$format.'.json');
 $cdata=json_decode($cdata);
 // check after
 $chkafter=date("d-m-Y H:i:s", strtotime("+6 hours"));
 if(!empty($cdata->amount) && ($cdata->lastfetched < $chkafter)) {
  $amount=$cdata->amount;
 }
 else {
  $ch=curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://free.currencyconverterapi.com/api/v5/convert?q=$format&compact=y"); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
  $output = curl_exec($ch); 
  curl_close($ch);
  $output=json_decode($output);
  // caching data in json file
  $amount=$output->$format->val;
  if(!empty($amount)) {
   $date=date("d-m-Y H:i:s");
   $cache=array("amount" => $amount, "lastfetched" => $date);
   $fp=fopen(__DIR__ . '/cache/result_'.$format.'.json', 'w');
   fwrite($fp, json_encode($cache));
   fclose($fp);
  }
 }
 return bcmul($conamt, $amount, 2);
}

?>