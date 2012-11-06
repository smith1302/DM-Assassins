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


	