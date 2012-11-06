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
	include_once("assignPin.php");
	
	echo exec('pwd');
	$command = "/home/mattgerstman/Python-2.7.3/python /home/mattgerstman/mattgerstman.com/assassins/users.py /home/mattgerstman/mattgerstman.com/assassins/namesList.txt";
	echo '<br />'.$command.'<br /><br />';
	$json = exec($command, $output);
	echo $json;
	$names = json_decode($json, true);
#	$file = "output.json";
#	$names = json_decode(file_get_contents($file), true);
	echo "<pre>";
	print_r($names);
	
	foreach ($names as $list => $user)
	{
		
		$name = mysql_escape_string($user['name']);
		$username = mysql_escape_string($user['username']);
		$email = mysql_escape_string($user['email']);
		$team = mysql_escape_string($user['team']);
		$pin = assignPin();		
		$sql0 = "INSERT INTO users SET name = '$name', username = $username, email='$email', pin=$pin, team=$team";
		mysql_query($sql0);
		echo mysql_error();
	}	
	
?>