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
<meta name = "viewport" content = "width = device-width">
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>
<title>Sign Up</title>
<body>
<div align="center">

<script language="Javascript">

function validate(form) {
	  var elem = form.elements;

	  if(elem.password.value != elem.confirm.value) {
	    alert('Please check your password; the confirmation entry does not match.');
	    return false;
	  }
	  return true;
	}
</script>
<!--
Sign Up

<form action="processSignup.php" method="post" onSubmit="return validate(this);">
<table>
<tr><td>First Name:</td><td> <input type="text" name="firstname" /></td></tr>
<tr><td>Last Name:</td><td>  <input type="text" name="lastname" /></td></tr>
<br />
<tr><td>Username: </td><td> <input type="text" name="username" /></td></tr>
<tr><td>Password: </td><td> <input type="password" name="password" /></td></tr>
<tr><td>Password (Confirm):</td><td>  <input type="password" name="confirm" /></td></tr>
<br />
<tr><td>Facebook Link:</td><td>  <input type="text" name="facebook" /></td></tr>
<tr><td>Email: </td><td> <input type="text" name="email" /></td></tr>
<tr><td>Team: </td><td> <select name="team">
	<option value="00">	Community Events</option>
	<option value="01">	Dancer Relations</option>
	<option value="02">	Entertainment</option>
	<option value="03">	Family Relations</option>
	<option value="04">	Finance</option>
	<option value="05">	Hospitality</option>
	<option value="06">	Marketing</option>
	<option value="07">	Morale</option>
	<option value="08">	Operations</option>
	<option value="09">	Public Relations</option>
	<option value="10">	Recruitment</option>
	<option value="11">	Technology</option>
</select></td></tr></table><br />
<input type="submit" value="Submit" />
<br /><br />
 <a href="login.php">Login</a> &nbsp;|&nbsp; <a href="forgotPassword.php">Forgot Password?</a>

<?php

echo($_SESSION['status']);
unset($_SESSION['status']);
?>

</div>

</form>-->
</body>
</html>