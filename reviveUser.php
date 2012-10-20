<?php
function randomUser() {
	
	$table = 'users';
	$sql = "SELECT * FROM $table WHERE alive!=0 ORDER BY RAND() LIMIT 1";
//	$sql = "SELECT * FROM $table WHERE pin=917"; //default to mattgerstman for test
	$random_row = mysql_query($sql);
    return $random_row;

}

include('checkAdmin.php');
checkAdmin();

require('connectToServer.php');
connect();

$pin = $_POST['pin'];
$table = "users";

// get info of user to be revived
$result = mysql_query("SELECT * FROM $table where pin = $pin");

//get random user to turn into assassin
$assassin = randomUser();
$target = mysql_result($assassin,0,"target");

//assign the assassin to the user and give the user his assassins old target
$result1 = mysql_query("UPDATE $table SET target = $pin where target = $target");
$result2 = mysql_query("UPDATE $table SET target = $target where pin = $pin");



//email the assassin that they have a new target.
$result =  mysql_query("SELECT * FROM $table where target = $pin");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Due to unforeseen circumstances we have assigned you a new target. You may view your new target information on your account at http://assassins.dmcaptains.com
	
FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);

if($result1 && $result2)
{
	
echo true;

}
else
{

echo false;

}

?>