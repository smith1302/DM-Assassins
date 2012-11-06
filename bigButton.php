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
		

require_once("connectToServer.php");
connect();

$pin = $_POST['pin'];

$test = mysql_query("SELECT * from users where changed = 0");
if (mysql_num_rows($test)!=0)
	{
	$sql0 = mysql_query("Select * from users where pin = $pin");
	$myTeam = mysql_result($sql0,0,'team');
	//echo mysql_result($sql0,0,'name');
	
	$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin where assassin.team=target.team AND assassin.team != $myTeam AND assassin.changed = 0 ORDER BY rand() limit 1");
	
	if (mysql_num_rows($sql1) == 0)
	{
		$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin WHERE target.team != $myTeam AND assassin.team != $myTeam AND assassin.changed = 0 ORDER BY rand() limit 1");
	}
	if (mysql_num_rows($sql1) == 0)
	{
		$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin WHERE changed=0 ORDER BY rand() limit 1");
	}
	
	$sql1 = mysql_fetch_row($sql1);
	
	$newAssassinPin = $sql1[0];
	$newTargetPin = $sql1[2];
	
	$assassinPin = mysql_query("SELECT pin FROM users where target = $pin");
	$assassinPin = mysql_result($assassinPin,0,"pin");
	$targetPin =  mysql_query("SELECT target FROM users where pin = $pin");
	$targetPin = mysql_result($targetPin,0,"target");
	
	if ($newAssassinPin && $newTargetPin && $targetPin && $assassinPin)
	{
		mysql_query("UPDATE users set target = $newTargetPin, showbutton = 0 WHERE pin = $pin");
		mysql_query("UPDATE users set target = $pin, changed = 1 WHERE pin = $newAssassinPin");
		mysql_query("UPDATE users set target = $targetPin, changed = 1 where pin = $assassinPin");
	
		$result =  mysql_query("SELECT * FROM users where pin = $assassinPin");
		$name = mysql_result($result,0,"name");
		$email = mysql_result($result,0,"email");
		
		
			$subject = 'You Have A New Target';
			$message = "Tribute,

A daring tribute has decided to press the red button. Not only did they change their fate, but they subsequently altered yours. You have been assigned to a new target.

Good luck pursuing your newest victim.
And may the odds be ever in your favor.";

			$headers = 'From: assassins@floridadm.org' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
		
			mail($email, $subject, $message, $headers);
		
		$result =  mysql_query("SELECT * FROM users where pin = $newAssassinPin");
		$name = mysql_result($result,0,"name");
		$email = mysql_result($result,0,"email");
		
		
			$subject = 'You Have A New Target';
			$message = "Tribute,

A daring tribute has decided to press the red button. Not only did they change their fate, but they subsequently altered yours. You have been assigned to a new target.

Good luck pursuing your newest victim.
And may the odds be ever in your favor.";

			$headers = 'From: assassins@floridadm.org' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
		
			mail($email, $subject, $message, $headers);
		
		
		/*echo ("\nAssassin Pin: $assassinPin\n");
		echo ("Target Pin: $targetPin\n");
		echo ("NewAssassinPin: $newAssassinPin\n");
		echo ("NewTargetPin: $newTargetPin\n");*/
		echo ($newTargetPin);
	}
	else
	{
		mysql_query("UPDATE users set showbutton = 0 where pin = $pin");
		echo 0;
	}
}
else
{
	mysql_query("UPDATE users set showbutton = 0");
	echo 0;
}

//print_r($sql1);
//echo mysql_error();


?>