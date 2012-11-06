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
		
require('connectToServer.php');
connect();

session_start();

$table='users';

$setup="Update $table SET target = 0, targetted = 0 WHERE alive = 1";
mysql_query($setup);
$i = 0;
for ($team=1; $team<14; $team++)
{
	echo ("<h1>Team: $team</h1>");
	$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 AND alive = 1 AND team = $team ORDER BY RAND()";

	$randomUser = mysql_query($sql1);
	if (mysql_num_rows($randomUser) !=0)
	{
		$randomUserPin = mysql_result($randomUser,0,"pin");	
		$firstPin = -1;
	
		while ($firstPin!=$randomUserPin)
		{
			$i++;
			if ($firstPin == -1)
			{
				$firstPin = $randomUserPin;
			}
			$currentPin = $randomUserPin;
			$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 AND team = $team ORDER BY RAND() LIMIT 1";
			$randomUser = mysql_query($sql1);
	
			if (mysql_num_rows($randomUser) == 0)
				$randomUserPin = $firstPin;
			else
				$randomUserPin = mysql_result($randomUser,0,"pin");	
		
			$sql2 = "UPDATE $table SET target = $randomUserPin WHERE pin = $currentPin";
			$sql3 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
			mysql_query($sql2);
			mysql_query($sql3);
			$sql = mysql_query("SELECT * FROM $table WHERE pin > 100 AND alive = 1 AND targetted = 0");
			echo("$i<br />$sql1<br />$sql2<br />$sql3<br />");
			
		}
	}
}
$sql2 = "SELECT SUM(alive) FROM $table WHERE pin > 100";
$sql2 = mysql_query($sql2);
$numAlive = mysql_result($sql2,0,"SUM(alive)");
echo("Alive: ".$numAlive);
echo("<br />Properly given targets: ".$i);

?>