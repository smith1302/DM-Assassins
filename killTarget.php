<?php
include('checkSession.php');
check();

include_once("connectToServer.php");
connect();

//get personal info
$username = $_SESSION['username'];
$targetPin = $_POST['targetPin'];
$table = "users";

$result = mysql_query("SELECT * FROM $table where username ='$username'");
$target = mysql_result($result,0, "target");
$kills =  mysql_result($result,0, "killed");

if ($target == $targetPin)
{
	//get new Target
	$result = mysql_query("SELECT * FROM $table where pin = $target");
	$assassinName = mysql_result($result,0, "name");
	$newTarget = mysql_result($result,0, "target");
	mysql_query("UPDATE $table SET target = $newTarget, lastkilled=CURRENT_TIMESTAMP where username = '$username'");
	
	//mark target as dead
	mysql_query("UPDATE $table SET target = 0, alive = 0 where pin = $target");
	
	//update kill count of player
	$kills++;
	mysql_query("UPDATE $table SET killed = $kills where username ='$username'");	
	
	//get account info of dead player
	$result = mysql_query("SELECT * FROM $table where pin = '$targetPin'");
	$name = mysql_result($result,0,"name");
	$team = mysql_result($result,0,"team");
	$email = mysql_result($result,0,"email");
	
	//get their overall's email
	$result = mysql_query("SELECT * FROM $table where team = '$team' AND usertype = 1");
	$overallEmail = mysql_result($result,0,"email");
	

	$subject = 'Assassins Account Information';
	$message = "Hello $name,
	
	We regret to inform you that you have been killed. If you believe this is in error, please contact your overall at $overallEmail
	
FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

//	mail($email, $subject, $message, $headers);
	
	include('killTweet.php');
	killTweet($targetPin);		
	
	echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "index.php"; self.location.href = redirURL;</script>');
	
}
else
{
	$_SESSION['status'] = "<p><strong>Error:</strong> That is not your targets pin.<br/><br/> If you think they're a lying cheat,<br /> their overall can kill them manually. <br /> Or maybe you messed up, who knows?</p>";
	echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "index.php"; self.location.href = redirURL;</script>');
}



?>


	