<?php

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