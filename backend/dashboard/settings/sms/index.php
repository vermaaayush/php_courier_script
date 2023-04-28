<?php
exit();
/*
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
require_once "Twilio/autoload.php";
$account_sid ="AC48efbb057c8c84ee17233ce3a9543895";
$auth_token ="42832cff3fbf8dacb4ec85330f88cc61";
$client = new Client($account_sid, $auth_token);
try {
	$twilio_number="+1 855 217 8181";
$countrycode ="92";
$number="3242429728";
$message="";

$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+'.$countrycode.$number,
    array(
        'from' => $twilio_number,
        'body' => $message
    )
);
echo "Yes";
}
catch (Exception $e) {
	echo "Error Occured ";
}

*/