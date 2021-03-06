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

include("assignPin.php");

//get user info from form
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$year = $_POST["year"];
	$grad = $_POST["grad"];
	$major = $_POST["major"];
	$gpa = $_POST["gpa"];
	$shirt = $_POST["shirt"];	
	$first = $_POST["first"];
	$second = $_POST["second"];
	$third = $_POST["third"];
	$phone = $_POST["phone"];	
	$uflemail = $_POST["uflemail"];
	$regemail = $_POST["regemail"];
	$lstreet = $_POST["lstreet"];
	$lcity = $_POST["lcity"];
	$lstate = $_POST["lstate"];
	$lzip = $_POST["lzip"];
	$pstreet = $_POST["pstreet"];
	$pcity = $_POST["pcity"];
	$pstate = $_POST["pstate"];
	$pzip = $_POST["pzip"];

	
//combine names, encrypt password, and make sure facebook includes http://
	$name = htmlspecialchars(ucwords($firstname . " " . $lastname));
	$encryptPassword = md5($password);
	
	
	
	if (strlen($firstname) == 0 || strlen($lastname) == 0)
	{
		$_SESSION['status'] = $_SESSION['status'] . "<p>Your first and last name cannot be left blank.</p>";
	}
	
	if (strlen($username) == 0)
	{
		$_SESSION['status'] = $_SESSION['status'] . "<p>Your username cannot be left blank.</p>";
	}
	
	if (strlen($password) == 0)
	{
		$_SESSION['status'] = $_SESSION['status'] . "<p>Your password cannot be left blank.</p>";
	}
	
	if (strlen($facebook) == 0)
	{
		$_SESSION['status'] = $_SESSION['status'] . "<p>Your Facebook link cannot be left blank.</p>";		
	}
	else if (strlen($facebook) < 14)
	{
		$_SESSION['status'] = "<p>Please enter your Facebook in the format http://www.facebook.com/<i>yourusernamehere</i></p>";
	}
	else if (substr($facebook,0,4) != "http")
	{
		$facebook = "http://".$facebook;
	}
	

	
	if (strlen($email) == 0)
	{
		$_SESSION['status'] = $_SESSION['status'] . "<p>Your email address cannot be left blank.</p>";
	}



//check to make sure user doesnt already exist
	$sql0 = "SELECT * FROM users WHERE username = '$username' OR name = '$name' OR email = '$email'";
	$sql0 = mysql_query($sql0);
	
if ((mysql_num_rows($sql0)==0) && (strlen($_SESSION['status'])==0))
{

//add user
    $sql1 = "INSERT INTO users SET pin = $pin, username='$username', password = '$encryptPassword', name = '$name', email = '$email', facebook = '$facebook', team='$team', usertype = 0, killed = 0, alive = 1, target = 0, targetted = 0;";
	mysql_query($sql1);	

    $sql2 = "SELECT * FROM users WHERE pin = $pin";
	$sql2= mysql_query($sql2);
	
if (mysql_num_rows($sql2))
{
//get user's team	
	include("getTeam.php");
	$outputTeam = getTeam($team);

//email user their information	
	$subject = 'Assassins Account Information';

//indentation here is important. if you include an indentation in the message it will show up in the email itself. Also HTML doesn't translate in the email.
	$message = "Hello $name,
	
Thank you for signing up to play assassins with Dance Marathon.
	
Your account information is below:
 	Username:	$username
	Password:	$password
	Pin:			$pin
	Facebook:	$facebook
	Team:		$outputTeam

Your overall will need to confirm that your entry fee has been paid and your account information is correct before you will be able to play.
Make sure to remember your pin number above. When you kill a player they will give you their pin number and you will enter it online to confirm you've killed them, if you are killed you will have to do likewise.

FTK!
The Assassins Staff

P.S. Super awesome stuff at http://www.twitter.com/DMAssassins";
	$headers = 'From: assassins@floridadm.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);




	 $_SESSION['username'] = htmlspecialchars($username);
	 $_SESSION['usertype'] = 0;
	
	echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "index.php";self.location.href = redirURL;</script>');
}
else
{
	$_SESSION['status'] = "<p>An error occurred while processing your account. Please try again later.</p>";
}
}	

else
{//if user already has an account, inform them
	$sql1 = "SELECT * FROM users WHERE username = '$username'";
	$sql1 = mysql_query($sql1);
	
	if (mysql_num_rows($sql1)!=0)
	{
		$_SESSION['status'] = "<p>That username is already taken.</p>";
	}
	else if ((strlen($_SESSION['status'])==0)|| (mysql_num_rows($sql0)!=0))
		$_SESSION['status'] = "<p><strong>Error:</strong> You have already signed up. If you believe this is in error please contact your overall.<p>";


}
	echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "index.php";	self.location.href = redirURL;</script>');
	
?>




</body>
</html>