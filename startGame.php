<?php
require('connectToServer.php');
connect();

session_start();

$table='users';

$sql = "SELECT * FROM $table WHERE pin > 100";
$needTargets = mysql_query($sql);

while ($row = mysql_fetch_array($needTargets))
{
	$myPin = $row['pin'];
	$myTeam = $row['team'];	
	
	for ($i = 0; $i<3; $i++)
	{
		$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 ORDER BY RAND() LIMIT 1";
		$randomUser = mysql_query($sql1);
		$randomUserTeam = mysql_result($randomUser,0,"team");
		
		if ($myTeam != $randomUserTeam)
		{
			$i = 3;
		}
	}

	$randomUserPin = mysql_result($randomUser,0,"pin");	
	$sql2 = "UPDATE $table SET target = $randomUserPin WHERE pin = $myPin";
	$sql3 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
	mysql_query($sql2);
	mysql_query($sql3);	
}

while ($row = mysql_fetch_array($needTargets))
{
	$myPin = $row['pin'];
	$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 ORDER BY RAND() LIMIT 1";
	$randomUser = mysql_query($sql1);
	
	$sql4 = "UPDATE $table SET target = $randomUserPin WHERE pin = $myPin";
	$sql5 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
}

echo("I think it worked. Check the database");

?>