<?php
session_start();
$otp_value=$_POST['otpvalue'];
if($otp_value==$_SESSION['otp'])
{
	echo "Registration successful";
}
else
{
	echo "Registration unsucessful";
}
?>