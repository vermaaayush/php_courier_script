<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
require_once "Twilio/autoload.php";

function connection(){
$account_sid ="AC48efbb057c8c84ee17233ce3a9543895";
$auth_token ="f289c83e17759a70b8295f3d75d16e64";
$client = new Client($account_sid, $auth_token);
return $client;
}
function msg_content($number,$message)
{
$twilio_number="+1 888 749 8389";
$client =connection();

try {

$client->messages->create(
    // Where to send a text message (your cell phone?)
    $number,
    array(
        'from' => $twilio_number,
        'body' => $message
    )
);
//echo "Sent to".$number;
}
catch (Exception $e) {
	///echo $e->getMessage();
//	print_r($e);
}
//echo $number;
//die();
}
//$msg="Hi farhan,you need to update facebook,";
//shipment_created($msg);