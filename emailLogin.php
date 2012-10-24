<?php
	include_once("connectToServer.php");
	connect();

	require_once('Mailer/class.phpmailer.php');
	include_once("getTeam.php");
	
	$sql0 = "SELECT * FROM users WHERE mailed = 0";
	$sql0 = mysql_query($sql0);
	
	while ($user = mysql_fetch_assoc($sql0))
	{
		$name = $user['name'];
		$email = $user['email'];
		$username = $user['username'];		
		$pin = $user['pin'];
		$target = $user['target'];		
		$sql3 = "SELECT * FROM users WHERE pin = $target";
		$sql3 = mysql_query($sql3);
		/*$targetName = mysql_result($sql3, 0, 'name');
		$targetTeam = mysql_result($sql3, 0, 'team');
		$targetTeam = getTeam($targetTeam);*/
		
/*		$message = "<p>Hello $name,
You have been assigned your first target. It is $targetName on the $targetTeam team.<br />
You can log in to check his profile here:<br />
<br />		
<a href='http://assassins.dmcaptains.com'>http://assassins.dmcaptains.com</a><br /><br />
UFID: $username<br />
PIN: $pin<br />
<br />
FTK!<br />
The Assassins Team<br />
<br />		
P.S. If you'd like to submit ideas for the <a href='http://twitter.com/dmassassins'>twitter feed</a>. You can submit them <a href='http://assassins.dmcaptains.com/waysYouCanDie.php'>here</a>.</p>
		";*/
		
		/*$message = "<p>Tributes,</p>

<p>The Gamemaker is disappointed with your performance. You may consider yourself lucky, or even skilled for making it out alive through the first quarter deaths. However we don't see it as such, we have decided that your pursuit of your current targets has failed. In response, the Gamemaker has decided upon a role reversal. These targets that you found so difficult to find, now target you. You may be thinking, \"I now know who targets me,\" but don't let this give you a false sense of security because you are not alone.</p>

<p>You may log into the assassins website to see your new target.</p>

<p>Good luck tributes, and may the odds be ever in your favor!</p>
<p>-The Gamemaker</p>";*/

		/*$message ="<p>Good day Tributes,</p>

<p>Our game has hit a stall of late. Some of you have decided to ease your efforts to kill off your targets. As a result, the Gamemaker has decided to add a new element. If you refer to your assassins page, you will notice a big red button. This big red button will change the game for you and others, but in what way you ask? Well that can only be answered by pressing the red button. If you dare to take this risk, accept the fate that comes with it, choose to stay away from the red button, and you may have sentenced yourself to be assassinated or positioned yourself for eternal Dance Marathon glory.</p>

<p>Good luck tributes.<br />
And may the odds be ever in your favor.</p>";*/

		$message="<p>Tributes,</p>

<p>Gainesville has been taken over by a swarm of <a href='http://thehungergames.wikia.com/wiki/Tracker_jacker'>Tracker jackers</a>. Unfortunately for you, you have been stung. Alas, there is an antidote! However it can only be retrieved if you kill your target in the next 48 hours. Act quickly for if the clock strikes zero, so will your chance to be the champion of DM Assassins.  But there is a catch, to test the will of friendship and team unity, the gamemaster has decided that your newest target will be someone on your own team. In other words, kill an ally or be killed, the choice is yours. Enjoy your newest plot twist Tributes, it may be your last. As always, good luck and may the odds be ever in your favor.</p>

<p>Truly yours,<br />
The Gamemaker</p>
<p>P.S. After further thought, if you and one other assassin remain as the lone survivors on your team, you shall be protected until the final stages of the game. Consider it a little reward for doing what the rest of your team could not.</p>";

/*		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: assassins@floridadm.org' . "\r\n";*/
		
		
		
		#mail($email, "Assassins Information", $message, $headers);
		
		
				
		$mail             = new PHPMailer(); // defaults to using php "mail()"
				
		$mail->SetFrom('assassins@floridadm.org', 'Dance Marathon Assassins');
		
		$address = $email;//$email;
		$mail->AddAddress($address);
		
		$mail->Subject    = "Plot Twist";
		
		$mail->AltBody = "Tributes,

Gainesville has been taken over by a swarm of Tracker jackers. Unfortunately for you, you have been stung. Alas, there is an antidote! However it can only be retrieved if you kill your target in the next 48 hours. Act quickly for if the clock strikes zero, so will your chance to be the champion of DM Assassins.  But there is a catch, to test the will of friendship and team unity, the gamemaster has decided that your newest target will be someone on your own team. In other words, kill an ally or be killed, the choice is yours. Enjoy your newest plot twist Tributes, it may be your last. As always, good luck and may the odds be ever in your favor.

Truly yours,
The Gamemaster

P.S. After further thought, if you and one other assassin remain as the lone survivors on your team, you shall be protected until the final stages of the game. Consider it a little reward for doing what the rest of your team could not.
";
		
/*		$mail->AltBody    = "Hello $name,
You have been assigned your first target. It is $targetName on the $targetTeam team.
You can log in to check his profile here:

http://assassins.dmcaptains.com
UFID: $username
PIN: $pin

FTK!
The Assassins Team

P.S. If you'd like to submit ideas for the twitter feed, You can submit them at http://assassins.dmcaptains.com/waysYouCanDie.php";*/
		
		$mail->MsgHTML($message);
		
		
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Emailed: $name at $email, with ufid: $username and pin: $pin<br />";
		  $sql1 = "update users set mailed = 1 where pin = $pin";
		  mysql_query($sql1);
		  }

		#echo ("$message");

	}



?>

<?php



?>

</body>
</html>