<?php

require_once("connectToServer.php");
connect();

$pin = $_POST['pin'];

$sql0 = mysql_query("Select * from users where pin = $pin");
$myTeam = mysql_result($sql0,0,'team');
//echo mysql_result($sql0,0,'name');

$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin where assassin.team=target.team AND assassin.team != $myTeam AND assassin.changed = 0 ORDER BY rand() limit 1");

if (mysql_num_rows($sql1) == 0)
{
	$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin WHERE target.team != $myTeam AND assassin.team != $myTeam AND assassin.changed = 0 ORDER BY rand() limit 1");
}
else if (mysql_num_rows($sql1) == 0)
{
	$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin WHERE ORDER BY rand() limit 1");
}

$sql1 = mysql_fetch_row($sql1);

$newAssassinPin = $sql1[0];
$newTargetPin = $sql1[2];

$assassinPin = mysql_query("SELECT pin FROM users where target = $pin");
$assassinPin = mysql_result($assassinPin,0,"pin");
$targetPin =  mysql_query("SELECT target FROM users where pin = $pin");
$targetPin = mysql_result($targetPin,0,"target");

mysql_query("UPDATE users set target = $newTargetPin, showbutton = 0 WHERE pin = $pin");
mysql_query("UPDATE users set target = $pin, changed = 1 WHERE pin = $newAssassinPin");
mysql_query("UPDATE users set target = $targetPin where pin = $assassinPin");

$result =  mysql_query("SELECT * FROM $table where pin = $assassinPin");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Because another captain was inconsiderate you now have a new target. You may research this person on the assassins website.
	
Sincerely,
The Gamemaker";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);

$result =  mysql_query("SELECT * FROM $table where pin = $newAssassinPin");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Because another captain was inconsiderate you now have a new target. You may research this person on the assassins website.
	
Sincerely,
The Gamemaker";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);


/*echo ("\nAssassin Pin: $assassinPin\n");
echo ("Target Pin: $targetPin\n");
echo ("NewAssassinPin: $newAssassinPin\n");
echo ("NewTargetPin: $newTargetPin\n");*/
echo ($newTargetPin);


//print_r($sql1);
//echo mysql_error();


?>