<?php
include('checkAdmin.php');
checkAdmin();

require('connectToServer.php');
connect();

//get info submitted by overall
$username = $_GET['username'];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$facebook = $_POST["facebook"];
$email = $_POST["email"];
$team = $_POST["team"];	
$usertype = $_POST["admin"];	

//combine first and last names
$name = htmlspecialchars(ucwords($firstname . " " . $lastname), ENT_QUOTES);
$table = "users";


//submit data to database
$result = mysql_query("UPDATE $table SET name = '$name', facebook = '$facebook', email = '$email', team = $team, usertype = $usertype WHERE username = '$username' ");

if($result)
{//alerts overall that it worked
	
	$_SESSION['status']="<br />User Information Changed";

}
else
{

// alerts overall that it didnt work

	$_SESSION['status']="<p>An error occurred when trying to change user information. <br /> Please contact Matt Gerstman at <a href='mailto:MattGerstman@gmail.com'>MattGerstman@gmail.com</a> for assistance.</p>";

}

echo('<SCRIPT LANGUAGE="JavaScript">history.go(-2);</script>');

?>