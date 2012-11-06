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

<?php
include_once("connectToServer.php");
connect();

	$way = mysql_real_escape_string($_POST['way']);
	if (strlen($way) < 131)
	{
    	$sql1 = "INSERT INTO tweetTest SET method = '$way', used =0";
		mysql_query($sql1);	
		
		$randNum = rand(0,15);
		switch ($randNum) {
			case	0	: $name = "Alex Spratt"; break;
			case	1	: $name = "Patrick Spook"; break;
			case	2	: $name = "Meredith Chipman"; break;
			case	3	: $name = "Eden Joyner"; break;
			case	4	: $name = "Jorge Sanchez"; break;
			case	5	: $name = "Mackenzie Pape"; break;
			case	6	: $name = "Blake Oliver"; break;
			case	7	: $name = "Steve McLaughlin"; break;
			case	8	: $name = "Christina Stine"; break;
			case	9	: $name = "Natalie Hyman"; break;
			case	10	: $name = "Garrett Chappell"; break;
			case	11	: $name = "Sam Capone"; break;
			case	12	: $name = "Madison Hager"; break;
			case	13	: $name = "Octavio Casanova"; break;
			case	14	: $name = "Steven Giordano"; break;						
			case	15	: $name = "Matt Gerstman"; break;						
		}
		$fun = str_replace("THEIRNAME",$name, $way);
		
		
			$subject = 'Death Submission';
			$message = $fun;
			$email = "imatt711@me.com";
			$headers = 'From: assassins@floridadm.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

		//	mail($email, $subject, $message, $headers);

		$_SESSION['nope']="Submission Successful! Once your submission has been approved, we'll add it to the database.<br />";
		
	}
	else
	{
		$_SESSION['nope']="Please make all submissions under 130 characters. Thank you.<br />";
	}

?>


<SCRIPT LANGUAGE="JavaScript">

redirURL = "waysYouCanDie.php";
self.location.href = redirURL;

</script>


</body>
</html>