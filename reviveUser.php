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