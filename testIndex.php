<?php

include('checkSession.php');
check();
include('getTeam.php');
include("dashboard.php");
printDashboard(0);

?>

<html>
<head>
<meta name = "viewport" content = "width = device-width">
<title>Target Information</title>
</head>

<body>


<?php

//get user info from cookies
	$username = $_SESSION['username'];
	$table = "users";
		
//display dashboard links




include_once("connectToServer.php");
connect();

//get user's target	

	$result = mysql_query("SELECT * FROM $table where username ='$username'");	
	$alive = mysql_result($result,0, "alive");	
	$target = mysql_result($result,0, "target");
	$myPin = mysql_result($result,0, "pin");
	$choice = $_GET['choice'];

	if (!($alive || $choice))
	{
		echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "leaderboard.php";	self.location.href = redirURL;</script>');
	}

// in case of circular targetting
/*	if ($target == $myPin)
	{
		$repairSQL = "SELECT * FROM $table WHERE pin > 100 AND pin != $myPin AND alive =1 ORDER BY RAND() LIMIT 1";
		$repair=mysql_query($repairSQL);
		$theirTarget = mysql_result($repair,0,"target");
		$theirPin  = mysql_result($repair,0,"pin");
		$theirName  = mysql_result($repair,0,"name");
		$theirEmail = mysql_result($repair,0,"email");
		mysql_query("UPDATE users SET target = $theirTarget where pin = $myPin");
		mysql_query("UPDATE users SET target = $myPin where pin = $theirPin");

		$subject = 'You Have A New Target';
		$message = "Hello $name,

	Due to unforeseen circumstances we have assigned you a new target. You may view your new target's information on your account at http://sgiordano.info/assassins

FTK!
The Assassins Staff";
		$headers = 'From: assassins@floridadm.org' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

		mail($theirEmail, $subject, $message, $headers);
		mail("imatt711@me.com", $subject, $message, $headers);
	}*/
	
	if ($target)
	{
		echo("Target Information<br />
		<br />");
		
		echo("<p class='special'>Earlier today we experienced some technical difficulties<br /> and had to reassign all targets. We apologize for the inconvenience.</p><br />");
		//get's target info from server
		
		
		$result = mysql_query("SELECT * FROM $table where pin = $target");
		$targetName = mysql_result($result,0,"name");
		$targetFacebook = mysql_result($result,0,"facebook");
		$targetEmail = mysql_result($result,0,"email");
		$team = mysql_result($result,0,"team");
		$outputTeam = getTeam($team);

		//prints target info

		echo("Name: ".$targetName);
		echo('<br />Facebook: <a href="'.$targetFacebook.'">'.$targetFacebook.'</a>');
		echo('<br />Email: <a href="mailto:'.$targetEmail.'">'.$targetEmail.'</a>');
		echo('<br />Team: '.$outputTeam.'<br />');
/*		if ($target == 917)
		{
			echo("<br /><p class='special'>Dear Assassin,<br />I'll be in Club West all week.<br />Come at me.<br />Sincerely,<br/>Matt Gerstman</p>");
		}
		else
		{
			echo('<br />');
		}*/

		echo('<br />');
		echo('<br />
		If you have killed your target<br />
		please enter their pin here:
		<form action="killTarget.php" method="post">
		<br /><input type="text" name="targetPin" /><br />
		<input type="submit" value="Kill Target" /><br /><br />');
		
		
		$result = mysql_query("SELECT * FROM $table where team=$team AND usertype = 1");
		
		if (mysql_num_rows($result))
			$overallEmail = mysql_result($result,0,"email");
		else
			$overallEmail = "spookp@floridadm.org";
		
		echo("If your target's Facebook is unaccessible you can email<br /> their overall at: <a href='mailto:$overallEmail'>$overallEmail</a>");
	}
	else if ($alive)
	{//if user has no target they are dead, let them know this.
//		echo("<br />The game will begin on Monday, November 28, 2011.<br /> You will receive an email when your target has been assigned.");
		echo("<br />The game has been paused due to an error with the system, when it starts up again you will have a new target.");
	}
	else
	{
		echo("You have been killed.<br /><br /> If you believe this is an error,<br /> please contact your overall");
	}

?>


<?php
echo('<br/>');
echo('<br/>');
echo($_SESSION['status']);
unset($_SESSION['status']);
?>

</div>
</body>
</html>