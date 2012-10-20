<?php
require('connectToServer.php');
connect();

session_start();

$table='users';

$setup="Update $table SET target = 0, targetted = 0 WHERE alive = 1";
mysql_query($setup);

$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 AND alive = 1 ORDER BY RAND() LIMIT 1";
$randomUser = mysql_query($sql1);
$randomUserPin = mysql_result($randomUser,0,"pin");	
$firstPin = -1;
$i = 0;

while ($firstPin!=$randomUserPin)
{
	$i++;
	if ($firstPin == -1)
	{
		$firstPin = $randomUserPin;
	}
	$currentPin = $randomUserPin;
	$team = mysql_query("SELECT * FROM $table WHERE pin = $currentPin");
	$team = mysql_result($team, 0 , 'team');
	if ((($i % 5)==0) && (($i/5) <15))
	{
		$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 AND team !=$team AND usertype = 1 ORDER BY RAND() LIMIT 1";
		$randomUser = mysql_query($sql1);
		if (mysql_num_rows($randomUser) == 0)
		{
			$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 ORDER BY RAND() LIMIT 1";
			$randomUser = mysql_query($sql1);
		}
	}
	else
	{
		$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 AND team !=$team AND usertype = 0 ORDER BY RAND() LIMIT 1";
		$randomUser = mysql_query($sql1);
		if (mysql_num_rows($randomUser) == 0)
		{
			$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 ORDER BY RAND() LIMIT 1";
			$randomUser = mysql_query($sql1);
		}

	}
	if (mysql_num_rows($randomUser) == 0)
		$randomUserPin = $firstPin;
	else
		$randomUserPin = mysql_result($randomUser,0,"pin");	

	$sql2 = "UPDATE $table SET target = $randomUserPin WHERE pin = $currentPin";
	$sql3 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
	mysql_query($sql2);
	mysql_query($sql3);
	$sql = mysql_query("SELECT * FROM $table WHERE pin > 100 AND alive = 1 AND targetted = 0");
	echo("$i<br />$sql1<br />$sql2<br />$sql3<br />");
	
}

echo("I think it worked. $i users set");

$sql1 = "SELECT * FROM $table WHERE pin > 100 AND alive = 1 ORDER BY RAND() LIMIT 1";
$randomUser = mysql_query($sql1);
$randomUserPin = mysql_result($randomUser,0,"pin");	
$firstPin = -1;
$i = 0;
while ($firstPin!=$randomUserPin)
{
	$i++;
	if ($firstPin == -1)
	{
		$firstPin = $randomUserPin;
	}
	$currentPin = $randomUserPin;	
	
	$sql0 = "SELECT * FROM $table WHERE pin = $currentPin";
	$sql0 = mysql_query($sql0);
	$currentTarget = mysql_result($sql0,0,"target");
	$sql1 = "SELECT * FROM $table WHERE pin = $currentTarget";
	$randomUser = mysql_query($sql1);
	$randomUserPin = mysql_result($randomUser,0,"pin");	
	echo("$currentPin is targeting $randomUserPin<br />");

}

$sql2 = "SELECT SUM(alive) FROM $table WHERE pin > 100";
$sql2 = mysql_query($sql2);
$numAlive = mysql_result($sql2,0,"SUM(alive)");
echo("Alive: ".$numAlive);
echo("<br />Properly given targets: ".$i);

/*if ($i == $numAlive)
{
	$j=0;
	echo("<br />I think everything worked. Emailing the world now. Another message will post when it's done.<br />");
	$sql2 = "SELECT * FROM $table WHERE pin > 100";
	$result = mysql_query("SELECT * FROM users where alive = 1 AND pin >100");
	while ($row = mysql_fetch_array($result))
	{	
		$j++;	
		$name = $row['name'];
		$email = $row["email"];


			$subject = 'You Have A New Target';
			$message = "Hello $name,

	To make things more interesting we've reassigned all targets. To check out your new target head to http://sgiordano.info/index.php. Happy Hunting!

FTK!
The Assassins Staff

P.S. You never know when we may decide to change things up so get on your targets ;)";
		$headers = 'From: assassins@floridadm.org' . "\r\n" .'X-Mailer: PHP/' . phpversion();

			mail($email, $subject, $message, $headers);
	}

echo("$j users have been emailed.");
}*/

?>