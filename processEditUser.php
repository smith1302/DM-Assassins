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
	
include('checkAdmin.php');
checkAdmin();

require('connectToServer.php');
connect();

//get info submitted by overall
$username = $_GET['username'];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$facebook = $_POST["facebook"];
$email = $_POST["email"];
$team = $_POST["team"];	
$usertype = $_POST["admin"];	

//combine first and last names
$name = htmlspecialchars(ucwords($firstname . " " . $lastname), ENT_QUOTES);
$table = "users";


//submit data to database
$result = mysql_query("UPDATE $table SET name = '$name', facebook = '$facebook', email = '$email', team = $team, usertype = $usertype WHERE username = '$username' ");

if($result)
{//alerts overall that it worked
	
	$_SESSION['status']="<br />User Information Changed";

}
else
{

// alerts overall that it didnt work

	$_SESSION['status']="<p>An error occurred when trying to change user information. <br /> Please contact Matt Gerstman at <a href='mailto:MattGerstman@gmail.com'>MattGerstman@gmail.com</a> for assistance.</p>";

}

echo('<SCRIPT LANGUAGE="JavaScript">history.go(-2);</script>');

?>