<?php
include('checkAdmin.php');
checkAdmin();

include('connectToServer.php');
connect();

$pin = $_POST['pin'];
$table = "users";

// get info of user to be killed
$result = mysql_query("SELECT * FROM $table where pin = $pin");
$hisTarget = mysql_result($result,0,"target");

//change target of the user's assassins to the user's target and update kills
$result = mysql_query("SELECT * FROM $table where target = $pin");
$kills = mysql_result($result,0,"killed") + 1;
$username = mysql_result($result,0,"username");
$result = mysql_query("UPDATE $table SET target = $hisTarget, killed = $kills where username = '$username'");

//kill User
$result = mysql_query("UPDATE $table SET target = 0, alive = 0 where pin = $pin");

//email the assassin that they have a new target.
$result =  mysql_query("SELECT * FROM $table where target = $hisTarget");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Your overall has manually killed your target. You may view your new target information on your account at http://assassins.dmcaptains.com
	
FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .'X-Mailer: PHP/' . phpversion();


	mail($email, $subject, $message, $headers);

if($result)
{
	include('killTweet.php');
	killTweet($pin);
	echo true;
}
else
{

	echo false;

}

?>