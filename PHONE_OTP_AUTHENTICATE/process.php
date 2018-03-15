<?php
session_start();
require "vendor\autoload.php"; 
use Twilio\Rest\Client;
 
$account_sid = "sid";
$auth_token = "token";
$twilio_phone_number = "number";
 
$client = new Client($account_sid, $auth_token);
$otp = rand(100000,999999);
$messages="Your otp is ".$otp;
$phone_number="+91".$_POST['phone'];
$client->messages->create(
    $phone_number,
    array(
        "from" => $twilio_phone_number,
        "body" => $messages
    )
);
$_SESSION['name']=$_POST['name'];
$_SESSION['email']=$_POST['email'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['otp']=$otp;
header( "Location: otp.php" );
?>