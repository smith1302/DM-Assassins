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
		

include("tweet.php");

function killTweet($pin)
{

$table = "users";
$fun = "blankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblank";
while (strlen($fun)>139)	
{	
	$result = mysql_query("SELECT * FROM $table where pin = $pin");
	$name = mysql_result($result,0,"name");
	$twitter = mysql_result($result,0,"twitter"); 
	
	
	$result = mysql_query("SELECT * FROM tweets WHERE used = 0 ORDER BY RAND() LIMIT 1");
	$method = mysql_result($result,0,"method");
	$twitterPin = mysql_result($result,0,"pin");
	
	if (strlen($twitter))
		$fun = str_replace("THEIRNAME",'.@'.$twitter, $method);	
	else
		$fun = str_replace("THEIRNAME",$name, $method);	
			

}

		mysql_query('UPDATE tweets set used = 1 where pin = '.$twitterPin);
		tweet($fun);
}


?>