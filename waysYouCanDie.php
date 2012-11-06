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

session_start();
?>

<html>
<head>

<style>
form{
	width:500px;
	margin:0 auto;
	}

textarea{
	width:490px;
	height:60px;
	border:2px solid #ccc;
	padding:3px;
	color:#555;
	font:16px Arial, Helvetica, sans-serif;
	}
form div{position:relative;margin:1em 0;}
form .counter{
	position:absolute;
	right:5;
	top:-25;
	font-size:20px;
	font-weight:bold;
	color:#ccc;
	}
form .warning{color:#600;}	
form .exceeded{color:#e00;}	

</style>

<?php 	include_once('dashboard.php');?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Ways You Can Die</title>


<script src="charCount/charCount.js" type="text/javascript"></script>

</head>
<body>
<div class="container" align="center">
<?php 
	if  ($_SESSION['usertype'])
		printTwitterDashboard(2);
	else if ($_SESSION['username'])
		printDashboard(5);
?>
<h1>Twitter Submissions</h1>
Want to see your idea posted when a player dies? You're in the right place. <br />
<br />
All of the tweets need to include the persons name to be worth it. <br /> When you want to insert someone's name into the submission include the text: "THEIRNAME" in all caps.<br />
THEIRNAME was killed in a tragic segway accident.<br />
THEIRNAME died from video game withdrawal.<br />
King Kong threw THEIRNAME off of a building.<br />
<br />
Also here's some other things to keep in mind:<br />
<br />
1) All submissions need to be under 130 characters so we can include the player's name in the tweet.<br />
2) Keep it PG. This one should be obvious.<br />
3) Since these will be tweeted, feel free to use #hashtags and @'s where appropriate.<br />
4) Spell-check is your friend.<br />
<br /><br /><br />
<form action="processWaysYouCanDie.php" method="post" onsubmit="return validate(this);">

    	<div align="center">
            <textarea id="way" name="way" ></textarea>
        </div>	


<br /><input type="submit" value="Submit" />
<br />
<br />
<script type="text/javascript">

	$(document).ready(function(){	
		$("#way").charCount({
			allowed: 130,		
			warning: 20,
			counterText: 'Characters left: '	
		});
	});
</script>
<?php

echo($_SESSION['nope']);
unset($_SESSION['nope']);

?>

<!--P.S. The current list is available <a href="listOfWays.php">here.</a>-->

</div>

</form>
</body>
</html>