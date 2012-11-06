<?php
/*Dance Marathon Assassins
    Copyright 2012 Dance Marathon at the University of Florida

This product includes software developed by the Dance Marathon at the University of Florida 2013 Technology Team.
The following developers contributed to this project:
	Matthew Gerstman

Dance Marathon at the University of Florida is a year-long effort that culminates in a 26.2-hour event where over 800 students stay awake and on their feet to symbolize the obstacles faced by children with serious illnesses or injuries. The event raises money for Shands Hospital for Children, your local Children’s Miracle Network Hospital, in Gainesville, FL. Our contributions are used where they are needed the most, including, but not limited to, purchasing life-saving medial equipment, funding pediatric research, and purchasing diversionary activities for the kids.

For more information you can visit http://floridadm.org
   
This software includes the following open source plugins listed below:
	Title:		HTML5 Image Uploader
	Link:		http://tutorialzine.com/2011/09/html5-file-upload-jquery-php/
	Copyright: 	None, but we're nice and want to give credit.

	Title:		Character Count Plugin - jQuery plugin
	Link:		http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
	Copyright:	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
	License:	MIT License (http://www.opensource.org/licenses/mit-license.php)

	Title:		Mobile Detect
	Link:		http://mobiledetect.net
	License:	http://www.opensource.org/licenses/mit-license.php

	Title:		PHPMailer - PHP email class
	Link:		https://code.google.com/a/apache-extras.org/p/phpmailer/
	Copyright:	Copyright (c) 2010-2012, Jim Jagielski. All Rights Reserved.
	License:	LGPL http://www.gnu.org/copyleft/lesser.html
	
	Title:		TableSorter 2.0 - Client-side table sorting with ease!
	Link:		http://tablesorter.com
	Copyright:	Copyright (c) 2007 Christian Bach
	License:	http://www.opensource.org/licenses/mit-license.php
	
	Title:		twitteroauth
	Link:		https://github.com/abraham/twitteroauth
	Copyright:	Copyright (c) 2009 Abraham Williams
	License:	http://www.opensource.org/licenses/mit-license.php*/
		
	
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

		$message = "<p>TRIBUTES,</p>

<p>Your efforts in killing have angered the Gamemaker to the point he needed a break. After a long weekend, the Gamemaker has finally decided to resume play. However, to prevent any boredom, you will have 48 hours from the time this email is sent out to eliminate your target. Fail to complete this task and you will be eliminated by me. I will not tolerate any of you trying to weasel your way through to the end. It is simple, kill or be killed. Good luck and may the odds be ever in your favor.</p>

<p>Truly yours,<br />
The Gamemaker</p>";

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

		/*$message="<p>Tributes,</p>

<p>Gainesville has been taken over by a swarm of <a href='http://thehungergames.wikia.com/wiki/Tracker_jacker'>Tracker jackers</a>. Unfortunately for you, you have been stung. Alas, there is an antidote! However it can only be retrieved if you kill your target in the next 48 hours. Act quickly for if the clock strikes zero, so will your chance to be the champion of DM Assassins.  But there is a catch, to test the will of friendship and team unity, the gamemaster has decided that your newest target will be someone on your own team. In other words, kill an ally or be killed, the choice is yours. Enjoy your newest plot twist Tributes, it may be your last. As always, good luck and may the odds be ever in your favor.</p>

<p>Truly yours,<br />
The Gamemaker</p>
<p>P.S. After further thought, if you and one other assassin remain as the lone survivors on your team, you shall be protected until the final stages of the game. Consider it a little reward for doing what the rest of your team could not.</p>";*/

/*		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: assassins@floridadm.org' . "\r\n";*/
		
		
		
		#mail($email, "Assassins Information", $message, $headers);
		
		
				
		$mail             = new PHPMailer(); // defaults to using php "mail()"
				
		$mail->SetFrom('assassins@floridadm.org', 'Dance Marathon Assassins');
		
		$address = $email;//$email;
		$mail->AddAddress($address);
		
		$mail->Subject    = "Plot Twist";
		
		$mail->AltBody = "TRIBUTES,

Your efforts in killing have angered the Gamemaker to the point he needed a break. After a long weekend, the Gamemaker has finally decided to resume play. However, to prevent any boredom, you will have 48 hours from the time this email is sent out to eliminate your target. Fail to complete this task and you will be eliminated by me. I will not tolerate any of you trying to weasel your way through to the end. It is simple, kill or be killed. Good luck and may the odds be ever in your favor. 

Truly yours, 
The Gamemaker";
		
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