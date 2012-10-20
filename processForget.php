<?php
require('connectToServer.php');
connect();

session_start();

$table='users';
$email = $_POST['email'];
$result = mysql_query("SELECT * FROM $table WHERE email='$email'");
//gets account info for email


if(mysql_num_rows($result))
{//if email is in system send them an email with a reset link		
		$name = mysql_result($result, 0,"name");				
		$password = mysql_result($result,0,"password");				
		
		$subject = 'Password Reset';
		$message = "Hello $name,

	We have received a reset password request for your account. If this is an error please disregard this email. If not, you may reset your password using the following link: http://sgiordano.info/assassins/processReset.php?old=$password&email=$email

FTK!
The Assassins Staff";

		$headers = 'From: assassins@floridadm.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		mail($email, $subject, $message, $headers);
	
	
}
else
{// if email is not in system redirect and give an error

 $_SESSION['status']="<p><strong>Error:</strong> No account registered to this email.</p>";
 
}
//redirect when done
 echo('<script language="javascript">redirURL = "login.php";self.location.href = redirURL;</script>');

?>