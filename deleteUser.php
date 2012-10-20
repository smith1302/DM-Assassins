<?php
include('checkAdmin.php');
checkAdmin();

require('connectToServer.php');
connect();

$pin = $_POST['pin'];
$table = "users";

// get info of user to be deleted
$result = mysql_query("SELECT * FROM $table where pin = $pin");
$hisTarget = mysql_result($result,0,"target");

//change target of the user's assassins to the user's target

$result  = mysql_query("UPDATE $table SET target = $hisTarget where target = $pin");
mysql_query("DELETE FROM $table where pin = $pin");


//email the assassin that they have a new target.
$result =  mysql_query("SELECT * FROM $table where target = $hisTarget");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Due to unforeseen circumstances we have assigned you a new target. You may view your new target's information on your account at http://assassins.dmcaptains.com
	
FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
if ($hisTarget)
{//assures that the game has started before sending the email
	mail($email, $subject, $message, $headers);
}

if($result)
{
	
echo true;

}
else
{

echo false;
}

?>