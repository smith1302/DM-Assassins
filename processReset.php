<html>
<head>
<meta name = "viewport" content = "width = device-width">
<title>Change Password</title>
</head>

<body>
<?php

//gets prehashed password from link
	$password = $_GET['old'];
	$email = $_GET['email'];
	echo($email." ".$password);
	$table = "users";

include_once("connectToServer.php");
connect();

include("randomString.php");

//generate random password
		$new = genRandomString(6);
		$newPassword = md5($new);

//change password to random one		
		$result = mysql_query("UPDATE $table SET password='$newPassword' where email = '$email' AND password='$password'");

//get users account info for email		
		$result = mysql_query("SELECT * FROM $table WHERE email='$email'");
		$name = mysql_result($result, 0,"name");
		$username = mysql_result($result, 0,"username");							

//email user with new password
		$subject = 'Password Reset';
		
//indentation here is important. if you include an indentation in the message it will show up in the email itself. Also HTML doesn't translate in the email.		
		$message = 'Hello $name,

	Your password has been changed to "'.$new.'". Your username is still "'.$username.'" Please login and change your password under My Profile.
	

FTK!
The Assassins Staff';

	$headers = 'From: assassins@floridadm.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
	mail($email, $subject, $message, $headers);		

echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "login.php";	self.location.href = redirURL;</script>');
?>

</div>
</body>
</html>