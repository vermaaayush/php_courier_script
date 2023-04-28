<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('../library.php');
require_once('../database.php');
require_once('../database-settings.php');

$payment_mode = "Live"; // "Live" or "Test"

$result1 =  mysql_query("SELECT * FROM company where id='1'");
while($row = mysql_fetch_array($result1)) {
$mail  = $row["cemail"];
$web  = $row["website"];
$paypal_email = "$mail";  // This is your paypal email address
$user_or_payer_email_address = $_SESSION['user_name']; // This is the email address of your user that is about to make a payment
}

$your_website_logo_url =  APP_URL."/logo-image/image_logo.php?id=1' height='39' width='150'";

$item_name = $_SESSION['user_name'];	// This is the name of the item that a user is about to pay for

$shipping_subtotal= $_GET['shipping_subtotal'];
$sql_1 = "SELECT shipping_subtotal,cons_no,note FROM courier_online WHERE shipping_subtotal = '$shipping_subtotal' AND email ='$user_or_payer_email_address' AND payment='Pending'";
$result2 = dbQuery($sql_1);		
while($data = dbFetchAssoc($result2)) {
	extract($data);	
	
$item_amount = $shipping_subtotal; // This is the amount charged for the item that a user is about to pay for
$item_number = $cons_no;	// # tracking
$item_name = $note;
$currency_code = $currency;
}

$no_note = '1';	// 1= Yes, 0 = No
$cmd = '_xclick';


// This is the URL to the notification page on your website
$vpb_notification_url = 'http://'.str_replace(basename($_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]), '', $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]).'notifications-paypal.php';


/*===========================    You do not need to modify the below codes unless you know what you are doing   ==============================*/

// For data security
class vpb_rc4_algorithm
{
   public function vpb_encodes($a,$b){
      for($i,$c;$i<256;$i++)$c[$i]=$i;
      for($i=0,$d,$e,$g=strlen($a);$i<256;$i++){
         $d=($d+$c[$i]+ord($a[$i%$g]))%256;
         $e=$c[$i];
         $c[$i]=$c[$d];
         $c[$d]=$e;
      }
      for($y,$i,$d=0,$f;$y<strlen($b);$y++){
         $i=($i+1)%256;
         $d=($d+$c[$i])%256;
         $e=$c[$i];
         $c[$i]=$c[$d];
         $c[$d]=$e;
         $f.=chr(ord($b[$y])^$c[($c[$i]+$c[$d])%256]);
      }
      return $f;
   }
   public function vpb_decodes($a,$b){return vpb_rc4_algorithm::vpb_encodes($a,$b);}
}
function vpb_encrpt_url_data($data)
{
	$key  = 'a7e88837b63bf2941ef819dc8ca282';
	$plain_text = vpb_rc4_algorithm::vpb_encodes($key,$data);
	return base64_encode($plain_text);
}

// Payment is completed successfully. This is the success page URL
$return_url = $vpb_notification_url.'?crypt='.vpb_encrpt_url_data('user-paid-successfully;'.$user_or_payer_email_address);

// Payment was canceled by the user. This is the cancel page URL
$cancel_url = $vpb_notification_url.'?crypt='.vpb_encrpt_url_data('user-canceled-payment;'.$user_or_payer_email_address);

// There was a problem with the payment. This is the notification page URL
$notify_url = $vpb_notification_url.'?crypt='.vpb_encrpt_url_data('payment-notification-brought;'.$user_or_payer_email_address);

$tax = 0;
$custom = $_SERVER['REMOTE_ADDR'];

$vpb_paypal_url_data = "?business=".urlencode($paypal_email)."&";	
$vpb_paypal_url_data .= "item_name=".urlencode($item_name)."&";
$vpb_paypal_url_data .= "amount=".urlencode($item_amount)."&";
$vpb_paypal_url_data .= "item_number=".urlencode($item_number)."&";
$vpb_paypal_url_data .= "cpp_header_image=".urlencode($your_website_logo_url)."&";
$vpb_paypal_url_data .= "tax=".urlencode($tax)."&";
$vpb_paypal_url_data .= "custom=".urlencode($custom)."&";
$vpb_paypal_url_data .= "currency_code=".urlencode($currency_code)."&";
$vpb_paypal_url_data .= "no_note=".urlencode($no_note)."&";
$vpb_paypal_url_data .= "cmd=".urlencode($cmd)."&";

foreach($_POST as $key => $value){
	$value = urlencode(stripslashes($value));
	$vpb_paypal_url_data .= "$key=$value&";
}

$vpb_paypal_url_data .= "return=".urlencode(stripslashes($return_url))."&";
$vpb_paypal_url_data .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
$vpb_paypal_url_data .= "notify_url=".urlencode($notify_url);

if($payment_mode == "Live")
{
	header('location: https://www.paypal.com/cgi-bin/webscr'.$vpb_paypal_url_data);
	exit();
}
else
{
	header('location: https://www.sandbox.paypal.com/cgi-bin/webscr'.$vpb_paypal_url_data);
	exit();
}
?>