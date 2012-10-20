<?php

session_start();
?>
<html>
<meta name = "viewport" content = "width = device-width">
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Forgot Password</title>
<body>
<div align="center">
Enter the email you used to sign up here.<br />
You will then be sent a link to reset your password.<br />
<br />
<form action="processForget.php" method="post">
Email: <input type="text" name="email" /><br />
<input type="submit" value="Reset" />
<br />
<a href="login.php">Login</a> &nbsp; <a href="signup.php">Sign Up</a>

<?php

echo($_SESSION['status']);
unset($_SESSION['status']);
?>

</div>

</form>
</body>
</html>