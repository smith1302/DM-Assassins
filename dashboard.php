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
	
function printDashboard($pageid)
{
	
	$usertype = $_SESSION['usertype'];	
	echo('<div id="dashboard" class="dashboard">');
	
		echo('<a id="0" href="index.php">Target</a>');

		echo('<a id="1" href="myProfile.php">Profile</a>');

	if (false) //(($_SESSION['team']== -1  || $_SESSION['username'] == "sgiordano" || $_SESSION['username'] == "mgerstman") && $pageid!=4)
	{
		echo('<a href ="admin.php">Admin</a>');
	}
	else if ($usertype)
	{//only give access to the overall panel to overalls
		echo('<a id="2" href ="admin.php">Overall</a>');
/*		echo('<script type="text/javascript">
$("#dashboard").width(762);
</script>');*/
	}
	
		echo('<a id="3" href ="leaderboard.php">Scores</a>');
		echo('<a id="4" href ="rules.php">Rules</a>');
		echo('<a id="5" href ="waysYouCanDie.php">Tweets</a>');
	echo('<a href="logout.php">Logout</a>');
	
	echo('</div>');
	echo('<script type="text/javascript">
$("#'.$pageid.'").attr("class","selected");
</script>');
}

function printTwitterDashboard($pageid)
{

	echo('<div id="dashboard" class="dashboard">');
	
		echo('<a id="0" href="listOfWays.php">List</a>');

		echo('<a id="1" href="needsApproval.php">Pending</a>');
	
		echo('<a id="2" href ="waysYouCanDie.php">Submissions</a>');
		echo('<a id="3" href ="admin.php">Overall</a>');
	
	echo('</div>');
	echo('<script type="text/javascript">
$("#'.$pageid.'").attr("class","selected");
</script>');

}

?>




<!--?php echo $pageid; ?-->