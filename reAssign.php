<?php
require('connectToServer.php');
connect();

session_start();

$table='users';

$setup = "UPDATE $table SET targetted = 0, target = 0 WHERE alive = 1";
mysql_query($setup);


$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 AND alive = 1 ORDER BY RAND() LIMIT 1";
$randomUser = mysql_query($sql1);
$randomUserPin = mysql_result($randomUser,0,"pin");	

$firstUser = $randomUserPin;

while (mysql_num_rows($randomUser))
{
	$currentPin = $randomUserPin;
	
	$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND targetted = 0 AND alive = 1 ORDER BY RAND() LIMIT 1";
	$randomUser = mysql_query($sql1);
	if (mysql_num_rows($randomUser))
		$randomUserPin = mysql_result($randomUser,0,"pin");	
	else
		$randomUserPin = $firstUser;

	$sql2 = "UPDATE $table SET target = $randomUserPin WHERE pin = $currentPin";
	$sql3 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
	mysql_query($sql2);
	mysql_query($sql3);
	$sql = mysql_query("SELECT * FROM $table WHERE pin > 100 AND alive = 1 AND target = 0");
}

echo("I think it worked. Check the database");

?>