<?php

include("checkSession.php");
check();

?>
<html>
<head>
<meta name = "viewport" content = "width = device-width">
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Change Password</title>
</head>

<body>
<?php

	$oldPassword = md5($_POST['old']);
	$password = $_POST['new'];	
	$newPassword = md5($password);
	$username = $_SESSION['username'];
	echo($username);
	$table = "users";

include_once("connectToServer.php");
connect();

//Request info about selected captain
	$result = mysql_query("SELECT * FROM $table WHERE username='$username' and password='$oldPassword'");
	echo($password." ".mysql_num_rows($result));

if ((mysql_num_rows($result)) && $password)
{//check if old password is correct, ifso email the user their new password
	$name = mysql_result($result, 0,"name");							
	$email = mysql_result($result, 0,"email");
	
	mysql_query("UPDATE $table SET password='$newPassword' where username = '$username' AND password='$oldPassword'");
	
	$subject = 'Password Reset';
		
//indentation here is important. if you include an indentation in the message it will show up in the email itself. Also HTML doesn't translate to the email.

	$message = "Hello $name,

	Your password has been changed to '$password'.
	

FTK!
The Assassins Staff";

				$headers = 'From: assassins@floridadm.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);		
	$_SESSION['status']="<p>Password successfully changed. Please login to test it.</p>";
	echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "login.php";self.location.href = redirURL;</script>');
}
else if ($password)
{
	$_SESSION['status']="<p><strong>Error:</strong> Old password is incorrect</p>";
		echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "myProfile.php";	self.location.href = redirURL;</script>');
}
else
{
	$_SESSION['status']="<p><strong>Error:</strong> New password cannot be blank</p>";
		echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "myProfile.php";	self.location.href = redirURL;</script>');
}
?>


</div>
</body>
</html>